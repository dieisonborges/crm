<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_ticket')): ?>    
    
    <?php $__env->startSection('title', 'Tickets'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Tickets 


        <a href="<?php echo e(url('tickets/1/status')); ?>" class="btn btn-info btn-lg"><i class="fa fa-search"> </i> Abertos</a> 

        <a href="<?php echo e(url('tickets/0/status')); ?>" class="btn btn-info btn-lg"><i class="fa fa-search"> </i> Fechados</a> 

        <a href="<?php echo e(url('tickets/')); ?>" class="btn btn-info btn-lg"><i class="fa fa-search"> </i> Todos</a> 

    </h1>



        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('tickets/busca')); ?>">
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
            <h3 class="box-title">Gerência de Tickets</h3>
            
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
                    <th>Setor de <br> Trabalho</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($ticket->id); ?></td>
                    <td><a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->protocolo); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>">
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
                    <td><a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->users->name); ?></a></td>
                    <td><a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->titulo); ?></a></td>
                    <td><a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>"><?php echo e(date('d/m/Y H:i:s', strtotime($ticket->created_at))); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>"><?php echo e($ticket->categorias['nome']); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('tickets')); ?>/<?php echo e($ticket->id); ?>">
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
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('tickets/'.$ticket->id.'/setors')); ?>"><i class="fa fa-group"></i> Setor</a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('tickets/'.$ticket->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="<?php echo e(action('TicketController@destroy', $ticket->id)); ?>" id="formDelete<?php echo e($ticket->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($ticket->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($ticket->id); ?>() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($ticket->id); ?>").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                    </td>
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