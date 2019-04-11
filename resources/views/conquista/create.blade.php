@extends('layouts.app')
@section('title', 'Nova Role')
@section('content')
		<h1>
	        Conquista
	        <small>Criar Nova</small>
	    </h1>
		

		<form method="POST" action="{{url('conquistas')}}">
			@csrf			
			<div class="form-group mb-12">
			    <label for="titulo">Título</label>
			    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Digite o Título" required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="valor_score">Valor do Score</label>
			    <input type="text" class="form-control" id="valor_score" name="valor_score" value="{{ old('valor_score') }}" placeholder="+30" required>
		 	</div>		 	
		 	<div class="form-group mb-12">
			    <label for="imagem_medalha">Imagem da Medalha</label>
			    <select class="form-control" id="imagem_medalha" name="imagem_medalha" required="required">
			    	<option value="" selected="selected">Nenhuma</option>
			    	@foreach($medalhaSelectOption as $medalha)
		 				{!!html_entity_decode($medalha)!!}
		 			@endforeach
		 		</select>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="icone_medalha">Ícone Medalha (fa fa-icons)</label>
			    <input type="text" class="form-control" id="icone_medalha" name="icone_medalha" value="{{ old('icone_medalha') }}" placeholder="fa fa-linux" required>
			    <a href="https://adminlte.io/themes/AdminLTE/pages/UI/icons.html" target="_blank">* Ver lista Font Awesome - Icons</a>
		 	</div>

		 	<div class="form-group mb-12">
			    <label for="descricao">Descrição/Motivo:</label>
			    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}" placeholder="Digite o descrição" required>
		 	</div> 	
		 	

		 	<div>
		 		<hr>
		 	</div>

		 	<button type="submit" class="btn btn-primary">cadastrar</button>
		</form>

		<hr class="col-md-12 hr">

		<h2 class="form-group">Imagens de medalhas existentes:</h2>

		@foreach($medalhaImagem as $medalha)
			<div class="col-md-2">
				<label class="text-center col-md-12">{{str_replace('.png', '', (ucwords(str_replace('-', ' ', $medalha))))}}</label><br>
				<img src="{{url('img/conquistas/'.$medalha)}}" width="100%" alt="{{$medalha}}">
				<hr class="col-md-12 hr"> 
			</div>
			
		@endforeach

@endsection