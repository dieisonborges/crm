<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_fornecedor')): ?>  
    
    <?php $__env->startSection('title', 'Fornecedors'); ?>
    <?php $__env->startSection('content'); ?>
    <h1>Fornecedors  <a href="<?php echo e(url('fornecedor/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

        <?php if(session('status')): ?>
            <div class="alert alert-success" fornecedor="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('fornecedor/busca')); ?>">
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
                    <th>Nome Fantasia</th>
                    <th>e-Mail</th>
                    <th>Responsável</th>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>                    
                    <th>País</th>
                    <th>Status</th>
                    <th>Usuários</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $fornecedors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($fornecedor->id); ?></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e(str_limit(strip_tags($fornecedor->nome_fantasia), $limit = 25, $end = '...')); ?></a></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e(str_limit(strip_tags($fornecedor->email), $limit = 30, $end = '...')); ?></a></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e(str_limit(strip_tags($fornecedor->responsavel), $limit = 10, $end = '...')); ?></a></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e(str_limit(strip_tags($fornecedor->razao_social), $limit = 10, $end = '...')); ?></a></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e($fornecedor->cnpj); ?></a></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e($fornecedor->telefone); ?></a></td>
                    <td><a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>"><?php echo e($fornecedor->endereco_pais); ?></a></td>
                    <td>
                        <a href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>">
                        <?php if($fornecedor->status): ?>
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>/usuarios">
                            <span class="fa fa-user"></span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('fornecedor')); ?>/<?php echo e($fornecedor->id); ?>">
                            <span class="fa fa-eye"> Ver</span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('fornecedor/'.$fornecedor->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                    </td>
                    <td>

                        <form method="POST" action="<?php echo e(action('FornecedorController@destroy', $fornecedor->id)); ?>" id="formDelete<?php echo e($fornecedor->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($fornecedor->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($fornecedor->id); ?>() {

                            var result = confirm('Tem certeza que deseja Excluir?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($fornecedor->id); ?>").submit();
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

                <?php echo e($fornecedors->links()); ?>      
                
            </table>
        </div>
        <!-- /.box-body -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>