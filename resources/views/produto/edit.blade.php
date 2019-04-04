@can('update_permission')  
	@extends('layouts.app')
	@section('title', 'Editar Produto')
	@section('content')
			<h1>
		        Editar Produto
		        <small>{{$produto->titulo}}</small>
		    </h1>
			

			<form method="POST" enctype="multipart/form-data" action="{{action('ProdutoController@update',$produto->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="PATCH">						
				
			 	<div class="form-group col-md-12">
				    <label for="titulo">Título:</label>
				    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $produto->titulo }}" placeholder="Digite o Título..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="palavras_chave">Palavras Chave (Separadas por vírgula):</label>
				    <input type="text" class="form-control" id="palavras_chave" name="palavras_chave" value="{{ $produto->palavras_chave }}" placeholder="casa, mesa, banho ..." required>
			 	</div>

			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Cubagem:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="altura" class="text-aqua">Altura (cm)</label>
			    		<input type="number" step="0.01" class="form-control" id="altura" name="altura" value="{{ $produto->altura }}" placeholder="Centímetros">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="largura" class="text-aqua">Largura (cm)</label>
			    		<input type="number" step="0.01" class="form-control" id="largura" name="largura" value="{{ $produto->largura }}" placeholder="Centímetros">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="comprimento" class="text-aqua">Comprimento (cm)</label>
			    		<input type="number" step="0.01" class="form-control" id="comprimento" name="comprimento" value="{{ $produto->comprimento }}" placeholder="Centímetros">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="peso" class="text-aqua">Peso (g)</label>
			    		<input type="number" step="0.01" class="form-control" id="peso" name="peso" value="{{ $produto->peso }}" placeholder="Gramas">
			    	</div>
			    	
				</div>

				<div class="form-group col-md-12">
				    <label for="link_referencia">Link de Referência:</label>
				    <input type="text" class="form-control" id="link_referencia" name="link_referencia" value="{{ $produto->link_referencia }}" placeholder="http://www.nomedoproduto.com/product?">
			 	</div>		 	


			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhes do produto" required="required" name="descricao" 
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $produto->descricao }}</textarea>
		              </form>
		            </div>
			 	</div>			 	

			 	<div class="col-md-12">			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Atualizar">
			 		<hr>
			 	</div>

			</form>
	@endsection
@endcan