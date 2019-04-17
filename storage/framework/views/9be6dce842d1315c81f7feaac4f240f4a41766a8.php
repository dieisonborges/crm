<?php $__env->startSection('title', 'Editar Conquista (Regra)'); ?>
<?php $__env->startSection('content'); ?>
		<h1>
	        Editar Conquista
	        <small><?php echo e($conquista->titulo); ?></small>
	    </h1>


	    <div class="form-group col-md-12">
	    	<div class="container-medalha">	    		
	    		<img src="<?php echo e(url('img/conquistas/'.$conquista->imagem_medalha)); ?>" width="100%"  alt="<?php echo e($conquista->imagem_medalha); ?>" class="imagem-medalha-ajuste">
	    		<i class="<?php echo e($conquista->icone_medalha); ?> icone-medalha-ajuste"></i>
	    		<span class="imagem-texto"><b><?php echo e($conquista->titulo); ?></b> <br> <?php echo e($conquista->descricao); ?></span>
	    	</div>
	    </div>

	    <div class="form-group col-md-12">

			<form method="POST" enctype="multipart/form-data" action="<?php echo e(action('ConquistaController@update', $conquista->id)); ?>" class="col-md-12">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="_method" value="PATCH">			

			 	<div class="form-group col-md-12">
				    <label for="titulo">Título</label>
				    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo e($conquista->titulo); ?>" placeholder="Digite o Título" required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="valor_score">Valor do Score</label>
				    <input type="text" class="form-control" id="valor_score" name="valor_score" value="<?php echo e($conquista->valor_score); ?>" placeholder="+30" required>
			 	</div>		 	
			 	<div class="form-group col-md-12">
				    <label for="imagem_medalha">Imagem da Medalha</label>
				    <select class="form-control" id="imagem_medalha" name="imagem_medalha" required="required">
				    	<option value="<?php echo e($conquista->imagem_medalha); ?>" selected="selected"><?php echo e($conquista->imagem_medalha); ?></option>
				    	<?php $__currentLoopData = $medalhaSelectOption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medalha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 				<?php echo html_entity_decode($medalha); ?>

			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 		</select>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="icone_medalha">Ícone Medalha (fa fa-icons)</label>
				    <input type="text" class="form-control" id="icone_medalha" name="icone_medalha" value="<?php echo e($conquista->icone_medalha); ?>" placeholder="fa fa-linux" required>
				    <a href="https://adminlte.io/themes/AdminLTE/pages/UI/icons.html" target="_blank">* Ver lista Font Awesome - Icons</a>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição/Motivo:</label>
				    <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo e($conquista->descricao); ?>" placeholder="Digite o descrição" required>
			 	</div> 	
			 	

			 	<div>
			 		<hr>
			 	</div>

			 	<button type="submit" class="btn btn-primary">Atualizar</button>
			</form>
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>