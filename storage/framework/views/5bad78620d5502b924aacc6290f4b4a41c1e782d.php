<?php $__env->startSection('title', 'Regras'); ?>
<?php $__env->startSection('content'); ?>
<h1>Role - Grupo <a href="<?php echo e(url('roles/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('roles/busca')); ?>">
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
        <h3 class="box-title">Role - Grupo - Papéis</h3>
        
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nome (Name)</th>
                <th>Rótulo (Label)</th>
                <th>Permissions</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><a href="<?php echo e(URL::to('roles')); ?>/<?php echo e($role->id); ?>"><?php echo e($role->id); ?></a></td>
                <td><a href="<?php echo e(URL::to('roles')); ?>/<?php echo e($role->id); ?>"><?php echo e($role->name); ?></a></td>
                <td><a href="<?php echo e(URL::to('roles')); ?>/<?php echo e($role->id); ?>"><?php echo e($role->label); ?></a></td>
                <td>
                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('role/'.$role->id.'/permissions')); ?>"><i class="fa fa-lock"></i> Permissions (filha)</a>
                </td>
                <td>
                    <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('roles/'.$role->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                </td>
                <td>

                    <form method="POST" action="<?php echo e(action('RoleController@destroy', $role->id)); ?>" id="formDelete<?php echo e($role->id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                        <!--<input type="submit" name="Excluir">-->

                        <a href="javascript:confirmDelete<?php echo e($role->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
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

            <tr>
                <td><b>Nenhum Resultado.</b></td>
            </tr>
                
            <?php endif; ?>            
            
        </table>
    </div>
    <!-- /.box-body -->
    <?php echo e($roles->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>