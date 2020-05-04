<?php

namespace App\Http\Controllers;

use App\GameProgress;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // TODO: WE NEED TO SAVE THE USER ID.
    // TODO: USERS NEED TO BE LOGGED IN AND IDENTIFIABLE.
    public function saveGame(Request $request) {
        GameProgress::create([
            'score' => $request->score,
            'rocks' => $request->resources['rocks'],
            'magic' => $request->resources['magic'],
            'timeRemaining' => $request->timer ? $request->timer : 0,
            'quarries' => $request->buildings['quarry'],
            'libraries' => $request->buildings['libraries']
        ]);
    }
}
