@if($orcamento->status==1)

	<script type="text/javascript">	
		document.getElementById("body-nologin").className = "sidebar-collapse";

	</script>

	@extends('layouts.nologin')
	@section('title', $orcamento->name)
	@section('content')

		<a href="https://translate.google.com.br/translate?hl=pt-BR&sl=pt&tl=en&u={{url('orcamento/fornecedor/'.$orcamento->token)}}" class="btn btn-primary">
			<i class="fa fa-language"> Automatic Translation | 翻譯</i>
		</a> 

		<br>

		<h1>
	        Orçamento de Produtos
	        <br>
	        Products Budget

	        @if($orcamento->status==0)
                <span class="btn btn-primary btn-xs">Em edição (In editing)</span> 
            @elseif($orcamento->status==1)
                <span class="btn btn-warning btn-xs">Em cotação (In quotation
)</span> 
            @elseif($orcamento->status==2)
                <span class="btn btn-danger btn-xs">Cancelado (Canceled)</span> 
            @else($orcamento->status==3)
                <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
            @endif


	    </h1>
	    <h2>
	        <small>Código (Code): <b>{{$orcamento->codigo}}</b></small>
	        		
	        	<button class="btn btn-success" type="submit" form="orcamento_salvar" value="Salvar (Save)"> <i class="fa fa-save"></i> Salvar (Save)</button>


	    </h2> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token (Token validity):</label>
				    <span class="form-control" >{{ date('d/m/Y', strtotime($orcamento->token_validade)) }}</span>
				    <br>				    
			 	</div>			 	

		    	<div class="form-group col-md-10">
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
			                    <th>Produto <br> (Product)</th>
			                    <th>Quantidade <br> (Amount)</th>
			                    <th>Preço <br> (Price)</th>
			                    <th>Preço Frete <br> (Shipping Cost)</th>
			                    <th>Tipo de Frete <br> (Shipping type)</th>
			                    <th>Moeda <br> (Currency)</th>			                    
			                    <th>Salvar <br> (Save)</th>
			                </tr>
			                <form method="POST" action="{{url('orcamento/fornecedorUpdate')}}" id="orcamento_salvar">

			                	@csrf			                	

			                	<input type="hidden" name="token" value="{{$orcamento->token}}">

				                @forelse ($itens as $item)

				                <input type="hidden" name="id[]" value="{{$item->item_id}}">

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
				                    	<button class="btn btn-success btn-xs" type="submit" form="orcamento_salvar" value="Salvar"> <i class="fa fa-save"></i> Salvar (Save)</button>
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
			
		<button class="btn btn-success" type="submit" form="orcamento_salvar" value="Salvar"> <i class="fa fa-save"></i> Salvar (Save)</button>

		<a href="{{url('orcamento/fornecedorFinalizar/'.$orcamento->token)}}" class="btn btn-primary"><i class="fa fa-check"></i> Finalizar Orçamento (Finalize Budget)</a>
		
		
	@endsection
@else

	<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-bane"></i> Erro (Error)!</h4>
        <h1>Orçamento Finalizado (Budget Completed)</h1>
    </div>

@endif

