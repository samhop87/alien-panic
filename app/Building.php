<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = "building_coordinates";

    const QUARRY   = 1;
    const LIBRARY  = 2;
    const DEFENDER = 3;

    protected $fillable = [
        'userId',
        'type',
        'x',
        'y',
    ];

//    public function gameProgress() {
//        return $this->hasOne('gameProgress', 'userId');
//    }
}
