@can('read_fornecedor_area')  
	@extends('layouts.app')
	@section('title', $orcamento->name)
	@section('content')
		<h1>
	        Orçamento 	        

            @if($orcamento->status==0)
                <span class="btn btn-primary btn-xs">Em edição / In editing</span> 
            @elseif($orcamento->status==1)
                <span class="btn btn-warning btn-xs">Em cotação / In quotation</span> 
            @elseif($orcamento->status==2)
                <span class="btn btn-danger btn-xs">Cancelado / Canceled</span> 
            @else($orcamento->status==3)
                <span class="btn btn-success btn-xs">Cotação Finalizada / Quotation Completed</span> 
            @endif


	    </h1>
	    <h2>
	        <small>Código / Code: <b>{{$orcamento->codigo}}</b></small>

	        		

	        		@if(($orcamento->status)==0)
		        		
		        		<a href="{{url('fornecedorArea/orcamentoItemLote/'.$orcamento->id)}}" class="btn btn-primary">
		        			<i class="fa fa-plus"></i> Adicionar Itens / Add Items
		        		</a>		        	    
		        	@endif


		        	@if((($orcamento->status)==0)or(($orcamento->status)==1))
		        	<a href="{{url('fornecedorArea/orcamentoEdit/'.$orcamento->id)}}" class="btn btn-warning">
		        	    	<i class="fa fa-edit"></i> Editar / Edit
		        	    </a>
		        	@endif
		        	

	    </h2> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Orçamento / Validity of the Budget:</label>
				    <span class="form-control" >{{ date('d/m/Y', strtotime($orcamento->token_validade)) }}</span>				    
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor / Provider:</label>
				    <span class="form-control">Nome / Name: <b>{{$fornecedor->nome_fantasia}} | {{$fornecedor->razao_social}} | {{$fornecedor->endereco_pais}}</b></span> 
				    <span class="form-control">Responsável / Responsible: <b>{{$fornecedor->responsavel}}</b> | e-Mail: <b>{{$fornecedor->email}}</b></span>
			 	</div>	
		</div>
		<div class="form-group col-md-12">	
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			            <table class="table table-hover">
			                <tr>
			                    <th>Produto <br> Product</th>
			                    <th>Quantidade <br> Amount</th>
			                    <th>Preço <br> Price</th>
			                    <th>Preço Frete <br> Shipping Cost</th>
			                    <th>Método de Envio <br> Shipping method</th>
			                    <th>Moeda <br> Currency</th>
			                    <th>Remover <br> Delete</th>
			                </tr>
			                @forelse ($itens as $item)
			                <tr>
			                    <td><a href="{{URL::to('produtos')}}/{{$item->id}}">{{$item->titulo}} 
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->quantidade}} {{$item->unidade_medida}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->preco}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->frete_preco}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->frete_tipo}}</a></td>
			                    <td><a href="{{URL::to('item')}}/{{$item->item_id}}">{{$item->moeda}}</a></td>
			                    
			                    <td>	

			                    	@if(($orcamento->status)==0)	                    	

			                        <form method="POST" action="{{action('FornecedorAreaController@orcamentoItemDestroy', $item->item_id)}}" id="formDelete{{$item->item_id}}">
			                            @csrf
			                            <input type="hidden" name="item_id" value="{{$item->item_id}}">
			                            <input type="hidden" name="orcamento_id" value="{{$orcamento->id}}">
			                            <a href="javascript:confirmDelete{{$item->item_id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i> Remover / Delete</a>
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
		@if((($orcamento->status)==0)or(($orcamento->status)==1))	
			<a href="{{url('fornecedorArea/orcamentoEdit/'.$orcamento->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>  Editar / Edit</a>
		@endif		
		
			<a href="javascript:history.go(-1)" class="btn btn-success"><i class="fas fa-arrow-left"></i> Voltar / Return</a>

		
	@endsection
@endcan