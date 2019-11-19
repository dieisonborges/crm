@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <div class="col-md-12">  

            <h1>
                <i class="fa fa-warehouse"></i> 
                Comprar Produto:
                <small>{{$produto->name}}</small>
            </h1> 

        <div class="col-md-9"> 
            <div class="col-md-12">  

                <form method="POST" enctype="multipart/form-data" action="{{action('AssinanteController@vendaStore',$armazem->id)}}">
                    @csrf

                    <input type="hidden" name="produto" value="{{$produto->id}}">

                    <div class="form-group mb-12">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="" placeholder="Digite a quantidade..." required>
                    </div>


                    @if($produto_variacoes)
                    <div class="form-group mb-12">
                        <label for="produto_variacao">Opções:</label>
                        <select name="produto_variacao"  class="form-control" >
                        @foreach($produto_variacoes as $produto_variacao)                        
                            <option value="{{$produto_variacao->id}}">
                                {{$produto_variacao->description}}
                                @foreach($produto_variacao->attributes as $attribute)
                                    {{$attribute->name}} - {{$attribute->option}}
                                @endforeach
                            </option> 
                        @endforeach
                        </select>
                    </div>
                    @endif

                                   
                    

                    <div>
                        <hr>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Confirmar Compra de Produto</button>
                </form>

            </div>

            <div class="col-md-12">

                <br>

                <div class="box-body table-responsive no-padding">

                    

                    <div class="box-header">
                        <h3 class="box-title">Tabela de Frete Estimado</h3>
                    
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Quantidade</th>
                                <th>Valor BRL</th>
                                <th>Valor USD</th>
                                                    
                            </tr>
                            @php $i=1; @endphp
                            @while($i<=15)
                                <tr>
                                    <td>{{$i}} un</td>
                                    <td>R$ {{number_format(((80*($produto->weight*$i)+25)*$cambio_cny),2)}}</td>
                                    <td>$ {{number_format(((((80*($produto->weight*$i)+25)*$cambio_cny)/($cambio_usd))),2)}}</td>                     
                                </tr>                        
                                @php $i++; @endphp 
                            @endwhile           
                            
                        </table>
                    </div>
                    <!-- /.box-body -->

                           
                </div>
                <!-- /.box-body -->
            </div>
        </div>

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

                        <a href="{{$armazem->store_url.'/produto/'.$produto->slug}}" class="btn btn-xs btn-info" target="_blank">
                            <span class="fa fa-eye"></span>
                            Ver na Store
                        </a>                        

                        <span class="btn btn-lg btn-success" target="_blank">

                            <i class="fa fa-shopping-cart"></i> Valor: 

                            @if(is_numeric($produto->sale_price))
                                R$ {{number_format(($produto->sale_price)*($cambio_usd),2)}}
                            @else 
                                @php
                                $price = (double) $produto->price;
                                echo "R$ ".number_format($price*$cambio_usd, 2);
                                @endphp
                            @endif

                        </span>

                        <p><b>SKU:</b>{{$produto->sku}}</p>
                        <p><b>Estoque:</b>{{$produto->stock_quantity}}</p>
                        <p><b>Peso:</b>{{$produto->weight}}g</p>
                        <p><b>Valor(USD):</b>${{$produto->price}}</p>
                        <p><b>Valor Regular(USD):</b>${{$produto->regular_price}}</p>
                        <p><b>Valor com Desconto(USD):</b>${{$produto->sale_price}}</p>
                        <p>
                            <b>Frete (USD):</b>
                            @if(isset($produto->weight))
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
                            @if(isset($produto->weight))
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

                        
                        

                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col --> 
            
            

        </div>

        <hr class="col-md-12 hr">
            
            <a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>

    @endsection
@endcan
