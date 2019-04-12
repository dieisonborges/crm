<?php

namespace App\Http\Controllers;

use App\Franquia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate; 
use DB;


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
            return redirect('erro')->with('franquia_error', '403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_franquia'))){
            $buscaInput = $request->input('busca');
            $franquias = Franquia::where('codigo_franquia', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('nome', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('slogan', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------

            return view('franquia.index', array('franquias' => $franquias, 'buscar' => $buscaInput ));

        }
        else{
            return redirect('erro')->with('franquia_error', '403');
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
            return redirect('erro')->with('franquia_error', '403');
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
            return redirect('erro')->with('franquia_error', '403');
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

            //Dados da Loja Open Cart
            $franquia->loja_url = $request->input('loja_url');
            //Database OpenCart
            $franquia->loja_database_url = $request->input('loja_database_url');
            $franquia->loja_database_name = $request->input('loja_database_name');
            $franquia->loja_database_user = $request->input('loja_database_user');
            //Password Database OpenCart
            //Salt
            $salt = $this->saltGen();
            $franquia->loja_database_password_salt = $salt;
            //base64_encode(database_password_salt + database_password + APP_HASH_ENCODE) 
            $franquia->loja_database_password = 
                            base64_encode( 
                                $salt.
                                $request->input('loja_database_password').
                                $this->appHashEncode()
                            );

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
            return redirect('erro')->with('franquia_error', '403');
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
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("franquia.edit.id=".$franquia);
            //--------------------------------------------------------------------------------------

            $select_estados_brasil = $this->selectEstadosBrasil();


            return view('franquia.edit', compact('franquia', 'users', 'select_estados_brasil'));
        }
        else{
            return redirect('erro')->with('franquia_error', '403');
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
                    //'cnpj' => 'cnpj',
                    'email' => 'email'  
            ]);            
                    
            $franquia->nome = $request->input('nome');
            $franquia->slogan = $request->input('slogan');
            $franquia->descricao = $request->input('descricao');
            $franquia->url_site = $request->input('url_site');
            $franquia->url_blog = $request->input('url_blog');


            //Dados da Loja Open Cart
            $franquia->loja_url = $request->input('loja_url');
            //Database OpenCart
            $franquia->loja_database_url = $request->input('loja_database_url');
            $franquia->loja_database_name = $request->input('loja_database_name');
            $franquia->loja_database_user = $request->input('loja_database_user');

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


            //Só modifica a Senha se não estiver vazio
            if($request->input('loja_database_password')){
                    //Password Database OpenCart
                    //Salt
                    $salt = $this->saltGen();
                    $franquia->loja_database_password_salt = $salt;
                    //base64_encode(database_password_salt + database_password + APP_HASH_ENCODE) 
                    $franquia->loja_database_password = 
                                    base64_encode( 
                                        $salt.
                                        $request->input('loja_database_password').
                                        $this->appHashEncode()
                                    );

            }

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
            return redirect('erro')->with('franquia_error', '403');
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
            return redirect('erro')->with('franquia_error', '403');
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

}
