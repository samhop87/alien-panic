<?php

namespace App\Http\Controllers;

use App\GameProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function saveGame(Request $request) {

        GameProgress::updateOrCreate([
            'userId' => Auth::user()->id
        ],[
            'score' => $request->score,
            'rocks' => $request->resources['rocks'],
            'magic' => $request->resources['magic'],
            'defenders' => 2,
            'timeRemaining' => $request->timer ? $request->timer : 0,
            'quarries' => $request->buildings['quarry'],
            'libraries' => $request->buildings['libraries']
        ]);
    }
}
