
@auth
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">      

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

          @can('read_log')

          <li class="header">Logs de Sistema</li> 

          <li class="treeview">
            <a href="#">
              <i class="fa fa-history"></i> <span>Logs (Registros) Sistema</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('logs/') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
              <li><a href="{{ url('logs/acesso') }}"><i class="fa fa-circle-o"></i> Acesso</a></li>
            </ul>
          </li>
          @endcan

                
          @can('read_user') 

          <!-- ************************ Controle de Usuário e Grupos ********************* -->        

          <li class="header">Usuário, Grupos e Setores</li> 

          @endcan
          @can('read_user')
          
          <li>
            <a href="{{ url('users/') }}">
              <i class="fa fa-user"></i> <span>Usuários</span>              
            </a>
            
          </li>

          @endcan

          @can('read_franquia')
          
          <li>
            <a href="{{ url('franquias/') }}">
              <i class="fa fa-home"></i> <span>Franquias</span>              
            </a>
            
          </li>

          @endcan

          @can('read_role')

          <li class="treeview">
            <a href="#">
              <i class="fa fa-group"></i> <span>Roles (grupo)</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('roles/') }}"><i class="fa fa-circle-o"></i> Listar</a></li>
              <li><a href="{{ url('roles/create') }}"><i class="fa fa-circle-o"></i> Novo</a></li>
            </ul>
          </li>

          @endcan

          @can('read_permission')

          <li class="treeview">
            <a href="#">
              <i class="fa fa-lock"></i> <span>Permissions</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('permissions/') }}"><i class="fa fa-circle-o"></i> Listar</a></li>
              <li><a href="{{ url('permissions/create') }}"><i class="fa fa-circle-o"></i> Novo</a></li>
              <li><a href="{{ url('permission/createAuto') }}"><i class="fa fa-circle-o"></i> Automatizado</a></li>
            </ul>
          </li>
          @endcan

          @can('read_setor')

          <li class="treeview">
            <a href="#">
              <i class="fa fa-black-tie"></i> <span>Setores Internos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('setors/') }}"><i class="fa fa-circle-o"></i> Listar</a></li>
              <li><a href="{{ url('setors/create') }}"><i class="fa fa-circle-o"></i> Novo</a></li>
            </ul>
          </li>
          @endcan

 

          @can('read_categoria')

          <li class="treeview">
            <a href="#">
              <i class="fa fa-wrench"></i> <span>Categorias</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('categorias/') }}"><i class="fa fa-circle-o"></i> Listar</a></li>
              <li><a href="{{ url('categorias/create') }}"><i class="fa fa-circle-o"></i> Novo</a></li>
            </ul>
          </li>
          @endcan

          @can('read_convite')

          <li class="treeview">
            <a href="#">
              <i class="fa fa-paper-plane"></i> <span>Convites</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('convites/') }}"><i class="fa fa-circle-o"></i> Listar</a></li>
              <li><a href="{{ url('convites/create') }}"><i class="fa fa-circle-o"></i> Novo</a></li>
            </ul>
          </li>
          @endcan  

  
          @can('read_ticket')     

          <li class="header">Tickets - Administração</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-ticket"></i> <span>Tickets <i class="fa fa-certificate text-red"></i> Adm</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('tickets/1/status') }}"><i class="fa fa-circle-o"></i> Abertos</a></li>
              <li><a href="{{ url('tickets/0/status') }}"><i class="fa fa-circle-o"></i> Fechados</a></li>
              <li><a href="{{ url('tickets/') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
            </ul>
          </li>
          @endcan   

          @can('read_produto')     

          <li class="header">Produtos e Estoque</li> 

          <li>
            <a href="{{ url('produtos') }}">  
              <i class="fa fa-shopping-cart"></i> <span>Produtos</span>
              
            </a>
            
          </li>
          @endcan  

           
          @if(session()->get('setors'))
              @foreach((session()->get('setors')) as $sess_setors)

              @can('read_'.$sess_setors->name)             

                <li class="header">{{$sess_setors->label}}</li>

                
                  <li>
                    <a href="{{ url('atendimentos/'.$sess_setors->name.'/dashboard/') }}">  
                      <i class="fa fa-tachometer"></i> <span>Dashboard</span>                      
                    </a>                    
                  </li>

                  <li class="treeview">
                    <a href="#">  
                      <i class="fa fa-ticket text-red"></i> <span>Tickets</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/') }}"><i class="fa fa-circle-o"></i> Listar</a></li>

                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/1/status') }}"><i class="fa fa-circle-o text-yellow"></i> Abertos</a></li>
                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/0/status') }}"><i class="fa fa-circle-o"></i> Fechados</a></li>
                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/') }}"><i class="fa fa-circle-o"></i> Todos</a></li>

                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/buscaData') }}"><i class="fa fa-circle-o"></i> Todos por Data</a></li>
                      
                    </ul>
                  </li>


              @endcan 

            @endforeach 
          @endif
          

          <!-- ************************ Cliente ********************* -->

          <li class="header">Cliente</li>

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-ticket text-red"></i> <span>Tickets</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              <li><a href="{{ url('clients/create') }}"><i class="fa fa-circle-o text-red"></i> Novo</a></li>
              <li><a href="{{ url('clients/1/status') }}"><i class="fa fa-circle-o text-yellow"></i> Abertos</a></li>
              <li><a href="{{ url('clients/0/status') }}"><i class="fa fa-circle-o"></i> Fechados</a></li>
              <li><a href="{{ url('clients/') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
              
            </ul>
          </li>          

          <!-- ************************ Atendimento ********************* -->

          <li class="header">Problemas (Bugs)</li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-address-book"></i> <span>Algo errado?</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('contato/') }}"><i class="fa fa-circle-o"></i> Enviar Mensagem (Bugs)</a></li>
            </ul>
          </li>
                   
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  @endauth

  @guest
      <p>Erro: 400 | Você não tem permissão para acessar essa área.</p>
  @endguest