<?php $__env->startSection('title', 'Nova Role'); ?>
<?php $__env->startSection('content'); ?>
		<h1>
	        Score de usuário
	        <small>Aumentar ou Reduzir</small>
	    </h1>
		

		<form method="POST" action="<?php echo e(url('scores')); ?>">
			<?php echo csrf_field(); ?>		

			<div class="form-group mb-12">
			    <label for="motivo">Motivo</label>
			    <input type="text" class="form-control" id="motivo" name="motivo" value="" placeholder="Digite o Motivo..." required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="valor">Valor (Poder ser positivo ou negativo)</label>
			    <input type="text" class="form-control" id="valor" name="valor" value="" placeholder="-10" required>
		 	</div>

		 	<div class="form-group col-md-12">
		        <label>Usuário:</label>
		        <select name="user_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários"
		                style="width: 100%;" required="required">
		                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		                    <option value="<?php echo e($user->id); ?>">
		                        <?php echo e($user->name); ?> | <?php echo e($user->apelido); ?> | <?php echo e($user->email); ?>

		                    </option>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
		                    <option>Nenhuma Opção</option>     
		                <?php endif; ?>
		                      
		        </select>
		    </div>

		 	<div class="form-group col-md-12">
		 		<hr>
		 		<button type="submit" class="btn btn-primary">Cadastrar</button>
		 	</div>

		 	
		</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>