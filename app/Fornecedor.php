<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    //
    public function users(){        
        return $this->belongsToMany('App\User','fornecedor_user', 'fornecedor_id', 'user_id');
    }
}
