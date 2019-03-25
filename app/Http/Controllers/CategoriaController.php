<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Sistema;
use App\User;
use Illuminate\Http\Request;
use Gate;

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_categoria'))){
            $categorias = Categoria::paginate(40);     

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.index");
            //--------------------------------------------------------------------------------------------

            return view('categoria.index', array('categorias' => $categorias, 'buscar' => null));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_categoria'))){
            $buscaInput = $request->input('busca');
            $categorias = Categoria::where('nome', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('part_number', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('serial_number', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('categoria.index', array('categorias' => $categorias, 'buscar' => $buscaInput ));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
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

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.create");
            //--------------------------------------------------------------------------------------------
        
            return view('categoria.create');
        }
        else{
            return redirect('erro')->with('permission_error', '403');
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
                    /*'part_number' => 'unique:categorias',*/
                    'serial_number' => '',
                    'descricao' => 'required|min:15',
            ]);
           
                    
            $categoria = new Categoria();
            $categoria->nome = $request->input('nome');
            $categoria->part_number = $request->input('part_number');
            $categoria->serial_number = $request->input('serial_number');
            $categoria->descricao = $request->input('descricao');

            if ($request->input('sistema_id')) {
                $categoria->sistema_id = $request->input('sistema_id');
            }
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.store");
            //--------------------------------------------------------------------------------------------

            if($categoria->save()){
                return redirect('categorias/')->with('success', 'Categoria cadastrado com sucesso!');
            }else{
                return redirect('categorias/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         if(!(Gate::denies('read_categoria'))){
            $categoria = Categoria::find($id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.show=".$id);
            //--------------------------------------------------------------------------------------------

            return view('categoria.show', array('categoria' => $categoria));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!(Gate::denies('update_categoria'))){            
            $categoria = Categoria::find($id);

            $sistemas = Sistema::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.edit=".$id);
            //--------------------------------------------------------------------------------------------

            return view('categoria.edit', compact('categoria','id', 'sistemas'));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!(Gate::denies('update_categoria'))){
            $categoria = Categoria::find($id);

            //Validação
            $this->validate($request,[
                    'nome' => 'required|min:3',
                    /*'part_number' => 'unique:categorias',*/
                    'serial_number' => '',
                    'descricao' => 'required|min:15',
                    //'sistema_id' => 'required',
            ]);                   
        
            
            $categoria->nome = $request->get('nome');
            $categoria->part_number = $request->get('part_number');
            $categoria->serial_number = $request->get('serial_number');
            $categoria->descricao = $request->get('descricao');

            if ($request->get('sistema_id')) {
                $categoria->sistema_id = $request->get('sistema_id');
            }

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.update=".$id);
            //--------------------------------------------------------------------------------------------


            if($categoria->save()){
                return redirect('categorias/')->with('success', 'Categoria atualizado com sucesso!');
            }else{
                return redirect('categorias/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!(Gate::denies('delete_categoria'))){
            $categoria = Categoria::find($id);        
            
            $categoria->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.destroy=".$id);
            //--------------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Categoria excluído com sucesso!');
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }


    /* ------------------------------ DASHBOARD --------------------------*/
    public function dashboard()
    {
        //
        if(!(Gate::denies('read_categoria'))){

            //carrega todos os sistemas Cadastrados
            $sistemas = Sistema::all(); 

            //Sistema Nomes

            foreach ($sistemas as $sistema_tmp) {
                $sistema_nome[$sistema_tmp->id] =  $sistema_tmp->nome;
            }

            /* --------------------Tickets por Sistema --------------------- */

            foreach ($sistemas as $sistema) {

                

                $categorias = Categoria::where('sistema_id', $sistema->id)->get();

                //Todos os TICKETs ABERTOS
                $sistema_ticket_qtd_abertos[$sistema->id]=0;
                foreach ($categorias as $categoria) {

                        $categoria_find = Categoria::find($categoria->id);
                    
                        $sistema_ticket_qtd_abertos[$sistema->id]+= $categoria_find
                                                                        ->tickets()
                                                                        ->where('status', '1')
                                                                        ->count();

                }

                //Todos os TICKETs FECHADOS
                $sistema_ticket_qtd_fechados[$sistema->id]=0;
                foreach ($categorias as $categoria) {

                        $categoria_find = Categoria::find($categoria->id);
                    
                        $sistema_ticket_qtd_fechados[$sistema->id]+= $categoria_find
                                                                        ->tickets()
                                                                        ->where('status', '0')
                                                                        ->count();

                }

            }

            /* --------------------- Verifica setor do usuário -------------------*/

            $usuario = User::find(auth()->user()->id);

            $setor = $usuario->setors()->first();


            if(!isset($setor)){
                return redirect('categorias/dashboard/')->with('danger', 'Vocẽ não está alocado em nenhum setor.');
            }
            
            /* ----------------------- END Verifica setor do usuário --------------------- */

            
            

            /* --------------------FIM Tickets por Sistema --------------------- */

            $categorias_inops = Categoria::where('status', 0)->orderBy('sistema_id')->get();


            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.dashboard");
            //--------------------------------------------------------------------------------------------



            return view('categoria.dashboard', compact('sistemas', 'sistema_ticket_qtd_abertos', 'sistema_ticket_qtd_fechados', 'categorias_inops', 'sistema_nome', 'setor'));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }
    /* ----------------------------- END DASHBOARD ---------------------*/

    /* ------------------------------ DASHBOARD SISTEMA --------------------------*/
    public function dashboardSistema($id)
    {
        
        //
        if(!(Gate::denies('read_categoria'))){

            //carrega todos os sistemas Cadastrados
            $sistema = Sistema::find($id); 

            $categorias = $sistema->categorias()->get();
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.dashboardsistema");
            //--------------------------------------------------------------------------------------------

            /* --------------------- Verifica setor do usuário -------------------*/

            $usuario = User::find(auth()->user()->id);

            $setor = $usuario->setors()->first();


            if(!isset($setor)){
                return redirect('categorias/dashboard/')->with('danger', 'Vocẽ não está alocado em nenhum setor.');
            }
            
            /* ----------------------- END Verifica setor do usuário --------------------- */



            return view('categoria.dashboardsistema', compact('sistema', 'categorias', 'setor', 'tickets'));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }
    /* ----------------------------- END DASHBOARD SISTEMA ---------------------*/


    public function status($id, $status, $sistema)
    {
        //
        if(!(Gate::denies('read_categoria'))){

            $categoria = Categoria::find($id);            
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.index.status=".$status);
            //--------------------------------------------------------------------------------------------

            $categoria->status = $status;            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("ticket.update.id=".$id);
            //--------------------------------------------------------------------------------------------

            if($categoria->save()){
                return redirect('categorias/dashboard/'.$sistema)->with('success', 'Status atualizado com sucesso!');
            }else{
                return redirect('categorias/dashboard/'.$sistema)->with('danger', 'Houve um problema, tente novamente.');
            }
        }


        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

}
