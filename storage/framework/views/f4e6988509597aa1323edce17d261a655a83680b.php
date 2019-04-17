<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_fornecedor')): ?>  
	
	<?php $__env->startSection('title', 'Novo Fornecedor'); ?>
	<?php $__env->startSection('content'); ?>
			<h1>
		        Novo
		        <small>Fornecedor</small>
		    </h1>
			

			<form method="POST" action="<?php echo e(url('fornecedor')); ?>" id="formSubmit">
				<?php echo csrf_field(); ?>			
				
			 	<div class="form-group col-md-12">
				    <label for="nome_fantasia">Nome Fantasia:</label>
				    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="<?php echo e(old('nome_fantasia')); ?>" placeholder="Digite o Nome Fantasia..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="email">e-Mail:</label>
				    <input type="mail" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="fornecedor@gmail.com" required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="responsavel">Nome do Responsável:</label>
				    <input type="text" class="form-control" id="responsavel" name="responsavel" value="<?php echo e(old('responsavel')); ?>" placeholder="Digite o Nome do Responsável..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="razao_social">Razão Social:</label>
				    <input type="text" class="form-control" id="razao_social" name="razao_social" value="<?php echo e(old('razao_social')); ?>" placeholder="Digite a razão social ou similar..." >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="cnpj">CNPJ ou Código Empresarial do País:</label>
				    <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo e(old('cnpj')); ?>" placeholder="Digite o CNPJ ou similar.." >
			 	</div>

			 	<div class="col-md-12">
			   		<label for="palavras_chave">Sites:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-4">
			    		<label for="url_site" class="text-aqua">Site:</label>
			    		<input type="text"class="form-control" id="url_site" name="url_site" value="<?php echo e(old('url_site')); ?>" placeholder="http://...">
			    	</div>
			    	<div class="col-md-4">
			    		<label for="url_loja" class="text-aqua">Loja, e-Commerce ou Alibaba:</label>
			    		<input type="text"class="form-control" id="url_loja" name="url_loja" value="<?php echo e(old('url_loja')); ?>" placeholder="http://...">
			    	</div>		
			    	<div class="col-md-4">
			    		<label for="url_blog" class="text-aqua">Blog:</label>
			    		<input type="text"class="form-control" id="url_blog" name="url_blog" value="<?php echo e(old('url_blog')); ?>" placeholder="http://...">
			    	</div>		    	
				</div>

			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Contatos:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="telefone" class="text-aqua">Telefone</label>
			    		<input type="text"class="form-control" id="telefone" name="telefone" value="<?php echo e(old('telefone')); ?>" placeholder="+55 52 3214-9635">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="skype" class="text-aqua">Skype</label>
			    		<input type="text"class="form-control" id="skype" name="skype" value="<?php echo e(old('skype')); ?>" placeholder="Nome Utilizador">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="wechat" class="text-aqua">WeChat</label>
			    		<input type="text"class="form-control" id="wechat" name="wechat" value="<?php echo e(old('wechat')); ?>" placeholder="Nome de utilizador">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="whatsapp" class="text-aqua">Whatsapp</label>
			    		<input type="text"class="form-control" id="whatsapp" name="whatsapp" value="<?php echo e(old('whatsapp')); ?>" placeholder="Número">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="telegram" class="text-aqua">Telegram</label>
			    		<input type="text"class="form-control" id="telegram" name="telegram" value="<?php echo e(old('telegram')); ?>" placeholder="Número">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="facebook" class="text-aqua">Facebook</label>
			    		<input type="text"class="form-control" id="facebook" name="facebook" value="<?php echo e(old('facebook')); ?>" placeholder="link">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="instagram" class="text-aqua">Instagram</label>
			    		<input type="text"class="form-control" id="instagram" name="instagram" value="<?php echo e(old('instagram')); ?>" placeholder="Link">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="twitter" class="text-aqua">Twitter</label>
			    		<input type="text"class="form-control" id="twitter" name="twitter" value="<?php echo e(old('twitter')); ?>" placeholder="Nome de utilizador">
			    	</div>
			    	
				</div>

				<div class="col-md-12">
			   		<label for="palavras_chave">Endereço:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-6">
			    		<label for="endereco" class="text-aqua">Logradouro:</label>
			    		<input type="text"class="form-control" id="endereco" name="endereco" value="<?php echo e(old('endereco')); ?>" placeholder="Rua, Avenida...">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_numero" class="text-aqua">Número:</label>
			    		<input type="text"class="form-control" id="endereco_numero" name="endereco_numero" value="<?php echo e(old('endereco_numero')); ?>" placeholder="000">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_bairro" class="text-aqua">Bairro:</label>
			    		<input type="text"class="form-control" id="endereco_bairro" name="endereco_bairro" value="<?php echo e(old('endereco_bairro')); ?>" placeholder="Bairro China">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_cidade" class="text-aqua">Cidade:</label>
			    		<input type="text"class="form-control" id="endereco_cidade" name="endereco_cidade" value="<?php echo e(old('endereco_cidade')); ?>" placeholder="Curitiba">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_estado" class="text-aqua">Estado, Região ou Privíncia:</label>
			    		<input type="text"class="form-control" id="endereco_estado" name="endereco_estado" value="<?php echo e(old('endereco_estado')); ?>" placeholder="Paraná">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_pais" class="text-aqua">País:</label>
			    		<input type="text"class="form-control" id="endereco_pais" name="endereco_pais" value="<?php echo e(old('endereco_pais')); ?>" placeholder="Brasil">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_cep" class="text-aqua">CEP (ZIP/Postal Code):</label>
			    		<input type="text"class="form-control" id="endereco_cep" name="endereco_cep" value="<?php echo e(old('endereco_cep')); ?>" placeholder="10000-000">
			    	</div>		    	
			    	
				</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Breve Descrição do Fonecedor:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhes do fornecedor" required="required" name="descricao" 
		                          style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e(old('descricao')); ?></textarea>
		              </form>
		            </div>
			 	</div>	

			 	<div class="col-md-12">

			 	</div>		 	

			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Cadastrar">
			 		<hr>

			 	</div>
			</form>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>