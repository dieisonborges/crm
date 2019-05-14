<?php

namespace App\Http\Controllers;

use App\Convite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate;
use Mail;
use Carbon\Carbon;
class ConviteController extends Controller
{
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ConviteController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    private function conviteCodeGenerator()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        return "C".date("Ymd").$protocolo;
    }

    private function calcDatas($data_ini, $data_fim){
        //Compara duas datas e retorna a diferença entre dias
        //$data_ini = "2013-08-01";
        //$data_fim = "2013-08-16";
        $diferenca = strtotime($data_fim) - strtotime($data_ini);
        //Calcula a diferença em dias
        $dias = floor($diferenca / (60 * 60 * 24));
        return $dias;
    }

    public function index(){

        return view('errors.419');

        if(!(Gate::denies('read_convite'))){
            $convites = Convite::paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.index");
            //--------------------------------------------------------------------------------------------

            return view('convite.index', array('convites' => $convites, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    // Seleciona por id
    public function show($id){
        if(!(Gate::denies('read_convite'))){
            $convite = Convite::find($id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.show.id=".$id);
            //--------------------------------------------------------------------------------------------
           

            return view('convite.show', array('convite' => $convite));
        }
        else{
            return view('errors.403');
        }

    }

    public function busca (Request $request){
        if(!(Gate::denies('read_convite'))){
            $buscaInput = $request->input('busca');

            $convites = Convite::where('codigo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('email', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.ibusca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('convite.index', array('convites' => $convites, 'buscar' => $buscaInput ));
        }
        else{
            return view('errors.403');
        }
    }

    // Criar
    public function create(){
        if(!(Gate::denies('create_convite'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.create");
            //--------------------------------------------------------------------------------------------

            return view('convite.create');                  
        }
        else{
            return view('errors.403');
        }
    }

    // Criar
    public function store(Request $request){

        if(!(Gate::denies('create_convite'))){
            //Validação
            $this->validate($request,[
                    'email' => 'required|min:3',               
            ]);

                                
            $convite = new Convite();
            $convite->email = $request->input('email');
            $convite->codigo = $this->conviteCodeGenerator();

            $mail_to = $request->input('email');

            $msg="                
                Para iniciar o acesso à plataforma de relacionamento clique no link abaixo, e confirme os dados: <br><br>
                Código: <b>".$convite->codigo."</b> <br>
                E-mail: <b>".$mail_to."</b> <br><br>
                Gerado em: <b>".date("d/m/Y às H:m")."</b><br><br>               
                link: ".url('/register')."  
                <br><br><br>
                <span style='color:red;'>*O convite expira em 48 horas</span>
                <br><br><br>           
            ";

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.store");
            //--------------------------------------------------------------------------------------------

            if($convite->save()){

                $mailData = array(
                    'nome' => "CRM e-Cardume | Relacionamento",
                    'email' => "atendimento@ecardume.com.br",
                    'assunto' => "Parabéns! Você recebeu um convite e-Cardume",
                    'msg' => $msg,
                );

                
                //Destinatario
                $mailFrom = array(
                            'email'     => $mail_to,
                            'name'      => 'Convidado',
                            'subject'   => 'CRM e-Cardume | Relacionamento'
                          );


                Mail::send('email.contato', $mailData, function ($m) use ($mailFrom) {
                    $m->from('atendimento@ecardume.com.br','CRM e-Cardume | Relacionamento');
                    $m->to($mailFrom['email'], $mailFrom['name'])->subject($mailFrom['subject']);
                });

                return redirect('convites/')->with('success', 'Convite (Regra) cadastrada com sucesso!');
            }else{
                return redirect('convites/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

    public function updateStatus($id, $status){

        if(!(Gate::denies('update_convite'))){
            

            $convite = Convite::find($id);            

            $convite->status = $status;

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.update.status=".$status);
            //--------------------------------------------------------------------------------------

            if($convite->save()){
                return redirect('convites/')->with('success', 'Convite (atualizado com sucesso!');
            }else{
                return redirect('convites/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

    public function destroy($id){
        if(!(Gate::denies('read_convite'))){
            $convite = Convite::find($id);        
            
            $convite->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.destroy.id=".$id);
            //--------------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Convite excluído com sucesso!');

        }
        else{
            return view('errors.403');
        }
    }


    // Criar
    public function reenviar($id){

        if(!(Gate::denies('read_convite'))){
            
            $convite = Convite::find($id);

            $mail_to = $convite->email;

            $msg="                
                Para iniciar o acesso à plataforma de relacionamento clique no link abaixo, e confirme os dados: <br><br>
                Código: <b>".$convite->codigo."</b> <br>
                E-mail: <b>".$mail_to."</b> <br><br>
                Gerado em: <b>".date("d/m/Y às H:m")."</b><br><br>               
                link: ".url('/register')."  
                <br><br><br>
                <span style='color:red;'>*O convite expira em 48 horas</span>
                <br><br><br>           
            ";

            //LOG ----------------------------------------------------------------------------------------
            $this->log("convite.reenviar.=".$convite);
            //--------------------------------------------------------------------------------------------


            /* ----------------------- Atualizar data e hora do convite ------------------------------*/
            $convite->created_at = Carbon::now();
            $convite->updated_at = Carbon::now();
            $convite->save();

            /* ----------------------- END Atualizar data e hora do convite ------------------------------*/

            $mailData = array(
                'nome' => "CRM e-Cardume | Relacionamento",
                'email' => "atendimento@ecardume.com.br",
                'assunto' => "Parabéns! Você recebeu um convite e-Cardume",
                'msg' => $msg,
            );

            
            //Destinatario
            $mailFrom = array(
                        'email'     => $mail_to,
                        'name'      => 'Convidado',
                        'subject'   => 'CRM e-Cardume | Relacionamento'
                      );


            $status = Mail::send('email.contato', $mailData, function ($m) use ($mailFrom) {
                $m->from('atendimento@ecardume.com.br','CRM e-Cardume | Relacionamento');
                $m->to($mailFrom['email'], $mailFrom['name'])->subject($mailFrom['subject']);
            });

            if(!$status){
                return redirect('convites/')->with('success', 'Convite reenviado com sucesso!');
            }else{
                return redirect('convites/')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }





}
