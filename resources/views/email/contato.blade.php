@extends('layouts.nologin')
@section('content')

	<div class="row">
		<h4 class="mb-3">Contato CRM e-Cardume (Bugs)</h4>
		<table class="table table-bordered">
		  <tbody>
		  	<tr>
		      <td><h1>e-Cardume CRM (Bugs)</h1></td>
		      <td><h3>Relcaionamento e Gestão e-Cardume</h3></td>
		    </tr>
		    <tr>
		      <td><strong>Nome:</strong></td>
		      <td>{{$nome}}</td>
		    </tr>
		    <tr>
		      <td><strong>Email:</strong></td>
		      <td>{{$email}}</td>
		    </tr>
		    <tr>
		      <td><strong>Assunto:</strong></td>
		      <td>{{$assunto}}</td>
		    </tr>
		    <tr>
		      <td><strong>Mensagem:</strong></td>
		      <td>{{$msg}}</td>
		    </tr>
		    <tr>
		    </tr>
		  </tbody>
		</table>
	</div>
	
@endsection