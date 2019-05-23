<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franquia extends Model
{
    //
    public function franquiaUser(){        
        return $this->belongsToMany('App\User','franquia_user', 'franquia_id', 'user_id');
    }

    public function franquiaProdutos(){        
        return $this->belongsToMany('App\Produto','produto_franquia', 'franquia_id', 'produto_id');
    }

    public function listaProspecto(){        
        return $this->belongsToMany(\App\ListaProspecto::class, 'lista_prospecto_franquia');
    }
    
}
 