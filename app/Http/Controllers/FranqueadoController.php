<?php

namespace App\Http\Controllers;

use App\Franquia;
use App\User;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate; 
use DB;


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

    private $franquia;

    public function __construct(Franquia $franquia){
        $this->franquia = $franquia;
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

            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.dashboard=".$franquia);
            //--------------------------------------------------------------------------------------



            return view('franqueado.dashboard', compact('franquia'));

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

    



}
