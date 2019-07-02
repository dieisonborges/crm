@can('read_fornecedor')  
    @extends('layouts.app')
    @section('title', 'Fornecedors')
    @section('content')
    <h1>Fornecedors  <a href="{{url('fornecedor/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

        @if (session('status'))
            <div class="alert alert-success" fornecedor="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('fornecedor/busca')}}">
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
                    <th>Nome Fantasia</th>
                    <th>e-Mail</th>
                    <th>Responsável</th>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>                    
                    <th>País</th>
                    <th>Status</th>
                    <th>Usuários</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                @forelse ($fornecedors as $fornecedor)
                <tr>
                    <td>{{$fornecedor->id}}</td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{ str_limit(strip_tags($fornecedor->nome_fantasia), $limit = 25, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{ str_limit(strip_tags($fornecedor->email), $limit = 30, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{ str_limit(strip_tags($fornecedor->responsavel), $limit = 10, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{ str_limit(strip_tags($fornecedor->razao_social), $limit = 10, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{$fornecedor->cnpj}}</a></td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{$fornecedor->telefone}}</a></td>
                    <td><a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">{{$fornecedor->endereco_pais}}</a></td>
                    <td>
                        <a href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">
                        @if($fornecedor->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}/usuarios">
                            <span class="fa fa-user"></span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('fornecedor')}}/{{$fornecedor->id}}">
                            <span class="fa fa-eye"> Ver</span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{{URL::to('fornecedor/'.$fornecedor->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="{{action('FornecedorController@destroy', $fornecedor->id)}}" id="formDelete{{$fornecedor->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$fornecedor->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete{{$fornecedor->id}}() {

                            var result = confirm('Tem certeza que deseja Excluir?');

                            if (result) {
                                    document.getElementById("formDelete{{$fornecedor->id}}").submit();
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

                {{$fornecedors->links()}}      
                
            </table>
        </div>
        <!-- /.box-body -->

    @endsection
@endcan
