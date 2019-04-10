@extends('layouts.app')
@section('title', 'Nova Role')
@section('content')
		<h1>
	        Score de usuário
	        <small>Aumentar ou Reduzir</small>
	    </h1>
		

		<form method="POST" action="{{url('scores')}}">
			@csrf		

			<div class="form-group mb-12">
			    <label for="motivo">Motivo</label>
			    <input type="text" class="form-control" id="motivo" name="motivo" value="" placeholder="Digite o Motivo..." required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="valor">Valor (Poder ser positivo ou negativo)</label>
			    <input type="text" class="form-control" id="valor" name="valor" value="" placeholder="-10" required>
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