@can('read_armazem')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <h1> <i class="fa fa-warehouse"></i> Armazéns <a href="{{url('armazems/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>  </h1>
    

        <br>

        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('armazems/busca')}}">
                @csrf
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="{{$buscar}}">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
     
        </div> 

        <br><br><br>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-12">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>Localização</th>
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
