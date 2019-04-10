@can('read_log')    
    @extends('layouts.app')
    @section('title', 'Logs')
    @section('content')    
    <h1>Logs (Registros) de Acesso do Sistema </h1>

        
        <div class="box-header">
            <h3 class="box-title">Eventos do sistema</h3>
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>IP</th>
                    <th>País</th>
                </tr>
                @forelse ($logs as $log)
                <tr>
                    <td><a href="#">{{$log->ip}}</a></td>      
                    <td><a href="#">
                    @php
                    $ip = $log->ip;
                        $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
                    @endphp

                    {{$details->geoplugin_countryName}} | {{$details->geoplugin_stateName}} | {{$details->geoplugin_cityName}}
                    </a></td>              
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->

        

    @endsection
@endcan
