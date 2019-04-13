@can('update_orcamento')  
	@extends('layouts.app')
	@section('title', 'Editar Orcamento')
	@section('content')
			<h1>
		        Editar Orcamento
		        <small>{{$orcamento->titulo}}</small> 
		    </h1>
			

			<form method="POST" enctype="multipart/form-data" action="{{action('OrcamentoController@update', $orcamento->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="PATCH">						
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <input type="date" class="form-control" id="token_validade" name="token_validade" value="{{ $orcamento->token_validade }}" placeholder="Validade do TOKEN de Orçamento" required>
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor:</label>
	                <select class="form-control select2" name="fornecedor_id">
	                		<option value="{{$fornecedor->id}}" selected="selected">{{$fornecedor->nome_fantasia}} - {{$fornecedor->responsavel}} - {{$fornecedor->email}} - {{$fornecedor->razao_social}}</option>
						@forelse ($fornecedors as $fornecedor)							
							<option value="{{$fornecedor->id}}">{{$fornecedor->nome_fantasia}} - {{$fornecedor->responsavel}} - {{$fornecedor->email}} - {{$fornecedor->razao_social}} </option>
						@empty                    
						@endforelse 
	                </select>
	                
			 	</div>			 	

			 	<div class="col-md-12">			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Atualizar">
			 		<hr>
			 	</div>

			</form>
	@endsection
@endcan