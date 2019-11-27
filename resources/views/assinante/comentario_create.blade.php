@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <div class="col-md-12">  

            <h1>
                <i class="fa fa-comment-dots"></i> 
                Criar comentário
            </h1> 

        <div class="col-md-9"> 
            <div class="col-md-12">  

                <form method="POST" enctype="multipart/form-data" action="{{action('AssinanteController@comentarioStore',$armazem->id)}}">
                    @csrf

                    <input type="hidden" name="produto" value="{{$produto}}">

                    <div class="form-group">
                      <div class="radio">

                        <label>
                          <input class="form-group" type="radio" name="classificacao" id="classificacao1" value="1" checked>
                          <i class="fa fa-star fa-2x text-green"></i>
                        </label>
                      
                        <label style="margin-left: 15px;">
                          <input class="form-group"  type="radio" name="classificacao" id="classificacao2" value="2">
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                        </label>  

                        <label style="margin-left: 15px;">
                          <input class="form-group"  type="radio" name="classificacao" id="classificacao3" value="3">
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                        </label> 

                        <label style="margin-left: 15px;">
                          <input class="form-group"  type="radio" name="classificacao" id="classificacao4" value="4">
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                        </label> 

                        <label style="margin-left: 15px;">
                          <input class="form-group"  type="radio" name="classificacao" id="classificacao5" value="5">
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                          <i class="fa fa-star fa-2x text-green"></i>
                        </label>                     
                        
                      </div>
                    </div>

                    <div class="form-group mb-12">
                        <label for="comentario">Comentário:</label>
                        <textarea class="form-control" id="comentario" name="comentario" placeholder="Digite o seu comentário..." required style="height: 200px;"></textarea>                        
                    </div>                                 
                    
                    <button type="submit" class="btn btn-success" style="float: right;"><i class="fa fa-save"></i> Confirmar comentário</button>
                </form>

            </div>

            
        </div>
            

    </div>

    <hr class="col-md-12 hr">
            
    <a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>

    @endsection
@endcan
