
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

           
          @if(session()->get('setors'))
              @foreach((session()->get('setors')) as $sess_setors)

              @can('read_'.$sess_setors->name)             

                <li class="header">{{ucfirst($sess_setors->label)}}</li>

                
                  <li>
                    <a href="{{ url('atendimentos/'.$sess_setors->name.'/dashboard/') }}">  
                      <i class="fa fa-tachometer"></i> <span>Dashboard | {{ucfirst($sess_setors->name)}}</span>                      
                    </a>                    
                  </li>

                  <li class="treeview">
                    <a href="#">  
                      <i class="fa fa-ticket text-red"></i> <span>Tickets | {{ucfirst($sess_setors->name)}}</span>
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

          @can('read_franqueado')     

          <li class="header">Franqueado</li> 

          <li>
            <a href="{{ url('franqueados') }}">  
              <i class="fa fa-building-o"></i> <span>Franqueado</span>
              
            </a>
            
          </li>
          @endcan 
          

          <!-- ************************ Cliente ********************* -->

          <li class="header">{{ ucfirst(Auth::user()->apelido) }}</li>

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-ticket text-aqua"></i> <span>Meus Tickets</span>
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

         
                   
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  @endauth

  @guest
      <p>Erro: 400 | Você não tem permissão para acessar essa área.</p>
  @endguest