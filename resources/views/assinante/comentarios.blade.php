@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <div class="col-md-12">  

            <h1>
                <i class="fa fa-comment-dots"></i> 
                Comentários:
                <small>{{$produto->name}}</small>
            </h1> 

            <div class="col-md-3">

            @php $i=0; @endphp
                @foreach($produto->images as $image)

                    @if($i<=0)
                        <a href="{{$image->src}}" data-toggle="lightbox" data-gallery="hidden-images{{$produto->id}}" class="col-4">
                            <img src="{{$image->src}}" class="img-fluid" width="100%">
                        </a> 
                    @endif

                    <div data-toggle="lightbox" data-gallery="hidden-images{{$produto->id}}" data-remote="{{$image->src}}" data-title="{{$produto->name}} {{$i}}"></div>

                    @php $i++; @endphp
                @endforeach
                
            </div>

            <div class="col-md-9">

                <br><br>
                <p>{{$produto->name}}</p>
                <p><b>SKU:</b>{{$produto->sku}}</p>
                <p><b>Estoque:</b>{{$produto->stock_quantity}}</p>
                <p>
                    @if(is_numeric($produto->weight))
                        <b>Peso:</b>{{$produto->weight}}g
                    @else
                        Sem Info de Peso.
                    @endif

                </p>
                <p><b>Valor(USD):</b>${{$produto->price}}</p>
                <p><b>Valor Regular(USD):</b>${{$produto->regular_price}}</p>
                <p><b>Valor com Desconto(USD):</b>${{$produto->sale_price}}</p>
                

            </div>
          

            <div class="col-md-12">

                <div class="box-body table-responsive no-padding">

                    <div class="box-header">
                        <a href="{{url('/assinante/'.$armazem->id.'/produto/'.$produto->id.'/comentarioCreate')}}" class="btn btn-primary btn-lg" style="float: right;">
                            <i class="fa fa-comments"></i>
                            Comentar
                        </a> 
                    </div>
                  
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Data</th>
                                <th>Nome</th>
                                <th>Comentário</th>
                                <th>Classificação</th>                                
                            </tr>
                            @foreach($produto_reviews as $produto_review)
                            <tr>
                                <td>{{date("d/m/Y H:i:s", strtotime($produto_review->date_created))}}</td>
                                <td>{{$produto_review->reviewer}}</td>
                                <td>{!!html_entity_decode($produto_review->review)!!}</td>
                                <td>
                                    @for ($i = 0; $i < $produto_review->rating; $i++)
                                        <i class="fa fa-star text-green"></i>
                                    @endfor
                                </td>                     
                            </tr>                        
                            @endforeach          
                            
                        </table>
                    </div>
                    <!-- /.box-body -->

                           
                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <hr class="col-md-12 hr">
            
            <a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>

    @endsection
@endcan
