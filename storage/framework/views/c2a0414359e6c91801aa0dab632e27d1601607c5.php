<?php $__env->startSection('title', $conquista->name); ?>
<?php $__env->startSection('content'); ?>
	<h1>
        Conquista
        <small><?php echo e($conquista->titulo); ?></small>
    </h1>
	<div class="row">		
		<div class="form-group col-md-12">
	    	<div class="container-medalha">	    		
	    		<img src="<?php echo e(url('img/conquistas/'.$conquista->imagem_medalha)); ?>" width="100%"  alt="<?php echo e($conquista->imagem_medalha); ?>" class="imagem-medalha-ajuste">
	    		<i class="<?php echo e($conquista->icone_medalha); ?> icone-medalha-ajuste"></i>
	    		<span class="imagem-texto"><b><?php echo e($conquista->titulo); ?></b> <br> <?php echo e($conquista->descricao); ?></span>
	    	</div>
	    </div>

	</div>

	<a class="btn btn-warning" href="<?php echo e(URL::to('conquistas/'.$conquista->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
	
	
	<a class="btn btn-primary" href="javascript:history.go(-1)">Voltar</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>