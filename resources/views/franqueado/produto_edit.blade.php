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

			    <h4><small>{{$produto->short_description}}</small></h4>

			    <br>

			    <hr class="col-md-12 hr">

			    <a href="{{$franquia->store_url.'/produto/'.$produto->slug}}" class="btn btn-sm btn-info" target="_blank">
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

                <br>
				
				<form method="POST" action="{{action('FranqueadoController@produtoSimpleUpdate')}}" id="formSubmit">
					@csrf
					<input type="hidden" name="_method" value="POST">	

					<input type="hidden" name="franquia_id" value="{{ $franquia->id }}">

					<input type="hidden" name="produto_id" value="{{ $produto->id }}">	

					<div class="form-group col-md-12">
					    <label for="sale_price">Preço Mínimo:</label>
					    <span class="btn btn-default">{{ $produto_ref->sale_price }}</span>
				 	</div>

				 	

				 	<div class="form-group col-md-12">
					    <label for="sale_price">Lucro/Prejuízo:</label>
					    <span class="btn btn-default btn-lg">{{ ($produto->sale_price)-($produto_ref->sale_price) }}</span>
				 	</div>	

					
				 	<div class="form-group col-md-12">
					    <label for="price">Preço:</label>
					    <input type="text" class="form-control" id="price" name="price" value="{{ $produto->price }}" required>
				 	</div>

				 	<div class="form-group col-md-12">
					    <label for="regular_price">Preço Regular:</label>
					    <input type="text" class="form-control" id="regular_price" name="regular_price" value="{{ $produto->regular_price }}" required>
				 	</div>

				 	<div class="form-group col-md-12">
					    <label for="sale_price">Preço de Venda:</label>
					    <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ $produto->sale_price }}" required>
				 	</div>

				 	<div class="form-group col-md-12">
					    <label for="sale_price">Exibição:</label>
					    <span class="btn btn-default btn-lg">{!!html_entity_decode($produto->price_html)!!}</span>
				 	</div>

				 	<div class="form-group col-md-12">
				 		<input type="submit" name="Salvar" value="Salvar Dados" class="btn btn-success btn-lg">
				 	</div>


				 	
				</form>
    			
    		</div>

    		<hr class="col-md-12 hr">

    		<div class="col-md-12">
			    	
			    	
			    	{!!html_entity_decode($produto->description)!!}

    		</div>
			
		</div>
	@endsection
@endcan