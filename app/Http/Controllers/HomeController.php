<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Home;
use App\User;
use App\Cambio;
use Gate;
use App\Setor; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        

        if(Auth::check()){



        //Taxa de Cambio CNY/RMB
        // A API do frete está em CNY/RMB
        $cambio_cny = Cambio::orderBy('id', 'DESC')->where('moeda','CNY')->first();
        if((isset($cambio_cny))){
            $request->session()->put('cambio_cny', $cambio_cny->valor);
        }else{
            $request->session()->put('cambio_cny', 9999999);
        }  

        //Taxa de Cambio USD
        // A API do frete está em USD
        $cambio_usd = Cambio::orderBy('id', 'DESC')->where('moeda','USD')->first();
        if((isset($cambio_usd))){
            $request->session()->put('cambio_usd', $cambio_usd->valor);
        }else{
            $request->session()->put('cambio_usd', 9999999);
        }  

        //Taxa de Cambio USD
        // A API do frete está em USD
        $cambio_eur = Cambio::orderBy('id', 'DESC')->where('moeda','EUR')->first();
        if((isset($cambio_eur))){
            $request->session()->put('cambio_eur', $cambio_eur->valor);
        }else{
            $request->session()->put('cambio_eur', 9999999);
        } 


        /* -------- Implementa ZERA Contagem de LOGIN --------*/
            // Menor que 10 permite o login
            $users = User::find(Auth::id());
            $users->login = 0;
            $users->save();
        /* --------- FIM ZERA Contagem -----------------------*/



            /* ------------- Verifica perfil técnico ----------------- */

            $setores = Setor::all();

            $flagClient=0;

            foreach ($setores as $setor) {
                
                if(!(Gate::denies('read_'.$setor->name))){
                    return redirect('atendimentos/'.$setor->name.'/dashboard');
                }

            }

            return redirect('clients/perfil');

            //return view('home.index'); 

        }else{
            return redirect('login')->with('danger', 'Erro: <b>400</b> Você não fez login no sistema');
        }
        
    }
}
