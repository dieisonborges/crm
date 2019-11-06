<?php

namespace App\Http\Controllers;

use App\Armazem;
use Illuminate\Http\Request;
use Gate; 
use DB;

//REST API Woocommerce
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

class ArmazemController extends Controller
{
    
    private function log($info){
        //path name
        $filename="FranquiaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    private $armazem;

    public function __construct(Armazem $armazem){
        $this->armazem = $armazem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(!(Gate::denies('read_armazem'))){
            $armazems = Armazem::paginate(40);  

            //LOG --------------------------------------------------------
            $this->log("armazem.index");
            //------------------------------------------------------------           

            return view('armazem.index', array('armazems' => $armazems, 'buscar' => null));
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
        if(!(Gate::denies('create_armazem'))){ 

            //LOG --------------------------------------------------------
            $this->log("armazem.create");
            //------------------------------------------------------------           

            return view('armazem.create');
        }
        else{
            return view('errors.403');
        }
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
        if(!(Gate::denies('create_armazem'))){ 

            //LOG --------------------------------------------------------
            $this->log("armazem.create.store");
            //------------------------------------------------------------   

            //Validação
            $this->validate($request,[
                    'nome' => 'required',
                    'tipo' => 'required',
                    'store_url' => 'required',
                    'consumer_key' => 'required',
                    'consumer_secret' => 'required',
            ]);
           
                    
            $armazem = new Armazem();
            $armazem->nome = $request->input('nome');
            $armazem->tipo = $request->input('tipo');
            $armazem->localizacao = $request->input('localizacao');
            $armazem->store_url = $request->input('store_url');
            $armazem->consumer_key = $request->input('consumer_key');
            $armazem->consumer_secret = $request->input('consumer_secret');     

            if($armazem->save()){
                return redirect('armazems/')->with('success', 'Armazém cadastrado com sucesso!');
            }else{
                return redirect('armazems/create')->with('danger', 'Houve um problema, tente novamente.');
            }   
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function show(Armazem $armazem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function edit(Armazem $armazem)
    {
        //
        if(!(Gate::denies('update_armazem'))){ 

            //LOG --------------------------------------------------------
            $this->log("armazem.edit");
            //------------------------------------------------------------           

            return view('armazem.edit', compact('armazem'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Armazem $armazem)
    {
        //
        if(!(Gate::denies('create_armazem'))){ 

            //LOG --------------------------------------------------------
            $this->log("armazem.update.store=".$armazem->id);
            //------------------------------------------------------------   

            //Validação
            $this->validate($request,[
                    'nome' => 'required',
                    'tipo' => 'required',
                    'store_url' => 'required',
                    'consumer_key' => 'required',
                    'consumer_secret' => 'required',
            ]);          
                                

            $armazem->nome = $request->input('nome');
            $armazem->tipo = $request->input('tipo');
            $armazem->localizacao = $request->input('localizacao');
            $armazem->store_url = $request->input('store_url');
            $armazem->consumer_key = $request->input('consumer_key');
            $armazem->consumer_secret = $request->input('consumer_secret');     

            if($armazem->save()){
                return redirect('armazems/')->with('success', 'Armazém modificado com sucesso!');
            }else{
                return redirect('armazems/'.$armazem->id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }   
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Armazem $armazem)
    {
        //
        if(!(Gate::denies('delete_armazem'))){ 
            if($armazem->delete()){
                    return redirect('armazems/')->with('success', 'Armazém excluído com sucesso!');
                }else{
                    return redirect('armazems')->with('danger', 'Houve um problema, tente novamente.');
                } 
        }
        else{
            return view('errors.403');
        }
    }

    public function status(Armazem $armazem, $status)
    {
        //
        if(!(Gate::denies('update_armazem'))){ 

            //LOG --------------------------------------------------------
            $this->log("armazem.update.store=".$armazem->id);
            //------------------------------------------------------------ 

            $armazem->status = $status;

            if($armazem->save()){
                return redirect('armazems/')->with('success', 'Status do Armazém modificado com sucesso!');
            }else{
                return redirect('armazems/')->with('danger', 'Houve um problema, tente novamente.');
            }   
        }
        else{
            return view('errors.403');
        }
    }

    public function produtos(Armazem $armazem, $page)
    {
        //
        if(!(Gate::denies('read_armazem'))){ 

            /* ------ Inicia Conexão WC ----- */
            $woocommerce = new Client(
                $armazem->store_url, 
                $armazem->consumer_key, 
                $armazem->consumer_secret,
                [
                    'wp_api'  => true,
                    'version' => 'wc/v3',
                ]
            );
            /* ------ Fim Conexão WC ----- */

            $produtos = $woocommerce->get('products/', array('per_page'=>50, 'page'=>$page));  
            //Paginacao
            if(!isset($page)){$page = 1;}  
            $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();
            $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 

            //LOG --------------------------------------------------------
            $this->log("armazem.produtos");
            //------------------------------------------------------------           

            return view('armazem.produtos', array(
                            'armazem'       => $armazem,
                            'produtos'      => $produtos,
                            'page'          => $page,
                            'totalPages'    => $totalPages,
                            'linkPaginate'  => 'armazem/'.$armazem->id.'/produtos/',
                            ));
        }
        else{
            return view('errors.403');
        }
    }
}
