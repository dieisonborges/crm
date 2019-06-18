<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franqueado')): ?>  
    
    <?php $__env->startSection('title', 'Franquias'); ?>
    <?php $__env->startSection('content'); ?>
        <h1><i class="fa fa-building"></i> Franquias</h1>

        <a style="float: right;" href="<?php echo e(url('franqueados/convites')); ?>" class="btn btn-xs btn-primary">
            <i class="fa fa-paper-plane"></i>
            Convites
        </a>

        <?php if(session('status')): ?>
            <div class="alert alert-success" franquia="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
       
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <div class="box-header with-border">
              <h3 class="box-title">Minhas Franquias</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Abrir loja</th>
                    <th>Gerenciar</th>

                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $franquias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $franquia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($franquia->id); ?></td>
                    <td><a href="<?php echo e(URL::to('franqueados')); ?>/<?php echo e($franquia->id); ?>/dashboard"><?php echo e($franquia->codigo_franquia); ?></a></td>
                    <td><a href="<?php echo e(URL::to('franqueados')); ?>/<?php echo e($franquia->id); ?>/dashboard"><?php echo e($franquia->nome); ?></a></td>
                    <td><a href="<?php echo e(URL::to('franqueados')); ?>/<?php echo e($franquia->id); ?>/dashboard"><?php echo e(str_limit(strip_tags($franquia->descricao), $limit = 40, $end = '...')); ?></a></td>
                    
                    <td>
                        <a href="<?php echo e(URL::to('franqueados')); ?>/<?php echo e($franquia->id); ?>/dashboard">
                        <?php if($franquia->status): ?>
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                        </a>
                    </td>

                    <td> 
                        
                        <?php if($franquia->status): ?>
                            <a href="https://<?php echo e($franquia->loja_url); ?>" target="_blank">
                                <span class="btn btn-primary btn-xs"><i class="fa fa-link"></i> Principal</span>
                            </a>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                       
                                            
                        <?php if($franquia->status): ?>
                            <a href="https://<?php echo e($franquia->loja_url_alternativa); ?>.venderaqui.com.br" target="_blank">
                                <span class="btn btn-warning btn-xs"><i class="fa fa-link"></i> Alternativo</span>
                            </a>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                       
                    </td>

                    <td>
                        
                        <?php if($franquia->status): ?>
                            <a href="<?php echo e(URL::to('franqueados')); ?>/<?php echo e($franquia->id); ?>/dashboard">
                                <span class="btn btn-primary btn-xs"><i class="fas fa-wrench"></i> Gerenciar</span>
                            </a>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                        
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

        <br>
        <hr class="hr">
        <br>
    
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <div class="box-header with-border">
              <h3 class="box-title">Meus Afiliados</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <!--<th>Ver</th>-->
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $afiliados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $afiliado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($afiliado->id); ?></td>
                    <td><a href="#"><?php echo e($afiliado->codigo_franquia); ?></a></td>
                    <td><a href="#"><?php echo e($afiliado->nome); ?></a></td>
                    <td><a href="#"><?php echo e(str_limit(strip_tags($afiliado->descricao), $limit = 40, $end = '...')); ?></a></td>
                    <td>
                        <a href="#">
                        <?php if($afiliado->status): ?>
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                        </a>
                    </td>

                    <!--

                    <td>
                        <a href="<?php echo e(URL::to('franqueados')); ?>/<?php echo e($afiliado->id); ?>/dashboard">
                        <?php if($afiliado->status): ?>
                            <span class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Visualizar</span>
                        <?php else: ?>
                            <span class="btn btn-warning btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        <?php endif; ?>
                        </a>
                    </td>       

                    -->           
                    
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>
                    <td><b>Nenhum Afiliado.</b></td>
                </tr>
                    
                <?php endif; ?>      
                
            </table>
        </div>
        <!-- /.box-body -->

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>