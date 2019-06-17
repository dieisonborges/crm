@extends('layouts.app')
@section('title', 'Franqueados VIP')
@section('content')
<h1><i class="fa fa-certificate text-blue"></i>
    Franqueados VIP    
 <a href="{{url('franqueadoVip/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Adicionar Novo Franquado VIP</a></h1>

    @if (session('status'))
        <div class="alert alert-success" score="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="{{url('franqueadoVip/busca')}}">
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
        <h3 class="box-title">Franqueados VIP: <b>{{count($franqueado_vips)}}</b></h3>


        
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Apelido</th>
                <th>Nome</th>                
                <th>e-mail</th>
                <th>CPF</th>
                <th>Convites</th>
                <th>Líder</th>
                <th>Destituir</th>
            </tr>
            @forelse ($franqueado_vips as $franqueado_vip)
            <tr>
                <td><a href="{{URL::to('users')}}/{{$franqueado_vip->id}}/">{{$franqueado_vip->id}}</a></td>
                <td><a href="{{URL::to('users')}}/{{$franqueado_vip->id}}">{{$franqueado_vip->apelido}}</a></td>
                <td><a href="{{URL::to('users')}}/{{$franqueado_vip->id}}">{{$franqueado_vip->name}}</a></td>
                <td><a href="{{URL::to('users')}}/{{$franqueado_vip->id}}">{{$franqueado_vip->email}}</a></td>
                <td><a href="{{URL::to('users')}}/{{$franqueado_vip->id}}">{{$franqueado_vip->cpf}}</a></td>
                <td>
                    <a class="btn btn-primary btn-xs" href="{{URL::to('user/'.$franqueado_vip->id.'/convites')}}"> 

                        <i class="fa fa-edit"></i> |  

                        {{$franqueado_vip->qtd_convites}}</a>
                </td>
                <td>
                    <a href="{{URL::to('users')}}/{{$franqueado_vip->id}}">
                    @if(($franqueado_vip->lider)==0)
                        <span class="btn btn-primary btn-xs">VIP</span>
                    @else
                        <span class="btn btn-danger btn-xs"><i class="fa fa-rocket"></i> LÍDER VIP</span>
                    @endif
                    </a>
                </td>
                <td>

                    <form method="POST" action="{{action('FranqueadoVipController@destroy', $franqueado_vip->vip_id)}}" id="formDelete{{$franqueado_vip->vip_id}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">

                        <a href="javascript:confirmDelete{{$franqueado_vip->vip_id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Destituir</a>
                    </form> 

                    <script>
                       function confirmDelete{{$franqueado_vip->vip_id}}() {

                        var result = confirm('Tem certeza que deseja destituir?');

                        if (result) {
                                document.getElementById("formDelete{{$franqueado_vip->vip_id}}").submit();
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
            
        </table>
    </div>
    <!-- /.box-body -->
    {{$franqueado_vips->links()}}

@endsection
