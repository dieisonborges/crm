@extends('layouts.app')
@section('title', 'Convites')
@section('content')
<h1>Convites Cadastrados  <a href="{{url('convites/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

    @if (session('status'))
        <div class="alert alert-success" convite="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="{{url('convites/busca')}}">
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

    
    <div class="box-header">
        <h3 class="box-title">Convites Cadastrados</h3>
        
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>e-mail</th>
                <th>Código</th> 
                <th>Gerado em:</th>
                <th>Expira em:</th>   
                <th>Usado:</th>                
                <th>Excluir</th>
            </tr>
            @forelse ($convites as $convite)
            <tr>
                <td>{{$convite->id}}</td>
                <td><a href="{{URL::to('convites')}}/{{$convite->id}}">{{$convite->email}}</a></td>
                <td><a href="{{URL::to('convites')}}/{{$convite->id}}">{{$convite->codigo}}</a></td>
                <td>
                <a href="{{URL::to('convites')}}/{{$convite->id}}">
                    {{date('d/m/Y H:i:s', strtotime($convite->created_at))}}
                </a></td>
                <td><a href="{{URL::to('convites')}}/{{$convite->id}}">
                    {{date('d/m/Y H:i:s', strtotime('+2 days', strtotime($convite->created_at)))}}
                    </a></td>
                <td>
                        @if($convite->status)
                            <a class='btn btn-danger btn-xs' href="{{URL::to('convites')}}/{{$convite->id}}/updateStatus/0">NÃO</a>
                        @else
                            <a class='btn btn-success btn-xs' href="{{URL::to('convites')}}/{{$convite->id}}/updateStatus/1">SIM</a>
                        @endif
                </td>               
                <td>

                    <form method="POST" action="{{action('ConviteController@destroy', $convite->id)}}" id="formDelete{{$convite->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                        <!--<input type="submit" name="Excluir">-->

                        <a href="javascript:confirmDelete{{$convite->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDelete{{$convite->id}}() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDelete{{$convite->id}}").submit();
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

            {{$convites->links()}}      
            
        </table>
    </div>
    <!-- /.box-body -->

@endsection
