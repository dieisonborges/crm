<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use App\User;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'apelido', 'email', 'country', 'cpf', 'phone_number', 'password', 'convite',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];


    //
    public function roles(){
        
        return $this->belongsToMany(\App\Role::class);
    }


    public function setors(){
        
        return $this->belongsToMany(\App\Setor::class);
    }

    public function enderecos(){
        
        return $this->belongsToMany(\App\Endereco::class);
    }

    public function franquia(){        
        return $this->belongsToMany(\App\Franquia::class);
    }

    public function fornecedor(){        
        return $this->belongsToMany(\App\Fornecedor::class);
    }

    public function franqueadoVip(){        
        return $this->hasMany(\App\FranqueadoVip::class);
    }

    public function conquista(){        
        return $this->belongsToMany(\App\Conquista::class);
    }

    public function carteira(){        
        return $this->hasMany(\App\Carteira::class);
    }   

    public function scores(){
        
        return $this->hasMany(\App\Score::class);
    }

    public function uploads(){        
        return $this->belongsToMany('App\Upload','imagem_user');
    }

    public function convites(){        
        return $this->belongsTo(\App\Convite::class);
    }

    /* --------------------- SEGURANCA ----------------------*/

    public function hasPermission(Permission $permission){

        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles){

        if(is_array($roles) || is_object($roles) ) {
            return !! $roles->intersect($this->roles)->count();
        }
        
        return $this->roles->contains('name', $roles);
        

    }

    public function hasRole($role){

        if($this->roles->contains('name', $role)){
            return true;
        }else{
            return false;
        }        

    }

    /* -------------------- SEGURANCA ----------------------*/


   
}
