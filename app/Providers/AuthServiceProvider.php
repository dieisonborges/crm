<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Role;
use App\Permission;
use App\Setor; 
use App\Config;

use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class AuthServiceProvider extends ServiceProvider
{
    
    private function first_deploy(){
        //true or false
        //.env
        return config('app.first_deploy');
    }

    private function active_adm(){
        //true or false
        //.env
        return config('app.active_adm');
    }

    private function html_alert($type, $msg){

        $msg = '
        <div class="box-body">
            <div class="alert alert-'.$type.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i>'.$type.'</h4>
                '.$msg.'
            </div>
        </div>
            ';

        return $msg;


    }


    /* ----------------------- LOGS ----------------------*/
    
    private function log($info){
        //path name
        $filename="AuthServiceProvider";

        $log = new LogController;
        $log->store($filename, $info);
        return null;  

    }
    /* ----------------------- END LOGS --------------------*/


    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        /*
        'App\Model' => 'App\Policies\ModelPolicy',
        */
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        //LOG --------------------------------------------------------------------------
        if($this->first_deploy()){
            //Aviso
            echo $this->html_alert("danger", "Set First deploy - Ignore Security");
        }else{
            //$this->log("GateContract");
        }
        //------------------------------------------------------------------------------
        
        $this->registerPolicies($gate);

        //

        //Comente esse bloco no primeiro migrate

        /* --------------------- Carrega as permissões ------------------------ */
        if($this->first_deploy()){
            //Aviso
            echo $this->html_alert("danger", "Set First deploy - Ignore Security");
        }else{
    
            $permissions = Permission::with('roles')->get();

            foreach ($permissions as $permission) {
                 
                $gate->define(

                    $permission->name, function(User $user) use ($permission){                 

                        return $user->hasPermission($permission);

                    }

                );

                if($this->active_adm()){
                    //Ativa bypass para grupo adm                    

                    //aviso
                    echo $this->html_alert("danger", "Set Active Administrator- Low Security");

                    Gate::before(function ($user) {
                        if ($user->hasRole('adm')) {
                            return true;
                        }
                    });
                }

            }


        }
        /* ------------- Carega setores para MENUS ---------------------*/
        if($this->first_deploy()){
            //Aviso
            echo $this->html_alert("danger", "Set First deploy - Ignore Security");
        }else{
            // Criar uma sessão
            
            $setors = Setor::select('name', 'label')->get();
            session(['setors' => $setors]);
        } 
        /* ------------- Carega setores para MENUS ---------------------*/



    }
}
