<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_permission')): ?>  
	
	<?php $__env->startSection('title', 'Nova Role'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Nova Permission - Automatizado
		        <small>Será criado 04 permissions e 01 role (grupo)</small>	        
		    </h1>

		    <p>
		    	
		    	create_nomepermission <br>
		    	read_nomepermission <br>
		    	update_nomepermission <br>
		    	delete_nomepermission <br>

		    </p>
			

			<form method="POST" action="<?php echo e(action('PermissionController@storeAuto')); ?>">
				<?php echo csrf_field(); ?>			
				<div class="form-group mb-12">
				    <label for="name">Nome</label>
				    crud_<input type="text" class="form-control" id="name" name="name" value="" placeholder="Digite o Nome..." required>
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
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>