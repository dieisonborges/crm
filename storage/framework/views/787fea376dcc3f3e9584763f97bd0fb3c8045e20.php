<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_log')): ?>  
	
	<?php $__env->startSection('title', 'Log'); ?>
	<?php $__env->startSection('content'); ?>
		<h1>
	        Logs (Registro)
	        <small> nº <?php echo e($log->id); ?></small>
	    </h1>
		<div class="row">
			<div class="col-md-6">	
				<div class="box box-warning">
					<h3>Registro</h3>
					<label><strong>ID: </strong></label>
					<span class="form-control"> <?php echo e($log->id); ?></span>

					<label><strong>Created At: </strong> </label>
					<span class="form-control"> <?php echo e(date('d/m/Y H:i:s', strtotime($log->created_at))); ?></span>

					<label><strong>Updated At: </strong></label>				
					<span class="form-control"> <?php echo e(date('d/m/Y H:i:s', strtotime($log->updated_at))); ?></span>

					<label><strong>IP: </strong></label>
					<span class="form-control"><?php echo e($log->ip); ?></span>
					<!--
					<label><strong>Mac: </strong></label>
					<span class="form-control"><?php echo e($log->mac); ?></span>
					-->
					<label><strong>Host: </strong></label>
					<span class="form-control"><?php echo e($log->host); ?></span>

					<label><strong>Filename: </strong></label>
					<span class="form-control"><?php echo e($log->filename); ?></span>
					
				</div>
			</div>

			<?php if($user): ?>

			<div class="col-md-6">
				<div class="box box-danger">
					<h3>Usuário</h3>
					<label><strong>Apelido: </strong></label>
					<span class="form-control"> <?php echo e($user->apelido); ?></span>

					<label><strong>Nome: </strong> </label>
					<span class="form-control"><?php echo e($user->name); ?></span>

					<label><strong>CPF: </strong></label>				
					<span class="form-control"> <?php echo e($user->cpf); ?></span>

				</div>
			</div>
			<?php else: ?>

			<div class="col-md-6">
				<div class="box box-danger">
					<h3>Operação não necessita LOGIN</h3>

				</div>
			</div>


			<?php endif; ?>

			<div class="col-md-12">
				<div class="box box-success">
					<label><strong>Info: </strong></label>
					<textarea class="form-control" style="min-height: 200px;" ><?php echo e($log->info); ?></textarea>					
				</div>
				
			</div>

		</div>
		
		
		<a href="javascript:history.go(-1)">Voltar</a>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>