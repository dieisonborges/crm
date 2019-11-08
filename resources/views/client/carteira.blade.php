 
    @extends('layouts.app')
    @section('title', 'Carteira')
    @section('content')    
    <h1><i class="fa fa-wallet"></i> Carteira: <small>{{$user->name}}</small>
        <a href="{{url('/clients/recarregar')}}" class="btn btn-success" style="float: right;">
            <i class="fa fa-money-check-alt"></i>
            Recarregar
        </a>
    </h1>

        <div class="col-md-12">
            
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon "><i class="fa fa-wallet"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="padding-bottom: 9px;">Saldo Atual:</span>
                    <span class="info-box-number">
                        <label class="btn btn-lg btn-default">@moneyBRL($saldo)</label>
                    </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>     
            <!-- /.col -->      

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon"><i class="fa fa-dollar-sign"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="padding-bottom: 9px;">Cotação do Dólar:</span>
                    <span class="info-box-number">
                        <label class="btn btn-lg btn-default">@moneyBRL($cambio_usd)</label>
                    </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>     
            <!-- /.col -->  

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon"><i class="fa fa-money-check-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="padding-bottom: 9px;">VET (Valor Efetivo Total):</span>

                    <span class="info-box-number">
                        <label class="btn btn-lg btn-default">@moneyBRL($cambio_usd*$vets)</label>
                    </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>     
            <!-- /.col -->  

        </div>

        

        <br>
        
        <div class="box-header">
            <h3 class="box-title">Transações Financeiras</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ticket</th>
                </tr>
                @forelse ($carteiras as $carteira)
                    <tr>
                        <td>{{$carteira->id}}</td>
                        <td>#{{$carteira->codigo}}</td>
                        <td>@datetimeBRL($carteira->created_at)</td>
                        <td>
                        @if (($carteira->valor)<0)                       
                            <i class="fa fa-arrow-down" style="color: #ca6048;"></i>
                             Débito
                        @elseif (($carteira->valor)>0)  
                            <i class="fa fa-arrow-up" style="color: #32CD32;"></i>
                             Crédito
                        @else
                            <i class="fa fa-circle" style="color: #87CEEB;"></i> - Info
                        @endif
                        </td>
                        <td>{{$carteira->descricao}}</td>
                        <td>@moneyBRL($carteira->valor)</td>
                        <td>                            
                            @if (($carteira->status)==3)                       
                                <i class="fa fa-thumbs-up text-green"></i>
                                Recebido
                            @else
                                <i class="fa fa-thumbs-down text-red"></i>
                                Não Recebido <b>#{{$carteira->status}}</b>
                            @endif
                        </td>
                        <td>
                            @if(isset($carteira->tickets()->first()->id))
                                <a href="{{url('clients/'.$carteira->tickets()->first()->id)}}"> {{$carteira->tickets()->first()->protocolo}}
                                </a>
                            @else
                                Nenhum Ticket
                            @endif


                        </td>  
                    </tr>
                
                               
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$carteiras->links()}}

    @endsection

