<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('gerir-jogos', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Game::create($request->all());

        return back()->with('success', 'Jogo adicionado com sucesso');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return back()->with('success', 'Jogo removido com sucesso');
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'result' => 'required|string|max:255',
        ]);

        $game->update($request->all());

        return back()->with('success', 'Resultado do jogo atualizado com sucesso');
    }
    
    public function calendario()
    {
        // Fetch all games
        $games = Game::orderBy('date', 'asc')->get();

        return view('calendario', compact('games'));
    }
}