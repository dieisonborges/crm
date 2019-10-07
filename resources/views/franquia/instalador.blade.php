@can('read_franquia')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Franquias  Instalador</h1>
             
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Domínio</th>                    
                    <th>Banco</th>
                    <th>Usuário</th>
                    <th>Iniciado</th>
                    <th>Finalizado</th>   
                    <th>Status</th>                  
                </tr>
                @forelse ($franquias as $franquia)
                <tr>
                    <td>{{$franquia->id}}</td>
                    <td>{{$franquia->codigo_franquia}}</td>
                    <td>{{$franquia->dominio}}</td>
                    <td>{{$franquia->banco}}</td>
                    <td>{{$franquia->usuario}}</td>
                    <td>
                        @if($franquia->iniciado)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Iniciado {{$franquia->iniciado}}</span>
                        @else
                            <span class="btn btn-waning btn-xs"><i class="fa fa-times-circle"></i> Em instalação {{$franquia->iniciado}}</span>
                        @endif
                    </td>
                    <td>
                        @if($franquia->finalizado)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Finalizado {{$franquia->finalizado}}</span>
                        @else
                            <span class="btn btn-waning btn-xs"><i class="fa fa-times-circle"></i> Em instalação {{$franquia->finalizado}}</span>
                        @endif
                    </td>

                    <td>
                        @if(($franquia->finalizado)==0)and(($franquia->iniciado)==1))
                            <span class="btn btn-danger btn-xs"><i class="fa fa-check"></i> Houve um problema na instalação da loja. {{$franquia->finalizado}} {{$franquia->iniciado}}</span>
                        @else
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Instalação Concluída com sucesso! {{$franquia->finalizado}} {{$franquia->iniciado}}</span>
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
