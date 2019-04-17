<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_ticket')): ?>  
    
    <?php $__env->startSection('title', 'Regras'); ?>
    <?php $__env->startSection('content'); ?>

    <h1>Setor(es) de Trabalho Associados ao Ticket <small><?php echo e($ticket->protocolo); ?></small></h1>
        <div class="box-body col-md-6">              
              <div class="callout callout-info">
                <h5>Usuário: <b><?php echo e($ticket->users->name); ?></b></h5>
                <h5>Número de Protocolo: <b><?php echo e($ticket->protocolo); ?></b></h5>
                <h5>Aberto em: <b><?php echo e(date('d/m/Y H:i:s', strtotime($ticket->created_at))); ?></b></h5>
                <h5>Título: <b><?php echo e($ticket->titulo); ?></b></h5>
              </div>
        </div>


        <div class="col-md-12">  
            <form method="POST" action="<?php echo e(action('TicketController@setorUpdate')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                <label>Adicionar Setor:</label>
                <select name="setor_id">
                    <?php $__empty_1 = true; $__currentLoopData = $all_setors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_setor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <option value="<?php echo e($all_setor->id); ?>">
                            <?php echo e($all_setor->name); ?> | <?php echo e($all_setor->label); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <option>Nenhuma Opção</option>     
                    <?php endif; ?>
                </select>
                <label>Ao usuário:</label>
                <span><?php echo e($ticket->protocolo); ?> | <small><?php echo e($ticket->id); ?></small></span>
                <input class="btn btn-success btn-sm" type="submit" value="Adicionar">
            </form>
        </div>

        
        <div class="box-header col-md-12">
            <h3 class="box-title">Setores Incluídos: </h3>        
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-12">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome (Name)</th>
                    <th>Rótulo (Label)</th>
                    <th>Excluir</th>
                </tr>


                <?php $__empty_1 = true; $__currentLoopData = $setors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($setor->id); ?></td>
                    <td><?php echo e($setor->name); ?></td>
                    <td><?php echo e($setor->label); ?></td>

                    
                    
                    <td>

                        <form method="POST" action="<?php echo e(action('TicketController@setorDestroy')); ?>" id="formDelete<?php echo e($setor->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="setor_id" value="<?php echo e($setor->id); ?>">
                            <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($setor->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($setor->id); ?>() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($setor->id); ?>").submit();
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
       

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>