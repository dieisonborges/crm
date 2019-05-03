<?php $__env->startSection('title', $user->name); ?>
<?php $__env->startSection('content'); ?>
	<h1>
		<i class="fa fa-star"></i>
        Perfil e Score
        <small>de <?php echo e($user->name); ?></small>
    </h1>
	<div class="row">	


		
		    <div class="box-body col-md-4">              
              <div class="callout callout-info">
              	<h5>ID: <b> <?php echo e($user->id); ?></b></h5>
                <h5>Apelido: <b> <?php echo e($user->apelido); ?></b></h5>
                <h5>Nome Completo: <b> <?php echo e($user->name); ?></b></h5>
                <h5>e-Mail: <b><?php echo e($user->email); ?></b></h5>
                <h5>CPF: <b> <?php echo e($user->cpf); ?></b></h5>
                <h5>Telefone: <b> <?php echo e($user->phone_number); ?></b></h5>
                <h5>Desde: <b> <?php echo e(date('d/m/Y H:i:s', strtotime($user->created_at))); ?></b></h5>
                
              </div>
        </div>

        <div class="box-body col-md-6"> 
          
          <div class="form-group col-md-2"> 
               <a class="btn btn-warning btn-xl" href="<?php echo e(URL::to('users/'.$user->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
          </div>
          <div class="form-group col-md-2">
              <?php if($user->status): ?>
                  <form method="POST" action="<?php echo e(action('UserController@updateActive')); ?>">
                      <?php echo csrf_field(); ?>    
                      <input type="hidden" name="status" value="0">
                      <input type="hidden" name="id" value="<?php echo e($user->id); ?>">                  
                      <input type="submit" class="btn btn-danger btn-xl" value="- Desativar">
                  </form>                        
              <?php else: ?>
                  <form method="POST" action="<?php echo e(action('UserController@updateActive', $user->id)); ?>">
                      <?php echo csrf_field(); ?>       
                      <input type="hidden" name="status" value="1">   
                      <input type="hidden" name="id" value="<?php echo e($user->id); ?>">                   
                      <input type="submit" class="btn btn-success btn-xl" value="+ Ativar">
                  </form>
                  
              <?php endif; ?>
          </div>
          <div class="form-group col-md-2">
              <a class="btn btn-primary btn-xl" href="<?php echo e(URL::to('user/'.$user->id.'/roles')); ?>"><i class="fa fa-lock"></i> Roles</a>
          </div>
          <div class="form-group col-md-2">
              <a class="btn btn-primary btn-xl" href="<?php echo e(URL::to('user/'.$user->id.'/setors')); ?>"><i class="fa fa-group"></i> Setor</a>
          </div>
          <div class="form-group col-md-2"> 
              <a class="btn btn-warning btn-xl" href="<?php echo e(URL::to('users/'.$user->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
          </div> 

        </div>

        

        <div class="col-md-12">              
              
            <?php $__currentLoopData = $conquistas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conquista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4"> 
                <div class="form-group col-md-12">
                  <div class="container-medalha">         
                    <img src="<?php echo e(url('img/conquistas/'.$conquista->imagem_medalha)); ?>" width="100%"  alt="<?php echo e($conquista->imagem_medalha); ?>" class="imagem-medalha-ajuste">
                    <i class="<?php echo e($conquista->icone_medalha); ?> icone-medalha-ajuste"></i>
                    <span class="imagem-texto"><b><?php echo e($conquista->titulo); ?></b> <br> <?php echo e($conquista->descricao); ?></span>
                  </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <?php if($user_score): ?>

        <div class="box-body col-md-12">              
              <div class="callout callout-primary">
              	<h3>Score Atual: <b> <?php echo e($user_score->valor); ?></b> pontos</h3>
              	<?php for($i=0; $i<=(($user_score->valor)-1); $i++): ?>
              		<?php if(($i % 10)==0): ?>
              			&nbsp;&nbsp;
              		<?php endif; ?>

              		<?php if(($i % 30)==0): ?>
						        <br>
					       <?php endif; ?>
              		<i class="fa fa-star" style="color: rgb(<?php echo e($i); ?>,<?php echo e($i); ?>,0)"></i>

              	<?php endfor; ?>
                
              </div>
        </div>

        <?php endif; ?>

	</div>



    <?php if($scores): ?>

	    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
      	<hr class="col-md-12 hr">

        	<h3>Linha do Tempo - Score</h3>

        <hr class="col-md-12 hr">
        <div class="col-md-12">       	

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-blue">
                    <?php echo e(date('d M. Y', strtotime($user->created_at))); ?>

                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('H:i:s', strtotime($user->created_at))); ?></span>

                <h3 class="timeline-header"><a href="#">Score: </a><b>0</b></h3>

                <div class="timeline-body">
                 Entrada no e-Cardume
                </div>
                <div class="timeline-footer">
                  <span class="btn btn-warning btn-xs">Inicio</span>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            <?php $__currentLoopData = $scores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- timeline time label -->
                <li class="time-label">
                	<?php if(($score->valor)>=0): ?>
                      	<span class="bg-green">
                    <?php else: ?>
                    	<span class="bg-red">
                    <?php endif; ?>
                        	<?php echo e(date('d M. Y', strtotime($score->created_at))); ?>

                      	</span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  
                  	<?php if(($score->valor)>=0): ?>
                      	<i class="fa fa-plus-circle  bg-gray"></i>
                    <?php else: ?>
                    	<i class="fa fa-minus-circle  bg-gray"></i>
                    <?php endif; ?>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('H:i:s', strtotime($score->created_at))); ?></span>

                    <?php if(($score->valor)>=0): ?>
	                    <h3 class="timeline-header"><a href="#">Parabéns você ganhou: </a><b><?php echo e($score->valor); ?> pontos</b></h3>
		            <?php else: ?>
		            	<h3 class="timeline-header"><a href="#">Infelizmente você perdeu: </a><b><?php echo e($score->valor); ?> pontos</b></h3>
		            <?php endif; ?>                    

                    <div class="timeline-body">
                     <?php echo html_entity_decode($score->motivo); ?>

                    </div>

                    <?php if(($score->valor)>=0): ?>
	                    <div class="timeline-footer">
		                  	<span class="btn btn-success btn-xs">Ganhou</span>
		                </div>
		            <?php else: ?>
		            	<div class="timeline-footer">
		                  	<span class="btn btn-danger btn-xs">Perdeu</span>
		                </div>
		            <?php endif; ?>
                                      
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            
            
            <!-- timeline item -->
            
            

            <?php if(($user->status)==1): ?>

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>

            

            <?php else: ?>

            <!-- -------------- ENCERRAMENTO ------------- -->

            

            <!-- timeline time label -->
            
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-times-circle bg-gray"></i>
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

    <?php else: ?>

    <?php endif; ?>
	
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>