<?php $__env->startSection('title', 'Score'); ?>
<?php $__env->startSection('content'); ?>
<h1>Score <a href="<?php echo e(url('scores/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Adicionar Nova Pontuação</a></h1>

    <?php if(session('status')): ?>
        <div class="alert alert-success" score="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('scores/busca')); ?>">
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
        <h3 class="box-title">Usuários</h3>
        
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Apelido</th>
                <th>Nome</th>
                <th>e-mail</th>
                <th>CPF</th>
                <th>Score</th>
            </tr>
            <?php $__empty_1 = true; $__currentLoopData = $scores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><a href="<?php echo e(URL::to('scores')); ?>/<?php echo e($score->id); ?>/"><?php echo e($score->id); ?></a></td>
                <td><a href="<?php echo e(URL::to('scores')); ?>/<?php echo e($score->id); ?>"><?php echo e($score->apelido); ?></a></td>
                <td><a href="<?php echo e(URL::to('scores')); ?>/<?php echo e($score->id); ?>"><?php echo e($score->name); ?></a></td>
                <td><a href="<?php echo e(URL::to('scores')); ?>/<?php echo e($score->id); ?>"><?php echo e($score->email); ?></a></td>
                <td><a href="<?php echo e(URL::to('scores')); ?>/<?php echo e($score->id); ?>"><?php echo e($score->cpf); ?></a></td>
                <td><a href="<?php echo e(URL::to('scores')); ?>/<?php echo e($score->id); ?>"><?php echo e($score->valor); ?></a></td>
            </tr>                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>
                <td><b>Nenhum Resultado.</b></td>
            </tr>
                
            <?php endif; ?>            
            
        </table>
    </div>
    <!-- /.box-body -->
    <?php echo e($scores->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>