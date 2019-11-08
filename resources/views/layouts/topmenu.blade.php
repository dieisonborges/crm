<header class="main-header" id="main-header">
    <!-- Logo -->
    <a href="{{ url('home/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
          <img src="{{ asset('img/logo/logo-e-ecardume-mini-v3.png') }}" width="70%">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="{{ asset('img/logo/logo-ecardume-branca-v2-com.png') }}" width="190">        
      </span>    
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navegação</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

              
              <!-- -------------------- MENU ICON TOP ------------------------- -->

              <li class="dropdown messages-menu">
                <a href="{{url('clients/create')}}" class="dropdown-toggle" alt="Novo Ticket">
                  <i class="fas fa-ticket-alt"></i>
                  <span class="label label-info">+</span>
                </a>
                
              </li>  

              <li class="dropdown messages-menu">
                <a href="{{ url('/home') }}" class="dropdown-toggle" alt="Home">
                  <i class="fa fa-home"></i>
                </a>                
              </li>


          @canany([
              'read_atendimento',
              ])


          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-headset"></i>
              <span class="label label-warning">?</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Setores de Atendimento</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                  @php

                  $color_p=0;
              
                    //RRGGBB

                    $pst = 1;

                    $color = array('', 'bg-maroon', 'bg-lime', 'bg-orange', 'bg-yellow', 'bg-aqua');           

                  @endphp
                  

                  @if(session()->get('setors'))
                      @foreach((session()->get('setors')) as $sess_setors)

                      @can('read_'.$sess_setors->name)                   

                          <li class="dropdown messages-menu">
                            <a href="{{ url('atendimentos/'.$sess_setors->name.'/dashboard/') }}" class="dropdown-toggle" alt="Novo Ticket">
                              <i class="fa fa-headset"></i>
                              <span class="label label-default {{$color[$pst++]}}">
                                {{ucfirst($sess_setors->label)}}
                              </span>
                              
                            </a>                        
                          </li>
                      @endcan 

                    @endforeach 
                  @endif  


                </ul>
              </li>
            </ul>
          </li>                           
            
          @endcanany

              <!-- -------------------- END MENU ICON TOP ------------------------- -->

              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  @php

                  $imagem_perfil = Auth::user()->uploads()->orderBy('id', 'DESC')->first();

                  @endphp


                  
                  @if($imagem_perfil)  
                      <img src="{{ url('storage/'.$imagem_perfil->dir.'/'.$imagem_perfil->link) }}" class="user-image" alt="User Image">
                  @else
                      <img src="{{ asset('img/default-user-image.png') }}" class="user-image" alt="User Image">
                  @endif


                  <span class="hidden-xs">{{ Auth::user()->apelido }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    @if($imagem_perfil)  
                        <img src="{{ url('storage/'.$imagem_perfil->dir.'/'.$imagem_perfil->link) }}" class="img-circle" alt="User Image">
                    @else
                        <img src="{{ asset('img/default-user-image.png') }}" class="img-circle" alt="User Image">
                    @endif
                    

                    <p>
                      {{ Auth::user()->name }}
                      <!--<small></small>-->                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="{{ url('clients/perfil') }}" class="btn btn-default btn-sm">
                        <i class="fa fa-user"></i>
                        Perfil
                        </a>
                      </div>
                      
                      <div class="col-xs-4 text-center">
                        <a href="{{url('password/reset')}}" class="btn btn-default btn-sm">
                          <i class="fa fa-lock"></i>
                          Senha
                        </a>
                      </div>

                      <div class="col-xs-4 text-center">                        
                        <a href="{{url('clients/carteira')}}" class="btn btn-default btn-sm">
                          <i class="fa fa-wallet"></i>
                          Carteira
                        </a>
                      </div>
                     
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    -->
                    <div class="pull-right">

                      <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <i class="fa fa-door-closed"></i>
                          {{ __('Sair') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>


                    </div>
                  </li>
                </ul>
              </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->