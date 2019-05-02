@can('read_franquia')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Franquias Integradas <a href="{{url('franquias/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Nova Franquia</a></h1>

        @if (session('status'))
            <div class="alert alert-success" franquia="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('franquiasIntegrada/busca')}}">
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

        <hr class="hr col-md-12">

        <a href="{{url('franquiasIntegrada/sync')}}" class="btn btn-info btn-lg"><i class="fa fa-refresh"> </i> Sincronizar</a>

        <hr class="hr col-md-12">           
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Locais</h3> 
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Slogan</th>
                    <th>Descrição</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($franquias as $franquia)
                <tr>
                    <td>{{$franquia->id}}</td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{$franquia->codigo_franquia}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{$franquia->nome}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{ str_limit(strip_tags($franquia->slogan), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{ str_limit(strip_tags($franquia->descricao), $limit = 40, $end = '...') }}</a></td>
                    <td>
                        <a href="{{URL::to('franquias')}}/{{$franquia->id}}">
                        @if($franquia->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
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
            <h3>Franquias Remotas (Lojas)</h3> 
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Slogan</th>
                    <th>Descrição</th>
                    <th>Status</th>                   
                </tr>
                @forelse ($franquias_remotas as $franquia)
                <tr>
                    <td>{{$franquia->id}}</td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{$franquia->codigo_franquia}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{$franquia->nome}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{ str_limit(strip_tags($franquia->slogan), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{ str_limit(strip_tags($franquia->descricao), $limit = 40, $end = '...') }}</a></td>
                    <td>
                        <a href="{{URL::to('franquias')}}/{{$franquia->id}}">
                        @if($franquia->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
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
