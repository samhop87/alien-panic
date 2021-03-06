<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameProgress extends Model
{
    protected $table = "game_progress";

    protected $fillable = [
        'userId',
        'rocks',
        'magic',
        'timeRemaining',
        'quarries',
        'libraries',
        'defenders',
        'score',
        'attacksSurvived'
    ];
}
