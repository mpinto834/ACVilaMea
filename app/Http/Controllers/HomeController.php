<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\News;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar as últimas 3 notícias
        $latestNews = News::orderBy('created_at', 'desc')->take(3)->get();

        // Buscar o próximo jogo (que ainda não tem resultado)
        $nextGame = Game::whereNull('result')
                       ->where('date_time', '>', Carbon::now())
                       ->orderBy('date_time', 'asc')
                       ->first();

        // Buscar o jogo anterior (que já tem resultado)
        $previousGame = Game::whereNotNull('result')
                          ->where('date_time', '<', Carbon::now())
                          ->orderBy('date_time', 'desc')
                          ->first();

        return view('home', compact('latestNews', 'nextGame', 'previousGame'));
    }
}