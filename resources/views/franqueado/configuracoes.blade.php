@can('read_franqueado')  
	@extends('layouts.app')
	@section('title', $franquia->name)
	@section('content')

		@include('layouts/topnavfranqueado')


		<h1>
	        Loja 
	        <small>{{ $franquia->nome }}</small>
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
	            <div class="tab-content">
	              <div class="tab-pane active" id="tab_1">

	              		<h3>Informações da Loja:</h3>

					    <label for="nome">Nome:</label>
					    <span  class="form-control">{{ $franquia->nome }}</span>
					    <br>

					    <label for="slogan">Slogan:</label>
					    <span  class="form-control">{{ $franquia->slogan }}</span>
					    <br>

					    <label for="url_site">Endereço (URL) do Site:</label>
					    <span  class="form-control">{{ $franquia->url_site }}</span>
					    <br>

					    <label for="url_blog">Endereço (URL) do Blog:</label>
					    <span  class="form-control">{{ $franquia->url_blog }}</span>
					    <br>

					    <label for="descricao">Descrição:</label>				            
			            {!!html_entity_decode($franquia->descricao)!!}
				        	
	              </div>
	              <!-- /.tab-pane -->
	              <div class="tab-pane" id="tab_2">
					   	<h3>Dados Comerciais:</h3>

					    <label for="cnpj">CNPJ:</label>
					    <span  class="form-control">{{ $franquia->cnpj }}</span>

					    <br>

					    <label for="telefone">Telefone Comercial:</label>
					    <span  class="form-control">{{ $franquia->telefone }}</span>

					    <br>

				 	    <label for="email">e-Mail Comercial:</label>
					    <span class="form-control">{{ $franquia->email }}</span>

					    <br>

				    	<label for="endereco">Endereço Comercial:</label>
				    	<span  class="form-control">{{ $franquia->endereco }},{{ $franquia->endereco_numero }}</span>

				    	<br>

					    <label for="endereco_bairro">Bairro:</label>
					    <span  class="form-control">{{ $franquia->endereco_bairro }}</span>

					    <br>

					    <label for="endereco_cep">CEP:</label>
					    <span  class="form-control">{{ $franquia->endereco_cep }}</span>

					    <br>

					    <label for="endereco_estado">Cidade / Estado (UF):</label>
		                <span class="form-control">{{ $franquia->endereco_cidade }} - {{ $franquia->endereco_estado }}</span>				                

							 	
	              </div>
	              <!-- /.tab-pane -->
	              <div class="tab-pane" id="tab_3">


	              		<h3>Configurações da Loja Integrada:</h3>

			    		<label for="loja_url" class="text-aqua">Endereço (URL) da loja integrada:</label>
			    		<span  class="form-control">{{ $franquia->loja_url }}</span>

			    		<br>

			    		<label for="loja_url" class="text-aqua">Margem de Lucro automática:</label>
			    		<span class="form-control">~20%</span>            	

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
	          </div>
	          <!-- nav-tabs-custom -->
	        </div>
	        <!-- /.col -->

      </div>
      <!-- /.row -->

		
		
		<a href="{{url('franqueados/'.$franquia->id.'/configuracoesEdit')}}" class="btn btn-warning"><i class="fa fa-tools"></i> Modificar Loja</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success"><i class="fa fa-undo"></i> Voltar</a>
	@endsection
@endcan