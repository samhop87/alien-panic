<?php

namespace App\Http\Controllers;

use App\Building;
use App\GameProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function saveGame(Request $request)
    {
        GameProgress::updateOrCreate([
            'userId' => Auth::user()->id
        ], [
            'attacksSurvived' => $request->attacksSurvived,
            'score' => $request->score,
            'rocks' => $request->resources['rocks'],
            'magic' => $request->resources['magic'],
            'defenders' => 2,
            'timeRemaining' => $request->timer ? $request->timer : 0,
            'quarries' => $request->buildings['quarry'],
            'libraries' => $request->buildings['libraries'],
        ]);

        foreach ($request->construction as $building) {
            switch ($building['type']) {
                case 'Quarry':
                    $building['type'] = Building::QUARRY;
                    break;
                case 'Library':
                    $building['type'] = Building::LIBRARY;
                    break;
                case 'Defender':
                    $building['type'] = Building::DEFENDER;
            }
            Building::create([
                'userId' => Auth::user()->id,
                'type' => $building['type'],
                'x' => $building['ax'],
                'y' => $building['ay']
            ]);
        }
    }
}
