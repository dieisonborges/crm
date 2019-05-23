@extends('layouts.app')
@section('title', $prospecto->name)
@section('content')
	<h1>
		<i class="fa fa-star"></i>
        Perfil do Prospecto
        <small>{{$prospecto->name}}</small>
    </h1>
	<div class="row">
		
		    <div class="box-body col-md-4">              
              <div class="callout callout-info">
              	<h5>ID: <b> {{$prospecto->id}}</b></h5>
                <h5>Nome: <b> {{$prospecto->name}}</b></h5>
                <h5>e-Mail: <b>{{$prospecto->email}}</b></h5>
                <h5>Telefone: <b> {{$prospecto->phone_number}}</b></h5>
                <h5>Criado em: <b> {{date('d/m/Y H:i:s', strtotime($prospecto->created_at))}}</b></h5> 
                
              </div>
        </div>       

	</div>

  <div class="col-md-12">
        
        <div class="box box-warning col-md-12">

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <h3 class="text-orange">Produtos de Interesse</h3>
                
                @forelse ($produtos as $produto)

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
                            <span class="username"><a href="{{url('produtos/'.$produto->id)}}">{{ str_limit(strip_tags($produto->titulo), $limit = 22, $end = '...') }}</a></span>                            
                          </div>
                          <!-- /.user-block -->
                          
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 200px; display: block;">
                          <img class="img-responsive pad" src="{{url($imagem_principal_link)}}" alt="{{$produto->titulo}}" style="max-height: 195px;">

                          <!-- -------------- Carousel -------------- -->

                          <!-- -------------- END Carousel ---------- -->

                          
                        </div>
                        <!-- /.box-body -->
                        <div class="box-body">

                        <p>{{ str_limit(strip_tags(str_replace('&nbsp;', '', $produto->descricao)), $limit = 20, $end = '...') }}</p>

                          <a href="{{url('produtos/'.$produto->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver</a>
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
    
  </div>	


  <div class="col-md-12">
      <!-- /.box-header -->
        <div class="box-body box box-primary table-responsive no-padding">
            <h3>Categorias de Interesse</h3>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Ver</th>
                </tr> 
                @forelse ($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>

                    <td>
                        <a href="{{URL::to('categorias')}}/{{$categoria->id}}" class="btn btn-primary">{{$categoria->nome}}</a>
                    </td>                 
                    
                    <td>
                        <a href="{{URL::to('categorias')}}/{{$categoria->id}}">{{$categoria->descricao}}</a>
                    </td>

                    <td>
                        <a href="{{URL::to('categorias')}}/{{$categoria->id}}"><span class="btn btn-primary btn-xs">{{$categoria->valor}}</span></a>
                    </td> 

                    <td>
                        <a class="btn btn-warning btn-xs" href="{{URL::to('categorias/'.$categoria->id)}}"><i class="fa fa-eye"></i> Ver</a>
                    </td>
                    
                    
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->
  </div>

  <div class="col-md-12">
        <!-- /.box-header -->
        <div class="box-body box box-success table-responsive no-padding">
            <h3>Franquias de Interesse</h3>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Código da Franquia</th>
                    <th>Nome</th>
                    <th>Slogan</th>
                    <th>Url</th>
                    <th>Url Alt.</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Dono(s)</th>                    
                </tr>
                @forelse ($franquias as $franquia)
                <tr>
                    <td>{{$franquia->id}}</td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{$franquia->codigo_franquia}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{$franquia->nome}}</a></td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{ str_limit(strip_tags($franquia->slogan), $limit = 40, $end = '...') }}</a></td>
                    <td>
                        <a class="btn btn-primary btn-xs"  target="_blank" href="https://{{$franquia->loja_url}}">
                            <i class="fa fa-link"></i> {{$franquia->loja_url}}
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" target="_blank" href="https://{{$franquia->loja_url_alternativa}}.venderaqui.com.br">
                            <i class="fa fa-link"></i> {{$franquia->loja_url_alternativa}}
                        </a>
                    </td>
                    <td><a href="{{URL::to('franquias')}}/{{$franquia->id}}">{{ str_limit(strip_tags($franquia->descricao), $limit = 40, $end = '...') }}</a></td>
                    <td>
                        <a href="{{URL::to('franquias')}}/{{$franquia->id}}">
                        @if($franquia->status)
                            <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ativo</span>
                        @else
                            <span class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Desativado</span>
                        @endif
                        </a>
                    </td>
                    <td>
                        
                            @php
                                $dono = $franquia->franquiaUser()->first();                                
                            @endphp

                            @if($dono)
                                <a class="btn btn-primary btn-xs" href="{{URL::to('franquias')}}/{{$franquia->id}}">
                                    <span class="fa fa-users"> {{$dono->apelido}}</span>
                                </a>
                            @else
                                <a class="btn btn-danger btn-xs" href="{{URL::to('franquias')}}/{{$franquia->id}}">
                                    <span class="fa fa-users"> Nenhum</span>
                                </a>
                            @endif                    
                        </a>
                    </td>
                                       
                </tr>                
                @empty

                <tr>
                    <td><b>Nenhum Resultado.</b></td>
                </tr>
                    
                @endforelse      

                
            </table>
        </div>
        <!-- /.box-body -->
  </div>

@endsection