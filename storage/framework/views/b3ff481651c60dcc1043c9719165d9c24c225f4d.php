<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_user')): ?>  
	
	<?php $__env->startSection('title', 'Editar Usuário'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Editar Usuário
		        <small><?php echo e($user->nome); ?></small>
		    </h1>
			

			<form method="POST" enctype="multipart/form-data" action="<?php echo e(action('UserController@update',$id)); ?>">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="_method" value="PATCH">
				<div class="form-group mb-12">
				    <label for="name">Nome</label>
				    <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>" placeholder="Digite o nome completo..." required>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="apelido">Apelido (Como quer ser chamado)</label>
				    <input type="text" class="form-control" id="apelido" name="apelido" value="<?php echo e($user->apelido); ?>" placeholder="Digite o Cargo, Posto, Graduação ou Formação..." required>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="email">E-mail</label>
				    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>" placeholder="Digite o E-mail..." required>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="cpf">Cpf</label>
				    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo e($user->cpf); ?>" placeholder="Digite o CPF..." required>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="phone_number">Celular com DDD</label>
				    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo e($user->phone_number); ?>" placeholder="Digite o Celular..." required>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="status">Status (1 - Ativo | 0 - Inativo)</label>
				    <input type="hidden" name="status" value="<?php echo e($user->status); ?>" required>
				    <input type="number" class="form-control" id="status_visible" name="status_visible" value="<?php echo e($user->status); ?>" placeholder="Digite o status..." disabled="disabled" required>
				    <?php if($user->status): ?>
	                    <span class="label label-success">ATIVO</span>                        
	                <?php else: ?>
	                    <span class="label label-danger">INATIVO</span>
	                <?php endif; ?>
			 	</div>
			 	<div class="form-group mb-12">
				    <label for="login">Login (Maior que 15 BLOQUEADO)</label>
				    <input type="number" class="form-control" id="login" name="login" value="<?php echo e($user->login); ?>" placeholder="Digite o login..." required>
				    <?php if(($user->login)<=15): ?>
	                    <span class="label label-success">LIBERADO</span>
	                <?php else: ?>
	                    <span class="label label-danger">BLOQUEADO</span>
	                <?php endif; ?>
			 	</div>
			 	

			 	<div>
			 		<hr>
			 	</div>

			 	<button type="submit" class="btn btn-primary">Atualizar</button>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>