<?php $__env->startSection('title', 'Regras'); ?>
<?php $__env->startSection('content'); ?>


<h1>Role (Grupo) <b><?php echo e($role->label); ?></b></h1>
<h3>Id: <b><?php echo e($role->id); ?></b> Label: <b><?php echo e($role->name); ?></b></h3>

<br>

<form method="POST" action="<?php echo e(action('RoleController@permissionUpdate')); ?>" class="form-group col-md-12">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
    
    <!--
    <select name="permission_id">
        <?php $__empty_1 = true; $__currentLoopData = $all_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <option value="<?php echo e($all_permission->id); ?>">
                <?php echo e($all_permission->name); ?> | <?php echo e($all_permission->label); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <option>Nenhuma Opção</option>     
        <?php endif; ?>
    </select>
    -->

    <div class="form-group col-md-6">
        <label>Adicionar Permissão:</label>
        <select name="permission_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais permissões"
                style="width: 100%;" required="required">
                <?php $__empty_1 = true; $__currentLoopData = $all_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <option value="<?php echo e($all_permission->id); ?>">
                        <?php echo e($all_permission->name); ?> | <?php echo e($all_permission->label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <option>Nenhuma Opção</option>     
                <?php endif; ?>
                      
        </select>

    </div>
    <div class="form-group col-md-3">
        <label>Ao Grupo:</label>
        <span class="form-control"><?php echo e($role->name); ?> | <small><?php echo e($role->label); ?></small></span>
    </div>
    <div class="form-group col-md-3" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>


<br><br><br>

    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Permissions:</h3>        
    </div>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding  col-md-12">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nome (Name)</th>
                <th>Rótulo (Label)</th>
                <th>Excluir</th>
            </tr>


            <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($permission->id); ?></td>
                <td><?php echo e($permission->name); ?></td>
                <td><?php echo e($permission->label); ?></td>
                
                <td>

                    <form method="POST" action="<?php echo e(action('RoleController@permissionDestroy')); ?>" id="formDeleteP<?php echo e($permission->id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
                        <input type="hidden" name="permission_id" value="<?php echo e($permission->id); ?>">
                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                        <!--<input type="submit" name="Excluir">-->

                        <a href="javascript:confirmDeleteP<?php echo e($permission->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDeleteP<?php echo e($permission->id); ?>() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDeleteP<?php echo e($permission->id); ?>").submit();
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