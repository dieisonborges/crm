<?php $__env->startSection('title', 'Conquistas'); ?>
<?php $__env->startSection('content'); ?>

<h1>
    Conquista dos usuários
    <small>Adicionar ou Remover</small>
</h1>




<form method="POST" action="<?php echo e(action('ConquistaController@userUpdate')); ?>" class="form-group col-md-12">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="conquista_id" value="<?php echo e($conquista->id); ?>">

    <div class="form-group col-md-6">
        <label>Adicionar Usuário:</label>
        <select name="user_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários"
                style="width: 100%;" required="required">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <option value="<?php echo e($user->id); ?>">
                        <?php echo e($user->apelido); ?> | <?php echo e($user->name); ?> | <?php echo e($user->email); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <option>Nenhuma Opção</option>     
                <?php endif; ?>
                      
        </select>

    </div>
    <div class="form-group col-md-3">
        <label>À Conquista:</label>

        <span class="form-control"><?php echo e($conquista->titulo); ?> | <small><?php echo e($conquista->descricao); ?></small></span>
    </div>
    <div class="form-group col-md-3" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>

<br><br><br>

<div class="form-group col-md-12">
	<div class="container-medalha">	    		
		<img src="<?php echo e(url('img/conquistas/'.$conquista->imagem_medalha)); ?>" width="100%"  alt="<?php echo e($conquista->imagem_medalha); ?>" class="imagem-medalha-ajuste">
		<i class="<?php echo e($conquista->icone_medalha); ?> icone-medalha-ajuste"></i>
		<span class="imagem-texto"><b><?php echo e($conquista->titulo); ?></b> <br> <?php echo e($conquista->descricao); ?></span>
	</div>
</div>


<br><br><br>

    <?php if(session('status')): ?>
        <div class="alert alert-success" conquista="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Usuários que possuem esta conquista:</h3>        
    </div>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding  col-md-12">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Apelido</th>
                <th>Nome</th>
                <th>e-mail</th>
                <th>cpf</th>
                <th>Excluir</th>
            </tr>


            <?php $__empty_1 = true; $__currentLoopData = $conquista_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->apelido); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->cpf); ?></td>                
                <td>

                    <form method="POST" action="<?php echo e(action('ConquistaController@userDestroy')); ?>" id="formDeleteP<?php echo e($user->id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="conquista_id" value="<?php echo e($conquista->id); ?>">
                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                        <!--<input type="submit" name="Excluir">-->

                        <a href="javascript:confirmDeleteP<?php echo e($user->id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDeleteP<?php echo e($user->id); ?>() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDeleteP<?php echo e($user->id); ?>").submit();
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
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>