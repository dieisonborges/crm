<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franquia extends Model
{
    //
    public function franquiaUser(){        
        return $this->belongsToMany('App\User','franquia_user', 'franquia_id', 'user_id');
    }
    
}
 