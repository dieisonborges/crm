@extends('layouts.app')
@section('title', 'Editar Conquista (Regra)')
@section('content')
		<h1>
	        Editar Conquista
	        <small>{{$conquista->titulo}}</small>
	    </h1>


	    <div class="form-group col-md-12">
	    	<div class="container-medalha">	    		
	    		<img src="{{url('img/conquistas/'.$conquista->imagem_medalha)}}" width="100%"  alt="{{$conquista->imagem_medalha}}" class="imagem-medalha-ajuste">
	    		<i class="{{$conquista->icone_medalha}} icone-medalha-ajuste"></i>
	    		<span class="imagem-texto"><b>{{$conquista->titulo}}</b> <br> {{$conquista->descricao}}</span>
	    	</div>
	    </div>

	    <div class="form-group col-md-12">

			<form method="POST" enctype="multipart/form-data" action="{{action('ConquistaController@update', $conquista->id)}}" class="col-md-12">
				@csrf
				<input type="hidden" name="_method" value="PATCH">			

			 	<div class="form-group col-md-12">
				    <label for="titulo">Título</label>
				    <input type="text" class="form-control" id="titulo" name="titulo" value="{{$conquista->titulo}}" placeholder="Digite o Título" required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="valor_score">Valor do Score</label>
				    <input type="text" class="form-control" id="valor_score" name="valor_score" value="{{$conquista->valor_score}}" placeholder="+30" required>
			 	</div>		 	
			 	<div class="form-group col-md-12">
				    <label for="imagem_medalha">Imagem da Medalha</label>
				    <select class="form-control" id="imagem_medalha" name="imagem_medalha" required="required">
				    	<option value="{{$conquista->imagem_medalha}}" selected="selected">{{$conquista->imagem_medalha}}</option>
				    	@foreach($medalhaSelectOption as $medalha)
			 				{!!html_entity_decode($medalha)!!}
			 			@endforeach
			 		</select>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="icone_medalha">Ícone Medalha (fa fa-icons)</label>
				    <input type="text" class="form-control" id="icone_medalha" name="icone_medalha" value="{{$conquista->icone_medalha}}" placeholder="fa fa-linux" required>
				    <a href="https://fontawesome.com/icons?d=gallery" target="_blank">* Ver lista Font Awesome - Icons</a>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição/Motivo:</label>
				    <input type="text" class="form-control" id="descricao" name="descricao" value="{{$conquista->descricao}}" placeholder="Digite o descrição" required>
			 	</div> 	
			 	

			 	<div>
			 		<hr>
			 	</div>

			 	<button type="submit" class="btn btn-primary">Atualizar</button>
			</form>
		</div>
@endsection