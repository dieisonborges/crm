<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Role;
use App\Permission;
use App\Setor; 

use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class AuthServiceProvider extends ServiceProvider
{
    $first_deploy = config('app.name');

    dd($first_deploy);

    /* ----------------------- LOGS ----------------------*/
    if($first_deploy=='true'){
        echo "First deploy";
    }else{
        private function log($info){
            //path name
            $filename="AuthServiceProvider";

            $log = new LogController;
            $log->store($filename, $info);
            return null;     
        }

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
        if($first_deploy=='true'){
        echo "First deploy";
        }else{
            $this->log("GateContract");
        }
        //------------------------------------------------------------------------------
        
        $this->registerPolicies($gate);

        //

        //Comente esse bloco no primeiro migrate

        /* --------------------- Carrega as permissões ------------------------ */
        if($first_deploy=='true'){
            echo "First deploy";
        }else{
    
            $permissions = Permission::with('roles')->get();

            foreach ($permissions as $permission) {
                 
                $gate->define(

                    $permission->name, function(User $user) use ($permission){                 

                        return $user->hasPermission($permission);

                    }

                );
            

            
                Gate::before(function ($user) {
                    if ($user->hasRole('adm')) {
                        return true;
                    }
                });        
            

            }
        }
        /* ------------- Carega setores para MENUS ---------------------*/
        if($first_deploy=='true'){
            echo "First deploy";
        }else{
            // Criar uma sessão
            
            $setors = Setor::select('name', 'label')->get();
            session(['setors' => $setors]);
        } 
        /* ------------- Carega setores para MENUS ---------------------*/



    }
}
