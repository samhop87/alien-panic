<?php

namespace App\Http\Controllers;

use App\GameProgress;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function saveGame(Request $request) {
        dd("hit", $request->resources['rocks']);
        GameProgress::create([
            'rocks' => $request->resources->rocks,
            'magic' => $request->resources->magic,
            'timeRemaining' => $request->timer,
        ]);
    }
}
