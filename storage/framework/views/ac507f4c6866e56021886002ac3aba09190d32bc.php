
<?php if(auth()->guard()->check()): ?>
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">      

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

          <!-- ----------------------------------- END Configurações ----------------------- -->


          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
              'read_user', 
              'read_score',
              'read_conquista',
              'read_categoria', 
              'read_log', 
              'read_role', 
              'read_permission', 
              'read_setor', 
              'read_ticket',
              ])): ?>    

          <li class="header">Configurações</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-cog"></i> <span>Configurações</span>              
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_user')): ?>
                <li>
                  <a href="<?php echo e(url('users/')); ?>">
                    <i class="fas fa-user text-aqua"></i> <span>Usuários</span>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franquia')): ?>
              <li>
                <a href="<?php echo e(url('franqueadoVip/')); ?>">
                    <i class="fas fa-store text-aqua"></i> <span>Franqueados VIP</span>
                </a>             
              </li>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_fornecedor')): ?>
              <li>
                <a href="<?php echo e(url('fornecedor/')); ?>">
                  <i class="fa fa-truck text-blue"></i><span>Fornecedores</span>              
                </a>           
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_score')): ?> 
              <li>
                <a href="<?php echo e(url('scores/')); ?>">
                  <i class="fa fa-star"></i> <span>Scores</span>              
                </a>           
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_conquista')): ?>
              <li>
                <a href="<?php echo e(url('conquistas/')); ?>">
                  <i class="fa fa-certificate"></i> <span>Conquistas</span>              
                </a>             
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_categoria')): ?>
              <li>
                <a href="<?php echo e(url('categorias/')); ?>">
                  <i class="fa fa-list-alt"></i> <span>Categorias</span>              
                </a>           
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_log')): ?>
              <li>
                <a href="<?php echo e(url('logs/')); ?>">
                  <i class="fa fa-history"></i> <span>Logs</span>
                </a>          
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_role')): ?>
              <li>
                <a href="<?php echo e(url('roles/')); ?>">
                  <i class="fas fa-user-shield"></i> <span>Roles (grupo)</span>              
                </a>          
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_permission')): ?>
              <li>
                <a href="<?php echo e(url('permissions/')); ?>">
                  <i class="fas fa-shield-alt"></i> <span>Permissions</span>              
                </a>            
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_setor')): ?>
              <li>
                <a href="<?php echo e(url('setors/')); ?>">
                  <i class="fas fa-building"></i> <span>Setores Internos</span>              
                </a>           
              </li> 
              <?php endif; ?> 
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_ticket')): ?>
              <li>
                <a href="<?php echo e(url('tickets/1/status')); ?>">  
                  <i class="fas fa-ticket-alt"></i> <span>Tickets</span>                          
                </a>            
              </li> 
              <?php endif; ?> 
            </ul>            
          </li>
          <?php endif; ?>

          <!-- ----------------------------------- END Configurações ----------------------- -->

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_sincronizar')): ?>
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
                  <a href="<?php echo e(url('produtoPrecos')); ?>">
                    <i class="fas fa-circle-notch"></i> Tudo
                  </a>
                </li>
                -->
                <li>
                  <a href="<?php echo e(url('uploadsSincronizar')); ?>">
                    <i class="fas fa-circle-notch"></i> Uploads
                  </a>
                </li>              
                <li>
                  <a href="<?php echo e(url('produtosSincronizar')); ?>">
                    <i class="fas fa-circle-notch"></i> Produtos
                  </a>
                </li>
                <li>
                  <a href="<?php echo e(url('categorias')); ?>">
                    <i class="fas fa-circle-notch"></i> Categorias
                  </a>
                </li>
                <li>
                  <a href="<?php echo e(url('produtoPrecosSincronizar')); ?>">
                    <i class="fas fa-circle-notch"></i> Preços de Produtos
                  </a>
                </li>
                <li>
                  <a href="<?php echo e(url('franquiasSincronizar')); ?>">
                    <i class="fas fa-circle-notch"></i> Franquias
                  </a>
                </li>

                <li>
                  <a href="<?php echo e(url('sincronizarTudo')); ?>">
                    <i class="fas fa-sync text-red"></i> Sincronizar Tudo
                  </a>
                </li>

                                
            </ul>
          </li> 
          <?php endif; ?>   

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_convite')): ?>
          <li>
            <a href="<?php echo e(url('convites/')); ?>">
              <i class="fa fa-paper-plane"></i> <span>Convites</span>              
            </a>            
          </li>
          <?php endif; ?> 
  
 

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
              'read_produto', 
              'read_orcamento',
              'read_produto_preco',
              ])): ?>     

          <li class="header">Produtos e Estoque</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-shopping-cart"></i> <span>Produtos</span>              
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_produto')): ?>
                <li>
                  <a href="<?php echo e(url('produtos')); ?>">  
                    <i class="fa fa-shopping-cart"></i> <span>Produtos</span>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_orcamento')): ?>
              <li>
                <a href="<?php echo e(url('orcamento')); ?>">  
                  <i class="fa fa-list-ol"></i> <span>Orçamentos</span>              
                </a>            
              </li>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_produto_preco')): ?> 
              <li>
                <a href="<?php echo e(url('produtoPrecos')); ?>">  
                  <i class="fas fa-money-bill-alt"></i> <span>Precificação</span>              
                </a>           
              </li> 
              <?php endif; ?> 
            </ul>            
          </li>
          <?php endif; ?>         

          

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franquia')): ?>
          <li>
            <a href="<?php echo e(url('franquias/')); ?>">  
              <i class="fas fa-store"></i> <span>Franquias</span>              
            </a>            
          </li>         

          <?php endif; ?> 

          <!-- Arrumar isso algum dia -->           
          <?php if(session()->get('setors')): ?>

              <?php

                $color_p=0;

              ?>

              <?php $__currentLoopData = (session()->get('setors')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sess_setors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_'.$sess_setors->name)): ?>   

                          

                  <!--<li class="header"><?php echo e(ucfirst($sess_setors->label)); ?></li>-->

                  <?php

                  //RRGGBB

                  $color_p += 1;

                  $color = array('','text-green','text-aqua','text-purple', 'text-light-blue', 'text-yellow');            

                  ?>
                  <!--
                    <li class="treeview">
                        <a href="#">  
                          <i class="fa fa-tachometer-alt <?php echo e($color[$color_p]); ?>"></i> <span><?php echo e($sess_setors->label); ?></span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                          <li>
                            <a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/dashboard/')); ?>">  
                              <i class="fa fa-tachometer-alt"></i> <span>Dashboard</span>                    
                            </a>
                            
                          </li>

                          <li>
                            <a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/tickets/')); ?>">
                              <i class="fa fa-ticket-alt"></i> Tickets
                            </a>
                          </li>                                          
                          
                        </ul>
                  </li> 
                -->

                  


                <?php endif; ?> 

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
          <?php endif; ?>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franqueado')): ?>     

          <li class="header">Franqueado</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store-alt"></i> <span>Franqueado</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo e(url('franqueados')); ?>"><i class="fas fa-circle-notch text-orange"></i> Franquias</a></li>
                <li><a href="<?php echo e(url('franqueados/produtos')); ?>"><i class="fas fa-circle-notch"></i> Catálogo de Produtos</a></li>
            </ul>
          </li>

          <?php endif; ?> 
          

          <!-- ************************ Cliente ********************* -->

          <li class="header"><?php echo e(ucfirst(Auth::user()->apelido)); ?></li>

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-ticket-alt text-aqua"></i> <span>Meus Tickets</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              <li><a href="<?php echo e(url('clients/create')); ?>"><i class="fas fa-circle-notch text-red"></i> Novo</a></li>
              <li><a href="<?php echo e(url('clients/1/status')); ?>"><i class="fas fa-circle-notch text-yellow"></i> Abertos</a></li>
              <li><a href="<?php echo e(url('clients/0/status')); ?>"><i class="fas fa-circle-notch"></i> Fechados</a></li>
              <li><a href="<?php echo e(url('clients/')); ?>"><i class="fas fa-circle-notch"></i> Todos</a></li>
              
            </ul>
          </li>    
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php endif; ?>

  <?php if(auth()->guard()->guest()): ?>
      <p>Erro: 400 | Você não tem permissão para acessar essa área.</p>
  <?php endif; ?>