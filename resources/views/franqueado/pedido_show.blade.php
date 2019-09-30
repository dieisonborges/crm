@extends('layouts.app')
@section('title', 'pedidos')
@section('content')


    @include('layouts/topnavfranqueado')

    <div class="box box-success">
    	<h1>
            Pedido <b>#{{$pedido->number}}</b>
            <small>{{$franquia->nome}}</small>
        </h1>

        <div class="col-md-12">
    	
              
                <div class="col-md-6">
                    <ul>
                        <li class="form-control"><strong>Franquia: </strong> {{$franquia->nome}}</li>
                        <li class="form-control"><strong>Código da Franquia: </strong> {{$franquia->codigo_franquia}}</li>
                        <li class="form-control"><strong>ID: </strong> {{$pedido->id}}</li>
                        <li class="form-control"><strong>Número: </strong> #{{$pedido->number}}</li>
                        <li class="form-control"><strong>Status: </strong> {{$pedido->status}}</li>             
                        <li class="form-control"><strong>Data: </strong> {{date('d/m/Y H:i:s', strtotime($pedido->date_created))}}</li>
                       
                        <br>
                    </ul>   
                </div> 

           

        	
        	
        	<a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
    </div>

@endsection