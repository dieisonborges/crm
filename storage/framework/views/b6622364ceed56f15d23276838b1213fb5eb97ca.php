  
    
    <?php $__env->startSection('title', 'Tickets'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Meus Tickets <a href="<?php echo e(url('clients/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>  </h1>



        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('clients/busca')); ?>">
                <?php echo csrf_field(); ?>
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="<?php echo e($buscar); ?>">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
     
        </div> 

        <br><br><br>

        
        <div class="box-header">
            <h3 class="box-title">Gerênciar Meus Tickets</h3>
            
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
                    <th>Categoria</th>
                    <th>Rótulo</th>

                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($ticket->id); ?></td>
                    <td><a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->protocolo); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>">
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
                    <td><a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->users->name); ?></a></td>
                    <td><a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->titulo); ?></a></td>
                    <td><a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>"><?php echo e(date('d/m/Y h:i:s', strtotime($ticket->created_at))); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->categorias['nome']); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('clients')); ?>/<?php echo e($ticket->id); ?>">
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

                    
                    
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                <?php endif; ?>            
                
            </table>
        </div>
        <!-- /.box-body -->

        <?php echo e($tickets->links()); ?>


    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>