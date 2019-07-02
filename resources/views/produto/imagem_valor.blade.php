@can('update_produto')  
	@extends('layouts.app')
	@section('title', 'Editar Produto')
	@section('content')
			<h1>
		        Valor de Imagem
		    </h1>
			

			<form method="POST" enctype="multipart/form-data" action="{{action('ProdutoController@imagemValorUpdate',$imagem->id)}}" id="formSubmit">
				@csrf

				<input type="hidden" name="imagem_id" value="{{$imagem->id}}">

				<input type="hidden" name="produto_id" value="{{$produto_id}}">
				


			 	<div class="form-group col-md-12">
				    <label for="valor">Valor:</label>
				    <input type="number" class="form-control" id="valor" name="valor" value="{{ $imagem->valor }}" placeholder="Digite o Valor" required>
			 	</div>
			 				 	

			 	<div class="col-md-12">			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Atualizar">
			 		<hr>
			 	</div>

			</form>
	@endsection
@endcan