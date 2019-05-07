<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_categoria')): ?>   
	
	<?php $__env->startSection('title', 'Editar Categoria'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Editar Categoria
		        <small><?php echo e($categoria->nome); ?></small>
		    </h1>			

			<form method="POST" enctype="multipart/form-data" action="<?php echo e(action('CategoriaController@update',$categoria->id)); ?>">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="_method" value="PATCH">
				<div class="form-group mb-12">
				    <label for="nome">Nome</label>
				    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e($categoria->nome); ?>" placeholder="Digite o Nome..." required>
			 	</div>

			 	<div class="form-group mb-12">
				    <label for="valor">Valor (Dinâmico)</label>
				    <input type="number" class="form-control" id="valor" name="valor" value="<?php echo e($categoria->valor); ?>" placeholder="Digite o Valor..." required>
			 	</div>
			 	
			 	<div class="form-group mb-12">
				    <label for="descricao">Descrição</label>
				    <textarea class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição.." required="required"><?php echo e($categoria->descricao); ?></textarea>
			 	</div>			 	

			 	<button type="submit" class="btn btn-primary">Atualizar</button>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>