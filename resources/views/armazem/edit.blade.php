@can('update_armazem')   
	@extends('layouts.app')
	@section('title', 'Editar Armazem')
	@section('content')
			<h1>
				<i class="fa fa-warehouse"></i> 
		        Modificar Armazém
		        <small>Integrado via Woocommerce</small>
		    </h1>			

			<form method="POST" enctype="multipart/form-data" action="{{action('ArmazemController@update',$armazem->id)}}">
				@csrf

				<input type="hidden" name="_method" value="PATCH">
				<div class="form-group mb-12">
				    <label for="nome">Nome</label>
				    <input type="text" class="form-control" id="nome" name="nome" value="{{$armazem->nome}}" placeholder="Digite o Nome..." required>
			 	</div>

			 	<div class="form-group mb-12">
				    <label for="localizacao">Localização:</label>
				    <input type="text" class="form-control" id="localizacao" name="localizacao" placeholder="Digite a localização..." value="{{$armazem->localizacao}}" required>
			 	</div>

			 	<div class="form-group mb-12">
				    <label for="store_url">Store Url (WP API):</label>
				    <input type="text" class="form-control" id="store_url" name="store_url" placeholder="Digite o store_url do Woocommerce..." value="{{$armazem->store_url}}" required>
			 	</div>

			 	<div class="form-group mb-12">
				    <label for="consumer_key">Consumer Key (WP API):</label>
				    <input type="text" class="form-control" id="consumer_key" name="consumer_key" placeholder="Digite o consumer_key do Woocommerce..." value="{{$armazem->consumer_key}}" required>
			 	</div>

			 	<div class="form-group mb-12">
				    <label for="consumer_secret">Consumer Secret (WP API):</label>
				    <input type="text" class="form-control" id="consumer_secret" name="consumer_secret" placeholder="Digite o consumer_secret do Woocommerce..." value="{{$armazem->consumer_secret}}" required>
			 	</div>		 	

			 	<button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Atualizar</button>

			</form>
	@endsection
@endcan