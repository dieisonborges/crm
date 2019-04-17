<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_orcamento')): ?>  
	
	<?php $__env->startSection('title', 'Novo Orcamento'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Novo
		        <small>Orcamento</small> 
		    </h1>
			

			<form method="POST" action="<?php echo e(url('orcamento')); ?>" id="formSubmit">
				<?php echo csrf_field(); ?>			
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <input type="date" class="form-control" id="token_validade" name="token_validade" value="<?php echo e(date('d-m-Y', strtotime('+5 days'))); ?>" placeholder="Validade do TOKEN de Orçamento" required>
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor:</label>
	                <select class="form-control select2" name="fornecedor_id">
	                		<option value="" selected="selected">Selecione um fornecedor</option>
						<?php $__empty_1 = true; $__currentLoopData = $fornecedors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>							
							<option value="<?php echo e($fornecedor->id); ?>"><?php echo e($fornecedor->nome_fantasia); ?> - <?php echo e($fornecedor->responsavel); ?> - <?php echo e($fornecedor->email); ?> - <?php echo e($fornecedor->razao_social); ?> </option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>                    
						<?php endif; ?> 
	                </select>
	                
			 	</div>			 	


			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Criar Orçamento">
			 		<hr>

			 	</div>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>