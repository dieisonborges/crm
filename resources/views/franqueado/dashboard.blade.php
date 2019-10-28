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

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="https://{{$franquia->store_url}}" target="_blank">
                <span class="info-box-icon">

                  @if($imagem)  
                      <img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" width="80%">
                  @else
                      <img src="{{ asset('img/default-image-store.png') }}" width="80%">
                  @endif

                </span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Loja Virtual: <b>{{$franquia->codigo_franquia}}</b></span>
                <span class="info-box-number">{{$franquia->nome}}</span>                
                Assinante Desde: <b>{{date('m/Y', strtotime($franquia->created_at))}}</b>
                
              </div>
            </div>
        </div>
        
        @can('read_woocommerce')

        @if($woo_status)

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="https://{{$franquia->store_url}}" target="_blank">
                <span class="info-box-icon bg-aqua"><i class="fa fa-external-link-alt"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Link da Loja</span>
                <span class="info-box-number">{{$franquia->nome}}</span>
                <small>
                  <a href="{{$franquia->store_url}}" class="btn btn-default" target="_blank">
                      {{$franquia->store_url}}
                      <i class="fa fa-link"></i>
                  </a>
                </small>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br" target="_blank">
                <span class="info-box-icon bg-aqua"><i class="fa fa-external-link-alt"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Link Alternativo da Loja</span>
                <span class="info-box-number">{{$franquia->nome}}</span>
                <small>
                  <a href="https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br" class="btn btn-default" target="_blank">
                      https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br
                      <i class="fa fa-link"></i>
                  </a>
                </small>
              </div>
            </div>
          </div>

          <hr class="hr col-md-12">

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{url('franqueados/'.$franquia->id.'/produtos/1')}}">
                <span class="info-box-icon bg-info"><i class="fa fa-gifts"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Produtos</span>
                <span class="info-box-number">Listagem de produtos.</span>
                <a href="{{url('franqueados/'.$franquia->id.'/produtos/1')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{url('franqueados/'.$franquia->id.'/pedidos/1')}}">
                <span class="info-box-icon bg-info"><i class="fa fa-shopping-cart"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Pedidos</span>
                <span class="info-box-number">Listagem de pedidos.</span>
                <a href="{{url('franqueados/'.$franquia->id.'/pedidos/1')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{url('franqueados/'.$franquia->id.'/clientes/1')}}">
                <span class="info-box-icon bg-info"><i class="fa fa-user"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Clientes</span>
                <span class="info-box-number">Listagem de clientes.</span>
                <a href="{{url('franqueados/'.$franquia->id.'/clientes/1')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{url('franqueados/'.$franquia->id.'/cupons/1')}}">
                <span class="info-box-icon bg-info"><i class="fa fa-ticket-alt"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Cupons</span>
                <span class="info-box-number">Cupons de Desconto.</span>
                <a href="{{url('franqueados/'.$franquia->id.'/cupons/1')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>
                
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{url('franqueados/'.$franquia->id.'/categorias/1')}}">
                <span class="info-box-icon bg-info"><i class="fa fa-list-alt"></i></span>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Categorias</span>
                <span class="info-box-number">Categorias de produtos.</span>
                <a href="{{url('franqueados/'.$franquia->id.'/categorias/1')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>
                
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        @else
        <div class="col-md-12">
          <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-unlink"></i> Atenção!</h4>
              Sua loja virtual não está configurada.
          </div>
        </div>

        @endif

        <hr class="hr col-md-12">

        @endcan        
        
        
        <!-- /.col -->
        <!--
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br" target="_blank">
              <span class="info-box-icon bg-aqua"><i class="fa fa-link"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Alternativo</span>
              <span class="info-box-number">Link.</span>
              <small>{{$franquia->loja_url_alternativa}}.venderaqui.com.br</small>
            </div>
          </div>
        </div>
        -->
        <!-- /.col -->       
        
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="{{url('franqueados/'.$franquia->id.'/configuracoes')}}">
              <span class="info-box-icon bg-olive"><i class="fa fa-tools"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Dados importantes de sua Loja.</span>
              <span class="info-box-number">Configurações</span>

              <a href="{{url('franqueados/'.$franquia->id.'/configuracoes')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="{{url('franqueados/convites')}}">
              <span class="info-box-icon bg-aqua"><i class="fa fa-store"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Convites</span>
              <span class="info-box-number">Novos Assinantes</span>
              <a href="{{url('franqueados/'.$franquia->id.'/configuracoes')}}" class="btn btn-default"> <i class="fa fa-edit"></i> Administrar</a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <a href="{{url('lojaFranqueado')}}" target="_blank">
              <span class="info-box-icon"><i class="fa fa-shopping-bag text-white"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Catálogo Referência</span>
              <span class="info-box-number">Loja do Assinante</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    Produtos de referência
              </span>
            </div>
            <!-- /.info-box-content -->
            
          </div>
        </div>
    
        
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
