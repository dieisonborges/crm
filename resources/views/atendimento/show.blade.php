@can('read_atendimento')      
	@extends('layouts.app')
	@section('title', 'Visualizar Ticket')
	@section('content')

        <a href="#footer" class="btn btn-primary" style="float: right;"><span class="fa fa-arrow-down"></span></a>

			  <h1>
		        Ticket 
		        <small>{{$ticket->protocolo}}</small>
		    </h1>

		    <div class="box-body col-md-4">              
              <div class="callout callout-info">
                <h5>Usuário: <b>{{$ticket->users->name}}</b></h5>
                <h5>Número de Protocolo: <b>{{$ticket->protocolo}}</b></h5>
                <h5>Aberto em: <b>{{date('d/m/Y H:i:s', strtotime($ticket->created_at))}}</b></h5>
                <h5>Dias abertos: <b>{{ number_format($data_aberto, 0) }}</b></h5>
              </div>
        </div>	

			 	<div class="form-group col-md-4">
				    <label for="status">Status</label>
				    <!--
                    0  => "Fechado",
                    1  => "Aberto",  
                    -->
                    
                    @switch($ticket->status)
                        @case(0)
                            <span class="btn btn-flat btn-success btn-md col-md-12">Fechado</span>
                            @break                                                               
                        @default
                            <span class="btn btn-flat btn-warning btn-md col-md-12">Aberto</span>
                    @endswitch
                	
				    
			 	</div>

			 	<div class="form-group col-md-4">					
				    <label for="rotulo">Rótulo (Criticidade)</label>
							<!--
                            0   =>  "Crítico - Emergência (resolver imediatamente)",
                            1   =>  "Alto - Urgência (resolver o mais rápido possível)",
                            2   =>  "Médio - Intermediária (avaliar situação)",
                            3   =>  "Baixo - Rotineiro ou Planejado",
                            -->
                            @switch($ticket->rotulo)
                                @case(0)
                                    <span class="btn btn-flat btn-danger btn-md col-md-12">Crítico - Emergência (resolver imediatamente)</span>
                                    @break
                                @case(1)
                                    <span class="btn btn-flat btn-warning btn-md col-md-12">Alto - Urgência (resolver o mais rápido possível)</span>
                                    @break
                                @case(2)
                                    <span class="btn btn-flat bg-purple btn-md col-md-12">Médio - Intermediária (avaliar situação)</span>
                                    @break
                                @case(3)
                                    <span class="btn btn-flat bg-navy btn-md col-md-12">Baixo - Rotineiro ou Planejado</span>
                                    @break
                                @case(4)
                                    <span class="btn btn-flat btn-info btn-md col-md-12">Nenhum</span>
                                    @break
                                @break                           

                            @endswitch
			 	</div>			 	


			 	<div class="form-group col-md-8">
				    <label for="categoria_id">Categoria</label>
            @if($ticket->categoria_id)
				    <span class="col-md-12 form-control">{{$ticket->categorias->nome}}</span>
            @else
            <span class="col-md-12 form-control">Nenhum</span>
            @endif
				    
			 	</div>
		 	

			 	<!--<a href="javascript:history.go(-1)">Voltar</a>-->


				<div class="col-md-12">
					<div class="box box-default">
					<div class="box-header with-border">
						<i class="fa fa-warning"></i>
						<h3 class="box-title">Ações</h3>

					</div>
					<!-- /.box-header -->

					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->




			
    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    {{date('d M. Y', strtotime($ticket->created_at))}}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-ticket-alt bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> {{date('H:i:s', strtotime($ticket->created_at))}}</span>


                <h3 class="user-header timeline-header">  
                                
                        @if($ticket_user_image)
                            <img src="{{url('storage/'.$ticket_user_image->dir.'/'.$ticket_user_image->link)}}" class="img-circle" alt="User Image" width="30px" height="30px"> 
                        @else
                            <img src="{{ asset('img/default-user-image.png') }}" class="img-circle" alt="User Image" width="30px" height="30px"> 
                        @endif
                        <a href="#">{{$ticket->users->apelido}}</a> 

                        

                        <!-- Setores de Trabalho -->
                        @foreach(($ticket->users->setors) as $setor)
                            <span class="btn btn-default btn-xs"><i class="fa fa-fish text-aqua"></i> {{$setor->label}}</span>
                        @endforeach
                        <!-- END Setores de Trabalho -->

                        <!-- VIP -->
                        @php
                        $lider = $ticket->users->franqueadoVip->first();
                        @endphp

                        @if($lider)
                            <img src="{{asset('img/conquistas/conquistas-vip.png')}}" width="90px" alt="e-Cardume VIP">
                            @if($lider->lider)
                                <img src="{{asset('img/conquistas/conquistas-lider.png')}}" width="90px" alt="e-Cardume Líder VIP">
                            @endif
                        @endif
                        <!-- END VIP -->



                        <br><br>
                        {{$ticket->titulo}}                    
                </h3>

                <div class="timeline-body">
                 {!!html_entity_decode($ticket->descricao)!!}
                </div>
                <div class="timeline-footer">
                  <span class="btn btn-warning btn-xs">Abertura</span>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            @foreach ($prontuarios as $prontuario)
                <!-- timeline time label -->
                <li class="time-label">
                      <span class="bg-red">
                        {{date('d M. Y', strtotime($prontuario->created_at))}}
                      </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-comments  bg-gray"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{date('H:i:s', strtotime($prontuario->created_at))}}</span>

                    @php
                    //Socorro
                    //Resolver esse código
                    //Está horrível

                    $prontuario_user = $prontuario->users()->first();

                    $prontuario_user_image = DB::table('imagem_user')
                                            ->select('uploads.*')
                                            ->join('uploads', 'uploads.id', 'imagem_user.upload_id')
                                            ->where('imagem_user.user_id', $prontuario_user->id)
                                            ->orderBy('uploads.id', 'DESC')
                                            ->first();

                    @endphp

                    <h3 class="user-header timeline-header">   

                        @if($ticket_user_image)
                            <img src="{{url('storage/'.$prontuario_user_image->dir.'/'.$prontuario_user_image->link)}}" class="img-circle" alt="User Image" width="30px" height="30px"> 
                        @else
                            <img src="{{ asset('img/default-user-image.png') }}" class="img-circle" alt="User Image" width="30px" height="30px"> 
                        @endif

                            <a href="#">{{$prontuario->users->apelido}}</a>

                            @foreach($prontuario->users->setors as $setor)
                                <span class="btn btn-default btn-xs"><i class="fa fa-fish text-aqua"></i> {{$setor->label}}</span>
                            @endforeach 


                            <!-- VIP -->
                            @php
                            $lider = $prontuario->users->franqueadoVip->first();
                            @endphp

                            @if($lider)
                                <img src="{{asset('img/conquistas/conquistas-vip.png')}}" width="90px" alt="e-Cardume VIP">
                                @if($lider->lider)
                                    <img src="{{asset('img/conquistas/conquistas-lider.png')}}" width="90px" alt="e-Cardume Líder VIP">
                                @endif
                            @endif
                            <!-- END VIP -->

                    </h3>

                    <div class="timeline-body">
                     {!!html_entity_decode($prontuario->descricao)!!}
                                      
                  </div>
                </li>
                <!-- END timeline item -->
            @endforeach 
            
            
            <!-- timeline item -->
            
            

            @if (($ticket->status)==1)

            <li>
              <i class="fa fa-clock bg-gray"></i>
            </li>

            

            @else

            <!-- -------------- ENCERRAMENTO ------------- -->

            

            <!-- timeline time label -->
            
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-times bg-gray"></i>
              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Encerrado</a></h3>
              </div>
            </li>
            <!-- END timeline item -->

            <li>
              <i class="fa fa-flag-checkered bg-green"></i>
            </li>

            <!-- -------------- FIM ENCERRAMENTO ------------- -->
    
            @endif  

          </ul>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
    <section class="content">

    @if (($ticket->status)==1)

      <a  class="btn btn-warning btn-md" href="{{URL::to('atendimentos/'.$setor.'/'.$ticket->id.'/edit')}}"><i class="fa fa-edit"></i> Editar Ticket</a>
    
      <a href="{{URL::to('atendimentos')}}/{{$setor}}/{{$ticket->id}}/acao"  class="btn btn-info btn-md"><i class="fa fa-plus-circle"></i> Nova Ação</a>

      <a href="{{URL::to('atendimentos')}}/{{$setor}}/{{$ticket->id}}/encerrar" class="btn btn-danger btn-md"><i class="fa fa-times-circle"></i> Encerrar Ticket</a>

    @else

    <a href="{{URL::to('atendimentos')}}/{{$setor}}/{{$ticket->id}}/reabrir" class="btn btn-success btn-md"><i class="fa fa-arrow-up"></i> Reabrir Ticket</a>
        
    @endif    

    <a  class="btn btn-info btn-md" style="float: right;" href="{{URL::to('atendimentos/'.$setor.'/'.$ticket->id.'/setors')}}"><i class="fa fa-users"></i> Setores Vinculados Ao Ticket</a>
    
    </section>

    <section class="content">

        <div class="form-group col-md-12">
            <div class="box-header">
            <h3 class="box-title">Arquivos: </h3>

            <a href="{{URL::to('uploads')}}/{{$ticket->id}}/create/ticket"  class="btn btn-info btn-md" style="float: right;"><i class="fa fa-plus-circle"></i> Novo Arquivo</a>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Titulo</th>
                        <th>Nome</th>
                        <th>Tamanho</th>
                        <th>Tipo</th>
                        <th>Ver</th>
                        <th>Excluir</th>
                    </tr>
                    @forelse ($uploads as $upload)
                    <tr>
                        <td><a href="{{ url('storage/'.$upload->dir.'/'.$upload->link) }}" target="_blank">{{ $upload->link }}</a> </td>
                        <td><a href="{{ url('storage/'.$upload->dir.'/'.$upload->link) }}" target="_blank">{{ $upload->titulo }}</a></td>
                        <td><a href="{{ url('storage/'.$upload->dir.'/'.$upload->link) }}" target="_blank">{{ $upload->nome }}</a></td>
                        <td><a href="{{ url('storage/'.$upload->dir.'/'.$upload->link) }}" target="_blank">{{ number_format(($upload->tam/1000), 2, ',', '') }} kbytes</a></td>
                        <td><a href="{{ url('storage/'.$upload->dir.'/'.$upload->link) }}" target="_blank">{{ $upload->tipo }}</a></td>
                        <td><a href="{{ url('storage/'.$upload->dir.'/'.$upload->link) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Visualizar</a></td>                       

                        <td>
                            <form method="POST" action="{{url('uploads/destroy', $upload->id)}}" id="formDelete{{$upload->id}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$upload->id}}">                                

                                <a href="javascript:confirmDelete{{$upload->id}}();" class="btn btn-danger"> <i class="fa fa-times"></i></a>
                            </form> 

                            <script>
                               function confirmDelete{{$upload->id}}() {

                                var result = confirm('Tem certeza que deseja excluir?');

                                if (result) {
                                        document.getElementById("formDelete{{$upload->id}}").submit();
                                    } else {
                                        return false;
                                    }
                                } 
                            </script>

                        </td>      
                        
                    </tr>                
                    @empty

                    <tr>
                        <td>
                            <span class="btn btn-primary">
                                <i class="fa fa-archive"></i>
                                 Nenhum arquivo relacionado.
                            </span>
                        </td>
                        
                    </tr>
                        
                    @endforelse            
                    
                </table>
            </div>
            <!-- /.box-body -->
        
        </div>

    </section>

    <a href="#main-header" class="btn btn-primary" style="float: right;"><span class="fa fa-arrow-up"></span></a>


  @endsection
@endcan
