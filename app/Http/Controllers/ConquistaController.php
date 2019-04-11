<?php

namespace App\Http\Controllers;

use App\Conquista;
use App\User;
use Illuminate\Http\Request;
use Gate;

class ConquistaController extends Controller
{
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ConquistaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $conquista;

    public function __construct(Conquista $conquista){
        $this->conquista = $conquista;        
    }

    private function medalhaSelectOption(){
        $medalhas = array(
            '<option value="conquista-ouro-1.png">Ouro Nível 1</option>',
            '<option value="conquista-ouro-2.png">Ouro Nível 2</option>',
            '<option value="conquista-ouro-3.png">Ouro Nível 3</option>',
            '<option value="conquista-ouro-4.png">Ouro Nível 4</option>',
            '<option value="conquista-ouro-5.png">Ouro Nível 5</option>',
            '<option value="conquista-prata-1.png">Prata Nível 1</option>',
            '<option value="conquista-prata-2.png">Prata Nível 2</option>',
            '<option value="conquista-prata-3.png">Prata Nível 3</option>',
            '<option value="conquista-prata-4.png">Prata Nível 4</option>',
            '<option value="conquista-prata-5.png">Prata Nível 5</option>',
        );

        return $medalhas;
    }

    private function medalhaImagem(){
        $medalhas = array (
            'conquista-ouro-1.png',
            'conquista-ouro-2.png',
            'conquista-ouro-3.png',
            'conquista-ouro-4.png',
            'conquista-ouro-5.png',
            'conquista-prata-1.png',
            'conquista-prata-2.png',
            'conquista-prata-3.png',
            'conquista-prata-4.png',
            'conquista-prata-5.png',
        );

        return $medalhas;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_conquista'))){
            $conquistas = Conquista::paginate(40); 

            //LOG ------------------------------------------------------------------------
            $this->log("conquista.index");
            //--------------------------------------------------------------------------------

            return view('conquista.index', array('conquistas' => $conquistas, 'buscar' => null));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_conquista'))){
            $buscaInput = $request->input('busca');

            $conquistas = Conquista::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ------------------------------------------------------------------------
            $this->log("conquista.ibusca=".$buscaInput);
            //--------------------------------------------------------------------------------

            return view('conquista.index', array('conquistas' => $conquistas, 'buscar' => $buscaInput ));
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
        if(!(Gate::denies('create_conquista'))){

            $medalhaSelectOption = $this->medalhaSelectOption();

            $medalhaImagem = $this->medalhaImagem();

            //LOG ------------------------------------------------------------------------------
            $this->log("conquista.create");
            //--------------------------------------------------------------------------------

            return view('conquista.create', compact('medalhaSelectOption', 'medalhaImagem'));                  
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
        if(!(Gate::denies('create_conquista'))){
            //Validação
            $this->validate($request,[
                    'titulo' => 'required|min:3|unique:conquistas',
                    'valor_conquista' => 'required',                    
                    'imagem_medalha' => 'required',
                    'icone_medalha' => 'required',
                    'descricao' => 'required|min:3',
                                  
            ]);            
                    
            $conquista = new Conquista();
            $conquista->titulo = $request->input('titulo');
            $conquista->valor_conquista = $request->input('valor_conquista');
            $conquista->imagem_medalha = $request->input('imagem_medalha');
            $conquista->icone_medalha = $request->input('icone_medalha');
            $conquista->descricao = $request->input('descricao');

            //LOG ------------------------------------------------------------------------
            $this->log("conquista.store=".$conquista);
            //--------------------------------------------------------------------------------

            if($conquista->save()){
                return redirect('conquistas/')->with('success', 'Conquista cadastrada com sucesso!');
            }else{
                return redirect('conquistas/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conquista  $conquista
     * @return \Illuminate\Http\Response
     */
    public function show(Conquista $conquista)
    {
        //
        if(!(Gate::denies('read_conquista'))){

            //LOG ------------------------------------------------------------------------
            $this->log("conquista.show.id=".$conquista);
            //--------------------------------------------------------------------------------

            return view('conquista.show', array('conquista' => $conquista));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conquista  $conquista
     * @return \Illuminate\Http\Response
     */
    public function edit(Conquista $conquista)
    {
        //
        if(!(Gate::denies('update_conquista'))){

            $medalhaSelectOption = $this->medalhaSelectOption();

            $medalhaImagem = $this->medalhaImagem();

            //LOG ------------------------------------------------------------------------
            $this->log("conquista.edit.id=".$conquista);
            //--------------------------------------------------------------------------------

            return view('conquista.edit', compact('conquista', 'medalhaSelectOption', 'medalhaImagem'));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conquista  $conquista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conquista $conquista)
    {
        //
        if(!(Gate::denies('update_conquista'))){

            //Validação
            $this->validate($request,[
                    'titulo' => 'required|min:3',
                    'valor_conquista' => 'required',                    
                    'imagem_medalha' => 'required',
                    'icone_medalha' => 'required',
                    'descricao' => 'required|min:3',      
            ]);
                    
            $conquista->titulo = $request->input('titulo');
            $conquista->valor_conquista = $request->input('valor_conquista');
            $conquista->imagem_medalha = $request->input('imagem_medalha');
            $conquista->icone_medalha = $request->input('icone_medalha');
            $conquista->descricao = $request->input('descricao');

            //LOG ------------------------------------------------------------------------
            $this->log("conquista.update=".$conquista);
            //----------------------------------------------------------------------------     

            if($conquista->save()){
                return redirect('conquistas/')->with('success', 'Conquista atualizada com sucesso!');
            }else{
                return redirect('conquistas/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conquista  $conquista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conquista $conquista)
    {
        //
        if(!(Gate::denies('delete_conquista'))){        
            
            $conquista->delete();


            //LOG ------------------------------------------------------------------------
            $this->log("conquista.destroy=".$conquista);
            //--------------------------------------------------------------------------------

            return redirect()->back()->with('success','Conquista excluída com sucesso!');
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }



    public function user($id)
    {
        //
        if(!(Gate::denies('update_conquista'))){

            $conquista = Conquista::find($id);

            $users = User::all();

            $conquista_users = $conquista->users()->get();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("conquista.create.user=".$conquista);
            //--------------------------------------------------------------------------------------



            return view('conquista.user', compact('conquista', 'users', 'conquista_users'));                  
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }


    public function userUpdate(Request $request)
    {
        //
        if(!(Gate::denies('update_conquista'))){

            //Validação
            $this->validate($request,[
                    'conquista_id' => 'required',               
            ]);     
            

            $users_id = $request->input('user_id');

            $conquista_id = $request->input('conquista_id');

            foreach ($users_id as $user_id) {
                //percorre o array e adiciona o conquista dos usuários
                $status = User::find($user_id)->conquista()->attach($conquista_id);
            }         


            //LOG----------------------------------------------------------------------------------
            $this->log("conquista.store.user.Userid=".(implode("", $users_id))."Conquista=".$conquista_id);
            //--------------------------------------------------------------------------------------
            
            if(!$status){
                return redirect('conquistas/'.$conquista_id.'/user')->with('success', 'Conquista adicionado com sucesso!');
            }else{
                return redirect('conquistas/'.$conquista_id.'/user')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function userDestroy(Request $request)
    {    
        if(!(Gate::denies('delete_conquista'))){

            /* -------------------- */

            $conquista_id = $request->input('conquista_id');
            $user_id = $request->input('user_id'); 

            $conquista  = Conquista::find($conquista_id);

            $status = $conquista->users()->detach($user_id);

            //LOG----------------------------------------------------------------------------------
            $this->log("conquista.sdestroy.user.Userid=".$user_id."Conquista=".$conquista);
            //--------------------------------------------------------------------------------------
            
            if($status){
                return redirect('conquistas/'.$conquista_id.'/user')->with('success', 'Conquista removida com sucesso!');
            }else{
                return redirect('conquistas/'.$conquista_id.'/user')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }
}
