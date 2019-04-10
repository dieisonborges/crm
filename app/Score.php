<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    public function users(){        
        return $this->belongsTo(\App\User::class);
    }
}
