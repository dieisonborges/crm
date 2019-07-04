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
        <h4><i class="icon fa fa-ban"></i> Erro: 503 </h4>

        <h2><i class="fa fa-wrench"></i> Estamos efetuando uma manutenção crítica em nossos servidores, voltamos em breve... :)</h2>
        

        <br>
        <small>Service Unavailable</small>
        <br>
        <small>Serviço Indisponível</small>
        <br>

    </div>

    <a class="btn btn-default" href="javascript:history.go(-1)"><span class="fa fa-arrow-left"></span> Voltar</a>

    <a class="btn btn-default" href="{{url('/')}}" style="float: right;"><span class="fa fa-home"></span> Login</a>

       


   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection