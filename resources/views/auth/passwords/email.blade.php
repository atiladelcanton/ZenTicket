@extends('layouts.login')

@section('content')

    <div class="body">
        <p class="lead mb-3"><strong>Oops</strong>,<br> esqueceu a senha?</p>
        <p>Escreva seu e-mail, para resetar a senha</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control round" id="signup-password" name="email" placeholder="Password">
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">Recurperar Senha</button>
            <div class="bottom m-t-10">
                <span class="helper-text">Se você sabe sua senha, faça o login <a href="{{url('/')}}">Login</a></span>
            </div>
        </form>
    </div>
@endsection
