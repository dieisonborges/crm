<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_produto')): ?>  
	
	<?php $__env->startSection('title', $produto->name); ?>
	<?php $__env->startSection('content'); ?>
		<h1>
	        Produto 
	        <small><?php echo e($produto->titulo); ?></small>

	        <?php if($produto->status): ?>
	    		<span class="btn btn-success">Ativo</span>
	    	<?php else: ?>
	    		<span class="btn btn-danger">Desativado</span>
	    	<?php endif; ?>

	    </h1>

	    <hr class="hr col-md-12">

    	<div class="row justify-content-center form-group">
		    <div class="col-md-12">
		        
		        	<?php $__empty_1 = true; $__currentLoopData = $imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		        	<div class="col-md-2">
			            <a href="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" data-toggle="lightbox" data-gallery="example-gallery">
			                <img src="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" class="img-fluid">
			            </a>
			        </div>
			        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			        <div class="col-md-2">
			        	<span class="btn btn-primary">
	                        <i class="fa fa-image"></i>
	                         Nenhuma imagem.
	                    </span>
	                </div>
			        <?php endif; ?>	        
		        
		    </div>
		</div>
		<div class="row">		
				
			 	<div class="form-group col-md-12">
				    <label for="titulo">Título:</label>
				    <span class="form-control"><?php echo e($produto->titulo); ?></span>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="palavras_chave">Palavras Chave (Separadas por vírgula):</label>
				    <span class="form-control"><?php echo e($produto->palavras_chave); ?></span>
			 	</div>
			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Cubagem:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="altura" class="text-aqua">Altura (cm)</label>
			    		<span class="form-control"><?php echo e($produto->altura); ?></span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="largura" class="text-aqua">Largura (cm)</label>
			    		<span class="form-control"><?php echo e($produto->largura); ?></span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="comprimento" class="text-aqua">Comprimento (cm)</label>
			    		<span class="form-control"><?php echo e($produto->comprimento); ?></span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="peso" class="text-aqua">Peso (g)</label>
			    		<span class="form-control"><?php echo e($produto->peso); ?></span>
			    	</div>
			    	
				</div>

				<div class="form-group col-md-12">
				    <label for="link_referencia">Link de Referência:</label>
				    <input disabled="disabled" class="form-control" value="<?php echo e($produto->link_referencia); ?>">
			 	</div>		 	


			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" disabled="disabled" placeholder="Detalhes do produto"="required" name="descricao" 
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($produto->descricao); ?></textarea>
		              </form>
		            </div>
			 	</div>	
		</div>
		
		<a href="<?php echo e($produto->id); ?>/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>