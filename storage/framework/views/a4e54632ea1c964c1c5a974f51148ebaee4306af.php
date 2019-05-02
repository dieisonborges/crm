<header class="main-header" id="main-header">
    <!-- Logo -->
    <a href="<?php echo e(url('home/')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
          <img src="<?php echo e(asset('img/logo/logo-e-ecardume-mini-v3.png')); ?>" width="70%">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo e(asset('img/logo/logo-ecardume-branca-v2.png')); ?>" width="125"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navegação</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

              
              <!-- -------------------- MENU ICON TOP ------------------------- -->

              <li class="dropdown messages-menu">
                <a href="<?php echo e(url('clients/create')); ?>" class="dropdown-toggle" alt="Novo Ticket">
                  <i class="fas fa-ticket-alt"></i>
                  <span class="label label-info">+</span>
                </a>
                
              </li>  

              <li class="dropdown messages-menu">
                <a href="<?php echo e(url('/home')); ?>" class="dropdown-toggle" alt="Home">
                  <i class="fa fa-home"></i>
                </a>
                
              </li>                            

              <li class="dropdown notifications-menu">
                <a href="<?php echo e(url('/contato')); ?>" class="dropdown-toggle" alt="Bugs">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-info">?</span>
                </a>
                
              </li>

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
              <!-- -------------------------- MENU ADM ----------------------------- -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cog"></i>                  
                  <span class="label label-info">!</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"></li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_user')): ?>
                      <li>
                        <a href="<?php echo e(url('users/')); ?>">
                          <i class="fas fa-user text-aqua"></i> Usuários
                        </a>
                      </li>
                      <?php endif; ?>                      

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_fornecedor')): ?>          
                      <li>
                        <a href="<?php echo e(url('fornecedor/')); ?>">
                          <i class="fa fa-truck text-blue"></i> 
                          <span>Fornecedores</span>              
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
                          <i class="fa fa-history"></i> Logs
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
                      <li class="treeview">
                        <a href="<?php echo e(url('permissions/')); ?>">
                          <i class="fas fa-shield-alt"></i> <span>Permissions</span>              
                        </a>            
                      </li>
                      <?php endif; ?>
                      
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_setor')): ?>
                      <li class="treeview">
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
                </ul>
              </li>

              <!-- -------------------------- END MENU ADM ------------------------- -->

              <?php endif; ?>

              <!-- -------------------- END MENU ICON TOP ------------------------- -->

              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <?php

                  $imagem_perfil = Auth::user()->uploads()->orderBy('id', 'DESC')->first();

                  ?>


                  
                  <?php if($imagem_perfil): ?>  
                      <img src="<?php echo e(url('storage/'.$imagem_perfil->dir.'/'.$imagem_perfil->link)); ?>" class="user-image" alt="User Image">
                  <?php else: ?>
                      <img src="<?php echo e(asset('img/default-user-image.png')); ?>" class="user-image" alt="User Image">
                  <?php endif; ?>


                  <span class="hidden-xs"><?php echo e(Auth::user()->apelido); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php if($imagem_perfil): ?>  
                        <img src="<?php echo e(url('storage/'.$imagem_perfil->dir.'/'.$imagem_perfil->link)); ?>" class="img-circle" alt="User Image">
                    <?php else: ?>
                        <img src="<?php echo e(asset('img/default-user-image.png')); ?>" class="img-circle" alt="User Image">
                    <?php endif; ?>
                    

                    <p>
                      <?php echo e(Auth::user()->name); ?>

                      <!--<small></small>-->                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="<?php echo e(url('clients/perfil')); ?>">Perfil</a>
                      </div>
                      <!--
                      <div class="col-xs-4 text-center">
                        <a href="#">Alterar Senha</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Score</a>
                      </div>
                      -->
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    -->
                    <div class="pull-right">

                      <a class="btn btn-default btn-flat" href="<?php echo e(route('logout')); ?>"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <?php echo e(__('Sair')); ?>

                      </a>

                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                          <?php echo csrf_field(); ?>
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