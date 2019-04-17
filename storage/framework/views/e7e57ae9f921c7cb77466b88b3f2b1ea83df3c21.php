<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_produto')): ?>  
    
    <?php $__env->startSection('title', 'Produtos'); ?>
    <?php $__env->startSection('content'); ?>
    <h1>Produtos  <a href="<?php echo e(url('produtos/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

        <?php if(session('status')): ?>
            <div class="alert alert-success" produto="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('produtos/busca')); ?>">
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
                    <th>SKU</th>
                    <th>Título</th>
                    <th>Palavras Chave</th>
                    <th>Descrição</th>
                    <th>Imagens</th>
                    <th>Status</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                    <th>Desativar</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($produto->id); ?></td>
                    <td><a href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>"><?php echo e($produto->sku); ?></a></td>
                    <td><a href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>"><?php echo e($produto->titulo); ?></a></td>
                    <td><a href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>"><?php echo e($produto->palavras_chave); ?></a></td>
                    <td><a href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>"><?php echo e(str_limit(strip_tags($produto->descricao), $limit = 40, $end = '...')); ?></a></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>/imagem">
                            <span class="fa fa-image"> Imagens</span>                        
                        </a>
                    </td>                    

                    <td>
                        <a href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>">
                        <?php if($produto->status): ?>
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-close"></i> Desativado</span>
                        <?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($produto->id); ?>">
                            <span class="fa fa-eye"> Ver</span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('produtos/'.$produto->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="<?php echo e(action('ProdutoController@destroy', $produto->id)); ?>" id="formDelete<?php echo e($produto->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($produto->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Desativar</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($produto->id); ?>() {

                            var result = confirm('Tem certeza que deseja desativar?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($produto->id); ?>").submit();
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

                <?php echo e($produtos->links()); ?>      
                
            </table>
        </div>
        <!-- /.box-body -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>