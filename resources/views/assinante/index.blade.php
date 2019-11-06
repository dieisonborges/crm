@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <h1> <i class="fa fa-warehouse"></i> Armazéns </h1>
    
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-12">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Localização</th>
                    <th>Tipo</th>
                    <th>Store Url</th>
                    <th>Produtos</th>
                </tr> 
                @forelse ($armazems as $armazem)
                <tr>
                    <td>#{{$armazem->id}}</td>
                    <td>
                        <a href="{{$armazem->store_url}}" target="_blank">
                        @switch($armazem->status)
                                @case(0)
                                    <span class="btn btn-danger btn-xs">Desativado</span>
                                    @break                                                               
                                @default
                                    <span class="btn btn-success btn-xs">Ativo</span>
                            @endswitch
                        </a>

                    </td>                 
                    
                    <td>
                        <a href="{{$armazem->store_url}}" target="_blank">{{$armazem->localizacao}}</a>
                    </td>

                    <td>
                        @if($armazem->tipo==0)
                        <span class="btn btn-xs btn-info"> Revenda (Estoque de Terceiros)</span>
                        @elseif($armazem->tipo==1)
                        <span class="btn btn-xs btn-info">Fulfillment (Estoque Próprio Internacional)</span>
                        @elseif($armazem->tipo==2)
                        <span class="btn btn-xs btn-info">Fulfillment (Estoque Próprio Nacional)</span>
                        @elseif($armazem->tipo==3)
                        <span class="btn btn-xs btn-info">Armazém Próprio Nacional</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{$armazem->store_url}}" target="_blank">
                            <span class="btn btn-primary btn-xs">{{$armazem->store_url}}</span>
                        </a>
                    </td> 

                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('assinante/'.$armazem->id.'/produtos/1')}}"><i class="fa fa-box"></i> Ver Produtos</a>
                    </td>
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        

    @endsection
@endcan
