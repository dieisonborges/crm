@extends('layouts.app')
@section('title', 'pedidos')
@section('content')
	<h1>
        pedidos
        <small>{{$franquia->nome}}</small>
    </h1>

    <div class="col-md-12">
	
        <div class="box-header">
            <h3 class="box-title">pedidos Cadastrados</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>Id</th>             
                    <th>Pedido</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Frete</th> 
                    <th>Moeda</th>
                    <th>Status</th>
                </tr>
                @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{$pedido->id}}</td>
                    <td>#{{$pedido->number}}</td>
                    <td>{{$pedido->date_created}}</td>
                    <td>{{$pedido->total}}</td>
                    <td>{{$pedido->shipping_total}}</td>
                    <td>{{$pedido->currency}}</td>
                    <td>{{$pedido->status}}</td>
                    
                </tr>                
                @empty

                <tr>
                    <td><b>Nenhum Resultado.</b></td>
                </tr>
                    
                @endforelse     

                  
                
            </table>
        </div>
        <!-- /.box-body -->

    	
    	
    	<a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>

@endsection