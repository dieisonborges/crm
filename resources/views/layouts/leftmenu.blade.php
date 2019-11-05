
@auth
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">      

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

          <!-- --------------------- END Configurações ------------------ -->


          @canany([
              'read_cambio',
              'read_user', 
              'read_armazem', 
              'read_score',
              'read_conquista',
              'read_categoria', 
              'read_log', 
              'read_role', 
              'read_permission', 
              'read_setor', 
              'read_ticket',
              ])    

          <li class="header">Configurações</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-cog"></i> <span>Configurações</span>              
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('read_cambio')
                <li>
                  <a href="{{ url('cambio/') }}">
                    <i class="fa fa-dollar-sign text-aqua"></i><span>Câmbio</span>
                  </a>
                </li>
              @endcan
              @can('read_user')
                <li>
                  <a href="{{ url('users/') }}">
                    <i class="fas fa-user text-aqua"></i> <span>Usuários</span>
                  </a>
                </li>
              @endcan
              @can('read_armazem')
                <li>
                  <a href="{{ url('armazems/') }}">
                    <i class="fas fa-warehouse text-aqua"></i> <span>Armazéns</span>
                  </a>
                </li>
              @endcan
              @can('read_franquia')
              <li>
                <a href="{{ url('franqueadoVip/') }}">
                    <i class="fas fa-store text-aqua"></i> <span>Assinantes VIP</span>
                </a>             
              </li>
              @endcan
              
              @can('read_score') 
              <li>
                <a href="{{ url('scores/') }}">
                  <i class="fa fa-star"></i> <span>Scores</span>              
                </a>           
              </li> 
              @endcan 
              @can('read_conquista')
              <li>
                <a href="{{ url('conquistas/') }}">
                  <i class="fa fa-certificate"></i> <span>Conquistas</span>              
                </a>             
              </li> 
              @endcan 
              @can('read_categoria')
              <li>
                <a href="{{ url('categorias/') }}">
                  <i class="fa fa-list-alt"></i> <span>Categorias</span>              
                </a>           
              </li> 
              @endcan 
              @can('read_log')
              <li>
                <a href="{{ url('logs/') }}">
                  <i class="fa fa-history"></i> <span>Logs</span>
                </a>          
              </li> 
              @endcan 
              @can('read_role')
              <li>
                <a href="{{ url('roles/') }}">
                  <i class="fas fa-user-shield"></i> <span>Roles (grupo)</span>              
                </a>          
              </li> 
              @endcan 
              @can('read_permission')
              <li>
                <a href="{{ url('permissions/') }}">
                  <i class="fas fa-shield-alt"></i> <span>Permissions</span>              
                </a>            
              </li> 
              @endcan 
              @can('read_setor')
              <li>
                <a href="{{ url('setors/') }}">
                  <i class="fas fa-building"></i> <span>Setores Internos</span>              
                </a>           
              </li> 
              @endcan 
              @can('read_ticket')
              <li>
                <a href="{{ url('tickets/1/status') }}">  
                  <i class="fas fa-ticket-alt"></i> <span>Tickets</span>                          
                </a>            
              </li> 
              @endcan 
            </ul>            
          </li>
          @endcanany

          <!-- --------------------- END Configurações -------------- -->

           

          @can('read_convite')
          
          <li class="header">Convites</li> 

          <li>
            <a href="{{ url('convites/') }}">
              <i class="fa fa-paper-plane"></i> <span>Convites</span>              
            </a>            
          </li>
          @endcan           

          @can('read_franquia')         

          <li class="header">Lojas</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store text-blue"></i> <span class="text-blue">Lojas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('franquias/') }}" class="text-blue"><i class="fas fa-store"></i> Gerenciar</a></li>               
                <li><a href="{{ url('franquias/instalador') }}"><i class="fa fa-cog"></i> Instalador</a></li>
            </ul>
          </li>        

          @endcan           

          @can('read_franqueado')     

          <li class="header">Assinante</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store-alt"></i> <span>Assinante</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('franqueados') }}"><i class="fas fa-store-alt"></i> Lojas</a></li>               
                <li><a href="{{ url('franqueados/convites') }}"><i class="fas fa-paper-plane"></i> Convites</a></li>
            </ul>
          </li>

          @endcan 
          

          <!-- ************************ Cliente ********************* -->

          <li class="header">{{ ucfirst(Auth::user()->apelido) }}</li>

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-ticket-alt text-aqua"></i> <span class="text-aqua">Meus Tickets</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              <li><a href="{{ url('clients/create') }}"><i class="fas fa-circle-notch text-red"></i> Novo</a></li>
              <li><a href="{{ url('clients/1/status') }}"><i class="fas fa-circle-notch text-yellow"></i> Abertos</a></li>
              <li><a href="{{ url('clients/0/status') }}"><i class="fas fa-circle-notch"></i> Fechados</a></li>
              <li><a href="{{ url('clients/') }}"><i class="fas fa-circle-notch"></i> Todos</a></li>
              
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