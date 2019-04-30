<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_franquia')): ?>  
	
	<?php $__env->startSection('title', $franquia->name); ?>
	<?php $__env->startSection('content'); ?>
		<h1>
	        Franquia 
	        <small><?php echo e($franquia->name); ?></small>
	        		<a href="<?php echo e($franquia->id); ?>/edit" class="btn btn-warning">Editar</a>

	    </h1>
		<div class="row">		
				
				
			 	<div class="form-group col-md-12">
				    <label for="nome">Nome:</label>
				    <input disabled="disabled" type="text" class="form-control" id="nome" name="nome" value="<?php echo e($franquia->nome); ?>" placeholder="Digite o Nome..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="slogan">Slogan:</label>
				    <input disabled="disabled" type="text" class="form-control" id="slogan" name="slogan" value="<?php echo e($franquia->slogan); ?>" placeholder="Slogan ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_site">Endereço (URL) do Site:</label>
				    <input disabled="disabled" type="text" class="form-control" id="url_site" name="url_site" value="<?php echo e($franquia->url_site); ?>" placeholder="http:// ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_blog">Endereço (URL) do Blog:</label>
				    <input disabled="disabled" type="text" class="form-control" id="url_blog" name="url_blog" value="<?php echo e($franquia->url_blog); ?>" placeholder="http:// ..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		                <textarea disabled="disabled" class="textarea" placeholder="Detalhes do franquia" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($franquia->descricao); ?></textarea>
		            </div>
			 	</div>	

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>Dados Comerciais:</h3>
				</div>

				<div class="form-group col-md-12">
				    <label for="cnpj">CNPJ:</label>
				    <input disabled="disabled" type="text" class="form-control" id="cnpj" name="cnpj" value=" <?php echo e($franquia->cnpj); ?>"placeholder="XX.XXX.XXX/YYYY-ZZ" >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="telefone">Telefone Comercial:</label>
				    <input disabled="disabled" type="text" class="form-control" id="telefone" name="telefone" value=" <?php echo e($franquia->telefone); ?>"placeholder="(00) 3000-0000" >
			 	</div>

			 	<div class="form-group col-md-12">
			 	    <label for="email">e-Mail Comercial:</label>
				    <input disabled="disabled" type="mail" class="form-control" id="email" name="email" value=" <?php echo e($franquia->email); ?>"placeholder="contato@suafranquia.com.br" >
			 	</div>

			 	<div class="form-group col-md-12">
			 		<div class="col-md-8">
				    	<label for="endereco">Endereço Comercial:</label>
				    	<input disabled="disabled" type="text" class="form-control" id="endereco" name="endereco" value=" <?php echo e($franquia->endereco); ?>"placeholder="Rua dos empreendedores...">
				    </div>
				    <div class="col-md-4">
				    	<label for="endereco_numero">Número:</label>
				    	<input disabled="disabled" type="text" class="form-control" id="endereco_numero" name="endereco_numero" value=" <?php echo e($franquia->endereco_numero); ?>"placeholder="1234">
				    </div>
			 	</div>

			 	<div class="form-group col-md-12">
				 	<div class="form-group col-md-8">
					    <label for="endereco_bairro">Bairro:</label>
					    <input disabled="disabled" type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" value=" <?php echo e($franquia->endereco_bairro); ?>"placeholder="Bairro das franquias">
				 	</div>

				 	<div class="form-group col-md-4">
					    <label for="endereco_cep">CEP:</label>
					    <input disabled="disabled" type="text" class="form-control" id="cep" name="endereco_cep" value=" <?php echo e($franquia->endereco_cep); ?>"placeholder="70000-000">
				 	</div>
			 	</div>

			 	<div class="form-group col-md-12">
			 		<div class="form-group col-md-4">
					    <label for="endereco_estado">Estado (UF):</label>
		                <select disabled="disabled" class="form-control select2" name="endereco_estado">
		                	<option selected="selected" value=""> <?php echo e($franquia->endereco_estado); ?></option>
		                							
		                </select>
				 	</div>

				 	<div class="form-group col-md-8">
					    <label for="endereco_cidade">Cidade:</label>
					    <input disabled="disabled" type="text" class="form-control" id="endereco_cidade" name="endereco_cidade" value=" <?php echo e($franquia->endereco_cidade); ?>"placeholder="São Paulo">
				 	</div>

				 	
			 	</div>

			 	

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>Loja Integrada::</h3>
				</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_url" name="loja_url" value="<?php echo e($franquia->loja_url); ?>" placeholder="http:// ...">
		    	</div>
		    	<!--
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_url" class="text-aqua">Endereço (URL) ou IP do Banco de Dados:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_database_url" name="loja_database_url" value="<?php echo e($franquia->loja_database_url); ?>" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_name" class="text-aqua">Nome do Banco de Dados:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_database_name" name="loja_database_name" value="<?php echo e($franquia->loja_database_name); ?>" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_user" class="text-aqua">Usuário do Banco de Dados:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_database_user" name="loja_database_user" value="<?php echo e($franquia->loja_database_user); ?>" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_password" class="text-aqua">Senha do Banco de Dados: <small class="text-black">Deixe vazio para não alterar a senha.</small></label>
		    		<input disabled="disabled" type="password" class="form-control" id="loja_database_password" name="loja_database_password" value="">
		    	</div>
			    -->	 	
			</form>
		</div>
		
		<a href="<?php echo e($franquia->id); ?>/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>