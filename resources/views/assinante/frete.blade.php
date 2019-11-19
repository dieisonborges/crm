@can('read_assinante')    
    @extends('layouts.app')
    @section('title', 'Armazens')
    @section('content')    
    <div class="col-md-12">  

            <h1>
                <i class="fa fa-warehouse"></i> 
                Produto:
                <small>{{$produto->name}}</small>
            </h1>   
            
            <!-- /.box-header -->
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
                            <th>Valor BRL (VET)</th>
                                                
                        </tr>
                        @php $i=1; @endphp
                        @while($i<=15)
                            <tr>
                                <td>{{$i}} un</td>
                                <td>R$ {{number_format(((80*($peso*$i)+25)*$cambio_cny),2)}}</td>
                                <td>$ {{number_format(((((80*($peso*$i)+25)*$cambio_cny)/($cambio_usd))),2)}}</td> 
                                <td>R$ {{number_format(((80*($peso*$i)+25)*$cambio_cny)*$vet,2)}}</td>                    
                            </tr>                        
                            @php $i++; @endphp 
                        @endwhile           
                        
                    </table>
                </div>
                <!-- /.box-body -->

                       
            </div>
            <!-- /.box-body -->
            
            <a class="btn btn-warning" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>

        

    @endsection
@endcan
