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
                            <span class="username">
                                <a href="{{url('franqueados/produtos/'.$produto->id)}}">{{ str_limit(strip_tags($produto->titulo), $limit = 22, $end = '...') }}</a></span>                            
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
    
  </div>	


  <div class="col-md-12">
      <!-- /.box-header -->
        <div class="box-body box box-primary table-responsive no-padding">
            <h3 class="text-blue">Categorias de Interesse</h3>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>                    
                </tr> 
                @forelse ($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>

                    <td>
                        <a href="#" class="btn btn-primary">{{$categoria->nome}}</a>
                    </td>                 
                    
                    <td>
                        <a href="#">{{$categoria->descricao}}</a>
                    </td>                   
                    
                    
                </tr>                
                @empty
                    
                @endforelse            
                
            </table>
        </div>
        <!-- /.box-body -->
  </div>

  

@endsection