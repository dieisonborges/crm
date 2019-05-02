<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franquia')): ?>  
    
    <?php $__env->startSection('title', 'Franquias'); ?>
    <?php $__env->startSection('content'); ?>
    <h1>Franquias  <a href="<?php echo e(url('franquias/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Nova Franquia</a></h1>

        <?php if(session('status')): ?>
            <div class="alert alert-success" franquia="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('franquias/busca')); ?>">
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
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Slogan</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Dono(s)</th>
                    <th>Ativar<br>Desativar</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $franquias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $franquia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($franquia->id); ?></td>
                    <td><a href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>"><?php echo e($franquia->codigo_franquia); ?></a></td>
                    <td><a href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>"><?php echo e($franquia->nome); ?></a></td>
                    <td><a href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>"><?php echo e(str_limit(strip_tags($franquia->slogan), $limit = 40, $end = '...')); ?></a></td>
                    <td><a href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>"><?php echo e(str_limit(strip_tags($franquia->descricao), $limit = 40, $end = '...')); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>">
                        <?php if($franquia->status): ?>
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        <?php else: ?>
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>/donos">
                            <span class="fa fa-users"> Dono(s)</span>                        
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo e(URL::to('franquias')); ?>/<?php echo e($franquia->id); ?>">
                        <?php if($franquia->status): ?>
                            <a href="<?php echo e(URL::to('franquias/disable/'.$franquia->id)); ?>" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativar</a>
                        <?php else: ?>
                             <a href="<?php echo e(URL::to('franquias/enable/'.$franquia->id)); ?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativar</a>
                        <?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('franquias/'.$franquia->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="<?php echo e(action('FranquiaController@destroy', $franquia->id)); ?>" id="formDelete<?php echo e($franquia->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($franquia->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($franquia->id); ?>() {

                            var result = confirm('Tem certeza que deseja desativar?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($franquia->id); ?>").submit();
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

                <?php echo e($franquias->links()); ?>      
                
            </table>
        </div>
        <!-- /.box-body -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>