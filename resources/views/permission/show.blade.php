@can('read_permission')  
	@extends('layouts.app')
	@section('title', $permission->name)
	@section('content')
		<h1>
	        Permission - Rótulo - Regra
	        <small>{{$permission->name}}</small>
	    </h1>
		<div class="row">		
			<div class="col-md-6">
				<ul>
					<li class="form-control"><strong>ID: </strong> {{$permission->id}}</li>
					<li class="form-control"><strong>Nome: </strong> {{$permission->name}}</li>
					<li class="form-control"><strong>Rótulo(label): </strong> {{$permission->label}}</li>				
				</ul>	
			</div> 

		</div>
		
		<a href="{{$permission->id}}/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan