<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Create a price for the product
        $price = Price::create([
            'product' => $product->id,
            'unit_amount' => $request->price * 100, // Amount in cents
            'currency' => 'eur',
        ]);

        // Optionally, save the product and price IDs to your database
        // ProductModel::create(['stripe_product_id' => $product->id, 'stripe_price_id' => $price->id, ...]);

        return response()->json(['product' => $product, 'price' => $price]);
    }
}