@can('read_franqueado')    
    @extends('layouts.appdashboard')
    @section('title', 'Dashboard')
    @section('content')    
    
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Painel de Controle <small>{{$franquia->nome}}</small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard </li>
      </ol>
    </section>

   
    <div class="col-lg-12 col-xs-12">
      @include('layouts.error')
    </div>   


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <a href="https://{{$franquia->loja_url}}" target="_blank">
              <span class="info-box-icon"><i class="fa fa-store text-white"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Laboratório e-Cardume</span>
              <span class="info-box-number">{{$franquia->nome}}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
              <span class="progress-description">
                    Loja 40% Concluída, previsão 01 de Agosto de 2019.
              </span>
            </div>
            <!-- /.info-box-content -->
            
          </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="{{url('franqueados/'.$franquia->id.'/configuracoes')}}">
              <span class="info-box-icon bg-olive"><i class="fa fa-tools"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Configurações</span>
              <span class="info-box-number">Dados importantes de sua Franquia.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="{{url('franqueados/'.$franquia->id.'/produtosFranqueado')}}">
              <span class="info-box-icon bg-blue"><i class="fa fa-shopping-bag"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Produtos</span>
              <span class="info-box-number">Produtos de sua franquia.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-exclamation-triangle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Parabéns</span>
              <span class="info-box-number">Franquia em desenvolvimento.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        

        


  


    
        
      </div>
      <!-- /.row -->
      <!-- Main row -->     

   
      <!-- Info boxes -->
      <div class="row">
               
        
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
     
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    @endsection
@endcan
