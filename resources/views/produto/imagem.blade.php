@extends('layouts.app')
@section('title', 'Nova Upload')
@section('content')
		<h1>
	        Galeria de Imagens
	        <small>{{ $produto->titulo }} <b>{{ $produto->sku }}</b></small>
	    </h1>
		

		<form action="{{url('produtos')}}/imagemUpdate" method="POST" enctype="multipart/form-data">
			@csrf

			<input type="hidden" name="id" value="{{ $produto->id }}">	

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

                <a class="btn btn-primary" href="{{ url('produtos/'.$produto->id) }}">
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
            <h3 class="box-title">Galeria de Imagens: </h3>
                        
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                    	<th></th>
                        <th>Titulo</th>
                        <th>Nome</th>
                        <th>Tamanho</th>
                        <th>Tipo</th>
                        <th>Ver</th>
                        <th>Excluir</th>
                    </tr>
                    @forelse ($imagens as $imagem)
                    <tr>
                    	<td>
                    		<img src="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" width="150px">
                    	</td>
                        <td><a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" target="_blank">{{ $imagem->link }}</a> </td>
                        <td><a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" target="_blank">{{ $imagem->titulo }}</a></td>
                        <td><a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" target="_blank">{{ $imagem->nome }}</a></td>
                        <td><a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" target="_blank">{{ number_format(($imagem->tam/1000), 2, ',', '') }} kbytes</a></td>
                        <td><a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" target="_blank">{{ $imagem->tipo }}</a></td>
                        <td><a href="{{ url('storage/'.$imagem->dir.'/'.$imagem->link) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Visualizar</a></td>                       

                        <td>
                            <form method="POST" action="{{url('produtos/imagemDestroy', $imagem->id)}}" id="formDelete{{$imagem->id}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$imagem->id}}">

                                <input type="hidden" name="produto_id" value="{{$produto->id}}">                                

                                <a href="javascript:confirmDelete{{$imagem->id}}();" class="btn btn-danger"> <i class="fa fa-close"></i></a>
                            </form> 

                            <script>
                               function confirmDelete{{$imagem->id}}() {

                                var result = confirm('Tem certeza que deseja excluir?');

                                if (result) {
                                        document.getElementById("formDelete{{$imagem->id}}").submit();
                                    } else {
                                        return false;
                                    }
                                } 
                            </script>

                        </td>      
                        
                    </tr>                
                    @empty

                    <tr>
                        <td>
                            <span class="btn btn-primary">
                                <i class="fa fa-image"></i>
                                 Nenhuma imagem cadastrada para este produto.
                            </span>
                        </td>
                        
                    </tr>
                        
                    @endforelse            
                    
                </table>
            </div>
            <!-- /.box-body -->
        
        </div>

    </section>
@endsection