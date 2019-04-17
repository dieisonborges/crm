<?php $__env->startSection('title', 'Convites'); ?>
<?php $__env->startSection('content'); ?>
<h1>Convites Cadastrados  <a href="<?php echo e(url('convites/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Novo</a></h1>

    <?php if(session('status')): ?>
        <div class="alert alert-success" convite="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('convites/busca')); ?>">
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
        <h3 class="box-title">Convites Cadastrados</h3>
        
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>e-mail</th>
                <th>Código</th> 
                <th>Gerado em:</th>
                <th>Expira em:</th>   
                <th>Usado:</th>                
                <th>Excluir</th>
            </tr>
            <?php $__empty_1 = true; $__currentLoopData = $convites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $convite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($convite->id); ?></td>
                <td><a href="<?php echo e(URL::to('convites')); ?>/<?php echo e($convite->id); ?>"><?php echo e($convite->email); ?></a></td>
                <td><a href="<?php echo e(URL::to('convites')); ?>/<?php echo e($convite->id); ?>"><?php echo e($convite->codigo); ?></a></td>
                <td>
                <a href="<?php echo e(URL::to('convites')); ?>/<?php echo e($convite->id); ?>">
                    <?php echo e(date('d/m/Y H:i:s', strtotime($convite->created_at))); ?>

                </a></td>
                <td><a href="<?php echo e(URL::to('convites')); ?>/<?php echo e($convite->id); ?>">
                    <?php echo e(date('d/m/Y H:i:s', strtotime('+2 days', strtotime($convite->created_at)))); ?>

                    </a></td>
                <td>
                        <?php if($convite->status): ?>
                            <a class='btn btn-danger' href="<?php echo e(URL::to('convites')); ?>/<?php echo e($convite->id); ?>/updateStatus/0">NÃO</a>
                        <?php else: ?>
                            <a class='btn btn-success' href="<?php echo e(URL::to('convites')); ?>/<?php echo e($convite->id); ?>/updateStatus/1">SIM</a>
                        <?php endif; ?>
                </td>               
                <td>

                    <form method="POST" action="<?php echo e(action('ConviteController@destroy', $convite->id)); ?>" id="formDelete<?php echo e($convite->id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                        <!--<input type="submit" name="Excluir">-->

                        <a href="javascript:confirmDelete<?php echo e($convite->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDelete<?php echo e($convite->id); ?>() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDelete<?php echo e($convite->id); ?>").submit();
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

            <?php echo e($convites->links()); ?>      
            
        </table>
    </div>
    <!-- /.box-body -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>