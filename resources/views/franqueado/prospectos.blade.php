@can('read_franqueado')    
    @extends('layouts.app')
    @section('title', 'Lista Prospectos')
    @section('content')    
    <h1>Lista de Prospectos

    <a href="{{url('listaProspectos/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>

    </h1>



        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="">
                @csrf
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
     
        </div> 

        <br><br><br>

        
        <div class="box-header">
            <h3 class="box-title">Gerência de Lista de Propectos</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Perfil</th>
                </tr>
                @forelse ($lista_prospectos as $lista_prospecto)
                <tr>
                    <td>{{$lista_prospecto->id}}</td>
                    <td>
                        <a href="{{URL::to('franqueados/'.$franqueado->id.'/prospectos/'.$lista_prospecto->id)}}">{{$lista_prospecto->name}}</a>
                    </td>
                    <td>
                        <a href="{{URL::to('franqueados/'.$franqueado->id.'/prospectos/'.$lista_prospecto->id)}}">{{$lista_prospecto->email}}</a>
                    </td>
                    <td>
                        <a href="{{URL::to('franqueados/'.$franqueado->id.'/prospectos/'.$lista_prospecto->id)}}">{{$lista_prospecto->phone_number}}</a>
                    </td>
                    <td>
                        <a href="{{URL::to('franqueados/'.$franqueado->id.'/prospectos/'.$lista_prospecto->id)}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-eye"></i> Ver
                        </a>
                    </td>                    
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$lista_prospectos->links()}}

    @endsection
@endcan
