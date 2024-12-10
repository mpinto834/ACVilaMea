<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    public function index()
    {
        $fotos = Foto::all();
        return view('gerir-galeria', compact('fotos'));
    }

    public function show()
    {
        $fotos = Foto::all();
        return view('galeria', compact('fotos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|max:2048', // máximo 2MB
            'legenda' => 'required|string|max:255'
        ]);

        $path = $request->file('imagem')->store('galeria', 'public');

        Foto::create([
            'imagem' => $path,
            'legenda' => $request->legenda
        ]);

        return redirect()->route('galeria.index')
            ->with('success', 'Foto adicionada com sucesso!');
    }

    public function destroy(Foto $foto)
    {
        if ($foto->imagem) {
            Storage::disk('public')->delete($foto->imagem);
        }

        $foto->delete();

        return redirect()->route('galeria.index')
            ->with('success', 'Foto removida com sucesso!');
    }

    public function update(Request $request, $foto)
    {
        // Lógica para atualizar a foto
        // Validação dos dados
        $validated = $request->validate([
            'legenda' => 'required|string|max:255',
        ]);

        // Atualizar a foto no banco de dados
        $foto = Foto::findOrFail($foto);
        $foto->update($validated);

        return redirect()->back()->with('success', 'Foto atualizada com sucesso!');
    }
} 