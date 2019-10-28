@can('read_carteira')    
    @extends('layouts.app')
    @section('title', 'Carteira')
    @section('content')    
    <h1>Carteira: <small>{{$user->name}}</small></h1>   

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
                        <label class="btn btn-lg btn-default">@moneyBRL($cambio_atual)</label>
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
                        <label class="btn btn-lg btn-default">@moneyBRL($vets)</label>
                    </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>     
            <!-- /.col -->  

        </div>    
        
        <div class="box-header">
            <h3 class="box-title">Transações Financeiras</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Saldo</th>
                    <th>Status</th>
                    <th>Ticket</th>
                </tr>
                @forelse ($carteiras as $carteira)
                    <tr>
                        <td>#{{$carteira->id}}</td>
                        <td>
                        @if (($carteira->valor)<0)                       
                            <i class="fa fa-arrow-down" style="color: #ca6048;"></i>
                             - Saída
                        @elseif (($carteira->valor)>0)  
                            <i class="fa fa-arrow-up" style="color: #32CD32;"></i>
                             - Entrada
                        @else
                            <i class="fa fa-circle" style="color: #87CEEB;"></i> - Info
                        @endif
                        </td>
                        <td>{{$carteira->descricao}}</td>
                        <td>@moneyBRL($carteira->valor)</td>
                        <td>{{$carteira->saldo}}</td>
                        <td>{{$carteira->status}}</td>
                        <td>--</td>  
                    </tr>
                
                               
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$carteiras->links()}}

    @endsection
@endcan
