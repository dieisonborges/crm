@can('read_franqueado')  
    @extends('layouts.app')
    @section('title', 'Produtos')
    @section('content')
    <h1>Produtos da Franquia <small>{{$franquia->nome}}</small></h1>

    <a href="https://{{$franquia->loja_url}}" target="_blank" class="btn btn-info btn-lg">{{$franquia->loja_url}}</a>

    <br><br>
        @if (session('status'))
            <div class="alert alert-success" produto="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="col-md-12">	

            <form method="POST" enctype="multipart/form-data" action="{{url('franqueados/produtos/busca')}}">
                @csrf
                <div class="input-group input-group-lg">			
                    <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar..." value="">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">Buscar</button>
                        </span>

                </div>
            </form>
     
        </div>

        <br><br><br> 

        <div class="box box-success col-md-12">
        
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <h3 class="text-green">Produtos Selecionados</h3>
                
                    @forelse ($produtos as $produto)

                    @php

                    $imagem_principal = $produto->imagemPrincipal->first();

                    if($imagem_principal){               

                        $imagem_principal_link = "storage/".$imagem_principal->dir."/".$imagem_principal->link;

                    }else{
                        $imagem_principal_link = "img/default-image.png";
                    }

                    @endphp


                    <div class="col-md-4">
                      <!-- Box Comment -->
                      <div class="box box-widget">
                        <div class="box-header with-border">
                          <div class="user-block">
                            <img class="img-circle" src="{{url($imagem_principal_link)}}" alt="{{$produto->titulo}}">
                            <span class="username"><a href="{{url('franqueados/produtos/'.$produto->id)}}">{{$produto->titulo}}</a></span>
                            <span class="description">Adicionado em: {{date('d/m/Y h:i:s', strtotime($produto->created_at))}}</span>
                          </div>
                          <!-- /.user-block -->
                          
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <img class="img-responsive pad" src="{{url($imagem_principal_link)}}" alt="{{$produto->titulo}}">

                          <!-- ----------------------------- Carousel ----------------------------------------- -->                      

                          <!-- ----------------------------- END Carousel ------------------------------------- -->

                          <p>{{ str_limit(strip_tags($produto->descricao), $limit = 40, $end = '...') }}</p>
                          <a href="{{url('franqueados/'.$franquia->id.'/produtosRemover/'.$produto->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remover</a>
                          <a href="{{url('franqueados/produtos/'.$produto->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver Produto</a>
                        </div>
                        <!-- /.box-body -->                        

                        
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->

                                   
                    @empty

                    <tr>
                        <td><b>Nenhum Resultado.</b></td>
                    </tr>
                        
                    @endforelse      

                    
                
            </div>
            <!-- /.box-body -->
        </div>


        <div class="box box-warning col-md-12">

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <h3 class="text-orange">Produtos Disponíveis</h3>
                
                @forelse ($todos_produtos as $produto)

                    @php

                    $imagem_principal = $produto->imagemPrincipal->first();

                    if($imagem_principal){               

                        $imagem_principal_link = "storage/".$imagem_principal->dir."/".$imagem_principal->link;

                    }else{
                        $imagem_principal_link = "img/default-image.png";
                    }

                    @endphp


                    <div class="col-md-2">
                      <!-- Box Comment -->
                      <div class="box box-widget">
                        <div class="box-header with-border">
                          <div class="text-center">
                            <span class="username"><a href="{{url('franqueados/produtos/'.$produto->id)}}">{{ str_limit(strip_tags($produto->titulo), $limit = 30, $end = '...') }}</a></span>
                            
                          </div>
                          <!-- /.user-block -->
                          
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 220px;">
                          <img class="img-responsive pad" src="{{url($imagem_principal_link)}}" alt="{{$produto->titulo}}" style="max-height: 210px;">

                          <!-- ----------------------------- Carousel ----------------------------------------- -->                      

                          <!-- ----------------------------- END Carousel ------------------------------------- -->

                          
                        </div>
                        <!-- /.box-body -->
                        <div class="box-body">

                        <p>{{ str_replace('&nbsp;', '', str_limit(strip_tags($produto->descricao), $limit = 30, $end = '...')) }}</p>


                          <a href="{{url('franqueados/'.$franquia->id.'/produtosAdicionar/'.$produto->id)}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Adicionar</a>



                          <a href="{{url('franqueados/produtos/'.$produto->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver</a>
                        </div>
                        <br><br>
                        
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->

                                   
                    @empty

                    <tr>
                        <td><b>Nenhum Resultado.</b></td>
                    </tr>
                        
                    @endforelse  
            </div>
            <!-- /.box-body -->     
        </div>   

    @endsection
@endcan
