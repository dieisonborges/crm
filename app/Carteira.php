<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{
    //
    public function user(){
    	return $this->hasMany(\App\User::class);
    }
}
