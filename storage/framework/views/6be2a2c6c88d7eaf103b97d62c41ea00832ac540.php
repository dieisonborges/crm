<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_log')): ?>    
    
    <?php $__env->startSection('title', 'Logs'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Logs (Registros) do Sistema 

    <a href="<?php echo e(url('logs/acesso')); ?>" class="btn btn-info btn-lg"><i class="fa fa-history"> </i> Logs de Acesso</a>

     </h1>

        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('logs/busca')); ?>">
                <?php echo csrf_field(); ?>
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="<?php echo e($buscar); ?>">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
     
        </div> 

        <br><br><br>

        
        <div class="box-header">
            <h3 class="box-title">Eventos do sistema</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <!--
                    <th>MAC</th>
                    -->
                    <th>HOST</th>
                    <th>Filename</th>
                    <th>Info</th>
                    <th>User ID</th>
                    <th>Created at</th> 
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($log->id); ?></td>
                    <td><a href="<?php echo e(URL::to('logs')); ?>/<?php echo e($log->id); ?>"><?php echo e($log->ip); ?></a></td>
                    <!--<td><a href=""></a></td>-->
                    <td><a href="<?php echo e(URL::to('logs')); ?>/<?php echo e($log->id); ?>"><?php echo e($log->host); ?></a></td>
                    <td><a href="<?php echo e(URL::to('logs')); ?>/<?php echo e($log->id); ?>"><?php echo e($log->filename); ?></a></td>
                    <td><a href="<?php echo e(URL::to('logs')); ?>/<?php echo e($log->id); ?>"> <?php echo e(str_limit($log->info, $limit = 90, $end = '...')); ?></a></td>
                    <td><a href="<?php echo e(URL::to('logs')); ?>/<?php echo e($log->id); ?>"><?php echo e($log->user_id); ?></a></td>
                    <td><a href="<?php echo e(URL::to('logs')); ?>/<?php echo e($log->id); ?>"><?php echo e(date('d/m/Y H:i:s', strtotime($log->created_at))); ?></a></td>
                    
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                <?php endif; ?>            
                
            </table>
        </div>
        <!-- /.box-body -->

        <?php echo e($logs->links()); ?>


    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>