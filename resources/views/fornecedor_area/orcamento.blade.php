@can('read_fornecedor_area')  
    @extends('layouts.app')
    @section('title', 'Orcamentos')
    @section('content')
    <h1>Orçamentos  / Budgeting <a href="{{url('fornecedorArea/orcamentoCreate')}}" class="btn btn-info btn-lg"><i class="fa fa-plus"> </i> Criar Novo / Create New</a></h1>

        @if (session('status'))
            <div class="alert alert-success" orcamento="alert">
                {{ session('status') }}
            </div> 
        @endif
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('fornecedorArea/orcamentoBusca')}}">
                @csrf
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar / Search for
 ..." value="{{$buscar}}">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar / Search</button>
                        </span>

                </div>
            </form>
     
        </div>

        <br><br><br>        
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>Código <br> Code</th>
                    <th>Criado em <br> Created at</th>                    
                    <th>Status</th>
                    <th>Visualizar <br> To View</th>
                    <th>Excel</th>
                    <th>Pdf</th>
                    <th>Excluir <br> Delete</th>
                </tr>
                @forelse ($orcamentos as $orcamento)
                <tr>
                    <td><a href="{{URL::to('fornecedorArea/orcamentoShow')}}/{{$orcamento->id}}">{{$orcamento->codigo}}</a></td>
                    <td><a href="{{URL::to('fornecedorArea/orcamentoShow')}}/{{$orcamento->id}}">{{ date('d/m/Y H:i:s', strtotime($orcamento->created_at)) }}</a></td>
                    
                    <td>
                        @if($orcamento->status==0)
                            <span class="btn btn-primary btn-xs">Em edição / In editing</span> 
                        @elseif($orcamento->status==1)
                            <span class="btn btn-warning btn-xs">Em cotação / In quotation</span> 
                        @elseif($orcamento->status==2)
                            <span class="btn btn-danger btn-xs">Cancelado / Canceled</span> 
                        @else($orcamento->status==3)
                            <span class="btn btn-success btn-xs">Cotação Finalizada / Quotation Completed</span> 
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{URL::to('fornecedorArea/orcamentoShow')}}/{{$orcamento->id}}">
                            <span class="fa fa-eye"></span>                        
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-default btn" href="{{URL::to('fornecedorArea/orcamentoShowExcel')}}/{{$orcamento->id}}">
                            <span class="fa fa-file-excel text-green"></span>                        
                        </a>
                    </td> 
                    <td>
                        <a class="btn btn-default btn" href="{{URL::to('fornecedorArea/orcamentoShowPdf')}}/{{$orcamento->id}}">
                            <span class="fa fa-file-pdf text-red"></span>                        
                        </a>
                    </td>                    
                    <td>

                        @if(($orcamento->status)==0)

                        <form method="POST" action="{{action('OrcamentoController@destroy', $orcamento->id)}}" id="formDelete{{$orcamento->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                            <!--<input type="submit" name="Excluir">-->

                            <a href="javascript:confirmDelete{{$orcamento->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i></a>
                        </form> 

                        <script>
                           function confirmDelete{{$orcamento->id}}() {

                            var result = confirm('Tem certeza que deseja remover?');

                            if (result) {
                                    document.getElementById("formDelete{{$orcamento->id}}").submit();
                                } else {
                                    return false;
                                }
                            } 
                        </script>

                        @else
                        @endif

                    </td>
                </tr>                
                @empty

                <tr>
                    <td><b>Nenhum Resultado.</b></td>
                </tr>
                    
                @endforelse      

                {{$orcamentos->links()}}      
                
            </table>
        </div>
        <!-- /.box-body -->

    @endsection
@endcan
