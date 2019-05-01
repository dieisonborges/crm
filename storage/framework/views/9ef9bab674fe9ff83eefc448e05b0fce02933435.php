
<?php if(auth()->guard()->guest()): ?>
  <script type="text/javascript">
      window.location = "/"; 
  </script>
        
<?php else: ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<?php echo $__env->make('layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body class="hold-transition <?php echo e(config('app.skin')); ?> sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- TOP MENU -->
  <?php echo $__env->make('layouts.topmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- END TOP MENU -->
  
  <!-- LEFT MENU -->
  <?php echo $__env->make('layouts.leftmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- END LEFT MENU -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">  

      <div class="row">

          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">

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

 <?php endif; ?>  
