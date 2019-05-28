<?php

namespace App\Http\Controllers;

use App\ListaProspecto;
use App\Franquia;
use App\Produto;
use App\Categoria;
use Illuminate\Http\Request;
use Gate;

class ListaProspectoController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ListaProspecto";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    private $listaProspecto;

    public function __construct(listaProspecto $listaProspecto){
        $this->listaProspecto = $listaProspecto;
    }

    /* ----------------------- END LOGS --------------------*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        if(!(Gate::denies('read_lista_prospecto'))){
            //$busca = $request->input('busca');
            $busca = "";
            $lista_prospectos = ListaProspecto::where('name', 'LIKE', '%'.$busca.'%')
                                ->orwhere('email', 'LIKE', '%'.$busca.'%')
                                ->orwhere('phone_number', 'LIKE', '%'.$busca.'%')
                                ->paginate(40);

            //LOG ---------------------------------------------------------------------------
            $this->log("lista_prospecto.busca=".$busca);
            //-------------------------------------------------------------------------------

            return view('lista_prospecto.index', array(
                                                'buscar' => $busca, 
                                                'lista_prospectos' => $lista_prospectos
                                            ));
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
        if(!(Gate::denies('create_lista_prospecto'))){

            //LOG ----------------------------------------------------------------------------
            $this->log("lista_prospecto.manual.create");
            //--------------------------------------------------------------------------------

            $franquias = Franquia::all();
            $produtos = Produto::all();
            $categorias = Categoria::all();

            return view('lista_prospecto.create', compact(
                                            'franquias', 
                                            'produtos', 
                                            'categorias'
                                        )
                        );                  
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
        
        return view('errors.403');

        die();

        //Desativado para sincronização

        //
        if(!(Gate::denies('create_lista_prospecto'))){

            $this->validate($request,[
                    'email' => 'required|email|unique:lista_prospectos',               
            ]);

            //Novo Prospecto
            $lista_prospecto = new ListaProspecto();
            $lista_prospecto->name = $request->input('name');
            $lista_prospecto->email =  $request->input('email');
            $lista_prospecto->phone_number =  $request->input('phone_number');

            //Salva o novo prospecto
            if($lista_prospecto->save()){

                //Busca o Prospecto Salvo
                $prospecto = ListaProspecto::
                                    where('name', $request->input('name'))
                                    ->where('email', $request->input('email'))
                                    ->where('phone_number', $request->input('phone_number'))
                                    ->first();

                //Array Franquia ----------------------------------------------------
                foreach (($request->input('franquia_id')) as $franquia) {
                        $status = $prospecto->listaProspectoFranquia()->attach($franquia);
                } 

                //Array Produto ----------------------------------------------------
                foreach (($request->input('produto_id')) as $produto) {
                        $status = $prospecto->listaProspectoProduto()->attach($produto);
                } 

                //Array Categoria ----------------------------------------------------
                foreach (($request->input('categoria_id')) as $categoria) {
                        $status = $prospecto->listaProspectoCategoria()->attach($categoria);
                } 
                     

                //LOG --------------------------------------------------------------------------
                $this->log("lista_prospecto.create.id=".$prospecto);
                //------------------------------------------------------------------------------
                
                if(!$status){
                    return redirect('listaProspectos')->with('success', 'Prospecto adicionado com sucesso!');
                }else{
                    return redirect('listaProspectos/create')->with('danger', 'Houve um problema, tente novamente.');
                }
            }else{
                    return redirect('listaProspectos/create')->with('danger', 'Houve um problema, tente novamente.');
                }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListaProspecto  $listaProspecto
     * @return \Illuminate\Http\Response
     */
    public function show(ListaProspecto $listaProspecto)
    {
        //
        if(!(Gate::denies('read_lista_prospecto'))){

            $prospecto = $listaProspecto;

            //Produtos
            $franquias = $prospecto->listaProspectoFranquia()->get();

            $produtos = $prospecto->listaProspectoProduto()->get();

            $categorias = $prospecto->listaProspectoCategoria()->get();

            

            //LOG -----------------------------------------------------------------------------
            $this->log("lista_prospecto.show=".$prospecto);
            //---------------------------------------------------------------------------------

            return view('lista_prospecto.show', compact(
                                            'prospecto',
                                            'franquias',
                                            'produtos',
                                            'categorias'
                                        ));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListaProspecto  $listaProspecto
     * @return \Illuminate\Http\Response
     */
    public function edit(ListaProspecto $listaProspecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListaProspecto  $listaProspecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListaProspecto $listaProspecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListaProspecto  $listaProspecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListaProspecto $listaProspecto)
    {
        //
    }
}
