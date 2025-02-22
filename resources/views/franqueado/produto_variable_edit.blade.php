@can('update_franqueado')  
	@extends('layouts.app')
	@section('title', 'Editar Produto')
	@section('content')

		@include('layouts/topnavfranqueado')
 
    	<div class="box box-success">
    		<div class="col-md-12">

    			<h1>
			        <i class="fa fa-store"></i> {{$produto->name}}
			        <small>Editar</small>
			    </h1>
			    <h4>SKU: <small>{{$produto->sku}}</small></h4>
			    <h4>Slug: <small>{{$produto->slug}}</small></h4>
			    <h4>Tipo: 
			    	@if($produto->type=='simple')
                        <span class="btn btn-sm btn-success">Simples</span>
                    @elseif($produto->type=='variable')
                        <span class="btn btn-sm btn-info">Variável</span>                        
                    @else
                        <span class="btn btn-sm btn-default">{{$produto->type}}</span>
                    @endif
				</h4>
			    <h4>Status: 
			    	@if($produto->status=='publish')
                        <span class="btn btn-sm btn-success">Publicado</span>
                    @elseif($produto->status=='pending')
                        <span class="btn btn-sm btn-warning">Revisão</span>
                    @elseif($produto->status=='draft')
                        <span class="btn btn-sm btn-danger">Rascunho</span>
                    @else
                        <span class="btn btn-sm btn-info">{{$produto->status}}</span>
                    @endif
			    </h4>			    

			    <h4><small>{!!$produto->short_description!!}</small></h4>

			    <div class="form-group col-md-12">
				    <label for="sale_price">Exibição Preço:</label>
				    <span class="btn btn-default btn-lg">{!!html_entity_decode($produto->price_html)!!}</span>
			 	</div>

			    <br>

			    <hr class="col-md-12 hr">

			    <a href="{{$franquia->store_url.'produto/'.$produto->slug}}" class="btn btn-sm btn-info" target="_blank">
                    <span class="fa fa-eye"></span>
                    Ver Produto
                </a>

                @if(($produto->status)=='publish')                
	                <a href="{{url('franqueados/'.$franquia->id.'/produtoPublic/'.$produto->id.'/draft')}}" class="btn btn-sm btn-danger">
	                    <span class="fa fa-window-close"></span>
	                    Despublicar
	                </a>
                @else
                	<a href="{{url('franqueados/'.$franquia->id.'/produtoPublic/'.$produto->id.'/publish')}}" class="btn btn-sm btn-success">
                    	<span class="fa fa-check-square"></span>
                    	Publicar
                </a>
                
                @endif

                <br>

                <hr class="col-md-12 hr">

                   

                <div class="col-md-6">   

                <h2>Variações:</h2>      
  

                @foreach($variations as $variation)

		                <hr class="hr col-md-12">

		                <form method="POST" action="{{action('FranqueadoController@produtoVariableUpdate')}}" id="formSubmit">
							@csrf
							<input type="hidden" name="_method" value="POST">	

							<input type="hidden" name="franquia_id" value="{{ $franquia->id }}">

							<input type="hidden" name="produto_id" value="{{ $produto->id }}">

							<input type="hidden" name="variation_id" value="{{ $variation->id }}">		

							@foreach($variation->attributes as $attribute)
							 	<div class="form-group col-md-12">
								    <label for="sku">{{$attribute->name}}:</label>
								    <span class="btn btn-default btn-lg">{{$attribute->option}}</span>
							 	</div>
						 	@endforeach

							<div class="form-group col-md-6">
							    <label for="sku">SKU:</label>
							    <span class="btn btn-default btn-lg">{{ $variation->sku }}</span>
						 	</div>

						 	<div class="form-group col-md-6">
							    <label for="sku">Estoque:</label>
							    <span class="btn btn-default btn-lg">{{ $variation->stock_quantity }}</span>
						 	</div>
						 	
							
						 	<div class="form-group col-md-12">
							    <label for="price">Preço:</label>
							    <span class="form-control">{{ $variation->price }}</span>
						 	</div>

						 	<div class="form-group col-md-12">
							    <label for="regular_price" class="text-blue">Preço Regular:</label>
							    <input type="text" class="form-control" id="regular_price" name="regular_price" value="{{ $variation->regular_price }}" required>
						 	</div>

						 	<div class="form-group col-md-12">
							    <label for="sale_price" class="text-blue">Preço de Venda:</label>
							    <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ $variation->sale_price }}" required>
						 	</div>				 	

						 	<div class="form-group col-md-12">
						 		<input type="submit" name="Salvar" value="Salvar Dados" class="btn btn-success btn-lg">
						 	</div>


						 	
						</form>
						
				@endforeach

				</div>

				<div class="col-md-6">

					<h2>Variações (Referência):</h2> 
					
					@foreach($variations_ref as $variation_ref)

			                <hr class="hr col-md-12">	

			                	@foreach($variation_ref->attributes as $attribute)
								 	<div class="form-group col-md-12">
									    <label for="sku">{{$attribute->name}}:</label>
									    <span class="btn btn-default btn-lg">{{$attribute->option}}</span>
								 	</div>
							 	@endforeach							

								<div class="form-group col-md-6">
								    <label for="sku">SKU:</label>
								    <span class="btn btn-default btn-lg">{{ $variation_ref->sku }}</span>
							 	</div>

							 	<div class="form-group col-md-6">
								    <label for="sku">Estoque:</label>
								    <span class="btn btn-default btn-lg">{{ $variation_ref->stock_quantity }}</span>
							 	</div>

							 	
								
							 	<div class="form-group col-md-12">
								    <label for="price">Preço Mínimo:</label>
								    <span class="form-control"> {{ $variation_ref->price }}</span>
							 	</div>

							 	<div class="form-group col-md-12">
								    <label for="regular_price">Preço Mínimo Regular:</label>
								    <span class="form-control"> {{ $variation_ref->regular_price }}</span>
							 	</div>

							 	<div class="form-group col-md-12">
								    <label for="sale_price">Preço Mínimo de Venda:</label>
								    <span class="form-control"> {{ $variation_ref->sale_price }}</span>
							 	</div>				 	

							 	<div class="form-group col-md-12">
							 		<span style="float: left; margin-top: 46px;"></span>
							 	</div>

							
					@endforeach
				</div>

    			
    		</div>

    		<hr class="col-md-12 hr">

    		<div class="col-md-12">
			    	
			    	
			    	{!!html_entity_decode($produto->description)!!}

    		</div>
			
		</div>
	@endsection
@endcan