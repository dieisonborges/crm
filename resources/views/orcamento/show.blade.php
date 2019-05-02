@can('read_orcamento')  
	@extends('layouts.app')
	@section('title', $orcamento->name)
	@section('content')
		<h1>
	        Orcamento 

	        @if($orcamento->status==0)
                <span class="btn btn-primary btn-xs">Em edição</span> 
            @elseif($orcamento->status==1)
                <span class="btn btn-warning btn-xs">Bloqueado: Enviado para cotação</span> 
            @elseif($orcamento->status==2)
                <span class="btn btn-danger btn-xs">Cancelado</span> 
            @else($orcamento->status==3)
                <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
            @endif


	    </h1>
	    <h2>
	        <small>Código: <b>{{$orcamento->codigo}}</b></small>

	        		@if($orcamento->status==3)
	        		<a href="{{URL::to('produtoPrecos/'.$orcamento->id.'/orcamento')}}" class="btn btn-primary">
	        			<i class="fas fa-money-bill-alt"></i> Precificar Todos Ítens
	        		</a> 
	        		@endif

	        		@if(($orcamento->status)==0)
		        		<a href="{{$orcamento->id}}/item" class="btn btn-primary">
		        			<i class="fa fa-plus"></i> Adicionar Item
		        		</a>
		        	    <a href="{{$orcamento->id}}/edit" class="btn btn-warning">
		        	    	<i class="fa fa-edit"></i> Editar
		        	    </a>
		        	@endif

		        	@if(($orcamento->status==0)or($orcamento->status==1))
	        	    <a href="{{URL::to('orcamento')}}/{{$orcamento->id}}/enviar" class="btn btn-danger">
                        <i class="fa fa-paper-plane"> Enviar</i>                       
                    </a>
                    @endif

	    </h2> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <span class="form-control" >{{ date('d/m/Y', strtotime($orcamento->token_validade)) }}</span>
				    <br>
				    <a href="{{url('fornecedor/'.$fornecedor->id)}}" class="btn btn-primary"><i class="fa fa-truck"></i> Ver Fonecedor</a>
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
			                    <th>P. Frete</th>
			                    <th>Frete</th>
			                    <th>Moeda</th>
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
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->moeda}}</a></td>
			                    <td>
			                    	@if(($orcamento->status)==0)
			                        	<a class="btn btn-warning btn-xs" href="{{URL::to('orcamento/'.$item->item_id.'/itemEdit')}}"><i class="fa fa-edit"></i> Editar</a>
			                        @else
			                            <span class="btn btn-warning btn-xs">Bloqueado</span>
			                        @endif
			                    </td>
			                    <td>	

			                    	@if(($orcamento->status)==0)	                    	

			                        <form method="POST" action="{{action('OrcamentoController@itemDestroy', $item->item_id)}}" id="formDelete{{$item->item_id}}">
			                            @csrf
			                            <input type="hidden" name="_method" value="DELETE">
			                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
			                            <!--<input type="submit" name="Excluir">-->

			                            <a href="javascript:confirmDelete{{$item->item_id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Remover</a>
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

			                        @else
			                            <span class="btn btn-warning btn-xs">Bloqueado</span>
			                        @endif

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
		@if(($orcamento->status)==0)	
			<a href="{{$orcamento->id}}/edit" class="btn btn-warning">Editar</a>
		@endif		
		
			<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>

		@if(($orcamento->status)!=2)	
			<a href="{{$orcamento->id}}/cancelar" class="btn btn-danger" style="float: right;">Cancelar Orçamento</a>
		@endif
	@endsection
@endcan