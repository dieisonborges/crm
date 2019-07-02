               @if($message = Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-window-close"></i> Alerta!</h4>
                        {{$message}}
                    </div>
                @endif 

                @if($message = Session::get('info'))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Informação!</h4>
                        {{$message}}
                    </div>
                @endif 

                @if($message = Session::get('warning'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-exclamation-circle"></i> Atenção!</h4>
                        {{$message}}
                    </div>
                @endif 

                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check-circle"></i> Sucesso!</h4>
                        {{$message}}
                    </div>
                @endif                               

                @if($message = Session::get('status'))                 
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info-circle"></i> Informação!</h4>
                        {{$message}}
                    </div>
                @endif                 

                @if($message = Session::get('permission_error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Atenção: {{$message}}</h4>
                        O seu usuário não tem autorização para acessar essa área.
                    </div>
                @endif

                @if(count($errors)>0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif              