@can('read_produto_preco')  
    @extends('layouts.app')
    @section('title', 'Produtos Preço')
    @section('content')
        <h1>
            Produtos Preços
        </h1>

        <div class="col-md-12"> 

            <form method="POST" enctype="multipart/form-data" action="{{url('produtoPrecos/busca')}}">
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
        
        <div class="form-group col-md-12">  
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>SKU</th>
                                <th>Produto</th>
                                <th>Fornecedor</th>
                                <th>Qtd em Estoque</th>
                                <th>Preço</th>
                                <th>Preço Frete</th>
                                <th>Tipo de Frete</th>
                                <th>Moeda</th>
                                <th>Ativ./Desa.</th>
                                <th>Modificar</th>                              
                                <th>Remover</th>
                            </tr>
                            @forelse ($produto_precos as $produto_preco)
                            <tr>
                                <td>{{$produto_preco->produto_id}}</td>                                
                                <td>
                                    @if($produto_preco->status)                                      
                                        <span class="btn btn-success btn-xs"> Liberado</span>                        
                                    @else
                                        <span class="btn btn-danger btn-xs">Bloqueado</span>
                                    @endif
                                </td>
                                <td>{{$produto_preco->sku}}</td>
                                <td>
                                    <a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->titulo}} 
                                    </a>
                                </td>
                                <td>
                                    @if($produto_preco->fornecedor_id)
                                        <a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->nome_fantasia}} 
                                        </a>
                                    @else
                                        <span class="btn btn-primary btn-xs">Nenhum</span>
                                    @endif
                                </td>
                                <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->produto_id}}">{{$produto_preco->quantidade}} {{$produto_preco->unidade_medida}}</a></td>
                                <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->produto_id}}">{{$produto_preco->preco}}</a></td>
                                <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->produto_id}}">{{$produto_preco->frete_preco}}</a></td>
                                <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->produto_id}}">{{$produto_preco->frete_tipo}}</a></td>
                                <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->produto_id}}">{{$produto_preco->moeda}}</a></td>
                                <td>
                                    <a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">
                                    @if($produto_preco->status)
                                        <a href="{{URL::to('produtoPrecos/disable/'.$produto_preco->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativar</a>
                                    @else
                                         <a href="{{URL::to('produtoPrecos/enable/'.$produto_preco->id)}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativar</a>
                                    @endif
                                    </a>
                                </td>
                                <td>
                                        <a class="btn btn-warning btn-xs" href="{{URL::to('produtoPrecos/'.$produto_preco->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                                    
                                </td>
                                <td>    


                                    <form method="POST" action="{{action('ProdutoPrecoController@destroy', $produto_preco->id)}}" id="formDelete{{$produto_preco->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                                        <!--<input type="submit" name="Excluir">-->

                                        <a href="javascript:confirmDelete{{$produto_preco->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Remover</a>
                                    </form> 

                                    <script>
                                       function confirmDelete{{$produto_preco->id}}() {

                                        var result = confirm('Tem certeza que deseja remover?');

                                        if (result) {
                                                document.getElementById("formDelete{{$produto_preco->id}}").submit();
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

                                
                            
                        </table>
                    </div>
                    <!-- /.box-body -->
        </div>

        <hr class="hr">
       
            <a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>

        
    @endsection
@endcan