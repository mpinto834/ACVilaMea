<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('date_time', 'desc')->get();
        return view('gerir-jogos', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_type' => 'required|in:home,away',
            'team2_name' => 'required|string|max:255',
            'team2_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'date_time' => 'required|date',
        ]);

        if ($request->hasFile('team2_photo')) {
            $team2_photo = 'storage/' . $request->file('team2_photo')->store('team_photos', 'public');
        }

        $data = [
            'game_type' => $request->game_type,
            'location' => $request->location,
            'date_time' => $request->date_time
        ];

        // Se for jogo em casa
        if ($request->game_type === 'home') {
            $data['team1_name'] = 'AC Vila Meã';
            $data['team1_photo'] = 'images/AC-VILA-MEA.ico';
            $data['team2_name'] = $request->team2_name;
            $data['team2_photo'] = $team2_photo;
        } 
        // Se for jogo fora
        else {
            $data['team1_name'] = $request->team2_name;
            $data['team1_photo'] = $team2_photo;
            $data['team2_name'] = 'AC Vila Meã';
            $data['team2_photo'] = 'images/AC-VILA-MEA.ico';
        }

        Game::create($data);

        return back()->with('success', 'Jogo adicionado com sucesso');
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'result' => 'required|string|max:255',
        ]);

        $game->update($request->all());

        return back()->with('success', 'Resultado do jogo atualizado com sucesso');
    }

    public function destroy(Game $game)
    {
        if ($game->team2_photo && $game->team2_photo !== 'images/AC-VILA-MEA.ico') {
            Storage::disk('public')->delete($game->team2_photo);
        }else{
            Storage::disk('public')->delete($game->team1_photo);
        }
        
        $game->delete();
        return back()->with('success', 'Jogo removido com sucesso');
    }

    public function calendario()
    {
        $games = Game::all();

        $futureGames = $games->filter(function($game) {
            return $game->date_time > now();
        })->sortBy('date_time');

        $pastGames = $games->filter(function($game) {
            return $game->date_time <= now();
        })->sortByDesc('date_time');

        return view('calendario', compact('futureGames', 'pastGames'));
    }

    public function home()
    {
        $nextGame = Game::whereNull('result')
                        ->orderBy('date_time', 'asc')
                        ->first();

        $previousGame = Game::whereNotNull('result')
                           ->orderBy('date_time', 'desc')
                           ->first();

        return view('home', compact('nextGame', 'previousGame'));
    }
}