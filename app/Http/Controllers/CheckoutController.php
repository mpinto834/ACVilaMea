<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckoutForm(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve the cart items from the session
        $cart = $request->session()->get('cart', []);
        $amount = 0;

        // Calculate the total amount based on the items in the cart
        foreach ($cart as $item) {
            $amount += $item['price'] * $item['quantity'];
        }

        // Convert amount to cents
        $amountInCents = $amount * 100;

        return view('checkout', ['cart' => $cart, 'total' => $amount, 'amountInCents' => $amountInCents]);
    }

    public function handleCheckout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->input('amount'); // Amount in cents

        // Minimum amount validation
        $minimumAmount = 50; // For EUR, the minimum is 50 cents
        if ($amount < $minimumAmount) {
            return response()->json(['error' => 'The amount must be at least €0.50.']);
        }

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'source' => $request->input('stripeToken'), // The token representing the payment method
                'description' => 'Order Description',
            ]);

            if ($charge->status == 'succeeded') {
                // Decodificar os produtos do carrinho
                $cartData = json_decode($request->input('cart'), true);

                // Criar a ordem no banco de dados
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'products' => json_encode($cartData), // Converte os dados do carrinho em JSON
                    'amount' => $amount / 100, // Este é o valor em euros
                    'payment_method' => 'card', // Define o método de pagamento como 'card'
                ]);

                try {
                    // Enviar fatura por e-mail
                $products = collect($cartData)->map(function ($item) {
                    return (object) [
                        'name' => $item['name'],
                        'quantity' => $item['quantidade'],
                        'price' => $item['price']
                    ];
                });

                    $pdf = PDF::loadView('emails.invoice-pdf', [
                        'user' => auth()->user(),
                        'products' => $products,
                        'total' => $amount / 100,
                    ]);
    
                    Mail::to(auth()->user()->email)->send(new InvoiceMail(
                        $order,
                        auth()->user(),
                        $products,
                        $amount / 100,
                        $pdf->output()
                    ));
    
                } catch (\Exception $e) {
                    \Log::error('Erro ao gerar PDF ou enviar email: ' . $e->getMessage());
                    return response()->json(['error' => $e->getMessage()], 500);
                }

                // Handle post-payment fulfillment
                return redirect()->route('checkout.success');
            } else {
                // Invalid status
                return response()->json(['error' => 'Invalid Charge status']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Stripe error: ' . $e->getMessage()]);
        }
    }

    public function checkoutSuccess()
    {
        return view('checkout-success');
    }
}

/* class CheckoutController extends Controller
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

        $amount = $request->amount;

        if ($amount < 50) {
            return response()->json(['error' => 'The amount must be at least 50 cents.']);
        }

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method' => 'pm_card_visa',
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('checkout.success'),
        ]);

        if ($paymentIntent->status == 'requires_action' &&
            $paymentIntent->next_action->type == 'use_stripe_sdk') {
            return response()->json([
                'requires_action' => true,
                'payment_intent_client_secret' => $paymentIntent->client_secret
            ]);
        } else if ($paymentIntent->status == 'succeeded') {
            $cartData = json_decode($request->cart, true);
            
            $order = Order::create([
                'user_id' => auth()->id(),
                'products' => $request->cart,
                'amount' => $amount,
                'payment_method' => $request->payment_method,
                'status' => 'completed'
            ]);

            $products = collect($cartData)->map(function ($item) {
                return (object) [
                    'name' => $item['name'],
                    'quantity' => $item['quantidade'],
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
            return response()->json(['error' => 'Invalid PaymentIntent status']);
        }
    }

    public function checkoutSuccess()
    {
        return view('checkout-success');
    }
} */