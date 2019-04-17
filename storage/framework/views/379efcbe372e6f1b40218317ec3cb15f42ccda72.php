                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-hand-spock-o"></i> Sucesso!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>               

                <?php if($message = Session::get('status')): ?>                 
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-hand-spock-o"></i> Sucesso!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>

                 <?php if($message = Session::get('danger')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-bane"></i> Erro!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>

                <?php if($message = Session::get('permission_error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Erro: <?php echo e($message); ?></h4>
                        O seu usuário não tem autorização para acessar essa área.
                    </div>
                <?php endif; ?>

                <?php if(count($errors)>0): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                