<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Sistema;
use App\User;
use Illuminate\Http\Request;
use Gate;
use DB;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class CategoriaController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="CategoriaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $categoria;

    public function __construct(Categoria $categoria){
        $this->categoria = $categoria;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_categoria'))){
            $categorias = Categoria::orderBy('id')->get();     

            //LOG --------------------------------------------------------
            $this->log("categoria.index");
            //------------------------------------------------------------

            //Conecta nas lojas remotas
            /*$categorias_remotas = DB::connection('mysql_loja')
                                        ->table('categorias')
                                        ->orderBy('id_7p')
                                        ->get();*/

            return view('categoria.index', array(
                                                'categorias' => $categorias, 
                                                /*'categorias_remotas' => $categorias_remotas, */
                                                'buscar' => null
                                            ));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_categoria'))){
            $buscaInput = $request->input('busca');
            $categorias = Categoria::where('nome', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->orderBy('id')
                                ->paginate(40);

            //Conecta nas lojas remotas
            /*$categorias_remotas = DB::connection('mysql_loja')
                                        ->table('categorias')
                                        ->where('nome', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                        ->orderBy('id_7p')
                                        ->get();*/


            //LOG -------------------------------------------------
            $this->log("categoria.busca=".$buscaInput);
            //------------------------------------------------------



            return view('categoria.index', array(
                                                'categorias' => $categorias,
                                                /*'categorias_remotas' => $categorias_remotas, */
                                                'buscar' => $buscaInput
                                            ));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
         if(!(Gate::denies('read_categoria'))){

            //LOG -------------------------------------------------
            $this->log("categoria.show=".$categoria);
            //-----------------------------------------------------

            return view('categoria.show', array('categoria' => $categoria));
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
        if(!(Gate::denies('create_categoria'))){

            //LOG --------------------------------------------
            $this->log("categoria.create");
            //------------------------------------------------
        
            return view('categoria.create');
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
        if(!(Gate::denies('create_categoria'))){
            //Validação
            $this->validate($request,[
                    'nome' => 'required|min:3',
                    'descricao' => 'required|min:15',
                    'valor' => 'required',
            ]);
           
                    
            $categoria = new Categoria();
            $categoria->nome = $request->input('nome');
            $categoria->descricao = $request->input('descricao');
            $categoria->valor = $request->input('valor');

            
            //LOG ----------------------------------------
            $this->log("categoria.store");
            //---------------------------------------------

            if($categoria->save()){
                return redirect('categorias/')->with('success', 'Categoria cadastrada com sucesso!');
            }else{
                return redirect('categorias/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
        if(!(Gate::denies('update_categoria'))){            

            //LOG -------------------------------------------------
            $this->log("categoria.edit=".$categoria);
            //------------------------------------------------------

            return view('categoria.edit', compact('categoria'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
        if(!(Gate::denies('update_categoria'))){

            //Validação
            $this->validate($request,[
                    'nome' => 'required|min:3',
                    'descricao' => 'required|min:15',
                    'valor' => 'required',
            ]);                   
        
            
            $categoria->nome = $request->get('nome');
            $categoria->descricao = $request->get('descricao');
            $categoria->valor = $request->input('valor');

            
            //LOG ---------------------------------------------
            $this->log("categoria.update=".$categoria);
            //--------------------------------------------------


            if($categoria->save()){
                return redirect('categorias/')->with('success', 'Categoria atualizada com sucesso!');
            }else{
                return redirect('categorias/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
        if(!(Gate::denies('delete_categoria'))){
            
            $categoria->delete();

            //LOG ------------------------------------------------------
            $this->log("categoria.destroy=".$categoria);
            //----------------------------------------------------------

            return redirect()->back()->with('success','Categoria excluída com sucesso!');
        }
        else{
            return view('errors.403');
        }
    }    


    

}
