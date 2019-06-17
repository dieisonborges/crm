<?php $__env->startSection('title', 'Franqueados VIP'); ?>
<?php $__env->startSection('content'); ?>
<h1><i class="fa fa-certificate text-blue"></i>
    Franqueados VIP    
 <a href="<?php echo e(url('franqueadoVip/create')); ?>" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Adicionar Novo Franquado VIP</a></h1>

    <?php if(session('status')): ?>
        <div class="alert alert-success" score="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="col-md-12">	

        <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('franqueadoVip/busca')); ?>">
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
        <h3 class="box-title">Franqueados VIP: <b><?php echo e(count($franqueado_vips)); ?></b></h3>


        
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Apelido</th>
                <th>Nome</th>                
                <th>e-mail</th>
                <th>CPF</th>
                <th>Convites</th>
                <th>Líder</th>
                <th>Destituir</th>
            </tr>
            <?php $__empty_1 = true; $__currentLoopData = $franqueado_vips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $franqueado_vip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($franqueado_vip->id); ?>/"><?php echo e($franqueado_vip->id); ?></a></td>
                <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($franqueado_vip->id); ?>"><?php echo e($franqueado_vip->apelido); ?></a></td>
                <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($franqueado_vip->id); ?>"><?php echo e($franqueado_vip->name); ?></a></td>
                <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($franqueado_vip->id); ?>"><?php echo e($franqueado_vip->email); ?></a></td>
                <td><a href="<?php echo e(URL::to('users')); ?>/<?php echo e($franqueado_vip->id); ?>"><?php echo e($franqueado_vip->cpf); ?></a></td>
                <td>
                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('user/'.$franqueado_vip->id.'/convites')); ?>"> 

                        <i class="fa fa-edit"></i> |  

                        <?php echo e($franqueado_vip->qtd_convites); ?></a>
                </td>
                <td>
                    <a href="<?php echo e(URL::to('users')); ?>/<?php echo e($franqueado_vip->id); ?>">
                    <?php if(($franqueado_vip->lider)==0): ?>
                        <span class="btn btn-primary btn-xs">VIP</span>
                    <?php else: ?>
                        <span class="btn btn-danger btn-xs"><i class="fa fa-rocket"></i> LÍDER VIP</span>
                    <?php endif; ?>
                    </a>
                </td>
                <td>

                    <form method="POST" action="<?php echo e(action('FranqueadoVipController@destroy', $franqueado_vip->vip_id)); ?>" id="formDelete<?php echo e($franqueado_vip->vip_id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">

                        <a href="javascript:confirmDelete<?php echo e($franqueado_vip->vip_id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Destituir</a>
                    </form> 

                    <script>
                       function confirmDelete<?php echo e($franqueado_vip->vip_id); ?>() {

                        var result = confirm('Tem certeza que deseja destituir?');

                        if (result) {
                                document.getElementById("formDelete<?php echo e($franqueado_vip->vip_id); ?>").submit();
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
    <?php echo e($franqueado_vips->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>