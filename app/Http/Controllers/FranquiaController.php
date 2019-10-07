<?php

namespace App\Http\Controllers;

use App\Franquia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Gate; 
use DB; 

//REST API Woocommerce
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;


//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class FranquiaController extends Controller
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

    private $franquia;

    public function __construct(Franquia $franquia){
        $this->franquia = $franquia;
    }

    private function codFranquiaGen()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        return "F".date("y").$protocolo;
    }

    private function saltGen()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ!@#$%1234567890';

        $qtd_chars = strlen($chars);

        $salt = $chars[rand (0 , $qtd_chars)];
        $salt .= $chars[rand (0 , $qtd_chars)];
        $salt .= $chars[rand (0 , $qtd_chars)];
        $salt .= $chars[rand (0 , $qtd_chars)];
        $salt .= $chars[rand (0 , $qtd_chars)];
        $salt .= $chars[rand (0 , $qtd_chars)];
        $salt .= $chars[rand (0 , $qtd_chars)];

        return md5($salt);
    }

    private function appHashEncode(){
        // APP_HASH_ENCODE
        // .env
        return config('app.app_hash_encode');
    }

    private function encrypt($text) 
    { 
        return trim(base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->appHashEncode(), $text, MCRYPT_MODE_ECB, @mcrypt_create_iv(@mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
    } 

    private function decrypt($text) 
    { 
        return trim(@mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->appHashEncode(), base64_decode($text), MCRYPT_MODE_ECB, @mcrypt_create_iv(@mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
    } 

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_franquia'))){
            $franquias = Franquia::paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.index");
            //--------------------------------------------------------------------------------------
            

            return view('franquia.index', array('franquias' => $franquias, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_franquia'))){
            $buscaInput = $request->input('busca');
            $franquias = Franquia::where('codigo_franquia', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('nome', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('slogan', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('loja_url', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------

            return view('franquia.index', array('franquias' => $franquias, 'buscar' => $buscaInput ));

        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Franquia  $franquia
     * @return \Illuminate\Http\Response
     */
    public function show(Franquia $franquia)
    {
        //
        //
        if(!(Gate::denies('read_franquia'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.show=".$franquia);
            //--------------------------------------------------------------------------------------

            return view('franquia.show', compact('franquia'));
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
        if(!(Gate::denies('read_franquia'))){

            $users = User::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.create");
            //--------------------------------------------------------------------------------------
        
            $select_estados_brasil = $this->selectEstadosBrasil();

            return view('franquia.create', compact('users', 'select_estados_brasil'));
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
        if(!(Gate::denies('read_franquia'))){
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

            //Dados WooCommerce
            $franquia->WP_HOME = $request->input('WP_HOME');
            $franquia->WP_SITEURL = $request->input('WP_SITEURL');
            $franquia->DB_NAME = $request->input('DB_NAME');
            $franquia->DB_USER = $request->input('DB_USER');            
            $franquia->DB_HOST = $request->input('DB_HOST');
            $franquia->DB_CHARSET = $request->input('DB_CHARSET');
            $franquia->DB_COLLATE = $request->input('DB_COLLATE');

            //Encrypt Password
            $DB_PASSWORD_ENC = $request->input('DB_PASSWORD');

            //dd($this->encrypt($DB_PASSWORD_ENC));


            $franquia->DB_PASSWORD = $this->encrypt($DB_PASSWORD_ENC);

            
            //Se tem líder/afiliado vincula
            if($request->input('user_id_afiliado')){
                    $franquia->user_id_afiliado = $request->input('user_id_afiliado');
            }

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.store=".$request);
            //--------------------------------------------------------------------------------------

            if($franquia->save()){

                /* ----------------- INSERE DONO --------------------------*/
                $franquia_last_id = DB::getPdo()->lastInsertId();

                //Se tem Dono vincula
                if($request->input('user_id_dono')){
                        User::find($request->input('user_id_dono'))->franquia()->attach($franquia_last_id);
                }
                
                /* ----------------- END INSERE DONO --------------------------*/


                return redirect('franquias/')->with('success', 'Franquia cadastrada com sucesso!');
            }else{
                return redirect('franquias/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Franquia  $franquia
     * @return \Illuminate\Http\Response
     */
    public function edit(Franquia $franquia)
    {
        //
        if(!(Gate::denies('read_franquia'))){

            $users = User::all();

            $codigo_franquia = $franquia->codigo_franquia;

            //Verifica se a loja foi criada -------------------------------
            $instalador_lojas = DB::connection('con_instalador_lojas')
                        ->select( DB::raw('SELECT * FROM instalador_lojas WHERE codigo_franquia="$codigo_franquia" LIMIT 1;') );
            if($instalador_lojas){
                foreach ($instalador_lojas as $instalador_loja);
            }else{
                $instalador_loja=false;
            }
            //-------------------------------------------------------------

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.edit.id=".$franquia);
            //--------------------------------------------------------------------------------------

            $select_estados_brasil = $this->selectEstadosBrasil();

            //Logomarca
            $imagem = $franquia->uploads()->orderBy('id', 'DESC')->first();


            return view('franquia.edit', compact('franquia', 'users', 'select_estados_brasil', 'imagem', 'instalador_loja'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Franquia  $franquia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Franquia $franquia)
    {
        //
        if(!(Gate::denies('read_franquia'))){
            //Validação
            $this->validate($request,[
                    'nome' => 'required|min:3',
                    'slogan' => 'required|min:3',     
                    'descricao' => 'required|min:10',               
                    'loja_url'  =>  'required|min:3',
                    'loja_url_alternativa'  =>  'required|min:3',
                    //'cnpj' => 'cnpj',
                    'email' => 'email'  
            ]);            
                    
            $franquia->nome = $request->input('nome');
            $franquia->slogan = $request->input('slogan');
            $franquia->descricao = $request->input('descricao');
            $franquia->url_site = $request->input('url_site');
            $franquia->url_blog = $request->input('url_blog');


            //URL da Loja
            $franquia->loja_url = $request->input('loja_url');
            $franquia->loja_url_alternativa = $request->input('loja_url_alternativa');
            
            //Wordpress Integração
            $franquia->WP_HOME = $request->input('WP_HOME');
            $franquia->WP_SITEURL = $request->input('WP_SITEURL');
            $franquia->DB_NAME = $request->input('DB_NAME');
            $franquia->DB_USER = $request->input('DB_USER');            
            $franquia->DB_HOST = $request->input('DB_HOST');
            $franquia->DB_CHARSET = $request->input('DB_CHARSET');
            $franquia->DB_COLLATE = $request->input('DB_COLLATE');

            //Encrypt Password            
            $DB_PASSWORD_ENC = $request->input('DB_PASSWORD');
            if($DB_PASSWORD_ENC){
                $franquia->DB_PASSWORD = $this->encrypt($DB_PASSWORD_ENC);
            }

            /* ---------------- API Woocommerce -------------- */
            $franquia->store_url = $request->input('store_url');
            $franquia->consumer_key = $request->input('consumer_key');

            //Encrypt Password            
            $consumer_secret_enc = $request->input('consumer_secret');
            if($consumer_secret_enc){
                $franquia->consumer_secret = $this->encrypt($consumer_secret_enc);
            }
            

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


            //Se tem líder/afiliado vincula
            if($request->input('user_id_afiliado')){
                    $franquia->user_id_afiliado = $request->input('user_id_afiliado');
            }
            
            //LOG --------------------------------------------------------------------------------
            $this->log("franquia.update=".$franquia);
            //------------------------------------------------------------------------------------    

            if($franquia->save()){
                return redirect('franquias/')->with('success', 'Franquia atualizada com sucesso!');
            }else{
                return redirect('franquias/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Franquia  $franquia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Franquia $franquia)
    {
        //
        if(!(Gate::denies('delete_franquia'))){
            
            $franquia->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.destroy=".$franquia);
            //--------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Franquia excluída com sucesso!');

        }
        else{
            return view('errors.403');
        }
    }

    public function donos($id){

        if(!(Gate::denies('read_franquia'))){

            $franquia = Franquia::find($id);

            //recuperar permissões
            $donos = $franquia->franquiaUser()->get();

            //todas permissoes
            $all_users = User::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.dono=".$franquia);
            //--------------------------------------------------------------------------------------

            return view('franquia.dono', compact('franquia', 'donos', 'all_users'));
        }
        else{
            return redirect('erro')->with('dono_error', '403');
        }


    }

    public function donoUpdate(Request $request){

        if(!(Gate::denies('update_franquia'))){

            $franquia_id = $request->input('franquia_id');
            $dono_id_array = $request->input('dono_id'); 

            $franquia  = Franquia::find($franquia_id);

            foreach ($dono_id_array as $dono_id) {
                    $status = User::find($dono_id)->franquia()->attach($franquia_id);
            }            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.donoUpdate.id=".$franquia_id."Dono=".$dono_id);
            //--------------------------------------------------------------------------------------
            
            if(!$status){
                return redirect('franquias/'.$franquia_id.'/donos')->with('success', 'Franquia (Regra) atualizada com sucesso!');
            }else{
                return redirect('franquias/'.$franquia_id.'/donos')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('dono_error', '403');
        }

    }

    public function donoDestroy(Request $request){
        if(!(Gate::denies('delete_franquia'))){

            /* -------------------- */

            $franquia_id = $request->input('franquia_id');
            $dono_id = $request->input('dono_id'); 

            $dono  = User::find($dono_id);

            $status = $dono->franquia()->detach($franquia_id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.dono.destroy.id=".$franquia_id."Permission".$dono_id);
            //--------------------------------------------------------------------------------------------
            
            if($status){
                return redirect('franquias/'.$franquia_id.'/donos')->with('success', 'Franquia (Regra) excluída com sucesso!');
            }else{
                return redirect('franquias/'.$franquia_id.'/donos')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('dono_error', '403');
        }
    }

    public function enable($id)
    {
        //
        if(!(Gate::denies('update_franquia'))){

            $franquia = Franquia::find($id);                       
                    
            $franquia->status = 1;
            
            //LOG --------------------------------------------------------------------------------
            $this->log("franquia.status.1.=".$franquia);
            //------------------------------------------------------------------------------------    

            if($franquia->save()){
                return redirect('franquias/')->with('success', 'Franquia ativada com sucesso!');
            }else{
                return redirect('franquias/')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    public function disable($id)
    {
        //
        if(!(Gate::denies('update_franquia'))){

            $franquia = Franquia::find($id);                       
                    
            $franquia->status = 0;
            
            //LOG --------------------------------------------------------------------------------
            $this->log("franquia.status.0.=".$franquia);
            //------------------------------------------------------------------------------------    

            if($franquia->save()){
                return redirect('franquias/')->with('success', 'Franquia desativada com sucesso!');
            }else{
                return redirect('franquias/')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    public function wpSettings($id)
    {
        
        //
        if(!(Gate::denies('update_franquia'))){

            //Selecionar franquia com segurança
            $franquia = Franquia::where('franquias.id', $id)
                            ->first();  

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
  
            $settings = $woocommerce->get('settings/general');

            //LOG ------------------------------------------------------
            $this->log("franquia.settings.Franquia=".$franquia);
            //----------------------------------------------------------

            return view('franquia.wp_settings', 
                   array(
                        'franquia'      => $franquia, 
                        'settings'      => $settings,                        
                    ));            
        }
        else{
            return view('errors.403');
        }
    }


    public function gerarLoja($id)
    {
        //
        if(!(Gate::denies('update_franquia'))){

            //Selecionar franquia com segurança
            $franquia = Franquia::where('franquias.id', $id)
                            ->first(); 

            /* ----------------------------Dados Franquia-------------------------- */
            $codigo_franquia=$franquia->codigo_franquia;

            $dominio=str_replace("https://", "", $franquia->WP_SITEURL);
            $dominio=str_replace("http://", "", $dominio);
            $dominio=str_replace("/", "", $dominio);

            $banco=$franquia->codigo_franquia;

            $usuario=$franquia->codigo_franquia;

            $senha=Hash::make(str_random(10));
            /* ------------------------------------------------------------------ */
    

            //Verifica se a loja foi criada -------------------------------
            $instalador_lojas = DB::connection('con_instalador_lojas')
                        ->select( DB::raw('SELECT * FROM instalador_lojas WHERE codigo_franquia="$codigo_franquia" LIMIT 1;') );


            if($instalador_lojas){
                return redirect('franquias/'.$franquia->id.'/edit')->with('danger', 'A franquia já existe!');
            }else{
                $instalacao = DB::connection('con_instalador_lojas')
                        ->select( DB::raw("INSERT INTO  instalador_lojas 
                                            (codigo_franquia, dominio, banco, usuario, senha) VALUES
                                            ('".$codigo_franquia."', '".$dominio."', '".$banco."', '".$usuario."', '".$senha."')
                                        ;") );
            }
            //-------------------------------------------------------------

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.gerarLoja.id=".$franquia);
            //--------------------------------------------------------------------------------------

            //Atualiza dados da Loja
            $franquia->DB_NAME=$banco;
            $franquia->DB_USER=$usuario;
            $franquia->DB_HOST="localhost";

            if($instalacao){
                $franquia->save();
                return redirect('franquias/'.$franquia->id.'/edit')->with('success', 'Iniciada a instalação da Loja, aguarde 30 minutos!');
            }else{
                return redirect('franquias/'.$franquia->id.'/edit')->with('danger', 'Houve um problema e o processo não foi iniciado!');
            }           

            
        }
        else{
            return view('errors.403');
        }
    }

    public function instalador()
    {
        //
        if(!(Gate::denies('read_franquia'))){            
    

            //Verificar lojas criadas --------------------------------------------------------------
            $franquias = DB::connection('con_instalador_lojas')
                        ->select( DB::raw('SELECT * FROM instalador_lojas;') );            

            //LOG ----------------------------------------------------------------------------------
            $this->log("franquia.show.instalador");
            //--------------------------------------------------------------------------------------

            

            return view('franquia.instalador', compact('franquias'));
            
        }
        else{
            return view('errors.403');
        }
    }

}
