<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    public function tickets(){
    	return $this->hasMany(\App\Ticket::class);
    }
    
}
