@can('read_produto_preco')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Sincronizar Preços de Produtos</h1>

        @if (session('status'))
            <div class="alert alert-success" produto_preco="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('produtoPrecosSincronizar')}}">
                @csrf
                <input type="hidden" name="_method" value="GET">
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="{{$buscar}}">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
     
        </div>

        <br><br><br>    

        <hr class="hr col-md-12">

        <a href="{{url('produtoPrecosSincronizarUpdate')}}" class="btn btn-info btn-lg"><i class="fas fa-sync-alt"></i> Sincronizar</a>

        <hr class="hr col-md-12">            
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Locais (7p CRM)</h3> 
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>SKU</th>
                    <th>Produto</th>
                    <!--<th>Forne.</th>-->
                    <th>Qtd</th>
                    <th>Preço</th>
                    <th>Frete</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($produto_precos as $produto_preco)
                <tr>

                    <td colspan="2">{{$produto_preco->id}}</td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->sku}}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{ str_limit(strip_tags($produto_preco->titulo), $limit = 40, $end = '...') }}</a></td>
                    <!--<td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->nome_fantasia}}</a></td>-->
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->quantidade }}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->preco }}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->frete_preco }}</a></td>
                    <td>
                        @if($produto_preco->status)                                      
                            <span class="btn btn-success btn-xs"> Liberado</span>                        
                        @else
                            <span class="btn btn-danger btn-xs">Bloqueado</span>
                        @endif
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

        

            
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Remotas (Lic - Lojas)</h3> 
            <table class="table table-hover">
                <tr>                    
                    <th>ID</th>
                    <th>7P</th>
                    <th>SKU</th>
                    <th>Produto</th>
                    <th>Qtd</th>
                    <th>Preço</th>
                    <th>Frete</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($produto_precos_remotos as $produto_preco)
                <tr>
                    <td>{{$produto_preco->id}}</td>
                    <td>{{$produto_preco->id_7p}}</td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->sku}}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{ str_limit(strip_tags($produto_preco->titulo), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->quantidade }}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->preco }}</a></td>
                    <td><a href="{{URL::to('produtoPrecos')}}/{{$produto_preco->id}}">{{$produto_preco->frete_preco }}</a></td>
                    <td>
                        @if($produto_preco->status)                                      
                            <span class="btn btn-success btn-xs"> Liberado</span>                        
                        @else
                            <span class="btn btn-danger btn-xs">Bloqueado</span>
                        @endif
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

    @endsection
@endcan
