@can('read_orcamento')  
	@extends('layouts.app')
	@section('title', $orcamento->name)
	@section('content')
		<h1>
	        Orcamento 
	        <small>{{$orcamento->name}}</small>

 

	        @if($orcamento->status)
	    		<span class="btn btn-success">Ativo</span>
	    	@else
	    		<span class="btn btn-danger">Desativado</span>
	    	@endif


	    </h1> 
		<div class="row">		
				
			 	<div class="form-group col-md-12">
				    <label for="titulo">Título:</label>
				    <span class="form-control">{{$orcamento->titulo}}</span>
			 	</div>

			 	<div class="form-group col-md-12">
				    <label for="palavras_chave">Palavras Chave (Separadas por vírgula):</label>
				    <span class="form-control">{{$orcamento->palavras_chave}}</span>
			 	</div>
			 	
		 		<div class="col-md-12">
			   		<label for="palavras_chave">Cubagem:</label>
				</div>
			    <div class="form-group col-md-12">
			    	<div class="col-md-3">
			    		<label for="altura" class="text-aqua">Altura (cm)</label>
			    		<span class="form-control">{{$orcamento->altura}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="largura" class="text-aqua">Largura (cm)</label>
			    		<span class="form-control">{{$orcamento->largura}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="comprimento" class="text-aqua">Comprimento (cm)</label>
			    		<span class="form-control">{{$orcamento->comprimento}}</span>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="peso" class="text-aqua">Peso (g)</label>
			    		<span class="form-control">{{$orcamento->peso}}</span>
			    	</div>
			    	
				</div>

				<div class="form-group col-md-12">
				    <label for="link_referencia">Link de Referência:</label>
				    <input disabled="disabled" class="form-control" value="{{$orcamento->link_referencia}}">
			 	</div>		 	


			 	<div class="form-group col-md-12">
				    <label for="descricao">Descrição:</label>				    
					<!-- /.box-header -->
		            <div class="box-body pad">
		              <form>
		                <textarea class="textarea" disabled="disabled" placeholder="Detalhes do orcamento"="required" name="descricao" 
		                          style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$orcamento->descricao}}</textarea>
		              </form>
		            </div>
			 	</div>	
		</div>
		
		<a href="{{$orcamento->id}}/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan