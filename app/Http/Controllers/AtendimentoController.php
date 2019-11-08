<?php

namespace App\Http\Controllers;

use App\Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
//use Request;
use Gate;
use App\Ticket;
use App\User;
use App\Franquia;
use App\FranqueadoVip;
use App\Categoria;
use App\Setor; 
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;
use App\Upload;
use DB;
use Mail;

class AtendimentoController extends Controller
{
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="AtendimentoController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    //
    private $ticket; 

    public function __construct(Ticket $ticket){
        $this->ticket = $ticket;        
    }



    private function ticketRotulo()
    {
        //
        $rotulo = array(
                0   =>  "Crítico - Emergência (resolver imediatamente)",
                1   =>  "Alto - Urgência (resolver o mais rápido possível)",
                2   =>  "Médio - Intermediária (avaliar situação)",
                3   =>  "Baixo - Rotineiro ou Planejado",
                4   =>  "Nenhum",
            );

        return $rotulo;
    }

    private function ticketStatus()
    {
        //
        $status = array(
                0  => "Fechado",
                1  => "Aberto",                
            );

        return $status;
    }

    private function protocolo()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);


        return date("Y").$protocolo;
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

    private function weekBr(){
        /*
        Sunday      Domingo
        Monday      Segunda
        Tuesday     Terça
        Wednesday   Quarta
        Thursday    Quinta
        Friday      Sexta
        Saturday    Sábado
        */

        $week = array(
            'Sunday' => 'Domingo',
            'Monday' => 'Segunda',
            'Tuesday' => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday' => 'Quinta',
            'Friday' => 'Sexta',
            'Saturday' => 'Sábado',
        );

        return $week;
    }

    private function mailTicket($id, $msg){

        if(Auth::check()){

            $ticket = Ticket::find($id);

            $user_ticket = $ticket->users()->first();
            $user_email = $user_ticket->email;


                $msg_comp =     "<br> Nº do atendimento (ticket):".
                                $ticket->protocolo."<br>".
                                $ticket->titulo."<br>".
                                $ticket->descricao.
                                "<br>Para mais informações acesse <a href='https://ecardume.com'>ecardume.com</a> e acesse o CRM 7p e-cardume.<br><br><br>";


                $mailData = array(
                    'nome' => "CRM 7p e-Cardume | Atendimento",
                    'email' => "nao-responder@ecardume.com.br",
                    'assunto' => "Atendimento nº: ". $ticket->protocolo." |  ".$msg,
                    'msg' => "<h1>".$msg."</h1><br>".$msg_comp,
                );

                
                //Destinatario
                $mailFrom = array(
                            'email'     => $user_ticket->email,
                            'name'      => $user_ticket->apelido,
                            'subject'   => 'CRM 7p e-Cardume | Atendimento nº: '.$ticket->protocolo
                          );


                Mail::send('email.contato', $mailData, function ($m) use ($mailFrom) {
                    $m->from('atendimento@ecardume.com.br','CRM 7p e-Cardume | Relacionamento');
                    $m->to($mailFrom['email'], $mailFrom['name'])->subject($mailFrom['subject']);
                });

                return true;
        }else{
            return false;
        }

    }

    private function storeAcaoAuto($setor, $descricao, $ticket_id, $tipo_acao, $tipo_acao_cor)
    {

        //usuário
        $user_id = auth()->user()->id;

        $descricao .= '<br><span class="btn btn-'.$tipo_acao_cor.' btn-xs">'.$tipo_acao.'</span>';

        $ticket = Ticket::find($ticket_id);

        $status = $ticket->prontuarioTickets()->attach([[
            'ticket_id' => $ticket_id, 
            'user_id' => $user_id, 
            'descricao' => $descricao,
            'created_at' => date ("Y-m-d H:i:s"),
            'updated_at' => date ("Y-m-d H:i:s")
        ]]); 

        //LOG ----------------------------------------------------------------------------------------
        $this->log("tecnico.storeAcao:".$ticket_id);
        //--------------------------------------------------------------------------------------------

        

        if(!$status){

            //Email de Aviso
            $this->mailTicket($ticket_id, 'Houve alterações no seu atendimento.');

            return true;
        }else{
            return false;
        }
        
    }

    public function index($setor)
    {       

        //
        if(!(Gate::denies('read_'.$setor))){

            //usuário
            //$user_id = auth()->user()->id;

            //setor
            $setors = Setor::where('name', $setor)->limit(1)->get();

            foreach ($setors as $setor ) {
                $temp_setor = $setor;
            }

            $setor = $temp_setor;

            $tickets = $setor->tickets()
                                ->orderBy('id', 'DESC')
                                ->paginate(40);

            //LOG ----------------------------------------------
            $this->log("atendimento.index");
            //--------------------------------------------------

            return view('atendimento.index', array('setor' => $setor, 'tickets' => $tickets, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request, $setor){
        if(!(Gate::denies('read_'.$setor))){

            $buscaInput = $request->input('busca');

             //usuário
            //$user_id = auth()->user()->id;

            //setor
            $setors = Setor::where('name', $setor)->limit(1)->get();

            foreach ($setors as $setor ) {
                $temp_setor = $setor;
            }

            $setor = $temp_setor;

            $tickets = $setor->tickets()
                                ->where(function($query) use ($buscaInput) {
                                    $query->where('titulo','LIKE' , '%'.$buscaInput.'%')
                                    ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                    ->orwhere('protocolo', 'LIKE', '%'.$buscaInput.'%');
                                })
                                ->orderBy('id', 'DESC')
                                ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.index', array('tickets' => $tickets, 'buscar' => $buscaInput, 'setor' => $setor ));
        }
        else{
            return view('errors.403');
        }
    }

    public function status($setor, $status)
    {
        //
        if(!(Gate::denies('read_'.$setor))){

            //setor
            $setors = Setor::where('name', $setor)->limit(1)->get();

            foreach ($setors as $setor ) {
                $temp_setor = $setor;
            }

            $setor = $temp_setor;

            $tickets = $setor->tickets()                                
                                ->where('status', $status)
                                ->orderBy('id', 'DESC')
                                ->paginate(40);
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.index.status=".$status);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.index', array('tickets' => $tickets, 'buscar' => null, 'setor' => $setor));
        }


        else{
            return view('errors.403');
        }
    }

    public function buscaStatus($setor, $status)
    {
        //
        if(!(Gate::denies('read_'.$setor))){

            $buscaInput = $request->input('busca');

            //setor
            $setors = Setor::where('name', $setor)->limit(1)->get();

            foreach ($setors as $setor ) {
                $temp_setor = $setor;
            }

            $setor = $temp_setor;

            $tickets = $setor->tickets()
                                ->where(function($query) use ($buscaInput) {
                                    $query->where('titulo','LIKE' , '%'.$buscaInput.'%')
                                    ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                    ->orwhere('protocolo', 'LIKE', '%'.$buscaInput.'%');
                                })
                                ->where('status', $status)
                                ->orderBy('id', 'DESC')
                                ->paginate(40);
            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.status=".$status."busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.index', array('tickets' => $tickets, 'buscar' => $buscaInput, 'setor' => $setor ));
        }

        
        else{
            return view('errors.403');
        }
    }

    public function buscaStatusIdCategoria($setor, $categoria_id, $status)
    {
        
        //
        if(!(Gate::denies('read_'.$setor))){

            //setor
            $setors = Setor::where('name', $setor)->limit(1)->get();

            foreach ($setors as $setor ) {
                $temp_setor = $setor;
            }

            $setor = $temp_setor;

            $tickets = $setor->tickets()
                                ->where('categoria_id', $categoria_id)
                                ->where('status', $status)
                                ->orderBy('id', 'DESC')
                                ->paginate(40);

            $categoria = Categoria::find($categoria_id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.status.id=".$status."categoria_id=".$categoria_id);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.index', array('tickets' => $tickets, 'buscar' => $categoria->nome, 'setor' => $setor ));
        }

        
        else{
            return view('errors.403');
        }
    }

    public function show($setor, $id)
    {    
        //
        if(!(Gate::denies('read_'.$setor))){
            $ticket = Ticket::find($id);

            $ticket_user = $ticket->users()->first();

            $ticket_user_image = DB::table('imagem_user')
                                    ->select('uploads.*')
                                    ->join('uploads', 'uploads.id', 'imagem_user.upload_id')
                                    ->where('imagem_user.user_id', $ticket_user->id)
                                    ->orderBy('uploads.id', 'DESC')
                                    ->first();



            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            //Arquivos relacionados
            $uploads = $ticket->uploads()->get();

            //Rotulos
            $rotulos = $this->ticketRotulo();

            //Status
            $status = $this->ticketStatus();

            //Verifica o ticket em dias
            $data_aberto = $this->calcDatas(date('Y-m-d', strtotime($ticket->created_at)), date ("Y-m-d"));

            $prontuarios = $ticket->prontuarioTicketsShow()->get();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.show.ticket=".$ticket->id);
            //--------------------------------------------------------------------------------------------


            return view('atendimento.show', compact(
                                            'ticket_user_image',
                                            'ticket', 
                                            'rotulos', 
                                            'status', 
                                            'data_aberto', 
                                            'prontuarios', 
                                            'setor', 
                                            'uploads'));
        }
        else{
            return view('errors.403');
        }

    }

    public function edit($setor, $id)
    {
        //
        if(!(Gate::denies('update_'.$setor))){           
            $ticket = Ticket::find($id);  

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            //Rotulos
            $rotulos = $this->ticketRotulo();

            //Status
            $status = $this->ticketStatus();

            //recuperar todos equipapmentos
            $categorias = Categoria::all(); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.edit.id:".$id);
            //--------------------------------------------------------------------------------------------

            if($ticket->status==0){
                return view('errors.403');
            }else{
                return view('atendimento.edit', compact('ticket','id', 'rotulos', 'categorias', 'status', 'setor'));
            }

            
        }
        else{
            return view('errors.403');
        }
    }

    public function update(Request $request, $setor, $id)
    {
        //
        if(!(Gate::denies('update_'.$setor))){ 

            $ticket = Ticket::find($id);

            //Dados para amrazenamento de alterções
            $ticket_anterior = Ticket::find($id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            //Validação
            $this->validate($request,[
                    'rotulo' => 'required',
                    'titulo' => 'required|string|max:80',
                    /*'descricao' => 'required|string|min:15',*/
            ]);

            $ticket->rotulo = $request->get('rotulo');

            if ($request->get('categoria_id')) {
                $ticket->categoria_id = $request->get('categoria_id');
            }

            $ticket->titulo = $request->get('titulo');

            $ticket->descricao = $request->get('descricao');

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.edit.update.ticket".$id."-".$ticket);
            //--------------------------------------------------------------------------------------------

            if($ticket->save()){


                /* -----------Salva mudanças na acao----------- */

                $descricao_acao = "<b>Alterações:</b><br><br>";
                

                $ticketRotulo = $this->ticketRotulo();
                if(($ticketRotulo[$ticket_anterior->rotulo])!=($ticketRotulo[$request->get('rotulo')])){
                    $descricao_acao  = "Rótulo alterado de: <i style='color:red;'>";
                    $descricao_acao .= $ticketRotulo[$ticket_anterior->rotulo];
                    $descricao_acao .= "</i>";
                    $descricao_acao .= " Para: <i style='color:blue;'>";
                    $descricao_acao .= $ticketRotulo[$request->get('rotulo')];
                    $descricao_acao .= "</i>";
                    $descricao_acao .= "<br>";
                }

                if ($request->get('categoria_id')) {   

                    $categoria_anterior = Categoria::find($ticket_anterior->categoria_id);
                    $categoria_novo = Categoria::find($request->get('categoria_id'));

                    if(($categoria_anterior)!=($categoria_novo)){
                        $descricao_acao .= "Categoria alterado de: <i style='color:red;'>";
                        $descricao_acao .= "Nome: ".$categoria_anterior->nome." ID: ".$categoria_anterior->id;
                        $descricao_acao .= "</i>";
                        $descricao_acao .= " Para: <i style='color:blue;'>";             
                        $descricao_acao .= "Nome: ".$categoria_novo->nome." ID: ".$categoria_novo->id;
                        $descricao_acao .= "</i>";
                        $descricao_acao .= "<br>";
                    }

                }

                if(($ticket_anterior->titulo)!=($request->get('titulo'))){
                    $descricao_acao .= "Título alterado de: <i style='color:red;'>";
                    $descricao_acao .= $ticket_anterior->titulo;
                    $descricao_acao .= "</i>";
                    $descricao_acao .= " Para: <i style='color:blue;'>";
                    $descricao_acao .= $request->get('titulo');
                    $descricao_acao .= "</i>";                
                    $descricao_acao .= "<br>";
                }

                if(($ticket_anterior->descricao)!=($request->get('descricao'))){
                    $descricao_acao .= "Descrição alterado de: <i style='color:red;'>";
                    $descricao_acao .= $ticket_anterior->descricao;
                    $descricao_acao .= "</i>";
                    $descricao_acao .= " Para: <i style='color:blue;'>";
                    $descricao_acao .= $request->get('descricao');
                    $descricao_acao .= "</i>";
                }

                $tipo_acao="Alteração";
                $tipo_acao_cor="warning";

                $this->storeAcaoAuto($setor, $descricao_acao, $id, $tipo_acao, $tipo_acao_cor);
                /* -----------End Salva mudanças na acao----------- */

                //Email de Aviso
                $this->mailTicket($ticket->id, 'Houve alterações no seu atendimento.');


                return redirect('atendimentos/'.$setor.'/tickets')->with('success', 'Ticket atualizado com sucesso!');
            }else{
                return redirect('atendimentos/'.$setor.'/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }


    public function setors($setor, $id){

        $my_setor = $setor;

        if(!(Gate::denies('read_'.$setor))){  


            $ticket = $this->ticket->find($id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/


            //recuperar setors
            $setors = $ticket->setors()->get();

            //todos setores
            $all_setors = Setor::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.setor.ticket:".$id);
            //--------------------------------------------------------------------------------------------


            return view('atendimento.setor', compact('ticket', 'setors', 'all_setors', 'my_setor'));
        }
        else{
            return view('errors.403');
        }

    }

    public function setorUpdate(Request $request){
            $my_setor = $request->input('my_setor'); 

        if(!(Gate::denies('update_'.$my_setor))){              
                    
            $setor_id = $request->input('setor_id');
            $ticket_id = $request->input('ticket_id');

            $ticket  = Ticket::find($ticket_id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $my_setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            $status = Setor::find($setor_id)->setorTicket()->attach($ticket->id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.setorUpdate.setor_id:".$setor_id."ticket_id:".$ticket_id);
            //--------------------------------------------------------------------------------------------
          
            if(!$status){
                return redirect('atendimentos/'.$my_setor."/".$ticket_id.'/setors')->with('success', 'Setor (Regra) atualizada com sucesso!');
            }else{
                return redirect('atendimentos/'.$my_setor."/".$ticket_id.'/setors')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }


    public function setorDestroy(Request $request){

        $my_setor = $request->input('my_setor'); 

        if(!(Gate::denies('delete_'.$my_setor))){
            $setor_id = $request->input('setor_id');
            $ticket_id = $request->input('ticket_id');  

            $ticket = Ticket::find($ticket_id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $my_setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            $setor = Setor::find($setor_id);

            $status = $setor ->setorTicket()->detach($ticket->id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.setorDestroy.setor:".$setor->name);
            //--------------------------------------------------------------------------------------------

            
            if($status){
                return redirect('atendimentos/'.$my_setor."/".$ticket_id.'/setors')->with('success', 'Setor (Regra) atualizada com sucesso!');
            }else{
                return redirect('atendimentos/'.$my_setor."/".$ticket_id.'/setors')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function acao($setor, $id)
    {
        //
        if(!(Gate::denies('update_'.$setor))){           
            $ticket = Ticket::find($id); 

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.acao.setor:".$ticket->id);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.acao', array('ticket' => $ticket, 'setor' => $setor));
        }
        else{
            return view('errors.403');
        }
    }

    public function storeAcao(Request $request)
    {
        
        $setor = $request->input('setor');

        //
        if(!(Gate::denies('update_'.$setor))){ 
            //Validação
            $this->validate($request,[
                    'descricao' => 'required|string|min:15',
                    
            ]);

            $ticket_id = $request->input('ticket_id');

            //usuário
            $user_id = auth()->user()->id;

            $descricao = $request->input('descricao');

            $descricao .= '<br><span class="btn btn-primary btn-xs">Ação</span>';

            $ticket = Ticket::find($ticket_id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/



            $status = $ticket->prontuarioTickets()->attach([[
                'ticket_id' => $ticket_id, 
                'user_id' => $user_id, 
                'descricao' => $descricao,
                'created_at' => date ("Y-m-d H:i:s"),
                'updated_at' => date ("Y-m-d H:i:s")
            ]]); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.storeAcao:".$ticket_id);
            //--------------------------------------------------------------------------------------------

            if(!$status){

                //Email de Aviso
                $this->mailTicket($ticket_id, 'Houve alterações no seu atendimento.');

                return redirect('atendimentos/'.$setor.'/'.$ticket_id.'/show')->with('success', ' Ação adicionada com sucesso!');
            }else{
                return redirect('atendimentos/'.$setor.'/'.$ticket_id.'/acao')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function encerrar($setor, $id)
    {
        //
        if(!(Gate::denies('update_'.$setor))){           
            $ticket = Ticket::find($id); 

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.encerrar:".$id);
            //--------------------------------------------------------------------------------------------            

            return view('atendimento.encerrar', compact('ticket', 'setor'));
        }
        else{
            return view('errors.403');
        }
    }


    public function storeEncerrar(Request $request)
    {

        $setor = $request->input('setor');

        //
        if(!(Gate::denies('update_'.$setor))){  
            //Validação
            $this->validate($request,[
                    'descricao' => 'required|string|min:15',
                    
            ]);
                                 

            $ticket_id = $request->input('ticket_id');

            //usuário
            $user_id = auth()->user()->id;

            $descricao = $request->input('descricao');

            $descricao .= '<br><br><span class="btn btn-danger btn-xs">Fechado em: '.date("d/m/Y H:i:s").'</span>';

            $ticket = Ticket::find($ticket_id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            $status = $ticket->prontuarioTickets()->attach([[
                'ticket_id' => $ticket_id, 
                'user_id' => $user_id, 
                'descricao' => $descricao,
                'created_at' => date ("Y-m-d H:i:s"),
                'updated_at' => date ("Y-m-d H:i:s")
            ]]); 

            /* ----------------- Encerra -------------*/
            
            $ticket->status = 0;

            /* ---------------------- Encerra FIM ----------*/

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.storeEncerrar:".$ticket_id);
            //--------------------------------------------------------------------------------------------

            if((!$status)and($ticket->save())){

                //Email de Aviso
                $this->mailTicket($ticket_id, 'Seu ticket de atendimento foi encerrado!');

                return redirect('atendimentos/'.$setor.'/'.$ticket_id.'/show')->with('success', ' Ticket Encerrado com sucesso!');
            }else{
                return redirect('atendimentos/'.$setor.'/'.$ticket_id.'/acao')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function reabrir($setor, $id)
    {
        //
        if(!(Gate::denies('update_'.$setor))){           
            $ticket = Ticket::find($id); 

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.encerrar:".$id);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.reabrir', compact('ticket', 'setor'));
        }
        else{
            return view('errors.403');
        }
    }


    public function storeReabrir(Request $request)
    {

        $setor = $request->input('setor');

        //
        if(!(Gate::denies('update_'.$setor))){  
            //Validação
            $this->validate($request,[
                    'descricao' => 'required|string|min:15',
                    
            ]);
                                 

            $ticket_id = $request->input('ticket_id');

            //usuário
            $user_id = auth()->user()->id;

            $descricao = $request->input('descricao');

            $descricao .= '<br><br><span class="btn btn-success btn-xs">Reaberto em: '.date("d/m/Y H:i:s").'</span>';

            $ticket = Ticket::find($ticket_id);

            /* ------------------------------ Security --------------------------------*/
            //verifica se o setor tem permissão ao ticket
            $setors_security = $ticket->setors()->where('name', $setor)->first();

            if(!(isset($setors_security->id))){
                return view('errors.403');
            }
            /* ------------------------------ END Security --------------------------------*/

            $status = $ticket->prontuarioTickets()->attach([[
                'ticket_id' => $ticket_id, 
                'user_id' => $user_id, 
                'descricao' => $descricao,
                'created_at' => date ("Y-m-d H:i:s"),
                'updated_at' => date ("Y-m-d H:i:s")
            ]]); 

            /* ----------------- Reabre -------------*/
            
            $ticket->status = 1;

            /* ---------------------- Encerra FIM ----------*/

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.storeReabrir:".$ticket_id);
            //--------------------------------------------------------------------------------------------

            if((!$status)and($ticket->save())){

                //Email de Aviso
                $this->mailTicket($ticket_id, 'Seu ticket de atendimento foi reaberto!');

                return redirect('atendimentos/'.$setor.'/'.$ticket_id.'/show')->with('success', ' Ticket Reaberto com sucesso!');
            }else{
                return redirect('atendimentos/'.$setor.'/'.$ticket_id.'/acao')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }


    /* ------------------------------ DASHBOARD --------------------------*/
    public function dashboard($setor)
    {
        
        //
        if(!(Gate::denies('read_'.$setor))){
            /* ======================== FILTRO SETOR ======================== */
            $setor = Setor::where('name', $setor)->first();
            /* ======================== END FILTRO SETOR ==================== */

            /* .................... EQUIPE ...................*/
            $equipe = $setor->users()->get();
            $equipe_qtd = $setor->users()->count();     

            /* .................... END EQUIPE ................... */

            /* .................... QTD Tickets Abertos ................... */
            $qtd_tick_aber = $setor->tickets()                                
                                ->where('status', 1)
                                ->count();
            /* .................... END QTD Tickets Abertos ................... */

            /* .................... QTD Tickets FECHADOS ................... */
            $qtd_tick_fech = $setor->tickets()                                
                                ->where('status', 0)
                                ->count();
            /* .................... END QTD Tickets FECHADOS ................... */

            /* .................... TODOS Tickets ................... */
            $qtd_todos_tickets = $setor->tickets()->count();
            /* .................... END QTD TODOS Tickets ................... */

            /* .................... QTD Users ................... */
            $qtd_users = User::all()->count();
            /* .................... END QTD Users ................... */

            /* .................... QTD Users ................... */
            $qtd_franquias = Franquia::all()->count();
            /* .................... END QTD Users ................... */

            /* .................... QTD Users ................... */
            $qtd_franqueados_vip = FranqueadoVip::all()->count();
            /* .................... END QTD Users ................... */
            
            /* .................... Listagem de Tickets Abertos ................... */
            $tickets = $setor->tickets()                                
                                ->where('status', 1)
                                ->orderBy('id', 'DESC')
                                ->get();
            /* .................... END Tickets Abertos ................... */

            


            /* WEEK */
            $week = $this->weekBr();
            /* END WEEK */

            /* .................... QTD não alocados ................... */

            $tickets_aloc = Ticket::where('status', '1')->get();

            $cont_aloc = 0;

            foreach ($tickets_aloc as $ticket_aloc) {
                $flagTicket=0;
                $setors_aloc = $ticket_aloc->setors()->get();
                foreach ($setors_aloc as $setor_aloc) {
                    if(isset($setor_aloc->id)){
                        $flagTicket=1;
                    }
                }
                if($flagTicket==0){
                    $cont_aloc+=1;
                }
            }



            /* .................... END QTD não alocados ................... */

            /* ........................ Última Ação do Ticket Aberto .............*/

            foreach ($tickets as $ticket) {

                $ticket_prontuario = Ticket::find($ticket->id);
                $prontuarios[$ticket->id] = $ticket_prontuario->prontuarioTicketsShow()->orderBy('id', 'desc')->first();                
            }



            //dd($prontuarios);

            /* ........................ Última Ação do Ticket Aberto .............*/

            //LOG -----------------------------------------------
            $this->log("atendimento.dashboard");
            //---------------------------------------------------



            return view('atendimento.dashboard', compact(
                            'qtd_tick_fech', 
                            'qtd_tick_aber', 
                            'qtd_todos_tickets',
                            'qtd_users',
                            'qtd_franquias',
                            'qtd_franqueados_vip',
                            'setor',
                            'equipe',
                            'equipe_qtd',
                            'tickets',
                            'week',
                            'cont_aloc',
                            'prontuarios'
                        ));
        }
        else{
            return view('errors.403');
        }
    }
    /* ----------------------------- END DASHBOARD ---------------------*/

    public function alocar($setor)
    {
        
        //
        if(!(Gate::denies('read_'.$setor))){

            $tickets = Ticket::where('status', '1')->paginate();

            $setor = Setor::where('name', $setor)->first();

            foreach ($tickets as $ticket) {
                $flagTicket[$ticket->id]=0;
                $setors = $ticket->setors()->get();
                foreach ($setors as $setor_get) {
                    if(isset($setor_get->id)){
                        $flagTicket[$ticket->id]=1;
                    }
                }
            }

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.alocar");
            //--------------------------------------------------------------------------------------------

            return view('atendimento.alocar', compact(
                            'tickets',
                            'setor',
                            'flagTicket'
                        ));

        }
        else{
            return view('errors.403');
        }
    }

    public function alocarSetors($setor, $id){

        $my_setor = $setor;

        if(!(Gate::denies('read_'.$setor))){  


            $ticket = $this->ticket->find($id);

            //recuperar setors
            $setors = $ticket->setors()->get();

            //todos setores
            $all_setors = Setor::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.alocarSetors:".$id);
            //--------------------------------------------------------------------------------------------


            return view('atendimento.alocarsetor', compact('ticket', 'setors', 'all_setors', 'my_setor'));
        }
        else{
            return view('errors.403');
        }

    }

    public function alocarSetorUpdate(Request $request){

        $my_setor = $request->input('my_setor');

        if(!(Gate::denies('update_'.$my_setor))){              
                    
            $setor_id = $request->input('setor_id');
            $ticket_id = $request->input('ticket_id');

            $ticket  = Ticket::find($ticket_id);

            $status = Setor::find($setor_id)->setorTicket()->attach($ticket->id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.alocarSetorsUpdate:".$setor_id."Ticket".$ticket_id);
            //--------------------------------------------------------------------------------------------
          
            if(!$status){
                return redirect('atendimentos/'.$my_setor.'/dashboard')->with('success', 'Setor (Regra) atualizada com sucesso!');
            }else{
                return redirect('atendimentos/'.$my_setor.'/dashboard')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

    public function buscaData (Request $request, $setor){
        if(!(Gate::denies('read_'.$setor))){

            $buscaInput = $request->input('busca');

             //usuário
            //$user_id = auth()->user()->id;

            //setor
            $setors = Setor::where('name', $setor)->limit(1)->get();

            foreach ($setors as $setor ) {
                $temp_setor = $setor;
            }

            $setor = $temp_setor;

            $tickets = $setor->tickets()
                                ->where(function($query) use ($buscaInput) {
                                    $query->where('titulo','LIKE' , '%'.$buscaInput.'%')
                                    ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                    ->orwhere('protocolo', 'LIKE', '%'.$buscaInput.'%');
                                })
                                ->orderBy('id', 'DESC')
                                ->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("atendimento.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('atendimento.data', array('tickets' => $tickets, 'buscar' => $buscaInput, 'setor' => $setor ));
        }
        else{
            return view('errors.403');
        }
    }


}
