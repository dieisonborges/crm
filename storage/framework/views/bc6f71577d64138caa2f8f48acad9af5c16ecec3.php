<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_orcamento')): ?>  
	
	<?php $__env->startSection('title', $orcamento->name); ?>
	<?php $__env->startSection('content'); ?>
		<h1>
	        Orcamento 

	        <?php if($orcamento->status==0): ?>
                <span class="btn btn-primary btn-xs">Em edição</span> 
            <?php elseif($orcamento->status==1): ?>
                <span class="btn btn-warning btn-xs">Bloqueado: Enviado para cotação</span> 
            <?php elseif($orcamento->status==2): ?>
                <span class="btn btn-danger btn-xs">Cancelado</span> 
            <?php else: ?>
                <span class="btn btn-success btn-xs">Cotação Finalizada</span> 
            <?php endif; ?>


	    </h1>
	    <h2>
	        <small>Código: <b><?php echo e($orcamento->codigo); ?></b></small>
	        		<?php if(($orcamento->status)==0): ?>
		        		<a href="<?php echo e($orcamento->id); ?>/item" class="btn btn-primary">
		        			<i class="fa fa-plus"></i> Adicionar Item
		        		</a>
		        	    <a href="<?php echo e($orcamento->id); ?>/edit" class="btn btn-warning">
		        	    	<i class="fa fa-edit"></i> Editar
		        	    </a>
		        	<?php endif; ?>

		        	<?php if(($orcamento->status==0)or($orcamento->status==1)): ?>
	        	    <a href="<?php echo e(URL::to('orcamento')); ?>/<?php echo e($orcamento->id); ?>/enviar" class="btn btn-danger">
                        <i class="fa fa-paper-plane"> Enviar</i>                       
                    </a>
                    <?php endif; ?>

	    </h2> 
		<div class="row">		
				
			 	<div class="form-group col-md-2">
				    <label for="token_validade">Validade do Token:</label>
				    <span class="form-control" ><?php echo e(date('d/m/Y', strtotime($orcamento->token_validade))); ?></span>
				    <br>
				    <a href="<?php echo e(url('fornecedor/'.$fornecedor->id)); ?>" class="btn btn-primary"><i class="fa fa-truck"></i> Ver Fonecedor</a>
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
			                    <th>ID</th>
			                    <th>Produto</th>
			                    <th>Quantidade</th>
			                    <th>Preço</th>
			                    <th>Preço Frete</th>
			                    <th>Tipo de Frete</th>
			                    <th>Modificar</th>			                    
			                    <th>Remover</th>
			                </tr>
			                <?php $__empty_1 = true; $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			                <tr>
			                    <td><?php echo e($item->item_id); ?></td>
			                    <td><a href="<?php echo e(URL::to('produtos')); ?>/<?php echo e($item->id); ?>"><?php echo e($item->titulo); ?> 
			                    <td><a href="<?php echo e(URL::to('item')); ?>/<?php echo e($item->item_id); ?>"><?php echo e($item->quantidade); ?> <?php echo e($item->unidade_medida); ?></a></td>
			                    <td><a href="<?php echo e(URL::to('item')); ?>/<?php echo e($item->item_id); ?>"><?php echo e($item->preco); ?></a></td>
			                    <td><a href="<?php echo e(URL::to('item')); ?>/<?php echo e($item->item_id); ?>"><?php echo e($item->frete_preco); ?></a></td>
			                    <td><a href="<?php echo e(URL::to('item')); ?>/<?php echo e($item->item_id); ?>"><?php echo e($item->frete_tipo); ?></a></td>
			                    <td>
			                    	<?php if(($orcamento->status)==0): ?>
			                        	<a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('orcamento/'.$item->item_id.'/itemEdit')); ?>"><i class="fa fa-edit"></i> Editar</a>
			                        <?php else: ?>
			                            <span class="btn btn-warning btn-xs">Bloqueado</span>
			                        <?php endif; ?>
			                    </td>
			                    <td>	

			                    	<?php if(($orcamento->status)==0): ?>	                    	

			                        <form method="POST" action="<?php echo e(action('OrcamentoController@itemDestroy', $item->item_id)); ?>" id="formDelete<?php echo e($item->item_id); ?>">
			                            <?php echo csrf_field(); ?>
			                            <input type="hidden" name="_method" value="DELETE">
			                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
			                            <!--<input type="submit" name="Excluir">-->

			                            <a href="javascript:confirmDelete<?php echo e($item->item_id); ?>();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Remover</a>
			                        </form> 

			                        <script>
			                           function confirmDelete<?php echo e($item->item_id); ?>() {

			                            var result = confirm('Tem certeza que deseja remover?');

			                            if (result) {
			                                    document.getElementById("formDelete<?php echo e($item->item_id); ?>").submit();
			                                } else {
			                                    return false;
			                                }
			                            } 
			                        </script>

			                        <?php else: ?>
			                            <span class="btn btn-warning btn-xs">Bloqueado</span>
			                        <?php endif; ?>

			                    </td>
			                </tr>                
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

			                <tr>
			                    <td><b>Nenhum Resultado.</b></td>
			                </tr>
			                    
			                <?php endif; ?>      

			                    
			                
			            </table>
			        </div>
			        <!-- /.box-body -->
		</div>

		<hr class="hr">
		<?php if(($orcamento->status)==0): ?>	
			<a href="<?php echo e($orcamento->id); ?>/edit" class="btn btn-warning">Editar</a>
		<?php endif; ?>		
		
			<a href="javascript:history.go(-1)" class="btn btn-success">Voltar</a>

		<?php if(($orcamento->status)!=2): ?>	
			<a href="<?php echo e($orcamento->id); ?>/cancelar" class="btn btn-danger" style="float: right;">Cancelar Orçamento</a>
		<?php endif; ?>
	<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>