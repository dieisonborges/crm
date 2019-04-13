<?php

namespace App\Http\Controllers;

use App\Orcamento;
use App\Fornecedor;
use Illuminate\Http\Request;
use Gate;

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

        return $token;
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
        if(!(Gate::denies('read_orcamento'))){
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
                return redirect('orcamento/')->with('success', 'Orcamento cadastrado com sucesso!');
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

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.show=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.show', compact('orcamento'));
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
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.edit.id=".$orcamento);
            //--------------------------------------------------------------------------------------------

            return view('orcamento.edit', compact('orcamento'));
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
        if(!(Gate::denies('read_orcamento'))){

            $this->validate($request,[
                    'titulo' => 'required|min:3',
                    'palavras_chave' => 'required|min:3',      
                    'descricao' => 'required|min:10',      
            ]);  

            // 1 - Ativo
            // 0 - Desativado
            $orcamento->status = $request->input('status');          
                    
            $orcamento->titulo = $request->input('titulo');
            $orcamento->palavras_chave = $request->input('palavras_chave');
            $orcamento->descricao = $request->input('descricao');

            //Cubagem
            $orcamento->altura = $request->input('altura');
            $orcamento->largura = $request->input('largura');
            $orcamento->comprimento = $request->input('comprimento');
            $orcamento->peso = $request->input('peso');

            $orcamento->link_referencia = $request->input('link_referencia');  

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
        if(!(Gate::denies('read_orcamento'))){
            $orcamento = Orcamento::find($id);        
            
            $orcamento->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("orcamento.destroy.id=".$id);
            //--------------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Orcamento excluído com sucesso!');

        }
        else{
            return redirect('erro')->with('orcamento_error', '403');
        }
    }
}
