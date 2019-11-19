@extends('layouts.app')
@section('title', 'Nova Endereço')
@section('content')
		<h1>
	        Novo Endereço
	        <small>+</small>
	    </h1>
		

		<form method="POST" enctype="multipart/form-data" action="{{action('ClientController@enderecoStore')}}">
            @csrf

			<div class="form-group mb-12">
			    <label for="label">Título:</label>
			    <input type="text" class="form-control" id="label" name="label" value="" placeholder="Casa, Comercial ..." required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="address_1">Logradouro:</label>
			    <input type="text" class="form-control" id="address_1" name="address_1" value="" placeholder="Rua China, Nº 9856 ..." required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="address_2">Complemento:</label>
			    <input type="text" class="form-control" id="address_2" name="address_2" value="" placeholder="Bloco 5, Apt 201">
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="city">Cidade:</label>
			    <input type="text" class="form-control" id="city" name="city" value="" placeholder="São Paulo" required>
		 	</div>
		 	<div class="form-group mb-12">
			    <label for="state">Estado:</label>
			    <select class="form-control" id="state" name="state">
					<option value="AC">Acre</option>
					<option value="AL">Alagoas</option>
					<option value="AP">Amapá</option>
					<option value="AM">Amazonas</option>
					<option value="BA">Bahia</option>
					<option value="CE">Ceará</option>
					<option value="DF">Distrito Federal</option>
					<option value="ES">Espírito Santo</option>
					<option value="GO">Goiás</option>
					<option value="MA">Maranhão</option>
					<option value="MT">Mato Grosso</option>
					<option value="MS">Mato Grosso do Sul</option>
					<option value="MG">Minas Gerais</option>
					<option value="PA">Pará</option>
					<option value="PB">Paraíba</option>
					<option value="PR">Paraná</option>
					<option value="PE">Pernambuco</option>
					<option value="PI">Piauí</option>
					<option value="RJ">Rio de Janeiro</option>
					<option value="RN">Rio Grande do Norte</option>
					<option value="RS">Rio Grande do Sul</option>
					<option value="RO">Rondônia</option>
					<option value="RR">Roraima</option>
					<option value="SC">Santa Catarina</option>
					<option value="SP">São Paulo</option>
					<option value="SE">Sergipe</option>
					<option value="TO">Tocantins</option>
				</select>
		 	</div>		 	
		 	<div class="form-group mb-12">
			    <label for="postcode">CEP:</label>
			    <input type="text" class="form-control" id="postcode" name="postcode" value="" placeholder="00000-000" required>
		 	</div>
		 	

		 	<div>
		 		<hr>
		 	</div>

		 	<button type="submit" class="btn btn-primary">cadastrar</button>
		</form>
@endsection