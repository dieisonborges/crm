@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <div class="col-md-12">  

            <h1>
                <i class="fa fa-warehouse"></i> 
                Encomendar Produto:
                <small>{{$produto->name}}</small>
            </h1>  

            <br>
            <a href="{{$armazem->store_url.'/products/'.$produto->slug}}" target="_blank" class="btn btn-lg btn-primary"><i class="fa fa-eye"></i> Ver Produto</a> 
            <br>

            <form method="POST" enctype="multipart/form-data" action="{{action('AssinanteController@encomendaStore',$armazem->id)}}">
                @csrf

                <input type="hidden" name="produto" value="{{$produto->id}}">

                <div class="form-group mb-12">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="" placeholder="Digite a quantidade..." required>
                </div>


                <div>
                    <hr>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Confirmar Pedido de Produto</button>
            </form>
            
            
            <br>
            <a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>

        

    @endsection
@endcan
