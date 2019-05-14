
<?php if(auth()->guard()->check()): ?>
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">      

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
                    

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_convite')): ?>
          <li>
            <a href="<?php echo e(url('convites/')); ?>">
              <i class="fa fa-paper-plane"></i> <span>Convites</span>              
            </a>            
          </li>
          <?php endif; ?> 
  
 

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_produto')): ?>     

          <li class="header">Produtos e Estoque</li> 

          <li>
            <a href="<?php echo e(url('produtos')); ?>">  
              <i class="fa fa-shopping-cart"></i> <span>Produtos</span>
              
            </a>
            
          </li>
          <?php endif; ?>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_orcamento')): ?>     

          <li class="header">Orçamentos</li> 

          <li>
            <a href="<?php echo e(url('orcamento')); ?>">  
              <i class="fa fa-list-ol"></i> <span>Orçamentos</span>
              
            </a>
            
          </li>
          <?php endif; ?> 

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_produto_preco')): ?> 

          <li class="header">Precificação de Produtos</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-money-bill-alt"></i> <span>Precificação</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo e(url('produtoPrecos')); ?>"><i class="fas fa-circle-notch"></i> Preços de Produtos</a></li>
                <li><a href="<?php echo e(url('produtoPrecosSincronizar')); ?>"><i class="fas fa-circle-notch"></i> Sincronizar Lojas</a></li>
            </ul>
          </li> 
          <?php endif; ?> 

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franquia')): ?>   

          <li class="header">Franquia</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fas fa-store"></i> <span>Franquia</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo e(url('franquiasIntegrada/')); ?>"><i class="fas fa-circle-notch"></i> Franquia Integrada</a></li>
                <li><a href="<?php echo e(url('franquias/')); ?>"><i class="fas fa-circle-notch"></i> Franquias</a></li>
                <li><a href="<?php echo e(url('franqueadoVip/')); ?>"><i class="fas fa-circle-notch"></i> Franquias VIP</a></li>
            </ul>
          </li>         

          <?php endif; ?> 

          <!-- Arrumar isso algum dia -->
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franqueado_vip')): ?>           
          <?php endif; ?>   

           
          <?php if(session()->get('setors')): ?>

              <?php

              $color_p=0;

              ?>

              <?php $__currentLoopData = (session()->get('setors')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sess_setors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_'.$sess_setors->name)): ?>             

                <li class="header"><?php echo e(ucfirst($sess_setors->label)); ?></li>

                <?php

                //RRGGBB

                $color_p += 1;

                $color = array('','text-green','text-aqua','text-purple', 'text-light-blue', 'text-yellow');            

                ?>

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
                <li><a href="<?php echo e(url('franqueados')); ?>"><i class="fas fa-circle-notch"></i> Franquias</a></li>
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