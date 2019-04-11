@extends('layouts.app')
@section('title', 'Conquistas')
@section('content')

<h1>
    Conquista dos usuários
    <small>Adicionar ou Remover</small>
</h1>




<form method="POST" action="{{action('ConquistaController@userUpdate')}}" class="form-group col-md-12">
    @csrf
    <input type="hidden" name="conquista_id" value="{{$conquista->id}}">

    <div class="form-group col-md-6">
        <label>Adicionar Usuário:</label>
        <select name="user_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários"
                style="width: 100%;" required="required">
                @forelse ($users as $user)
                    <option value="{{$user->id}}">
                        {{$user->apelido}} | {{$user->name}} | {{$user->email}}
                    </option>
                @empty
                    <option>Nenhuma Opção</option>     
                @endforelse
                      
        </select>

    </div>
    <div class="form-group col-md-3">
        <label>À Conquista:</label>

        <span class="form-control">{{$conquista->titulo}} | <small>{{$conquista->descricao}}</small></span>
    </div>
    <div class="form-group col-md-3" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>

<br><br><br>

<div class="form-group col-md-12">
	<div class="container-medalha">	    		
		<img src="{{url('img/conquistas/'.$conquista->imagem_medalha)}}" width="100%"  alt="{{$conquista->imagem_medalha}}" class="imagem-medalha-ajuste">
		<i class="{{$conquista->icone_medalha}} icone-medalha-ajuste"></i>
		<span class="imagem-texto"><b>{{$conquista->titulo}}</b> <br> {{$conquista->descricao}}</span>
	</div>
</div>


<br><br><br>

    @if (session('status'))
        <div class="alert alert-success" conquista="alert">
            {{ session('status') }}
        </div>
    @endif

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Usuários que possuem esta conquista:</h3>        
    </div>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding  col-md-12">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Apelido</th>
                <th>Nome</th>
                <th>e-mail</th>
                <th>cpf</th>
                <th>Excluir</th>
            </tr>


            @forelse ($conquista_users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->apelido}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->cpf}}</td>                
                <td>

                    <form method="POST" action="{{action('ConquistaController@userDestroy')}}" id="formDeleteP{{$user->id}}">
                        @csrf
                        <input type="hidden" name="conquista_id" value="{{$conquista->id}}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <!--<button class="btn btn-danger btn-xs" >Excluir</button>-->
                        <!--<input type="submit" name="Excluir">-->

                        <a href="javascript:confirmDeleteP{{$user->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDeleteP{{$user->id}}() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDeleteP{{$user->id}}").submit();
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
   

@endsection
