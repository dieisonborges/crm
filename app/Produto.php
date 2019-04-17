<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    public function imagens(){        
        return $this->belongsToMany('App\Upload','galeria_produto');
    }
}
