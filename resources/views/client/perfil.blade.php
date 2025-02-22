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
              
            @if($imagem)  
                <img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" width="100%">
            @else
                <img src="{{ asset('img/default-user-image.png') }}" width="100%">
            @endif
           

            <a href="{{URL::to('clients')}}/imagem" class="btn btn-primary btn-xs"><i class="fa fa-image"></i> Alterar Imagem</a>

        </div>


        <div class="box-body col-md-6"> 

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
  

        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Endereços Cadastrados:</h3>              
            <!-- /.box-header -->
              <div class="box-tools">
                  <div class="input-group input-group-sm hidden-xs">
                    <a href="{{url('clients/enderecoCreate')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Novo Endereço</a>
                  </div>
                </div>
              </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>Título</th>
                  <th>Endereço</th>
                  <th>Complemento</th>
                  <th>Cidade</th>
                  <th>Estado</th>
                  <th>CEP</th>
                  <th>País</th>
                  <!--<th>Mapa</th>-->
                  <th>Remover</th>
                </tr>
                @forelse($enderecos as $endereco)
                <tr>
                  <td>{{$endereco->label}}</td>
                  <td>{{$endereco->address_1}}</td>
                  <td>{{$endereco->address_2}}</td>                  
                  <td>{{$endereco->city}}</td>
                  <td>{{$endereco->state}}</td> 
                  <td>{{$endereco->postcode}}</td> 
                  <td>{{$endereco->country}}</td>
                  <!--<td><a href="#" target="_blank"><i class="fa fa-globe"></i></a></td>-->
                  <td>

                        <form method="POST" action="{{action('ClientController@destroyEndereco')}}" id="formDelete{{$endereco->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <input type="hidden" name="endereco_id" value="{{$endereco->id}}">

                            <a href="javascript:confirmDelete{{$endereco->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Remover</a>
                        </form> 

                        <script>
                           function confirmDelete{{$endereco->id}}() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete{{$endereco->id}}").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                    </td>
                </tr>  
                @empty
                <tr>
                  <td>Nenhum endereço cadastrado.</td>
                </tr>

                @endforelse              
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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

  <div class="col-md-12">



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
                <span class="time"><i class="fa fa-clock"></i> {{date('H:i:s', strtotime($user->created_at))}}</span>

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
                    <span class="time"><i class="fa fa-clock"></i> {{date('H:i:s', strtotime($score->created_at))}}</span>

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

    @else

    @endif
    </div>	
@endsection