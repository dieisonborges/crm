<?php $__env->startSection('content'); ?>
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">

    <a href="/">
        <b style="display:none;">e-Cardume</b>
        <img src="<?php echo e(asset('img/logo/logo-7p-cardume-transp.png')); ?>" width="50%" style=" margin-left: 25%;">
    </a>

    <hr>

    <?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <p class="login-box-msg"><?php echo e(__('Login')); ?></p>

     <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label text-md-right"><?php echo e(__('E-Mail')); ?></label>

            <div class="col-md-9">
                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-3 col-form-label text-md-right"><?php echo e(__('Senha')); ?></label>

            <div class="col-md-9">
                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember">
                        <?php echo e(__('Lembrar-me')); ?>

                    </label>
                </div>
            </div>
            <div style="width: 100%; height: 50px; display: block;"></div>
            <div class="col-md-12 offset-md-4">
                <button type="submit" class="btn btn-primary col-md-12">
                    <?php echo e(__('Login')); ?>

                </button>

                <div style="width: 100%; height: 50px; display: block;"></div>   

                <a class="btn btn-link col-md-6" href="<?php echo e(route('password.request')); ?>">
                    <?php echo e(__('Esqueceu sua senha?')); ?>

                </a>

                <a class="btn btn-link col-md-6" href="<?php echo e(route('register')); ?>">
                    <?php echo e(__('Cadastre-se')); ?>

                </a>
            </div>

        </div>
    </form>    


   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>