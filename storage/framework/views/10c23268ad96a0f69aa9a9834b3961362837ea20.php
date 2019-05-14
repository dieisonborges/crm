<?php $__env->startSection('title', 'Nova Upload'); ?>
<?php $__env->startSection('content'); ?>
		<h1>
	        Upload de Arquivos
	        <small>+</small>
	    </h1>
		

		<form action="<?php echo e(url('uploads')); ?>" method="POST" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>	

			<input type="hidden" name="id" value="<?php echo e($id); ?>">	

			<input type="hidden" name="area" value="<?php echo e($area); ?>">	

			<div class="form-group mb-12">
			    <label for="titulo">Título: </label>
			    <input type="text" class="form-control" id="titulo" name="titulo" value="" placeholder="Digite o Título do Arquivo..." required>
		 	</div>

		 	<div class="form-group mb-12">
			    <label for="file" >Arquivo: </label>
			    <input type="file" name="file" required="required" accept="image/*|application/pdf">
			    <span style="font-size: 15px; color: red;">Arquivos suportados: <b>jpeg,png,jpg,pdf</b></span>
		 	</div>
		 	
    		<button type="submit" class="btn btn-success">Enviar</button>
		 	

		 	<div>
		 		<hr class="hr col-md-12">
		 	</div>

		 	
		</form>

		<a class="btn btn-primary" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>