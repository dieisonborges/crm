@extends('layouts.login')
@section('content')
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">

    <a href="/">
        <b style="display:none;">e-Cardume</b>
        <img src="{{ asset('img/logo/logo-ecardume.png') }}" width="100%">
    </a>

    <hr>

    @include('layouts.error')

    
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-door-closed"></i> Erro: 404</h4>
        Ops... Ficamos perdidos e não encontramos a página procurada;
    </div>

    <a class="btn btn-default" href="javascript:history.go(-1)"><span class="fa fa-arrow-left"></span> Voltar</a>

    <a class="btn btn-default" href="{{url('/')}}" style="float: right;"><span class="fa fa-home"></span> Login</a>

       


   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
