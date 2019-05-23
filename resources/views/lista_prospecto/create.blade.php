@can('create_convite')  
	@extends('layouts.app')
	@section('title', 'Nova Role')
	@section('content')
			<h1>
		        Novo Prospecto
		        <small>Manual</small>
		    </h1>
			

			<form method="POST" action="{{url('listaProspectos')}}">
				@csrf		
				<div class="form-group mb-12">
				    <label for="name">Nome</label>
				    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o nome completo..." required>
			 	</div>	

				<div class="form-group mb-12">
				    <label for="email">E-mail</label>
				    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Digite o email do convidado" required>
			 	</div>	

			 	<div class="form-group mb-12">
				    <label for="phone_number">Telefone com DDD</label>
				    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Digite o Telefone..." required>
			 	</div>	

			 	<div class="form-group col-md-12">
			        <label>Loja(s):</label>
			        <select name="franquia_id[]" class="form-control select2" multiple="multiple" data-placeholder="Franquias de Interesse"
			                style="width: 100%;" required="required">

			                @forelse ($franquias as $franquia)
			                	<option value="{{$franquia->id}}">
			                        {{$franquia->codigo_franquia}} | {{$franquia->nome}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        </select>

			    </div> 	

			    <div class="form-group col-md-12">
			        <label>Produto(s):</label>
			        <select name="produto_id[]" class="form-control select2" multiple="multiple" data-placeholder="Produtos de Interesse"
			                style="width: 100%;" required="required">
			                @forelse ($produtos as $produto)
			                	<option value="{{$produto->id}}">
			                        {{$produto->id}} | {{$produto->titulo}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        </select>

			    </div> 

			    <div class="form-group col-md-12">
			        <label>Categoria(s):</label>
			        <select name="categoria_id[]" class="form-control select2" multiple="multiple" data-placeholder="Categorias de Interesse"
			                style="width: 100%;" required="required">
			                @forelse ($categorias as $categoria)
			                	<option value="{{$categoria->id}}">
			                        {{$categoria->id}} | {{$categoria->nome}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        </select>

			    </div> 

			 	<div>
			 		<hr> 
			 	</div>

			 	<button type="submit" class="btn btn-primary">cadastrar</button>
			</form>
	@endsection
@endcan