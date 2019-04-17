<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_permission')): ?>  
	
	<?php $__env->startSection('title', $permission->name); ?>
	<?php $__env->startSection('content'); ?>
		<h1>
	        Permission - Rótulo - Regra
	        <small><?php echo e($permission->name); ?></small>
	    </h1>
		<div class="row">		
			<div class="col-md-6">
				<ul>
					<li class="form-control"><strong>ID: </strong> <?php echo e($permission->id); ?></li>
					<li class="form-control"><strong>Nome: </strong> <?php echo e($permission->name); ?></li>
					<li class="form-control"><strong>Rótulo(label): </strong> <?php echo e($permission->label); ?></li>				
				</ul>	
			</div> 

		</div>
		
		<a href="<?php echo e($permission->id); ?>/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>