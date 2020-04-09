@extends('layouts.login')

@section('content')
    <div class="body">
        <p class="lead">Efetue seu Login</p>
        <form method="POST" class="form-auth-small m-t-20" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror round" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="signin-password" class="control-label sr-only">Senha</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror round" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label class="fancy-checkbox element-left">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Lembrar-me</span>
                </label>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">Acessar</button>
            <div class="bottom">

                @if (Route::has('password.request'))
                    <span class="helper-text m-b-10">
                       <i class="fa fa-lock"></i>
                        <a  href="{{ route('password.request') }}">
                            Esqueçeu a senha?
                        </a>
                    </span>
                @endif
            </div>
        </form>
    </div>
@endsection
