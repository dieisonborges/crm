<?php $__env->startSection('title', 'Convites'); ?>
<?php $__env->startSection('content'); ?>
	<h1>
        Permission - Rótulo - Regra
        <small><?php echo e($convite->name); ?></small>
    </h1>
	<div class="row">		
		<div class="col-md-6">
			<ul>
				<li class="form-control"><strong>ID: </strong> <?php echo e($convite->id); ?></li>
				<li class="form-control"><strong>Código: </strong> <?php echo e($convite->codigo); ?></li>
				<li class="form-control"><strong>Gerado em: </strong> <?php echo e(date('d/m/Y H:i:s', strtotime($convite->created_at))); ?></li>				
				<li class="form-control"><strong>Expira em: </strong> <?php echo e(date('d/m/Y H:i:s', strtotime('+2 days', strtotime($convite->created_at)))); ?></li>
				<li class="form-control"><strong>Usado: </strong> 
				<?php if($convite->status): ?>
					<span class='btn btn-danger'>NÃO</span>
				<?php else: ?>
					<span class='btn btn-success'>SIM</span>
				<?php endif; ?>
				</li>
				<br>
			</ul>	
		</div> 

	</div>
	
	<a class="btn btn-warning" href="javascript:history.go(-1)">Voltar</a>

	<a class="btn btn-danger" href="#" style="float: right;">Excluir</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>