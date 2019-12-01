@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')  

    <div class="col-md-12">
        
    @forelse ($armazems as $armazem_top)

        <div class="col-md-2">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-warehouse"></i> {{strtoupper(str_replace(".ecardume.com","",(str_replace("https://","",$armazem_top->store_url))))}}</h3>

              @if(($armazem_top->tipo==1)or($armazem_top->tipo==2))
              <span class="label label-default label-xs" style="float: right;">Encomenda</span>
              @endif
              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{$armazem_top->localizacao}}
              <a href="{{URL::to('assinante/'.$armazem_top->id.'/produtosBusca/1')}}" class="btn btn-default btn-xs" style="float: right;"><i class="fa fa-box"></i> Produtos</a>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
                      
    @empty
        
    @endforelse            
                
    
    </div>          

    <div class="col-md-12">

        <h1>
            <i class="fa fa-warehouse"></i> 
            <small>Produtos do Armazém:</small>
            {{str_replace("https://","",$armazem->store_url)}}
        </h1>   


            <form method="GET" enctype="multipart/form-data" action="{{url('/assinante/'.$armazem->id.'/produtosBusca/1')}}">
                <div class="input-group input-group-lg">            
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="{{ $busca ?? '' }}">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
        <br>

        
        @php $j=1; @endphp
        @forelse ($produtos as $produto)

        

        <div class="col-md-3">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{str_limit($produto->name, 50, '...')}}</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <!--
                <a href="#" class="btn btn-default">
                    <i class="fa fa-comments-dollar"></i>
                    Interesses
                </a>
                -->

                <a href="{{url('/assinante/'.$armazem->id.'/produto/'.$produto->id.'/comentarios')}}" class="btn btn-primary">
                    <i class="fa fa-comment-dots"></i>
                    Comentários
                </a>
                <br><br>

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

                <hr class="col-md-11 hr">

                    @if(($armazem->tipo)==0)
                        @if($produto->stock_quantity>1)
                            <a href="{{url('assinante/'.$armazem->id.'/produto/'.$produto->id.'/vendaCreate')}}" class="btn btn-lg btn-success">
                                <i class="fa fa-shopping-cart"></i> Comprar: 

                                @if(is_numeric($produto->sale_price))
                                    R$ {{number_format(($produto->sale_price)*($cambio_usd),2)}}
                                @else 
                                    @php
                                    $price = (double) $produto->price;
                                    echo "R$ ".number_format($price*$cambio_usd, 2);
                                    @endphp
                                @endif
                            </a>
                        @else
                            <span class="btn btn-lg btn-warning">
                                <i class="fa fa-boxes"></i>
                                Sem Estoque.
                            </span>
                        @endif
                    @elseif(($armazem->tipo)==1)

                        <a href="{{url('assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')}}" class="btn btn-lg btn-primary">
                            <span class="fa fa-industry"></span>
                           Encomendar por

                            @if(is_numeric($produto->sale_price))
                                R$ {{number_format(($produto->sale_price)*($cambio_usd),2)}}
                            @else 
                                @php
                                $price = (double) $produto->price;
                                echo "R$ ".number_format($price*$cambio_usd, 2);
                                @endphp
                            @endif
                        </a>

                    @endif

                
                <p><br></p>
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
                <p>
                    <b>Frete (USD):</b>
                    @if(is_numeric($produto->weight))
                    <a href="{{url('assinante/'.$armazem->id.'/produto/'.$produto->id.'/freteEstimado')}}" class="btn btn-xs btn-info">
                        <span class="fa fa-truck"></span>

                        $ {{number_format((App\Http\Controllers\AssinanteController::getFrete($produto->weight, '1', $cambio_cny)/$cambio_usd),2)}} 
                        
                    </a>
                    @else
                        Sem Info de Peso.
                    @endif

                </p>
                <p>
                    <b>Frete (BRL):</b>
                    @if(is_numeric($produto->weight))
                    <a href="{{url('assinante/'.$armazem->id.'/produto/'.$produto->id.'/freteEstimado')}}" class="btn btn-xs btn-info">
                        <span class="fa fa-truck"></span>
                        
                        R$ {{number_format(App\Http\Controllers\AssinanteController::getFrete($produto->weight, '1', $cambio_cny),2)}} 
                        
                    </a>
                    @else
                        Sem Info de Peso.
                    @endif

                </p>


                <!-- Status do Produto -->
                @if($produto->status=='publish')
                        <span class="btn btn-xs btn-success">Status: Publicado</span>
                    @elseif($produto->status=='pending')
                        <span class="btn btn-xs btn-warning">Status: Em Revisão</span>
                    @elseif($produto->status=='draft')
                        <span class="btn btn-xs btn-danger">Status: Rascunho</span>
                    @else
                        <span class="btn btn-xs btn-info">Status: {{$produto->status}}</span>
                    @endif

                <!-- Tipo de Produto -->
                @if($produto->type=='simple')
                        <span class="btn btn-xs btn-success">Produto Simples</span>
                @elseif($produto->type=='variable')
                    <span class="btn btn-xs btn-info">Produto Variável</span>                        
                @else
                    <span class="btn btn-xs btn-default">{{$produto->type}}</span>
                @endif   

                <a href="{{$armazem->store_url.'/produto/'.$produto->slug}}" class="btn btn-xs btn-info" target="_blank">
                    <span class="fa fa-eye"></span>
                    Ver na Store (Loja)
                </a>              

                
                @if(($armazem->tipo)==1)
                    <hr class="col-md-11 hr"> 
                    <p><b>Encomendas:</b>
                    {{$encomenda_quantidade[$produto->id] ?? '0'}}un
                    </p>
                    <p><b>MOQ: </b>                                           
                    @foreach(($produto->attributes) as $attribute)
                        @if($attribute->name=='MOQ')
                            @foreach(($attribute->options) as $option)
                                {{$option}}un
                            @endforeach
                        @endif                           
                    @endforeach 
                    (Minimal Order Quantities)
                    </p>
                    <a href="{{url('assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')}}" class="btn btn-sm btn-primary">
                        <span class="fa fa-industry"></span>
                       Eu quero Encomendar
                    </a>

                @endif

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->   

        @if(($j%4)==0)

            <hr class="col-md-12 hr">

        @endif


        @php $j++; @endphp
        @empty

            Nenhum Resultado.
                
        @endforelse 

    </div>

    @include('layouts/paginatewc')
 

    
    
    
    <a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
 

        

    @endsection
@endcan
