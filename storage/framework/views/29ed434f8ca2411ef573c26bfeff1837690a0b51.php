<?php $__env->startSection('title', $role->name); ?>
<?php $__env->startSection('content'); ?>
	<h1>
        Role - Rótulo - Regra
        <small><?php echo e($role->name); ?></small>
    </h1>
	<div class="row">		
		<div class="col-md-6">
			<ul>
				<li><strong>ID: </strong> <?php echo e($role->id); ?></li>
				<li><strong>Nome: </strong> <?php echo e($role->name); ?></li>
				<li><strong>Rótulo(label): </strong> <?php echo e($role->label); ?></li>				
			</ul>	
		</div>

	</div>
	
	
	<a href="javascript:history.go(-1)">Voltar</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>