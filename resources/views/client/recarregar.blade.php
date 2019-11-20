	@extends('layouts.app')
	@section('title', 'Nova Recarrega')
	@section('content')
			<h1>
		        Recarregar 
		        <small>Conta</small>
		    </h1>			

			<form method="POST" action="{{url('clients/recarregarStore')}}">
				@csrf			
				<div class="form-group mb-12">

					<div class="col-md-12">

						<a href="javascript: $('#recarga').val('100');" class="col-md-2" id="cedula-100">
							<img src="{{ asset('img/real-cedulas/cedula-100.jpg') }}" width="100%" id="cedula-100" style="margin-top: 5px;">						
						</a>

						<a href="javascript: $('#recarga').val('50');" class="col-md-2" id="cedula-50">
							<img src="{{ asset('img/real-cedulas/cedula-50.png') }}" width="100%" style="margin-top: 5px;">						
						</a>

						<a href="javascript: $('#recarga').val('20');" class="col-md-2" id="cedula-20">
							<img src="{{ asset('img/real-cedulas/cedula-20.jpg') }}" width="100%" style="margin-top: 5px;">						
						</a>

						<a href="javascript: $('#recarga').val('10');" class="col-md-2" id="cedula-10">
							<img src="{{ asset('img/real-cedulas/cedula-10.jpg') }}" width="100%" style="margin-top: 5px;">						
						</a>	

						<div class="col-md-4">
							<label for="recarga">Valor R$ (BRL):</label>

				    		<input type="number"  min="10"  step="0.01" class="form-control" id="recarga" name="recarga" value="" placeholder="Digite o valor da recarga" required>

				    		<button style="margin-top: 10px;" type="submit" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Recarregar</button>
						</div>					

					</div>

				    <br>

				    <label class="btn btn-sm">¹Valor mínimo R$ 10.00</label>
				    <label class="btn btn-sm">²Taxa Boleto R$ 3,90</label>
				    <label class="btn btn-sm">³Taxa da plataforma 3%</label>
				    <label class="btn btn-sm">Você receberá por e-mail as informações para pagamento.</label>

				    <p></p>
				    
				    
			 	</div>		 	

			 	<div>
			 		<hr>
			 	</div>

			 	

			 	
			</form>

	@endsection