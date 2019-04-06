@can('read_produto')  
	@extends('layouts.app')
	@section('title', $produto->name)
	@section('content')
		<h1>
	        Produto 
	        <small>{{$produto->name}}</small>



	        @if($produto->status)
	    		<span class="btn btn-success">Ativo</span>
	    	@else
	    		<span class="btn btn-danger">Desativado</span>
	    	@endif


	    </h1> 
		<div class="row">		
				
			 	<div class="form-group col-md-12">
				    <label for="titulo">Título:</label>
				    <span class="form-control">{{$produto->titulo}}</span>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="palavras_chave">Palavras Chave (Separadas por vírgula):</label>
				    <span class="form-control">{{$produto->palavras_chave}}</span>
			 	</div>
			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Cubagem:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="altura" class="text-aqua">Altura (cm)</label>
			    		<span class="form-control">{{$produto->altura}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="largura" class="text-aqua">Largura (cm)</label>
			    		<span class="form-control">{{$produto->largura}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="comprimento" class="text-aqua">Comprimento (cm)</label>
			    		<span class="form-control">{{$produto->comprimento}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="peso" class="text-aqua">Peso (g)</label>
			    		<span class="form-control">{{$produto->peso}}</span>
			    	</div>
			    	
				</div>

				<div class="form-group col-md-12">
				    <label for="link_referencia">Link de Referência:</label>
				    <input disabled="disabled" class="form-control" value="{{$produto->link_referencia}}">
			 	</div>		 	


			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" disabled="disabled" placeholder="Detalhes do produto"="required" name="descricao" 
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$produto->descricao}}</textarea>
		              </form>
		            </div>
			 	</div>	
		</div>
		
		<a href="{{$produto->id}}/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan