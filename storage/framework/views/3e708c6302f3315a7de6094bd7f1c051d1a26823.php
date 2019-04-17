   
	
	<?php $__env->startSection('title', 'Visualizar Ticket'); ?>
	<?php $__env->startSection('content'); ?>
			  <h1>
		        Ticket 
		        <small><?php echo e($ticket->protocolo); ?></small>
		    </h1>

		    <div class="box-body col-md-4">              
              <div class="callout callout-info">
                <h5>Usuário: <b><?php echo e($ticket->users->name); ?></b></h5>
                <h5>Número de Protocolo: <b><?php echo e($ticket->protocolo); ?></b></h5>
                <h5>Aberto em: <b><?php echo e(date('d/m/Y H:i:s', strtotime($ticket->created_at))); ?></b></h5>
                <h5>Dias abertos: <b><?php echo e(number_format($data_aberto, 0)); ?></b></h5>
              </div>
        </div>	

			 	<div class="form-group col-md-4">
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

			 	<div class="form-group col-md-4">					
				    <label for="rotulo">Rótulo (Criticidade)</label>
							<!--
                            0   =>  "Crítico - Emergência (resolver imediatamente)",
                            1   =>  "Alto - Urgência (resolver o mais rápido possível)",
                            2   =>  "Médio - Intermediária (avaliar situação)",
                            3   =>  "Baixo - Rotineiro ou Planejado",
                            -->
                            <?php switch($ticket->rotulo):
                                case (0): ?>
                                    <span class="btn btn-flat btn-danger btn-md col-md-12">Crítico - Emergência (resolver imediatamente)</span>
                                    <?php break; ?>
                                <?php case (1): ?>
                                    <span class="btn btn-flat btn-warning btn-md col-md-12">Alto - Urgência (resolver o mais rápido possível)</span>
                                    <?php break; ?>
                                <?php case (2): ?>
                                    <span class="btn btn-flat btn-info btn-md col-md-12">Médio - Intermediária (avaliar situação)</span>
                                    <?php break; ?>
                                <?php case (3): ?>
                                    <span class="btn btn-flat btn-md col-md-12">Baixo - Rotineiro ou Planejado</span>
                                    <?php break; ?>                            

                            <?php endswitch; ?>
			 	</div>			 	


			 	<div class="form-group col-md-4">
				    <label for="categoria_id">Categoria</label>
            <?php if($ticket->categoria_id): ?>
				    <span class="col-md-12 form-control"><?php echo e($ticket->categorias->nome); ?> - <?php echo e($ticket->categorias->descricao); ?></span>
            <?php else: ?>
            <span class="col-md-12 form-control">Nenhum</span>
            <?php endif; ?>
				    
			 	</div>
		 	

			 	<!--<a href="javascript:history.go(-1)">Voltar</a>-->


				<div class="col-md-12">
					<div class="box box-default">
					<div class="box-header with-border">
						<i class="fa fa-warning"></i>
						<h3 class="box-title">Ações</h3>

					</div>
					<!-- /.box-header -->

					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->




			
    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo e(date('d M. Y', strtotime($ticket->created_at))); ?>

                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-ticket bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('H:i:s', strtotime($ticket->created_at))); ?></span>

                <h3 class="timeline-header"><a href="#"><?php echo e($ticket->users->name); ?></a> <?php echo e($ticket->titulo); ?></h3>

                <div class="timeline-body">
                 <?php echo html_entity_decode($ticket->descricao); ?>

                </div>
                <div class="timeline-footer">
                  <span class="btn btn-warning btn-xs">Abertura</span>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            <?php $__currentLoopData = $prontuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prontuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- timeline time label -->
                <li class="time-label">
                      <span class="bg-red">
                        <?php echo e(date('d M. Y', strtotime($prontuario->created_at))); ?>

                      </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-comments  bg-gray"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('H:i:s', strtotime($prontuario->created_at))); ?></span>

                    <h3 class="timeline-header"><a href="#"><?php echo e($prontuario->users->name); ?></a></h3>

                    <div class="timeline-body">
                     <?php echo html_entity_decode($prontuario->descricao); ?>

                                      
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            
            
            <!-- timeline item -->
            
            

            <?php if(($ticket->status)==1): ?>

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>

            

            <?php else: ?>

            <!-- -------------- ENCERRAMENTO ------------- -->

            

            <!-- timeline time label -->
            
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-close bg-gray"></i>
              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Encerrado</a></h3>
              </div>
            </li>
            <!-- END timeline item -->

            <li>
              <i class="fa fa-flag-checkered bg-green"></i>
            </li>

            <!-- -------------- FIM ENCERRAMENTO ------------- -->
    
            <?php endif; ?>  

          </ul>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->

    <?php if(($ticket->status)==1): ?>
    <section class="content">
      <a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>/acao"  class="btn btn-info btn-md"><i class="fa fa-plus-circle"></i> Nova Ação</a>

      <a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>/encerrar" class="btn btn-danger btn-md"><i class="fa fa-times-circle"></i> Encerrar Ticket</a>
    </section>
    <?php else: ?>
        
    <?php endif; ?>

    

	
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>