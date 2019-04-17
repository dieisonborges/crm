<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_user')): ?>    
    
    <?php $__env->startSection('title', 'Usuários'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Usuários</h1>



        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('users/busca')); ?>">
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
            <h3 class="box-title">Gerência de Usuários</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Celular</th>
                    <th>Status</th>
                    <th>Login<br> (Max 15)</th>
                    <th>Desativar <br>Ativar</th>
                    <th>Roles <br> Grupo</th>
                    <th>Setor de <br> Trabalho</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($user->id); ?>"><?php echo e($user->name); ?></a></td>
                    <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($user->id); ?>"><?php echo e($user->email); ?></a></td>
                    <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($user->id); ?>"><?php echo e($user->cpf); ?></a></td>
                    <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($user->id); ?>"><?php echo e($user->telefone); ?></a></td>
                    <td>
                        <?php if($user->status): ?>
                            <span class="label label-success">ATIVO</span>                        
                        <?php else: ?>
                            <span class="label label-danger">INATIVO</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(($user->login)<=15): ?>
                            <span class="label label-success"><?php echo e($user->login); ?></span>
                        <?php else: ?>
                            <span class="label label-danger"><?php echo e($user->login); ?></span>
                        <?php endif; ?>
                    </td>               
                    <td>                  

                        <?php if($user->status): ?>
                            <form method="POST" action="<?php echo e(action('UserController@updateActive')); ?>">
                                <?php echo csrf_field(); ?>    
                                <input type="hidden" name="status" value="0">
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">                  
                                <input type="submit" class="btn btn-danger btn-xs" value="Desativar">
                            </form>                        
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(action('UserController@updateActive', $user->id)); ?>">
                                <?php echo csrf_field(); ?>       
                                <input type="hidden" name="status" value="1">   
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">                   
                                <input type="submit" class="btn btn-success btn-xs" value="Ativar">
                            </form>
                            
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('user/'.$user->id.'/roles')); ?>"><i class="fa fa-lock"></i> Roles</a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('user/'.$user->id.'/setors')); ?>"><i class="fa fa-group"></i> Setor</a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('users/'.$user->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="<?php echo e(action('UserController@destroy', $user->id)); ?>" id="formDelete<?php echo e($user->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($user->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($user->id); ?>() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($user->id); ?>").submit();
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

        <?php echo e($users->links()); ?>


    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>