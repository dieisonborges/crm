@can('read_franqueado')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
        <h1><i class="fa fa-building"></i> Franquias</h1>

        @if (session('status'))
            <div class="alert alert-success" franquia="alert">
                {{ session('status') }}
            </div>
        @endif
       
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <div class="box-header with-border">
              <h3 class="box-title">Minhas Franquias</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Abrir loja</th>
                    <th>Gerenciar</th>

                </tr>
                @forelse ($franquias as $franquia)
                <tr>
                    <td>{{$franquia->id}}</td>
                    <td><a href="{{URL::to('franqueados')}}/{{$franquia->id}}/dashboard">{{$franquia->codigo_franquia}}</a></td>
                    <td><a href="{{URL::to('franqueados')}}/{{$franquia->id}}/dashboard">{{$franquia->nome}}</a></td>
                    <td><a href="{{URL::to('franqueados')}}/{{$franquia->id}}/dashboard">{{ str_limit(strip_tags($franquia->descricao), $limit = 40, $end = '...') }}</a></td>
                    
                    <td>
                        <a href="{{URL::to('franqueados')}}/{{$franquia->id}}/dashboard">
                        @if($franquia->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
                    </td>

                    <td> 
                        
                        @if($franquia->status)
                            <a href="https://{{$franquia->loja_url}}" target="_blank">
                                <span class="btn btn-primary btn-xs"><i class="fa fa-link"></i> Principal</span>
                            </a>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                       
                                            
                        @if($franquia->status)
                            <a href="https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br" target="_blank">
                                <span class="btn btn-warning btn-xs"><i class="fa fa-link"></i> Alternativo</span>
                            </a>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                       
                    </td>

                    <td>
                        
                        @if($franquia->status)
                            <a href="{{URL::to('franqueados')}}/{{$franquia->id}}/dashboard">
                                <span class="btn btn-primary btn-xs"><i class="fas fa-wrench"></i> Gerenciar</span>
                            </a>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
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

        <br>
        <hr class="hr">
        <br>
    
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <div class="box-header with-border">
              <h3 class="box-title">Meus Afiliados</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ver</th>
                </tr>
                @forelse ($afiliados as $afiliado)
                <tr>
                    <td>{{$afiliado->id}}</td>
                    <td><a href="{{URL::to('franqueados')}}/{{$afiliado->id}}/dashboard">{{$afiliado->codigo_franquia}}</a></td>
                    <td><a href="{{URL::to('franqueados')}}/{{$afiliado->id}}/dashboard">{{$afiliado->nome}}</a></td>
                    <td><a href="{{URL::to('franqueados')}}/{{$afiliado->id}}/dashboard">{{ str_limit(strip_tags($afiliado->descricao), $limit = 40, $end = '...') }}</a></td>
                    <td>
                        <a href="{{URL::to('franqueados')}}/{{$afiliado->id}}/dashboard">
                        @if($afiliado->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
                    </td>

                    <td>
                        <a href="{{URL::to('franqueados')}}/{{$afiliado->id}}/dashboard">
                        @if($afiliado->status)
                            <span class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Visualizar</span>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
                    </td>                  
                    
                </tr>                
                @empty

                <tr>
                    <td><b>Nenhum Afiliado.</b></td>
                </tr>
                    
                @endforelse      
                
            </table>
        </div>
        <!-- /.box-body -->

    @endsection
@endcan
