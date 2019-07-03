<?php

namespace App\Http\Controllers;

use App\Orcamento;
use App\ItemOrcamento;
use App\Fornecedor;
use App\Produto;
use Illuminate\Http\Request;
use Gate;
use DB;
use Mail; 

class OrcamentoController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="OrcamentoController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;
    }

    /* ----------------------- END LOGS --------------------*/

    private $orcamento;

    public function __construct(Orcamento $orcamento){
        $this->orcamento = $orcamento;
    }

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_orcamento'))){
            //$orcamentos = Orcamento::paginate(40);  

            $orcamentos = DB::table('orcamentos')
                    ->select(array(
                        'orcamentos.*',
                        'fornecedors.nome_fantasia',
                        'fornecedors.endereco_pais'
                     ))
                    ->join('fornecedors', 'orcamentos.fornecedor_id', '=', 'fornecedors.id')                    
                    ->orderBy('orcamentos.id', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.index");
            //--------------------------------------------------------------------------------------------

            return view('orcamento.index', array('orcamentos' => $orcamentos, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_orcamento'))){
            $buscaInput = $request->input('busca');


            //$orcamentos = Orcamento::where('codigo', 'LIKE', '%'.$buscaInput.'%')
            //                    ->paginate(40); 

            $orcamentos = DB::table('orcamentos')
                    ->select(array(
                        'orcamentos.*',
                        'fornecedors.nome_fantasia',
                        'fornecedors.endereco_pais'
                     ))
                    ->join('fornecedors', 'orcamentos.fornecedor_id', '=', 'fornecedors.id')
                    ->where('orcamentos.codigo', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('fornecedors.nome_fantasia', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('fornecedors.endereco_pais', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('orcamentos.created_at', 'LIKE', '%'.$buscaInput.'%')                   
                    ->orderBy('orcamentos.id', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.index', array('orcamentos' => $orcamentos, 'buscar' => $buscaInput ));

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
        if(!(Gate::denies('read_orcamento'))){

            $fornecedors = Fornecedor::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.create");
            //--------------------------------------------------------------------------------------------
        
            return view('orcamento.create', compact('fornecedors'));
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
        //
        if(!(Gate::denies('create_orcamento'))){
            //Validação
            $this->validate($request,[
                    'token_validade' => 'required',
                    'fornecedor_id' => 'required',     
            ]);            
                    
            $orcamento = new Orcamento();
            $orcamento->token = $this->token();
            $orcamento->codigo = $this->codigo();
            $orcamento->token_validade = $request->input('token_validade');
            $orcamento->fornecedor_id = $request->input('fornecedor_id');
                        

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.store=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->save()){
                    $id_orcamento = DB::getPdo()->lastInsertId();
                    return redirect('orcamento/'.$id_orcamento)->with('success', 'Orcamento cadastrado com sucesso!');
            }else{
                return redirect('orcamento/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function show(Orcamento $orcamento)
    {
        //
        if(!(Gate::denies('read_orcamento'))){

            $fornecedor = Fornecedor::find($orcamento->fornecedor_id);

            $fornecedors = Fornecedor::all();

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
            $this->log("orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.show', compact('orcamento', 'fornecedors', 'fornecedor', 'itens'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Orcamento $orcamento)
    {
        //
        if(!(Gate::denies('read_orcamento'))){

            $fornecedor = Fornecedor::find($orcamento->fornecedor_id);

            $fornecedors = Fornecedor::all();
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.edit.id=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.edit', compact('orcamento', 'fornecedor', 'fornecedors'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orcamento $orcamento)
    {
        //
        if(!(Gate::denies('update_orcamento'))){

            //Validação
            $this->validate($request,[
                    'token_validade' => 'required',
                    'fornecedor_id' => 'required',     
            ]);            
                    
            $orcamento->token_validade = $request->input('token_validade');
            $orcamento->fornecedor_id = $request->input('fornecedor_id');

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.update=".$orcamento);
            //--------------------------------------------------------------------------------------------    

            if($orcamento->save()){
                return redirect('orcamento/')->with('success', 'Orcamento atualizado com sucesso!');
            }else{
                return redirect('orcamento/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orcamento $orcamento)
    {
        //
        if(!(Gate::denies('delete_orcamento'))){    
            
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.destroy=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->delete()){
                return redirect('orcamento/')->with('success', 'Orcamento excluido com sucesso!');
            }else{
                return redirect('orcamento/create')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    public function item($id)
    {
        //
        if(!(Gate::denies('read_orcamento'))){

            $orcamento = Orcamento::find($id);

            $produtos = Produto::all();

            $unidades_medidas = $this->unidadesMedidas();

            $moedas = $this->moedas();
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.create.item.id=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.item', compact('orcamento', 'produtos', 'unidades_medidas', 'moedas'));
        }
        else{
            return view('errors.403');
        }
    }

    public function itemStore(Request $request)
    {
        //
        //
        if(!(Gate::denies('create_orcamento'))){
            //Validação
            $this->validate($request,[
                    'quantidade' => 'required',
                    'unidade_medida' => 'required',
                    'orcamento_id' => 'required',
                    'produto_id' => 'required',    
            ]);            
                    
            $item_orcamento = new ItemOrcamento();

            $item_orcamento->orcamento_id = $request->input('orcamento_id');
            //redirect
            $orcamento_id = $item_orcamento->orcamento_id;

            $item_orcamento->produto_id = $request->input('produto_id');

            $item_orcamento->quantidade = $request->input('quantidade');
            $item_orcamento->unidade_medida = $request->input('unidade_medida');


            $item_orcamento->preco = $request->input('preco');
            $item_orcamento->frete_preco = $request->input('frete_preco');
            $item_orcamento->frete_tipo = $request->input('frete_tipo');
            $item_orcamento->moeda = $request->input('moeda');

            //LOG ----------------------------------------------------------------------------------------
            $this->log("item_orcamento.store=".$item_orcamento);
            //--------------------------------------------------------------------------------------------

            if($item_orcamento->save()){
                return redirect('orcamento/'.$orcamento_id)->with('success', 'Item adicionado ao orcamento com sucesso!');
            }else{
                return redirect('orcamento/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function itemLote($id)
    {
        //
        if(!(Gate::denies('read_orcamento'))){

            $orcamento = Orcamento::find($id);

            $produtos = Produto::all();

            $unidades_medidas = $this->unidadesMedidas();

            $moedas = $this->moedas();
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.create.item.id=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.item_lote', compact('orcamento', 'produtos', 'unidades_medidas', 'moedas'));
        }
        else{
            return view('errors.403');
        }
    }

    public function itemLoteStore(Request $request)
    {
        //
        //
        if(!(Gate::denies('create_orcamento'))){
            //Validação
            $this->validate($request,[
                    'quantidade' => 'required',
                    'unidade_medida' => 'required',
                    'orcamento_id' => 'required',
                    'produto_id' => 'required',    
            ]); 

            $produtos_id = $request->input('produto_id');

            foreach ($produtos_id as $produto_id) {
                
                $item_orcamento = new ItemOrcamento();

                $item_orcamento->orcamento_id = $request->input('orcamento_id');
                //redirect
                $orcamento_id = $item_orcamento->orcamento_id;

                $item_orcamento->produto_id = $produto_id;

                $item_orcamento->quantidade = $request->input('quantidade');
                $item_orcamento->unidade_medida = $request->input('unidade_medida');


                $item_orcamento->preco = $request->input('preco');
                $item_orcamento->frete_preco = $request->input('frete_preco');
                $item_orcamento->frete_tipo = $request->input('frete_tipo');
                $item_orcamento->moeda = $request->input('moeda');

                //LOG --------------------------------------------------------------
                $this->log("item_orcamento.store=".$item_orcamento);
                //------------------------------------------------------------------

                $status = $item_orcamento->save();

            }

            if($status){
                return redirect('orcamento/'.$orcamento_id)->with('success', 'Item adicionado ao orcamento com sucesso!');
            }else{
                return redirect('orcamento/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function itemEdit($id)
    {
        //
        if(!(Gate::denies('update_orcamento'))){

            $item = ItemOrcamento::find($id);

            $produto = Produto::where('id', $item->produto_id)->first();

            $produtos = Produto::all();

            $orcamento = Orcamento::where('id', $item->orcamento_id)->first();

            $unidades_medidas = $this->unidadesMedidas();

            $moedas = $this->moedas();

            //$fornecedors = Fornecedor::all();
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.item.edit.id=".$item);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.item_edit', compact('orcamento', 'produtos', 'produto', 'item', 'unidades_medidas', 'moedas'));
        }
        else{
            return view('errors.403');
        }
    }

    public function itemUpdate(Request $request)
    {
        //
        //
        if(!(Gate::denies('update_orcamento'))){           

            //Validação
            $this->validate($request,[
                    'quantidade' => 'required',
                    'unidade_medida' => 'required',
                    'item_id' => 'required',
                    'produto_id' => 'required',    
            ]);        

            $item_orcamento = ItemOrcamento::find($request->input('item_id'))->first();
    
            $item_orcamento->produto_id = $request->input('produto_id');

            $item_orcamento->quantidade = $request->input('quantidade');
            $item_orcamento->unidade_medida = $request->input('unidade_medida');


            $item_orcamento->preco = $request->input('preco');
            $item_orcamento->frete_preco = $request->input('frete_preco');
            $item_orcamento->frete_tipo = $request->input('frete_tipo');
            $item_orcamento->moeda = $request->input('moeda');

            //LOG ----------------------------------------------------------------------------------------
            $this->log("item_orcamento.store=".$item_orcamento);
            //--------------------------------------------------------------------------------------------


            //redirect      
            $orcamento_id = $request->input('orcamento_id');

            if($item_orcamento->save()){
                return redirect('orcamento/'.$orcamento_id)->with('success', 'Item alterado com sucesso!');
            }else{
                return redirect('orcamento/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function itemDestroy(Request $request)
    {
        
        //
        if(!(Gate::denies('delete_orcamento'))){

            $orcamento_id = $request->input('orcamento_id');

            $item = ItemOrcamento::find($request->input('item_id'));

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.item.destroy=".$item);
            //--------------------------------------------------------------------------------------------

            if($item->delete()){
                return redirect('orcamento/'.$orcamento_id)->with('success', 'Item removido com sucesso!');
            }else{
                return redirect('orcamento/'.$orcamento_id)->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }
    }

    
    public function enviar($id){

        if(!(Gate::denies('create_orcamento'))){  

            $orcamento = Orcamento::where('id', $id)->first(); 
 

            $fornecedor = Fornecedor::where('id', $orcamento->fornecedor_id)->first();    

                                
            // 0 - Em edição
            // 1 - Bloqueado (Enviado Para Cotação)
            // 2 - Cancelado
            // 3 - Cotação Finalizada
            $orcamento->status = 1;


            $mail_to = $fornecedor->email;

            $msg="                
                Olá, você acabou de receber um pedido de orçamento, clique no link abaixo, e insira os valores dos produtos e frete: <br><br>
                Código: <b>".$orcamento->codigo."</b> <br>
                Fornecedor: ".$fornecedor->nome_fantasia." | ".$fornecedor->razao_social."
                Gerado em: <b>".date("d/m/Y às H:m")."</b><br><br>               
                link para preencher o orçamento:".url('/orcamento/fornecedor')."/".$orcamento->token."  
                <br><br><br>
                <span style='color:red;'>*Aguardamos o retorno o mais breve possível.</span>
                <br><br><br>           
            ";

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.enviado=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->save()){

                $mailData = array(
                    'nome' => "7P CRM e-Cardume | Relacionamento",
                    'email' => "atendimento@ecardume.com.br",
                    'assunto' => "Solicitação de orçamento e-Cardume",
                    'msg' => $msg,
                );

                
                //Destinatario
                $mailFrom = array(
                            'email'     => $mail_to,
                            'name'      => $fornecedor->nome_fantasia,
                            'subject'   => 'CRM e-Cardume | Relacionamento | Orçamento'
                          );


                Mail::send('email.contato', $mailData, function ($m) use ($mailFrom) {
                    $m->from('atendimento@ecardume.com.br','CRM e-Cardume | Relacionamento | Orçamento');
                    $m->to($mailFrom['email'], $mailFrom['name'])->subject($mailFrom['subject']);
                });

                return redirect('orcamento/')->with('success', 'Orçamento enviado com sucesso!');
            }else{
                return redirect('orcamento/'.$id)->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

    public function cancelar($id){

        if(!(Gate::denies('create_orcamento'))){  

            $orcamento = Orcamento::where('id', $id)->first(); 
 

            $orcamento->status = 2;
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.cancelar=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->save()){
                return redirect('orcamento/')->with('success', 'Orçamento cancelado com sucesso!');
            }else{
                return redirect('orcamento/'.$id)->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }


    /*-------------------------------- SEGURANCA VIA TOKEN --------------------------------*/

    public function fornecedor($token)
    {
        
        $orcamento = Orcamento::where('token', $token)->first();

        if($orcamento){

            $orcamento = Orcamento::where('token', $token)->first();

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
            $this->log("orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.fornecedor', compact('orcamento', 'fornecedors', 'fornecedor', 'itens', 'moedas'));
        }
        else{
            return view('errors.403');
        }   
        
        
    }

    public function fornecedorUpdate(Request $request)
    {
        
        $token = $request->input('token');

        $orcamento = Orcamento::where('token', $token)->first();        

        if($orcamento){

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
                $item_orcamento = ItemOrcamento::where('id', $id[$i])->first();

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
                return redirect('orcamento/fornecedor/'.$token)->with('success', 'Orçamento salvo com sucesso! Budget saved successfully!');
            }else{
                return redirect('orcamento/fornecedor/'.$token)->with('danger', 'Houve um problema, tente novamente. (There was a problem, please try again.)');
            }
        }
        else{
            return view('errors.403');
        }
        
    }

    public function fornecedorFinalizar($token){

        $orcamento = Orcamento::where('token', $token)->first();

        if($orcamento){
             
            //Cotação Finalizada
            $orcamento->status = 3;
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.cancelar=".$orcamento);
            //--------------------------------------------------------------------------------------------

            if($orcamento->save()){
                return redirect('/')->with('success', 'Orçamento finalizado com sucesso! (Budget completed successfully!)');
            }else{
                return redirect('orcamento/fornecedor/'.$token)->with('danger', 'Houve um problema, tente novamente. (There was a problem, please try again.)');
            }
        }
        else{
            return view('errors.403');
        }

    }

    

}
