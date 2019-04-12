@extends('layouts.app')
@section('title', 'Franqueado')
@section('content')
		<h1>
	        Franqueado VIP
	        <small>Adicionar ou Remover</small>
	    </h1>
		

		<form method="POST" action="{{url('franqueadoVip')}}">
			@csrf		

			<div class="form-group mb-12">
			    <label for="lider">Líder</label>
			    <select class="form-control" name="lider" required="required">
			    	<option value="0">Não</option>
			    	<option value="1">Sim</option>
			    </select>
		 	</div>
		 	

		 	<div class="form-group col-md-12">
		        <label>Usuário:</label>
		        <select name="user_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários"
		                style="width: 100%;" required="required">
		                @forelse ($users as $user)
		                    <option value="{{$user->id}}">
		                        {{$user->name}} | {{$user->apelido}} | {{$user->email}}
		                    </option>
		                @empty
		                    <option>Nenhuma Opção</option>     
		                @endforelse
		                      
		        </select>
		    </div>

		 	<div class="form-group col-md-12">
		 		<hr>
		 		<button type="submit" class="btn btn-primary">Cadastrar</button>
		 	</div>

		 	
		</form>
@endsection