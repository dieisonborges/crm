@can('read_lista_prospecto')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Sincronizar Franquias</h1>

        @if (session('status'))
            <div class="alert alert-success" lista_prospecto="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('lista_prospectosIntegrada/busca')}}">
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

        <a href="{{url('prospectosSincronizarUpdate')}}" class="btn btn-info btn-lg"><i class="fas fa-sync-alt"></i>Sincronizar</a>

        <hr class="hr col-md-12">           
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Locais (7p CRM)</h3> 
            <table class="table table-hover">
                <tr>
                    <th colspan="2">ID</th>
                    <th>Nome</th>
                    <th>e-mail</th>
                    <th>Telefone</th>                  
                </tr>
                @forelse ($lista_prospectos as $lista_prospecto)
                <tr>
                    <td>{{$lista_prospecto->id}}</td>
                    <td></td>
                    <td><a href="">{{$lista_prospecto->name}}</a></td>
                    <td><a href="">{{$lista_prospecto->email}}</a></td>
                    <td><a href="">{{$lista_prospecto->phone_number}}</a></td>
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
                    <th>ID7p</th>
                    <th>Nome</th>
                    <th>e-mail</th>
                    <th>Telefone</th>                     
                </tr>
                @forelse ($lista_prospectos_remotas as $lista_prospecto)
                <tr>
                    <td>{{$lista_prospecto->id}}</td>
                    <td>{{$lista_prospecto->id_7p}}</td>
                    <td><a href="">{{$lista_prospecto->name}}</a></td>
                    <td><a href="">{{$lista_prospecto->email}}</a></td>
                    <td><a href="">{{$lista_prospecto->phone_number}}</a></td>                                      
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
