<?php

namespace App\Http\Controllers;

use App\Carteira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Cambio;
use Gate;
use DB;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class CarteiraController extends Controller
{
    /* ----------------------- LOGS ----------------------*/
    private function log($info){
        //path name
        $filename="CarteiraController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }
    /* ----------------------- END LOGS --------------------*/

    //
    private $carteira;

    public function __construct(Carteira $carteira){
        $this->carteira = $carteira;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user)
    {
        //
        if(!(Gate::denies('read_carteira'))){

            //$ticket = $this->ticket->find($id);
            //$setors = $ticket->setors()->get();

            $user = User::find($user);            

            $carteiras = $user->carteira()->paginate(40); 

            $saldo = $user->carteira()->orderBy('id', 'DESC')->first(); 

            if((isset($saldo))){
                $saldo = $saldo->saldo;
            }else{
                $saldo = 0;
            }

            //Taxa de Cambio
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

            //LOG ------------------------------------------------------
            $this->log("carteira.index.user=".$user->id);
            //----------------------------------------------------------

            return view('carteira.index', array(
                            'carteiras' => $carteiras, 
                            'user' => $user, 
                            'saldo' => $saldo,
                            'cambio_atual' => $cambio_atual,
                            'vets' => $vets,
                            'buscar' => null
                            ));
        }
        else{
            return view('errors.403');
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
     * @param  \App\Carteira  $carteira
     * @return \Illuminate\Http\Response
     */
    public function show(Carteira $carteira)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carteira  $carteira
     * @return \Illuminate\Http\Response
     */
    public function edit(Carteira $carteira)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carteira  $carteira
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carteira $carteira)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carteira  $carteira
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carteira $carteira)
    {
        //
    }
}
