@can('read_carteira')    
    @extends('layouts.app')
    @section('title', 'Carteira')
    @section('content')    
    <h1>Carteira: <small>{{$user->name}}</small></h1>   

        <h2>Saldo Atual: <label class="btn btn-lg btn-default">@moneyBRL($saldo)</label></h2>     
        
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
