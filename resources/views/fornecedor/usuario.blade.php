@extends('layouts.app')
@section('title', 'Regras')
@section('content')


<h1>Usuários do fornecedor: <b>{{$fornecedor->nome_fantasia}}</b></h1>
<h6>Razão Social: <b>{{$fornecedor->razao_social}}</b></h6>
<h6>País: <b>{{$fornecedor->endereco_pais}}</b></h6>




<br>

<form method="POST" action="{{action('FornecedorController@usuarioUpdate')}}" class="form-group col-md-12">
    @csrf
    <input type="hidden" name="fornecedor_id" value="{{$fornecedor->id}}">
    

    <div class="form-group col-md-6">
        <label>Adicionar Usuário:</label>
        <select name="usuario_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários à fornecedor"
                style="width: 100%;" required="required">
                @forelse ($all_users as $user)
                    <option value="{{$user->id}}">
                        {{$user->name}} | {{$user->email}}
                    </option>
                @empty
                    <option>Nenhuma Opção</option>     
                @endforelse
                      
        </select>

    </div>
    <div class="form-group col-md-4">
        <label>ao Fornecedor:</label>
        <span class="form-control"><small>{{$fornecedor->nome_fantasia}}</small></span>
    </div>
    <div class="form-group col-md-2" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>




<br><br><br>

    @if (session('status'))
        <div class="alert alert-success" usuarios="alert">
            {{ session('status') }}
        </div>
    @endif

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Usuários vinculados ao fornecedor:</h3>        
    </div>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding  col-md-12">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>e-Mail</th>
                <th>Excluir</th>
            </tr>


            @forelse ($usuarios as $usuario)
            <tr>
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                
                <td>

                    <form method="POST" action="{{action('FornecedorController@usuarioDestroy')}}" id="formDeleteP{{$usuario->id}}">

                        @csrf
                        
                        <input type="hidden" name="usuario_id" value="{{$usuario->id}}">

                        <input type="hidden" name="fornecedor_id" value="{{$fornecedor->id}}">
                        

                        <a href="javascript:confirmDeleteP{{$usuario->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDeleteP{{$usuario->id}}() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDeleteP{{$usuario->id}}").submit();
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
