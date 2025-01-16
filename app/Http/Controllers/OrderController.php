<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller{

    public function store(Request $request)
    {

            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'products' => 'required|array',
                'products.*' => 'integer|exists:products,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|string',
            ]);


            $order = Order::create([
                'user_id' => $validated['user_id'],
                'products' => json_encode($validated['products']),
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
            ]);


            return response()->json([
                'message' => 'Pedido criado com sucesso!',
                'order' => $order
            ], 201);
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', auth()->id())
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('user.orders', compact('orders'));
    }
}

/* class OrderController extends Controller
{
    public function userOrders()
    {
        $orders = Order::where('user_id', auth()->id())
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('user.orders', compact('orders'));
    }
}  */