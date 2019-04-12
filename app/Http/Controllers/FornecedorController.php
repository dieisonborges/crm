<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use Gate;

class FornecedorController extends Controller
{
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FornecedorController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $fornecedor;

    public function __construct(Fornecedor $fornecedor){
        $this->fornecedor = $fornecedor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_fornecedor'))){
            $fornecedors = Fornecedor::paginate(40);  

            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.index");
            //---------------------------------------------------------------------------------------

            return view('fornecedor.index', array('fornecedors' => $fornecedors, 'buscar' => null));
        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_fornecedor'))){
            $buscaInput = $request->input('busca');
            $fornecedors = Fornecedor::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.busca=".$buscaInput);
            //---------------------------------------------------------------------------------------

            return view('fornecedor.index', array('fornecedors' => $fornecedors, 'buscar' => $buscaInput ));

        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
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
        if(!(Gate::denies('read_fornecedor'))){

            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.create");
            //---------------------------------------------------------------------------------------
        
            return view('fornecedor.create');
        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
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
        if(!(Gate::denies('read_fornecedor'))){
            //Validação
            $this->validate($request,[
                    'nome_fantasia' => 'required|min:3',
                    'email' => 'required|min:3|email',      
                    'responsavel' => 'required|min:3',      
            ]);                     
                    
            $fornecedor = new Fornecedor();

            $fornecedor->status = "1"; //Fornecedor Ativo 

            $fornecedor->nome_fantasia = $request->input('nome_fantasia');
            $fornecedor->email = $request->input('email');
            $fornecedor->responsavel = $request->input('responsavel');
            $fornecedor->razao_social = $request->input('razao_social');
            $fornecedor->cnpj = $request->input('cnpj');
            $fornecedor->descricao = $request->input('descricao');
            //Sites
            $fornecedor->url_site = $request->input('url_site');
            $fornecedor->url_loja = $request->input('url_loja');
            $fornecedor->url_blog = $request->input('url_blog');
            //Contatos
            $fornecedor->telefone = $request->input('telefone');
            //Contatos
            $fornecedor->skype = $request->input('skype');
            $fornecedor->wechat = $request->input('wechat');
            $fornecedor->whatsapp = $request->input('whatsapp');
            $fornecedor->telegram = $request->input('telegram');
            $fornecedor->facebook = $request->input('facebook');
            $fornecedor->instagram = $request->input('instagram');
            $fornecedor->twitter = $request->input('twitter');
            //Endereço
            $fornecedor->endereco = $request->input('endereco');
            $fornecedor->endereco_numero = $request->input('endereco_numero');
            $fornecedor->endereco_bairro = $request->input('endereco_bairro');
            $fornecedor->endereco_cidade = $request->input('endereco_cidade');
            $fornecedor->endereco_estado = $request->input('endereco_estado');
            $fornecedor->endereco_pais = $request->input('endereco_pais');
            $fornecedor->endereco_cep = $request->input('endereco_cep');           

            //LOG ---------------------------------------------------------------------------------------
            $this->log("fornecedor.store=".$fornecedor);
            //--------------------------------------------------------------------------------------

            if($fornecedor->save()){
                return redirect('fornecedor/')->with('success', 'Fornecedor cadastrado com sucesso!');
            }else{
                return redirect('fornecedor/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
        if(!(Gate::denies('read_fornecedor'))){
            
            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.read=".$fornecedor);
            //---------------------------------------------------------------------------------------

            return view('fornecedor.show', compact('fornecedor'));
        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
        if(!(Gate::denies('update_fornecedor'))){
            
            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.edit=".$fornecedor);
            //---------------------------------------------------------------------------------------

            return view('fornecedor.edit', compact('fornecedor'));
        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
        if(!(Gate::denies('update_fornecedor'))){

            $this->validate($request,[
                    'nome_fantasia' => 'required|min:3',
                    'email' => 'required|min:3|email',      
                    'responsavel' => 'required|min:3',       
            ]);  

            $fornecedor->nome_fantasia = $request->input('nome_fantasia');
            $fornecedor->email = $request->input('email');
            $fornecedor->responsavel = $request->input('responsavel');
            $fornecedor->razao_social = $request->input('razao_social');
            $fornecedor->cnpj = $request->input('cnpj');
            $fornecedor->descricao = $request->input('descricao');
            //Sites
            $fornecedor->url_site = $request->input('url_site');
            $fornecedor->url_loja = $request->input('url_loja');
            $fornecedor->url_blog = $request->input('url_blog');
            //Contatos
            $fornecedor->telefone = $request->input('telefone');
            //Contatos
            $fornecedor->skype = $request->input('skype');
            $fornecedor->wechat = $request->input('wechat');
            $fornecedor->whatsapp = $request->input('whatsapp');
            $fornecedor->telegram = $request->input('telegram');
            $fornecedor->facebook = $request->input('facebook');
            $fornecedor->instagram = $request->input('instagram');
            $fornecedor->twitter = $request->input('twitter');
            //Endereço
            $fornecedor->endereco = $request->input('endereco');
            $fornecedor->endereco_numero = $request->input('endereco_numero');
            $fornecedor->endereco_bairro = $request->input('endereco_bairro');
            $fornecedor->endereco_cidade = $request->input('endereco_cidade');
            $fornecedor->endereco_estado = $request->input('endereco_estado');
            $fornecedor->endereco_pais = $request->input('endereco_pais');
            $fornecedor->endereco_cep = $request->input('endereco_cep');  

            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.update=".$fornecedor);
            //---------------------------------------------------------------------------------------    

            if($fornecedor->save()){
                return redirect('fornecedor/')->with('success', 'Fornecedor atualizado com sucesso!');
            }else{
                return redirect('fornecedor/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
        if(!(Gate::denies('read_fornecedor'))){      
            
            $fornecedor->delete();

            //LOG -----------------------------------------------------------------------------------
            $this->log("fornecedor.destroy=".$fornecedor);
            //---------------------------------------------------------------------------------------

            if(!$fornecedor->delete()){
                return redirect('fornecedor/')->with('success', 'Fornecedor removido com sucesso!');
            }else{
                return redirect('fornecedor/')->with('danger', 'Houve um problema, tente novamente.');
            }

            return redirect()->back()->with('success','Fornecedor excluído com sucesso!');

        }
        else{
            return redirect('erro')->with('fornecedor_error', '403');
        }
    }
}
