@extends('layouts.nologin') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ __('Cadastre-se') }}</h1></div>

                <div class="card-body">
                    <form method="POST" name="register" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="convite" class="col-md-4 col-form-label text-md-right">{{ __('Código do Convite') }}</label>

                            <div class="col-md-6">
                                <input id="convite" type="text" class="form-control{{ $errors->has('convite') ? ' is-invalid' : '' }}" name="convite" placeholder="ABCXY45YX" value="{{ old('convite') }}" required autofocus>

                                @if ($errors->has('convite'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('convite') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome Completo') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Seu Nome Completo" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apelido" class="col-md-4 col-form-label text-md-right">{{ __('Apelido') }}</label>

                            <div class="col-md-6">
                                <input id="apelido" type="text" class="form-control{{ $errors->has('apelido') ? ' is-invalid' : '' }}" name="apelido" placeholder="Como você gostaria de ser chamado" value="{{ old('apelido') }}" required autofocus>

                                @if ($errors->has('apelido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apelido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="email@email.com"  value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('País') }}</label>

                            <div class="col-md-6">                                

                                <select  style="width:150;font-size:11px" name="country"  class="form-control" required="">
                                    <option value="BR" selected>Brasil</option>
                                    <option value="EUA">EUA</option>
                                    <option value="CN">China</option>
                                    <option value="PY">Paraguai</option>
                                    <option value="ZA">África do Sul</option>
                                    <option value="DE">Alemanha</option>
                                </select>

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF (Somente Brasileiros)') }}</label>

                            <div class="col-md-6">
                                <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" placeholder="012.012.012-01" value="{{ old('cpf') }}">

                                @if ($errors->has('cpf'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Telefone Móvel') }}</label>

                            <div class="col-md-2">
                                Código do País:
                                <input id="phone_number_country" type="text" class="form-control{{ $errors->has('phone_number_country') ? ' is-invalid' : '' }}" name="phone_number_country" placeholder="+55" value="{{ old('phone_number_country') }}" required style="width: 65%;">

                                @if ($errors->has('phone_number_country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number_country') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                               Número com DDD: <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" placeholder="21 99123-4560" value="{{ old('phone_number') }}" required style="width: 65%;">

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar-se') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
