<?php

namespace App\Http\Controllers;

use App\ProdutoPreco;
use App\Produto;
use App\Orcamento;
use App\ItemOrcamento;
use App\Fornecedor;
use App\Upload;
use Illuminate\Http\Request;
use Gate;
use DB;

class ProdutoPrecoController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ProdutoPrecoController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;
    }

    /* ----------------------- END LOGS --------------------*/

    private $produtoPreco;

    public function __construct(ProdutoPreco $produtoPreco){
        $this->produtoPreco = $produtoPreco;
    }

        private function unidadesMedidas()
    {
        
        $units = array(
                        'un  | Unidade   | Unity',
                        'cx  | Caixa     | Box',
                        'emb | Embalagem | Packing',
                        'fd  | Fardo     | Burden',
                        'pct | Pacote    | Package',
                        'ro  | Rolo      | Roll',
                        'm   | Metro     | Meter',
                        'fl  | Folha     | Sheet',
                        'kg  | Kilograma | Kilogram'

        );

        return $units;
    }

    private function moedas()
    {
        
        $moeda = array(
                        'US$ | US Dollar',
                        '€   | Euro',
                        'R$  | Brazilian Real'
        );

        return $moeda;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        if(!(Gate::denies('read_produto_preco'))){
            $buscaInput = "";
            /*$produtos = Produto::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);*/


            $produto_precos = DB::table('produto_precos')
                    ->select(array(
                        'produto_precos.*',
                        'produtos.sku',
                        'produtos.titulo',
                        'fornecedors.nome_fantasia'
                     ))
                    ->join('produtos', 'produto_precos.produto_id', '=', 'produtos.id') 
                    ->join('fornecedors', 'produto_precos.fornecedor_id', '=', 'fornecedors.id')  
                    ->where('produtos.titulo', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.sku', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.descricao', 'LIKE', '%'.$buscaInput.'%')                  
                    ->orderBy('produto_precos.id', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.preco.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('produto_preco.index', array('produto_precos' => $produto_precos, 'buscar' => $buscaInput ));

        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_produto_preco'))){
            $buscaInput = $request->input('busca');
            /*$produtos = Produto::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);*/


            $produto_precos = DB::table('produto_precos')
                    ->select(array(
                        'produto_precos.*',
                        'produtos.sku',
                        'produtos.titulo',
                        'fornecedors.nome_fantasia'
                     ))
                    ->join('produtos', 'produto_precos.produto_id', '=', 'produtos.id') 
                    ->join('fornecedors', 'produto_precos.fornecedor_id', '=', 'fornecedors.id')  
                    ->where('produtos.titulo', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.sku', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.descricao', 'LIKE', '%'.$buscaInput.'%')                  
                    ->orderBy('produto_precos.id', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.preco.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('produto_preco.index', array('produto_precos' => $produto_precos, 'buscar' => $buscaInput ));

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProdutoPreco  $produtoPreco
     * @return \Illuminate\Http\Response
     */
    public function show(ProdutoPreco $produtoPreco)
    {
        //
        if(!(Gate::denies('read_produto_preco'))){

            $produto = $produtoPreco->produtos()->first();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.show=".$produto);
            //--------------------------------------------------------------------------------------------

            $imagens = $produto->imagens()->get();

            return view('produto_preco.show', compact('produto', 'imagens', 'produtoPreco'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProdutoPreco  $produtoPreco
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdutoPreco $produtoPreco)
    {
        //
        //
        if(!(Gate::denies('read_produto_preco'))){

            $unidades_medidas = $this->unidadesMedidas();

            $moedas = $this->moedas();

            $produto = $produtoPreco->produtos()->first();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.show=".$produto);
            //--------------------------------------------------------------------------------------------

            $imagens = $produto->imagens()->get();

            return view('produto_preco.edit', compact('produto', 'imagens', 'produtoPreco', 'unidades_medidas', 'moedas'));
        }
        else{
            return view('errors.403');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProdutoPreco  $produtoPreco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdutoPreco $produtoPreco)
    {
        //
        //
        if(!(Gate::denies('read_produto_preco'))){

            $this->validate($request,[
                    'quantidade' => 'required',
                    'unidade_medida' => 'required',      
                    'preco' => 'required',
                    'frete_preco' => 'required', 
                    'moeda' => 'required',
                    'taxa_plataforma' => 'required',
                    'impostos' => 'required',  
            ]);  

            
            $produtoPreco->quantidade = $request->input('quantidade');
            $produtoPreco->unidade_medida = $request->input('unidade_medida');
            $produtoPreco->preco = $request->input('preco');
            $produtoPreco->frete_preco = $request->input('frete_preco');
            $produtoPreco->frete_tipo = $request->input('frete_tipo');
            $produtoPreco->moeda = $request->input('moeda');
            $produtoPreco->taxa_plataforma = $request->input('taxa_plataforma');
            $produtoPreco->impostos = $request->input('impostos');

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.preco.update=".$produtoPreco);
            //--------------------------------------------------------------------------------------------    

            if($produtoPreco->save()){
                return redirect('produtoPrecos/')->with('success', 'Precificação atualizada com sucesso!');
            }else{
                return redirect('produtoPrecos/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProdutoPreco  $produtoPreco
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdutoPreco $produtoPreco)
    {
        //
        //
        if(!(Gate::denies('delete_produto_preco'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.preco.destroy.id=".$produtoPreco);
            //--------------------------------------------------------------------------------------------

            if($produtoPreco->delete()){
                return redirect('produtoPrecos/')->with('success', 'Precificação excluída com sucesso!');
            }else{
                return redirect('produtoPrecos/')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    public function orcamento($id)
    {        

        if(!(Gate::denies('create_produto_preco'))){

            $orcamento = Orcamento::find($id);

            $itens = ItemOrcamento::where('orcamento_id', $orcamento->id)->get();
            
            $fornecedor = Fornecedor::find($orcamento->fornecedor_id);

            $fornecedors = Fornecedor::all();

            $moedas = $this->moedas();
            

            //$itens = ItemOrcamento::where('orcamento_id', $orcamento->id)->get();


            $itens = DB::table('item_orcamentos')
                    ->select(array(
                        'item_orcamentos.id as item_id',
                        'item_orcamentos.quantidade',
                        'item_orcamentos.unidade_medida',
                        'item_orcamentos.preco',
                        'item_orcamentos.frete_preco',
                        'item_orcamentos.frete_tipo',
                        'item_orcamentos.moeda',
                        'produtos.id as produto_id',
                        'produtos.*'
                     ))
                    ->join('produtos', 'item_orcamentos.produto_id', '=', 'produtos.id')
                    ->where('item_orcamentos.orcamento_id', $orcamento->id)                  
                    ->orderBy('produtos.id', 'asc')
                    ->paginate(40);


            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.preco.orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('produto_preco.orcamento', compact('orcamento', 'fornecedors', 'fornecedor', 'itens', 'moedas'));
        }
        else{
            return view('errors.403');
        }   
        
        
    }

    public function orcamentoCreate(Request $request)
    {        

        if(!(Gate::denies('create_produto_preco'))){

        
            $token = $request->input('token');

            $orcamento = Orcamento::where('token', $token)->first();        

          
            $this->validate($request,[
                    'quantidade' =>  'required',
                    'preco' => 'required',
                    'frete_preco' => 'required',
                    'frete_tipo' => 'required',
                    'moeda' => 'required',    
            ]);

            /* ------------------------ POST ITEM -------------------- */ 
            $produto_id = $request->input('produto_id');         
            $fornecedor_id = $request->input('fornecedor_id');
            $orcamento_id = $request->input('orcamento_id');
            $item_orcamento_id = $request->input('item_id');
            $quantidade = $request->input('quantidade');
            $unidade_medida = $request->input('unidade_medida');
            $preco = $request->input('preco');
            $frete_preco = $request->input('frete_preco');
            $frete_tipo = $request->input('frete_tipo');
            $moeda = $request->input('moeda');
            $taxa_plataforma = $request->input('taxa_plataforma');
            $impostos = $request->input('impostos');
            /* ------------------------ END POST ITEM -------------------- */

            //Total array
            $total = sizeof($produto_id);

            

            for ($i = 0; $i < $total; $i++) {

                $produtoPreco = new ProdutoPreco(); 
                $produtoPreco->produto_id = $produto_id[$i];
                $produtoPreco->fornecedor_id = $fornecedor_id;
                $produtoPreco->orcamento_id = $orcamento_id;
                $produtoPreco->item_orcamento_id = $item_orcamento_id[$i];
                $produtoPreco->quantidade = $quantidade[$i];
                $produtoPreco->unidade_medida = $unidade_medida[$i];
                $produtoPreco->preco = $preco[$i];
                $produtoPreco->frete_preco = $frete_preco[$i];
                $produtoPreco->frete_tipo = $frete_tipo[$i];
                $produtoPreco->moeda = $moeda[$i];
                $produtoPreco->taxa_plataforma = $taxa_plataforma[$i];
                $produtoPreco->impostos = $impostos[$i];

                //dd($produtoPreco);

                if($produtoPreco->save()){
                    $status = true;
                }else{
                    $status = false;
                }
            }
            

                //LOG ----------------------------------------------------------------------------------------
                $this->log("orcamento.fornecedorUpdate=".$orcamento);
                //--------------------------------------------------------------------------------------------

                if($status){
                    return redirect('produtoPrecos/')->with('success', 'Precificação gerada com sucesso!');
                }else{
                    return redirect('produtoPrecos/'.$orcamento_id.'/orcamento')->with('danger', 'Houve um problema, tente novamente.');
                }
            
        }
        else{
            return view('errors.403');
        }
    }


    public function enable($id)
    {
        //
        if(!(Gate::denies('update_produto_preco'))){

            $produtoPreco = ProdutoPreco::find($id);                       
                    
            $produtoPreco->status = 1;
            
            //LOG --------------------------------------------------------------------------------
            $this->log("produto.Preco.status.1.=".$produtoPreco);
            //------------------------------------------------------------------------------------    

            if($produtoPreco->save()){
                return redirect('produtoPrecos/')->with('success', 'Produto Preço liberado com sucesso!');
            }else{
                return redirect('produtoPrecos/')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    public function disable($id)
    {
        //
        if(!(Gate::denies('update_produto_preco'))){

            $produtoPreco = ProdutoPreco::find($id);                       
                    
            $produtoPreco->status = 0;
            
            //LOG --------------------------------------------------------------------------------
            $this->log("produto.Preco.status.0.=".$produtoPreco);
            //------------------------------------------------------------------------------------    

            if($produtoPreco->save()){
                return redirect('produtoPrecos/')->with('success', 'Produto Preço bloqueado com sucesso!');
            }else{
                return redirect('produtoPrecos/')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    
        
    

}
