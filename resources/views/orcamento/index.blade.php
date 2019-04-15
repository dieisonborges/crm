@can('read_orcamento')  
    @extends('layouts.app')
    @section('title', 'Orcamentos')
    @section('content')
    <h1>Orçamentos  <a href="{{url('orcamento/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Criar Novo</a></h1>

        @if (session('status'))
            <div class="alert alert-success" orcamento="alert">
                {{ session('status') }}
            </div> 
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('orcamento/busca')}}">
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
                    <th>Código</th>
                    <th>Validade do Token</th>
                    <th>Criado em</th>
                    <th>Enviar</th>
                    <th>Status</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                @forelse ($orcamentos as $orcamento)
                <tr>
                    <td>{{$orcamento->id}}</td>
                    <td><a href="{{URL::to('orcamento')}}/{{$orcamento->id}}">{{$orcamento->codigo}}</a></td>
                    <td><a href="{{URL::to('orcamento')}}/{{$orcamento->id}}">{{ date('d/m/Y', strtotime($orcamento->token_validade)) }}</a></td>
                    <td><a href="{{URL::to('orcamento')}}/{{$orcamento->id}}">{{ date('d/m/Y H:i:s', strtotime($orcamento->created_at)) }}</a></td>
                    
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('orcamento')}}/{{$orcamento->id}}/enviar">
                            <span class="fa fa-paper-plane"> Enviar</span>                        
                        </a>
                    </td>
                    <td>
                        @if($orcamento->status==0)
                            <span class="btn btn-primary btn-xs">Em edição</span> 
                        @elseif($orcamento->status==1)
                            <span class="btn btn-warning btn-xs">Bloqueado: Enviado para cotação</span> 
                        @elseif($orcamento->status==2)
                            <span class="btn btn-danger btn-xs">Cancelado</span> 
                        @else($orcamento->status==3)
                            <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('orcamento')}}/{{$orcamento->id}}">
                            <span class="fa fa-eye"> Ver</span>                        
                        </a>
                    </td>
                    <td>
                        @if(($orcamento->status)==0)
                            <a class="btn btn-warning btn-xs" href="{{URL::to('orcamento/'.$orcamento->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                        @else
                            <span class="btn btn-warning btn-xs">Bloqueado</span>
                        @endif
                    </td>
                    <td>

                        @if(($orcamento->status)==0)

                        <form method="POST" action="{{action('OrcamentoController@destroy', $orcamento->id)}}" id="formDelete{{$orcamento->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$orcamento->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Remover</a>
                        </form> 

                        <script>
                           function confirmDelete{{$orcamento->id}}() {

                            var result = confirm('Tem certeza que deseja remover?');

                            if (result) {
                                    document.getElementById("formDelete{{$orcamento->id}}").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                        @else
                            <span class="btn btn-warning btn-xs">Bloqueado</span>
                        @endif

                    </td>
                </tr>                
                @empty

                <tr>
                    <td><b>Nenhum Resultado.</b></td>
                </tr>
                    
                @endforelse      

                {{$orcamentos->links()}}      
                
            </table>
        </div>
        <!-- /.box-body -->

    @endsection
@endcan
