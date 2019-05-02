<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_atendimento')): ?>    
    
    <?php $__env->startSection('title', 'Dashboard'); ?>
    <?php $__env->startSection('content'); ?>    
    
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Painel de Controle <small><?php echo e($setor->label); ?></small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard </li>
      </ol>
    </section>

   
    <div class="col-lg-12 col-xs-12">
      <?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo e($cont_aloc); ?></h3>

              <p>Tickets Não Alocados</p>
            </div>
            <a href="<?php echo e(url('atendimentos/'.$setor->name.'/alocar')); ?>">
              <div class="icon">                
                    <i class="fas fa-ticket-alt"></i>                
              </div>
            </a>
            <a href="<?php echo e(url('atendimentos/'.$setor->name.'/alocar')); ?>" class="small-box-footer">Visualizar Tickets <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


         <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo e($qtd_tick_aber); ?></h3>

              <p>Tickets Abertos</p>
            </div>
            <a href="<?php echo e(url('atendimentos/'.$setor->name.'/tickets/1/status')); ?>">
              <div class="icon">                
                    <i class="fas fa-ticket-alt"></i>                
              </div>
            </a>
            <a href="<?php echo e(url('atendimentos/'.$setor->name.'/tickets/1/status')); ?>" class="small-box-footer">Visualizar Tickets <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo e($qtd_tick_fech); ?></h3>

              <p>Tickets Fechados</p>
            </div>
            <a href="<?php echo e(url('atendimentos/'.$setor->name.'/tickets/0/status')); ?>">
              <div class="icon">
                <i class="fas fa-ticket-alt"></i>
              </div>
            </a>
            <a href="<?php echo e(url('atendimentos/'.$setor->name.'/tickets/0/status')); ?>" class="small-box-footer">Visualizar Tickets <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


    
        
      </div>
      <!-- /.row -->
      <!-- Main row -->     

   
      <!-- Info boxes -->
      <div class="row">






        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <!-- Pessima pratica - melhorar -->
        <?php
            unset($prontuario_tmp);
            $prontuario_tmp[] = $prontuarios[$ticket->id];
        ?>


       <div class="col-md-4">
          <!-- DIRECT CHAT PRIMARY -->
          <!--
          0   =>  "Crítico - Emergência (resolver imediatamente)",
          1   =>  "Alto - Urgência (resolver o mais rápido possível)",
          2   =>  "Médio - Intermediária (avaliar situação)",
          3   =>  "Baixo - Rotineiro ou Planejado",
          4   =>  "Nenhum",
          -->
          <?php switch($ticket->rotulo):
              case (0): ?>
                  <div class="box box-danger direct-chat direct-chat-primary collapsed-box">
              <?php break; ?>
              <?php case (1): ?>
                  <div class="box box-warning direct-chat direct-chat-primary collapsed-box">
              <?php break; ?>
              <?php case (2): ?>
                  <div class="box box-info direct-chat direct-chat-primary collapsed-box">
              <?php break; ?>
              <?php case (3): ?>
                  <div class="box box-default direct-chat direct-chat-primary collapsed-box">
              <?php break; ?>
              <?php case (4): ?>
                  <div class="box box-primary direct-chat direct-chat-primary collapsed-box">                  
              <?php break; ?>
          <?php endswitch; ?>         


            <div class="box-header with-border">
              <h3 class="box-title">
                <a href="<?php echo e(url('atendimentos/'.$setor->name.'/'.$ticket->id.'/show')); ?>" class="text-black" style="font-size: 20px;">
                  <?php echo e(str_limit($ticket->titulo, $limit = 20, $end = '...')); ?>

                </a></h3><br>
              <a href="<?php echo e(url('atendimentos/'.$setor->name.'/'.$ticket->id.'/show')); ?>">Ticket: <b><?php echo e($ticket->protocolo); ?></b></a><br>
              <small>Aberto há <b><?php echo e(floor((strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($ticket->created_at)))) / (60 * 60 * 24))); ?> dia(s)</b></small><br>

              
              <?php $__currentLoopData = $prontuario_tmp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prontuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($prontuario['descricao']): ?>

                  <small>Última ação há <b><?php echo e(floor((strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($prontuario['created_at'])))) / (60 * 60 * 24))); ?> dia(s)</b></small><br>

                <?php else: ?>
                  <small>Nenhuma ação.</small><br>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              <!--
              0   =>  "Crítico - Emergência (resolver imediatamente)",
              1   =>  "Alto - Urgência (resolver o mais rápido possível)",
              2   =>  "Médio - Intermediária (avaliar situação)",
              3   =>  "Baixo - Rotineiro ou Planejado",
              4   =>  "Nenhum",
              -->
              <div class="box-tools pull-right">
                <?php switch($ticket->rotulo):
                    case (0): ?>
                        <span data-toggle="tooltip" title="Crítico" class="badge bg-red">Crítico</span>
                    <?php break; ?>
                    <?php case (1): ?>
                        <span data-toggle="tooltip" title="Alto" class="badge bg-yellow">Alto</span>
                    <?php break; ?>
                    <?php case (2): ?>
                        <span data-toggle="tooltip" title="Médio" class="badge bg-purple">Médio</span>
                    <?php break; ?>
                    <?php case (3): ?>
                        <span data-toggle="tooltip" title="Baixo" class="badge bg-navy">Baixo</span>
                    <?php break; ?>
                    <?php case (4): ?>
                        <span data-toggle="tooltip" title="Nenhum" class="badge bg-blue">Nenhum</span>
                    <?php break; ?>
                <?php endswitch; ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->

                
                <?php $__currentLoopData = $prontuario_tmp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tickets->prontuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($prontuario['descricao']): ?>
                    <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <!--<span class="direct-chat-name pull-left">{//{//$prontuario['user_id']}}</span>-->
                      <span class="direct-chat-timestamp pull-right"><?php echo e(date('d/m/Y H:i:s', strtotime($prontuario['created_at']))); ?></span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="<?php echo e(asset('img/default-user-image.png')); ?>" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo html_entity_decode($prontuario['descricao']); ?>

                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                <?php else: ?>

                <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


              </div>
              <!--/.direct-chat-messages-->

           
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="<?php echo e(url('atendimentos/'.$setor->name.'/'.$ticket->id.'/show')); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Mais Informações</a>
              <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/encerrar"  style="float: right;" class="btn btn-danger btn-md"><i class="fa fa-times-circle"></i> Encerrar Ticket</a>            
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->        

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

               
        
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        

        <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Equipe <?php echo e($setor->label); ?></h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo e($equipe_qtd); ?> Alocado(s)</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php $__currentLoopData = $equipe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>

                      <?php

                        $imagem_perfil = $membro->uploads()->orderBy('id', 'DESC')->first();

                      ?>

                      <?php if($imagem_perfil): ?>  
                          <img src="<?php echo e(url('storage/'.$imagem_perfil->dir.'/'.$imagem_perfil->link)); ?>" class="user-image" alt="User Image" width="50px">
                      <?php else: ?>
                          <img src="<?php echo e(asset('img/default-user-image.png')); ?>" class="user-image" alt="User Image" width="50px">
                      <?php endif; ?>

                      
                        <a class="users-list-name" href="#"><?php echo e($membro->apelido); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">Todos</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
        </div>
        <!-- /.col -->

     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.appdashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>