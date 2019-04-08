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

        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>0</h3>

              <p>Vendas</p>
            </div>
            <a href="{{url('franqueados/alocar')}}">
              <div class="icon">                
                    <i class="fa fa-shopping-cart"></i>                
              </div>
            </a>
            <a href="{{url('franqueados/alocar')}}" class="small-box-footer">Visualizar Vendas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


         <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>0</h3>
              <p>Produtos em Transporte</p>
            </div>
            <a href="{{url('franqueados/tickets/1/status')}}">
              <div class="icon">                
                    <i class="fa fa-truck"></i>                
              </div>
            </a>
            <a href="{{url('franqueados/tickets/1/status')}}" class="small-box-footer">Visualizar Produtos em Transporte <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>0</h3>

              <p>Produtos Entregues</p>
            </div>
            <a href="{{url('franqueados/tickets/0/status')}}">
              <div class="icon">
                <i class="fa fa-house"></i>
              </div>
            </a>
            <a href="{{url('franqueados/tickets/0/status')}}" class="small-box-footer">Visualizar Produtos Entregues <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>2</h3>

              <p>Reclamações</p>
            </div>
            <a href="{{url('franqueados/tickets/0/status')}}">
              <div class="icon">
                <i class="fa fa-ticket"></i>
              </div>
            </a>
            <a href="{{url('franqueados/tickets/0/status')}}" class="small-box-footer">Visualizar Produtos Entregues <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


    
        
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
