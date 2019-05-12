@can('update_franqueado')  
	@extends('layouts.app')
	@section('title', 'Editar Franquia')
	@section('content')
			<h1>
		        <i class="fa fa-tools"></i> Editar Margem de Lucro do Produto
		        <small>{{$franquia->nome}}</small>
		    </h1>

		    <div class="row justify-content-center form-group">
			    <div class="col-md-12">
			        
			        	@forelse ($imagens as $imagem)
			        	<div class="col-md-2">
				            <a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" data-toggle="lightbox" data-gallery="example-gallery">
				                <img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" class="img-fluid" width="100%">
				            </a>
				        </div>
				        @empty
				        <div class="col-md-2">
				        	<span class="btn btn-primary">
		                        <i class="fa fa-image"></i>
		                         Nenhuma imagem.
		                    </span>
		                </div>
				        @endforelse	        
			        
			    </div>
			</div>
			<div class="row">		
					
				 	<div class="form-group col-md-12">
					    <label for="titulo">Título:</label>
					    <span class="form-control">{{$produto->titulo}}</span>
				 	</div>
			</div>
				
			<form method="POST" action="{{action('FranqueadoController@produtosLucroUpdate',$franquia->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="POST">

				<input type="hidden" name="produto_franquia" value="{{$produto_franquia->id}}">		 	

		    	<div class="form-group col-md-12">
		    		<label for="lucro" class="text-aqua">Margem de lucro automática (em porcentagem %):</label>
		    		<input type="number" step=".2" class="form-control" id="lucro" name="lucro" value="{{ $produto_franquia->lucro }}">
		    	</div>
		    			 	

			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Salvar">

			 		<a href="javascript:history.go(-1)" class="btn btn-success"><i class="fa fa-undo"></i> Voltar</a>
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan