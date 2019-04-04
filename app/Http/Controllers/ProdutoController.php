<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class ProdutoController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ProdutoController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $produto;

    public function __construct(Produto $produto){
        $this->produto = $produto;
    }

    private function skuGenerate()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        $protocolo2 = $chars[rand (0 , 24)];
        $protocolo2 .= $chars[rand (0 , 24)];

        return "K".date("y").$protocolo.date("m").$protocolo2;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(Gate::denies('read_produto'))){
            $produtos = Produto::paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.index");
            //--------------------------------------------------------------------------------------------

            return view('produto.index', array('produtos' => $produtos, 'buscar' => null));
        }
        else{
            return redirect('erro')->with('produto_error', '403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_produto'))){
            $buscaInput = $request->input('busca');
            $produtos = Produto::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('produto.index', array('produtos' => $produtos, 'buscar' => $buscaInput ));

        }
        else{
            return redirect('erro')->with('produto_error', '403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {

        //
        if(!(Gate::denies('read_produto'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.show=".$produto);
            //--------------------------------------------------------------------------------------------

            return view('produto.show', compact('produto'));
        }
        else{
            return redirect('erro')->with('produto_error', '403');
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
        if(!(Gate::denies('read_produto'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.create");
            //--------------------------------------------------------------------------------------------
        
            return view('produto.create');
        }
        else{
            return redirect('erro')->with('produto_error', '403');
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
        if(!(Gate::denies('read_produto'))){
            //Validação
            $this->validate($request,[
                    'titulo' => 'required|min:3',
                    'palavras_chave' => 'required|min:3',      
                    'descricao' => 'required|min:10',      
            ]);            
                    
            $produto = new Produto();
            $produto->sku = $this->skuGenerate();
            $produto->titulo = $request->input('titulo');
            $produto->palavras_chave = $request->input('palavras_chave');
            $produto->descricao = $request->input('descricao');
            $produto->status = "1"; //Produto Ativo

            //Cubagem
            $produto->altura = $request->input('altura');
            $produto->largura = $request->input('largura');
            $produto->comprimento = $request->input('comprimento');
            $produto->peso = $request->input('peso');

            $produto->link_referencia = $request->input('link_referencia');
            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.store");
            //--------------------------------------------------------------------------------------------

            if($produto->save()){
                return redirect('produtos/')->with('success', 'Produto cadastrado com sucesso!');
            }else{
                return redirect('produtos/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('produto_error', '403');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
        if(!(Gate::denies('read_produto'))){
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.edit.id=".$produto);
            //--------------------------------------------------------------------------------------------

            return view('produto.edit', compact('produto'));
        }
        else{
            return redirect('erro')->with('produto_error', '403');
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
        if(!(Gate::denies('read_produto'))){

            $this->validate($request,[
                    'titulo' => 'required|min:3',
                    'palavras_chave' => 'required|min:3',      
                    'descricao' => 'required|min:10',      
            ]);            
                    
            $produto->titulo = $request->input('titulo');
            $produto->palavras_chave = $request->input('palavras_chave');
            $produto->descricao = $request->input('descricao');

            //Cubagem
            $produto->altura = $request->input('altura');
            $produto->largura = $request->input('largura');
            $produto->comprimento = $request->input('comprimento');
            $produto->peso = $request->input('peso');

            $produto->link_referencia = $request->input('link_referencia');  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.update=".$produto);
            //--------------------------------------------------------------------------------------------    

            if($produto->save()){
                return redirect('produtos/')->with('success', 'Produto atualizado com sucesso!');
            }else{
                return redirect('produtos/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return redirect('erro')->with('produto_error', '403');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
        if(!(Gate::denies('read_produto'))){
            $produto = Produto::find($id);        
            
            $produto->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.destroy.id=".$id);
            //--------------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Produto excluído com sucesso!');

        }
        else{
            return redirect('erro')->with('produto_error', '403');
        }
    }
}
