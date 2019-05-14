
@auth
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">      

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
                  
          @can('read_sincronizar')
          <li class="header">Sincronização</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-sync"></i> <span>Sincronizar Lojas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <!--
                <li>
                  <a href="{{ url('produtoPrecos') }}">
                    <i class="fas fa-circle-notch"></i> Tudo
                  </a>
                </li>
                -->
                <li>
                  <a href="{{ url('uploadsSincronizar') }}">
                    <i class="fas fa-circle-notch"></i> Uploads
                  </a>
                </li>              
                <li>
                  <a href="{{ url('produtosSincronizar') }}">
                    <i class="fas fa-circle-notch"></i> Produtos
                  </a>
                </li>
                <li>
                  <a href="{{ url('categorias') }}">
                    <i class="fas fa-circle-notch"></i> Categorias
                  </a>
                </li>
                <li>
                  <a href="{{ url('produtoPrecosSincronizar') }}">
                    <i class="fas fa-circle-notch"></i> Preços de Produtos
                  </a>
                </li>
                <li>
                  <a href="{{ url('franquiasSincronizar') }}">
                    <i class="fas fa-circle-notch"></i> Franquias
                  </a>
                </li>

                <li>
                  <a href="{{ url('sincronizarTudo') }}">
                    <i class="fas fa-sync text-red"></i> Sincronizar Tudo
                  </a>
                </li>

                                
            </ul>
          </li> 
          @endcan   

          @can('read_convite')
          <li>
            <a href="{{ url('convites/') }}">
              <i class="fa fa-paper-plane"></i> <span>Convites</span>              
            </a>            
          </li>
          @endcan 
  
 

          @canany([
              'read_produto', 
              'read_orcamento',
              'read_produto_preco',
              ])     

          <li class="header">Produtos e Estoque</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-shopping-cart"></i> <span>Produtos</span>              
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('read_produto')
                <li>
                  <a href="{{ url('produtos') }}">  
                    <i class="fa fa-shopping-cart"></i> <span>Produtos</span>
                  </a>
                </li>
              @endcan
              @can('read_orcamento')
              <li>
                <a href="{{ url('orcamento') }}">  
                  <i class="fa fa-list-ol"></i> <span>Orçamentos</span>              
                </a>            
              </li>
              @endcan
              @can('read_produto_preco') 
              <li>
                <a href="{{ url('produtoPrecos') }}">  
                  <i class="fas fa-money-bill-alt"></i> <span>Precificação</span>              
                </a>           
              </li> 
              @endcan 
            </ul>            
          </li>
          @endcanany         

          

          @can('read_franquia')
          <li>
            <a href="{{ url('franquias/') }}">  
              <i class="fas fa-store"></i> <span>Franquias</span>              
            </a>            
          </li>         

          @endcan 

          <!-- Arrumar isso algum dia -->
          @can('read_franqueado_vip')           
          @endcan   

           
          @if(session()->get('setors'))

              @php

              $color_p=0;

              @endphp

              @foreach((session()->get('setors')) as $sess_setors)

              @can('read_'.$sess_setors->name)             

                <li class="header">{{ucfirst($sess_setors->label)}}</li>

                @php

                //RRGGBB

                $color_p += 1;

                $color = array('','text-green','text-aqua','text-purple', 'text-light-blue', 'text-yellow');            

                @endphp

                  <li class="treeview">
                      <a href="#">  
                        <i class="fa fa-tachometer-alt {{$color[$color_p]}}"></i> <span>{{$sess_setors->label}}</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li>
                          <a href="{{ url('atendimentos/'.$sess_setors->name.'/dashboard/') }}">  
                            <i class="fa fa-tachometer-alt"></i> <span>Dashboard</span>                    
                          </a>
                          
                        </li>

                        <li>
                          <a href="{{ url('atendimentos/'.$sess_setors->name.'/tickets/') }}">
                            <i class="fa fa-ticket-alt"></i> Tickets
                          </a>
                        </li>                                          
                        
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