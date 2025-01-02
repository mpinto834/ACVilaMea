<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => 1099, // Example amount in cents
            'currency' => 'eur',
        ]); 

        return view('checkout', ['intent' => $intent]);
    }

    public function handleCheckout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->amount; // Amount in cents

        if ($amount < 50) { // Ensure the amount meets the minimum requirement
            return response()->json(['error' => 'The amount must be at least 50 cents.']);
        }

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method' => 'pm_card_visa',
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('checkout.success'), // Provide a return URL
        ]);

        if ($paymentIntent->status == 'requires_action' &&
            $paymentIntent->next_action->type == 'use_stripe_sdk') {
            return response()->json([
                'requires_action' => true,
                'payment_intent_client_secret' => $paymentIntent->client_secret
            ]);
        } else if ($paymentIntent->status == 'succeeded') {
            // Decodificar os produtos do carrinho
            $cartData = json_decode($request->cart, true);
            
            $products = collect($cartData)->map(function ($item) {
                return (object) [
                    'name' => $item['name'],
                    'quantity' => $item['quantidade'], // Note que usamos 'quantidade' aqui
                    'price' => $item['price']
                ];
            });

            try {
                $pdf = PDF::loadView('emails.invoice-pdf', [
                    'user' => auth()->user(),
                    'products' => $products,
                    'total' => $amount / 100,
                ]);

                Mail::to(auth()->user()->email)->send(new InvoiceMail(
                    $paymentIntent,
                    auth()->user(),
                    $products,
                    $amount / 100,
                    $pdf->output()
                ));

            } catch (\Exception $e) {
                \Log::error('Erro ao gerar PDF ou enviar email: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return redirect()->route('checkout.success');
        } else {
            // Invalid status
            return response()->json(['error' => 'Invalid PaymentIntent status']);
        }
    }

    public function checkoutSuccess()
    {
        return view('checkout-success');
    }
}