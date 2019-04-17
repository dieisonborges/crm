<?php $__env->startSection('title', 'Nova Role'); ?>
<?php $__env->startSection('content'); ?>
		<h1>
	        Conquista
	        <small>Criar Nova</small>
	    </h1>
		

		<form method="POST" action="<?php echo e(url('conquistas')); ?>">
			<?php echo csrf_field(); ?>			
			<div class="form-group mb-12">
			    <label for="titulo">Título</label>
			    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo e(old('titulo')); ?>" placeholder="Digite o Título" required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="valor_score">Valor do Score</label>
			    <input type="text" class="form-control" id="valor_score" name="valor_score" value="<?php echo e(old('valor_score')); ?>" placeholder="+30" required>
		 	</div>		 	
		 	<div class="form-group mb-12">
			    <label for="imagem_medalha">Imagem da Medalha</label>
			    <select class="form-control" id="imagem_medalha" name="imagem_medalha" required="required">
			    	<option value="" selected="selected">Nenhuma</option>
			    	<?php $__currentLoopData = $medalhaSelectOption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medalha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 				<?php echo html_entity_decode($medalha); ?>

		 			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 		</select>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="icone_medalha">Ícone Medalha (fa fa-icons)</label>
			    <input type="text" class="form-control" id="icone_medalha" name="icone_medalha" value="<?php echo e(old('icone_medalha')); ?>" placeholder="fa fa-linux" required>
			    <a href="https://adminlte.io/themes/AdminLTE/pages/UI/icons.html" target="_blank">* Ver lista Font Awesome - Icons</a>
		 	</div>

		 	<div class="form-group mb-12">
			    <label for="descricao">Descrição/Motivo:</label>
			    <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo e(old('descricao')); ?>" placeholder="Digite o descrição" required>
		 	</div> 	
		 	

		 	<div>
		 		<hr>
		 	</div>

		 	<button type="submit" class="btn btn-primary">cadastrar</button>
		</form>

		<hr class="col-md-12 hr">

		<h2 class="form-group">Imagens de medalhas existentes:</h2>

		<?php $__currentLoopData = $medalhaImagem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medalha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-md-2">
				<label class="text-center col-md-12"><?php echo e(str_replace('.png', '', (ucwords(str_replace('-', ' ', $medalha))))); ?></label><br>
				<img src="<?php echo e(url('img/conquistas/'.$medalha)); ?>" width="100%" alt="<?php echo e($medalha); ?>">
				<hr class="col-md-12 hr"> 
			</div>
			
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>