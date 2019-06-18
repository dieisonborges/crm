@extends('layouts.app')
@section('title', 'Convites')
@section('content')
<h1>Convites Cadastrados <small>Franqueado</small>  </h1>

<hr class="hr col-md-12">

<span class="btn btn-success">Convites Disponíveis: <b>{{$qtd_convites_usuario-$qtd_convites_usados}}</b></span>
<span class="btn btn-primary">Convites Total: <b>{{$qtd_convites_usuario}}</b></span>
<span class="btn btn-warning">Convites Utilizados: <b>{{$qtd_convites_usados}}</b></span>

@if(($qtd_convites_usuario-$qtd_convites_usados)>0)

<a style="float: right;" href="{{url('franqueados/convite/create')}}" class="btn btn-info"><i class="fa fa-paper-plane"> </i> Enviar Novo Convite</a>

@else

<span style="float: right;" class="btn btn-danger">Nenhum Convite Disponível</span>

@endif

<hr class="hr col-md-12">

    @if (session('status'))
        <div class="alert alert-success" convite="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="{{url('franqueados/convites/busca')}}">
            @csrf
            <div class="input-group input-group-lg">			
                <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="{{$buscar}}">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                    </span>

            </div>
        </form>
 
    </div>

    <hr class="hr col-md-12">

    <br><br><br>

    
    <div class="box-header">
        <br>
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
                <th>Afiliado</th>
                <th>Reenviar:</th>   
                <th>Usado:</th>
            </tr>
            @forelse ($convites as $convite)
            <tr>
                <td>{{$convite->id}}</td>
                <td><a href="{{URL::to('franqueados/conviteShow')}}/{{$convite->id}}">{{$convite->email}}</a></td>
                <td><a href="{{URL::to('franqueados/conviteShow')}}/{{$convite->id}}">{{$convite->codigo}}</a></td>
                <td>
                <a href="{{URL::to('franqueados/conviteShow')}}/{{$convite->id}}">
                    {{date('d/m/Y H:i:s', strtotime($convite->created_at))}}
                </a></td>
                <td><a href="{{URL::to('franqueados/conviteShow')}}/{{$convite->id}}">
                    {{date('d/m/Y H:i:s', strtotime('+2 days', strtotime($convite->created_at)))}}
                    </a>
                </td>
                <td>
                    @if($convite->status)
                        <span class="btn btn-warning btn-xs">Sem Cadastro</span>
                    @else

                        @if($convite->franquia_id)
                            <span class="btn btn-success btn-xs">O Convite já gerou uma franquia</span>
                        @else
                            <a class='btn btn-primary btn-xs' href="{{URL::to('franqueados/franquiaCreate/'.$convite->id)}}"><i class="fa fa-store"></i> Gerar Franquia</a>
                        @endif                        
                        
                    @endif
                </td> 
                <td>
                    @if($convite->status)
                        <a class='btn btn-primary btn-xs' href="{{URL::to('convites/reenviar/'.$convite->id)}}"><i class="fa fa-paper-plane"></i> Reenviar</a>
                    @else
                        <span class="btn btn-success btn-xs">Foi Utilizado</span>
                    @endif
                </td> 
                <td>
                        @if($convite->status)
                            <a class='btn btn-danger btn-xs' href="{{URL::to('franqueados/conviteShow')}}/{{$convite->id}}">NÃO</a>
                        @else
                            <a class='btn btn-success btn-xs' href="{{URL::to('franqueados/conviteShow')}}/{{$convite->id}}">SIM</a>
                        @endif
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
