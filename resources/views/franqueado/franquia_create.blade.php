@can('create_franqueado')  
	@extends('layouts.app')
	@section('title', 'Novo Franquia')
	@section('content')
			<h1>
		        Nova
		        <small>Franquia</small>
		    </h1>
			

			<form method="POST" action="{{url('franqueados/franquiaStore')}}" id="formSubmit">
				@csrf		

				<input type="hidden" name="convite_id" value="{{$convite->id}}">	
				
			 	<div class="form-group col-md-12">
				    <label for="nome">Nome: <i class="text-red fa fa-exclamation-circle"></i> </label>
				    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Digite o Nome..." required="required">
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="slogan">Slogan:  <i class="text-red fa fa-exclamation-circle"></i> </label>
				    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan') }}" placeholder="Slogan ..." >
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_site">Endereço (URL) do Site:</label>
				    <input type="text" class="form-control" id="url_site" name="url_site" value="{{ old('url_site') }}" placeholder="http:// ..." >
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_blog">Endereço (URL) do Blog:</label>
				    <input type="text" class="form-control" id="url_blog" name="url_blog" value="{{ old('url_blog') }}" placeholder="http:// ..." >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição: <i class="text-red fa fa-exclamation-circle"></i> </label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		                <textarea class="textarea" placeholder="Detalhes do franquia" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('descricao') }}</textarea>
		            </div>
			 	</div>
			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>Dados Comerciais:</h3>
				</div>

				<div class="form-group col-md-12">
				    <label for="cnpj">CNPJ:</label>
				    <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" placeholder="XX.XXX.XXX/YYYY-ZZ" >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="telefone">Telefone Comercial:</label>
				    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}" placeholder="(00) 3000-0000" >
			 	</div>

			 	<div class="form-group col-md-12">
			 	    <label for="email">e-Mail Comercial: <i class="text-red fa fa-exclamation-circle"></i> </label>
				    <input type="mail" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="contato@suafranquia.com.br" required="required">
			 	</div>

			 	<div class="form-group col-md-12">
			 		<div class="col-md-8">
				    	<label for="endereco">Endereço Comercial:</label>
				    	<input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}" placeholder="Rua dos empreendedores...">
				    </div>
				    <div class="col-md-4">
				    	<label for="endereco_numero">Número:</label>
				    	<input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value="{{ old('endereco_numero') }}" placeholder="1234">
				    </div>
			 	</div>

			 	<div class="form-group col-md-12">
				 	<div class="form-group col-md-8">
					    <label for="endereco_bairro">Bairro:</label>
					    <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" value="{{ old('endereco_bairro') }}" placeholder="Bairro das franquias">
				 	</div>

				 	<div class="form-group col-md-4">
					    <label for="endereco_cep">CEP:</label>
					    <input type="text" class="form-control" id="cep" name="endereco_cep" value="{{ old('endereco_cep') }}" placeholder="70000-000">
				 	</div>
			 	</div>

			 	<div class="form-group col-md-12">
			 		<div class="form-group col-md-4">
					    <label for="endereco_estado">Estado (UF):</label>
		                <select class="form-control select2" name="endereco_estado">
		                	<option selected="selected" value="">Nenhum Estado</option>
		                	{!!html_entity_decode($select_estados_brasil)!!}						
		                </select>
				 	</div>

				 	<div class="form-group col-md-8">
					    <label for="endereco_cidade">Cidade:</label>
					    <input type="text" class="form-control" id="endereco_cidade" name="endereco_cidade" value="{{ old('endereco_cidade') }}" placeholder="São Paulo">
				 	</div>				 	
			 	</div>			 	

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>Loja Integrada:</h3>
				</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada: <i class="text-red fa fa-exclamation-circle"></i> </label>
		    		<input type="text" class="form-control" id="loja_url" name="loja_url" value="{{ old('loja_url') }}" placeholder="loja.com.br" required="required">
		    	</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url_alternativa" class="text-aqua">Endereço Alternativo (URL) da loja integrada: <i class="text-red fa fa-exclamation-circle"></i> </label>
		    		<input type="text" class="form-control" id="loja_url_alternativa" name="loja_url_alternativa" value="{{ old('loja_url_alternativa') }}" placeholder="loja" required="required">
		    		<span style="color: red; font-size: 12px;">*a url alternativa ficará assim: https://loja.venderaqui.com.br</span>
		    	</div>		    	 	
			    		 	

			 	<div class="col-md-12">

			 		<br><br>
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Cadastrar">
			 		<hr>

			 	</div>


			 	<div>
			 		<i class="text-red fa fa-exclamation-circle"></i> <small>Campos Obrigatórios.</small>
			 	</div>
			</form>
	@endsection
@endcan