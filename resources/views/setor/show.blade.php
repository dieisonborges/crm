@extends('layouts.app')
@section('title', 'Setor')
@section('content')
	<h1>
        Setor
        <small>{{$setor->name}}</small>
    </h1>
	<div class="row">		
		<div class="col-md-6">
			<ul>
				<li><strong>ID: </strong> {{$setor->id}}</li>
				<li><strong>Nome: </strong> {{$setor->name}}</li>
				<li><strong>Rótulo(label): </strong> {{$setor->label}}</li>				
			</ul>	
		</div>

	</div>
	
	
	<a href="javascript:history.go(-1)">Voltar</a>
@endsection