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
            $cambio_atual = Cambio::orderBy('id', 'DESC')->first();
            if((isset($cambio_atual))){
                $cambio_atual = $cambio_atual->valor;
            }else{
                $cambio_atual = 9999999;
            }

            //Valor Efetivo Total
            $vets = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vets))){
                $vets = $vets->valor;
            }else{
                $vets = 9999999;
            }


            //LOG --------------------------------------------------------------------
            $this->log("cambio.index");
            //------------------------------------------------------------------------

            return view('cambio.index', array(
                'cambios' => $cambios,
                'cambio_atual' => $cambio_atual,
                'vets' => $vets,
                'buscar' => null
            ));
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
