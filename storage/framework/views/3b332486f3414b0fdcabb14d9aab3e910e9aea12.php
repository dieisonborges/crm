 
	 
	<?php $__env->startSection('title', 'Novo Ticket'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Novo Ticket
		        <small>+</small>
		    </h1>
			

			<form method="POST" action="<?php echo e(url('clients')); ?>" enctype="multipart/form-data" id="form-create">
				<?php echo csrf_field(); ?>

			 	<div class="form-group col-md-12">
				    <label for="titulo">Título (Descrição Resumida) <span style="color: red; font-size: 10px;">*80 caract.</span></label>
				    <input type="text" class="form-control" placeholder="Descrição resumida do problema" name="titulo" value="<?php echo e(old('titulo')); ?>" onkeyup="limite_textarea(this.value)" id="texto">
				    <div style="font-size: 10px; color: #AA0000; float: right;">
				    	*<span id="cont">80</span> Restantes <br>
				    </div>
			 	</div>

			 	<script type="text/javascript">
					
				function limite_textarea(valor) {
				    quant = 80;
				    total = valor.length;
				    if(total <= quant) {
				        resto = quant - total;
				        document.getElementById('cont').innerHTML = resto;
				    } else {
				        document.getElementById('texto').value = valor.substr(0,quant);
				    }
				}
				</script>

	            <!-- /.form-group -->

	            <div class="form-group col-md-6">
	                <label>Setor</label>
	                <select name="setor[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais setores para atendimento"
	                        style="width: 100%;" required="required">
		                  	<?php $__empty_1 = true; $__currentLoopData = $setores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		                        <option value="<?php echo e($setor->id); ?>">
		                            <?php echo e($setor->name); ?> | <?php echo e($setor->label); ?>

		                        </option>
		                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                        	<option>Nenhuma Opção</option>     
	                    	<?php endif; ?>
		                  
	                </select>
	            </div>
	            <!-- /.form-group -->

	            <div class="form-group col-md-6">
				    <label for="categoria_id">Categoria</label>
	                <select class="form-control select2" name="categoria_id">
	                	<option value="0">Nenhum - Nenhum categoria.</option>
						<?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nome); ?> - <?php echo e(str_limit($categoria->descricao,30)); ?> </option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>                    
						<?php endif; ?> 
	                </select>
			 	</div>	

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhe seu o problema ou solicitação" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e(old('descricao')); ?></textarea>
		              </form>
		            </div>
			 	</div>

			 	

			 	<div class="col-md-12">
			 		
			 		<!--<button type="submit" class="btn btn-primary" onclick="document.getElementById('formSubmit').submit();">Cadastrar</button>-->
			 		
			 		<input type="submit" form="form-create" class="btn btn-primary" value="Cadastrar">
			 		<hr>
			 	</div>

			 	
			</form>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>