<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_permission')): ?>  
	
	<?php $__env->startSection('title', 'Editar Permission (Regra)'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Editar Usuário
		        <small><?php echo e($permission->nome); ?></small>
		    </h1>
			

			<form method="POST" enctype="multipart/form-data" action="<?php echo e(action('PermissionController@update',$id)); ?>">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="_method" value="PATCH">
				<div class="form-group mb-12">
				    <label for="name">Nome</label>
				    <input type="text" class="form-control" id="name" name="name" value="<?php echo e($permission->name); ?>" placeholder="Digite o Nome..." required>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="label">Rótulo</label>
				    <input type="text" class="form-control" id="label" name="label" value="<?php echo e($permission->label); ?>" placeholder="Digite o Rótulo..." required>
			 	</div>

			 	<div>
			 		<hr>
			 	</div>

			 	<button type="submit" class="btn btn-primary">Atualizar</button>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>