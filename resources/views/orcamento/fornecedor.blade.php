@if($orcamento->status==1)	

	@extends('layouts.nologin')
	@section('title', $orcamento->name)
	@section('content')
		<h1>
	        Orcamento 

	        @if($orcamento->status==0)
                <span class="btn btn-primary btn-xs">Em edição</span> 
            @elseif($orcamento->status==1)
                <span class="btn btn-warning btn-xs">Em cotação</span> 
            @elseif($orcamento->status==2)
                <span class="btn btn-danger btn-xs">Cancelado</span> 
            @else($orcamento->status==3)
                <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
            @endif


	    </h1>
	    <h2>
	        <small>Código: <b>{{$orcamento->codigo}}</b></small>
	        		
	        	<a href="#" class="btn btn-success"><i class="fa fa-save"></i> Salvar</a>


	    </h2> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <span class="form-control" >{{ date('d/m/Y', strtotime($orcamento->token_validade)) }}</span>
				    <br>				    
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor:</label>
				    <span class="form-control">Nome: <b>{{$fornecedor->nome_fantasia}} | {{$fornecedor->razao_social}} | {{$fornecedor->endereco_pais}}</b></span> 
				    <span class="form-control">Responsável: <b>{{$fornecedor->responsavel}}</b> | e-Mail: <b>{{$fornecedor->email}}</b></span>
			 	</div>	
		</div>
		<div class="form-group col-md-12">	
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			            <table class="table table-hover">
			                <tr>
			                    <th>ID</th>
			                    <th>Produto</th>
			                    <th>Quantidade</th>
			                    <th>Preço</th>
			                    <th>Preço Frete</th>
			                    <th>Tipo de Frete</th>			                    
			                    <th>Salvar</th>
			                </tr>
			                <form action="#" id="orcamento_salvar">

			                	@csrf

			                	<input type="hidden" name="token" value="{{$orcamento->token}}">

				                @forelse ($itens as $item)
				                <tr>

				                    <td>{{$item->item_id}}</td>
				                    <td><a target="_blank" href="{{$item->link_referencia}}">{{$item->titulo}}</a></td>
				                    <td><a target="_blank" href="{{$item->link_referencia}}">{{$item->quantidade}} {{$item->unidade_medida}}</a></td>
				                    <td> 
				                    	<input type="text" name="preco[{{$item->id}}]" value="{{$item->preco}}">
				                    </td>
				                    <td> 
				                    	<input type="text" name="frete_preco[{{$item->id}}]" value="{{$item->frete_preco}}">
				                    </td>
				                    <td> 
				                    	<input type="text" name="frete_tipo[{{$item->id}}]" value="{{$item->frete_tipo}}">
				                    </td>
				                    <td>				                    	
				                    	<a href="#" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Salvar</a>
				                    </td>
				                    
				                </tr>                
				                @empty

				                <tr>
				                    <td><b>Nenhum Resultado.</b></td>
				                </tr>
				                    
				                @endforelse
				            </form>  

			                    
			                
			            </table>
			        </div>
			        <!-- /.box-body -->
		</div>

		<hr class="hr">
			
		<a href="#" class="btn btn-success"><i class="fa fa-save"></i> Salvar</a>

		<a href="#" class="btn btn-primary"><i class="fa fa-close"></i> Finalizar Orçamento</a>
		
		
	@endsection
@else

	<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-bane"></i> Erro!</h4>
        <h1>Orçamento Finalizado</h1>
    </div>

@endif