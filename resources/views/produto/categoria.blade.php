@extends('layouts.app')
@section('title', 'Regras')
@section('content')


<h1>Categorias do produto: <b>{{$produto->titulo}}</b></h1>

<form method="POST" action="{{action('ProdutoController@categoriaUpdate')}}" class="form-group col-md-12">
    @csrf
    <input type="hidden" name="produto_id" value="{{$produto->id}}">
    
    <div class="form-group col-md-6">
        <label>Adicionar Categoria:</label>
        <select name="categoria_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione uma ou mais categorias"
                style="width: 100%;" required="required">
                @forelse ($all_categorias as $all_categoria)
                    <option value="{{$all_categoria->id}}">
                        {{$all_categoria->nome}} | {{$all_categoria->descricao}}
                    </option>
                @empty
                    <option>Nenhuma Opção</option>     
                @endforelse
                      
        </select>

    </div>
    <div class="form-group col-md-4">
        <label>Ao Produto:</label>
        <span class="form-control">{{ str_limit($produto->titulo, 45, '...')}}</span>
    </div>
    <div class="form-group col-md-2" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>


<br><br><br>

    @if (session('status'))
        <div class="alert alert-success" produto="alert">
            {{ session('status') }}
        </div>
    @endif

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Categorias do Produto:</h3>        
    </div>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding  col-md-12">

            <div class="form-group col-md-10">
                @forelse ($categorias as $categoria)
                    <div class="col-md-2">
                        <span class="btn btn-primary">{{$categoria->nome}} | {{$categoria->valor}}</span> 
                        <form method="POST" action="{{action('ProdutoController@categoriaDestroy')}}" id="formDeleteP{{$categoria->id}}">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{$produto->id}}">
                            <input type="hidden" name="categoria_id" value="{{$categoria->id}}">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDeleteP{{$categoria->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-window-close"></i> Excluir</a>
                        </form> 

                        <script>
                           function confirmDeleteP{{$categoria->id}}() {

                            var result = confirm('Tem certeza que deseja excluir?');

                            if (result) {
                                    document.getElementById("formDeleteP{{$categoria->id}}").submit();
                              } else {
                                    return false;
                                }
                            } 
                        </script> 
                    </div>           
                @empty
                    <div class="col-md-4">
                        <span class="btn btn-primary btn-xs">Nenhuma Categoria</span>
                    </div>
                @endforelse
            </div>         

    </div>
    <!-- /.box-body -->
   

@endsection
