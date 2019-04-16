<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{
    //

    public function categorias(){        
        return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
    }

    public function users(){        
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function prontuarioTickets(){        
        return $this->belongsToMany('App\Ticket','prontuario_tickets');
    }

    public function prontuarioTicketsShow(){        
        return $this->hasMany(\App\ProntuarioTickets::class);
    }

    public function setors(){
        
        return $this->belongsToMany(\App\Setor::class);
    }

    public function uploads(){        
        return $this->belongsToMany('App\Upload','upload_ticket');
    }
 


}
