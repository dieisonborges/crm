@extends('layouts.app')
@section('title', 'Score')
@section('content')
<h1>Score <a href="{{url('scores/create')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Adicionar Nova Pontuação</a></h1>

    @if (session('status'))
        <div class="alert alert-success" score="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="{{url('scores/busca')}}">
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
        <h3 class="box-title">Usuários</h3>
        
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
                <th>Score</th>
            </tr>
            @forelse ($scores as $score)
            <tr>
                <td><a href="{{URL::to('scores')}}/{{$score->id}}/">{{$score->id}}</a></td>
                <td><a href="{{URL::to('scores')}}/{{$score->id}}">{{$score->apelido}}</a></td>
                <td><a href="{{URL::to('scores')}}/{{$score->id}}">{{$score->name}}</a></td>
                <td><a href="{{URL::to('scores')}}/{{$score->id}}">{{$score->email}}</a></td>
                <td><a href="{{URL::to('scores')}}/{{$score->id}}">{{$score->cpf}}</a></td>
                <td><a href="{{URL::to('scores')}}/{{$score->id}}">{{$score->valor}}</a></td>
            </tr>                
            @empty

            <tr>
                <td><b>Nenhum Resultado.</b></td>
            </tr>
                
            @endforelse            
            
        </table>
    </div>
    <!-- /.box-body -->
    {{$scores->links()}}

@endsection
