@can('create_franqueado')  
	@extends('layouts.app')
	@section('title', 'Nova Role')
	@section('content')
			<h1>
		        Novo Convite <b>Franqueado</b>
		        <small>Enviar</small>
		    </h1>
			

			<form method="POST" action="{{url('franqueados/convite/conviteStore')}}">
				@csrf			
				<div class="form-group mb-12">
				    <label for="email">E-mail</label>
				    <input type="text" class="form-control" id="email" name="email" value="" placeholder="Digite o email do convidado" required>
			 	</div>		 	

			 	<div>
			 		<hr>
			 	</div>

			 	<button type="submit" class="btn btn-primary">cadastrar</button>
			</form>
	@endsection
@endcan