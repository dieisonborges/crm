<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conquista extends Model
{
    //
    public function users(){
    	return $this->belongsToMany(\App\User::class);
    }
}
