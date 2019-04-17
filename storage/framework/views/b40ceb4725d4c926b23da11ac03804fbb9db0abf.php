<?php $__env->startSection('title', 'Nova Role'); ?>
<?php $__env->startSection('content'); ?>
		<h1>
	        Nova Role
	        <small>+</small>
	    </h1>
		

		<form method="POST" action="<?php echo e(url('roles')); ?>">
			<?php echo csrf_field(); ?>			
			<div class="form-group mb-12">
			    <label for="name">Nome</label>
			    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Digite o Nome..." required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="label">Rótulo</label>
			    <input type="text" class="form-control" id="label" name="label" value="" placeholder="Digite o Rótulo..." required>
		 	</div>
		 	

		 	<div>
		 		<hr>
		 	</div>

		 	<button type="submit" class="btn btn-primary">cadastrar</button>
		</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>