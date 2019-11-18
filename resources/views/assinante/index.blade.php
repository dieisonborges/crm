@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content') 

    


    <h1> <i class="fa fa-warehouse"></i> Armazéns </h1>

    <hr class="col-md-11 hr">
    
    <div class="col-md-12">
            
        @php $i=1; @endphp
        @forelse ($armazems as $armazem)


        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box widget-user-2 box-solid box-primary box-solid">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/armazem/armazem-'.$i.'.jpg')}}" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <a href="{{URL::to('assinante/'.$armazem->id.'/produtosBusca/1')}}" class="btn btn-default btn-lg" style="float: right;"><i class="fa fa-box"></i> Produtos</a>
              <h3 class="widget-user-username">{{str_replace("https://","",$armazem->store_url)}}</h3>
              <h5 class="widget-user-desc">{{$armazem->localizacao}}</h5>

            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li>
                    <a href="{{$armazem->store_url}}" target="_blank"> 
                        Status:
                        @if($armazem->status)
                            <span class="pull-right badge bg-green">Ativo</span>
                        @else
                            <span class="pull-right badge bg-red">Desativado</span>
                        @endif

                    </a>
                </li>
                <li>
                    <a href="#">Localização: <span class="pull-right badge bg-aqua">{{$armazem->localizacao}}</span></a>
                </li>
                <li>
                    <a href="#">Tipo:

                    @if($armazem->tipo==0)
                    <span class="pull-right badge bg-blue"> Revenda (Estoque de Terceiros)</span>
                    @elseif($armazem->tipo==1)
                    <span class="pull-right badge bg-blue">Fulfillment (Estoque Próprio Internacional)</span>
                    @elseif($armazem->tipo==2)
                    <span class="pull-right badge bg-blue">Fulfillment (Estoque Próprio Nacional)</span>
                    @elseif($armazem->tipo==3)
                    <span class="pull-right badge bg-blue">Armazém Próprio Nacional</span>
                    @endif
                    </a>
                </li>
                <li>
                    <a href="{{$armazem->store_url}}" target="_blank">Ver na Loja: <span class="pull-right badge bg-puple">{{$armazem->store_url}}</span></a>
                </li>
                
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>              

              

              @php 

              $i++; 
              if($i>4){
                $i=1;
              }
              @endphp              
        @empty
            
        @endforelse            
                
    
    </div>

    <hr class="col-md-12 hr">

        <h1>  <small><i class="fa fa-warehouse"></i> Armazém:</small> {{str_replace("https://","",$armazem_preview->store_url)}}</h1>

        <hr class="col-md-11 hr">

    
        @forelse ($produtos as $produto)                

        <div class="col-md-3">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{str_limit($produto->name, 50, '...')}}</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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

                @if(($armazem_preview->tipo)==0)
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
                @elseif(($armazem_preview->tipo)==1)

                    <a href="{{url('assinante/'.$armazem->id.'/produto/'.$produto->id.'/encomendaCreate')}}" class="btn btn-lg btn-primary">
                        <span class="fa fa-industry"></span>
                       Eu quero Encomendar
                    </a>

                @endif

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
                        
                        $ {{number_format(((((80*($produto->weight)+25)*$cambio_cny)/($cambio_usd))),2)}}
                        
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
                        
                        R$ {{number_format(((((80*($produto->weight)+25)*$cambio_cny))),2)}}
                        
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
                    Ver na Store
                </a>                                 

                
                @if(($armazem_preview->tipo)==1)
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

        
        @empty

            Nenhum Resultado.
                
        @endforelse 
        

    @endsection
@endcan
