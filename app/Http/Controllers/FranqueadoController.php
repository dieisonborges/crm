<?php

namespace App\Http\Controllers;

use App\Franquia;
use App\User;
use App\Produto;
use App\Convite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate; 
use DB;
use Mail;


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

            

                //LOG --------------------------------------------------------------------------
                $this->log("franqueado.dashboard=".$franquia);
                //------------------------------------------------------------------------------

                /* ------------------------ Contagem REGRESSIVA DASHBOARD ---------*/
                $inicio_contagem = '2018-11-01';
                $data_inicial = date('Y-m-d');                
                $data_final = '2019-08-01';
                

                // Dias que faltam
                $diferenca = strtotime($data_final) - strtotime($data_inicial);
                $faltam = floor($diferenca / (60 * 60 * 24));

                // Total de dias
                $total_contagem = strtotime($data_final) - strtotime($inicio_contagem);
                $total = floor($total_contagem / (60 * 60 * 24));


                $porcentagem = (($total-$faltam) * 100 )/$total;
                /* ------------------------ Contagem REGRESSIVA DASHBOARD ---------*/
                
            return view('franqueado.dashboard', compact('franquia', 'faltam', 'total', 'porcentagem'));

            }else{
            return view('errors.403');
        }


            
        }
        else{
            return view('errors.403');
        }
    }

    /* ------------------------------ Produtos da Franquia --------------------------*/
    public function produtosFranqueado($id)
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

                 $produtos = $franquia
                            ->franquiaProdutos()
                            ->select('produtos.*', 'produto_franquia.lucro')
                            ->where('produtos.status', 1)->get();

                 $todos_produtos = Produto::where('status', 1)->get();



            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.produtosFranqueado=".$franquia);
            //--------------------------------------------------------------------------------------



            return view('franqueado.produto_franqueado', compact('franquia', 'produtos', 'todos_produtos'));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------


            
        }
        else{
            return view('errors.403');
        }
    }


    public function produtosFranqueadoBusca(Request $request, $id)
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

                $buscaInput = $request->input('busca');    

                /*
                $produtos = $franquia::franquiaProdutos()
                                    ->select('produtos.*', 'produto_franquia.lucro')
                                    ->where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                    ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                    ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                    ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                    ->where('produtos.status', 1)
                                    ->get();
                */

                $produtos = $franquia->franquiaProdutos()
                            ->select('produtos.*', 'produto_franquia.lucro')
                            ->where(function ($query) use ($buscaInput) {
                                return $query
                                        ->where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%');
                            })
                            ->where('produtos.status', 1)
                            ->get();



                $todos_produtos = Produto::where('status', 1)
                                        ->where(function ($query) use ($buscaInput) {
                                            return $query
                                                    ->where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                                    ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                                    ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                                    ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%');
                                        })                                        
                                        ->get();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.produtosFranqueado=".$franquia."Busca".$buscaInput);
            //--------------------------------------------------------------------------------------



            return view('franqueado.produto_franqueado', array(
                                                            'franquia' => $franquia, 
                                                            'produtos' => $produtos,
                                                            'todos_produtos' => $todos_produtos,
                                                            'buscar' => $buscaInput,
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

    public function produtosRemover($id, $id_produto)
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

                $status = $franquia->franquiaProdutos()->detach($id_produto);


                //LOG ----------------------------------------------------------------------------------------
                $this->log("franqueado.produtos.remover=".$franquia);
                //--------------------------------------------------------------------------------------

                if($status){
                        return redirect('franqueados/'.$id.'/produtosFranqueado')->with('success', 'Produto removido com sucesso!');
                }else{
                    return redirect('franqueados/'.$id.'/produtosFranqueado')->with('danger', 'Houve um problema, tente novamente.');
                }
            }
            
        }
        else{
            return view('errors.403');
        }
    }


    public function produtosAdicionar($id, $id_produto)
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


                if($franquia->franquiaProdutos()->where('produto_id', $id_produto)->first()){

                    return redirect('franqueados/'.$id.'/produtosFranqueado')->with('success', 'Produto já está cadastrado para sua franquia!');

                }else{
                    //$status = $franquia->franquiaProdutos()->attach($id_produto);

                    $status = DB::table('produto_franquia')->insert([
                                                    'franquia_id' => $franquia->id, 
                                                    'produto_id' => $id_produto,
                                                    'lucro' => $franquia->lucro
                                                ]);


                    //LOG ----------------------------------------------------------------------------------------
                    $this->log("franqueado.produtos.remover=".$franquia);
                    //--------------------------------------------------------------------------------------

                    if($status){
                            return redirect('franqueados/'.$id.'/produtosFranqueado')->with('success', 'Produto adicionado com sucesso!');
                    }else{
                        return redirect('franqueados/'.$id.'/produtosFranqueado')->with('danger', 'Houve um problema, tente novamente.');
                    }

                }

                
            }
            
        }
        else{
            return view('errors.403');
        }
    }

    public function produtosLucro($id, $id_produto)
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

            $produto = Produto::find($id_produto)->where('status', 1)->first();

            $imagens = $produto->imagens()->get();

            $produto_franquia = DB::table('produto_franquia')
                                    ->where('produto_id', $id_produto)
                                    ->where('franquia_id', $franquia->id)
                                    ->first();

            //LOG ----------------------------------------------------------------------------------
            $this->log("franqueado.lucro.produto=".$franquia."Produto=".$produto);
            //--------------------------------------------------------------------------------------

            return view('franqueado.produto_lucro', compact('produto_franquia', 'franquia', 'produto', 'imagens'));

            }else{
            return view('errors.403');
        }


            
        }
        else{
            return view('errors.403');
        }
            
    }

    public function produtosLucroUpdate(Request $request, $id)
    {
        
        //Margem de Lucro do Produto
        if(!(Gate::denies('read_franqueado'))){

            //Selecionar franquia com segurança
            $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

            //Verifica se tem permissão na franquia
            if($franquia){

                
                $produto_franquia = $request->input('produto_franquia');
                $lucro = $request->input('lucro');

                $status = DB::table('produto_franquia')
                                ->where('id', $produto_franquia)
                                ->where('franquia_id', $franquia->id)
                                ->update(['lucro' => $lucro]);              
                
                
                //LOG --------------------------------------------------------------------------------
                $this->log("franqueado.lucro.update=".$franquia."Lucro".$lucro."ProdutoFranquia".$produto_franquia);
                //------------------------------------------------------------------------------------    

                if($franquia->save()){
                    return redirect('franqueados/'.$id.'/produtosFranqueado')->with('success', 'Franquia atualizada com sucesso!');
                }else{
                    return redirect('franqueados/'.$id.'/produtosFranqueado')->with('danger', 'Houve um problema, tente novamente.');
                }

            
            }
            else{
                return view('errors.403');
            }
        }
    }

    //Catálogo de Produtos -------------------------------------------------------------------------------------------------------
    public function produtos()
    {

        //
        if(!(Gate::denies('read_franqueado'))){

            $produtos = Produto::paginate(40);            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.catalogo.produtos.index");
            //--------------------------------------------------------------------------------------

            return view('franqueado.produto', array('produtos' => $produtos, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function produtosBusca (Request $request){
        if(!(Gate::denies('read_franqueado'))){
            $buscaInput = $request->input('busca');
            $produtos = Produto::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('franqueado.produto', array('produtos' => $produtos, 'buscar' => $buscaInput ));

        }
        else{
            return view('errors.403');
        }
    }

    public function produtosShow($id)
    {

        //
        if(!(Gate::denies('read_franqueado'))){

            $produto = Produto::find($id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.show=".$produto);
            //--------------------------------------------------------------------------------------------

            $imagens = $produto->imagens()->get();

            return view('franqueado.produtoshow', compact('produto', 'imagens'));
        }
        else{
            return view('errors.403');
        }
    }

    // FIM Catálogo de Produtos --------------------------------------------------------------------------------------------------------

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



            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.produtosFranqueado=".$franquia);
            //--------------------------------------------------------------------------------------



            return view('franqueado.configuracoes', compact('franquia'));

            }else{
                return view('errors.403');
            }
            //---------------------------------------------------------------------------------------------------


            
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

                $users = User::all();
                
                //LOG ----------------------------------------------------------------------------------------
                $this->log("franquia.edit.id=".$franquia);
                //--------------------------------------------------------------------------------------

                $select_estados_brasil = $this->selectEstadosBrasil();


                return view('franqueado.configuracoes_edit', compact('franquia', 'users', 'select_estados_brasil'));
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
                            'email' => 'email',
                            'lucro' => 'required' 
                    ]);            
                            
                    $franquia->nome = $request->input('nome');
                    $franquia->slogan = $request->input('slogan');
                    $franquia->descricao = $request->input('descricao');
                    $franquia->url_site = $request->input('url_site');
                    $franquia->url_blog = $request->input('url_blog');   

                    //Margem de Lucro Automática
                    $franquia->lucro = $request->input('lucro');                  

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

    public function prospectos($id)
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

                $lista_prospectos = $franquia->listaProspecto()->paginate(40);

                //$busca = $request->input('busca');
                /*$busca = "";
                $lista_prospectos = ListaProspecto::where('name', 'LIKE', '%'.$busca.'%')
                                    ->orwhere('email', 'LIKE', '%'.$busca.'%')
                                    ->orwhere('phone_number', 'LIKE', '%'.$busca.'%')
                                    ->paginate(40);*/

                //LOG ---------------------------------------------------------------------------
                $this->log("lista_prospecto.franquia=".$franquia);
                //-------------------------------------------------------------------------------

                return view('franqueado.prospectos', array(
                                                    //'buscar' => $busca,
                                                    'franquia' => $franquia, 
                                                    'lista_prospectos' => $lista_prospectos
                                                ));
            }else{
                return view('errors.403');
            }

        }
        else{
            return view('errors.403');
        }
        
    }

    public function prospectosBusca($id, Request $request)
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

                //$lista_prospectos = $franquia->listaProspecto()->paginate(40);

                $busca = $request->input('busca');
                $lista_prospectos = $franquia->listaProspecto()
                                    ->where('name', 'LIKE', '%'.$busca.'%')
                                    ->orwhere('email', 'LIKE', '%'.$busca.'%')
                                    ->orwhere('phone_number', 'LIKE', '%'.$busca.'%')
                                    ->paginate(40);

                //LOG ---------------------------------------------------------------------------
                $this->log("lista_prospecto.franquia=".$franquia);
                //-------------------------------------------------------------------------------

                return view('franqueado.prospectos', array(
                                                    //'buscar' => $busca,
                                                    'franquia' => $franquia, 
                                                    'lista_prospectos' => $lista_prospectos
                                                ));
            }else{
                return view('errors.403');
            }

        }
        else{
            return view('errors.403');
        }
        
    }



    public function prospectoShow($id, $prospecto_id)
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

                $prospecto = $franquia->listaProspecto()->where('lista_prospectos.id',$prospecto_id)->first();


                //Verifica se o usuário pode acessar o propecto
                if($prospecto){

                    //Produtos
                    $franquias = $prospecto->listaProspectoFranquia()->get();

                    $produtos = $prospecto->listaProspectoProduto()->get();

                    $categorias = $prospecto->listaProspectoCategoria()->get();

                    

                    //LOG -------------------------------------------------------------------
                    $this->log("franqueado.prospecto.show=".$prospecto);
                    //------------------------------------------------------------------------

                    return view('franqueado.prospecto_show', compact(
                                                    'prospecto',
                                                    'produtos',
                                                    'categorias'
                                                ));

                }else{
                    return view('errors.403');
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
        if(!(Gate::denies('read_franquia'))){

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

    



}
