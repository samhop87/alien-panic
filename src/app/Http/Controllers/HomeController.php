<?php

namespace App\Http\Controllers;

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
        $savedGame = GameProgress::where('userId', Auth::User()->id)->first()->toJson();
        return view('index', compact(['savedGame']));
    }
}
