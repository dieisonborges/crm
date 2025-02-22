<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_atendimento')): ?>      
	
	<?php $__env->startSection('title', 'Visualizar Ticket'); ?>
	<?php $__env->startSection('content'); ?>

        <a href="#footer" class="btn btn-primary" style="float: right;"><span class="fa fa-arrow-down"></span></a>

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
                                    <span class="btn btn-flat bg-purple btn-md col-md-12">Médio - Intermediária (avaliar situação)</span>
                                    <?php break; ?>
                                <?php case (3): ?>
                                    <span class="btn btn-flat bg-navy btn-md col-md-12">Baixo - Rotineiro ou Planejado</span>
                                    <?php break; ?>
                                <?php case (4): ?>
                                    <span class="btn btn-flat btn-info btn-md col-md-12">Nenhum</span>
                                    <?php break; ?>
                                <?php break; ?>                           

                            <?php endswitch; ?>
			 	</div>			 	


			 	<div class="form-group col-md-8">
				    <label for="categoria_id">Categoria</label>
            <?php if($ticket->categoria_id): ?>
				    <span class="col-md-12 form-control"><?php echo e($ticket->categorias->nome); ?></span>
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
              <i class="fa fa-ticket-alt bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> <?php echo e(date('H:i:s', strtotime($ticket->created_at))); ?></span>


                <h3 class="user-header timeline-header">                    
                        <img src="<?php echo e(asset('img/default-user-image.png')); ?>" class="img-circle" alt="User Image" width="30px"> 
                        <a href="#"><?php echo e($ticket->users->apelido); ?></a> 
                        <br><br>
                        <?php echo e($ticket->titulo); ?>                    
                </h3>

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
                    <span class="time"><i class="fas fa-clock"></i> <?php echo e(date('H:i:s', strtotime($prontuario->created_at))); ?></span>

                    <h3 class="user-header timeline-header">                    
                            <img src="<?php echo e(asset('img/default-user-image.png')); ?>" class="img-circle" alt="User Image" width="30px"> 
                            <a href="#"><?php echo e($prontuario->users->apelido); ?></a>                                                
                    </h3>

                    <div class="timeline-body">
                     <?php echo html_entity_decode($prontuario->descricao); ?>

                                      
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            
            
            <!-- timeline item -->
            
            

            <?php if(($ticket->status)==1): ?>

            <li>
              <i class="fa fa-clock bg-gray"></i>
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
    <section class="content">

    <?php if(($ticket->status)==1): ?>

      <a  class="btn btn-warning btn-md" href="<?php echo e(URL::to('atendimentos/'.$setor.'/'.$ticket->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar Ticket</a>
    
      <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor); ?>/<?php echo e($ticket->id); ?>/acao"  class="btn btn-info btn-md"><i class="fa fa-plus-circle"></i> Nova Ação</a>

      <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor); ?>/<?php echo e($ticket->id); ?>/encerrar" class="btn btn-danger btn-md"><i class="fa fa-times-circle"></i> Encerrar Ticket</a>

    <?php else: ?>

    <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor); ?>/<?php echo e($ticket->id); ?>/reabrir" class="btn btn-success btn-md"><i class="fa fa-arrow-up"></i> Reabrir Ticket</a>
        
    <?php endif; ?>    

    <a  class="btn btn-info btn-md" style="float: right;" href="<?php echo e(URL::to('atendimentos/'.$setor.'/'.$ticket->id.'/setors')); ?>"><i class="fa fa-group"></i> Setores Vinculados Ao Ticket</a>
    
    </section>

    <section class="content">

        <div class="form-group col-md-12">
            <div class="box-header">
            <h3 class="box-title">Arquivos: </h3>

            <a href="<?php echo e(URL::to('uploads')); ?>/<?php echo e($ticket->id); ?>/create/ticket"  class="btn btn-info btn-md" style="float: right;"><i class="fa fa-plus-circle"></i> Novo Arquivo</a>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Titulo</th>
                        <th>Nome</th>
                        <th>Tamanho</th>
                        <th>Tipo</th>
                        <th>Ver</th>
                        <th>Excluir</th>
                    </tr>
                    <?php $__empty_1 = true; $__currentLoopData = $uploads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upload): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a href="<?php echo e(url('storage/'.$upload->dir.'/'.$upload->link)); ?>" target="_blank"><?php echo e($upload->link); ?></a> </td>
                        <td><a href="<?php echo e(url('storage/'.$upload->dir.'/'.$upload->link)); ?>" target="_blank"><?php echo e($upload->titulo); ?></a></td>
                        <td><a href="<?php echo e(url('storage/'.$upload->dir.'/'.$upload->link)); ?>" target="_blank"><?php echo e($upload->nome); ?></a></td>
                        <td><a href="<?php echo e(url('storage/'.$upload->dir.'/'.$upload->link)); ?>" target="_blank"><?php echo e(number_format(($upload->tam/1000), 2, ',', '')); ?> kbytes</a></td>
                        <td><a href="<?php echo e(url('storage/'.$upload->dir.'/'.$upload->link)); ?>" target="_blank"><?php echo e($upload->tipo); ?></a></td>
                        <td><a href="<?php echo e(url('storage/'.$upload->dir.'/'.$upload->link)); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Visualizar</a></td>                       

                        <td>
                            <form method="POST" action="<?php echo e(url('uploads/destroy', $upload->id)); ?>" id="formDelete<?php echo e($upload->id); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($upload->id); ?>">                                

                                <a href="javascript:confirmDelete<?php echo e($upload->id); ?>();" class="btn btn-danger"> <i class="fa fa-close"></i></a>
                            </form> 

                            <script>
                               function confirmDelete<?php echo e($upload->id); ?>() {

                                var result = confirm('Tem certeza que deseja excluir?');

                                if (result) {
                                        document.getElementById("formDelete<?php echo e($upload->id); ?>").submit();
                                    } else {
                                        return false;
                                    }
                                } 
                            </script>

                        </td>      
                        
                    </tr>                
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td>
                            <span class="btn btn-primary">
                                <i class="fa fa-archive"></i>
                                 Nenhum arquivo relacionado.
                            </span>
                        </td>
                        
                    </tr>
                        
                    <?php endif; ?>            
                    
                </table>
            </div>
            <!-- /.box-body -->
        
        </div>

    </section>

    <a href="#main-header" class="btn btn-primary" style="float: right;"><span class="fa fa-arrow-up"></span></a>


  <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>