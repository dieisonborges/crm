<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_convite')): ?>  
	
	<?php $__env->startSection('title', 'Nova Role'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Novo Convite
		        <small>Enviar</small>
		    </h1>
			

			<form method="POST" action="<?php echo e(url('convites')); ?>">
				<?php echo csrf_field(); ?>			
				<div class="form-group mb-12">
				    <label for="email">E-mail</label>
				    <input type="text" class="form-control" id="email" name="email" value="" placeholder="Digite o email do convidado" required>
			 	</div>		 	

			 	<div>
			 		<hr>
			 	</div>

			 	<button type="submit" class="btn btn-primary">cadastrar</button>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>