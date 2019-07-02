               <?php if($message = Session::get('danger')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-window-close"></i> Alerta!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?> 

                <?php if($message = Session::get('info')): ?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Informação!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?> 

                <?php if($message = Session::get('warning')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-exclamation-circle"></i> Atenção!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?> 

                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check-circle"></i> Sucesso!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>                               

                <?php if($message = Session::get('status')): ?>                 
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info-circle"></i> Informação!</h4>
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>                 

                <?php if($message = Session::get('permission_error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Atenção: <?php echo e($message); ?></h4>
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