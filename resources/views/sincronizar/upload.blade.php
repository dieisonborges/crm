@can('read_upload')  
    @extends('layouts.app')
    @section('title', 'Franquias')
    @section('content')
    <h1>Sincronizar Uploads</h1>

        @if (session('status'))
            <div class="alert alert-success" upload="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('uploadsSincronizar')}}">
                @csrf
                <input type="hidden" name="_method" value="GET">
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

        <a href="{{url('uploadsSincronizarUpdate')}}" class="btn btn-info btn-lg"><i class="fas fa-sync-alt"></i> Sincronizar</a>

        <hr class="hr col-md-12">            
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Franquias Locais (7p CRM)</h3> 
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>Nome</th>
                    <th>Título</th>
                    <th>Link</th>
                    <th>Dir</th>
                    <th>Ext</th>
                    <th>Tipo</th>                 
                </tr>
                @forelse ($uploads as $upload)
                <tr>
                    <td colspan="2">{{$upload->id}}</td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->nome}}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{ str_limit(strip_tags($upload->titulo), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{ str_limit(strip_tags($upload->link), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->dir}}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->ext}}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->tipo}}</a></td>                                       
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
                    <th>7P</th>
                    <th>Nome</th>
                    <th>Título</th>
                    <th>Link</th>
                    <th>Dir</th>
                    <th>Ext</th>
                    <th>Tipo</th>                   
                </tr>
                @forelse ($uploads_remotos as $upload)
                <tr>
                    <td>{{$upload->id}}</td>
                    <td>{{$upload->id_7p}}</td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->nome}}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{ str_limit(strip_tags($upload->titulo), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{ str_limit(strip_tags($upload->link), $limit = 40, $end = '...') }}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->dir}}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->ext}}</a></td>
                    <td><a href="{{URL::to('uploads')}}/{{$upload->id}}">{{$upload->tipo}}</a></td>  
                                       
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
