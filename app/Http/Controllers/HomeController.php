<?php
namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Game;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the latest 3 news
        $latestNews = News::orderBy('created_at', 'desc')->take(3)->get();

        // Fetch the next game
        $nextGame = Game::where('date', '>', Carbon::now())->orderBy('date', 'asc')->first();

        // Fetch the previous game
        $previousGame = Game::where('date', '<', Carbon::now())->orderBy('date', 'desc')->first();

        return view('home', compact('latestNews', 'nextGame', 'previousGame'));
    }
}