@can('create_orcamento')  
	@extends('layouts.app')
	@section('title', 'Novo Orcamento')
	@section('content')
			<h1>
		        Novo
		        <small>Orcamento</small> 
		    </h1>
			

			<form method="POST" action="{{url('orcamento')}}" id="formSubmit">
				@csrf			
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <input type="date" class="form-control" id="token_validade" name="token_validade" value="{{ date('d-m-Y', strtotime('+5 days')) }}" placeholder="Validade do TOKEN de Orçamento" required>
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor:</label>
	                <select class="form-control select2" name="fornecedor_id">
	                		<option value="" selected="selected">Selecione um fornecedor</option>
						@forelse ($fornecedors as $fornecedor)							
							<option value="{{$fornecedor->id}}">{{$fornecedor->nome_fantasia}} - {{$fornecedor->responsavel}} - {{$fornecedor->email}} - {{$fornecedor->razao_social}} </option>
						@empty                    
						@endforelse 
	                </select>
	                
			 	</div>			 	


			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Criar Orçamento">
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan