<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_user')): ?>  
    
    <?php $__env->startSection('title', 'Regras'); ?>
    <?php $__env->startSection('content'); ?>

    <h1>Usuários/Roles(Grupos)</h1>

        <a href="<?php echo e(url('user/'.$user->id.'/setors')); ?>" class="btn btn-info btn-xs"> Alterar Setor de Trabalho</a>

        <br><br>

        <div class="box box-primary col-lg-3">
            <h2 class="box-title">Usuário: <b><?php echo e($user->name); ?></b></h2>
            <br>
            <h2 class="box-title">Email: <b><?php echo e($user->email); ?></b></h2>
            <br>
            <h2 class="box-title">CPF: <b><?php echo e($user->cpf); ?></b></h2>
        </div>

        <form method="POST" action="<?php echo e(action('UserController@roleUpdate')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
            <label>Adicionar Grupo (Role):</label>
            <select name="role_id">
                <?php $__empty_1 = true; $__currentLoopData = $all_roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <option value="<?php echo e($all_role->id); ?>">
                        <?php echo e($all_role->name); ?> | <?php echo e($all_role->label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <option>Nenhuma Opção</option>     
                <?php endif; ?>
            </select>
            <label>Ao usuário:</label>
            <span><?php echo e($user->id); ?> | <small><?php echo e($user->name); ?></small></span>
            <input class="btn btn-success btn-sm" type="submit" value="Adicionar">
        </form>

        
        <div class="box-header">
            <h3 class="box-title">Roles (Grupos): </h3>        
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome (Name)</th>
                    <th>Rótulo (Label)</th>
                    <th>Excluir</th>
                </tr>


                <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($role->id); ?></td>
                    <td><?php echo e($role->name); ?></td>
                    <td><?php echo e($role->label); ?></td>

                    
                    
                    <td>

                        <form method="POST" action="<?php echo e(action('UserController@roleDestroy')); ?>" id="formDelete<?php echo e($role->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
                            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($role->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($role->id); ?>() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($role->id); ?>").submit();
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