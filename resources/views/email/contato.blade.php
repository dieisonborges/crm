@extends('layouts.mail')
@section('content')

	<div class="row">
		<h4 class="mb-3">CRM e-Cardume | Relacionamento</h4>
		<table class="table table-bordered">
		  <tbody>
		  	<tr>
		      <td colspan="2"><img src="http://atendimento.ecardume.com.br/img/logo/logo-ecardume.png" width="20%" align="center" alt="e-Cardume"></td>
		    </tr>		    
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <td><strong>Nome:</strong></td>
		      <td>{{$nome}}</td>
		    </tr>
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <td><strong>Email:</strong></td>
		      <td>{{$email}}</td>
		    </tr>
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <td><strong>Assunto:</strong></td>
		      <td>{{$assunto}}</td>
		    </tr>
		    <tr>
		    	<td colspan="2"><br></td>
		    </tr>
		    <tr>
		      <td><strong>Mensagem:</strong></td>
		      <td>{!!html_entity_decode($msg)!!}</td>
		    </tr>
		    <tr>
		    </tr>
		  </tbody>
		</table>
	</div>
	
@endsection