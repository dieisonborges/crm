@extends('layouts.app')
@section('title', 'Contato')
@section('content')
		<h3 class="mb-3">Entre em Contato para Informar Problemas no Sistema</h3>
		<h4 class="mb-3">Somente Bugs</h4>
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif

		@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" action="{{url('contato/enviar')}}">
			@csrf

			<div class="form-group mb-3">
			    <label for="nome">Nome</label>
			    
			    <input type="hidden" id="nome" name="nome" value="{{ Auth::user()->cargo }} {{ Auth::user()->name }}">
			    <span class="form-control">{{ Auth::user()->cargo }} {{ Auth::user()->name }}</span>
		 	</div>

		 	<div class="form-group mb-3">
			    <label for="email">E-mail</label>			    

			    <input type="hidden" id="email" name="email" value="{{ Auth::user()->email }}">
			    <span class="form-control">{{ Auth::user()->email }}</span>
		 	</div>

			<div class="form-group mb-3">
			    <input type="hidden" id="assunto" name="assunto" value="Bugs - Problemas no CRM">
			    <label for="assunto">Assunto</label>
			    <span class="form-control">Bugs - Problemas no CRM</span>
		 	</div>
		 	
		 	<div class="form-group mb-3">
			    <label for="msg">Mensagem</label>
			   	<textarea class="form-control" id="msg" name="msg" rows="3" placeholder="Digite sua Mensagem..." required></textarea>
		 	</div>
		 	
		 	<button type="submit" class="btn btn-primary">Enviar Mensagem</button>
		</form>
@endsection