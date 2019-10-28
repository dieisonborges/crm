@can('read_cambio')    
    @extends('layouts.app')
    @section('title', 'Carteira')
    @section('content')    
    <h1>Câmbio</h1>   

        <div class="col-md-12">           
                 

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon"><i class="fa fa-dollar-sign"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="padding-bottom: 9px;">Cotação do Dólar:</span>
                    <span class="info-box-number">
                        <label class="btn btn-lg btn-default">R$ {{$cambio_atual}}</label>
                        <label class="btn btn-lg btn-default"><b>Arredondado:</b> @moneyBRL($cambio_atual)</label>
                        
                        
                    </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>     
            <!-- /.col -->  

            <div class="col-md-6 col-sm-6 col-xs-12">
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
            <h3 class="box-title">Atualizações de Câmbio</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Valor Arredondado</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Moeda</th>
                </tr>
                @forelse ($cambios as $cambio)
                    <tr>
                        <td>{{$cambio->id}}</td>
                        <td>@datetimeBRL($cambio->created_at)</td>
                        <td>@moneyBRL($cambio->valor)</td>
                        <td>R$ {{$cambio->valor}}</td>
                        <td>{{$cambio->descricao}}</td>
                        <td>{{$cambio->moeda}}</td>  
                    </tr>
                
                               
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$cambios->links()}}

    @endsection
@endcan
