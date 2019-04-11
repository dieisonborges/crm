@extends('layouts.app')
@section('title', $conquista->name)
@section('content')
	<h1>
        Conquista
        <small>{{$conquista->titulo}}</small>
    </h1>
	<div class="row">		
		<div class="form-group col-md-12">
	    	<div class="container-medalha">	    		
	    		<img src="{{url('img/conquistas/'.$conquista->imagem_medalha)}}" width="100%"  alt="{{$conquista->imagem_medalha}}" class="imagem-medalha-ajuste">
	    		<i class="{{$conquista->icone_medalha}} icone-medalha-ajuste"></i>
	    		<span class="imagem-texto"><b>{{$conquista->titulo}}</b> <br> {{$conquista->descricao}}</span>
	    	</div>
	    </div>

	</div>

	<a class="btn btn-warning" href="{{URL::to('conquistas/'.$conquista->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
	
	
	<a class="btn btn-primary" href="javascript:history.go(-1)">Voltar</a>
@endsection