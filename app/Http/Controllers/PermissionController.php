<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Permission;
use App\Role;
use Gate;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class PermissionController extends Controller
{ 
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="PermissionController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    //
    private $permission;

    public function __construct(Permission $permission){
        $this->permission = $permission;
    }

 
    public function index(){
        if(!(Gate::denies('read_permission'))){
        	$permissions = Permission::paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.index");
            //---------------------------------------------------------------------------------------

        	return view('permission.index', array('permissions' => $permissions, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    // Seleciona por id
    public function show($id){
        if(!(Gate::denies('read_permission'))){
            $permission = Permission::find($id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.show");
            //---------------------------------------------------------------------------------------

            return view('permission.show', array('permission' => $permission));
        }
        else{
            return view('errors.403');
        }

    }

    public function busca (Request $request){
        if(!(Gate::denies('read_permission'))){
            $buscaInput = $request->input('busca');
            $permissions = Permission::where('name', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('label', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.busca=".$buscaInput);
            //---------------------------------------------------------------------------------------

            return view('permission.index', array('permissions' => $permissions, 'buscar' => $buscaInput ));

        }
        else{
            return view('errors.403');
        }
    }

    // Criar
    public function create(){
        if(!(Gate::denies('read_permission'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.create");
            //---------------------------------------------------------------------------------------
        
            return view('permission.create');
        }
        else{
            return view('errors.403');
        }      

    }

    // Criar usuário
    public function store(Request $request){
        if(!(Gate::denies('read_permission'))){
            //Validação
            $this->validate($request,[
                    'name' => 'required|min:3|unique:permissions',
                    'label' => 'required|min:3|unique:permissions',                
            ]);

            
                    
            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->label = $request->input('label');

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.store");
            //---------------------------------------------------------------------------------------

            if($permission->save()){
                return redirect('permissions/')->with('success', 'Permission (Regra) cadastrada com sucesso!');
            }else{
                return redirect('permissions/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

    public function edit($id){  
        if(!(Gate::denies('read_permission'))){
            
            $permission = Permission::find($id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.edit.id=".$id);
            //---------------------------------------------------------------------------------------

            return view('permission.edit', compact('permission','id'));
        }
        else{
            return view('errors.403');
        }        

    }

    public function update(Request $request, $id){
        if(!(Gate::denies('read_permission'))){
            $permission = Permission::find($id);

            //Validação
            $this->validate($request,[
                    'name' => 'required|min:3|unique:permissions',
                    'label' => 'required|min:3|unique:permissions',       
            ]);
                    
            $permission->name = $request->get('name');
            $permission->label = $request->get('label');   

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.update.id=".$id);
            //---------------------------------------------------------------------------------------    

            if($permission->save()){
                return redirect('permissions/')->with('success', 'Permission (Regra) atualizada com sucesso!');
            }else{
                return redirect('permissions/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }

    }

    public function destroy($id){
        if(!(Gate::denies('read_permission'))){
            $permission = Permission::find($id);        
            
            $permission->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.destroy.id=".$id);
            //---------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Permission (Regra) excluída com sucesso!');

        }
        else{
            return view('errors.403');
        }
    }

    public function roles($id){
        if(!(Gate::denies('read_permission'))){
            //Recupera Permission
            $permission = Permission::find($id);

            //recuperar roles
            $roles = $permission->roles()->get();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.roles.id=".$id);
            //---------------------------------------------------------------------------------------

            return view('permission.role', compact('permission', 'roles'));

        }
        else{
            return view('errors.403');
        }


    }



    // Criar
    public function createAuto(){

        if(!(Gate::denies('read_permission'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.auto.create");
            //---------------------------------------------------------------------------------------
        
            return view('permission.create_auto');
        }
        else{
            return view('errors.403');
        }      

    }

    // Criar usuário
    public function storeAuto(Request $request){

        if(!(Gate::denies('read_permission'))){
            //Validação
            $this->validate($request,[
                    'name' => 'required|min:3|unique:permissions',
                    'label' => 'required|min:3|unique:permissions',                
            ]);

            //variavel de controle dos 04 stores
            $controle = 0;

            
            //create  -----------------------------------------------------                  
            $permission = new Permission();
            $permission->name = "create_".$request->input('name');
            $permission->label = "Create - ".$request->input('label');
            if($permission->save()){
                $controle = $controle+1;
            }

            //read  -----------------------------------------------------                  
            $permission = new Permission();
            $permission->name = "read_".$request->input('name');
            $permission->label = "Read - ".$request->input('label');
            if($permission->save()){
                $controle = $controle+1;
            }

            //update  -----------------------------------------------------                  
            $permission = new Permission();
            $permission->name = "update_".$request->input('name');
            $permission->label = "Update - ".$request->input('label');
            if($permission->save()){
                $controle = $controle+1;
            }

            //delete  -----------------------------------------------------                  
            $permission = new Permission();
            $permission->name = "delete_".$request->input('name');
            $permission->label = "Delete - ".$request->input('label');
            if($permission->save()){
                $controle = $controle+1;
            }

            //Create Role-----------------------------------------------------                  
            $role = new Role();
            $role->name = $request->input('name');
            $role->label = $request->input('label');
            if($role->save()){
                $controle = $controle+1;
            }

            //Vincula automaticamente --------------------------------------------------------------
            $role  = Role::where('name', $request->input('name'))->first();
            //Create
            $status = Permission::where('name', "create_".$request->input('name'))->first()
                                ->permissionRole()->attach($role->id);
            //Read
            $status = Permission::where('name', "read_".$request->input('name'))->first()
                                ->permissionRole()->attach($role->id);
            //Update
            $status = Permission::where('name', "update_".$request->input('name'))->first()
                                ->permissionRole()->attach($role->id);
            //Delete
            $status = Permission::where('name', "delete_".$request->input('name'))->first()
                                ->permissionRole()->attach($role->id);
            // ------------------------------------------------------------------------------------

            //LOG ----------------------------------------------------------------------------------------
            $this->log("permission.auto.store=".$request->input('name'));
            //---------------------------------------------------------------------------------------

            if($controle>=5){
                return redirect('permissions/')->with('success', 'Permission (Regra) Automatizadas cadastrada com sucesso!');
            }else{
                return redirect('permissions/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

}
