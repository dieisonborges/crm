<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaProspecto extends Model
{
    //    
    public function listaProspectoFranquia(){        
        return $this->belongsToMany(\App\Franquia::class, 'lista_prospecto_franquia');
    }

    public function listaProspectoProduto(){        
        return $this->belongsToMany(\App\Produto::class, 'lista_prospecto_produto');
    }

    public function listaProspectoCategoria(){        
        return $this->belongsToMany(\App\Categoria::class, 'lista_prospecto_categoria');
    }

}
