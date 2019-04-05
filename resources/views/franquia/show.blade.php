@can('read_franquia')  
	@extends('layouts.app')
	@section('title', $franquia->name)
	@section('content')
		<h1>
	        Franquia 
	        <small>{{$franquia->name}}</small>
	        		<a href="{{$franquia->id}}/edit" class="btn btn-warning">Editar</a>

	    </h1>
		<div class="row">		
				
				
			 	<div class="form-group col-md-12">
				    <label for="nome">Nome:</label>
				    <input disabled="disabled" type="text" class="form-control" id="nome" name="nome" value="{{ $franquia->nome }}" placeholder="Digite o Nome..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="slogan">Slogan:</label>
				    <input disabled="disabled" type="text" class="form-control" id="slogan" name="slogan" value="{{ $franquia->slogan }}" placeholder="Slogan ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_site">Endereço (URL) do Site:</label>
				    <input disabled="disabled" type="text" class="form-control" id="url_site" name="url_site" value="{{ $franquia->url_site }}" placeholder="http:// ..." required>
			 	</div>
			 	<div class="form-group col-md-12">
				    <label for="url_blog">Endereço (URL) do Blog:</label>
				    <input disabled="disabled" type="text" class="form-control" id="url_blog" name="url_blog" value="{{ $franquia->url_blog }}" placeholder="http:// ..." required>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		                <textarea disabled="disabled" class="textarea" placeholder="Detalhes do franquia" required="required" name="descricao" 
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $franquia->descricao }}</textarea>
		            </div>
			 	</div>	

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>OpenCart:</h3>
				</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_url" name="loja_url" value="{{ $franquia->loja_url }}" placeholder="http:// ...">
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_url" class="text-aqua">Endereço (URL) ou IP do Banco de Dados:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_database_url" name="loja_database_url" value="{{ $franquia->loja_database_url }}" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_name" class="text-aqua">Nome do Banco de Dados:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_database_name" name="loja_database_name" value="{{ $franquia->loja_database_name }}" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_user" class="text-aqua">Usuário do Banco de Dados:</label>
		    		<input disabled="disabled" type="text" class="form-control" id="loja_database_user" name="loja_database_user" value="{{ $franquia->loja_database_user }}" >
		    	</div>
		    	<div class="form-group col-md-12">
		    		<label for="loja_database_password" class="text-aqua">Senha do Banco de Dados: <small class="text-black">Deixe vazio para não alterar a senha.</small></label>
		    		<input disabled="disabled" type="password" class="form-control" id="loja_database_password" name="loja_database_password" value="">
		    	</div>
			    		 	
			</form>
		</div>
		
		<a href="{{$franquia->id}}/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan