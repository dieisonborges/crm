@extends('layouts.app')
@section('title', $user->name)
@section('content')
	<h1>
		<i class="fa fa-star"></i>
        Perfil e Score
        <small>de {{$user->name}}</small>
    </h1>
	<div class="row">	


		
		    <div class="box-body col-md-4">              
              <div class="callout callout-info">
              	<h5>ID: <b> {{$user->id}}</b></h5>
                <h5>Apelido: <b> {{$user->apelido}}</b></h5>
                <h5>Nome Completo: <b> {{$user->name}}</b></h5>
                <h5>e-Mail: <b>{{$user->email}}</b></h5>
                <h5>CPF: <b> {{$user->cpf}}</b></h5>
                <h5>Telefone: <b> {{$user->phone_number}}</b></h5>
                <h5>Desde: <b> {{date('d/m/Y H:i:s', strtotime($user->created_at))}}</b></h5>
                
              </div>
        </div>

        <div class="box-body col-md-2"> 
          
              <div class="form-group col-md-12"> 
                   <a class="btn btn-warning btn-xl" href="{{URL::to('users/'.$user->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
              </div>
              <div class="form-group col-md-12">
                  @if ($user->status)
                      <form method="POST" action="{{action('UserController@updateActive')}}">
                          @csrf    
                          <input type="hidden" name="status" value="0">
                          <input type="hidden" name="id" value="{{$user->id}}">                  
                          <input type="submit" class="btn btn-danger btn-xl" value="- Desativar">
                      </form>                        
                  @else
                      <form method="POST" action="{{action('UserController@updateActive', $user->id)}}">
                          @csrf       
                          <input type="hidden" name="status" value="1">   
                          <input type="hidden" name="id" value="{{$user->id}}">                   
                          <input type="submit" class="btn btn-success btn-xl" value="+ Ativar">
                      </form>
                      
                  @endif
              </div>
              <div class="form-group col-md-12">
                  <a class="btn btn-primary btn-xl" href="{{URL::to('user/'.$user->id.'/roles')}}"><i class="fa fa-lock"></i> Roles</a>
              </div>
              <div class="form-group col-md-12">
                  <a class="btn btn-primary btn-xl" href="{{URL::to('user/'.$user->id.'/setors')}}"><i class="fa fa-building"></i> Setor</a>
              </div>
              <div class="form-group col-md-12"> 
                  <a class="btn btn-warning btn-xl" href="{{URL::to('users/'.$user->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
              </div> 

        </div>

        <div class="box-body col-md-2">              
              
            @if($imagem)  
                <img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" width="100%">
            @else
                <img src="{{ asset('img/default-user-image.png') }}" width="100%">
            @endif
        </div>


        <div class="box-body col-md-4"> 

            @if($franqueadoVip)               
            <div class="col-md-6"> 
                <img src="{{asset('img/conquistas/conquistas-vip.png')}}" width="100%" alt="VIP">
            </div>
            @endif

            @if($franqueadoVip)
            @if($franqueadoVip->lider)
            <div class="col-md-6"> 
                <img src="{{asset('img/conquistas/conquistas-lider.png')}}" width="100%" alt="Líder">
            </div>
            @endif
            @endif

        </div> 

        

        <div class="col-md-12">              
              
            @foreach($conquistas as $conquista)
            <div class="col-md-4"> 
                <div class="form-group col-md-12">
                  <div class="container-medalha">         
                    <img src="{{url('img/conquistas/'.$conquista->imagem_medalha)}}" width="100%"  alt="{{$conquista->imagem_medalha}}" class="imagem-medalha-ajuste">
                    <i class="{{$conquista->icone_medalha}} icone-medalha-ajuste"></i>
                    <span class="imagem-texto"><b>{{$conquista->titulo}}</b> <br> {{$conquista->descricao}}</span>
                  </div>
                </div>
            </div>
            @endforeach

        </div>

        @if($user_score)

        <div class="box-body col-md-12">              
              <div class="callout callout-primary">
              	<h3>Score Atual: <b> {{$user_score->valor}}</b> pontos</h3>
              	@for($i=0; $i<=(($user_score->valor)-1); $i++)
              		@if(($i % 10)==0)
              			&nbsp;&nbsp;
              		@endif

              		@if(($i % 30)==0)
						        <br>
					       @endif
              		<i class="fa fa-star" style="color: rgb({{$i}},{{$i}},0)"></i>

              	@endfor
                
              </div>
        </div>

        @endif

	</div>



    @if($scores)

	    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
      	<hr class="col-md-12 hr">

        	<h3>Linha do Tempo - Score</h3>

        <hr class="col-md-12 hr">
        <div class="col-md-12">       	

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-blue">
                    {{date('d M. Y', strtotime($user->created_at))}}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i:s', strtotime($user->created_at))}}</span>

                <h3 class="timeline-header"><a href="#">Score: </a><b>0</b></h3>

                <div class="timeline-body">
                 Entrada no e-Cardume
                </div>
                <div class="timeline-footer">
                  <span class="btn btn-warning btn-xs">Inicio</span>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            @foreach ($scores as $score)
                <!-- timeline time label -->
                <li class="time-label">
                	@if(($score->valor)>=0)
                      	<span class="bg-green">
                    @else
                    	<span class="bg-red">
                    @endif
                        	{{date('d M. Y', strtotime($score->created_at))}}
                      	</span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  
                  	@if(($score->valor)>=0)
                      	<i class="fa fa-plus-circle  bg-gray"></i>
                    @else
                    	<i class="fa fa-minus-circle  bg-gray"></i>
                    @endif

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i:s', strtotime($score->created_at))}}</span>

                    @if(($score->valor)>=0)
	                    <h3 class="timeline-header"><a href="#">Parabéns você ganhou: </a><b>{{$score->valor}} pontos</b></h3>
		            @else
		            	<h3 class="timeline-header"><a href="#">Infelizmente você perdeu: </a><b>{{$score->valor}} pontos</b></h3>
		            @endif                    

                    <div class="timeline-body">
                     {!!html_entity_decode($score->motivo)!!}
                    </div>

                    @if(($score->valor)>=0)
	                    <div class="timeline-footer">
		                  	<span class="btn btn-success btn-xs">Ganhou</span>
		                </div>
		            @else
		            	<div class="timeline-footer">
		                  	<span class="btn btn-danger btn-xs">Perdeu</span>
		                </div>
		            @endif
                                      
                  </div>
                </li>
                <!-- END timeline item -->
            @endforeach 
            
            
            <!-- timeline item -->
            
            

            @if (($user->status)==1)

            <li>
              <i class="fa fa-clock bg-gray"></i>
            </li>

            

            @else

            <!-- -------------- ENCERRAMENTO ------------- -->

            

            <!-- timeline time label -->
            
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-times-circle bg-gray"></i>
              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Usuário Desativado</a></h3>
              </div>
            </li>
            <!-- END timeline item -->

            <li>
              <i class="fa fa-flag-checkered bg-red"></i>
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

    @else

    @endif
	
	
@endsection