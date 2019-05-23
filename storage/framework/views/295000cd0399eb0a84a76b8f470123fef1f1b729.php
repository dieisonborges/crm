<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franqueado')): ?>    
    
    <?php $__env->startSection('title', 'Dashboard'); ?>
    <?php $__env->startSection('content'); ?>    
    
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Painel de Controle <small><?php echo e($franquia->nome); ?></small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard </li>
      </ol>
    </section>

   
    <div class="col-lg-12 col-xs-12">
      <?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>   


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row"> 

        <div class="col-md-6 col-sm-4 col-xs-12">
          <div class="info-box bg-aqua">
            <a href="https://<?php echo e($franquia->loja_url); ?>" target="_blank">
              <span class="info-box-icon"><i class="fa fa-store text-white"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Laboratório e-Cardume</span>
              <span class="info-box-number"><?php echo e($franquia->nome); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo e(number_format($porcentagem, '2')); ?>%"></div>
              </div>
              <span class="progress-description">

                    Loja <?php echo e(number_format($porcentagem, '2')); ?>% Concluída, previsão 01 de Ago de 2019.
              </span>
            </div>
            <!-- /.info-box-content -->
            
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="https://<?php echo e($franquia->loja_url); ?>" target="_blank">
              <span class="info-box-icon bg-aqua"><i class="fa fa-link"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Principal</span>
              <span class="info-box-number">Link.</span>
              <small><?php echo e($franquia->loja_url); ?></small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="https://<?php echo e($franquia->loja_url_alternativa); ?>.venderaqui.com.br" target="_blank">
              <span class="info-box-icon bg-aqua"><i class="fa fa-link"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Alternativo</span>
              <span class="info-box-number">Link.</span>
              <small><?php echo e($franquia->loja_url_alternativa); ?>.venderaqui.com.br</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="<?php echo e(url('franqueados/'.$franquia->id.'/configuracoes')); ?>">
              <span class="info-box-icon bg-olive"><i class="fa fa-tools"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Configurações</span>
              <span class="info-box-number">Dados importantes de sua Franquia.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="<?php echo e(url('franqueados/'.$franquia->id.'/produtosFranqueado')); ?>">
              <span class="info-box-icon bg-blue"><i class="fa fa-shopping-bag"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Produtos</span>
              <span class="info-box-number">Produtos de sua franquia.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="<?php echo e(url('franqueados/'.$franquia->id.'/prospectos')); ?>">
              <span class="info-box-icon bg-orange"><i class="fa fa-user-plus"></i></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Prospectos</span>
              <span class="info-box-number">Clientes Interessados.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-12 col-sm-12 col-xs-12">

          <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-store"></i><i class="icon fa fa-fish"></i> Parabéns</h4>

              <h5>Sua franquia está em desenvolvimento</h5>

              
          </div>
          
        </div>

        

        

        


  


    
        
      </div>
      <!-- /.row -->
      <!-- Main row -->     

   
      <!-- Info boxes -->
      <div class="row">
               
        
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
     
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.appdashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>