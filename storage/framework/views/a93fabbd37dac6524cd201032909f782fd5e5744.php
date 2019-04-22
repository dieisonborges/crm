<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_orcamento')): ?>  
    
    <?php $__env->startSection('title', 'Orcamentos'); ?>
    <?php $__env->startSection('content'); ?>
    <h1>Orçamentos  <a href="<?php echo e(url('orcamento/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Criar Novo</a></h1>

        <?php if(session('status')): ?>
            <div class="alert alert-success" orcamento="alert">
                <?php echo e(session('status')); ?>

            </div> 
        <?php endif; ?>
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('orcamento/busca')); ?>">
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
                    <th>Código</th>
                    <th>Validade do Token</th>
                    <th>Criado em</th>
                    <th>Fornecedor</th>
                    <th>País</th>
                    <th>Enviar</th>
                    <th>Status</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $orcamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orcamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($orcamento->id); ?></td>
                    <td><a href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>"><?php echo e($orcamento->codigo); ?></a></td>
                    <td><a href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>"><?php echo e(date('d/m/Y', strtotime($orcamento->token_validade))); ?></a></td>
                    <td><a href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>"><?php echo e(date('d/m/Y H:i:s', strtotime($orcamento->created_at))); ?></a></td>
                    <td><a href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>"><?php echo e($orcamento->nome_fantasia); ?></a></td>
                    <td><a href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>"><?php echo e($orcamento->endereco_pais); ?></a></td>

                    <td>
                        <?php if(($orcamento->status==0)or($orcamento->status==1)): ?>

                            <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>/enviar">
                            <span class="fa fa-paper-plane"> Enviar</span>                        
                            </a>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs">Bloqueado</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($orcamento->status==0): ?>
                            <span class="btn btn-primary btn-xs">Em edição</span> 
                        <?php elseif($orcamento->status==1): ?>
                            <span class="btn btn-warning btn-xs">Bloqueado: Em cotação</span> 
                        <?php elseif($orcamento->status==2): ?>
                            <span class="btn btn-danger btn-xs">Cancelado</span> 
                        <?php else: ?>
                            <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>">
                            <span class="fa fa-eye"> Ver</span>                        
                        </a>
                    </td>
                    <td>
                        <?php if(($orcamento->status)==0): ?>
                            <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('orcamento/'.$orcamento->id.'/edit')); ?>"><i class="fa fa-edit"></i> Editar</a>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs">Bloqueado</span>
                        <?php endif; ?>
                    </td>
                    <td>

                        <?php if((($orcamento->status)==0)or(($orcamento->status)==2)): ?>

                        <form method="POST" action="<?php echo e(action('OrcamentoController@destroy', $orcamento->id)); ?>" id="formDelete<?php echo e($orcamento->id); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete<?php echo e($orcamento->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Remover</a>
                        </form> 

                        <script>
                           function confirmDelete<?php echo e($orcamento->id); ?>() {

                            var result = confirm('Tem certeza que deseja remover?');

                            if (result) {
                                    document.getElementById("formDelete<?php echo e($orcamento->id); ?>").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                        <?php else: ?>
                            <span class="btn btn-warning btn-xs">Bloqueado</span>
                        <?php endif; ?>

                    </td>
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>
                    <td><b>Nenhum Resultado.</b></td>
                </tr>
                    
                <?php endif; ?>      

                <?php echo e($orcamentos->links()); ?>      
                
            </table>
        </div>
        <!-- /.box-body -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>