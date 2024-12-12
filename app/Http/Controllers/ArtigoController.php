<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artigo;
use Illuminate\Support\Facades\Storage;

class ArtigoController extends Controller
{
    // Lista todos os artigos
    public function index()
    {
        $artigos = Artigo::all();
        return view('gerir-artigos', compact('artigos'));
    }

    // Armazena um novo artigo
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artigo = new Artigo();
        $artigo->nome = $request->nome;
        $artigo->stock = $request->stock;
        $artigo->preco = $request->preco;

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('artigos', 'public');
            $artigo->imagem = $path;
        }

        $artigo->save();

        return redirect()->route('artigos.index')->with('success', 'Artigo criado com sucesso!');
    }

    // Atualiza um artigo existente
    public function update(Request $request, Artigo $artigo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artigo->nome = $request->nome;
        $artigo->stock = $request->stock;
        $artigo->preco = $request->preco;

        if ($request->hasFile('imagem')) {
            if ($artigo->imagem) {
                Storage::disk('public')->delete($artigo->imagem);
            }
            
            $path = $request->file('imagem')->store('artigos', 'public');
            $artigo->imagem = $path;
        }

        $artigo->save();

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    // Exclui um artigo
    public function destroy(Artigo $artigo)
    {
        if ($artigo->imagem) {
            Storage::delete(str_replace('/storage', 'public', $artigo->imagem));
        }
        $artigo->delete();

        return redirect()->route('artigos.index')->with('success', 'Artigo excluído com sucesso!');
    }

    // Exibe a loja
    public function loja()
    {
        $artigos = Artigo::all();
        return view('loja', compact('artigos'));
    }
} 