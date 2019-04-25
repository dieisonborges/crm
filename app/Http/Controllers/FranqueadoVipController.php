<?php

namespace App\Http\Controllers;

use App\FranqueadoVip;
use App\User;
use Illuminate\Http\Request;

use Gate;
use DB;

class FranqueadoVipController extends Controller
{
    



    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FranqueadoVipController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/


    private $franqueado_vip;

    public function __construct(FranqueadoVip $franqueado_vip){
        $this->franqueado_vip = $franqueado_vip;        
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(Gate::denies('read_franqueado_vip'))){
            
            $franqueado_vips = DB::table('franqueado_vips')
                    ->select(array('users.*', 'franqueado_vips.lider', 'franqueado_vips.id as vip_id'))
                    ->join('users', 'franqueado_vips.user_id', '=', 'users.id')
                    ->orderBy('lider', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado_vip.index=".$franqueado_vips);
            //---------------------------------------------------------------------------------------

            return view('franqueado_vip.index', array('franqueado_vips' => $franqueado_vips, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_franqueado_vip'))){

            $buscaInput = $request->input('busca');
        
            $franqueado_vips = DB::table('franqueado_vips')
                    ->select(array('users.*', 'franqueado_vips.lider', 'franqueado_vips.id as vip_id'))
                    ->join('users', 'franqueado_vips.user_id', '=', 'users.id')
                    ->where('users.apelido', 'LIKE', '%'.$buscaInput.'%')
                    ->where('users.name', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('users.email', 'LIKE', '%'.$buscaInput.'%')  
                    ->orwhere('users.cpf', 'LIKE', '%'.$buscaInput.'%')
                    ->orderBy('lider', 'DESC')
                    ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado_vips.busca=".$buscaInput);
            //---------------------------------------------------------------------------------------

            return view('franqueado_vip.index', array('franqueado_vips' => $franqueado_vips, 'buscar' => $buscaInput ));

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
        if(!(Gate::denies('create_franqueado_vip'))){

            $users = User::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueado_vip.create");
            //--------------------------------------------------------------------------------------

            return view('franqueado_vip.create', compact('users'));                  
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
        if(!(Gate::denies('create_franqueado_vip'))){

            //Validação
            $this->validate($request,[
                    'lider' => 'required',               
            ]);
            

            $users_id = $request->input('user_id');

            foreach ($users_id as $user_id) {
                //percorre o array e adiciona o franqueado_vip dos usuários
                $franqueado_vip = new FranqueadoVip();
                $franqueado_vip->lider = $request->input('lider');
                $franqueado_vip->user_id = $user_id;
                if($franqueado_vip->save()){
                    $status = true;
                }else{
                    $status = false;
                }
                        
            }         


            //LOG----------------------------------------------------------------------------------
            $this->log("franqueado_vip.store.Userid=".(implode("", $users_id))."FranqueadoVip=".$franqueado_vip);
            //--------------------------------------------------------------------------------------
            
            if($status){
                return redirect('franqueadoVip/')->with('success', 'FranqueadoVip adicionado com sucesso!');
            }else{
                return redirect('franqueadoVip/create')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FranqueadoVip  $franqueadoVip
     * @return \Illuminate\Http\Response
     */
    public function show(FranqueadoVip $franqueado_vip)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FranqueadoVip  $franqueadoVip
     * @return \Illuminate\Http\Response
     */
    public function edit(FranqueadoVip $franqueado_vip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FranqueadoVip  $franqueadoVip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FranqueadoVip $franqueado_vip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FranqueadoVip  $franqueadoVip
     * @return \Illuminate\Http\Response
     */
    public function destroy($franqueado_vip)
    {
        //
        if(!(Gate::denies('delete_franqueado_vip'))){

            $franqueado_vip = FranqueadoVip::find($franqueado_vip);            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("franqueadoVip.destroy=".$franqueado_vip);
            //--------------------------------------------------------------------------------------

            if($franqueado_vip->delete()){
                return redirect('franqueadoVip/')->with('success', 'FranqueadoVip destituído com sucesso!');
            }else{
                return redirect('franqueadoVip/')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return redirect('erro')->with('franquia_error', '403');
        }
    }
}
