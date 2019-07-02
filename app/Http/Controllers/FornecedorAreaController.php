<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Orcamento;
use App\ItemOrcamento;
use App\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gate;
use DB;
use Mail; 


class FornecedorAreaController extends Controller
{
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FornecedorAreaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $fornecedor;

    public function __construct(Fornecedor $fornecedor){
        $this->fornecedor = $fornecedor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            //LOG ----------------------------------------------------
            $this->log("fornecedor.area.dashboard");
            //--------------------------------------------------------

            return view('fornecedor_area.dashboard', compact('fornecedor'));
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentos()
    {
        //
        if(!(Gate::denies('read_orcamento'))){
            //$orcamentos = Orcamento::paginate(40);  

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamentos = DB::table('orcamentos')
                    ->select(array(
                        'orcamentos.*',
                        'fornecedors.nome_fantasia',
                        'fornecedors.endereco_pais'
                     ))
                    ->join('fornecedors', 'orcamentos.fornecedor_id', '=', 'fornecedors.id')
                    ->where('fornecedors.id', $fornecedor->id)                    
                    ->orderBy('orcamentos.id', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.index");
            //--------------------------------------------------------------------------------------------

            return view('orcamento.index', array('orcamentos' => $orcamentos, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    
}

