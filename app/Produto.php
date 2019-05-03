<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    public function imagens(){        
        return $this->belongsToMany('App\Upload','galeria_produto');
    }

    public function categorias(){        
        return $this->belongsToMany('App\Categoria','categoria_produto', 'produto_id', 'categoria_id');
    }
}
