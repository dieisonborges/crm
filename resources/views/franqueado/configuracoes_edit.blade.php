@can('update_franqueado')  
	@extends('layouts.app')
	@section('title', 'Editar Loja')
	@section('content')
	<h1>
        <i class="fa fa-tools"></i> Editar Loja
        <small>{{$franquia->nome}}</small>
    </h1>

    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Informações da Loja</a></li>
              <li><a href="#tab_2" data-toggle="tab">Dados Comerciais</a></li>
              <li><a href="#tab_3" data-toggle="tab">Configurações da Loja Integrada</a></li>
              <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-image"></i> Logomarca</a></li>
            </ul>
            <form method="POST" action="{{action('FranqueadoController@configuracoesUpdate',$franquia->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="POST">
	            <div class="tab-content">
					<div class="tab-pane active" id="tab_1">

						<h3>Informações da Loja:</h3>

						<div class="form-group col-md-12">
						    <label for="nome">Nome:</label>
						    <input type="text" class="form-control" id="nome" name="nome" value="{{ $franquia->nome }}" placeholder="Digite o Nome..." required>
					 	</div>
					 	<div class="form-group col-md-12">
						    <label for="slogan">Slogan:</label>
						    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $franquia->slogan }}" placeholder="Slogan ..." required>
					 	</div>
					 	<div class="form-group col-md-12">
						    <label for="url_site">Endereço (URL) do Site:</label>
						    <input type="text" class="form-control" id="url_site" name="url_site" value="{{ $franquia->url_site }}" placeholder="http:// ..." required>
					 	</div>
					 	<div class="form-group col-md-12">
						    <label for="url_blog">Endereço (URL) do Blog:</label>
						    <input type="text" class="form-control" id="url_blog" name="url_blog" value="{{ $franquia->url_blog }}" placeholder="http:// ..." required>
					 	</div>

					 	<div class="form-group col-md-12">
						    <label for="descricao">Descrição:</label>				    
							<!-- /.box-header -->
					        <div class="box-body pad">
					            <textarea class="textarea" placeholder="Detalhes do franquia" required="required" name="descricao" 
					                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $franquia->descricao }}</textarea>
					        </div>
					 	</div>
					    	
					</div>
					<!-- /.tab-pane -->
	              	<div class="tab-pane" id="tab_2">
					   	<h3>Dados Comerciais:</h3>

					    <div class="form-group col-md-12">
						    <label for="cnpj">CNPJ:</label>
						    <input type="text" class="form-control" id="cnpj" name="cnpj" value=" {{ $franquia->cnpj }}"placeholder="XX.XXX.XXX/YYYY-ZZ" >
					 	</div>

					 	<div class="form-group col-md-12">
						    <label for="telefone">Telefone Comercial:</label>
						    <input type="text" class="form-control" id="telefone" name="telefone" value=" {{ $franquia->telefone }}"placeholder="(00) 3000-0000" >
					 	</div>

					 	<div class="form-group col-md-12">
					 	    <label for="email">e-Mail Comercial:</label>
						    <input type="mail" class="form-control" id="email" name="email" value=" {{ $franquia->email }}"placeholder="contato@suafranquia.com.br" >
					 	</div>

					 	<div class="form-group col-md-12">
					 		<div class="col-md-8">
						    	<label for="endereco">Endereço Comercial:</label>
						    	<input type="text" class="form-control" id="endereco" name="endereco" value=" {{ $franquia->endereco }}"placeholder="Rua dos empreendedores...">
						    </div>
						    <div class="col-md-4">
						    	<label for="endereco_numero">Número:</label>
						    	<input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value=" {{ $franquia->endereco_numero }}"placeholder="1234">
						    </div>
					 	</div>			 	

					 	<div class="form-group col-md-12">
						 	<div class="form-group col-md-8">
							    <label for="endereco_bairro">Bairro:</label>
							    <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" value=" {{ $franquia->endereco_bairro }}"placeholder="Bairro das franquias">
						 	</div>

						 	<div class="form-group col-md-4">
							    <label for="endereco_cep">CEP:</label>
							    <input type="text" class="form-control" id="cep" name="endereco_cep" value=" {{ $franquia->endereco_cep }}"placeholder="70000-000">
						 	</div>
					 	</div>

					 	<div class="form-group col-md-12">			 		
						 	<div class="form-group col-md-4">
							    <label for="endereco_estado">Estado (UF):</label>
				                <select class="form-control select2" name="endereco_estado" style="width: 100%; float: left;">
				                	<option selected="selected" value="">Nenhum Estado</option>
				                	<option selected="selected" value="{{ $franquia->endereco_estado }}"> {{ $franquia->endereco_estado }}</option>
				                	{!!html_entity_decode($select_estados_brasil)!!}						
				                </select>
						 	</div>

						 	<div class="form-group col-md-8">
							    <label for="endereco_cidade">Cidade:</label>
							    <input type="text" class="form-control" id="endereco_cidade" name="endereco_cidade" value=" {{ $franquia->endereco_cidade }}"placeholder="São Paulo">
						 	</div>	
						</div>		                

							 	
	              	</div>
	              	<!-- /.tab-pane -->
	              	<div class="tab-pane" id="tab_3">

	              		<h3>Configurações da Loja Integrada:</h3>

			    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada:</label>
			    		<span  class="form-control">{{ $franquia->loja_url }}</span>

			    		<br>

			    		<label for="loja_url" class="text-aqua">Margem de Lucro automática:</label>
			    		<span class="form-control">~20%</span>     

			    		<br>       	

	              	</div>
	              	<!-- /.tab-pane -->
	              	<div class="tab-pane" id="tab_4">

	              		<h3>Logomarca Atual:</h3>


				            @if($imagem)  
				                <img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" width="10%">
				            @else
				                <img src="{{ asset('img/default-image-store.png') }}" width="10%">
				            @endif

			            
			    			<a href="{{url('franqueados/'.$franquia->id.'/imagem')}}" class="btn btn-info btn-lg"><i class="fa fa-image"></i> Alterar Logo</a>  
			    		

			    		<br><br><br>       	

	              	</div>
	              	<!-- /.tab-pane -->
	            </div>
	            <!-- /.tab-content --> 

	            <div class="col-md-12">

	            	<br>

		          	<a href="javascript:history.go(-1)" class="btn btn-info btn-lg"><i class="fa fa-undo"></i> Cancelar e Voltar</a>				

					<input style="float: right;"  type="submit" form="formSubmit" class="btn btn-success btn-lg" value="Salvar Dados">

		        </div>


	        </form>
          </div>
          <!-- nav-tabs-custom -->

        </div>
        <!-- /.col -->

	        

      </div>
      <!-- /.row -->
	
	@endsection
@endcan