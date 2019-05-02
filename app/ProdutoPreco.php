<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoPreco extends Model
{
    //Produto
    public function produtos(){        
        return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }

    //Fornecedor
    public function fornecedores(){        
        return $this->belongsTo('App\Fornecedor', 'fornecedor_id', 'id');
    }

}
