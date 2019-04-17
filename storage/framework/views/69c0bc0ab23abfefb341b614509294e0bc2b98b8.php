<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1><?php echo e(__('Reiniciar Senha')); ?></h1></div>
                <br><br>
                
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.email')); ?>" aria-label="<?php echo e(__('Reset Password')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-right"><?php echo e(__('E-Mail:')); ?></label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Enviar o Link de Redefinição de Senha')); ?>

                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.nologin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>