@can('create_categoria')   
	@extends('layouts.app')
	@section('title', 'Nova Categoria')
	@section('content')
			<h1>
		        Nova
		        <small>Categoria</small>
		    </h1>
			

			<form method="POST" action="{{url('categorias')}}">
				@csrf			
				<div class="form-group mb-12">
				    <label for="nome">Nome</label>
				    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo..." value="{{ old('nome') }}" required>
			 	</div>
			 	
			 	<div class="form-group mb-12">
				    <label for="descricao">Descrição</label>
				    <textarea class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição.." required="required">{{ old('descricao') }}</textarea>
			 	</div>			 	

			 	<button type="submit" class="btn btn-primary">Cadastrar</button>
			</form>
	@endsection
@endcan