@can('read_categoria')    
    @extends('layouts.app')
    @section('title', 'Categorias')
    @section('content')    
    <h1>Categorias <a href="{{url('categorias/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>  </h1>



        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('categorias/busca')}}">
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
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                @forelse ($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>

                    <td>
                        <a href="{{URL::to('categorias')}}/{{$categoria->id}}">{{$categoria->nome}}</a>
                    </td>                 
                    
                    <td>
                        <a href="{{URL::to('categorias')}}/{{$categoria->id}}">{{$categoria->descricao}}</a>
                    </td>

                    <td>
                        <a class="btn btn-warning btn-xs" href="{{URL::to('categorias/'.$categoria->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    
                    <td>

                        <form method="POST" action="{{action('CategoriaController@destroy', $categoria->id)}}" id="formDelete{{$categoria->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$categoria->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete{{$categoria->id}}() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete{{$categoria->id}}").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                    </td>
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$categorias->links()}}

    @endsection
@endcan
