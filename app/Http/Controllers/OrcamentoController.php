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
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $token1 = $chars[rand (0 , 24)];
        $token1 .= $chars[rand (0 , 24)];
        $token1 .= rand (0 , 9);
        $token1 .= rand (0 , 9);
        $token = md5($token1);

        $token2 = $chars[rand (0 , 24)];
        $token2 .= $chars[rand (0 , 24)];
        $token2 .= rand (0 , 9);
        $token2 .= rand (0 , 9);
        $token  .= md5($token2);

        $token3 = $chars[rand (0 , 24)];
        $token3 .= $chars[rand (0 , 24)];
        $token3 .= rand (0 , 9);
        $token3 .= rand (0 , 9);
        $token  .= md5($token3);

        $token4 = $chars[rand (0 , 24)];
        $token4 .= $chars[rand (0 , 24)];
        $token4 .= rand (0 , 9);
        $token4 .= rand (0 , 9);
        $token  .= md5($token4);

        $token .= date("Ymdhis");

        return $token;
    }

    private function unidadesMedidas()
    {
        
        $units = array(
                        'unidade',
                        'caixa',
                        'galão',
                        'litro',
                        'kilograma'
        );

        return $units;
    }

    private function moedas()
    {
        
        $moeda = array(
                        'US$',
                        'R$'
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
            $orcamentos = Orcamento::paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.index");
            //--------------------------------------------------------------------------------------------

            return view('orcamento.index', array('orcamentos' => $orcamentos, 'buscar' => null));
        }
        else{
            return redirect('erro')->with('orcamento_error', '403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_orcamento'))){
            $buscaInput = $request->input('busca');
            $orcamentos = Orcamento::where('codigo', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.index', array('orcamentos' => $orcamentos, 'buscar' => $buscaInput ));

        }
        else{
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
                        'produtos.*'
                     ))
                    ->join('produtos', 'item_orcamentos.produto_id', '=', 'produtos.id')                    
                    ->orderBy('produtos.id', 'asc')
                    ->paginate(40);


            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.show', compact('orcamento', 'fornecedors', 'fornecedor', 'itens'));
        }
        else{
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
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
            return redirect('erro')->with('orcamento_error', '403');
        }
    }

    public function itemDestroy($id)
    {
        //
        if(!(Gate::denies('delete_orcamento'))){
            $item = ItemOrcamento::find($id);  

            $orcamento_id = $item->orcamento_id();      
            
            $item->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.item.destroy=".$item);
            //--------------------------------------------------------------------------------------------

            if($item_orcamento->save()){
                return redirect('orcamento/'.$orcamento_id)->with('success', 'Item removido com sucesso!');
            }else{
                return redirect('orcamento/create')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return redirect('erro')->with('orcamento_error', '403');
        }
    }

    // Criar usuário
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
                link para preencher o orçamento: http://atendimento.ecardume.com.br/orcamento/fornecedor/".$orcamento->token."  
                <br><br><br>
                <span style='color:red;'>*Aguardamos o retorno o mais breve possível.</span>
                <br><br><br>           
            ";

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.store");
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
            return redirect('erro')->with('orcamento_error', '403');
        }

    }

    public function fornecedor($token)
    {
        //
            
            $orcamento = Orcamento::where('token', $token)->first();

            $itens = ItemOrcamento::where('orcamento_id', $orcamento->id)->get();

            
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
                        'produtos.*'
                     ))
                    ->join('produtos', 'item_orcamentos.produto_id', '=', 'produtos.id')                    
                    ->orderBy('produtos.id', 'asc')
                    ->paginate(40);


            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.fornecedor', compact('orcamento', 'fornecedors', 'fornecedor', 'itens'));
        
        
    }

}
