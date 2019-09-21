@extends('layouts.app')
@section('title', 'Produtos')
@section('content')
	<h1>
        Produtos
        <small>{{$franquia->nome}}</small>
    </h1>

    <div class="col-md-12">
	
        <div class="box-header">
            <h3 class="box-title">Produtos Cadastrados</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>Id</th>             
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Preço</th>
                    <th>Preço Regular</th> 
                    <th>Preço de Venda</th>
                    <th>Status</th>
                </tr>
                @forelse ($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->name}}</td>
                    <td>{{$produto->slug}}</td>
                    <td>{{$produto->price}}</td>
                    <td>{{$produto->regular_price}}</td>
                    <td>{{$produto->sale_price}}</td>
                    <td>{{$produto->status}}</td>
                    
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