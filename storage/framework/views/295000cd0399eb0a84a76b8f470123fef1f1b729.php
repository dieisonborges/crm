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

        <!--

        <div class="col-lg-4 col-xs-4">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>0</h3>
              <p>Vendas</p>
            </div>
            <a href="<?php echo e(url('franqueados/alocar')); ?>">
              <div class="icon">                
                    <i class="fa fa-shopping-cart"></i>                
              </div>
            </a>
            <a href="<?php echo e(url('franqueados/alocar')); ?>" class="small-box-footer">Visualizar Vendas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


         <div class="col-lg-4 col-xs-4">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>0</h3>
              <p>Produtos em Transporte</p>
            </div>
            <a href="<?php echo e(url('franqueados/tickets/1/status')); ?>">
              <div class="icon">                
                    <i class="fa fa-truck"></i>                
              </div>
            </a>
            <a href="<?php echo e(url('franqueados/tickets/1/status')); ?>" class="small-box-footer">Visualizar Produtos em Transporte <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-4 col-xs-4">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>0</h3>

              <p>Produtos Entregues</p>
            </div>
            <a href="<?php echo e(url('franqueados/tickets/0/status')); ?>">
              <div class="icon">
                <i class="fa fa-house"></i>
              </div>
            </a>
            <a href="<?php echo e(url('franqueados/tickets/0/status')); ?>" class="small-box-footer">Visualizar Produtos Entregues <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-4">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>2</h3>

              <p>Reclamações</p>
            </div>
            <a href="<?php echo e(url('franqueados/tickets/0/status')); ?>">
              <div class="icon">
                <i class="fa fa-ticket"></i>
              </div>
            </a>
            <a href="<?php echo e(url('franqueados/tickets/0/status')); ?>" class="small-box-footer">Visualizar Produtos Entregues <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    -->

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Parabéns</span>
              <span class="info-box-number">Sua franquia está em desenvolvimento.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


    
        
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