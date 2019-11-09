<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Armazem;
use App\Cambio;
use App\Produto;
use App\Ticket;
use App\Setor;
use App\Carteira;
use App\Encomenda;

use Gate;
use DB;

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

    private function cambio($moeda)
    {

        //Moedas Disponíveis
        //USD
        //CNY/RMB
        //EUR
        //Taxa de Cambio
        $cambio = Cambio::orderBy('id', 'DESC')->where('moeda',$moeda)->first();
        if((isset($cambio))){
            $cambio = $cambio->valor;
        }else{
            //Insere valor absurdo caso não exista a moeda
            $cambio = 9999999;
        }

        return $cambio;
        
    }

    private function protocolo()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);


        return date("Y").$protocolo.date("m");
    }

    private function carteiraCodigo()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        return "TF".date("Y").$protocolo;
    }

    private function vet(){
        $vets = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vets))){
                $vets = $vets->valor;
            }else{
                $vets = 9999999;
            }
        return $vets;
    }

    private function getEncomendaProdutos($armazem, $produtos){
        //Verifica as encomendas
        if(($armazem->tipo)==1){
            $encomenda_quantidade[] = "";
            foreach($produtos as $produto){


                /* --- Pega Quantidade de Encomendas ----*/
                $produto_local = Produto::where('store_id',$produto->id)
                            ->where('armazem_id', $armazem->id)->first();

                if($produto_local){

                    $encomendas = Encomenda::select( DB::raw('sum(quantidade) as quantidade') )
                    ->where('produto_id', $produto_local->id)
                    ->first();

                    $encomenda_quantidade[$produto->id] = $encomendas->quantidade;
                }                   

            }
        
        }else{
            $encomenda_quantidade[] = "";
        }

        return $encomenda_quantidade;
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

            $armazem = Armazem::where('status','1')->get()->random();  

            //Taxa de Cambio CNY/RMB
            // A API do frete está em CNY/RMB
            $cambio_cny = $this->cambio('CNY');

            //Taxa de Cambio USD
            // A API do frete está em USD
            $cambio_usd = $this->cambio('USD');

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
                'per_page'=>4
            ];

            $produtos = $woocommerce->get('products', $data);

            $encomenda_quantidade = $this->getEncomendaProdutos($armazem, $produtos);

            //LOG --------------------------------------------------------
            $this->log("assinante.index");
            //------------------------------------------------------------           

            return view('assinante.index', array(
                                        'encomenda_quantidade' => $encomenda_quantidade,
                                        'armazem_preview'   =>  $armazem,
                                        'cambio_usd'  => $cambio_usd,
                                        'cambio_cny'  => $cambio_cny,
                                        'armazems'  => $armazems,
                                        'produtos' => $produtos
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

            //Taxa de Cambio CNY/RMB
            // A API do frete está em CNY/RMB
            $cambio_cny = $this->cambio('CNY');

            //Taxa de Cambio USD
            // A API do frete está em USD
            $cambio_usd = $this->cambio('USD');


            //Paginacao
            if(!isset($page)){$page = 1;}  
            $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();
            $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 

            $encomenda_quantidade = $this->getEncomendaProdutos($armazem, $produtos);
            

            //LOG --------------------------------------------------------
            $this->log("assinante.produtos");
            //------------------------------------------------------------  

                   

            return view('assinante.produtos', array(
                            'encomenda_quantidade'=>   $encomenda_quantidade,
                            'cambio_usd'    => $cambio_usd,
                            'cambio_cny'    => $cambio_cny,
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

    public function encomendaCreate(Armazem $armazem, $produto)
    {
        //
        if(!(Gate::denies('read_assinante'))){ 


            /* ------- Verifica Saldo da Carteira ----------- */
            $user = Auth::user();

            $saldo = $user->carteira()
                        ->select( DB::raw('sum( carteiras.valor ) as valor') )
                        ->where('carteiras.status','3')
                        ->first(); 

            if((isset($saldo))){
                $saldo = $saldo->valor;
            }else{
                $saldo = 0;
            }

            //Verifica se o Saldo está zerado
            if($saldo>0){

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
                $this->log("assinante.encomenda");
                //------------------------------------------------------------  

                $peso = $produto->weight;

                //Taxa de Cambio CNY/RMB
                // A API do frete está em CNY/RMB
                $cambio_cny = $this->cambio('CNY'); 

                //Taxa de Cambio USD
                // A API do frete está em USD
                $cambio_usd = $this->cambio('USD');         

                return view('assinante.encomenda_create', array(
                                'peso'        =>  $peso,
                                'armazem'       =>  $armazem, 
                                'produto'       =>  $produto, 
                                'cambio_cny'    =>  $cambio_cny,
                                'cambio_usd'    =>  $cambio_usd,                      
                                ));
            }else{
                return redirect('clients/carteira')->with('danger', 'Você não tem saldo suficiente para executar a operação. Faça uma recarga!');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function encomendaStore(Request $request, Armazem $armazem)
    {
        //
        if(!(Gate::denies('read_assinante'))){            

            //Validação
            $this->validate($request,[
                    'produto' => 'required|integer',
                    'quantidade' => 'required|integer',
                    'quantidade_envio' => 'required|integer',
                    
            ]);
            //Dados do Usuário
            $user = Auth::user();  

            //Taxa de Cambio CNY/RMB
            // A API do frete está em CNY/RMB
            $cambio_cny = $this->cambio('CNY');

            //Taxa de Cambio USD
            // A API do frete está em USD
            $cambio_usd = $this->cambio('USD');

            //Valor Efetivo Total
            $vets = $this->vet();

            $produto = $request->input('produto');

            /* ------------- Busca Produto ---------------- */
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


            $quantidade = $request->input('quantidade');
            $quantidade_envio = $request->input('quantidade_envio');

            //dd($quantidade_envio,">", ($quantidade/2));

            //50% do estoque fica na China (Estoque Coletivo)
            if(($quantidade_envio)>($quantidade/2)){
                return redirect('/assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')->with('danger', 'A quantidade enviada deve ser menor de 50% da quantidade solicitada.');
            }else{
                

                //Verifica Valor total com Frete
                //Valor Produto
                if(is_numeric($produto->sale_price)){
                    $valor_produto = number_format(($produto->sale_price)*($cambio_usd),2);
                }
                else{                    
                    $price = (double) $produto->price;
                    $valor_produto = number_format($price*$cambio_usd, 2);                   
                }

                $valor_total_produto = $valor_produto*$quantidade;

                $peso = $produto->weight;

                //Valor Frete
                $valor_frete = ((80*($peso*$quantidade_envio)+25)*$cambio_cny);

                //Verifica Saldo do Client
                /* ------- Verifica Saldo da Carteira ----------- */
                $saldo = $user->carteira()
                            ->select( DB::raw('sum( carteiras.valor ) as valor') )
                            ->where('carteiras.status','3')
                            ->first(); 

                if((isset($saldo))){
                    $saldo = $saldo->valor;
                }else{
                    $saldo = 0;
                }

                if($saldo>($valor_frete+$valor_total_produto)){

                    //Verifica se o produto já está cadastrado na base de dados local
                    $produto_local = Produto::where('store_id', $produto->id)
                                    ->where('armazem_id', $armazem->id)
                                    ->first();

                    

                    //Caso não exista, cria o produto
                    if(!$produto_local){
                        $produto_local = new Produto;
                        $produto_local->store_id = $produto->id; //ID no Woocommerce
                        $produto_local->produto = json_encode($produto);//Json
                        $produto_local->armazem_id = $armazem->id;
                        if($produto_local->save()){
                           $produto_local = Produto::where('store_id', $produto->id)
                                            ->where('armazem_id', $armazem->id)
                                            ->first();
                        }
                    }

                    /* -------------- Abre Ticket Referente à Encomenda ----------*/
                    $ticket = new Ticket();

                    // 1 - Aberto/Ativo
                    // 0 - Fechado/Encerrado
                    $ticket->status = 1;

                    // Rotulos de Criticidade
                    //    0   =>  "Crítico - Emergência (resolver imediatamente)",
                    //    1   =>  "Alto - Urgência (resolver o mais rápido possível)",
                    //    2   =>  "Médio - Intermediária (avaliar situação)",
                    //    3   =>  "Baixo - Rotineiro ou Planejado",
                    //    4   =>  "Nenhum",
                    $ticket->rotulo = "3";                

                    $ticket->titulo = "Encomenda de Produto: ".str_limit($produto->name, 50, '...');

                    $ticket->descricao = "
                            <h1>Encomenda de Produto</h1>
                            <p><b>Gerado por:</b> ".auth()->user()->name."</p>
                            <p><b>Produto:</b> ".$produto->name."</p>
                            <p><b>Valor Total:</b> R$".($valor_frete+$valor_total_produto)."</p>
                            <p><b>Valor Unitário do Produto:</b> R$".$valor_produto."</p>
                            <p><b>Valor Total do Frete:</b> R$".$valor_frete."</p>
                            <p><b>Quantidade Total:</b> ".$quantidade."un</p>
                            <p><b>Quantidade a ser enviado para o comprador:</b>".$quantidade_envio."un</p>
                            <p><b>Valor Total:</b> R$".($valor_frete+$valor_produto)."</p>
                            <p><b>Dólar:</b> R$".$cambio_usd."</p>
                            <p><b>VET (Valor Efetivo Total):</b> R$".($cambio_usd*$vets)."</p>
                            <br><br>
                            <p>link do produto:</p>
                            <a target='_blank' href='".$armazem->store_url."/".$produto->slug."'>".$produto->name."</a>
                            
                            <br>
                            <p>Solicitação foi gerada com sucesso.</p>
                            
                    ";                

                    //usuário
                    $ticket->user_id = auth()->user()->id;

                    $protocolo = $this->protocolo();

                    //protocolo humano
                    $ticket->protocolo = $protocolo;


                    if($ticket->save()){

                        $ticket = Ticket::where('protocolo', $protocolo)->first();

                        //Vincula Ticket com Setor Atendimento
                        $setor = Setor::where('name', 'atendimento')->first();
                        Ticket::find($ticket->id)->setors()->attach($setor);  

                        /* ----------- Gera movimentação na Carteira ----*/

                        $carteira = new Carteira();
                        $carteira->codigo = $this->carteiraCodigo();
                        $carteira->valor = -(($valor_frete+$valor_total_produto)*$vets);
                        $carteira->dolar = $cambio_usd;
                        $carteira->vet = $vets;
                        $carteira->status = 3;
                        $carteira->user_id = $user->id;
                        $carteira->descricao = "Encomenda de Produto:".$produto->name;

                        /* ----------- FIM Gera movimentação na Carteira ----*/

                        if($carteira->save()){
                            //Vincula Ticket com Carteira
                            $carteira = Carteira::where('codigo', $carteira->codigo)->first();
                            Ticket::find($ticket->id)->carteira()->attach($carteira);

                            //Cria novo pedido de encomenda
                            $encomenda = new Encomenda();
                            $encomenda->quantidade = $quantidade;
                            $encomenda->quantidade_envio = $quantidade_envio;
                            $encomenda->valor = ($valor_frete+$valor_produto)*$vets;
                            $encomenda->frete = $valor_frete;
                            $encomenda->tipo_quantidade = "Un";
                            $encomenda->user_id = $user->id;
                            //Produto Cadastrado Localmente (Extraido do Wordpress)
                            $encomenda->produto_id = $produto_local->id;
                            //Ticket de Acompanhamento
                            $encomenda->ticket_id = $ticket->id;

                            if($encomenda->save()){
                                return redirect('assinante')->with('success', 'Encomenda efetuada com sucesso.');
                            }
                            else{
                                return redirect('assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')->with('danger', 'Houve Algo errado ao solicitar a encomenda, tente novamente mais tarde!');
                            }  
                            

                        }
                        else{
                            return redirect('assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')->with('danger', 'Houve Algo errado ao inserir na carteira, tente novamente mais tarde!');
                        }                         

                    }else{
                        return redirect('assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')->with('danger', 'Houve Algo errado ao gerar o Ticket, tente novamente mais tarde!');
                    }                                               


                    /* -------------- FIM Abre Ticket Referente à Encomenda ----------*/




                    

                }else{
                    return redirect('clients/carteira')->with('danger', 'Você não tem saldo suficiente para executar a operação. Faça uma recarga!');
                }


            } 

        }else{
            return view('errors.403');
        }
    }

    public function vendaCreate(Armazem $armazem, $produto)
    {
        //
        if(!(Gate::denies('read_assinante'))){ 


            /* ------- Verifica Saldo da Carteira ----------- */
            $user = Auth::user();

            $saldo = $user->carteira()
                        ->select( DB::raw('sum( carteiras.valor ) as valor') )
                        ->where('carteiras.status','3')
                        ->first(); 

            if((isset($saldo))){
                $saldo = $saldo->valor;
            }else{
                $saldo = 0;
            }

            //Verifica se o Saldo está zerado
            if($saldo>0){

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
                $produto_variacoes = $woocommerce->get('products/'.$produto->id.'/variations');

                //dd($produto_variacoes);
                

                //LOG --------------------------------------------------------
                $this->log("assinante.encomenda");
                //------------------------------------------------------------  

                $peso = $produto->weight;

                //Taxa de Cambio CNY/RMB
                // A API do frete está em CNY/RMB
                $cambio_cny = $this->cambio('CNY'); 

                //Taxa de Cambio USD
                // A API do frete está em USD
                $cambio_usd = $this->cambio('USD');         

                return view('assinante.venda_create', array(
                                'peso'        =>  $peso,
                                'armazem'       =>  $armazem, 
                                'produto'       =>  $produto, 
                                'produto_variacoes' => $produto_variacoes,
                                'cambio_cny'    =>  $cambio_cny,
                                'cambio_usd'    =>  $cambio_usd,                      
                                ));
            }else{
                return redirect('clients/carteira')->with('danger', 'Você não tem saldo suficiente para executar a operação. Faça uma recarga!');
            }
        }
        else{
            return view('errors.403');
        }
    }

}
