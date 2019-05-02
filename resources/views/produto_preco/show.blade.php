@can('read_produto_preco')  
	@extends('layouts.app')
	@section('title', $produto->name)
	@section('content')
		<h1>
	        Preço de Produto 
	        <small>{{$produto->titulo}}</small>|
	        <small>Precificação nº {{$produtoPreco->id}}</small>
	    </h1>
	        @if($produto->status)
	    		<span class="btn btn-success">Produto Ativo</span>
	    	@else
	    		<span class="btn btn-danger">Produto Desativado</span>
	    	@endif

	    	@if($produtoPreco->status)
	    		<span class="btn btn-success">Liberado</span>
	    	@else
	    		<span class="btn btn-danger">Bloqueado</span>
	    	@endif

	    
	    <hr class="hr col-md-12">
	    <div class="row">
	    		@if($produtoPreco->fornecedor_id)
			 	<div class="form-group col-md-6">
				    <label for="titulo">Fornecedor:</label>
				    <span class="form-control">{{$produtoPreco->fornecedores->nome_fantasia}}</span>
			 	</div>
			 	@endif
			 	@if($produtoPreco->orcamento_id)
			 	<div class="form-group col-md-4">
				    <label for="titulo">Orçamento:</label>
				    <span class="form-control">{{$produtoPreco->orcamentos->codigo}}</span>
			 	</div>
			 	@endif
			 	@if($produtoPreco->item_orcamento_id)
			 	<div class="form-group col-md-2">
				    <label for="titulo">Nº de Item de Orçamento:</label>
				    <span class="form-control">{{$produtoPreco->item_orcamento->id}}</span>
			 	</div>
			 	@endif

			 	<hr class="hr col-md-12">

			 	<div class="form-group col-md-1">
				    <label for="titulo">Quantidade:</label>
				    <span class="form-control">{{$produtoPreco->quantidade}}</span>
			 	</div>
			 	<div class="form-group col-md-3">
				    <label for="titulo">Unidade:</label>
				    <span class="form-control">{{$produtoPreco->unidade_medida}}</span>
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="titulo">Preço:</label>
				    <span class="form-control">{{number_format($produtoPreco->preco, 2, ',', ' ')}}</span>
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="titulo">Frete:</label>
				    <span class="form-control">{{number_format($produtoPreco->frete_preco, 2, ',', ' ')}}</span>
			 	</div>
			 	<div class="form-group col-md-2">
				    <label for="titulo">Tipo de Frete:</label>
				    <span class="form-control">{{$produtoPreco->frete_tipo}}</span>
			 	</div>
			 	<div class="form-group col-md-2">
				    <label for="titulo">Moeda:</label>
				    <span class="form-control">{{$produtoPreco->moeda}}</span>
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="titulo">Taxa:</label>
				    <span class="form-control">{{number_format($produtoPreco->taxa_plataforma, 2, ',', ' ')}}%</span>
			 	</div>
			 	<div class="form-group col-md-1">
				    <label for="titulo">Impostos:</label>
				    <span class="form-control">{{number_format($produtoPreco->impostos, 2, ',', ' ')}}%</span>
			 	</div>
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
		
		<a href="{{$produtoPreco->id}}/edit" class="btn btn-warning">Editar Precificação</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan