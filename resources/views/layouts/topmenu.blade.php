<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('home/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
          <img src="{{ asset('img/logo/favicon.png') }}" width="70%">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('img/logo/logo-ecardume.png') }}" width="125"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

              
              <!-- -------------------- MENU ICON TOP ------------------------- -->

              <li class="dropdown messages-menu">
                <a href="{{url('clients/create')}}" class="dropdown-toggle" alt="Novo Ticket">
                  <i class="fa fa-ticket text-yellow"></i>
                </a>
                
              </li>  

              <li class="dropdown messages-menu">
                <a href="{{ url('/home') }}" class="dropdown-toggle" alt="Home">
                  <i class="fa fa-home"></i>
                </a>
                
              </li>                            

              <li class="dropdown notifications-menu">
                <a href="{{ url('/contato') }}" class="dropdown-toggle" alt="Bugs">
                  <i class="fa fa-envelope"></i>
                </a>
                
              </li>

              <!-- -------------------- END MENU ICON TOP ------------------------- -->

              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('img/default-user-image.png') }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->apelido }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('img/default-user-image.png') }}" class="img-circle" alt="User Image">

                    <p>
                      {{ Auth::user()->name }}
                      <!--<small></small>-->                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                  -->
                    <!-- /.row -->
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