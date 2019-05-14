@can('read_produto')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Sincronizar Produtos</h1>

        @if (session('status'))
            <div class="alert alert-success" produto="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('produtosSincronizar')}}">
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

        <a href="{{url('produtosSincronizarUpdate')}}" class="btn btn-info btn-lg"><i class="fas fa-sync-alt"></i> Sincronizar</a>

        <hr class="hr col-md-12">            
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Locais (7p CRM)</h3> 
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>SKU</th>
                    <th>Título</th>
                    <th>Palavras Chave</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($produtos as $produto)
                <tr>

                    <td colspan="2">{{$produto->id}}</td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->sku}}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{ str_limit(strip_tags($produto->titulo), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{ str_limit(strip_tags($produto->palavras_chave), $limit = 40, $end = '...') }}</a></td>                   
                    <td>
                        @if($produto->status)                                      
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
                    <th>Título</th>
                    <th>Palavras Chave</th>                  
                    <th>Status</th>                   
                </tr>
                @forelse ($produtos_remotos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->id_7p}}</td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->sku}}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{ str_limit(strip_tags($produto->titulo), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{ str_limit(strip_tags($produto->palavras_chave), $limit = 40, $end = '...') }}</a></td>                  
                    <td>
                        @if($produto->status)                                      
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
