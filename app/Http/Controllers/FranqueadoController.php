<?php

namespace App\Http\Controllers;

use App\Franquia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate; 
use DB;


//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class FranqueadoController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FranquiaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $franquia;

    public function __construct(Franquia $franquia){
        $this->franquia = $franquia;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_franquia'))){

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            //Afiliados
            $afiliados = Franquia::where('user_id_afiliado', Auth::id())->get();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.index");
            //--------------------------------------------------------------------------------------

            return view('franqueado.index', array('franquias' => $franquias, 'buscar' => null, 'afiliados' => $afiliados));
        }
        else{
            return redirect('erro')->with('franquia_error', '403');
        }
    }

    /* ------------------------------ DASHBOARD --------------------------*/
    public function dashboard($id)
    {
        
        //
        if(!(Gate::denies('read_franquia'))){

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            $franquia = $franquias->where('id', $id)->first();

            if($franquia){            

            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.dashboard=".$franquia);
            //--------------------------------------------------------------------------------------



            return view('franqueado.dashboard', compact('franquia'));

            }else{
            return redirect('erro')->with('permission_error', '403');
        }


            
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }





}
