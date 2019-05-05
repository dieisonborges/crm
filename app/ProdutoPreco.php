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

    public function orcamentos(){        
        return $this->belongsTo('App\Orcamento', 'orcamento_id', 'id');
    }

    public function itemOrcamentos(){        
        return $this->belongsTo('App\ItemOrcamento', 'item_orcamento_id', 'id');
    }

}
