<?php

namespace App\Http\Controllers;

use App\Cambio;
use Illuminate\Http\Request;
use Gate;
use DB;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class CambioController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="CambioController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $cambio;

    public function __construct(Cambio $cambio){
        $this->cambio = $cambio;        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_cambio'))){
            

            //Taxa de Cambio
            $cambios = Cambio::orderBy('id', 'DESC')->paginate(40);
            //Dólar
            $cambio_atual = Cambio::orderBy('id', 'DESC')->where('moeda','USD')->first();
            if((isset($cambio_atual))){
                $cambio_atual = $cambio_atual->valor;
            }else{
                $cambio_atual = 9999999;
            }

            //Valor Efetivo Total
            $vet_atual = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vet_atual))){
                $vet_atual = $vet_atual->valor;
            }else{
                $vet_atual = 9999999;
            }

            //LOG --------------------------------------------------------------------
            $this->log("cambio.index");
            //------------------------------------------------------------------------

            return view('cambio.index', array(
                'cambios' => $cambios,
                'cambio_atual' => $cambio_atual,
                'vets' => $vet_atual,
                'buscar' => null
            ));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function vet()
    {
        //

        if(!(Gate::denies('read_cambio'))){
            

            //Taxa de Cambio - Dolar
            $cambio_atual = Cambio::orderBy('id', 'DESC')->where('moeda','USD')->first();
            if((isset($cambio_atual))){
                $cambio_atual = $cambio_atual->valor;
            }else{
                $cambio_atual = 9999999;
            }

            //Valor Efetivo Total
            $vets = DB::table('vets')->orderBy('id', 'DESC')->paginate(40);
            $vet_atual = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vet_atual))){
                $vet_atual = $vet_atual->valor;
            }else{
                $vet_atual = 9999999;
            }

            //LOG --------------------------------------------------------------------
            $this->log("cambio.index");
            //------------------------------------------------------------------------

            return view('cambio.vet', array(
                'cambio_atual' => $cambio_atual,
                'vets' => $vets,
                'vet_atual' => $vet_atual,
                'buscar' => null
            ));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function vetCreate()
    {
        //

        if(!(Gate::denies('update_cambio'))){
            

            //Taxa de Cambio
            //Dolar
            $cambio_atual = Cambio::orderBy('id', 'DESC')->where('moeda','USD')->first();
            if((isset($cambio_atual))){
                $cambio_atual = $cambio_atual->valor;
            }else{
                $cambio_atual = 9999999;
            }

            //Valor Efetivo Total
            $vet_atual = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vet_atual))){
                $vet_atual = $vet_atual->valor;
            }else{
                $vet_atual = 9999999;
            }

            //LOG --------------------------------------------------------------------
            $this->log("cambio.vet.create");
            //------------------------------------------------------------------------

            return view('cambio.vet_create', array(
                'cambio_atual' => $cambio_atual,
                'vet_atual' => $vet_atual,
                'buscar' => null
            ));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function vetStore(Request $request)
    {
        //
        if(!(Gate::denies('update_cambio'))){            

            //Validação
            $this->validate($request,[
                    'vet' => 'required|numeric'
            ]);

            //LOG --------------------------------------------------------------------
            $this->log("cambio.vet.store");
            //------------------------------------------------------------------------

            $storeVets = DB::table('vets')->insert([
                'valor' => $request->input('vet'), 
                'descricao' => $request->input('descricao'),
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ]);

            if($storeVets){
                return redirect('cambio/vet')->with('success', 'VET cadastrado com sucesso!');
            }else{
                return redirect('cambio/vetCreate')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function show(Cambio $cambio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function edit(Cambio $cambio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cambio $cambio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cambio  $cambio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cambio $cambio)
    {
        //
    }
}
