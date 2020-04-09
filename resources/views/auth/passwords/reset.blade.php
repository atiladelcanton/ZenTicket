@extends('layouts.login')

@section('content')
    <div class="body">
        <p class="lead mb-3">Recurperação de Senha</p>
        <p>Informe a nova senha</p>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror round"
                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="col-md-12 col-form-label"> {{ __('Senha') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror round"
                       name="password" required autocomplete="new-password">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm" class="col-md-12 col-form-label"> {{ __('Repetir Senha') }}</label>
                <input id="password-confirm" type="password" class="form-control round" name="password_confirmation"
                       required autocomplete="new-password">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">Recurperar Senha</button>
        </form>
    </div>
@endsection
