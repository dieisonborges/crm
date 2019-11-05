@can('read_armazem')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <div class="col-md-12">  

            <h1>
                <i class="fa fa-warehouse"></i> 
                Produtos do Armazém:
                <small>{{$armazem->nome}}</small>
            </h1>   
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th colspan="20">@include('layouts/paginatewc')</th>                  
                    </tr>  
                    <tr>
                        <th>Id</th>             
                        <th>Nome</th>
                        <th>SKU</th>
                        <th>Tipo</th>
                        <th>Estoque</th>
                        <th>Peso</th>
                        <th>Preço</th>
                        <th>Preço Regular</th> 
                        <th>Preço de Venda</th>
                        <th>Status</th>
                        <th>Modificar</th>
                    </tr>
                    @forelse ($produtos as $produto)
                    <tr>
                        <td>
                            <a href="{{$armazem->store_url.'/produto/'.$produto->slug}}" class="btn btn-sm btn-info" target="_blank">
                                <span class="fa fa-eye"></span>
                                {{$produto->id}}
                            </a>
                        </td>
                        <td>{{$produto->name}}</td>
                        <td>{{$produto->sku}}</td>
                        <td>
                            @if($produto->type=='simple')
                                <span class="btn btn-sm btn-success">Simples</span>
                            @elseif($produto->type=='variable')
                                <span class="btn btn-sm btn-info">Variável</span>                        
                            @else
                                <span class="btn btn-sm btn-default">{{$produto->type}}</span>
                            @endif
                        </td>
                        <td>{{$produto->stock_quantity}}</td>
                        <td>{{$produto->weight}}</td>
                        <td>{{$produto->price}}</td>
                        <td>{{$produto->regular_price}}</td>
                        <td>{{$produto->sale_price}}</td>
                        <td>
                            @if($produto->status=='publish')
                                <span class="btn btn-sm btn-success">Publicado</span>
                            @elseif($produto->status=='pending')
                                <span class="btn btn-sm btn-warning">Revisão</span>
                            @elseif($produto->status=='draft')
                                <span class="btn btn-sm btn-danger">Rascunho</span>
                            @else
                                <span class="btn btn-sm btn-info">{{$produto->status}}</span>
                            @endif
                        </td>
                        <td><a href="{{url('franqueados/'.$armazem->id.'/produtoEdit/'.$produto->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></span></a></td>
                        
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
@endcan
