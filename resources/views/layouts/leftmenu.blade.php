
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
              'read_convite',
              'read_score',
              'read_conquista',
              'read_categoria', 
              'read_log', 
              'read_role', 
              'read_permission', 
              'read_setor', 
              'read_ticket',
              'read_franquia',
              ])    

          <!--<li class="header">Área Administrativa</li>-->

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-cog"></i> <span>Administração</span>              
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
                    <i class="fas fa-user text-aqua"></i><span>Usuários</span>
                  </a>
                </li>
              @endcan

              @can('read_armazem')
                <li>
                  <a href="{{ url('armazems/') }}">
                    <i class="fas fa-warehouse text-aqua"></i><span>Armazéns</span>
                  </a>
                </li>
              @endcan

              @can('read_convite')
              <li>
                <a href="{{ url('convites/') }}">
                  <i class="fa fa-paper-plane"></i><span>Convites</span>              
                </a>            
              </li>
              @endcan 

              @can('read_franquia')
              <li>
                <a href="{{ url('franqueadoVip/') }}">
                    <i class="fas fa-store"></i><span>Assinantes VIP</span>
                </a>             
              </li>
              @endcan
              
              @can('read_score') 
              <li>
                <a href="{{ url('scores/') }}">
                  <i class="fa fa-star"></i><span>Scores</span>              
                </a>           
              </li> 
              @endcan 
              @can('read_conquista')
              <li>
                <a href="{{ url('conquistas/') }}">
                  <i class="fa fa-certificate"></i><span>Conquistas</span>              
                </a>             
              </li> 
              @endcan 
              @can('read_categoria')
              <li>
                <a href="{{ url('categorias/') }}">
                  <i class="fa fa-list-alt"></i><span>Categorias</span>              
                </a>           
              </li> 
              @endcan 
              @can('read_log')
              <li>
                <a href="{{ url('logs/') }}">
                  <i class="fa fa-history"></i><span>Logs</span>
                </a>          
              </li> 
              @endcan 
              @can('read_role')
              <li>
                <a href="{{ url('roles/') }}">
                  <i class="fas fa-user-shield"></i><span>Roles (grupo)</span>              
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

              @can('read_franquia')
              <li>
                <a href="{{ url('franquias/') }}">  
                  <i class="fas fa-store"></i> <span>Lojas Virtuais</span>                          
                </a>            
              </li> 

              <li>
                <a href="{{ url('franquias/instalador') }}">  
                  <i class="fa fa-cog"></i> <span>Instalador de Lojas</span>
                </a>            
              </li>
              @endcan
              
              

            </ul>            
          </li>
          @endcanany

          <!-- --------------------- END Administração -------------- -->

          @canany([
              'read_franqueado',
              'read_assinante',             
              ])    

          <!--<li class="header">Área Administrativa</li>-->

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store-alt"></i> <span>Área do Assinante</span>              
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              @can('read_franqueado')
                <!--
                <li>
                  <a href="{{ url('franqueados/') }}">
                    <i class="fas fa-store-alt"></i><span>Lojas</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('franqueados/convites') }}">
                    <i class="fas fa-paper-plane"></i><span>Convites</span>
                  </a>
                </li>
                -->
              @endcan 

              @can('read_assinante')
                <li>
                  <a href="{{ url('assinante/') }}">
                    <i class="fa fa-warehouse"></i><span>Produtos</span>
                  </a>
                </li>                
              @endcan

            </ul>            
          </li>
          @endcanany
           

          <!-- ************************ Cliente ********************* -->

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-user"></i> <span>Área de {{ ucfirst(Auth::user()->apelido) }}</span>              
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">    
                <li>
                  <a href="{{ url('clients/perfil') }}"><i class="fa fa-user"></i>Perfil</a>
                </li>
                <li>
                  <a href="{{ url('clients/carteira') }}"><i class="fa fa-wallet"></i>Carteira</a>
                </li>          
                <li>
                  <a href="{{ url('clients/1/status') }}"><i class="fa fa-ticket-alt text-yellow"></i>Tickets Abertos</a>
                </li>
                <li>
                  <a href="{{ url('clients/0/status') }}"><i class="fa fa-ticket-alt text-green"></i> Tickets Fechados</a>
                </li>
                <li>
                  <a href="{{ url('clients/') }}"><i class="fa fa-ticket-alt"></i> Todos Tickets</a>
                </li>                

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