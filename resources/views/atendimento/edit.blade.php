@can('update_atendimento')   
	@extends('layouts.app')
	@section('title', 'Editar Ticket')
	@section('content')
			<h1>
		        Editar Ticket
		        <small>{{$ticket->protocolo}}</small>
		    </h1>

		    <div class="box-body">              
              <div class="callout callout-info">
                <h5>Usuário: <b>{{$ticket->users->name}}</b></h5>
                <h5>Número de Protocolo: <b>{{$ticket->protocolo}}</b></h5>
                <h5>Aberto em: <b>{{date('d/m/Y H:i:s', strtotime($ticket->created_at))}}</b></h5>
              </div>              
              
            </div>

            <div class="form-group col-md-2">
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


			

			<form method="POST" enctype="multipart/form-data" action="{{url('atendimentos/'.$setor.'/'.$id.'/update')}}" id="form-edit">
				@csrf

				<input type="hidden" name="my_setor" value="{{$setor}}">
				
			 	<div class="form-group col-md-4">					
				    <label for="rotulo">Rótulo (Criticidade)</label>				    
					<select class="form-control" name="rotulo">						
						<option value="{{$ticket->rotulo}}" selected="selected">{{$rotulos[$ticket->rotulo]}}</option>

	                	@foreach ($rotulos as $Key => $rotulo)
						   <option value="{{$Key}}"> {{$rotulo}}</option>
						@endforeach 
											
					</select>
			 	</div>

			 	<div class="form-group col-md-6">
				    <label for="categoria_id">Categoria</label>
				    <select class="form-control  select2" name="categoria_id" style="width: 100%;">
				    	@if($ticket->categoria_id)
				    		<option selected="selected" value="{{$ticket->categorias->id}}">{{$ticket->categorias->nome}} - {{$ticket->categorias->descricao}} </option>
				    	@else
				    		<option selected="selected" value="">Nenhum</option>
            			@endif
				    	@forelse ($categorias as $categoria)
				    		<option value="{{$categoria->id}}">{{$categoria->nome}} - {{$categoria->descricao}} </option>
					    @empty                    
	                	@endforelse			
					</select>
			 	</div>		 	
			 	

		        <div class="form-group col-md-12">
				    <label for="titulo">Título (Descrição Resumida)</label>
				    <input type="text" class="form-control" placeholder="Descrição resumida do problema" name="titulo" value="{{$ticket->titulo}}">
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhe seu o problema ou solicitação" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$ticket->descricao}}</textarea>
		              </form>
		            </div>
			 	</div> 	


			 	<div>
			 		<hr>
			 	</div>

			 	<div class="form-group col-md-12">
			 		<input type="submit" form="form-edit" class="btn btn-primary" value="Atualizar" style="float: right;">
			 	</div>

			</form>




			
	@endsection
@endcan