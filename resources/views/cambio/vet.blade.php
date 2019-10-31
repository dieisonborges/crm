@can('read_cambio')    
    @extends('layouts.app')
    @section('title', 'Carteira')
    @section('content')    
    <h1>Câmbio
    <a class="btn btn-warning" style="float: right;" href="{{url('cambio/vetCreate')}}">Modificar o VET <i class="fa fa-edit"></i> </a>  

    <a class="btn btn-primary" style="float: right; margin-right: 10px;" href="{{url('cambio')}}">Ver Câmbio <i class="fa fa-eye"></i> </a> 

    </h1>  

        <div class="col-md-12">           
                 

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon"><i class="fa fa-dollar-sign"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="padding-bottom: 9px;">Cotação do Dólar:</span>
                    <span class="info-box-number">
                        <label class="btn btn-lg btn-default">R$ {{$cambio_atual}} (@moneyBRL($cambio_atual))</label>
                        
                        
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
                        <span class="btn btn-lg btn-default">@moneyBRL($vet_atual*$cambio_atual) <i class="fa fa-edit"></i>
                        </span>
                    </span>
                    
                </div>
                <!-- /.info-box-content -->

              </div>
              <!-- /.info-box -->
            </div>     
            <!-- /.col -->  

        </div>     
        
        <div class="box-header">
            <h3 class="box-title">Atualizações de VET (Valor Efetivo Total)</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Valor %</th>
                    <th>Descrição</th>
                </tr>
                @forelse ($vets as $vet)
                    <tr>
                        <td>{{$vet->id}}</td>
                        <td>@datetimeBRL($vet->created_at)</td>
                        <td>{{number_format($vet->valor, 2)}} %</td>
                        <td>{{$vet->descricao}}</td> 
                    </tr>
                               
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        {{$vets->links()}}

    @endsection
@endcan
