@can('create_franquia')  
	@extends('layouts.app')
	@section('title', 'Novo Franquia')
	@section('content')
			<h1>
		        Nova
		        <small>Franquia</small>
		    </h1>
			

			<form method="POST" action="{{url('franquias')}}" id="formSubmit">
				@csrf			
				
			 	<div class="form-group col-md-12">
				    <label for="nome">Nome:</label>
				    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Digite o Nome..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="slogan">Slogan:</label>
				    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan') }}" placeholder="Slogan ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_site">Endereço (URL) do Site:</label>
				    <input type="text" class="form-control" id="url_site" name="url_site" value="{{ old('url_site') }}" placeholder="http:// ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_blog">Endereço (URL) do Blog:</label>
				    <input type="text" class="form-control" id="url_blog" name="url_blog" value="{{ old('url_blog') }}" placeholder="http:// ..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		                <textarea class="textarea" placeholder="Detalhes do franquia" required="required" name="descricao" 
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
			 	    <label for="email">e-Mail Comercial:</label>
				    <input type="mail" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="contato@suafranquia.com.br" >
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
		    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada:</label>
		    		<input type="text" class="form-control" id="loja_url" name="loja_url" value="{{ old('loja_url') }}" placeholder="http:// ...">
		    	</div>
		    	<!--
		    	Não se usa mais OpenCart no projeto
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_url" class="text-aqua">Endereço (URL) ou IP do Banco de Dados:</label>
		    		<input type="text" class="form-control" id="loja_database_url" name="loja_database_url" value="{{ old('loja_database_url') }}" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_name" class="text-aqua">Nome do Banco de Dados:</label>
		    		<input type="text" class="form-control" id="loja_database_name" name="loja_database_name" value="{{ old('loja_database_name') }}" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_user" class="text-aqua">Usuário do Banco de Dados:</label>
		    		<input type="text" class="form-control" id="loja_database_user" name="loja_database_user" value="{{ old('loja_database_user') }}" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_password" class="text-aqua">Senha do Banco de Dados:</label>
		    		<input type="password" class="form-control" id="loja_database_password" name="loja_database_password" value="">
		    	</div>
		   		-->		    	

		    	<hr class="hr">

		    	<div class="form-group col-md-12">
		    		<br><br>
			   		<h3>Dono e Afiliado:</h3>
				</div>

		    	<div class="form-group col-md-12">
		    		<br><br>
				    <label for="user_id_dono">Dono da Franquia:</label>
	                <select class="form-control select2" name="user_id_dono">
	                	<option value="0">Nenhum - Nenhum  Dono.</option>
						@forelse ($users as $user)
							<option value="{{$user->id}}">{{$user->name}} - {{$user->email}} </option>
						@empty                    
						@endforelse 
	                </select>
	                
			 	</div>

			 	<hr class="hr">

		    	<div class="form-group col-md-12">
		    		<br><br>
				    <label for="user_id_afiliado">Líder da Franquia (Afiliado):</label>
	                <select class="form-control select2" name="user_id_afiliado">
	                	<option value="0">Nenhum - Nenhum Líder.</option>
						@forelse ($users as $user)
							<option value="{{$user->id}}">{{$user->name}} - {{$user->email}} </option>
						@empty                    
						@endforelse 
	                </select>
			 	</div>				 	
			    		 	

			 	<div class="col-md-12">

			 		<br><br>
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Cadastrar">
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan