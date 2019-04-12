@can('update_fornecedor')  
	@extends('layouts.app')
	@section('title', 'Editar Fornecedor')
	@section('content')
			<h1>
		        Editar Fornecedor
		        <small>{{$fornecedor->titulo}}</small>

		        @if($fornecedor->status)
		    		<span class="btn btn-success">Ativo</span>
		    	@else
		    		<span class="btn btn-danger">Desativado</span>
		    	@endif
				    
		    </h1>
			

			<form method="POST" enctype="multipart/form-data" action="{{action('FornecedorController@update', $fornecedor->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="PATCH">						
				
			 	<div class="form-group col-md-12">
				    <label for="nome_fantasia">Nome Fantasia:</label>
				    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="{{$fornecedor->nome_fantasia}}" placeholder="Digite o Nome Fantasia..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="email">e-Mail:</label>
				    <input type="mail" class="form-control" id="email" name="email" value="{{$fornecedor->email}}" placeholder="fornecedor@gmail.com" required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="responsavel">Nome do Responsável:</label>
				    <input type="text" class="form-control" id="responsavel" name="responsavel" value="{{$fornecedor->responsavel}}" placeholder="Digite o Nome do Responsável..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="razao_social">Razão Social:</label>
				    <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{$fornecedor->razao_social}}" placeholder="Digite a razão social ou similar..." >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="cnpj">CNPJ ou Código Empresarial do País:</label>
				    <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{$fornecedor->cnpj}}" placeholder="Digite o CNPJ ou similar.." >
			 	</div>

			 	<div class="col-md-12">
			   		<label for="palavras_chave">Sites:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-4">
			    		<label for="url_site" class="text-aqua">Site:</label>
			    		<input type="text"class="form-control" id="url_site" name="url_site" value="{{$fornecedor->url_site}}" placeholder="http://...">
			    	</div>
			    	<div class="col-md-4">
			    		<label for="url_loja" class="text-aqua">Loja, e-Commerce ou Alibaba:</label>
			    		<input type="text"class="form-control" id="url_loja" name="url_loja" value="{{$fornecedor->url_loja}}" placeholder="http://...">
			    	</div>		
			    	<div class="col-md-4">
			    		<label for="url_blog" class="text-aqua">Blog:</label>
			    		<input type="text"class="form-control" id="url_blog" name="url_blog" value="{{$fornecedor->url_blog}}" placeholder="http://...">
			    	</div>		    	
				</div>

			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Contatos:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="telefone" class="text-aqua">Telefone</label>
			    		<input type="text"class="form-control" id="telefone" name="telefone" value="{{$fornecedor->telefone}}" placeholder="+55 52 3214-9635">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="skype" class="text-aqua">Skype</label>
			    		<input type="text"class="form-control" id="skype" name="skype" value="{{$fornecedor->skype}}" placeholder="Nome Utilizador">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="wechat" class="text-aqua">WeChat</label>
			    		<input type="text"class="form-control" id="wechat" name="wechat" value="{{$fornecedor->wechat}}" placeholder="Nome de utilizador">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="whatsapp" class="text-aqua">Whatsapp</label>
			    		<input type="text"class="form-control" id="whatsapp" name="whatsapp" value="{{$fornecedor->whatsapp}}" placeholder="Número">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="telegram" class="text-aqua">Telegram</label>
			    		<input type="text"class="form-control" id="telegram" name="telegram" value="{{$fornecedor->telegram}}" placeholder="Número">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="facebook" class="text-aqua">Facebook</label>
			    		<input type="text"class="form-control" id="facebook" name="facebook" value="{{$fornecedor->facebook}}" placeholder="link">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="instagram" class="text-aqua">Instagram</label>
			    		<input type="text"class="form-control" id="instagram" name="instagram" value="{{$fornecedor->instagram}}" placeholder="Link">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="twitter" class="text-aqua">Twitter</label>
			    		<input type="text"class="form-control" id="twitter" name="twitter" value="{{$fornecedor->twitter}}" placeholder="Nome de utilizador">
			    	</div>
			    	
				</div>

				<div class="col-md-12">
			   		<label for="palavras_chave">Endereço:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-6">
			    		<label for="endereco" class="text-aqua">Logradouro:</label>
			    		<input type="text"class="form-control" id="endereco" name="endereco" value="{{$fornecedor->endereco}}" placeholder="Rua, Avenida...">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_numero" class="text-aqua">Número:</label>
			    		<input type="text"class="form-control" id="endereco_numero" name="endereco_numero" value="{{$fornecedor->endereco_numero}}" placeholder="000">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_bairro" class="text-aqua">Bairro:</label>
			    		<input type="text"class="form-control" id="endereco_bairro" name="endereco_bairro" value="{{$fornecedor->endereco_bairro}}" placeholder="Bairro China">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_cidade" class="text-aqua">Cidade:</label>
			    		<input type="text"class="form-control" id="endereco_cidade" name="endereco_cidade" value="{{$fornecedor->endereco_cidade}}" placeholder="Curitiba">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_estado" class="text-aqua">Estado, Região ou Privíncia:</label>
			    		<input type="text"class="form-control" id="endereco_estado" name="endereco_estado" value="{{$fornecedor->endereco_estado}}" placeholder="Paraná">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_pais" class="text-aqua">País:</label>
			    		<input type="text"class="form-control" id="endereco_pais" name="endereco_pais" value="{{$fornecedor->endereco_pais}}" placeholder="Brasil">
			    	</div>
			    	<div class="col-md-3">
			    		<label for="endereco_cep" class="text-aqua">CEP (ZIP/Postal Code):</label>
			    		<input type="text"class="form-control" id="endereco_cep" name="endereco_cep" value="{{$fornecedor->endereco_cep}}" placeholder="10000-000">
			    	</div>		    	
			    	
				</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Breve Descrição do Fonecedor:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhes do fornecedor" required="required" name="descricao" 
		                          style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$fornecedor->descricao}}</textarea>
		              </form>
		            </div>
			 	</div>				 	

			 	<div class="col-md-12">			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Atualizar">
			 		<hr>
			 	</div>

			</form>
	@endsection
@endcan