
@auth
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">      

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
                    

          @can('read_convite')
          <li>
            <a href="{{ url('convites/') }}">
              <i class="fa fa-paper-plane"></i> <span>Convites</span>              
            </a>            
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

          @can('read_orcamento')     

          <li class="header">Orçamentos</li> 

          <li>
            <a href="{{ url('orcamento') }}">  
              <i class="fa fa-list-ol"></i> <span>Orçamentos</span>
              
            </a>
            
          </li>
          @endcan 

          @can('read_produto_preco')     

          <li class="header">Precificação de Produtos</li> 

          <li>
            <a href="{{ url('produtoPrecos') }}">  
              <i class="fas fa-money-bill-alt"></i> <span>Precificação</span>
              
            </a>
            
          </li>
          @endcan 

          @can('read_franquia')   

          <li class="header">Franquia</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store"></i> <span>Franquia</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('franquiasIntegrada/') }}"><i class="fas fa-circle-notch"></i> Franquia Integrada</a></li>
                <li><a href="{{ url('franquias/') }}"><i class="fas fa-circle-notch"></i> Franquias</a></li>
                <li><a href="{{ url('franqueadoVip/') }}"><i class="fas fa-circle-notch"></i> Franquias VIP</a></li>
            </ul>
          </li>         

          @endcan 

          <!-- Arrumar isso algum dia -->
          @can('read_franqueado_vip')           
          @endcan   

           
          @if(session()->get('setors'))
              @foreach((session()->get('setors')) as $sess_setors)

              @can('read_'.$sess_setors->name)             

                <li class="header">{{ucfirst($sess_setors->label)}}</li>

                
                  <li>
                    <a href="{{ url('atendimentos/'.$sess_setors->name.'/dashboard/') }}">  
                      <i class="fas fa-tachometer-alt"></i> <span>Dashboard | {{ucfirst($sess_setors->name)}}</span>                      
                    </a>                    
                  </li>

                  <li class="treeview">
                    <a href="#">  
                      <i class="fas fa-ticket-alt text-red"></i> <span>Tickets | {{ucfirst($sess_setors->name)}}</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/') }}"><i class="fas fa-circle-notch"></i> Listar</a></li>

                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/1/status') }}"><i class="fas fa-circle-notch text-yellow"></i> Abertos</a></li>
                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/0/status') }}"><i class="fas fa-circle-notch"></i> Fechados</a></li>
                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/') }}"><i class="fas fa-circle-notch"></i> Todos</a></li>

                      <li><a href="{{ url('atendimentos/'.$sess_setors->name.'/buscaData') }}"><i class="fas fa-circle-notch"></i> Todos por Data</a></li>
                      
                    </ul>
                  </li>


              @endcan 

            @endforeach 
          @endif

          @can('read_franqueado')     

          <li class="header">Franqueado</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store-alt"></i> <span>Franqueado</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('franqueados') }}"><i class="fas fa-circle-notch"></i> Franquias</a></li>
                <li><a href="{{ url('franqueados/produtos') }}"><i class="fas fa-circle-notch"></i> Catálogo de Produtos</a></li>
            </ul>
          </li>

          @endcan 
          

          <!-- ************************ Cliente ********************* -->

          <li class="header">{{ ucfirst(Auth::user()->apelido) }}</li>

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-ticket-alt text-aqua"></i> <span>Meus Tickets</span>
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