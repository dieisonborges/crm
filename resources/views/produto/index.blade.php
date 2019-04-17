@can('read_produto')  
    @extends('layouts.app')
    @section('title', 'Produtos')
    @section('content')
    <h1>Produtos  <a href="{{url('produtos/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

        @if (session('status'))
            <div class="alert alert-success" produto="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('produtos/busca')}}">
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
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Título</th>
                    <th>Palavras Chave</th>
                    <th>Descrição</th>
                    <th>Imagens</th>
                    <th>Status</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                    <th>Desativar</th>
                </tr>
                @forelse ($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->sku}}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->titulo}}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->palavras_chave}}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{ str_limit(strip_tags($produto->descricao), $limit = 40, $end = '...') }}</a></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('produtos')}}/{{$produto->id}}/imagem">
                            <span class="fa fa-image"> Imagens</span>                        
                        </a>
                    </td>                    

                    <td>
                        <a href="{{URL::to('produtos')}}/{{$produto->id}}">
                        @if($produto->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-close"></i> Desativado</span>
                        @endif
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('produtos')}}/{{$produto->id}}">
                            <span class="fa fa-eye"> Ver</span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{{URL::to('produtos/'.$produto->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="{{action('ProdutoController@destroy', $produto->id)}}" id="formDelete{{$produto->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$produto->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Desativar</a>
                        </form> 

                        <script>
                           function confirmDelete{{$produto->id}}() {

                            var result = confirm('Tem certeza que deseja desativar?');

                            if (result) {
                                    document.getElementById("formDelete{{$produto->id}}").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                    </td>
                </tr>                
                @empty

                <tr>
                    <td><b>Nenhum Resultado.</b></td>
                </tr>
                    
                @endforelse      

                {{$produtos->links()}}      
                
            </table>
        </div>
        <!-- /.box-body -->

    @endsection
@endcan
