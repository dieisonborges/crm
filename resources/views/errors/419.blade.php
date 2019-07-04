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
        <h4><i class="icon fa fa-hourglass-end"></i> Erro: 419</h4>

        <h5>A página expirou devido a inatividade.<br>
        Por favor, atualize e tente novamente.</h5>

        <small>The page has expired due to inactivity. <br>
        Please refresh and try again.</small>
    </div>

    <a class="btn btn-default" href="javascript:history.go(-1)"><span class="fa fa-arrow-left"></span> Voltar</a>

    <a class="btn btn-default" href="{{url('/')}}" style="float: right;"><span class="fa fa-home"></span> Login</a>

       


   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
