<?php

namespace App\Http\Controllers;

use App\Franquia;
use App\User;
use App\Convite;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Config;
use Gate; 
use DB;
use Mail;

use App\Upload; 


//REST API Woocommerce
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

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

    private function selectEstadosBrasil(){
        return '
                <option value="AC">Acre - AC</option>
                <option value="AL">Alagoas - AL</option>
                <option value="AP">Amapá - AP</option>
                <option value="AM">Amazonas - AM</option>
                <option value="BA">Bahia - BA</option>
                <option value="CE">Ceará - CE</option>
                <option value="DF">Distrito Federal - DF</option>
                <option value="ES">Espírito Santo - ES</option>
                <option value="GO">Goiás - GO</option>
                <option value="MA">Maranhão - MA</option>
                <option value="MT">Mato Grosso - MT</option>
                <option value="MS">Mato Grosso do Sul - MS</option>
                <option value="MG">Minas Gerais - MG</option>
                <option value="PA">Pará - PA</option>
                <option value="PB">Paraíba - PB</option>
                <option value="PR">Paraná - PR</option>
                <option value="PE">Pernambuco - PE</option>
                <option value="PI">Piauí - PI</option>
                <option value="RJ">Rio de Janeiro - RJ</option>
                <option value="RN">Rio Grande do Norte - RN</option>
                <option value="RS">Rio Grande do Sul - RS</option>
                <option value="RO">Rondônia - RO</option>
                <option value="RR">Roraima - RR</option>
                <option value="SC">Santa Catarina - SC</option>
                <option value="SP">São Paulo - SP</option>
                <option value="SE">Sergipe - SE</option>
                <option value="TO">Tocantins - TO</option>';
    }

    private function codFranquiaGen()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        return "FA".date("y").$protocolo;
    }

    private $franquia;

    public function __construct(Franquia $franquia){
        $this->franquia = $franquia;
    }

    private function conviteCodeGenerator()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        return "CF".date("Ymd").$protocolo;
    }

    private function appHashEncode(){
        // APP_HASH_ENCODE
        // .env
        return config('app.app_hash_encode');
    }

    private function decrypt($text) 
    { 
        return trim(@mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->appHashEncode(), base64_decode($text), MCRYPT_MODE_ECB, @mcrypt_create_iv(@mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
    } 


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_franqueado'))){

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
            return view('errors.403');
        }
    }

    /* ------------------------------ DASHBOARD --------------------------*/
    public function dashboard($id)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia
            if($franquia){    

                /* ------------------ Verifica Conexão Woocommerce --------------------*/

                $woo_status = false;

                if(($franquia->store_url)and($franquia->consumer_key)and($franquia->consumer_secret)){
                    $woo_status = true;
                        
                }else{
                    $woo_status = false;
                }
                /* ------------------ Verifica Conexão Woocommerce --------------------*/  

                //LOG -----------------------------------------------------------------
                $this->log("franqueado.dashboard=".$franquia);
                //---------------------------------------------------------------------

                //Logomarca
                $imagem = $franquia->uploads()->orderBy('id', 'DESC')->first();
                
                
                return view('franqueado.dashboard', compact('franquia', 'woo_status', 'imagem'));

            }else{
                return view('errors.403');
        }


            
        }
        else{
            return view('errors.403');
        }
    }

   

    public function configuracoes($id)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){ 

            //LOG ----------------------------------------------------------------------
            $this->log("franqueado.categoriasFranqueado=".$franquia);
            //--------------------------------------------------------------------------

            //Logomarca
            $imagem = $franquia->uploads()->orderBy('id', 'DESC')->first();


            return view('franqueado.configuracoes', compact('franquia', 'imagem'));

            }else{
                return view('errors.403');
            }
            //--------------------------------------------------------------------------


            
        }
        else{
            return view('errors.403');
        }
    }

    public function configuracoesEdit($id)
    {
        //
        if(!(Gate::denies('update_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  

                //Listagem de possíveis Líder de franquia
                $users = User::all();

                //Logomarca
                $imagem = $franquia->uploads()->orderBy('id', 'DESC')->first();
                
                //LOG ----------------------------------------------------------------------------------------
                $this->log("franquia.edit.id=".$franquia);
                //--------------------------------------------------------------------------------------

                $select_estados_brasil = $this->selectEstadosBrasil();


                return view('franqueado.configuracoes_edit', compact('franquia', 'users', 'select_estados_brasil', 'imagem'));
            }else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }


    public function configuracoesUpdate(Request $request, $id)
    {
        
        //
        if(!(Gate::denies('update_franqueado'))){
            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  
                    //Validação
                    $this->validate($request,[
                            'nome' => 'required|min:3',
                            'slogan' => 'required|min:3',      
                            'descricao' => 'required|min:10',                    
                            'email' => 'email'
                    ]);            
                            
                    $franquia->nome = $request->input('nome');
                    $franquia->slogan = $request->input('slogan');
                    $franquia->descricao = $request->input('descricao');
                    $franquia->url_site = $request->input('url_site');
                    $franquia->url_blog = $request->input('url_blog');   

                    //Margem de Lucro Automática
                    //$franquia->lucro = $request->input('lucro');                  

                    //Dados Comerciais
                    $franquia->cnpj = $request->input('cnpj');
                    $franquia->telefone = $request->input('telefone');
                    $franquia->email = $request->input('email');
                    $franquia->endereco = $request->input('endereco');
                    $franquia->endereco_numero = $request->input('endereco_numero');
                    $franquia->endereco_bairro = $request->input('endereco_bairro');
                    $franquia->endereco_cep = $request->input('endereco_cep');
                    $franquia->endereco_cidade = $request->input('endereco_cidade');
                    $franquia->endereco_estado = $request->input('endereco_estado');


                    //Margem de lucro negativa                    

                    //LOG --------------------------------------------------------------------------------
                    $this->log("franqueado.update=".$franquia);
                    //------------------------------------------------------------------------------------    

                    if($franquia->save()){
                        return redirect('franqueados/'.$id.'/configuracoes')->with('success', 'Franquia atualizada com sucesso!');
                    }else{
                        return redirect('franqueados/'.$id.'/configuracoesEdit')->with('danger', 'Houve um problema, tente novamente.');
                    }                   
                    
                    
            }else{
                return view('errors.403');
            }

        }
        else{
            return view('errors.403');
        }
    }

    


/*=====================================================================================*/
/* --------------------------- Convite GERADO pelo Franquado VIP --------------------- */
/*=====================================================================================*/


    public function convite(){
        //Gera convite via Franqueado

        if(!(Gate::denies('read_franqueado'))){

            $user = auth()->user();

            $convites = Convite::where('user_id', $user->id)->paginate(40);

            $qtd_convites_usuario = $user->qtd_convites;

            //$qtd_convites_usados = Convite::where('status', 0)->where('user_id', $user->id)->count();

            $qtd_convites_usados = Convite::where('user_id', $user->id)->count();

            //LOG -------------------------------------------------------------------------------------
            $this->log("convite.index");
            //-----------------------------------------------------------------------------------

            return view('franqueado.convite', array(
                                            'convites' => $convites, 
                                            'qtd_convites_usuario' => $qtd_convites_usuario,
                                            'qtd_convites_usados' => $qtd_convites_usados,
                                            'buscar' => null
                                        ));
        }
        else{
            return view('errors.403');
        }
    }

    // Seleciona por id
    public function conviteShow($id){
        //Gera convite via Franqueado

        if(!(Gate::denies('read_franqueado'))){
            $convite = Convite::find($id);

            //LOG ---------------------------------------------------------------------------
            $this->log("convite.show.id=".$id);
            //-------------------------------------------------------------------------------
           

            return view('franqueado.convite_show', array('convite' => $convite));
        }
        else{
            return view('errors.403');
        }

    }

    public function conviteBusca (Request $request){
        //Gera convite via Franqueado

        if(!(Gate::denies('read_franqueado'))){
            $buscaInput = $request->input('busca');

            $user = auth()->user();

            $convites = Convite::where(function ($query) use ($buscaInput) {
                $query->where('codigo', 'LIKE', '%'.$buscaInput.'%')
                      ->orwhere('email', 'LIKE', '%'.$buscaInput.'%');
            })
            ->where('user_id', $user->id)
            ->paginate(40);



            $qtd_convites_usuario = $user->qtd_convites;

            //$qtd_convites_usados = Convite::where('status', 0)->where('user_id', $user->id)->count();

            $qtd_convites_usados = Convite::where('user_id', $user->id)->count();

            //LOG ---------------------------------------------------------------------------------
            $this->log("convite.ibusca=".$buscaInput);
            //-------------------------------------------------------------------------------------

            return view('franqueado.convite', array(
                                            'convites' => $convites, 
                                            'qtd_convites_usuario' => $qtd_convites_usuario,
                                            'qtd_convites_usados' => $qtd_convites_usados,
                                            'buscar' => null
                                        ));
        }
        else{
            return view('errors.403');
        }
    }


    public function conviteCreate(){

        //Gera convite via Franqueado
        if(!(Gate::denies('create_franqueado'))){

            $user = auth()->user();


            //Verifica se tem convites
            $convites = Convite::where('user_id', $user->id)->paginate(40);

            $qtd_convites_usuario = $user->qtd_convites;

            //$qtd_convites_usados = Convite::where('status', 0)->where('user_id', $user->id)->count();

            $qtd_convites_usados = Convite::where('user_id', $user->id)->count();


            //Verifica se é VIP

            //Verifica se o usuário é VIP e tem convites
            if(($user->franqueadoVip()->count())and($qtd_convites_usuario-$qtd_convites_usados )>0){
                //LOG ------------------------------------------------------------
                $this->log("convite.franqueado.create");
                //----------------------------------------------------------------

                return view('franqueado.convite_create');  

            }else{
                return view('errors.403');
            }

                            
        }
        else{
            return view('errors.403');
        }
    }

    // Criar
    public function conviteStore(Request $request){
        //Gera convite via Franqueado
        if(!(Gate::denies('create_franqueado'))){


            $user = auth()->user();

            //Verifica se tem convites
            $convites = Convite::where('user_id', $user->id)->paginate(40);

            $qtd_convites_usuario = $user->qtd_convites;

            //$qtd_convites_usados = Convite::where('status', 0)->where('user_id', $user->id)->count();

            $qtd_convites_usados = Convite::where('user_id', $user->id)->count();




            //Verifica se é VIP

            //Verifica se o usuário é VIP e tem convites
            if(($user->franqueadoVip()->count())and($qtd_convites_usuario-$qtd_convites_usados )>0){

                //Validação
                $this->validate($request,[
                        'email' => 'required|min:3',               
                ]);

                //Verifica se o email já foi convidado
                if((Convite::where('email', $request->input('email'))->count())>0){
                    return redirect('franqueados/convite/create')->with('danger', 'O usuário já foi convidado por um franqueado');
                }else{

                                    
                    $convite = new Convite();
                    $convite->email = $request->input('email');
                    $convite->codigo = $this->conviteCodeGenerator();
                    $convite->user_id = auth()->user()->id;


                    $mail_to = $request->input('email');

                    $msg="                
                        Para iniciar o acesso à plataforma de relacionamento clique no link abaixo, e confirme os dados: <br><br>
                        Código: <b>".$convite->codigo."</b> <br>
                        E-mail: <b>".$mail_to."</b> <br><br>
                        Gerado em: <b>".date("d/m/Y às H:m")."</b><br><br>               
                        link: ".url('/register')." 
                        <br><br>
                        Convite enviado por:".$user->name." | ".$user->email."
                        <br><br><br>
                        <span style='color:red;'>*O convite expira em 48 horas</span>
                        <br><br><br>           
                    ";

                    //LOG --------------------------------------------------------
                    $this->log("convite.franqueado.store");
                    //------------------------------------------------------------

                    if($convite->save()){

                        $mailData = array(
                            'nome' => "CRM e-Cardume | Relacionamento",
                            'email' => "atendimento@ecardume.com.br",
                            'assunto' => "Parabéns! Você recebeu um convite e-Cardume",
                            'msg' => $msg,
                        );

                        
                        //Destinatario
                        $mailFrom = array(
                                    'email'     => $mail_to,
                                    'name'      => 'Convidado',
                                    'subject'   => 'CRM e-Cardume | Relacionamento'
                                  );


                        Mail::send('email.contato', $mailData, function ($m) use ($mailFrom) {
                            $m->from('atendimento@ecardume.com.br','CRM e-Cardume | Relacionamento');
                            $m->to($mailFrom['email'], $mailFrom['name'])->subject($mailFrom['subject']);
                        });

                        return redirect('franqueados/convites')->with('success', 'Convite (Regra) cadastrada com sucesso!');
                    }else{
                        return view('errors.403');
                    }
                }
            }else{
                return redirect('franqueados/convite/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

/*=====================================================================================*/
/* --------------------------- END Convite GERADO pelo Franquado VIP ----------------- */
/*=====================================================================================*/

/*=====================================================================================*/
/* --------------------------- Franqueado gera a loja do afiliado -------------------- */
/*=====================================================================================*/

public function franquiaCreate($convite_id)
    {
        //
        if(!(Gate::denies('read_franqueado'))){

            $user = auth()->user();

            //Verifica se tem convites
            $convite = Convite::where('user_id', $user->id)->where('id', $convite_id)->first();

            if(($convite)and(!($convite->franquia_id))){ 

                //LOG ----------------------------------------------------------------------------------------
                $this->log("franqueado.franquia.create");
                //--------------------------------------------------------------------------------------
            
                $select_estados_brasil = $this->selectEstadosBrasil();

                return view('franqueado.franquia_create', compact('convite', 'select_estados_brasil'));

            }else{
                return view('errors.403');
            }
            
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
    public function franquiaStore(Request $request)
    {
    //
        if(!(Gate::denies('read_franqueado'))){
            //Validação
            $this->validate($request,[
                    'nome' => 'required|min:3',
                    'slogan' => 'required|min:3',      
                    'descricao' => 'required|min:10',
                    'loja_url'  =>  'required|min:3|unique:franquias',
                    'loja_url_alternativa'  =>  'required|min:3|unique:franquias',
                    //'cnpj' => 'cnpj',
                    'email' => 'email'

            ]);

            $convite_id = $request->input('convite_id');

            $user = auth()->user();

            //Verifica se tem convites
            $convite = Convite::where('user_id', $user->id)->where('id', $convite_id)->first();

            //Verifica se o convite já gerou uma franquia


            if(($convite)and(!($convite->franquia_id))){     
                    
                $franquia = new Franquia();
                $franquia->codigo_franquia = $this->codFranquiaGen();
                $franquia->nome = $request->input('nome');
                $franquia->slogan = $request->input('slogan');
                $franquia->descricao = $request->input('descricao');
                $franquia->url_site = $request->input('url_site');
                $franquia->url_blog = $request->input('url_blog');

                //Dados Comerciais
                $franquia->cnpj = $request->input('cnpj');
                $franquia->telefone = $request->input('telefone');
                $franquia->email = $request->input('email');
                $franquia->endereco = $request->input('endereco');
                $franquia->endereco_numero = $request->input('endereco_numero');
                $franquia->endereco_bairro = $request->input('endereco_bairro');
                $franquia->endereco_cep = $request->input('endereco_cep');
                $franquia->endereco_cidade = $request->input('endereco_cidade');
                $franquia->endereco_estado = $request->input('endereco_estado');



                $franquia->status = "1"; //Franquia Ativa

                //URL da Loja
                $franquia->loja_url = $request->input('loja_url');
                $franquia->loja_url_alternativa = $request->input('loja_url_alternativa');
                
                //Insere afiliado
                $franquia->user_id_afiliado = $user->id;

                //LOG ----------------------------------------------------------------------------------------
                $this->log("franqueado.franquia.store=".$request);
                //--------------------------------------------------------------------------------------

                if($franquia->save()){

                    /* ----------------- INSERE DONO --------------------------*/
                    //$franquia_last_id = DB::getPdo()->lastInsertId();

                    $franquia = Franquia::where('loja_url', $request->input('loja_url'))
                            ->where('loja_url_alternativa', $request->input('loja_url_alternativa'))
                            ->first();

                    $dono = User::where('email', $convite->email)->first();

                    /* -------------- Adiciona o usuário ao Grupo (Role) franqueado ------- */
                    $role = Role::where('name', 'franqueado')->first();

                    $status6 = $role->roleUser()->attach($dono->id);
                    /* -------------- END Adiciona o usuário ao Grupo (Role) franqueado ------- */

                    //Vincula ao dono do convite
                    $status3 = $dono->franquia()->attach($franquia->id);
                    
                    /* ----------------- END INSERE DONO --------------------------*/

                    /* ----------------- Insere ID da Franquia no COnvite ---------*/

                    $convite->franquia_id = $franquia->id;
                    $status4 = $convite->save();

                    /* ----------------- END Insere ID da Franquia no COnvite ---------*/

                    return redirect('franqueados')->with('success', 'Franquia cadastrada com sucesso!');
                }else{
                    return redirect('franqueados/franquiaCreate/'.$id)->with('danger', 'Houve um problema, tente novamente.');
                }
            }
            else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }

/*=====================================================================================*/
/* ----------------------- End Franqueado gera a loja do afiliado -------------------- */
/*=====================================================================================*/

    
    /* ------------------------------ Produtos da Franquia --------------------------*/
    

    public function produtos($id, $page)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if(!isset($page)){
                    $page = 1;
                }


             

                //$produtos = $woocommerce->get('products');        
                $produtos = $woocommerce->get('products', array('per_page'=>50, 'page'=>$page));  

                $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();

                $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 


                //LOG ------------------------------------------------------
                $this->log("franqueado.produtosFranqueado=".$franquia);
                //----------------------------------------------------------

                return view('franqueado.produto', 
                       array(
                            'franquia'      => $franquia, 
                            'produtos'      => $produtos,
                            'page'          => $page,
                            'totalPages'    => $totalPages,
                            'linkPaginate'  => 'franqueados/'.$franquia->id.'/produtos/',
                        ));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------


            
        }
        else{
            return view('errors.403');
        }
    }

    public function produtoEdit($id, $produto)
    {
        //
        if(!(Gate::denies('update_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  

                $produto_id = $produto;

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                //LOja Atual
                $produto = $woocommerce->get('products/'.$produto_id); 

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                /* ----------------- Loja de Referência ---------------------- */
                $woocommerce_ref = new Client(
                    config('app.wc_reference_store_url'), 
                    config('app.wc_reference_consumer_key'), 
                    config('app.wc_reference_secret'),
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );                

                //Loja de referencia
                $params_ref = [
                    'slug' => $produto->slug,
                ];
   
                $produto_refs = $woocommerce_ref->get('products', $params_ref); 

                //First row
                foreach ($produto_refs as $produto_ref);

                //LOG ------------------------------------------------------------------
                $this->log("franquia.edit.produto.id=".$franquia."Produto=".$produto->slug);
                //------------------------------------------------------------------------

                if(!isset($produto_ref)){

                    return redirect('franqueados/'.$franquia->id.'/produtos/1')->with('danger', 'Produto Bloqueado (Sem preço de referência)!');

                }else{

                    if($produto->type=='variable'){

                        $variations = $woocommerce->get('products/'.$produto->id.'/variations');

                        $variations_ref = $woocommerce_ref->get('products/'.$produto_ref->id.'/variations');

                        return view('franqueado.produto_variable_edit', compact('franquia', 'produto', 'variations', 'produto_ref', 'variations_ref'));
                        
                    }elseif($produto->type=='simple'){

                        return view('franqueado.produto_simple_edit', compact('franquia', 'produto', 'produto_ref'));
                    }
                }

                
            }else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function produtoEditTest($id, $produto)
    {
        //
        if(!(Gate::denies('update_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  

                $produto_id = $produto;

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                //LOja Atual
                $produto = $woocommerce->get('products/'.$produto_id); 

                

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                /* ----------------- Loja de Referência ---------------------- */
                $woocommerce_ref = new Client(
                    config('app.wc_reference_store_url'), 
                    config('app.wc_reference_consumer_key'), 
                    config('app.wc_reference_secret'),
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );                

                //Loja de referencia
                $params_ref = [
                    'slug' => $produto->slug,
                ];                
                    
                
                //$settings = $woocommerce->get('settings/general/woocommerce_currency');

                //$settings_ref = $woocommerce_ref->get('settings/general/woocommerce_currency');


                $produto_refs = $woocommerce_ref->get('products', $params_ref); 

                //First row
                foreach ($produto_refs as $produto_ref);

                dd($produto, $produto_ref);


                //LOG ------------------------------------------------------------------
                $this->log("franquia.edit.produto.id=".$franquia."Produto=".$produto->slug);
                //------------------------------------------------------------------------

                if(!isset($produto_ref)){

                    return redirect('franqueados/'.$franquia->id.'/produtos/1')->with('danger', 'Produto Bloqueado (Sem preço de referência)!');

                }else{

                    if($produto->type=='variable'){

                        $variations = $woocommerce->get('products/'.$produto->id.'/variations');

                        $variations_ref = $woocommerce_ref->get('products/'.$produto_ref->id.'/variations');

                        return view('franqueado.produto_variable_edit', compact('franquia', 'produto', 'variations', 'produto_ref', 'variations_ref'));
                        
                    }elseif($produto->type=='simple'){

                        return view('franqueado.produto_simple_edit', compact('franquia', 'produto', 'produto_ref'));
                    }
                }

                
            }else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function produtoSimpleUpdate(Request $request)
    {
        //
        if(!(Gate::denies('update_franqueado'))){

            //Validação
            $this->validate($request,[
                    'price' => 'required',
                    'regular_price' => 'required',      
                    'sale_price' => 'required'
            ]);

            $id = $request->input('franquia_id');

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  

                //Request Produto
                $produto_id = $request->input('produto_id');

                /* ----------------- Loja de Referência ---------------------- */
                $woocommerce_ref = new Client(
                    config('app.wc_reference_store_url'), 
                    config('app.wc_reference_consumer_key'), 
                    config('app.wc_reference_secret'),
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );
                /* ----------------- FIM Loja de Referência ---------------------- */

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );
                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                // Busca Produto
                // Loja Atual
                $produto = $woocommerce->get('products/'.$produto_id); 

                /* ----------------- Produto de Referência ----------------------- */
                //Loja de referencia
                $params_ref = [
                    'sku' => $produto->sku,
                    'slug' => $produto->slug,
                ];
   
                $produto_refs = $woocommerce_ref->get('products', $params_ref);
                //First row
                foreach ($produto_refs as $produto_ref);
                /* ----------------- FIM Produto de Referência ----------------------- */

                //LOG ----------------------------------------------------------------------------------
                $this->log("franquia.simple.update.produto.id=".$franquia."Produto=".$produto->slug);
                //--------------------------------------------------------------------------------------

                // Alterando o produto
                // Preço do Produto não pode ser inferior ao de referencia                

                if(($produto_ref->sale_price)<($request->input('sale_price'))){

                    $data = [
                        'price'         => $request->input('price'),
                        'regular_price' => $request->input('regular_price'),
                        'sale_price'    => $request->input('sale_price'),
                    ];

                    $produto = $woocommerce->put('products/'.$produto->id, $data);

                    return redirect('franqueados/'.$franquia->id.'/produtoEdit/'.$produto->id)->with('success', 'Produto atualizado com sucesso!');

                }else{
                    return redirect('franqueados/'.$franquia->id.'/produtoEdit/'.$produto->id)->with('danger', 'O valor do produto está abaixo da referência!');
                }

                
            }else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function produtoVariableUpdate(Request $request)
    {
        //
        if(!(Gate::denies('update_franqueado'))){

            //Validação
            $this->validate($request,[
                    'regular_price' => 'required',      
                    'sale_price' => 'required'
            ]);

            $id = $request->input('franquia_id');

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  

                //Request Produto
                $produto_id = $request->input('produto_id');
                $variation_id = $request->input('variation_id');

                /* ----------------- Loja de Referência ---------------------- */
                $woocommerce_ref = new Client(
                    config('app.wc_reference_store_url'), 
                    config('app.wc_reference_consumer_key'), 
                    config('app.wc_reference_secret'),
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );
                /* ----------------- FIM Loja de Referência ---------------------- */

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );
                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                // Busca Produto
                // Loja Atual
                $produto = $woocommerce->get('products/'.$produto_id); 



                //Busca a variação do Produto
                $produto_variation = $woocommerce->get('products/'.$produto_id.'/variations/'.$variation_id); 

                /* ----------------- Produto de Referência ----------------------- */
                //Loja de referencia
                $params_ref = [
                    'slug' => $produto->slug,
                ];
                //Consulta pelos parametros acima
                $produto_refs = $woocommerce_ref->get('products', $params_ref);

                //First row
                foreach ($produto_refs as $produto_ref);

                //Consulta pelo id e sku

                $params_ref = [
                    'sku' => $produto_variation->sku,
                ];


                $produto_variation_refs = $woocommerce_ref->get('products/'.$produto_ref->id.'/variations/', $params_ref);                
                
                //First row
                foreach ($produto_variation_refs as $produto_variation_ref);         
                
                /* ----------------- FIM Produto de Referência ----------------------- */

                //LOG ----------------------------------------------------------------------------------
                $this->log("franquia.variable.update.produto.id=".$franquia."Produto=".$produto->slug);
                //--------------------------------------------------------------------------------------                

                //Verifica se tem referencia adequada
                if(!isset($produto_variation_ref)){

                    return redirect('franqueados/'.$franquia->id.'/produtos/1')->with('danger', 'Produto Bloqueado (Sem preço de referência para variação via SKU)!');

                }elseif(($request->input('regular_price'))<($request->input('sale_price'))){
                    return redirect('franqueados/'.$franquia->id.'/produtoEdit/'.$produto->id)->with('danger', 'Preço Regular tem que ser maior do que o Preço de Venda');
                    
                }else{                   

                    // Alterando o produto
                    // Preço do Produto não pode ser inferior ao de referencia 

                    if(($produto_variation_ref->sale_price)<($request->input('sale_price'))){

                        /*$data = [
                            'price'         => $request->input('sale_price'),
                            'regular_price' => $request->input('regular_price'),
                            'sale_price'    => $request->input('sale_price')
                        ];*/

                        $data = [
                            'price'         => $request->input('sale_price'),
                            'regular_price' => $request->input('regular_price'),
                            'sale_price'    => $request->input('sale_price')
                        ];

                        $produto_variation = $woocommerce->put('products/'.$produto->id.'/variations/'.$produto_variation->id."/", $data);

                        
                        return redirect('franqueados/'.$franquia->id.'/produtoEdit/'.$produto->id)->with('success', 'Produto atualizado com sucesso!');

                    }else{
                        return redirect('franqueados/'.$franquia->id.'/produtoEdit/'.$produto->id)->with('danger', 'O valor do produto está abaixo da referência!');
                    }
                }

                
            }else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }


    public function produtoPublic($id, $produto, $status)
    {
        //
        if(!(Gate::denies('update_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-------------------------------------------------------------
            if($franquia){  

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if($status=='publish'){
                    $data = [
                        'status' => 'publish'
                    ];
                }else{                    
                    $data = [
                        'status' => 'draft'
                    ];
                }
                

                $produto = $woocommerce->put('products/'.$produto, $data);
                
                //LOG ----------------------------------------------------------------------------------------
                $this->log("franquia.edit.produto.id=".$franquia."Produto=".$produto->slug);
                //--------------------------------------------------------------------------------------


                return redirect('franqueados/'.$franquia->id.'/produtoEdit/'.$produto->id)->with('success', 'Produto atualizado com sucesso!');
            }else{
                return view('errors.403');
            }
        }
        else{
            return view('errors.403');
        }
    }

    

    /* ---------------------------- FIM Produtos da Franquia ------------------------*/

    /* ---------------------------- Pedidos da Franquia ------------------------*/

    public function pedidos($id, $page)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if(!isset($page)){
                    $page = 1;
                }             

                //$pedidos = $woocommerce->get('products');        
                $pedidos = $woocommerce->get('orders', array('per_page'=>50, 'page'=>$page));  

                $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();

                $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 


                //LOG ------------------------------------------------------
                $this->log("franqueado.pedidosFranqueado=".$franquia);
                //----------------------------------------------------------

                return view('franqueado.pedido', 
                       array(
                            'franquia'      => $franquia, 
                            'pedidos'      => $pedidos,
                            'page'          => $page,
                            'totalPages'    => $totalPages,
                            'linkPaginate'  => 'franqueados/'.$franquia->id.'/pedidos/',
                        ));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------
            
        }
        else{
            return view('errors.403');
        }
    }

    public function pedidoShow($id, $pedido)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if(!isset($page)){
                    $page = 1;
                }             

                $pedido = $woocommerce->get('orders/'.$pedido);  

                
                //LOG ------------------------------------------------------
                $this->log("franqueado.pedidoShowFranqueado=".$franquia."Pedido=".$pedido->id);
                //----------------------------------------------------------

                return view('franqueado.pedido_show', 
                       array(
                            'franquia'      => $franquia, 
                            'pedido'      => $pedido,
                        ));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ---------------------------- FIM Pedidos da Franquia ------------------------*/

    /* ---------------------------- Clientes da Franquia ------------------------*/

    public function clientes($id, $page)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if(!isset($page)){
                    $page = 1;
                }             

                //$clientes = $woocommerce->get('products');        
                $clientes = $woocommerce->get('customers', array('per_page'=>50, 'page'=>$page));  

                $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();

                $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 


                //LOG ------------------------------------------------------
                $this->log("franqueado.clientesFranqueado=".$franquia);
                //----------------------------------------------------------

                return view('franqueado.cliente', 
                       array(
                            'franquia'      => $franquia, 
                            'clientes'      => $clientes,
                            'page'          => $page,
                            'totalPages'    => $totalPages,
                            'linkPaginate'  => 'franqueados/'.$franquia->id.'/clientes/',
                        ));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------


            
        }
        else{
            return view('errors.403');
        }
    }

    /* ---------------------------- FIM Pedidos da Franquia ------------------------*/

    /* ---------------------------- Cupons da Franquia ------------------------*/

    public function cupons($id, $page)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if(!isset($page)){
                    $page = 1;
                }             

                $cupons = $woocommerce->get('coupons', array('per_page'=>50, 'page'=>$page));  

                $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();

                $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 


                //LOG ------------------------------------------------------
                $this->log("franqueado.cuponsFranqueado=".$franquia);
                //----------------------------------------------------------

                return view('franqueado.cupom', 
                       array(
                            'franquia'      => $franquia, 
                            'cupons'      => $cupons,
                            'page'          => $page,
                            'totalPages'    => $totalPages,
                            'linkPaginate'  => 'franqueados/'.$franquia->id.'/cupons/',
                        ));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------


            
        }
        else{
            return view('errors.403');
        }
    }

    /* ---------------------------- FIM Pedidos da Franquia ------------------------*/

    /* --------------------- Categorias da Franquia ----------------------*/
    

    public function categorias($id, $page)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                /* ----------------- Inicia Conexão WC ----------------------- */
                $consumer_secret = $this->decrypt($franquia->consumer_secret);                

                $woocommerce = new Client(
                    $franquia->store_url, 
                    $franquia->consumer_key, 
                    $consumer_secret,
                    [
                        'wp_api'  => true,
                        'version' => 'wc/v3',
                    ]
                );

                /* ----------------- FIM Inicia Conexão WC ----------------------- */

                if(!isset($page)){$page = 1;}             
      
                $categorias = $woocommerce->get('products/categories', array('per_page'=>50, 'page'=>$page));  

                $woocommerceHeaders = $woocommerce->http->getResponse()->getHeaders();

                $totalPages = $woocommerceHeaders['X-WP-TotalPages']; 


                //LOG ------------------------------------------------------
                $this->log("franqueado.categoriasFranqueado=".$franquia);
                //----------------------------------------------------------

                return view('franqueado.categoria', 
                       array(
                            'franquia'      => $franquia, 
                            'categorias'      => $categorias,
                            'page'          => $page,
                            'totalPages'    => $totalPages,
                            'linkPaginate'  => 'franqueados/'.$franquia->id.'/categorias/',
                        ));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------


            
        }
        else{
            return view('errors.403');
        }
    }

    /* ----------------------- END Produtos -------------------------- */

    public function imagem($id)
    {
        //
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first();  
            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){

                    //LOG ----------------------------------------------------------------------------------------
                    $this->log("upload.imagem.franqueado=".$id);
                    //--------------------------------------------------------------------------------------------

                    return view('franqueado.imagem', compact('franquia'));

            }else{
                return view('errors.403');
            }
            
        }
        else{
            return view('errors.403');
        }
    }

    public function imagemUpdate(Request $request)
    {
        if(!(Gate::denies('read_franqueado'))){

            //Validação
            $this->validate($request,[                
                    'file' => 'required|mimes:jpeg,png,jpg,pdf',
            ]);

            $id = $request->input('id');

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first();  
            //Verifica se tem permissão na franquia-----------------------------
            if($franquia){                

                $dir = "files/"."franquia".'/'.$franquia->id;

                $id = $franquia->id;

                $area = "franquia";

                /* -------------------------------- UPLOAD --------------------*/

                $file = $request->file('file');

                // Se informou o arquivo, retorna um boolean
                //$file = $request->hasFile('file');
                 
                // Se é válido, retorna um boolean
                //$file = $request->file('file')->isValid();

                // Retorna mime type do arquivo (Exemplo image/png)
                $tipo = $request->file('file')->getMimeType();
                 
                // Retorna o nome original do arquivo
                $nome = $request->file('file')->getClientOriginalName();
                 
                // Extensão do arquivo
                //$request->file('file')->getClientOriginalExtension();
                $ext = $request->file('file')->extension();
                 
                // Tamanho do arquivo
                $tam = $request->file('file')->getClientSize();

                // Define um aleatório para o arquivo baseado no timestamps atual
                $link = uniqid(date('HisYmd'));

                // Define finalmente o nome
                $link = "{$link}.{$ext}";

                // Faz o upload:
                $upload = $request->file->storeAs($dir, $link);
                // Armazenado em storage/app/public/


                /* -------------------------------- END UPLOAD --------------------*/

                        
                $upload = new Upload();
                $upload->titulo = "Logomarca ".$franquia->nome." ".$franquia->codigo_franquia;
                $upload->dir = $dir;
                $upload->link = $link;
                $upload->tipo = $tipo;
                $upload->nome = $nome;
                $upload->ext = $ext;
                $upload->tam = $tam;

                
                //LOG ----------------------------------------------------------------------------------------
                $this->log("franqueado.logomarca.store=".$request);
                //--------------------------------------------------------------------------------------------

                if($upload->save()){

                    /* ------------Vinculo do Arquivo------------- */

                    $upload_id = DB::getPdo()->lastInsertId();

                    
                    $status = $franquia->uploads()->attach($upload_id);
                                   

                    /* ------------END Vinculo do Arquivo------------- */

                    return redirect('franqueados/'.$franquia->id.'/configuracoesEdit')->with('success', 'Logomarca Alterada com Sucesso!.');
                }else{
                    return redirect('uploads/'.$id.'/create/'.$area)->with('danger', 'Houve um problema, tente novamente.');
                }

            }else{
                return view('errors.403');
            }

        }
        else{
            return view('errors.403');
        }
    }

}
