@can('update_categoria')   
	@extends('layouts.app')
	@section('title', 'Editar Categoria')
	@section('content')
			<h1>
		        Editar Categoria
		        <small>{{$categoria->nome}}</small>
		    </h1>			

			<form method="POST" enctype="multipart/form-data" action="{{action('CategoriaController@update',$categoria->id)}}">
				@csrf

				<input type="hidden" name="_method" value="PATCH">
				<div class="form-group mb-12">
				    <label for="nome">Nome</label>
				    <input type="text" class="form-control" id="nome" name="nome" value="{{$categoria->nome}}" placeholder="Digite o Nome..." required>
			 	</div>
			 	
			 	<div class="form-group mb-12">
				    <label for="descricao">Descrição</label>
				    <textarea class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição.." required="required">{{$categoria->descricao}}</textarea>
			 	</div>			 	

			 	<button type="submit" class="btn btn-primary">Atualizar</button>
			</form>
	@endsection
@endcan