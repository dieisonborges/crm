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
                    <th>Código</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <!--<th>Saldo</th>-->
                    <th>Status</th>
                    <th>Ticket</th>
                    <th colspan="2">Operação</th>
                </tr>
                @forelse ($carteiras as $carteira)
                    <tr>
                        <td>{{$carteira->id}}</td>
                        <td>#{{$carteira->codigo}}</td>
                        <td>@datetimeBRL($carteira->created_at)</td>
                        <td>
                        @if (($carteira->valor)<0)                       
                            <i class="fa fa-arrow-down" style="color: #ca6048;"></i>
                             Crédito
                        @elseif (($carteira->valor)>0)  
                            <i class="fa fa-arrow-up" style="color: #32CD32;"></i>
                             Débito
                        @else
                            <i class="fa fa-circle" style="color: #87CEEB;"></i> - Info
                        @endif
                        </td>
                        <td>{{$carteira->descricao}}</td>
                        <td>@moneyBRL($carteira->valor)</td>
                        <!--<td>@moneyBRL($carteira->saldo)</td>-->
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
                                <a href="{{url('atendimentos/financeiro/'.$carteira->tickets()->first()->id.'/show')}}"> {{$carteira->tickets()->first()->protocolo}}
                                </a>
                            @else
                                Nenhum Ticket
                            @endif
                        </td> 

                        <td>

                            <form method="POST" action="{{action('CarteiraController@status')}}" id="formRecebido{{$carteira->id}}">
                                @csrf

                                <input type="hidden" name="id" value="{{$carteira->id}}">

                                <input type="hidden" name="user_id" value="{{$user->id}}">

                                <input type="hidden" name="status" value="3">                            

                                <a href="javascript:confirmRecebido{{$carteira->id}}();" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i></a>
                            </form> 

                            <script>
                               function confirmRecebido{{$carteira->id}}() {

                                var result = confirm('Tem certeza que deseja confirmar o recebimento do valor?');

                                if (result) {
                                        document.getElementById("formRecebido{{$carteira->id}}").submit();
                                    } else {
                                        return false;
                                    }
                                } 
                            </script>

                        </td>  

                        <td>

                            <form method="POST" action="{{action('CarteiraController@status')}}" id="formCancelado{{$carteira->id}}">
                                @csrf

                                <input type="hidden" name="id" value="{{$carteira->id}}">

                                <input type="hidden" name="user_id" value="{{$user->id}}">

                                <input type="hidden" name="status" value="7">                            

                                <a href="javascript:confirmCancelado{{$carteira->id}}();" class="btn btn-danger btn-sm"> <i class="fa fa-times"></i></a>
                            </form> 

                            <script>
                               function confirmCancelado{{$carteira->id}}() {

                                var result = confirm('Tem certeza que deseja CANCELAR o recebimento do valor?');

                                if (result) {
                                        document.getElementById("formCancelado{{$carteira->id}}").submit();
                                    } else {
                                        return false;
                                    }
                                } 
                            </script>

                        </td>
                    </tr>
                
                               
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$carteiras->links()}}

    @endsection
@endcan
