<?php

namespace App\Http\Controllers;

use App\Models\TipoArtigo;
use Illuminate\Http\Request;

class TiposArtigosController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tem_tamanho' => 'boolean'
        ]);

        TipoArtigo::create([
            'nome' => $request->nome,
            'tem_tamanho' => $request->has('tem_tamanho')
        ]);

        return redirect()->back()->with('success', 'Tipo de artigo criado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoArtigo $tiposArtigo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tem_tamanho' => 'boolean'
        ]);

        $tiposArtigo->update([
            'nome' => $request->nome,
            'tem_tamanho' => $request->has('tem_tamanho')
        ]);

        return redirect()->back()->with('success', 'Tipo de artigo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoArtigo $tiposArtigo)
    {
        // Verificar se existem artigos usando este tipo
        if ($tiposArtigo->artigos()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível excluir este tipo pois existem artigos associados a ele.');
        }

        $tiposArtigo->delete();
        return redirect()->back()->with('success', 'Tipo de artigo excluído com sucesso!');
    }
} 