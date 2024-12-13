<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('checkout', compact('intent'));
    }

    public function processCheckout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount * 100, // Amount in cents
            'currency' => 'eur',
            'payment_method' => $request->payment_method,
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        if ($paymentIntent->status == 'succeeded') {
            // Handle successful payment
            return redirect()->route('home')->with('success', 'Payment successful!');
        } else {
            // Handle payment failure
            return redirect()->route('checkout')->with('error', 'Payment failed. Please try again.');
        }
    }
}