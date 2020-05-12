<?php

namespace App\Http\Controllers;

use App\GameProgress;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    // TODO: WE NEED TO SAVE THE USER ID.
    // TODO: USERS NEED TO BE LOGGED IN AND IDENTIFIABLE.
    public function saveGame(Request $request) {
        GameProgress::create([
            'userId'=> Auth::user()->id,
            'score' => $request->score,
            'rocks' => $request->resources['rocks'],
            'magic' => $request->resources['magic'],
            'defenders' => 1,
            'timeRemaining' => $request->timer ? $request->timer : 0,
            'quarries' => $request->buildings['quarry'],
            'libraries' => $request->buildings['libraries']
        ]);
    }
}
