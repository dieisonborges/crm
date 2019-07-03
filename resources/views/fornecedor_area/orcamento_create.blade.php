@can('create_orcamento')  
	@extends('layouts.app')
	@section('title', 'Novo Orcamento')
	@section('content')
			<h1>
		        Novo
		        <small>Orcamento</small> 
		    </h1>
		    <h1>
		        New
		        <small>Budget</small>
		    </h1>
			

			<form method="POST" action="{{url('fornecedorArea/orcamentoStore')}}" id="formSubmit">
				@csrf			
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Orçamento / Validity of the Budget:</label>
				    <input type="date" class="form-control" id="token_validade" name="token_validade" value="{{ date('d-m-Y', strtotime('+5 days')) }}" placeholder="Validade do Orçamento / Validity of the Budget" required>
			 	</div>	

			 	<input type="hidden" name="fornecedor_id" value="{{$fornecedor->id}}">	

			 	<div class="col-md-12">
			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Criar Orçamento / Create Budget">
			 		<hr>

			 	</div>
			</form>
	@endsection
@endcan