<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_orcamento')): ?>  
	
	<?php $__env->startSection('title', 'Novo Item'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Novo Item
		        <small>Orçamento: <b><?php echo e($orcamento->codigo); ?></b></small> 
		    </h1>
			

			<form method="POST" action="<?php echo e(url('orcamento/itemStore')); ?>" id="formSubmit">
				<?php echo csrf_field(); ?>	

				<input type="hidden" name="orcamento_id" value="<?php echo e($orcamento->id); ?>">

				<div class="form-group col-md-12">
			        <label>Produto:</label>
			        <select name="produto_id" class="form-control select2" data-placeholder="Selecione um produto"
			                style="width: 100%;" required="required">
			                <?php $__empty_1 = true; $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			                    <option value="<?php echo e($produto->id); ?>">
			                        <?php echo e($produto->titulo); ?> | <?php echo e($produto->sku); ?> | <?php echo e($produto->palavras_chave); ?>

			                    </option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			                    <option>Nenhuma Opção</option>     
			                <?php endif; ?>
			                      
			        </select>
			    </div>

			    <div class="form-group col-md-12">		
				
				 	<div class="form-group col-md-2">
					    <label for="quantidade">Quantidade:</label>
					    <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo e(old('quantidade')); ?>" placeholder="Quantidade" required>
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="unidade_medida">Unidade de Medida:</label>

					    <select name="unidade_medida" class="form-control select2" data-placeholder="Selecione uma unidade de medida"
			                style="width: 100%;" required="required">
			                	<option value="<?php echo e(old('unidade_medida')); ?>"><?php echo e(old('unidade_medida')); ?></option>
			                <?php $__empty_1 = true; $__currentLoopData = $unidades_medidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidade_medida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			                    <option value="<?php echo e($unidade_medida); ?>">
			                        <?php echo e($unidade_medida); ?>

			                    </option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			                    <option>Nenhuma Opção</option>     
			                <?php endif; ?>
			                      
			        	</select>
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="preco">Preço:</label>
					    <input disabled="disabled" type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo e(old('preco')); ?>" placeholder="Preço" >
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="frete_preco">Preço do Frete:</label>
					    <input disabled="disabled" type="number" step="0.01" class="form-control" id="frete_preco" name="frete_preco" value="<?php echo e(old('frete_preco')); ?>" placeholder="Preço do Frete" >
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="frete_tipo">Tipo de Frete:</label>
					    <input disabled="disabled" type="text" class="form-control" id="frete_tipo" name="frete_tipo" value="<?php echo e(old('frete_tipo')); ?>" placeholder="DHL, Aéreo, Terrestre, Marítimo ..." >
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="moeda">Moeda:</label>

					    <select disabled="disabled" name="moeda" class="form-control select2" data-placeholder="Selecione uma unidade de medida"
			                style="width: 100%;">
			                	<option value="<?php echo e(old('moeda')); ?>"><?php echo e(old('moeda')); ?></option>
			                <?php $__empty_1 = true; $__currentLoopData = $moedas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moeda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			                    <option value="<?php echo e($moeda); ?>">
			                        <?php echo e($moeda); ?>

			                    </option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			                    <option>Nenhuma Opção</option>     
			                <?php endif; ?>
			                      
			        	</select>
				 	</div>

			 	</div>		 	

		    			 	


			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Adicionar Item">
			 		<hr>

			 	</div>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>