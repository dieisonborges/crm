<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_permission')): ?>  
    
    <?php $__env->startSection('title', 'Permissões'); ?>
    <?php $__env->startSection('content'); ?>
    <h1>Permissões  

        <a href="<?php echo e(url('permissions/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>

        <a href="<?php echo e(url('permission/createAuto')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Automatizado</a>

        <a href="<?php echo e(url('roles')); ?>" class="btn btn-primary btn-lg"><i class="fa fa-users"> </i> Roles (Grupos)</a>


    </h1>

        <?php if(session('status')): ?>
            <div class="alert alert-success" permission="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('permissions/busca')); ?>">
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
            <h3 class="box-title">Responsive Hover Table</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome (Name)</th>
                    <th>Rótulo (Label)</th>
                    <th>Role (Grupo)</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($permission->id); ?></td>
                    <td><a href="<?php echo e(URL::to('permissions')); ?>/<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></a></td>
                    <td><a href="<?php echo e(URL::to('permissions')); ?>/<?php echo e($permission->id); ?>"><?php echo e($permission->label); ?></a></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('permission/'.$permission->id.'/roles')); ?>"><i class="fa fa-lock"></i> Role (Grupo Mãe)</a>
                    </td>
                    
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('permissions/'.$permission->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="<?php echo e(action('PermissionController@destroy', $permission->id)); ?>" id="formDelete<?php echo e($permission->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($permission->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($permission->id); ?>() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($permission->id); ?>").submit();
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

                <?php echo e($permissions->links()); ?>      
                
            </table>
        </div>
        <!-- /.box-body -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>