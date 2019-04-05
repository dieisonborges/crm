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
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('descricao') }}</textarea>
		            </div>
			 	</div>	

			 	<hr class="hr">
			 	
		 		<div class="form-group col-md-12">
			   		<h3>OpenCart:</h3>
				</div>

		    	<div class="form-group col-md-12">
		    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja:</label>
		    		<input type="text" class="form-control" id="loja_url" name="loja_url" value="{{ old('loja_url') }}" placeholder="http:// ...">
		    	</div>
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

		    	<hr class="hr">

		    	<div class="form-group col-md-12">
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
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Cadastrar">
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan