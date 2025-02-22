 
	@extends('layouts.app') 
	@section('title', 'Novo Ticket')
	@section('content')
			<h1>
		        Novo Ticket
		        <small>+</small>
		    </h1>
			

			<form method="POST" action="{{url('clients')}}" enctype="multipart/form-data" id="form-create">
				@csrf

			 	<div class="form-group col-md-12">
				    <label for="titulo">Título (Descrição Resumida) <span style="color: red; font-size: 10px;">*80 caract.</span></label>
				    <input type="text" class="form-control" placeholder="Descrição resumida do problema" name="titulo" value="{{ old('titulo') }}" onkeyup="limite_textarea(this.value)" id="texto">
				    <div style="font-size: 10px; color: #AA0000; float: right;">
				    	*<span id="cont">80</span> Restantes <br>
				    </div>
			 	</div>

			 	<script type="text/javascript">
					
				function limite_textarea(valor) {
				    quant = 80;
				    total = valor.length;
				    if(total <= quant) {
				        resto = quant - total;
				        document.getElementById('cont').innerHTML = resto;
				    } else {
				        document.getElementById('texto').value = valor.substr(0,quant);
				    }
				}
				</script>

	            <!-- /.form-group -->

	            <div class="form-group col-md-6">
	                <label>Setor</label>
	                <select name="setor[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais setores para atendimento"
	                        style="width: 100%;" required="required">
		                  	@forelse ($setores as $setor)
		                        <option value="{{$setor->id}}">
		                            {{$setor->name}} | {{$setor->label}}
		                        </option>
		                    @empty
	                        	<option>Nenhuma Opção</option>     
	                    	@endforelse
		                  
	                </select>
	            </div>
	            <!-- /.form-group -->

	            <div class="form-group col-md-6">
				    <label for="categoria_id">Categoria</label>
	                <select class="form-control select2" name="categoria_id">
	                	<option value="0">Nenhum - Nenhum categoria.</option>
						@forelse ($categorias as $categoria)
							<option value="{{$categoria->id}}">{{$categoria->nome}} - {{str_limit($categoria->descricao,30)}} </option>
						@empty                    
						@endforelse 
	                </select>
			 	</div>	

			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" placeholder="Detalhe seu o problema ou solicitação" required="required" name="descricao" 
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('descricao') }}</textarea>
		              </form>
		            </div>
			 	</div>

			 	

			 	<div class="col-md-12">
			 		
			 		<!--<button type="submit" class="btn btn-primary" onclick="document.getElementById('formSubmit').submit();">Cadastrar</button>-->
			 		
			 		<input type="submit" form="form-create" class="btn btn-primary" value="Cadastrar">
			 		<hr>
			 	</div>

			 	
			</form>
	@endsection
