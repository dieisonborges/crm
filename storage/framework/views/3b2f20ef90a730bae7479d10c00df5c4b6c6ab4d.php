<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_fornecedor')): ?>  
	
	<?php $__env->startSection('title', $fornecedor->name); ?>
	<?php $__env->startSection('content'); ?>
		<h1>
	        Fornecedor 
	        <small><?php echo e($fornecedor->name); ?></small>



	        <?php if($fornecedor->status): ?>
	    		<span class="btn btn-success">Ativo</span>
	    	<?php else: ?>
	    		<span class="btn btn-danger">Desativado</span>
	    	<?php endif; ?>


	    </h1> 
		<div class="row">	

			<input disabled="disabled" type="hidden" name="_method" value="PATCH">						
				
			 	<div class="form-group col-md-12">
				    <label for="nome_fantasia">Nome Fantasia:</label>
				    <input disabled="disabled" type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="<?php echo e($fornecedor->nome_fantasia); ?>" placeholder="Digite o Nome Fantasia..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="email">e-Mail:</label>
				    <input disabled="disabled" type="mail" class="form-control" id="email" name="email" value="<?php echo e($fornecedor->email); ?>" placeholder="fornecedor@gmail.com" required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="responsavel">Nome do Responsável:</label>
				    <input disabled="disabled" type="text" class="form-control" id="responsavel" name="responsavel" value="<?php echo e($fornecedor->responsavel); ?>" placeholder="Digite o Nome do Responsável..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="razao_social">Razão Social:</label>
				    <input disabled="disabled" type="text" class="form-control" id="razao_social" name="razao_social" value="<?php echo e($fornecedor->razao_social); ?>" placeholder="Digite a razão social ou similar..." >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="cnpj">CNPJ ou Código Empresarial do País:</label>
				    <input disabled="disabled" type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo e($fornecedor->cnpj); ?>" placeholder="Digite o CNPJ ou similar.." >
			 	</div>

			 	<div class="col-md-12">
			   		<label for="palavras_chave">Sites:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-4">
			    		<label for="url_site" class="text-aqua">Site:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="url_site" name="url_site" value="<?php echo e($fornecedor->url_site); ?>" placeholder="http://...">
			    	</div>
			    	<div class="col-md-4">
			    		<label for="url_loja" class="text-aqua">Loja, e-Commerce ou Alibaba:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="url_loja" name="url_loja" value="<?php echo e($fornecedor->url_loja); ?>" placeholder="http://...">
			    	</div>		
			    	<div class="col-md-4">
			    		<label for="url_blog" class="text-aqua">Blog:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="url_blog" name="url_blog" value="<?php echo e($fornecedor->url_blog); ?>" placeholder="http://...">
			    	</div>		    	
				</div>

			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Contatos:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="telefone" class="text-aqua">Telefone</label>
			    		<input disabled="disabled" type="text"class="form-control" id="telefone" name="telefone" value="<?php echo e($fornecedor->telefone); ?>" placeholder="+55 52 3214-9635">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="skype" class="text-aqua">Skype</label>
			    		<input disabled="disabled" type="text"class="form-control" id="skype" name="skype" value="<?php echo e($fornecedor->skype); ?>" placeholder="Nome Utilizador">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="wechat" class="text-aqua">WeChat</label>
			    		<input disabled="disabled" type="text"class="form-control" id="wechat" name="wechat" value="<?php echo e($fornecedor->wechat); ?>" placeholder="Nome de utilizador">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="whatsapp" class="text-aqua">Whatsapp</label>
			    		<input disabled="disabled" type="text"class="form-control" id="whatsapp" name="whatsapp" value="<?php echo e($fornecedor->whatsapp); ?>" placeholder="Número">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="telegram" class="text-aqua">Telegram</label>
			    		<input disabled="disabled" type="text"class="form-control" id="telegram" name="telegram" value="<?php echo e($fornecedor->telegram); ?>" placeholder="Número">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="facebook" class="text-aqua">Facebook</label>
			    		<input disabled="disabled" type="text"class="form-control" id="facebook" name="facebook" value="<?php echo e($fornecedor->facebook); ?>" placeholder="link">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="instagram" class="text-aqua">Instagram</label>
			    		<input disabled="disabled" type="text"class="form-control" id="instagram" name="instagram" value="<?php echo e($fornecedor->instagram); ?>" placeholder="Link">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="twitter" class="text-aqua">Twitter</label>
			    		<input disabled="disabled" type="text"class="form-control" id="twitter" name="twitter" value="<?php echo e($fornecedor->twitter); ?>" placeholder="Nome de utilizador">
			    	</div>
			    	
				</div>

				<div class="col-md-12">
			   		<label for="palavras_chave">Endereço:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-6">
			    		<label for="endereco" class="text-aqua">Logradouro:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco" name="endereco" value="<?php echo e($fornecedor->endereco); ?>" placeholder="Rua, Avenida...">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_numero" class="text-aqua">Número:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco_numero" name="endereco_numero" value="<?php echo e($fornecedor->endereco_numero); ?>" placeholder="000">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_bairro" class="text-aqua">Bairro:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco_bairro" name="endereco_bairro" value="<?php echo e($fornecedor->endereco_bairro); ?>" placeholder="Bairro China">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_cidade" class="text-aqua">Cidade:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco_cidade" name="endereco_cidade" value="<?php echo e($fornecedor->endereco_cidade); ?>" placeholder="Curitiba">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_estado" class="text-aqua">Estado, Região ou Privíncia:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco_estado" name="endereco_estado" value="<?php echo e($fornecedor->endereco_estado); ?>" placeholder="Paraná">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_pais" class="text-aqua">País:</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco_pais" name="endereco_pais" value="<?php echo e($fornecedor->endereco_pais); ?>" placeholder="Brasil">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_cep" class="text-aqua">CEP (ZIP/Postal Code):</label>
			    		<input disabled="disabled" type="text"class="form-control" id="endereco_cep" name="endereco_cep" value="<?php echo e($fornecedor->endereco_cep); ?>" placeholder="10000-000">
			    	</div>		    	
			    	
				</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Breve Descrição do Fonecedor:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea disabled="disabled" class="textarea" placeholder="Detalhes do fornecedor" required="required" name="descricao" 
		                          style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($fornecedor->descricao); ?></textarea>
		              </form>
		            </div>
			 	</div>		
				
			 		
		</div>
		
		<a href="<?php echo e($fornecedor->id); ?>/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>