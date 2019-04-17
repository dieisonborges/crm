<?php if($orcamento->status==1): ?>

	<script type="text/javascript">	
		document.getElementById("body-nologin").className = "sidebar-collapse";

	</script>

	
	<?php $__env->startSection('title', $orcamento->name); ?>
	<?php $__env->startSection('content'); ?>

		<a href="https://translate.google.com.br/translate?hl=pt-BR&sl=pt&tl=en&u=<?php echo e(url('orcamento/fornecedor/'.$orcamento->token)); ?>" class="btn btn-primary">
			<i class="fa fa-language"> Translate | 翻譯</i>
		</a> 

		<br>

		<h1>
	        Orcamento 

	        <?php if($orcamento->status==0): ?>
                <span class="btn btn-primary btn-xs">Em edição</span> 
            <?php elseif($orcamento->status==1): ?>
                <span class="btn btn-warning btn-xs">Em cotação</span> 
            <?php elseif($orcamento->status==2): ?>
                <span class="btn btn-danger btn-xs">Cancelado</span> 
            <?php else: ?>
                <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
            <?php endif; ?>


	    </h1>
	    <h2>
	        <small>Código: <b><?php echo e($orcamento->codigo); ?></b></small>
	        		
	        	<button class="btn btn-success" type="submit" form="orcamento_salvar" value="Salvar"> <i class="fa fa-save"></i> Salvar</button>


	    </h2> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <span class="form-control" ><?php echo e(date('d/m/Y', strtotime($orcamento->token_validade))); ?></span>
				    <br>				    
			 	</div>			 	

		    	<div class="form-group col-md-10">
				    <label for="fornecedor_id">Fornecedor:</label>
				    <span class="form-control">Nome: <b><?php echo e($fornecedor->nome_fantasia); ?> | <?php echo e($fornecedor->razao_social); ?> | <?php echo e($fornecedor->endereco_pais); ?></b></span> 
				    <span class="form-control">Responsável: <b><?php echo e($fornecedor->responsavel); ?></b> | e-Mail: <b><?php echo e($fornecedor->email); ?></b></span>
			 	</div>	
		</div>
		<div class="form-group col-md-12">	
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			            <table class="table table-hover">
			                <tr>
			                    <th>SKU: </th>
			                    <th>Produto: </th>
			                    <th>Quantidade: </th>
			                    <th>Preço: </th>
			                    <th>Preço <br> Frete: </th>
			                    <th>Tipo <br> de Frete: </th>
			                    <th>Moeda: </th>			                    
			                    <th>Salvar: </th>
			                </tr>
			                <form method="POST" action="<?php echo e(url('orcamento/fornecedorUpdate')); ?>" id="orcamento_salvar">

			                	<?php echo csrf_field(); ?>			                	

			                	<input type="hidden" name="token" value="<?php echo e($orcamento->token); ?>">

				                <?php $__empty_1 = true; $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

				                <input type="hidden" name="id[]" value="<?php echo e($item->item_id); ?>">

				                <tr>
				                	<td>
				                		<a target="_blank" href="<?php echo e($item->link_referencia); ?>"><?php echo e($item->sku); ?></a>
				                	</td>
				                    <td style="width:40%;">
				                    	<a target="_blank" href="<?php echo e($item->link_referencia); ?>"><?php echo e($item->titulo); ?></a>
				                    </td>
				                    <td>
				                    	<a target="_blank" href="<?php echo e($item->link_referencia); ?>"><?php echo e($item->quantidade); ?> <?php echo e($item->unidade_medida); ?></a>
				                    </td>				                
				                    <td> 
				                    	<input class="form-control" type="number" step="0.01" name="preco[]" value="<?php echo e($item->preco); ?>" size="1">
				                    </td>
				                    <td> 
				                    	<input class="form-control" type="number" step="0.01" name="frete_preco[]" value="<?php echo e($item->frete_preco); ?>" size="1">
				                    </td>
				                    <td style="width:10%;"> 
				                    	<input class="form-control" type="text" name="frete_tipo[]" value="<?php echo e($item->frete_tipo); ?>" size="1">
				                    </td>
				                    <td> 
				                    	 <select name="moeda[]" class="form-control" data-placeholder="Moeda" style="width: 80px;">
							                	<option selected="selected" value="<?php echo e($item->moeda); ?>"><?php echo e($item->moeda); ?></option>
								                <?php $__empty_2 = true; $__currentLoopData = $moedas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moeda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
								                    <option value="<?php echo e($moeda); ?>">
								                        <?php echo e($moeda); ?>

								                    </option>
								                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
								                    <option>Nenhuma Opção</option>     
								                <?php endif; ?>
							                      
							        	</select>
				                    </td>
				                    <td>
				                    	<button class="btn btn-success btn-xs" type="submit" form="orcamento_salvar" value="Salvar"> <i class="fa fa-save"></i> Salvar</button>
				                    </td>
				                    
				                </tr>                
				                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

				                <tr>
				                    <td><b>Nenhum Resultado.</b></td>
				                </tr>
				                    
				                <?php endif; ?>
				            </form>  

			                    
			                
			            </table>
			        </div>
			        <!-- /.box-body -->
		</div>

		<hr class="hr">
			
		<button class="btn btn-success" type="submit" form="orcamento_salvar" value="Salvar"> <i class="fa fa-save"></i> Salvar</button>

		<a href="<?php echo e(url('orcamento/fornecedorFinalizar/'.$orcamento->token)); ?>" class="btn btn-primary"><i class="fa fa-check"></i> Finalizar Orçamento</a>
		
		
	<?php $__env->stopSection(); ?>
<?php else: ?>

	<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-bane"></i> Erro!</h4>
        <h1>Orçamento Finalizado</h1>
    </div>

<?php endif; ?>


<?php echo $__env->make('layouts.nologin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>