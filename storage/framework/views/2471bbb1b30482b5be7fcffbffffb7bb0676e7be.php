<?php $__env->startSection('title', 'Nova Upload'); ?>
<?php $__env->startSection('content'); ?>
		<h1>
	        Galeria de Imagens
	        <small><?php echo e($produto->titulo); ?> <b><?php echo e($produto->sku); ?></b></small>
	    </h1>
		

		<form action="<?php echo e(url('produtos')); ?>/imagemUpdate" method="POST" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id" value="<?php echo e($produto->id); ?>">	

		 	<div class="form-group mb-12">
			    <label for="file" >Nova Imagem: </label>
			    <input type="file" name="file" required="required" accept="image/*|application/pdf">
			    <span style="font-size: 15px; color: red;">Arquivos suportados: <b>jpeg, png, jpg</b></span>
		 	</div>
		 	
    		<button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Enviar</button>
		 	

		 	<div>
		 		<hr class="hr col-md-12">
		 	</div>

                <a class="btn btn-primary" href="javascript:history.go(-1)">
                    <i class="fa fa-arrow-left"></i> Voltar
                </a>

                <a class="btn btn-primary" href="<?php echo e(url('produtos/'.$produto->id)); ?>">
                    <i class="fa fa-shopping-cart"></i> Produto
                </a>

                <a class="btn btn-primary" href="produtos/">
                    <i class="fa fa-list-alt"></i> Lista de Produtos
                </a>


		 	<div>
		 		<hr class="hr col-md-12">
		 	</div>

		 	
		</form>

        <section class="content">

        <div class="form-group col-md-12">
            <div class="box-header">
            <h3 class="box-title">Imagem Principal: </h3>
                        
            </div>
            <!-- /.box-header -->
            <div class="box box-warning">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th></th>
                            <th>Imagem Princpal</th>
                            <th>Link</th>
                            <th>Titulo</th>
                            <th>Nome</th>
                            <th>Tamanho</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Ver</th>
                        </tr>
                        <?php if($imagem_principal): ?>
                        <tr class="border-yellow text-white">
                            <td><br><span class="btn btn-warning"><i class="fa fa-star"></i></span></td>
                            <td>
                                <img src="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" width="150px">
                            </td>
                            <td><a href="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" target="_blank"><?php echo e($imagem_principal->link); ?></a> </td>
                            <td><a href="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" target="_blank"><?php echo e($imagem_principal->titulo); ?></a></td>
                            <td><a href="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" target="_blank"><?php echo e($imagem_principal->nome); ?></a></td>
                            <td><a href="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" target="_blank"><?php echo e(number_format(($imagem_principal->tam/1000), 2, ',', '')); ?> kbytes</a></td>
                            <td><a href="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" target="_blank"><?php echo e($imagem_principal->tipo); ?></a></td>
                            <td><a href="<?php echo e(url('produtos/'.$produto->id.'/imagemValor/'.$imagem_principal->id)); ?>" class="btn btn-info"><i class="fa fa-edit"></i> <?php echo e($imagem_principal->valor); ?></a></td> 
                            <td><a href="<?php echo e(url('storage/'.$imagem_principal->dir.'/'.$imagem_principal->link)); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Visualizar</a></td>                        
                        </tr>                
                        <?php else: ?>

                        <tr>
                            <td>
                                <span class="btn btn-primary">
                                    <i class="fa fa-image"></i>
                                     Nenhuma imagem PRINCIPAL para este produto.
                                </span>
                            </td>
                            
                        </tr>
                            
                        <?php endif; ?>            
                        
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        
        </div>

    </section>


		<section class="content">

        <div class="form-group col-md-12">
            <div class="box-header">
            <h3 class="box-title">Galeria de Imagens: </h3>
                        
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                    	<th>Imagem</th>
                        <th>Link</th>
                        <th>Titulo</th>
                        <th>Tamanho</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Principal</th>
                        <th>Ver</th>
                        <th>Excluir</th>
                    </tr>
                    <?php $__empty_1 = true; $__currentLoopData = $imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                    	<td>
                    		<img src="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" width="150px">
                    	</td>
                        <td><a href="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" target="_blank"><?php echo e($imagem->link); ?></a> </td>
                        <td><a href="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" target="_blank"><?php echo e($imagem->titulo); ?></a></td>                        
                        <td><a href="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" target="_blank"><?php echo e(number_format(($imagem->tam/1000), 2, ',', '')); ?> kbytes</a></td>
                        <td><a href="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" target="_blank"><?php echo e($imagem->tipo); ?></a></td>

                        <td><a href="<?php echo e(url('produtos/'.$produto->id.'/imagemValor/'.$imagem->id)); ?>" class="btn btn-info"><i class="fa fa-edit"></i> <?php echo e($imagem->valor); ?></a></td> 

                        <td><a href="<?php echo e(url('produtos/imagemPrincipal/'.$imagem->id.'/'.$produto->id)); ?>" class="btn btn-primary"><i class="fa fa-star"></i></a></td> 

                        <td><a href="<?php echo e(url('storage/'.$imagem->dir.'/'.$imagem->link)); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Visualizar</a></td>                       

                        <td>
                            <form method="POST" action="<?php echo e(url('produtos/imagemDestroy', $imagem->id)); ?>" id="formDelete<?php echo e($imagem->id); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($imagem->id); ?>">

                                <input type="hidden" name="produto_id" value="<?php echo e($produto->id); ?>">                                

                                <a href="javascript:confirmDelete<?php echo e($imagem->id); ?>();" class="btn btn-danger"> <i class="fa fa-times"></i></a>
                            </form> 

                            <script>
                               function confirmDelete<?php echo e($imagem->id); ?>() {

                                var result = confirm('Tem certeza que deseja excluir?');

                                if (result) {
                                        document.getElementById("formDelete<?php echo e($imagem->id); ?>").submit();
                                    } else {
                                        return false;
                                    }
                                } 
                            </script>

                        </td>      
                        
                    </tr>                
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td>
                            <span class="btn btn-primary">
                                <i class="fa fa-image"></i>
                                 Nenhuma imagem cadastrada para este produto.
                            </span>
                        </td>
                        
                    </tr>
                        
                    <?php endif; ?>            
                    
                </table>
            </div>
            <!-- /.box-body -->
        
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>