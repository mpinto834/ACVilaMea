<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Ticket;
use Stripe\Stripe;
use Stripe\Charge;

class TicketController extends Controller
{
    public function showPurchaseForm($game_id)
    {
        $game = Game::findOrFail($game_id);
        return view('ticketscheckout', compact('game'));
    }

    public function handlePurchase(Request $request)
    {
        $game = Game::findOrFail($request->input('game_id'));
        $quantity = $request->input('quantity');
        $amount = $quantity * 1000; // Example: 10.00 EUR per ticket

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'source' => $request->input('stripeToken'),
                'description' => 'Ticket Purchase for ' . $game->team1_name . ' vs ' . $game->team2_name,
            ]);

            if ($charge->status == 'succeeded') {
                // Save ticket information to the database
                Ticket::create([
                    'user_id' => auth()->id(),
                    'game_id' => $game->id,
                    'quantity' => $quantity,
                    'amount' => $amount / 100, // Convert to EUR
                    'payment_status' => 'completed',
                ]);

                return redirect()->route('tickets.purchase', ['game_id' => $game->id])->with('success', 'Bilhetes comprados com sucesso!');
            } else {
                return redirect()->route('tickets.purchase', ['game_id' => $game->id])->with('error', 'Erro ao processar o pagamento.');
            }
        } catch (\Exception $e) {
            return redirect()->route('tickets.purchase', ['game_id' => $game->id])->with('error', 'Stripe error: ' . $e->getMessage());
        }
    }
}