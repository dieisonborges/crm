@can('read_orcamento')  
	@extends('layouts.app')
	@section('title', $orcamento->name)
	@section('content')
		<h1>
	        Orcamento 
	        <small>{{$orcamento->codigo}}</small>
	        		<a href="{{$orcamento->id}}/item" class="btn btn-primary">
	        			<i class="fa fa-plus"></i> Adicionar Item
	        		</a>
	        	    <a href="{{$orcamento->id}}/edit" class="btn btn-warning">
	        	    	<i class="fa fa-edit"></i> Editar
	        	    </a>
	        	    <a href="{{URL::to('orcamento')}}/{{$orcamento->id}}/enviar" class="btn btn-danger">
                        <i class="fa fa-paper-plane"> Enviar</i>                       
                    </a>

	    </h1> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <span class="form-control" >{{ date('d/m/Y', strtotime($orcamento->token_validade)) }}</span>
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor:</label>
				    <span class="form-control">{{$fornecedor->nome_fantasia}} | {{$fornecedor->responsavel}} | {{$fornecedor->email}} | {{$fornecedor->razao_social}} | {{$fornecedor->cnpj}} | {{$fornecedor->endereco_pais}}</span>
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
			                    <th>Modificar</th>
			                    <th>Remover</th>
			                </tr>
			                @forelse ($itens as $item)
			                <tr>
			                    <td>{{$item->item_id}}</td>
			                    <td><a href="{{URL::to('produtos')}}/{{$item->id}}">{{$item->titulo}} 
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->quantidade}} {{$item->unidade_medida}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->preco}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->frete_preco}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->frete_tipo}}</a></td>
			                    <td>
			                        <a class="btn btn-warning btn-xs" href="{{URL::to('orcamento/'.$item->item_id.'/itemEdit')}}"><i class="fa fa-edit"></i> Editar</a>
			                    </td>
			                    <td>

			                        <form method="POST" action="{{action('OrcamentoController@itemDestroy', $item->item_id)}}" id="formDelete{{$item->item_id}}">
			                            @csrf
			                            <input type="hidden" name="_method" value="DELETE">
			                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
			                            <!--<input type="submit" name="Excluir">-->

			                            <a href="javascript:confirmDelete{{$item->item_id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Remover</a>
			                        </form> 

			                        <script>
			                           function confirmDelete{{$item->item_id}}() {

			                            var result = confirm('Tem certeza que deseja remover?');

			                            if (result) {
			                                    document.getElementById("formDelete{{$item->item_id}}").submit();
			                                } else {
			                                    return false;
			                                }
			                            } 
			                        </script>

			                    </td>
			                </tr>                
			                @empty

			                <tr>
			                    <td><b>Nenhum Resultado.</b></td>
			                </tr>
			                    
			                @endforelse      

			                    
			                
			            </table>
			        </div>
			        <!-- /.box-body -->
		</div>

		<hr class="hr">
		
		<a href="{{$orcamento->id}}/edit" class="btn btn-warning">Editar</a>
		
		<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>
	@endsection
@endcan