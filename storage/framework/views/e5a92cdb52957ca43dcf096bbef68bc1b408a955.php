<?php $__env->startSection('title', 'Setor'); ?>
<?php $__env->startSection('content'); ?>
	<h1>
        Setor
        <small><?php echo e($setor->name); ?></small>
    </h1>
	<div class="row">		
		<div class="col-md-6">
			<ul>
				<li><strong>ID: </strong> <?php echo e($setor->id); ?></li>
				<li><strong>Nome: </strong> <?php echo e($setor->name); ?></li>
				<li><strong>Rótulo(label): </strong> <?php echo e($setor->label); ?></li>				
			</ul>	
		</div>

	</div>
	
	
	<a href="javascript:history.go(-1)">Voltar</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>