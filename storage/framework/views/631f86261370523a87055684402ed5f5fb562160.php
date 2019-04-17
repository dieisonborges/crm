<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_atendimento')): ?>    
    
    <?php $__env->startSection('title', 'Tickets'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Tickets</h1>



        <div class="col-md-12"> 

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('atendimentos/'.$setor->name.'/buscaData')); ?>">
                <?php echo csrf_field(); ?>
                <div class="input-group input-group-lg col-md-12">    

                     <!-- Date and time range -->
                      <div class="form-group col-md-3">
                        <label>Selecione um período:</label>
                      </div>
                      <div class="form-group col-md-4">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="reservationtime" name="periodo[]">
                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->  

                      <input type="submit" value="Buscar" class="btn btn-success">           


                </div>
            </form>
     
        </div> 

        <br><br><br>

        
        <div class="box-header">
            <h3 class="box-title"><?php echo e($setor->label); ?> <small>Gerência de Tickets</small></h3>

            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Protocolo</th>
                    <th>Status</th>
                    <th>Usuário</th>
                    <th>Titulo</th>
                    <th>Criado em:</th>
                    <th>Equipamento</th>
                    <th>Rótulo</th>
                    <th>Tipo</th>
                    <th>Setor de <br> Trabalho</th>
                    <th>Editar</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($ticket->id); ?></td>
                    <td><a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show"><?php echo e($ticket->protocolo); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show">
                            <!--
                            0  => "Fechado",
                            1  => "Aberto",  
                            -->
                            <?php switch($ticket->status):
                                case (0): ?>
                                    <span class="btn btn-success btn-xs">Fechado</span>
                                    <?php break; ?>                                                               
                                <?php default: ?>
                                    <span class="btn btn-warning btn-xs">Aberto</span>
                            <?php endswitch; ?>
                        </a>
                    </td>
                    <td><a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show"><?php echo e($ticket->users->name); ?></a></td>
                    <td><a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show"><?php echo e($ticket->titulo); ?></a></td>
                    <td><a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show"><?php echo e(date('d/m/Y H:i:s', strtotime($ticket->created_at))); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show"><?php echo e($ticket->equipamentos['nome']); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show">
                            <!--
                            0   =>  "Crítico - Emergência (resolver imediatamente)",
                            1   =>  "Alto - Urgência (resolver o mais rápido possível)",
                            2   =>  "Médio - Intermediária (avaliar situação)",
                            3   =>  "Baixo - Rotineiro ou Planejado",
                            -->
                            <?php switch($ticket->rotulo):
                                case (0): ?>
                                    <span class="btn btn-danger btn-xs">Crítico</span>
                                    <?php break; ?>
                                <?php case (1): ?>
                                    <span class="btn btn-warning btn-xs">Alto</span>
                                    <?php break; ?>
                                <?php case (2): ?>
                                    <span class="btn btn-info btn-xs">Médio</span>
                                    <?php break; ?>
                                <?php case (3): ?>
                                    <span class="btn btn-xs">Baixo</span>
                                    <?php break; ?>                            

                            <?php endswitch; ?>
                        </a>
                    </td>

                    <td>
                        <a href="<?php echo e(URL::to('atendimentos')); ?>/<?php echo e($setor->name); ?>/<?php echo e($ticket->id); ?>/show">
                            <!--
                            0  => "Técnico",
                            1  => "Administrativo",  
                            -->
                            <?php switch($ticket->tipo):
                                case (0): ?>
                                    <span>Técnico</span>
                                    <?php break; ?>
                                <?php case (1): ?>
                                    <span>Administrativo</span>
                                    <?php break; ?>                                
                                <?php default: ?>
                                    <span>Nenhum</span>
                            <?php endswitch; ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('atendimentos/'.$setor->name.'/'.$ticket->id.'/setors')); ?>"><i class="fa fa-group"></i> Setor</a>
                    </td>

                    <?php if(($ticket->status)!=0): ?>
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('atendimentos/'.$setor->name.'/'.$ticket->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <?php else: ?>
                    <td>
                        <span class="btn btn-success btn-xs"> Fechado </span>
                    </td>
                    <?php endif; ?>
                    
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                <?php endif; ?>            
                
            </table>
        </div>
        <!-- /.box-body -->

        <?php echo e($tickets->links()); ?>


    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>