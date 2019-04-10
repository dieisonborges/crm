<?php

namespace App\Http\Controllers;

use App\Score;
use App\User;
use Illuminate\Http\Request;
use Gate;
use DB;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class ScoreController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ScoreController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private $score;

    public function __construct(Score $score){
        $this->score = $score;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(Gate::denies('read_score'))){
            
            $scores = DB::table('scores')
                    ->select(array('users.*', DB::raw('sum(scores.valor) as valor')))
                    ->join('users', 'scores.user_id', '=', 'users.id')                    
                    ->groupBy('scores.user_id')
                    ->orderBy('valor', 'asc')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("score.index=".$scores);
            //---------------------------------------------------------------------------------------

            return view('score.index', array('scores' => $scores, 'buscar' => null));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }

    }

    public function busca (Request $request){
        if(!(Gate::denies('read_score'))){

            $buscaInput = $request->input('busca');
        
            $scores = DB::table('scores')
                    ->select(array('users.*', DB::raw('sum(scores.valor) as valor')))
                    ->join('users', 'scores.user_id', '=', 'users.id')
                    ->where('users.apelido', 'LIKE', '%'.$buscaInput.'%')
                    ->where('users.name', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('users.email', 'LIKE', '%'.$buscaInput.'%')  
                    ->orwhere('users.cpf', 'LIKE', '%'.$buscaInput.'%')                  
                    ->groupBy('scores.user_id')
                    ->orderBy('valor', 'asc')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("scores.busca=".$buscaInput);
            //---------------------------------------------------------------------------------------

            return view('score.index', array('scores' => $scores, 'buscar' => $buscaInput ));

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
        if(!(Gate::denies('create_score'))){

            $users = User::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("score.create");
            //--------------------------------------------------------------------------------------

            return view('score.create', compact('users'));                  
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
        if(!(Gate::denies('create_score'))){

            //Validação
            $this->validate($request,[
                    'motivo' => 'required|min:3',
                    'valor' => 'required|min:-100|max:100',                
            ]);

            
                    
            

            $users_id = $request->input('user_id');

            foreach ($users_id as $user_id) {
                //percorre o array e adiciona o score dos usuários
                $score = new Score();
                $score->motivo = $request->input('motivo');
                $score->valor = $request->input('valor'); 
                $score->user_id = $user_id;
                if($score->save()){
                    $status = true;
                }else{
                    $status = false;
                }
                        
            }         


            //LOG----------------------------------------------------------------------------------
            $this->log("score.store.Userid=".(implode("", $users_id))."Score=".$score);
            //--------------------------------------------------------------------------------------
            
            if($status){
                return redirect('scores/')->with('success', 'Score adicionado com sucesso!');
            }else{
                return redirect('scores/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        //
        if(!(Gate::denies('read_score'))){

            $user = User::where('id', $user_id)->first();

            $scores = $user->scores()->paginate(40);  

            $user_score = DB::table('scores')
                    ->select(array('users.*', DB::raw('sum(scores.valor) as valor')))
                    ->join('users', 'scores.user_id', '=', 'users.id')
                    ->where('users.id', $user_id)                   
                    ->groupBy('scores.user_id')
                    ->orderBy('valor', 'asc')
                    ->first();         
            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("score.index=".$scores);
            //---------------------------------------------------------------------------------------

            return view('score.show', compact('scores', 'user', 'user_score'));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
