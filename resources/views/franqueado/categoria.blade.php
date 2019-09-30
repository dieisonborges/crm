@extends('layouts.app')
@section('title', 'Categorias')
@section('content')

   
    @include('layouts/topnavfranqueado')
 
    <div class="box box-success">
    	<h1>
            Categorias
        </h1>

        <div class="col-md-12">   	
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th colspan="20">@include('layouts/paginatewc')</th>                  
                    </tr>  
                    <tr>
                        <th>Id</th>             
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Modificar</th>
                    </tr>
                    @forelse ($categorias as $categoria)
                    <tr>
                        <td>
                            <a href="{{$franquia->store_url.'categoria-produto/'.$categoria->slug}}" class="btn btn-sm btn-info" target="_blank">
                                <span class="fa fa-eye"></span>
                                {{$categoria->id}}
                            </a>
                        </td>
                        <td>{{$categoria->name}}</td>
                        <td>{{$categoria->slug}}</td>
                        
                        <td><a href="{{url('franqueados/'.$franquia->id.'/categoriaEdit/'.$categoria->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></span></a></td>
                        
                    </tr>                
                    @empty

                    <tr>
                        <td><b>Nenhum Resultado.</b></td>
                    </tr>
                        
                    @endforelse   

                    <tr>
                        <td colspan="20">@include('layouts/paginatewc')</td>                  
                    </tr>                                 
                    
                </table>
            </div>
            <!-- /.box-body -->

        	
        	
        	<a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>


@endsection