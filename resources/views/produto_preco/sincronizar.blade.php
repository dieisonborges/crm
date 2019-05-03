@can('read_produto_preco')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Produtos Precificados</h1>

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

        <a href="{{url('produto_precosIntegrada/sync')}}" class="btn btn-info btn-lg"><i class="fas fa-sync-alt"></i> Sincronizar</a>

        <hr class="hr col-md-12">           
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Locais (7p CRM)</h3> 
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Produto</th>
                    <th>Forne.</th>
                    <th>Qtd</th>
                    <th>Preço</th>
                    <th>Frete</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($produto_precos as $produto_preco)
                <tr>
                    <td>{{$produto_preco->id}}</td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->sku}}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->titulo}}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->nome_fantasia}}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->quantidade }}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->preco }}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->frete_preco }}</a></td>
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
                    <th>SKU</th>
                    <th>Produto</th>
                    <th>Forne.</th>
                    <th>Qtd</th>
                    <th>Preço</th>
                    <th>Frete</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($produto_precos as $produto_preco)
                <tr>
                    <td>{{$produto_preco->id}}</td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->sku}}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->titulo}}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->nome_fantasia}}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->quantidade }}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->preco }}</a></td>
                    <td><a href="{{URL::to('produto_precos')}}/{{$produto_preco->id}}">{{$produto_preco->frete_preco }}</a></td>
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
