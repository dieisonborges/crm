<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
//use Request;
use Gate;
use App\Ticket;
use App\Categoria;
use App\Setor; 
use App\User;
use App\Upload; 
use App\FranqueadoVip; 
use DB;
use App\Cambio; 
use App\Carteira;

use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class ClientController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ClientController";

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
        $protocolo .= rand (0 , 9);


        return date("Y").$protocolo.date("m");
    }

    private function carteiraCodigo()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        return "TF".date("Y").$protocolo;
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

    public function index()
    {
        //
        if(auth()->user()->id){

        	//usuário
            $user_id = auth()->user()->id;

            $tickets = Ticket::where('user_id', $user_id)->orderBy('id', 'DESC')->paginate(40);

            //LOG -----------------------------------------------------------------
            $this->log("client.index");
            //---------------------------------------------------------------------

            return view('client.index', array('tickets' => $tickets, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(auth()->user()->id){

        	//usuário
            $user_id = auth()->user()->id;

            $buscaInput = $request->input('busca');           

			// ...
			$tickets = Ticket::where(function ($query) use ($buscaInput) {
			    $query->where('titulo','LIKE' , '%'.$buscaInput.'%')
			        ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('protocolo', 'LIKE', '%'.$buscaInput.'%');
			})->Where(function($query) use ($user_id) {
			    $query->where('user_id', $user_id);	
			})->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.index.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

			            				   
            return view('client.index', array('tickets' => $tickets, 'buscar' => $buscaInput ));
        }
        else{
            return view('errors.403');
        }
    }


    public function status($status)
    {
        //
        if(auth()->user()->id){

        	//usuário
            $user_id = auth()->user()->id;

            $tickets = Ticket::where('user_id', $user_id)                            
            				->where('status', $status)
                            ->orderBy('id', 'DESC')
            				->paginate(40);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.index.status=".$status);
            //--------------------------------------------------------------------------------------------

            return view('client.index', array('tickets' => $tickets, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function create()
    {
        //
        if(auth()->user()->id){
            $categorias = Categoria::all(); 

            //Rotulos
            $rotulos = $this->ticketRotulo();

            //Status
            $status = $this->ticketStatus();

            $setores = Setor::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.create");
            //--------------------------------------------------------------------------------------------


            return view('client.create', compact('categorias', 'rotulos', 'status', 'setores'));
        }
        else{
            return view('errors.403');
        } 


    }

    public function store(Request $request)
    {
        //
        if(auth()->user()->id){
            //Validação
            $this->validate($request,[
                    'setor' => 'required',
                    'titulo' => 'required|string|max:80',
                    'descricao' => 'required|string|min:15',
                    
            ]);

            $ticket = new Ticket();
            $ticket->status = 1;

            // Rotulos de Criticidade
            //    0   =>  "Crítico - Emergência (resolver imediatamente)",
            //    1   =>  "Alto - Urgência (resolver o mais rápido possível)",
            //    2   =>  "Médio - Intermediária (avaliar situação)",
            //    3   =>  "Baixo - Rotineiro ou Planejado",
            //    4   =>  "Nenhum",
            $ticket->rotulo = "2";

            if ($request->input('categoria_id')) {
                $ticket->categoria_id = $request->input('categoria_id');
            }

            $ticket->titulo = $request->input('titulo');

            $ticket->descricao = $request->input('descricao');
            

            //usuário
            $ticket->user_id = auth()->user()->id;

            //protocolo humano
            $ticket->protocolo = $this->protocolo();


            if($ticket->save()){

                $setores = $request->input('setor');

                $ticket_id = DB::getPdo()->lastInsertId();
                //Vincula tecnicos ao livro
                foreach ($setores as $setor) {
                    Ticket::find($ticket_id)->setors()->attach($setor);
            }

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.store");
            //-------------------------------------------------------------------------------------------- 

                return redirect('clients/1/status')->with('success', 'Ticket cadastrado com sucesso!');
            }else{
                return redirect('clients/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function show($id)
    {
        //
        if(auth()->user()->id){

        	//usuário
            $user_id = auth()->user()->id;

            $ticket = Ticket::where('id', $id)->where('user_id', $user_id)->limit(1)->first();

            $ticket_user_image = DB::table('imagem_user')
                                    ->select('uploads.*')
                                    ->join('uploads', 'uploads.id', 'imagem_user.upload_id')
                                    ->where('imagem_user.user_id', $ticket->id)
                                    ->orderBy('uploads.id', 'DESC')
                                    ->first();

            //Verifica permissão de acesso por usuário
            //Ao ticket
            if(!isset($ticket)){
            	return view('errors.403');
            }

            //Rotulos
            $rotulos = $this->ticketRotulo();

            //Status
            $status = $this->ticketStatus();

            //Verifica o ticket em dias
            $data_aberto = $this->calcDatas(date('Y-m-d', strtotime($ticket->created_at)), date ("Y-m-d"));

            $prontuarios = $ticket->prontuarioTicketsShow()->get();

            //Arquivos relacionados
            $uploads = $ticket->uploads()->get();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.show.id=".$id);
            //--------------------------------------------------------------------------------------------


            return view('client.show', compact(
                                        'ticket', 
                                        'rotulos', 
                                        'status', 
                                        'data_aberto', 
                                        'prontuarios', 
                                        'uploads', 
                                        'ticket_user_image'
                                    ));
        }
        else{
            return view('errors.403');
        }

    }

    public function acao($id)
    {
        //
         if(auth()->user()->id){            
            $ticket = Ticket::find($id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.acao=".$id);
            //--------------------------------------------------------------------------------------------

            return view('client.acao', compact('ticket'));
        }
        else{
            return view('errors.403');
        }
    }


    public function storeAcao(Request $request)
    {

        //
        if(auth()->user()->id){
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

            $status = $ticket->prontuarioTickets()->attach([[
                'ticket_id' => $ticket_id, 
                'user_id' => $user_id, 
                'descricao' => $descricao,
                'created_at' => date ("Y-m-d H:i:s"),
                'updated_at' => date ("Y-m-d H:i:s")
            ]]); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.store.acao.id=".$ticket_id);
            //--------------------------------------------------------------------------------------------

            if(!$status){
                return redirect('clients/'.$ticket_id)->with('success', ' Ação adicionada com sucesso!');
            }else{
                return redirect('clients/'.$ticket_id.'/acao')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function encerrar($id)
    {
        //
         if(auth()->user()->id){            
            $ticket = Ticket::find($id); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.encerrar.id=".$id);
            //--------------------------------------------------------------------------------------------

            return view('client.encerrar', compact('ticket'));
        }
        else{
            return view('errors.403');
        }
    }


    public function storeEncerrar(Request $request)
    {

        //
        if(auth()->user()->id){
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
            $this->log("client.store.encerrar.id=".$ticket_id);
            //--------------------------------------------------------------------------------------------

            if((!$status)and($ticket->save())){
                return redirect('clients/'.$ticket_id)->with('success', ' Ticket Encerrado com sucesso!');
            }else{
                return redirect('clients/'.$ticket_id.'/acao')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }


    public function perfil(){
        //
        if(Auth::id()){

            $user_id = auth()->user()->id;

            $user = User::where('id', $user_id)->first();

            /* ------------ Score do Usuário ----------- */
            $scores = $user->scores()->paginate(40);  

            $user_score = DB::table('scores')
                    ->select(array('users.*', DB::raw('sum(scores.valor) as valor')))
                    ->join('users', 'scores.user_id', '=', 'users.id')
                    ->where('users.id', $user_id)                   
                    ->groupBy('scores.user_id')
                    ->orderBy('valor', 'asc')
                    ->first();  

            /* ------------ Conquistas do Usuário ----------- */      

            $conquistas = $user->conquista()->get();     


            /* ------------ FOTO PERFIL -------------------- */

            $imagem = $user->uploads()->orderBy('id', 'DESC')->first();

            /* ---------------- VIP e VIP Líder ----------- */

            $franqueadoVip = $user->franqueadoVip()->first();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("client.index=".$scores);
            //---------------------------------------------------------------------------------------

            return view('client.perfil', compact('scores', 'user', 'user_score', 'conquistas', 'imagem', 'franqueadoVip'));
        }
        else{
            return view('errors.403');
        }


    }

    public function imagem()
    {
        //
        if(Auth::id()){  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("upload.imagem.client=".(Auth::id()));
            //--------------------------------------------------------------------------------------------

            return view('client.imagem');
        }
        else{
            return view('errors.403');
        }
    }

    public function imagemUpdate(Request $request)
    {
        if(Auth::id()){

            //Validação
            $this->validate($request,[
                    'file' => 'required|mimes:jpeg,png,jpg,pdf',
            ]);

            $dir = "files/"."client".'/'.(Auth::id());

            $id = Auth::id();

            $area = "client";

            /* -------------------------------- UPLOAD --------------------*/

            $file = $request->file('file');

            // Se informou o arquivo, retorna um boolean
            //$file = $request->hasFile('file');
             
            // Se é válido, retorna um boolean
            //$file = $request->file('file')->isValid();

            // Retorna mime type do arquivo (Exemplo image/png)
            $tipo = $request->file('file')->getMimeType();
             
            // Retorna o nome original do arquivo
            $nome = $request->file('file')->getClientOriginalName();
             
            // Extensão do arquivo
            //$request->file('file')->getClientOriginalExtension();
            $ext = $request->file('file')->extension();
             
            // Tamanho do arquivo
            $tam = $request->file('file')->getClientSize();

            // Define um aleatório para o arquivo baseado no timestamps atual
            $link = uniqid(date('HisYmd'));

            // Define finalmente o nome
            $link = "{$link}.{$ext}";

            // Faz o upload:
            $upload = $request->file->storeAs($dir, $link);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao


            /* -------------------------------- END UPLOAD --------------------*/

                    
            $upload = new Upload();
            $upload->titulo = "Perfil de Usuário";
            $upload->dir = $dir;
            $upload->link = $link;
            $upload->tipo = $tipo;
            $upload->nome = $nome;
            $upload->ext = $ext;
            $upload->tam = $tam;

            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("perfil.imagem.store=".$request);
            //--------------------------------------------------------------------------------------------

            if($upload->save()){

                /* ------------Vinculo do Arquivo------------- */

                $upload_id = DB::getPdo()->lastInsertId();

                
                $status = User::find($id)->uploads()->attach($upload_id);
                               

                /* ------------END Vinculo do Arquivo------------- */

                return redirect('clients/perfil')->with('success', 'Imagem Alterada com Sucesso!.');
            }else{
                return redirect('uploads/'.$id.'/create/'.$area)->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }

    public function carteira()
    {        

        //
        if(Auth::id()){

            $user = Auth::id();

            $user = User::find($user);            

            $carteiras = $user->carteira()->orderBy('carteiras.id','DESC')->paginate(40); 

            /* -------- Saldo da Carteira ---------- */
            $saldo = $user->carteira()
                        ->select( DB::raw('sum( carteiras.valor ) as valor') )
                        ->where('carteiras.status','3')
                        ->first(); 

            if((isset($saldo))){
                $saldo = $saldo->valor;
            }else{
                $saldo = 0;
            }

            //Taxa de Cambio
            $cambio_atual = Cambio::orderBy('id', 'DESC')->first();
            if((isset($cambio_atual))){
                $cambio_atual = $cambio_atual->valor;
            }else{
                $cambio_atual = 9999999;
            }

            //Valor Efetivo Total
            $vets = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vets))){
                $vets = $vets->valor;
            }else{
                $vets = 9999999;
            }


            //LOG ------------------------------------------------------
            $this->log("client.carteira.user=".$user->id);
            //----------------------------------------------------------

            return view('client.carteira', array(
                            'carteiras' => $carteiras, 
                            'user' => $user, 
                            'saldo' => $saldo,
                            'cambio_atual' => $cambio_atual,
                            'vets' => $vets,
                            'buscar' => null
                            ));
        }
        else{
            return view('errors.403');
        }
    }


    public function recarregar(Request $request)
    {
        //
        if(Auth::id()){  

            //LOG -------------------------------------------------
            $this->log("client.recarregar=".(Auth::id()));
            //-----------------------------------------------------

            return view('client.recarregar');
        }
        else{
            return view('errors.403');
        }
    }

    public function recarregarStore(Request $request)
    {

        //
        if(auth()->user()->id){
            //Validação
            $this->validate($request,[
                    'recarga' => 'required|numeric|min:10',                    
            ]);                                 

            $recarga = $request->input('recarga');

            //usuário
            $user = User::find(auth()->user()->id);

            /* ----------- Armazena e Recupera a Recarga  -------- */

            //Taxa de Cambio
            $cambio_atual = Cambio::orderBy('id', 'DESC')->first();
            if((isset($cambio_atual))){
                $cambio_atual = $cambio_atual->valor;
            }else{
                $cambio_atual = 9999999;
            }

            //VET
            //Valor Efetivo Total
            $vets = DB::table('vets')->orderBy('id', 'DESC')->first();
            if((isset($vets))){
                $vet = $vets->valor;
            }else{
                $vet = 9999999;
            }

            /* -------- Saldo da Carteira ---------- */
            $saldo = $user->carteira()
                        ->select( DB::raw('sum( carteiras.valor ) as valor') )
                        ->where('carteiras.status','3')
                        ->first();  

            if((isset($saldo))){
                $saldo = $saldo->valor;
            }else{
                $saldo = 0;
            }

            $carteira = new Carteira();
            $carteira->codigo = $this->carteiraCodigo();
            $carteira->valor = $request->input('recarga');
            $carteira->dolar = $cambio_atual;
            $carteira->vet = $vet;
            $carteira->status = 0;
            $carteira->user_id = $user->id;

            $carteira->descricao = "Solicitação de recarga gerada pelo usuário.";

            $carteiraSave = $carteira->save();

            /* ----------- FIM Armazena e Recupera a Recarga  -------- */

            /* ----------- Gera um ticket da Recarga  -------- */

            if($carteiraSave){

                $ticket = new Ticket();

                // 1 - Aberto/Ativo
                // 0 - Fechado/Encerrado
                $ticket->status = 1;

                // Rotulos de Criticidade
                //    0   =>  "Crítico - Emergência (resolver imediatamente)",
                //    1   =>  "Alto - Urgência (resolver o mais rápido possível)",
                //    2   =>  "Médio - Intermediária (avaliar situação)",
                //    3   =>  "Baixo - Rotineiro ou Planejado",
                //    4   =>  "Nenhum",
                $ticket->rotulo = "3";                

                $ticket->titulo = "Recarga #".$carteira->codigo;

                $ticket->descricao = "
                        Solicitação de Recarga <br><br>
                        Gerada pelo usuário<br>
                        Código: ".$carteira->codigo." <br>
                        Valor: ".$request->input('recarga')." <br>
                        Câmbio: ".$cambio_atual." <br>
                        VET: ".$vet." <br>
                ";                

                //usuário
                $ticket->user_id = auth()->user()->id;

                //protocolo humano
                $ticket->protocolo = $this->protocolo();


                if($ticket->save()){
                    $ticket_id = DB::getPdo()->lastInsertId();

                    //Vincula Ticket com Setor
                    $setor = Setor::where('name', 'financeiro')->first();
                    Ticket::find($ticket_id)->setors()->attach($setor);    

                    //Vincula Ticket com Carteira
                    $carteira = Carteira::where('codigo', $carteira->codigo)->first();
                    Ticket::find($ticket_id)->carteira()->attach($carteira);

                }


                /* ----------- FIM Gera um ticket da Recarga  -------- */
                

                //LOG --------------------------------------------------------
                $this->log("client.recargaStore.id=".$user->id."| Recarga=".$recarga);
                //------------------------------------------------------------

                
                return redirect('clients/carteira')->with('success', ' Pedido de recarga efetuado com sucesso!');

            }else{
                return redirect('clients/recarregar')->with('danger', 'Houve um problema, tente novamente.');
            }
        
        }else{
            return view('errors.403');
        }
    }

}
