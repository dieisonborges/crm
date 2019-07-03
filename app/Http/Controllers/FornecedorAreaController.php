<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Orcamento;
use App\ItemOrcamento;
use App\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gate;
use DB;
use Mail; 


class FornecedorAreaController extends Controller
{
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FornecedorAreaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private function codigo()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        $protocolo2 = $chars[rand (0 , 24)];
        $protocolo2 .= $chars[rand (0 , 24)];
        $protocolo2 .= $chars[rand (0 , 24)];
        $protocolo2 .= $chars[rand (0 , 24)];

        return "ORC".date("y").$protocolo.date("m").$protocolo2;
    }

    private function token()
    {
        
        $chars  = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $chars2 = 'abcdefghijklmnpqrstuvwxyz';

        $token1 = $chars[rand (0 , 24)];
        $token1 .= $chars[rand (0 , 24)];
        $token1 .= rand (0 , 9);
        $token1 .= rand (0 , 9);
        //TOKEN
        $token = md5($token1);

        $token2 = $chars[rand (0 , 24)];
        $token2 .= rand (0 , 9);
        $token2 .= $chars[rand (0 , 24)];
        $token2 .= rand (0 , 9); 
        $token2 .= $chars[rand (0 , 24)];
        $token2 .= rand (0 , 9); 
        $token2 .= $chars[rand (0 , 24)]; 
        //TOKEN
        $token  .= $token2;

        $token3 = $chars[rand (0 , 24)];
        $token3 .= $chars[rand (0 , 24)];
        $token3 .= rand (0 , 9);
        $token3 .= rand (0 , 9);
        //TOKEN
        $token  .= md5($token3);

        $token4 = $chars[rand (0 , 24)];
        $token4 .= $chars[rand (0 , 24)];
        $token4 .= rand (0 , 9);
        $token4 .= rand (0 , 9);
        //TOKEN
        $token  .= md5($token4);

        

        $token .= date("Ymdhis");

        $token .= rand (0 , 9999999999);

        $token .= $chars2[rand (0 , 24)];


        return $token;
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

    private $fornecedor;

    public function __construct(Fornecedor $fornecedor){
        $this->fornecedor = $fornecedor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            //LOG ----------------------------------------------------
            $this->log("fornecedor.area.dashboard");
            //--------------------------------------------------------

            return view('fornecedor_area.dashboard', compact('fornecedor'));
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentos()
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){
            //$orcamentos = Orcamento::paginate(40);  

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamentos = DB::table('orcamentos')
                    ->select(array(
                        'orcamentos.*',
                        'fornecedors.nome_fantasia',
                        'fornecedors.endereco_pais'
                     ))
                    ->join('fornecedors', 'orcamentos.fornecedor_id', '=', 'fornecedors.id')
                    ->where('fornecedors.id', $fornecedor->id)                    
                    ->orderBy('orcamentos.id', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.index");
            //--------------------------------------------------------------------------------------------

            return view('fornecedor_area.orcamento', array('orcamentos' => $orcamentos, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentoCreate()
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("fornecedor.area.orcamento.create");
            //--------------------------------------------------------------------------------------------
        
            return view('fornecedor_area.orcamento_create', compact('fornecedor'));
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentoStore(Request $request)
    {
        //
        //
        if(!(Gate::denies('update_fornecedor_area'))){
            //Validação
            $this->validate($request,[
                    'token_validade' => 'required',
                    'fornecedor_id' => 'required',     
            ]);            
                    

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 


            $orcamento = new Orcamento();
            $orcamento->token = $this->token();
            $orcamento->codigo = $this->codigo();
            $orcamento->token_validade = $request->input('token_validade');
            $orcamento->fornecedor_id = $fornecedor->id;
                        

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.store=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->save()){
                    $id_orcamento = DB::getPdo()->lastInsertId();
                    return redirect('fornecedorArea/orcamentoShow/'.$id_orcamento)->with('success', 'Orcamento cadastrado com sucesso! / Budget successfully entered!');
            }else{
                return redirect('fornecedorArea/orcamentoCreate')->with('danger', 'Houve um problema, tente novamente. / There was a problem, please try again.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentoShow($orcamento)
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $orcamento)
                                    ->first();

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
                        'produtos.*'
                     ))
                    ->join('produtos', 'item_orcamentos.produto_id', '=', 'produtos.id')
                    ->where('item_orcamentos.orcamento_id', $orcamento->id)                  
                    ->orderBy('produtos.id', 'asc')
                    ->paginate(40);


            //LOG ----------------------------------------------------------------------------------------
            $this->log("fornecedor_area.orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('fornecedor_area.orcamento_show', compact('orcamento', 'fornecedor', 'itens'));
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentoEdit($orcamento)
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $orcamento)
                                    ->first();

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
                        'produtos.*'
                     ))
                    ->join('produtos', 'item_orcamentos.produto_id', '=', 'produtos.id')
                    ->where('item_orcamentos.orcamento_id', $orcamento->id)                  
                    ->orderBy('produtos.id', 'asc')
                    ->paginate(40);


            //LOG ----------------------------------------------------------------------------------------
            $this->log("fornecedor.area.orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('fornecedor_area.orcamento_interno', compact('orcamento', 'fornecedors', 'fornecedor', 'itens', 'moedas'));
        }
        else{
            return view('errors.403');
        }   
        
        
    }


    public function orcamentoUpdate(Request $request)
    {
        
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento_id = $request->input('orcamento_id');

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $orcamento_id)
                                    ->first();

            //Validação
            /*
            $this->validate($request,[
                    'preco' => 'required',
                    'frete_preco' => 'required',
                    'frete_tipo' => 'required',
                    'moeda' => 'required',    
            ]);
            */

            /* ------------------------ POST ITEM -------------------- */
            $id = $request->input('id');
            $preco = $request->input('preco');
            $frete_preco = $request->input('frete_preco');
            $frete_tipo = $request->input('frete_tipo');
            $moeda = $request->input('moeda');
            /* ------------------------ END POST ITEM -------------------- */

            //Total array
            $total = sizeof($id);

            

            for ($i = 0; $i < $total; $i++) {
                $item_orcamento = ItemOrcamento::where('id', $id[$i])->where('orcamento_id', $orcamento->id)->first();

                //itens
                $item_orcamento->preco = $preco[$i];
                $item_orcamento->frete_preco = $frete_preco[$i];
                $item_orcamento->frete_tipo = $frete_tipo[$i];
                $item_orcamento->moeda = $moeda[$i];

                if($item_orcamento->save()){
                    $status = true;
                }else{
                    $status = false;
                }
            }

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.fornecedorUpdate=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($item_orcamento->save()){
                return redirect('fornecedorArea/orcamentoEdit/'.$orcamento->id)->with('success', 'Orçamento salvo com sucesso! Budget saved successfully!');
            }else{
                return redirect('fornecedorArea/orcamentoEdit/'.$orcamento->id)->with('danger', 'Houve um problema, tente novamente. (There was a problem, please try again.)');
            }
        }
        else{
            return view('errors.403');
        }
        
    }


    public function orcamentoFinalizar($orcamento_id)
    {
        
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $orcamento_id)
                                    ->first();
        
             
            //Cotação Finalizada
            $orcamento->status = 3;
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("fornecedor.area.orcamento.finlizar=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->save()){
                return redirect('fornecedorArea/orcamentoShow/'.$orcamento->id)->with('success', 'Orçamento salvo com sucesso! Budget saved successfully!');
            }else{
                return redirect('fornecedorArea/orcamentoEdit/'.$orcamento->id)->with('danger', 'Houve um problema, tente novamente. (There was a problem, please try again.)');
            }
        }
        else{
            return view('errors.403');
        }

    }


    public function orcamentoItemLote($id)
    {
        //
        if(!(Gate::denies('read_fornecedor_area'))){

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $id)
                                    ->first();

            $produtos = Produto::all();

            $unidades_medidas = $this->unidadesMedidas();

            $moedas = $this->moedas();
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("fornecedor.area.orcamento.create.item.id=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('fornecedor_area.orcamento_item_lote', compact('orcamento', 'produtos', 'unidades_medidas', 'moedas'));
        }
        else{
            return view('errors.403');
        }
    }

    public function orcamentoItemLoteStore(Request $request)
    {
        //
        //
        if(!(Gate::denies('create_fornecedor_area'))){
            //Validação
            $this->validate($request,[
                    'quantidade' => 'required',
                    'unidade_medida' => 'required',
                    'orcamento_id' => 'required',
                    'produto_id' => 'required',    
            ]); 



            $produtos_id = $request->input('produto_id');


            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $request->input('orcamento_id'))
                                    ->first();


            foreach ($produtos_id as $produto_id) {
                
                $item_orcamento = new ItemOrcamento();

                $item_orcamento->orcamento_id = $orcamento->id;

                $item_orcamento->produto_id = $produto_id;

                $item_orcamento->quantidade = $request->input('quantidade');
                $item_orcamento->unidade_medida = $request->input('unidade_medida');


                $item_orcamento->preco = $request->input('preco');
                $item_orcamento->frete_preco = $request->input('frete_preco');
                $item_orcamento->frete_tipo = $request->input('frete_tipo');
                $item_orcamento->moeda = $request->input('moeda');

                //LOG --------------------------------------------------------------
                $this->log("fornecedor_area.item_orcamento.store=".$item_orcamento);
                //------------------------------------------------------------------

                $status = $item_orcamento->save();

            }

            if($status){
                return redirect('fornecedorArea/orcamentoEdit/'.$orcamento->id)->with('success', 'Item adicionado ao orcamento com sucesso!');
            }else{
                return redirect('fornecedorArea/orcamentoItemLote/'.$orcamento->id)->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }


    public function orcamentoItemDestroy(Request $request)
    {
        
        //
        if(!(Gate::denies('delete_fornecedor_area'))){

            $orcamento_id = $request->input('orcamento_id');

            $user = Auth::user();

            $fornecedor = $user->fornecedor()->first(); 

            $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                    ->where('id', $orcamento_id)
                                    ->first();


            $item = ItemOrcamento::where('id', $request->input('item_id'))
                                    ->where('orcamento_id', $orcamento->id)
                                    ->first();

            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("fornecedor_area.orcamento.item.destroy=".$item);
            //--------------------------------------------------------------------------------------------

            if($item->delete()){
                return redirect('fornecedorArea/orcamentoShow/'.$orcamento->id)->with('success', 'Item removido com sucesso! Item successfully removed!');
            }else{
                return redirect('fornecedorArea/orcamentoShow/'.$orcamento->id)->with('danger', 'Houve um problema, tente novamente. (There was a problem, please try again.)');
            }

        }
        else{
            return view('errors.403');
        }
    }




    

    
}

