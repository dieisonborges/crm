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

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            $franquia = $franquias->where('id', $id)->first();

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

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            $franquia = $franquias->where('id', $id)->first();

            //Verifica se tem permissão na franquia
            if($franquia){

                 $produtos = $franquia->franquiaProdutos()->where('produtos.status', 1)->get();

                 $todos_produtos = Produto::where('status', 1)->get();



            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado.produtosFranqueado=".$franquia);
            //--------------------------------------------------------------------------------------



            return view('franqueado.produto_franqueado', compact('franquia', 'produtos', 'todos_produtos'));

            }else{
            return view('errors.403');
        }


            
        }
        else{
            return view('errors.403');
        }
    }

    public function produtosRemover($id, $id_produto)
    {
        
        //
        if(!(Gate::denies('read_franqueado'))){

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            $franquia = $franquias->where('id', $id)->first();

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

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            $franquia = $franquias->where('id', $id)->first();

            //Verifica se tem permissão na franquia
            if($franquia){


                if($franquia->franquiaProdutos()->where('produto_id', $id_produto)->first()){

                    return redirect('franqueados/'.$id.'/produtosFranqueado')->with('success', 'Produto já está cadastrado para sua franquia!');

                }else{
                    $status = $franquia->franquiaProdutos()->attach($id_produto);


                    //LOG ----------------------------------------------------------------------------------------
                    $this->log("franqueado.produtos.remover=".$franquia);
                    //--------------------------------------------------------------------------------------

                    if(!$status){
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







}
