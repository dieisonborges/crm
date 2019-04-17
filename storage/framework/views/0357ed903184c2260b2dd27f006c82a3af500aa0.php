<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_atendimento')): ?>   
	
	<?php $__env->startSection('title', 'Editar Ticket'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Editar Ticket
		        <small><?php echo e($ticket->protocolo); ?></small>
		    </h1>

		    <div class="box-body">              
              <div class="callout callout-info">
                <h5>Usuário: <b><?php echo e($ticket->users->name); ?></b></h5>
                <h5>Número de Protocolo: <b><?php echo e($ticket->protocolo); ?></b></h5>
                <h5>Aberto em: <b><?php echo e(date('d/m/Y H:i:s', strtotime($ticket->created_at))); ?></b></h5>
              </div>              
              
            </div>

            <div class="form-group col-md-2">
				    <label for="status">Status</label>
				    <!--
                    0  => "Fechado",
                    1  => "Aberto",  
                    -->
                    
                    <?php switch($ticket->status):
                        case (0): ?>
                            <span class="btn btn-flat btn-success btn-md col-md-12">Fechado</span>
                            <?php break; ?>                                                               
                        <?php default: ?>
                            <span class="btn btn-flat btn-warning btn-md col-md-12">Aberto</span>
                    <?php endswitch; ?>
                	
				    
			 </div>


			

			<form method="POST" enctype="multipart/form-data" action="<?php echo e(url('atendimentos/'.$setor.'/'.$id.'/update')); ?>" id="form-edit">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="my_setor" value="<?php echo e($setor); ?>">
				
			 	<div class="form-group col-md-4">					
				    <label for="rotulo">Rótulo (Criticidade)</label>				    
					<select class="form-control" name="rotulo">						
						<option value="<?php echo e($ticket->rotulo); ?>" selected="selected"><?php echo e($rotulos[$ticket->rotulo]); ?></option>

	                	<?php $__currentLoopData = $rotulos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Key => $rotulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						   <option value="<?php echo e($Key); ?>"> <?php echo e($rotulo); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
											
					</select>
			 	</div>

			 	<div class="form-group col-md-6">
				    <label for="categoria_id">Categoria</label>
				    <select class="form-control  select2" name="categoria_id" style="width: 100%;">
				    	<?php if($ticket->categoria_id): ?>
				    		<option selected="selected" value="<?php echo e($ticket->categorias->id); ?>"><?php echo e($ticket->categorias->nome); ?> - <?php echo e($ticket->categorias->descricao); ?> </option>
				    	<?php else: ?>
				    		<option selected="selected" value="">Nenhum</option>
            			<?php endif; ?>
				    	<?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				    		<option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nome); ?> - <?php echo e($categoria->descricao); ?> </option>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>                    
	                	<?php endif; ?>			
					</select>
			 	</div>		 	
			 	

		        <div class="form-group col-md-12">
				    <label for="titulo">Título (Descrição Resumida)</label>
				    <input type="text" class="form-control" placeholder="Descrição resumida do problema" name="titulo" value="<?php echo e($ticket->titulo); ?>">
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhe seu o problema ou solicitação" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($ticket->descricao); ?></textarea>
		              </form>
		            </div>
			 	</div> 	


			 	<div>
			 		<hr>
			 	</div>

			 	<div class="form-group col-md-12">
			 		<input type="submit" form="form-edit" class="btn btn-primary" value="Atualizar" style="float: right;">
			 	</div>

			</form>




			
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>