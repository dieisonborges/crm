@extends('layouts.app')
@section('title', 'Regras')
@section('content')


<h1>Donos e gestores da franquia: <b>{{$franquia->nome}}</b></h1>
<h6>Id: <b>{{$franquia->id}}</b></h6>
<h6>Código da Franquia: <b>{{$franquia->codigo_franquia}}</b></h6>
<h6>Slogan: <b>{{$franquia->slogan}}</b></h6>




<br>

<form method="POST" action="{{action('FranquiaController@donoUpdate')}}" class="form-group col-md-12">
    @csrf
    <input type="hidden" name="franquia_id" value="{{$franquia->id}}">
    

    <div class="form-group col-md-6">
        <label>Adicionar Usuário:</label>
        <select name="dono_id[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione um ou mais usuários à franquia"
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
        <label>à Franquia:</label>
        <span class="form-control"><small>{{$franquia->nome}}</small></span>
    </div>
    <div class="form-group col-md-2" style="margin-top: 25px;">   
        <input class="btn btn-success btn-md" type="submit" value="Adicionar">
    </div>
    
</form>




<br><br><br>

    @if (session('status'))
        <div class="alert alert-success" donos="alert">
            {{ session('status') }}
        </div>
    @endif

    
    <div class="box-header  col-md-12">
        <h3 class="box-title">Usuários dono(s) da franquia:</h3>        
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


            @forelse ($donos as $dono)
            <tr>
                <td>{{$dono->id}}</td>
                <td>{{$dono->name}}</td>
                <td>{{$dono->email}}</td>
                
                <td>

                    <form method="POST" action="{{action('FranquiaController@donoDestroy')}}" id="formDeleteP{{$dono->id}}">

                        @csrf
                        
                        <input type="hidden" name="dono_id" value="{{$dono->id}}">

                        <input type="hidden" name="franquia_id" value="{{$franquia->id}}">
                        

                        <a href="javascript:confirmDeleteP{{$dono->id}}();" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Excluir</a>
                    </form> 

                    <script>
                       function confirmDeleteP{{$dono->id}}() {

                        var result = confirm('Tem certeza que deseja excluir?');

                        if (result) {
                                document.getElementById("formDeleteP{{$dono->id}}").submit();
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
