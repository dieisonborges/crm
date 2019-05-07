<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_categoria')): ?>    
    
    <?php $__env->startSection('title', 'Categorias'); ?>
    <?php $__env->startSection('content'); ?>    
    <h1>Categorias <a href="<?php echo e(url('categorias/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a>  </h1>


    <a href="<?php echo e(url('categorias/sincronizar')); ?>" class="btn btn-info btn-lg"><i class="fa fa-sync"> </i> Sincronizar</a> 

        <br><br><br>

        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('categorias/busca')); ?>">
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

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Categorias | Franquias Locais (7p CRM)</h3>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr> 
                <?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($categoria->id); ?></td>

                    <td>
                        <a href="<?php echo e(URL::to('categorias')); ?>/<?php echo e($categoria->id); ?>"><?php echo e($categoria->nome); ?></a>
                    </td>                 
                    
                    <td>
                        <a href="<?php echo e(URL::to('categorias')); ?>/<?php echo e($categoria->id); ?>"><?php echo e($categoria->descricao); ?></a>
                    </td>

                    <td>
                        <a href="<?php echo e(URL::to('categorias')); ?>/<?php echo e($categoria->id); ?>"><span class="btn btn-primary btn-xs"><?php echo e($categoria->valor); ?></span></a>
                    </td> 

                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('categorias/'.$categoria->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    
                    <td>

                        <form method="POST" action="<?php echo e(action('CategoriaController@destroy', $categoria->id)); ?>" id="formDelete<?php echo e($categoria->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($categoria->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($categoria->id); ?>() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($categoria->id); ?>").submit();
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

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding col-md-6">
            <h3>Categorias | Franquias Remotas (Lic - Lojas)</h3>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr> 
                <?php $__empty_1 = true; $__currentLoopData = $categorias_remotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($categoria->id); ?></td>

                    <td>
                        <a href="<?php echo e(URL::to('categorias')); ?>/<?php echo e($categoria->id); ?>"><?php echo e($categoria->nome); ?></a>
                    </td>                 
                    
                    <td>
                        <a href="<?php echo e(URL::to('categorias')); ?>/<?php echo e($categoria->id); ?>"><?php echo e($categoria->descricao); ?></a>
                    </td>

                    <td>
                        <a href="<?php echo e(URL::to('categorias')); ?>/<?php echo e($categoria->id); ?>"><span class="btn btn-primary btn-xs"><?php echo e($categoria->valor); ?></span></a>
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