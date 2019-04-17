<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_log')): ?>    
    
    <?php $__env->startSection('title', 'Logs'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Logs (Registros) de Acesso do Sistema </h1>

        
        <div class="box-header">
            <h3 class="box-title">Eventos do sistema</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>IP</th>
                    <th>País</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><a href="#"><?php echo e($log->ip); ?></a></td>      
                    <td><a href="#">
                    <?php
                    $ip = $log->ip;
                        $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
                    ?>



                    <?php echo e($details->geoplugin_countryName); ?> | <?php echo e($details->geoplugin_region); ?> | <?php echo e($details->geoplugin_city); ?>

                    </a></td>              
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                <?php endif; ?>            
                
            </table>
        </div>
        <!-- /.box-body -->

        

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>