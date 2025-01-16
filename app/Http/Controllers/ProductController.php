<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product as StripeProduct;
use Stripe\Price as StripePrice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Artigo;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function loja()
    {
        $products = Artigo::all();

        $desconto = 0;
        if (auth()->check() && auth()->user()->role === 1) {
        $desconto = 0.10;
        }

        return view('loja', compact('products','desconto'));
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);



            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $path = $image->store('artigos', 'public');
            }

            $artigo = Artigo::create([
                        'nome' => $request->name,
                        'descricao' => $request->description,
                        'preco' => $request->price,
                        'imagem' => $path,
                    ]);



            return redirect()->back()->with('success', 'Produto adicionado com sucesso!');

    }

    public function showAddProductForm()
    {
        $products = Artigo::orderBy('created_at', 'desc')->take(10)->get();

        return view('add-product', compact('products'));
    }

    public function deleteProduct(Artigo $produto)
    {
           if ($produto->image) {
           Storage::disk('public')->delete($produto->image);
           }

           $produto->delete();


           return redirect()->back()->with('success', 'Produto eliminado com sucesso!');
    }
}


/* class ProductController extends Controller
{
    public function loja()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $products = StripeProduct::all(['active' => true]);

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
            $quantity = max(1, intval($request->quantity));

            $imageUrl = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $imageUrl = Storage::url($imagePath);
            }

           $product = StripeProduct::create([
                'name' => $request->name,
                'description' => $request->description,
                'metadata' => [
                    'image_url' => $imageUrl,
                    'quantity' => $quantity,
                ],
            ]);

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

        $products = StripeProduct::all(['limit' => 10]);

        return view('add-product', compact('products'));
    }

    public function deleteProduct($id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $product = StripeProduct::retrieve($id);

            $prices = StripePrice::all(['product' => $id]);

            foreach ($prices->data as $price) {
                StripePrice::update($price->id, [
                    'active' => false,
                ]);
            }

            StripeProduct::update($id, [
                'active' => false,
            ]);

            return redirect()->back()->with('success', 'Produto arquivado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao arquivar produto: ' . $e->getMessage());
        }
    }
} */