<?php $__env->startSection('content'); ?>

	<div class="row">
		<table class="table table-bordered">
		  <tbody>
		  	<tr>
		      <td colspan="2"><img src="http://atendimento.ecardume.com.br/img/logo/logo-ecardume.png" width="20%" align="center" alt="e-Cardume"></td>
		    </tr>		    
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <!--<td><strong>Nome:</strong></td>-->
		      <td><?php echo e($nome); ?></td>
		    </tr>
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <!--<td><strong>Email:</strong></td>-->
		      <td><?php echo e($email); ?></td>
		    </tr>
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <!--<td><strong>Assunto:</strong></td>-->
		      <td><?php echo e($assunto); ?></td>
		    </tr>
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <!--<td><strong>Mensagem:</strong></td>-->
		      <td><?php echo html_entity_decode($msg); ?></td>
		    </tr>
		    <tr>
		    </tr>
		  </tbody>
		</table>
	</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>