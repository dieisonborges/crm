@extends('layouts.app')
@section('title', 'Cupons')
@section('content')

   
    @include('layouts/topnavfranqueado')
 
    <div class="box box-success">
    	<h1>
            Cupons
        </h1>

        <div class="col-md-12">   	
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th colspan="4">@include('layouts/paginatewc')</th>                  
                    </tr>  
                    <tr>
                        <th>Id</th>             
                        <th>Código</th>
                        <th>Valor</th>
                        <th>Tipo de Desconto</th>
                    </tr>
                    @forelse ($cupons as $cupom)
                    <tr>
                        <td>{{$cupom->id}}</td>
                        <td>{{$cupom->code}}</td>
                        <td>{{$cupom->amount}}</td>
                        <td>{{$cupom->discount_type}}</td>                        
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


@endsection