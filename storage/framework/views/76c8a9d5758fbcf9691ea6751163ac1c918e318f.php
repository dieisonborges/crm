<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

  <?php echo $__env->make('layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body class="hold-transition <?php echo e(config('app.skin')); ?> sidebar-mini sidebar-collapse" id="body-nologin">
<div class="wrapper">
  
   
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">  

      <div class="row">         

          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">

                <div class="col-md-4" style="float: right;">
                  <a href="/">
                      <b style="display:none;"><?php echo e(config('app.name')); ?></b>        
                      <img src="<?php echo e(asset('img/logo/logo-ecardume-sem-borda.png')); ?>" width="80%">        
                  </a>     
                </div>

                <?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->yieldContent('content'); ?>
                
              </div>
            </div>
            
          </div>          

      </div>


    </section>
    <!-- /.content -->
  </div>
 
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<!-- ./wrapper -->

<?php echo $__env->make('layouts.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


</body>
</html>
