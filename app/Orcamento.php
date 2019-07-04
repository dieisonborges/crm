<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    public function fornecedor(){
    	return $this->belongsTo(\App\Fornecedor::class);
    }
}
