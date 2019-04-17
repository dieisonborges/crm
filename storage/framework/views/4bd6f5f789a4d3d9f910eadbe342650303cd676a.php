 

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1><?php echo e(__('Cadastre-se')); ?></h1></div>

                <div class="card-body">
                    <form method="POST" name="register" action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="codigo" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Código do Convite')); ?></label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control<?php echo e($errors->has('codigo') ? ' is-invalid' : ''); ?>" name="codigo" placeholder="ABCXY45YX" value="<?php echo e(old('codigo')); ?>" required autofocus>

                                <?php if($errors->has('codigo')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('codigo')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nome Completo')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" placeholder="Seu Nome Completo" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apelido" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Apelido')); ?></label>

                            <div class="col-md-6">
                                <input id="apelido" type="text" class="form-control<?php echo e($errors->has('apelido') ? ' is-invalid' : ''); ?>" name="apelido" placeholder="Como você gostaria de ser chamado" value="<?php echo e(old('apelido')); ?>" required autofocus>

                                <?php if($errors->has('apelido')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('apelido')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" placeholder="email@email.com"  value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right"><?php echo e(__('País')); ?></label>

                            <div class="col-md-6">                                

                                <select  style="width:150;font-size:11px" name="country"  class="form-control" required="">
                                    <option value="BR" selected>Brasil</option>
                                    <option value="EUA">EUA</option>
                                    <option value="CN">China</option>
                                    <option value="PY">Paraguai</option>
                                    <option value="ZA">África do Sul</option>
                                    <option value="DE">Alemanha</option>
                                </select>

                                <?php if($errors->has('country')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('country')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right"><?php echo e(__('CPF (Somente Brasileiros)')); ?></label>

                            <div class="col-md-6">
                                <input id="cpf" type="text" class="form-control<?php echo e($errors->has('cpf') ? ' is-invalid' : ''); ?>" name="cpf" placeholder="012.012.012-01" value="<?php echo e(old('cpf')); ?>">

                                <?php if($errors->has('cpf')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('cpf')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Telefone Móvel')); ?></label>

                            <div class="col-md-2">
                                Código do País:
                                <input id="phone_number_country" type="text" class="form-control<?php echo e($errors->has('phone_number_country') ? ' is-invalid' : ''); ?>" name="phone_number_country" placeholder="+55" value="<?php echo e(old('phone_number_country')); ?>" required style="width: 65%;">

                                <?php if($errors->has('phone_number_country')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone_number_country')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                               Número com DDD: <input id="phone_number" type="text" class="form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" name="phone_number" placeholder="21 99123-4560" value="<?php echo e(old('phone_number')); ?>" required style="width: 65%;">

                                <?php if($errors->has('phone_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Senha')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirmar Senha')); ?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Cadastrar-se')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.nologin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>