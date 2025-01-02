<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product as StripeProduct;
use Stripe\Price as StripePrice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function loja()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Fetch products from Stripe
        $products = StripeProduct::all(['active' => true]);

        // Fetch prices for each product
        foreach ($products->data as $product) {
            $prices = StripePrice::all(['product' => $product->id, 'active' => true]);
            $product->price = $prices->data[0]->unit_amount / 100; // Assuming each product has at least one price
        }

        return view('loja', ['products' => $products->data]);
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Força a quantidade mínima como 1
            $quantity = max(1, intval($request->quantity));

            // Handle image upload
            $imageUrl = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $imageUrl = Storage::url($imagePath);
            }

            // Create a product
            $product = StripeProduct::create([
                'name' => $request->name,
                'description' => $request->description,
                'metadata' => [
                    'image_url' => $imageUrl,
                    'quantity' => $quantity,
                ],
            ]);

            // Create a price for the product
            $price = StripePrice::create([
                'product' => $product->id,
                'unit_amount' => max(1, $request->price * 100),
                'currency' => 'eur',
            ]);

            Log::info('Product created successfully', ['product' => $product, 'price' => $price]);

            return redirect()->back()->with('success', 'Produto adicionado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Error creating product', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao adicionar produto: ' . $e->getMessage());
        }
    }

    public function showAddProductForm()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Fetch the list of products from Stripe
        $products = StripeProduct::all(['limit' => 10]);

        return view('add-product', compact('products'));
    }

    public function deleteProduct($id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Retrieve the product
            $product = StripeProduct::retrieve($id);

            // Retrieve all associated prices
            $prices = StripePrice::all(['product' => $id]);

            // Deactivate the prices
            foreach ($prices->data as $price) {
                StripePrice::update($price->id, [
                    'active' => false,
                ]);
            }

            // Archive the product (Stripe recommends this instead of deletion)
            StripeProduct::update($id, [
                'active' => false,
            ]);

            return redirect()->back()->with('success', 'Produto arquivado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao arquivar produto: ' . $e->getMessage());
        }
    }
}