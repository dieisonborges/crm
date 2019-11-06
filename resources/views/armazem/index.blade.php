@can('read_armazem')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <h1> <i class="fa fa-warehouse"></i> Armazéns <a href="{{url('armazems/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>  </h1>
    
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-12">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>Localização</th>
                    <th>Tipo</th>
                    <th>Store Url</th>
                    <th>Produtos</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr> 
                @forelse ($armazems as $armazem)
                <tr>
                    <td>{{$armazem->id}}</td>
                    <td>
                        <a href="{{URL::to('armazems')}}/{{$armazem->id}}">
                        @switch($armazem->status)
                                @case(0)
                                    <a href="{{url('armazem/'.$armazem->id.'/status/1')}}" class="btn btn-danger btn-xs">Desativado</a>
                                    @break                                                               
                                @default
                                    <a href="{{url('armazem/'.$armazem->id.'/status/0')}}" class="btn btn-success btn-xs">Ativo</a>
                            @endswitch
                        </a>

                    </td>

                    <td>
                        <a href="{{URL::to('armazems')}}/{{$armazem->id}}">{{$armazem->nome}}</a>
                    </td>                 
                    
                    <td>
                        <a href="{{URL::to('armazems')}}/{{$armazem->id}}">{{$armazem->localizacao}}</a>
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
                        <a class="btn btn-primary btn-xs" href="{{URL::to('armazem/'.$armazem->id.'/produtos/1')}}"><i class="fa fa-box"></i> Ver</a>
                    </td>

                    <td>
                        <a class="btn btn-warning btn-xs" href="{{URL::to('armazems/'.$armazem->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    
                    <td>

                        <form method="POST" action="{{action('ArmazemController@destroy', $armazem->id)}}" id="formDelete{{$armazem->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$armazem->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete{{$armazem->id}}() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete{{$armazem->id}}").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                    </td>
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        

    @endsection
@endcan
