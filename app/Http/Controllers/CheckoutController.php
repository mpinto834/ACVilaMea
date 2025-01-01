<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

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
            // The payment didn’t need any additional actions and completed!
            // Handle post-payment fulfillment
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