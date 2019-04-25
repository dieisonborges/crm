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

    <a class="btn btn-primary" href="javascript:history.go(-1)">Voltar</a>

       


   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
