@can('update_franqueado')  
	@extends('layouts.app')
	@section('title', 'Editar Franquia')
	@section('content')
			<h1>
		        <i class="fa fa-tools"></i> Editar Franquia
		        <small>{{$franquia->nome}}</small>
		    </h1>
			
			<form method="POST" action="{{action('FranqueadoController@configuracoesUpdate',$franquia->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="POST">				
				
			 	<div class="form-group col-md-12">
				    <label for="nome">Nome:</label>
				    <input type="text" class="form-control" id="nome" name="nome" value="{{ $franquia->nome }}" placeholder="Digite o Nome..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="slogan">Slogan:</label>
				    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $franquia->slogan }}" placeholder="Slogan ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_site">Endereço (URL) do Site:</label>
				    <input type="text" class="form-control" id="url_site" name="url_site" value="{{ $franquia->url_site }}" placeholder="http:// ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_blog">Endereço (URL) do Blog:</label>
				    <input type="text" class="form-control" id="url_blog" name="url_blog" value="{{ $franquia->url_blog }}" placeholder="http:// ..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		                <textarea class="textarea" placeholder="Detalhes do franquia" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $franquia->descricao }}</textarea>
		            </div>
			 	</div>	

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>Dados Comerciais:</h3>
				</div>

				<div class="form-group col-md-12">
				    <label for="cnpj">CNPJ:</label>
				    <input type="text" class="form-control" id="cnpj" name="cnpj" value=" {{ $franquia->cnpj }}"placeholder="XX.XXX.XXX/YYYY-ZZ" >
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="telefone">Telefone Comercial:</label>
				    <input type="text" class="form-control" id="telefone" name="telefone" value=" {{ $franquia->telefone }}"placeholder="(00) 3000-0000" >
			 	</div>

			 	<div class="form-group col-md-12">
			 	    <label for="email">e-Mail Comercial:</label>
				    <input type="mail" class="form-control" id="email" name="email" value=" {{ $franquia->email }}"placeholder="contato@suafranquia.com.br" >
			 	</div>

			 	<div class="form-group col-md-12">
			 		<div class="col-md-8">
				    	<label for="endereco">Endereço Comercial:</label>
				    	<input type="text" class="form-control" id="endereco" name="endereco" value=" {{ $franquia->endereco }}"placeholder="Rua dos empreendedores...">
				    </div>
				    <div class="col-md-4">
				    	<label for="endereco_numero">Número:</label>
				    	<input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value=" {{ $franquia->endereco_numero }}"placeholder="1234">
				    </div>
			 	</div>			 	

			 	<div class="form-group col-md-12">
				 	<div class="form-group col-md-8">
					    <label for="endereco_bairro">Bairro:</label>
					    <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" value=" {{ $franquia->endereco_bairro }}"placeholder="Bairro das franquias">
				 	</div>

				 	<div class="form-group col-md-4">
					    <label for="endereco_cep">CEP:</label>
					    <input type="text" class="form-control" id="cep" name="endereco_cep" value=" {{ $franquia->endereco_cep }}"placeholder="70000-000">
				 	</div>
			 	</div>

			 	<div class="form-group col-md-12">			 		
				 	<div class="form-group col-md-4">
					    <label for="endereco_estado">Estado (UF):</label>
		                <select class="form-control select2" name="endereco_estado">
		                	<option selected="selected" value="">Nenhum Estado</option>
		                	<option selected="selected" value="{{ $franquia->endereco_estado }}"> {{ $franquia->endereco_estado }}</option>
		                	{!!html_entity_decode($select_estados_brasil)!!}						
		                </select>
				 	</div>

				 	<div class="form-group col-md-8">
					    <label for="endereco_cidade">Cidade:</label>
					    <input type="text" class="form-control" id="endereco_cidade" name="endereco_cidade" value=" {{ $franquia->endereco_cidade }}"placeholder="São Paulo">
				 	</div>

				 	
			 	</div>

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>Loja Integrada:</h3>
				</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_url" name="loja_url" value="{{ $franquia->loja_url }}" placeholder="http:// ...">
		    	</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url" class="text-aqua">Margem de lucro automática (em porcentagem %):</label>
		    		<input type="number" step=".2" class="form-control" id="lucro" name="lucro" value="{{ $franquia->lucro }}">
		    	</div>
		    			 	

			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Salvar">

			 		<a href="javascript:history.go(-1)" class="btn btn-success"><i class="fa fa-undo"></i> Voltar</a>
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan