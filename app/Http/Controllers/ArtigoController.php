<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\TipoArtigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtigoController extends Controller
{
    public function index()
    {
        $artigos = Artigo::all();
        $tipos_artigos = TipoArtigo::all();
        return view('gerir-artigos', compact('artigos', 'tipos_artigos'));
    }

    public function store(Request $request)
    {
        $artigo = new Artigo();
        $artigo->nome = $request->nome;
        $artigo->tipo_artigo_id = $request->tipo_artigo_id;
        $artigo->preco = $request->preco;
        
        // Verifica se o tipo de artigo tem tamanhos
        $tipoArtigo = TipoArtigo::find($request->tipo_artigo_id);
        
        if ($tipoArtigo->tem_tamanho) {
            // Lógica para artigos com tamanhos
            $tamanhos_stock = [];
            foreach ($request->tamanhos ?? [] as $tamanho) {
                $tamanhos_stock[$tamanho] = $request->quantidade[$tamanho];
            }
            $artigo->tamanhos_stock = json_encode($tamanhos_stock);
            $artigo->stock = array_sum($tamanhos_stock);
        } else {
            // Lógica para artigos sem tamanhos
            $artigo->stock = $request->stock;
            $artigo->tamanhos_stock = null;
        }

        // Processa a imagem
        if ($request->hasFile('imagem')) {
            $artigo->imagem = $request->file('imagem')->store('artigos', 'public');
        }

        $artigo->save();

        return redirect()->back()->with('success', 'Artigo adicionado com sucesso!');
    }

    public function update(Request $request, Artigo $artigo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|max:2048',
        ]);

        // Primeiro, atualize os dados básicos
        $artigo->nome = $request->nome;
        $artigo->preco = $request->preco;

        // Verifica se o tipo de artigo tem tamanhos
        if ($artigo->tipoArtigo->tem_tamanho) {
            // Lógica para artigos com tamanhos
            $tamanhos_stock = [];
            if ($request->tamanhos) {
                foreach ($request->tamanhos as $tamanho) {
                    if (isset($request->quantidade[$tamanho])) {
                        $tamanhos_stock[$tamanho] = (int) $request->quantidade[$tamanho];
                    }
                }
            }
            $artigo->tamanhos_stock = json_encode($tamanhos_stock);
            $artigo->stock = array_sum($tamanhos_stock);
        } else {
            // Lógica para artigos sem tamanhos
            $artigo->stock = (int) $request->stock;
            $artigo->tamanhos_stock = null;
        }

        // Processa a imagem se uma nova for enviada
        if ($request->hasFile('imagem')) {
            if ($artigo->imagem) {
                Storage::disk('public')->delete($artigo->imagem);
            }
            $artigo->imagem = $request->file('imagem')->store('artigos', 'public');
        }

        $artigo->save();

        return redirect()->back()->with('success', 'Artigo atualizado com sucesso!');
    }

    public function destroy(Artigo $artigo)
    {
        if ($artigo->imagem) {
            Storage::disk('public')->delete($artigo->imagem);
        }
        
        $artigo->delete();
        return redirect()->back()->with('success', 'Artigo excluído com sucesso!');
    }

    public function loja()
    {
        $artigos = Artigo::with('tipoArtigo')->get()->map(function($artigo) {
            // Se o artigo tem tamanhos
            if ($artigo->tipoArtigo->tem_tamanho) {
                $tamanhos_stock = json_decode($artigo->tamanhos_stock, true) ?? [];
                $artigo->stock = array_sum($tamanhos_stock); // Soma total do stock
                $artigo->tamanhos_disponiveis = array_keys($tamanhos_stock); // Tamanhos disponíveis
                $artigo->stock_por_tamanho = $tamanhos_stock; // Stock por tamanho
            }
            // Se não tem tamanhos, o stock já está correto no campo 'stock'
            return $artigo;
        });

        return view('loja', compact('artigos'));
    }
} 