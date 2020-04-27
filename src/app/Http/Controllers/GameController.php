<?php

namespace App\Http\Controllers;

use App\GameProgress;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function saveGame() {
        dd("hit");
        GameProgress::create([]);
    }
}
