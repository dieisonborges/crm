@can('read_franquia')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Franquias  <a href="{{url('franquias/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Nova Franquia</a></h1>

        @if (session('status'))
            <div class="alert alert-success" franquia="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('franquias/busca')}}">
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
                    <th>Código da Franquia</th>
                    <th>Nome</th>                    
                    <th>Url</th>
                    <th>Url Alt.</th>
                    <th>Status</th>
                    <th>Dono(s)</th>
                    <th>Ativar<br>Desativar</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                @forelse ($franquias as $franquia)
                <tr>
                    <td>{{$franquia->id}}</td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}/edit">{{$franquia->codigo_franquia}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}/edit">{{$franquia->nome}}</a></td>
                    
                    <td>
                        <a class="btn btn-primary btn-xs"  target="_blank" href="https://{{$franquia->loja_url}}">
                            <i class="fa fa-link"></i> {{$franquia->loja_url}}
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" target="_blank" href="https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br">
                            <i class="fa fa-link"></i> {{$franquia->loja_url_alternativa}}
                        </a>
                    </td>                    
                    <td>
                        <a href="{{URL::to('franquias')}}/{{$franquia->id}}/edit">
                        @if($franquia->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
                    </td>
                    <td>
                        
                            @php
                                $dono = $franquia->franquiaUser()->first();                                
                            @endphp

                            @if($dono)
                                <a class="btn btn-primary btn-xs" href="{{URL::to('franquias')}}/{{$franquia->id}}/edit/donos">
                                    <span class="fa fa-users"> {{$dono->apelido}}</span>
                                </a>
                            @else
                                <a class="btn btn-danger btn-xs" href="{{URL::to('franquias')}}/{{$franquia->id}}/edit/donos">
                                    <span class="fa fa-users"> Nenhum</span>
                                </a>
                            @endif                    
                        </a>
                    </td>
                    <td>
                        <a href="{{URL::to('franquias')}}/{{$franquia->id}}/edit">
                        @if($franquia->status)
                            <a href="{{URL::to('franquias/disable/'.$franquia->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativar</a>
                        @else
                             <a href="{{URL::to('franquias/enable/'.$franquia->id)}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativar</a>
                        @endif
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{{URL::to('franquias/'.$franquia->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="{{action('FranquiaController@destroy', $franquia->id)}}" id="formDelete{{$franquia->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$franquia->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete{{$franquia->id}}() {

                            var result = confirm('Tem certeza que deseja desativar?');

                            if (result) {
                                    document.getElementById("formDelete{{$franquia->id}}").submit();
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

                {{$franquias->links()}}      
                
            </table>
        </div>
        <!-- /.box-body -->

    @endsection
@endcan
