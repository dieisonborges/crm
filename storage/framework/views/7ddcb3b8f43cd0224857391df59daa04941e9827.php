<?php $__env->startSection('content'); ?>

    
    <div class="row">
        <div class="col-md-12"> 
            <h3><?php echo e(config('app.name')); ?></h3>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>