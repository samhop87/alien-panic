<?php

namespace App\Http\Controllers;

use App\Building;
use App\GameProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $retrieved = GameProgress::where('userId', Auth::User()->id)->first();
        $savedGame = $retrieved ? $retrieved->toJson() : null;

        if ($savedGame) {
            $record = Building::where('userId', Auth::User()->id)->get();
            $buildings = $record ? $record->toJson() : null;
        }

        return view('index', compact(['savedGame', 'buildings']));
    }
}
