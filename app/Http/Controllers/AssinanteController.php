<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Armazem;
use App\Cambio;

use Gate;

//REST API Woocommerce
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

class AssinanteController extends Controller
{
    
    private function log($info){
        //path name
        $filename="AssinanteController";

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

        if(!(Gate::denies('read_assinante'))){
            $armazems = Armazem::where('status','1')->paginate(40);  

            //LOG --------------------------------------------------------
            $this->log("assinante.index");
            //------------------------------------------------------------           

            return view('assinante.index', array('armazems' => $armazems));
        }
        else{
            return view('errors.403');
        }
    }

    public function produtos(Armazem $armazem, $page)
    {
        //
        if(!(Gate::denies('read_assinante'))){ 

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
            $this->log("assinante.produtos");
            //------------------------------------------------------------           

            return view('assinante.produtos', array(
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

    public function produtosBusca(Armazem $armazem, $page, Request $request)
    {
        //
        if(!(Gate::denies('read_assinante'))){ 

            $busca = $request->input('busca');

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

            $data = [
                'search' => $busca,
                'per_page'=>50,
                'page'=>$page
            ];

            $produtos = $woocommerce->get('products', $data); 


            //Paginacao
            if(!isset($page)){$page = 1;}  
            $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();
            $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 

            //LOG --------------------------------------------------------
            $this->log("assinante.produtos");
            //------------------------------------------------------------  

                   

            return view('assinante.produtos', array(
                            'busca'         => $busca,
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
    
    /*
    public function freteEstimado(Armazem $armazem, $produto)
    {
        //
        if(!(Gate::denies('read_assinante'))){ 

            // ------ Inicia Conexão WC ----- 
            $woocommerce = new Client(
                $armazem->store_url, 
                $armazem->consumer_key, 
                $armazem->consumer_secret,
                [
                    'wp_api'  => true,
                    'version' => 'wc/v3',
                ]
            );
            // ------ Fim Conexão WC ----- 

            $produto = $woocommerce->get('products/'.$produto);  
            

            //LOG --------------------------------------------------------
            $this->log("assinante.produtos");
            //------------------------------------------------------------  

            $peso = ($produto->weight)*1000;

            $pesos = $peso;

            $unidades = 0;

            // Peso máximo e-packet
            // 4kg
            // Máximo 5 unidades
            while(($pesos<4000)and($unidades<5)){

            
                $url = file_get_contents('https://www.chinapostaltracking.com/service/rate/?weight='.$pesos.'&country=BR#result');

                if ( preg_match ( '/<table class="table result-list">(.*?)<\/table>/s', $url, $matches ) )
                    {
                        foreach ( $matches as $key => $match )
                        {
                            $frete[$key] = $match;
                        }
                    }

                $frete = explode("<strong>", $frete[0]);
                $frete = array_reverse($frete);
                $frete = explode("</strong>", $frete[0]);
                $fretes[] = $frete[0];

                //Contador Peso
                $pesos = $pesos + $peso;

                //Contador de Unidades
                $$unidades = $unidades++;

            }

            //Taxa de Cambio CNY/RMB
            // A API do frete está em CNY/RMB
            $cambio_cny = Cambio::orderBy('id', 'DESC')->where('moeda','CNY')->first();
            if((isset($cambio_cny))){
                $cambio_cny = $cambio_cny->valor;
            }else{
                $cambio_cny = 9999999;
            }           

            return view('assinante.frete', array(
                            'fretes'     =>  $fretes,
                            'armazem'   =>  $armazem, 
                            'produto'   =>  $produto, 
                            'cambio_cny'          =>  $cambio_cny,                       
                            ));
        }
        else{
            return view('errors.403');
        }
    }

    */

    public function freteEstimado(Armazem $armazem, $produto)
    {
        //
        if(!(Gate::denies('read_assinante'))){ 

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

            $produto = $woocommerce->get('products/'.$produto);  
            

            //LOG --------------------------------------------------------
            $this->log("assinante.produtos");
            //------------------------------------------------------------  

            $peso = $produto->weight;

            //Taxa de Cambio CNY/RMB
            // A API do frete está em CNY/RMB
            $cambio_cny = Cambio::orderBy('id', 'DESC')->where('moeda','CNY')->first();
            if((isset($cambio_cny))){
                $cambio_cny = $cambio_cny->valor;
            }else{
                $cambio_cny = 9999999;
            }  

            //Taxa de Cambio USD
            // A API do frete está em USD
            $cambio_usd = Cambio::orderBy('id', 'DESC')->where('moeda','USD')->first();
            if((isset($cambio_usd))){
                $cambio_usd = $cambio_usd->valor;
            }else{
                $cambio_usd = 9999999;
            }          

            return view('assinante.frete', array(
                            'peso'        =>  $peso,
                            'armazem'       =>  $armazem, 
                            'produto'       =>  $produto, 
                            'cambio_cny'    =>  $cambio_cny,
                            'cambio_usd'    =>  $cambio_usd,                      
                            ));
        }
        else{
            return view('errors.403');
        }
    }

}
