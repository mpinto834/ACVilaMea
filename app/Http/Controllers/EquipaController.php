<?php

namespace App\Http\Controllers;

use App\Models\Equipa;
use Illuminate\Http\Request;

class EquipaController extends Controller
{
    public function index()
    {
        $equipas = Equipa::orderBy('pontos', 'desc')->get();
        return view('gerir-equipas', compact('equipas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pontos' => 'required|integer',
        ]);

        $equipa = new Equipa();
        $equipa->nome = $request->nome;
        $equipa->pontos = $request->pontos;

        if ($request->hasFile('logo')) {
            $equipa->logo = $request->file('logo')->store('logos', 'public');
        }

        $equipa->save();

        return redirect()->route('equipas.index')->with('success', 'Equipa adicionada com sucesso!');
    }

    public function update(Request $request, Equipa $equipa)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pontos' => 'required|integer',
        ]);

        $equipa->nome = $request->nome;
        $equipa->pontos = $request->pontos;

        if ($request->hasFile('logo')) {
            $equipa->logo = $request->file('logo')->store('logos', 'public');
        }

        $equipa->save();

        return redirect()->route('equipas.index')->with('success', 'Equipa atualizada com sucesso!');
    }

    public function destroy(Equipa $equipa)
    {
        $equipa->delete();
        return redirect()->route('equipas.index')->with('success', 'Equipa excluída com sucesso!');
    }
}
