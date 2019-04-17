<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_permission')): ?>  
    
    <?php $__env->startSection('title', 'Regras'); ?>
    <?php $__env->startSection('content'); ?> 

    <h1>Permission <b><?php echo e($permission->label); ?></b></h1>
    <h3>Id: <b><?php echo e($permission->id); ?></b> Label: <b><?php echo e($permission->name); ?></b></h3>
        
        <div class="box-header">
            <h3 class="box-title">Roles(Grupos) Mãe:</h3>
            
        </div>

        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome (Name)</th>
                    <th>Rótulo (Label)</th>
                </tr>


                <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($role->id); ?></td>
                    <td><?php echo e($role->name); ?></td>
                    <td><?php echo e($role->label); ?></td>
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                <?php endif; ?>            
                
            </table>
        </div>
        <!-- /.box-body -->
       

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>