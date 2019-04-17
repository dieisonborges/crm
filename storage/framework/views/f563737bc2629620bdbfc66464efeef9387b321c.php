<?php $__env->startSection('title', 'Contato'); ?>
<?php $__env->startSection('content'); ?>
		<h3 class="mb-3">Entre em Contato para Informar Problemas no Sistema</h3>
		<h4 class="mb-3">Somente Bugs</h4>
		<?php if($message = Session::get('success')): ?>
			<div class="alert alert-success">
				<?php echo e($message); ?>

			</div>
		<?php endif; ?>

		<?php if(count($errors)>0): ?>
			<div class="alert alert-danger">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		<?php endif; ?>

		<form method="POST" action="<?php echo e(url('contato/enviar')); ?>">
			<?php echo csrf_field(); ?>

			<div class="form-group mb-3">
			    <label for="nome">Nome</label>
			    
			    <input type="hidden" id="nome" name="nome" value="<?php echo e(Auth::user()->cargo); ?> <?php echo e(Auth::user()->name); ?>">
			    <span class="form-control"><?php echo e(Auth::user()->cargo); ?> <?php echo e(Auth::user()->name); ?></span>
		 	</div>

		 	<div class="form-group mb-3">
			    <label for="email">E-mail</label>			    

			    <input type="hidden" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>">
			    <span class="form-control"><?php echo e(Auth::user()->email); ?></span>
		 	</div>

			<div class="form-group mb-3">
			    <input type="hidden" id="assunto" name="assunto" value="Bugs - Problemas no CRM">
			    <label for="assunto">Assunto</label>
			    <span class="form-control">Bugs - Problemas no CRM</span>
		 	</div>
		 	
		 	<div class="form-group mb-3">
			    <label for="msg">Mensagem</label>
			   	<textarea class="form-control" id="msg" name="msg" rows="3" placeholder="Digite sua Mensagem..." required></textarea>
		 	</div>
		 	
		 	<button type="submit" class="btn btn-primary">Enviar Mensagem</button>
		</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>