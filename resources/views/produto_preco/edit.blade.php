@can('read_produto_preco')  
	@extends('layouts.app')
	@section('title', $produto->name)
	@section('content')
		<h1>
	        Preço de Produto 
	        <small>{{$produto->titulo}}</small>|
	        <small>Precificação nº {{$produtoPreco->id}}</small>
	    </h1>
	    	<small>Status do Produto: </small>
	        @if($produto->status)
	    		<span class="btn btn-success">Produto Ativo</span>
	    	@else
	    		<span class="btn btn-danger">Produto Desativado</span>
	    	@endif

	    	<small>Status da Precificação: </small>
	    	@if($produtoPreco->status)
	    		<span class="btn btn-success">Liberado</span>
	    	@else
	    		<span class="btn btn-danger">Bloqueado</span>
	    	@endif

	    
	    <hr class="hr col-md-12">
	    <div class="row">

	    	<form method="POST" enctype="multipart/form-data" action="{{action('ProdutoPrecoController@update', $produtoPreco->id)}}" id="formSubmit">
				@csrf
				<input type="hidden" name="_method" value="PATCH">

			 	<div class="form-group col-md-1">
				    <label for="quantidade">Quantidade:</label>
				    <input name="quantidade" type="number" class="form-control" value="{{$produtoPreco->quantidade}}">
			 	</div>

			 	<div class="form-group col-md-3">
				    <label for="unidade_medida">Unidade:</label>

					    <select name="unidade_medida" class="form-control select2" data-placeholder="Selecione uma unidade de medida"
			                style="width: 100%;" required="required">
			                	<option value="{{ $produtoPreco->unidade_medida }}">{{ $produtoPreco->unidade_medida }}</option>
			                @forelse ($unidades_medidas as $unidade_medida)
			                    <option value="{{$unidade_medida}}">
			                        {{$unidade_medida}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        	</select>
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="preco">Preço:</label>
				    <input name="preco" type="number" class="form-control" value="{{number_format($produtoPreco->preco, 2, '.', ' ')}}">
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="frete_preco">Frete:</label>
				    <input name="frete_preco" type="number" class="form-control" value="{{number_format($produtoPreco->frete_preco, 2, '.', ' ')}}">
			 	</div>
			 	<div class="form-group col-md-2">
				    <label for="frete_tipo">Tipo de Frete:</label>
				    <input name="frete_tipo" type="text" class="form-control" value="{{$produtoPreco->frete_tipo}}">
			 	</div>
			 	<div class="form-group col-md-2">
				    <label for="moeda">Moeda:</label>
					    <select name="moeda" class="form-control select2" data-placeholder="Selecione uma moeda"
			                style="width: 100%;">
			                	<option value="{{ $produtoPreco->moeda }}">{{ $produtoPreco->moeda }}</option>
			                @forelse ($moedas as $moeda)
			                    <option value="{{$moeda}}">
			                        {{$moeda}}
			                    </option>
			                @empty
			                    <option>Nenhuma Opção</option>     
			                @endforelse
			                      
			        	</select>
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="taxa_plataforma">Taxa %:</label>
				    <input name="taxa_plataforma" type="number" class="form-control" value="{{number_format($produtoPreco->taxa_plataforma, 2, '.', ' ')}}">
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="impostos">Impostos %:</label>
				    <input name="impostos" type="number" class="form-control" value="{{number_format($produtoPreco->impostos, 2, '.', ' ')}}">
			 	</div>
				<div class="col-md-12">			 			 		
			 		<input type="submit" form="formSubmit" class="btn btn-primary" value="Atualizar Precificação">
			 		<hr>
			 	</div>

			</form>
		</div>

	    <hr class="hr col-md-12">

    	<div class="row justify-content-center form-group">
		    <div class="col-md-12">
		        
		        	@forelse ($imagens as $imagem)
		        	<div class="col-md-2">
			            <a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" data-toggle="lightbox" data-gallery="example-gallery">
			                <img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" class="img-fluid" width="100%">
			            </a>
			        </div>
			        @empty
			        <div class="col-md-2">
			        	<span class="btn btn-primary">
	                        <i class="fa fa-image"></i>
	                         Nenhuma imagem.
	                    </span>
	                </div>
			        @endforelse	        
		        
		    </div>
		</div>
		<div class="row">		
				
			 	<div class="form-group col-md-12">
				    <label for="titulo">Título:</label>
				    <span class="form-control">{{$produto->titulo}}</span>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="palavras_chave">Palavras Chave (Separadas por vírgula):</label>
				    <span class="form-control">{{$produto->palavras_chave}}</span>
			 	</div>
			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Cubagem:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="altura" class="text-aqua">Altura (cm)</label>
			    		<span class="form-control">{{$produto->altura}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="largura" class="text-aqua">Largura (cm)</label>
			    		<span class="form-control">{{$produto->largura}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="comprimento" class="text-aqua">Comprimento (cm)</label>
			    		<span class="form-control">{{$produto->comprimento}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="peso" class="text-aqua">Peso (g)</label>
			    		<span class="form-control">{{$produto->peso}}</span>
			    	</div>
			    	
				</div>

				<div class="form-group col-md-12">
				    <label for="link_referencia">Link de Referência:</label>
				    <input disabled="disabled" class="form-control" value="{{$produto->link_referencia}}">
			 	</div>		 	


			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" disabled="disabled" placeholder="Detalhes do produto"="required" name="descricao" 
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$produto->descricao}}</textarea>
		              </form>
		            </div>
			 	</div>	
		</div>
				
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan