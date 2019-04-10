@extends('layouts.app')
@section('title', $user->name)
@section('content')
	<h1>
		<i class="fa fa-star"></i>
        Score
        <small>{{$user->name}}</small>
    </h1>
	<div class="row">		
		
		<div class="box-body col-md-6">              
              <div class="callout callout-info">
              	<h5>ID: <b> {{$user->id}}</b></h5>
                <h5>Apelido: <b> {{$user->apelido}}</b></h5>
                <h5>Nome Completo: <b> {{$user->name}}</b></h5>
                <h5>e-Mail: <b>{{$user->email}}</b></h5>
                <h5>CPF: <b> {{$user->cpf}}</b></h5>
                
              </div>
        </div>

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

	</div>





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
              <i class="fa fa-clock-o bg-gray"></i>
            </li>

            

            @else

            <!-- -------------- ENCERRAMENTO ------------- -->

            

            <!-- timeline time label -->
            
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-close bg-gray"></i>
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
	
	
@endsection