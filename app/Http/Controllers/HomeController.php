<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Equipa;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar o próximo jogo
        $nextGame = Game::where('date_time', '>', now())
                       ->orderBy('date_time', 'asc')
                       ->first();
        
        // Buscar o jogo anterior
        $previousGame = Game::where('date_time', '<', now())
                          ->orderBy('date_time', 'desc')
                          ->first();

        $equipas = Equipa::orderBy('pontos', 'desc')->get();

        
        // Buscar as últimas notícias
        $latestNews = News::latest()->take(3)->get();

        return view('home', compact('nextGame', 'previousGame', 'latestNews', 'equipas'));
    }
}