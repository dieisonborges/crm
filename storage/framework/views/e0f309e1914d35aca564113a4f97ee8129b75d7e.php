<?php $__env->startSection('title', 'Regras'); ?>
<?php $__env->startSection('content'); ?>


<h1>Donos e gestores da franquia: <b><?php echo e($franquia->nome); ?></b></h1>
<h6>Id: <b><?php echo e($franquia->id); ?></b></h6>
<h6>Código da Franquia: <b><?php echo e($franquia->codigo_franquia); ?></b></h6>
<h6>Slogan: <b><?php echo e($franquia->slogan); ?></b></h6>




<br>

<form method="POST" action="<?php echo e(action('FranquiaController@donoUpdate')); ?>" class="form-group col-md-12">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="franquia_id" value="<?php echo e($franquia->id); ?>">
    

    <div class="form-group col-md-6">
        <label>Adicionar Usuário:</label>
        <select name="dono_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários à franquia"
                style="width: 100%;" required="required">
                <?php $__empty_1 = true; $__currentLoopData = $all_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <option value="<?php echo e($user->id); ?>">
                        <?php echo e($user->name); ?> | <?php echo e($user->email); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <option>Nenhuma Opção</option>     
                <?php endif; ?>
                      
        </select>

    </div>
    <div class="form-group col-md-4">
        <label>à Franquia:</label>
        <span class="form-control"><small><?php echo e($franquia->nome); ?></small></span>
    </div>
    <div class="form-group col-md-2" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>




<br><br><br>

    <?php if(session('status')): ?>
        <div class="alert alert-success" donos="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Usuários dono(s) da franquia:</h3>        
    </div>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding  col-md-12">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>e-Mail</th>
                <th>Excluir</th>
            </tr>


            <?php $__empty_1 = true; $__currentLoopData = $donos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dono): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($dono->id); ?></td>
                <td><?php echo e($dono->name); ?></td>
                <td><?php echo e($dono->email); ?></td>
                
                <td>

                    <form method="POST" action="<?php echo e(action('FranquiaController@donoDestroy')); ?>" id="formDeleteP<?php echo e($dono->id); ?>">

                        <?php echo csrf_field(); ?>
                        
                        <input type="hidden" name="dono_id" value="<?php echo e($dono->id); ?>">

                        <input type="hidden" name="franquia_id" value="<?php echo e($franquia->id); ?>">
                        

                        <a href="javascript:confirmDeleteP<?php echo e($dono->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDeleteP<?php echo e($dono->id); ?>() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDeleteP<?php echo e($dono->id); ?>").submit();
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

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>