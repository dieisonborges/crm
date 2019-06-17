@can('update_user')  
    @extends('layouts.app')
    @section('title', 'Regras')
    @section('content')

    <h1>Convites</h1>

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary col-md-3 bg-aqua">
                    <br>
                    <h2 class="box-title">Usuário: <b>{{$user->name}}</b></h2>
                    <br><br>
                    <h2 class="box-title">Email: <b>{{$user->email}}</b></h2>
                    <br><br>
                    <h2 class="box-title">CPF: <b>{{$user->cpf}}</b></h2>
                    <br><br>
                </div>

                @if($user->franqueadoVip()->count())

                <form method="POST" action="{{action('UserController@conviteUpdate')}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    
                    <label>Convites do Usuário:</label>
                    <br>
                    <input type="number" name="qtd_convites" value="{{$user->qtd_convites}}">
                    <br><br>
                    <input class="btn btn-warning btn-sm" type="submit" value="Modificar">
                </form>

                @else

                <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="fa fa-times"></i> Não é um franqueado VIP</a>

                @endif

            </div>

        </div>

        
        
       

    @endsection
@endcan
