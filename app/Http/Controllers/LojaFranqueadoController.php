<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

use Gate; 

class LojaFranqueadoController extends Controller
{
    //

    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FranquiaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    public function index()
    {
        //
        if(!(Gate::denies('read_franqueado'))){

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("loja_franqueado.index");
            //--------------------------------------------------------------------------------------

            return view('loja_franqueado.index');
        }
        else{
            return view('errors.403');
        }
    }
}
