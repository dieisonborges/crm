 
	
	<?php $__env->startSection('title', 'Adicionar Ação ao Ticket'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Encerrar Ticket
		        <small><?php echo e($ticket->protocolo); ?></small>
		    </h1>

		    <div class="box-body">              
              <div class="callout callout-danger">
                <h5>Usuário: <b><?php echo e($ticket->users->name); ?></b></h5>
                <h5>Número de Protocolo: <b><?php echo e($ticket->protocolo); ?></b></h5>
                <h5>Aberto em: <b><?php echo e(date('d/m/Y H:i:s', strtotime($ticket->created_at))); ?></b></h5>
              </div>              
              
            </div>

			<form method="POST" enctype="multipart/form-data" action="<?php echo e(action('ClientController@storeEncerrar')); ?>" id="form-edit">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">				
			 	
			 	<div class="form-group col-md-12">
				    <label for="descricao">Deixe uma mensagem de encerramento</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhe seu o problema ou solicitação" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
		              </form>
		            </div>
			 	</div> 	


			 	<div>
			 		<hr>
			 	</div>

			 	<input type="submit" form="form-edit" class="btn btn-danger" value="Encerrar">

			</form>

			
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>