<?php

namespace App\Http\Controllers;

use App\Models\Jogador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlantelController extends Controller
{
    public function index()
    {
        $jogadores = Jogador::orderBy('numero')->get();
        return view('gerir-plantel', compact('jogadores'));
    }

    public function show()
    {
        $jogadores = Jogador::orderBy('posicao')
            ->orderBy('numero')
            ->get();
        return view('plantel', compact('jogadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero' => 'required|integer|min:1|max:99|unique:jogadores,numero',
            'posicao' => 'required|in:Guarda Redes,Defesa,Médio,Avançado',
            'foto' => 'required|image|max:2048' // máximo 2MB
        ]);

        $path = $request->file('foto')->store('jogadores', 'public');

        Jogador::create([
            'nome' => $request->nome,
            'numero' => $request->numero,
            'posicao' => $request->posicao,
            'foto' => $path
        ]);

        return redirect()->route('plantel.index')
            ->with('success', 'Jogador adicionado com sucesso!');
    }

    public function update(Request $request, Jogador $jogador)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero' => 'required|integer|min:1|max:99|unique:jogadores,numero,' . $jogador->id,
            'posicao' => 'required|in:Guarda Redes,Defesa,Médio,Avançado',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Apaga a foto antiga
            if ($jogador->foto) {
                Storage::disk('public')->delete($jogador->foto);
            }
            // Salva a nova foto
            $path = $request->file('foto')->store('jogadores', 'public');
            $jogador->foto = $path;
        }

        $jogador->nome = $request->nome;
        $jogador->numero = $request->numero;
        $jogador->posicao = $request->posicao;
        $jogador->save();

        return redirect()->route('plantel.index')
            ->with('success', 'Jogador atualizado com sucesso!');
    }

    public function destroy(Jogador $jogador)
    {
        // Apaga a foto do jogador
        if ($jogador->foto) {
            Storage::disk('public')->delete($jogador->foto);
        }

        $jogador->delete();

        return redirect()->route('plantel.index')
            ->with('success', 'Jogador removido com sucesso!');
    }
} 