<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_categoria')): ?>   
	
	<?php $__env->startSection('title', 'Nova Categoria'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Nova
		        <small>Categoria</small>
		    </h1>
			

			<form method="POST" action="<?php echo e(url('categorias')); ?>">
				<?php echo csrf_field(); ?>			
				<div class="form-group mb-12">
				    <label for="nome">Nome</label>
				    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo..." value="<?php echo e(old('nome')); ?>" required>
			 	</div>
			 	
			 	<div class="form-group mb-12">
				    <label for="descricao">Descrição</label>
				    <textarea class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição.." required="required"><?php echo e(old('descricao')); ?></textarea>
			 	</div>			 	

			 	<button type="submit" class="btn btn-primary">Cadastrar</button>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>