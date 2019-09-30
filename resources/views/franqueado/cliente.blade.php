@extends('layouts.app')
@section('title', 'clientes')
@section('content')

    @include('layouts/topnavfranqueado')

    <div class="box box-success">
    	<h1>
            Clientes
            <small>{{$franquia->nome}}</small>
        </h1>

        <div class="col-md-12">
    	
            <div class="box-header">
                <h3 class="box-title">Clientes Cadastrados</h3>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <td colspan="4">@include('layouts/paginatewc')</td>                  
                    </tr> 

                    <tr>
                        <th>Id</th>             
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>email</th>
                        <th>data</th>
                    </tr>
                    @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->first_name}}{{$cliente->last_name}}</td>
                        <td>{{$cliente->username}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>{{$cliente->date_created}}</td>
                        
                    </tr>                
                    @empty

                    <tr>
                        <td><b>Nenhum Resultado.</b></td>
                    </tr>
                        
                    @endforelse     

                    <tr>
                        <td colspan="4">@include('layouts/paginatewc')</td>                  
                    </tr>                  
                    
                </table>
            </div>
            <!-- /.box-body -->

        	
        	
        	<a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
    </div>

@endsection