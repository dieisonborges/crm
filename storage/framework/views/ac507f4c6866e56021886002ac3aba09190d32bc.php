
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

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franquia')): ?>   

          <li class="header">Franquia</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-building-o"></i> <span>Franquia</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo e(url('franquiasIntegrada/')); ?>"><i class="fa fa-circle-o"></i> Franquia Integrada</a></li>
                <li><a href="<?php echo e(url('franquias/')); ?>"><i class="fa fa-circle-o"></i> Franquias</a></li>
                <li><a href="<?php echo e(url('franqueadoVip/')); ?>"><i class="fa fa-circle-o"></i> Franquias VIP</a></li>
            </ul>
          </li>         

          <?php endif; ?> 

          <!-- Arrumar isso algum dia -->
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franqueado_vip')): ?>           
          <?php endif; ?>   

           
          <?php if(session()->get('setors')): ?>
              <?php $__currentLoopData = (session()->get('setors')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sess_setors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_'.$sess_setors->name)): ?>             

                <li class="header"><?php echo e(ucfirst($sess_setors->label)); ?></li>

                
                  <li>
                    <a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/dashboard/')); ?>">  
                      <i class="fa fa-tachometer"></i> <span>Dashboard | <?php echo e(ucfirst($sess_setors->name)); ?></span>                      
                    </a>                    
                  </li>

                  <li class="treeview">
                    <a href="#">  
                      <i class="fa fa-ticket text-red"></i> <span>Tickets | <?php echo e(ucfirst($sess_setors->name)); ?></span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/tickets/')); ?>"><i class="fa fa-circle-o"></i> Listar</a></li>

                      <li><a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/tickets/1/status')); ?>"><i class="fa fa-circle-o text-yellow"></i> Abertos</a></li>
                      <li><a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/tickets/0/status')); ?>"><i class="fa fa-circle-o"></i> Fechados</a></li>
                      <li><a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/tickets/')); ?>"><i class="fa fa-circle-o"></i> Todos</a></li>

                      <li><a href="<?php echo e(url('atendimentos/'.$sess_setors->name.'/buscaData')); ?>"><i class="fa fa-circle-o"></i> Todos por Data</a></li>
                      
                    </ul>
                  </li>


              <?php endif; ?> 

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
          <?php endif; ?>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franqueado')): ?>     

          <li class="header">Franqueado</li> 

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-building-o"></i> <span>Franqueado</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo e(url('franqueados')); ?>"><i class="fa fa-circle-o"></i> Franquias</a></li>
                <li><a href="<?php echo e(url('franqueados/produtos')); ?>"><i class="fa fa-circle-o"></i> Catálogo de Produtos</a></li>
            </ul>
          </li>

          <?php endif; ?> 
          

          <!-- ************************ Cliente ********************* -->

          <li class="header"><?php echo e(ucfirst(Auth::user()->apelido)); ?></li>

          <li class="treeview">
            <a href="#">  
              <i class="fa fa-ticket text-aqua"></i> <span>Meus Tickets</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              <li><a href="<?php echo e(url('clients/create')); ?>"><i class="fa fa-circle-o text-red"></i> Novo</a></li>
              <li><a href="<?php echo e(url('clients/1/status')); ?>"><i class="fa fa-circle-o text-yellow"></i> Abertos</a></li>
              <li><a href="<?php echo e(url('clients/0/status')); ?>"><i class="fa fa-circle-o"></i> Fechados</a></li>
              <li><a href="<?php echo e(url('clients/')); ?>"><i class="fa fa-circle-o"></i> Todos</a></li>
              
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