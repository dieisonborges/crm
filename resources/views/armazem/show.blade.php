@can('read_categoria')   
	@extends('layouts.app')
	@section('title', 'Categoria')
	@section('content')
				

		<h1>
		        Categoria 
		        <small>{{$categoria->nome}}</small>
		    </h1>

		    
		    <div class="box-body col-md-4">              
              <div class="callout callout-info">
                <h5>Nome: <b>{{$categoria->nome}}</b></h5>
                <h5>Valor: <span class="btn btn-primary">{{$categoria->valor}}</span></h5>
             </div>
        	</div>

        	<div class="box-body col-md-8">              
              <div class="form-group col-md-12">
				    <label for="descricao">Descrição</label>				    
					<!-- /.box-header -->
		            
		              
		                <span class="form-control" placeholder="Detalhe seu o problema ou solicitação" required="required" name="descricao" 
		                          style="width: 100%; min-height: 230px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$categoria->descricao}}
		              </span>
		            
			 	</div>	
        	</div>

        	<div class="box-body col-md-12">

        		<a href="javascript:history.go(-1)" class="btn btn-info"><i class="fa fa-arrow-left"></i> Voltar</a>

        		<a class="btn btn-warning" href="{{URL::to('categorias/'.$categoria->id.'/edit')}}"><i class="fa fa-edit"></i> Editar</a>

        	</div>

			 	
			 	
		
		
	@endsection
@endcan 