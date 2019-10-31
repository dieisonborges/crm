@can('read_cambio') 
	@extends('layouts.app')
	@section('title', 'Nova Recarrega')
	@section('content')
			<h1>
		        Novo VET 
		        <small>Valor Efetivo Total</small>
		    </h1>			

			<form method="POST" action="{{url('cambio/vetStore')}}">
				@csrf			
				<div class="form-group mb-12">

					<div class="col-md-12">

						<div class="col-md-12">
							<label class="btn btn-primary">Câmbio Atual: <b>@moneyBRL($cambio_atual)</b></label>

							<label class="btn btn-primary">VET Atual: <b>@moneyBRL($cambio_atual*$vet_atual)</b></label>	
							<br><br>
						</div>

						<div class="col-md-4">

							<label for="descricao">Comentário:</label>

				    		<input type="text" class="form-control" id="descricao" name="descricao" value="" placeholder="Digite um comentário">

				    		<br>

							<label for="vet">Valor em %:</label>

				    		<input type="number"  step="0.01" class="form-control" id="vet" name="vet" value="" placeholder="Digite o valor do VET" required>

				    		<label class="btn">Valor em %, será multiplicado no valor da cotação</label>

				    		<button style="margin-top: 10px;" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
						</div>					

					</div>

				    <br>

				    				    
				    
			 	</div>		 	

			 	<div>
			 		<hr>
			 	</div>

			 	

			 	
			</form>

	@endsection
@endcan