@can('update_franquia')  
	@extends('layouts.app')
	@section('title', 'Editar Franquia')
	@section('content')
			<h1>
		        Editar Franquia
		        <small>{{$franquia->titulo}}</small>
		    </h1>
			
			<form method="POST" action="{{action('FranquiaController@update',$franquia->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="PATCH">	

				<div class="box box-info col-md-12">
				  <div class="box-header with-border">
				    <h3 class="box-title">Informações Básicas da Loja</h3>
				    <div class="box-tools pull-right">
				      <!-- Buttons, labels, and many other things can be placed here! -->
				      <!-- Here is a label for example -->
				      <span class="label label-info">Básicas</span>
				    </div>
				    <!-- /.box-tools -->
				  </div>
				  <!-- /.box-header -->
				  <div class="box-body">
				    <div class="form-group col-md-6">
					    <label for="nome">Nome: <small class="text-red">*Obrigatório</small></label>
					    <input type="text" class="form-control" id="nome" name="nome" value="{{ $franquia->nome }}" placeholder="Digite o Nome..." required>
				 	</div>
				 	<div class="form-group col-md-6">
					    <label for="slogan">Slogan: <small class="text-red">*Obrigatório</small></label>
					    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $franquia->slogan }}" placeholder="Slogan ..." required>
				 	</div>
				 	<div class="form-group col-md-6">
					    <label for="url_site">Endereço (URL) do Site:</label>
					    <input type="text" class="form-control" id="url_site" name="url_site" value="{{ $franquia->url_site }}" placeholder="http:// ..." >
					    <small>*link de seu <b>site</b> pessoal ou da empresa.</small>
				 	</div>
				 	<div class="form-group col-md-6">
					    <label for="url_blog">Endereço (URL) do Blog:</label>
					    <input type="text" class="form-control" id="url_blog" name="url_blog" value="{{ $franquia->url_blog }}" placeholder="http:// ..." >
					    <small>*link de seu <b>blog</b> pessoal ou da empresa.</small>
				 	</div>
				 	<div class="form-group col-md-12">
					    <label for="descricao">Descrição:  <small class="text-red">*Obrigatório</small></label>				    
						<!-- /.box-header -->
			            <div class="box-body pad">
			                <textarea class="textarea" placeholder="Detalhes do franquia" required="required" name="descricao" 
			                          style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $franquia->descricao }}</textarea>
			            </div>
			            <small>*breve <b>descrição</b> da loja.</small>
				 	</div>
				  </div>
				  <!-- /.box-body -->
				  
				</div>
				<!-- /.box -->	
				

				<div class="box box-primary col-md-12">
				  <div class="box-header with-border">
				    <h3 class="box-title">Informações Comerciais</h3>
				    <div class="box-tools pull-right">
				      <!-- Buttons, labels, and many other things can be placed here! -->
				      <!-- Here is a label for example -->
				      <span class="label label-primary">Comerciais</span>
				    </div>
				    <!-- /.box-tools -->
				  </div>
				  <!-- /.box-header -->
				  <div class="box-body">
				    	<div class="form-group col-md-6">
						    <label for="cnpj">CNPJ:</label>
						    <input type="text" class="form-control" id="cnpj" name="cnpj" value=" {{ $franquia->cnpj }}"placeholder="XX.XXX.XXX/YYYY-ZZ" >
					 	</div>

					 	<div class="form-group col-md-6">
						    <label for="telefone">Telefone Comercial:</label>
						    <input type="text" class="form-control" id="telefone" name="telefone" value=" {{ $franquia->telefone }}"placeholder="(00) 3000-0000" >
					 	</div>

					 	<div class="form-group col-md-6">
					 	    <label for="email">e-Mail Comercial:</label>
						    <input type="mail" class="form-control" id="email" name="email" value=" {{ $franquia->email }}"placeholder="contato@suafranquia.com.br" >
					 	</div>

					 	
				 		<div class="col-md-8">
					    	<label for="endereco">Endereço Comercial:</label>
					    	<input type="text" class="form-control" id="endereco" name="endereco" value=" {{ $franquia->endereco }}"placeholder="Rua dos empreendedores...">
					    </div>
					    <div class="col-md-4">
					    	<label for="endereco_numero">Número:</label>
					    	<input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value=" {{ $franquia->endereco_numero }}"placeholder="1234">
					    </div>
					 				 	

					 	
					 	<div class="form-group col-md-8">
						    <label for="endereco_bairro">Bairro:</label>
						    <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" value=" {{ $franquia->endereco_bairro }}"placeholder="Bairro das franquias">
					 	</div>

					 	<div class="form-group col-md-4">
						    <label for="endereco_cep">CEP:</label>
						    <input type="text" class="form-control" id="cep" name="endereco_cep" value=" {{ $franquia->endereco_cep }}"placeholder="70000-000">
					 	</div>
					 	

					 			 		
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
				  <!-- /.box-body -->
				  
				</div>
				<!-- /.box -->

				<div class="box box-danger col-md-12">
				  <div class="box-header with-border">
				    <h3 class="box-title">Loja Integrada</h3>
				    <div class="box-tools pull-right">
				      <!-- Buttons, labels, and many other things can be placed here! -->
				      <!-- Here is a label for example -->
				      <span class="label label-danger">Wordpress</span>
				    </div>
				    <!-- /.box-tools -->
				  </div>
				  <!-- /.box-header -->
				  <div class="box-body">
				    <div class="form-group col-md-6">
			    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada:</label>
			    		<input type="text" class="form-control" id="loja_url" name="loja_url" value="{{ $franquia->loja_url }}" placeholder="loja.com.br">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="loja_url_alternativa" class="text-aqua">Endereço Alternativo (URL) da loja integrada:</label>
			    		<input type="text" class="form-control" id="loja_url_alternativa" name="loja_url_alternativa" value="{{ $franquia->loja_url_alternativa }}" placeholder="loja">
			    		<span style="color: red; font-size: 12px;">*a url alternativa ficará assim: https://loja.venderaqui.com.br</span>
			    	</div>

			    	<div class="box-header with-border col-md-12">
					    <h3 class="box-title"><small>Wordpress</small></h3>
					    <!-- /.box-tools -->
					 </div>

			    	<div class="form-group col-md-6">
			    		<label for="WP_HOME" class="text-aqua">WP_HOME:</label>
			    		<input type="text" class="form-control" id="WP_HOME" name="WP_HOME" value="{{ $franquia->WP_HOME }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="WP_SITEURL" class="text-aqua">WP_SITEURL:</label>
			    		<input type="text" class="form-control" id="WP_SITEURL" name="WP_SITEURL" value="{{ $franquia->WP_SITEURL }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="DB_NAME" class="text-aqua">DB_NAME:</label>
			    		<input type="text" class="form-control" id="DB_NAME" name="DB_NAME" value="{{ $franquia->DB_NAME }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="DB_USER" class="text-aqua">DB_USER:</label>
			    		<input type="text" class="form-control" id="DB_USER" name="DB_USER" value="{{ $franquia->DB_USER }}" placeholder="">
			    	</div>			    	

			    	<div class="form-group col-md-6">
			    		<label for="DB_HOST" class="text-aqua">DB_HOST:</label>
			    		<input type="text" class="form-control" id="DB_HOST" name="DB_HOST" value="{{ $franquia->DB_HOST }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="DB_CHARSET" class="text-aqua">DB_CHARSET:</label>
			    		<input type="text" class="form-control" id="DB_CHARSET" name="DB_CHARSET" value="{{ $franquia->DB_CHARSET }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="DB_COLLATE" class="text-aqua">DB_COLLATE:</label>
			    		<input type="text" class="form-control" id="DB_COLLATE" name="DB_COLLATE" value="{{ $franquia->DB_COLLATE }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-6">
			    		<label for="DB_PASSWORD" class="text-aqua">DB_PASSWORD:</label>
			    		<input type="password" class="form-control" id="DB_PASSWORD" name="DB_PASSWORD" value="" placeholder="************">
			    		<small>*Deixe em branco para não alterar a senha</small>
			    	</div>

			    	<div class="box-header with-border col-md-12">
					    <h3 class="box-title"><small>API Woocommerce</small></h3>
					    <!-- /.box-tools -->
					 </div>

			    	<div class="form-group col-md-12">
			    		<label for="store_url" class="text-aqua">Store Url:</label>
			    		<input type="text" class="form-control" id="store_url" name="store_url" value="{{ $franquia->store_url }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-12">
			    		<label for="consumer_key" class="text-aqua">Consumer Key:</label>
			    		<input type="text" class="form-control" id="consumer_key" name="consumer_key" value="{{ $franquia->consumer_key }}" placeholder="">
			    	</div>

			    	<div class="form-group col-md-12">
			    		<label for="consumer_secret" class="text-aqua">Consumer Secret:</label>
			    		<input type="password" class="form-control" id="consumer_secret" name="consumer_secret" value="" placeholder="******************************">
			    		<small>*Deixe em branco para não alterar a consumer_secret</small>
			    	</div>

				  </div>
				  <!-- /.box-body -->
				  
				</div>
				<!-- /.box -->

				<div class="box box-warning col-md-12">
				  <div class="box-header with-border">
				    <h3 class="box-title">Gestão de Afiliados</h3>
				    <div class="box-tools pull-right">
				      <!-- Buttons, labels, and many other things can be placed here! -->
				      <!-- Here is a label for example -->
				      <span class="label label-warning">Líder</span>
				    </div>
				    <!-- /.box-tools -->

				    <div class="box-body">

					    <div class="form-group col-md-6">
						    <label for="user_id_afiliado">Líder da Franquia:</label>
			                <select class="form-control select2" name="user_id_afiliado">
			                	@if(!($franquia->user_id_afiliado))
			                		<option selected="selected" value="">Nenhum - Nenhum Líder Afiliado.</option>	
			                	@endif
								@forelse ($users as $user)
									

									@if(($franquia->user_id_afiliado)==($user->id))
									 	<option selected="selected" value="{{$user->id}}">{{$user->name}} - {{$user->email}} </option>
									@else
										<option value="{{$user->id}}">{{$user->name}} - {{$user->email}} </option>
									@endif

									

								@empty                    
								@endforelse 
			                </select>
					 	</div>

					  </div>
					  <!-- /.box-header -->
				  
				  </div>
				  <!-- /.box-body -->
				  
				</div>
				<!-- /.box -->
			 	
		    	
			    		 	

			 	<div class="col-md-6">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Atualizar">
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan