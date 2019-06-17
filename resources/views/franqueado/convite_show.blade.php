@extends('layouts.app')
@section('title', 'Convites')
@section('content')
	<h1>
        Convite
        <small>{{$convite->name}}</small>
    </h1>
	<div class="row">		
		<div class="col-md-6">
			<ul>
				<li class="form-control"><strong>ID: </strong> {{$convite->id}}</li>
				<li class="form-control"><strong>Código: </strong> {{$convite->codigo}}</li>
				<li class="form-control"><strong>Gerado em: </strong> {{date('d/m/Y H:i:s', strtotime($convite->created_at))}}</li>				
				<li class="form-control"><strong>Expira em: </strong> {{date('d/m/Y H:i:s', strtotime('+2 days', strtotime($convite->created_at)))}}</li>
				<li class="form-control"><strong>Usado: </strong> 
				@if($convite->status)
					<span class='btn btn-danger'>NÃO</span>
				@else
					<span class='btn btn-success'>SIM</span>
				@endif
				</li>
				<br>
			</ul>	
		</div> 

	</div>
	
	<a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
@endsection