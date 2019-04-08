@can('read_franqueado')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Minhas Franquias</h1>

        @if (session('status'))
            <div class="alert alert-success" franquia="alert">
                {{ session('status') }}
            </div>
        @endif
       
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
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
                            <span class="btn btn-warning btn-xs"><i class="fa fa-close"></i> Desativado</span>
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
