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
                    <span class="pull-right badge bg-blue">Encomendas<!--Fulfillment (Estoque Próprio Internacional)--></span>
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
    

    @endsection
@endcan
