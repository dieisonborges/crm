@can('create_orcamento')  
	@extends('layouts.app')
	@section('title', 'Novo Item')
	@section('content')
			<h1>
		        Novos Itens em Lotes
		        <small>Orçamento: <b>{{$orcamento->codigo}}</b></small> 
		    </h1>
			

			<form method="POST" action="{{url('orcamento/itemLoteStore')}}" id="formSubmit">
				@csrf	

				<input type="hidden" name="orcamento_id" value="{{$orcamento->id}}">

				<div class="form-group col-md-12">
			        <label>Produtos:</label>
			        <select name="produto_id[]" class="form-control select2" data-placeholder="Selecione um produto" multiple="multiple" style="width: 100%;" required="required">
			                @forelse ($produtos as $produto)
			                    <option value="{{$produto->id}}">
			                        {{$produto->titulo}} | {{$produto->sku}} | {{$produto->palavras_chave}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        </select>
			    </div>

			    <div class="form-group col-md-12">		
				
				 	<div class="form-group col-md-2">
					    <label for="quantidade">Quantidade:</label>
					    <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ old('quantidade') }}" placeholder="Quantidade" required>
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="unidade_medida">Unidade de Medida:</label>

					    <select name="unidade_medida" class="form-control select2" data-placeholder="Selecione uma unidade de medida"
			                style="width: 100%;" required="required">
			                	<option value="{{ old('unidade_medida') }}">{{ old('unidade_medida') }}</option>
			                @forelse ($unidades_medidas as $unidade_medida)
			                    <option value="{{$unidade_medida}}">
			                        {{$unidade_medida}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        	</select>
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="preco">Preço:</label>
					    <input disabled="disabled" type="number" step="0.01" class="form-control" id="preco" name="preco" value="{{ old('preco') }}" placeholder="Preço" >
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="frete_preco">Preço do Frete:</label>
					    <input disabled="disabled" type="number" step="0.01" class="form-control" id="frete_preco" name="frete_preco" value="{{ old('frete_preco') }}" placeholder="Preço do Frete" >
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="frete_tipo">Tipo de Frete:</label>
					    <input disabled="disabled" type="text" class="form-control" id="frete_tipo" name="frete_tipo" value="{{ old('frete_tipo') }}" placeholder="DHL, Aéreo, Terrestre, Marítimo ..." >
				 	</div>

				 	<div class="form-group col-md-2">
					    <label for="moeda">Moeda:</label>

					    <select disabled="disabled" name="moeda" class="form-control select2" data-placeholder="Selecione uma unidade de medida"
			                style="width: 100%;">
			                	<option value="{{ old('moeda') }}">{{ old('moeda') }}</option>
			                @forelse ($moedas as $moeda)
			                    <option value="{{$moeda}}">
			                        {{$moeda}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        	</select>
				 	</div>

			 	</div>		 	

		    			 	


			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Adicionar Item">
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan