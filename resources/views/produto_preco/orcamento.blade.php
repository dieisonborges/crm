@can('create_produto_preco')  
	@extends('layouts.app')
	@section('title', '')
	@section('content')

		<h1>
	        Preço de Produto de Orçamento
	    </h1>
	    <h2>
	        <small>Código (Code): <b>{{$orcamento->codigo}}</b></small>
	    </h2> 
		<div class="row"> 
				<div class="form-group col-md-12">
				    <label for="fornecedor_id">Fornecedor (Provider):</label>
				    <span class="form-control">Nome (Name): <b>{{$fornecedor->nome_fantasia}} | {{$fornecedor->razao_social}} | {{$fornecedor->endereco_pais}}</b></span> 
				    <span class="form-control">Responsável (Responsible): <b>{{$fornecedor->responsavel}}</b> | e-Mail: <b>{{$fornecedor->email}}</b></span>
			 	</div>	
		</div>
		<div class="form-group col-md-12">	
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			            <table class="table table-hover">
			                <tr>
			                    <th>SKU</th>
			                    <th>Produto</th>
			                    <th>Qtd Orç.</th>
			                    <th>Qtd Disp.</th>
			                    <th>Preço</th>
			                    <th>Preço Frete</th>
			                    <th>Tipo Frete</th>
			                    <th>Moeda</th>
			                    <th>Taxa %</th>
			                    <th>Imp. %</th>	                    
			                </tr>
			                <form method="POST" action="{{url('produtoPrecos/orcamentoCreate')}}" id="orcamento_salvar">

			                	@csrf	

			                	<input type="hidden" name="orcamento_id" value="{{$orcamento->id}}">

			                	<input type="hidden" name="fornecedor_id" value="{{$fornecedor->id}}">

				                @forelse ($itens as $item)

				                <input type="hidden" name="produto_id[]" value="{{$item->produto_id}}">

			                	<input type="hidden" name="item_id[]" value="{{$item->item_id}}">

				                <input type="hidden" name="id[]" value="{{$item->item_id}}">

				                <input type="hidden" name="unidade_medida[]" value="{{$item->unidade_medida}}">

				                <tr>
				                	<td>
				                		<a target="_blank" href="{{$item->link_referencia}}">{{$item->sku}}</a>
				                	</td>
				                    <td style="width:30%;">
				                    	<a target="_blank" href="{{$item->link_referencia}}">{{$item->titulo}}</a>
				                    </td>
				                    <td align="center">
				                    	<a target="_blank" href="{{$item->link_referencia}}">
				                    		<span style="font-size: 30px;">{{$item->quantidade}}</span><br>
				                    		<span style="font-size: 10px;">{{$item->unidade_medida}}</span>
				                    	</a>
				                    </td>
				                    <td align="center">
				                    		<input class="form-control" type="number" name="quantidade[]" value="" size="1">
				                    </td>				                
				                    <td> 
				                    	<input class="form-control" type="number" step="0.01" name="preco[]" value="{{$item->preco}}" size="1">
				                    </td>
				                    <td> 
				                    	<input class="form-control" type="number" step="0.01" name="frete_preco[]" value="{{$item->frete_preco}}" size="1">
				                    </td>
				                    <td style="width:10%;"> 
				                    	<input class="form-control" type="text" name="frete_tipo[]" value="{{$item->frete_tipo}}" size="1">
				                    </td>
				                    <td> 
				                    	 <select name="moeda[]" class="form-control" data-placeholder="Moeda (Currency)" style="width: 80px;">
							                	<option selected="selected" value="{{$item->moeda}}">{{$item->moeda}}</option>
								                @forelse ($moedas as $moeda)
								                    <option value="{{$moeda}}">
								                        {{$moeda}}
								                    </option>
								                @empty
								                    <option>Nenhuma Opção (No Options)</option>     
								                @endforelse
							                      
							        	</select>
				                    </td>
				                    <td> 
				                    	<input class="form-control" type="number" step="0.01" name="taxa_plataforma[]" value="2.00" size="1">
				                    </td>
				                    <td> 
				                    	<input class="form-control" type="number" step="0.01" name="impostos[]" value="0.00" size="1">
				                    </td>			                    
				                    
				                </tr>                
				                @empty

				                <tr>
				                    <td><b>Nenhum Resultado (No results)</b></td>
				                </tr>
				                    
				                @endforelse
				            </form>  

			                    
			                
			            </table>
			        </div>
			        <!-- /.box-body -->
		</div>

		<hr class="hr">
			
		<button class="btn btn-success" type="submit" form="orcamento_salvar" value="Salvar"> <i class="fa fa-money-bill-alt"></i> Gerar Precificação</button>
	
		
	@endsection
@endcan

