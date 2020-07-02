@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('usuarios.profile')}}">Perfil</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="body">
                    <form action="{{ route('usuarios.update_profile',auth()->user()->id) }}" method="post">
                        {{ @csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group  @error('name') 'has-error' @enderror">
                                        <label name="name">Nome</label>
                                        <input type="text" name="name" id="name" class="form-control" required value="{{old('name',$user->name)}}">
                                        @error('name')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group  @error('email') 'has-error' @enderror">
                                        <label name="name">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control" required value="{{old('email',$user->email)}}">
                                        @error('email')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="senha">Senha:</label>
                                        <input type="password" class="form-control" name="password" id="senha">
                                        <div id="senhaBarra" class="progress mt-2" style="display: none;">
                                            <div id="senhaForca" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                            </div>
                                        </div>
                                        <small><code>Garanta que sua senha contenha caractees especiais *&ˆ%$#@ e contenha aumenos uma letra maiuscula</code></small>
                                    </div>
                                </div>
                            </div>
                        <br/>
                        <div class="form-group">
                            <button type='button' class="btn btn-outline-warning"
                                    onclick="location.href =  '{{route('impactos')}}' ">Voltar
                            </button>
                            <button type="submit" class="btn btn-outline-success mr-2 float-right">Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(function() {
    $("#senha").keyup(function(e) {
        var senha = $(this).val();
        if (senha == "") {
            $("#senhaBarra").hide();
        } else {
            var fSenha = forcaSenha(senha);
            var texto = "";
            $("#senhaForca").css("width", fSenha + "%");
            $("#senhaForca").removeClass();
            $("#senhaForca").addClass("progress-bar");
            if (fSenha <= 40) {
                texto = "Fraca";
                $("#senhaForca").addClass("progress-bar-danger");
            }

            if (fSenha > 40 && fSenha <= 70) {
                texto = "Media";
            }

            if (fSenha > 70 && fSenha <= 90) {
                texto = "Boa";
                $("#senhaForca").addClass("progress-bar-success");
            }

            if (fSenha > 90) {
                texto = "Muito boa";
                $("#senhaForca").addClass("progress-bar-success");
            }

            $("#senhaForca").text(texto);

            $("#senhaBarra").show();
        }
    });
});

function forcaSenha(senha) {
    var forca = 0;

    var regLetrasMa = /[A-Z]/;
    var regLetrasMi = /[a-z]/;
    var regNumero = /[0-9]/;
    var regEspecial = /[!@#$%&*?]/;

    var tam = false;
    var tamM = false;
    var letrasMa = false;
    var letrasMi = false;
    var numero = false;
    var especial = false;

    if (senha.length >= 6) tam = true;
    if (senha.length >= 10) tamM = true;
    if (regLetrasMa.exec(senha)) letrasMa = true;
    if (regLetrasMi.exec(senha)) letrasMi = true;
    if (regNumero.exec(senha)) numero = true;
    if (regEspecial.exec(senha)) especial = true;

    if (tam) forca += 10;
    if (tamM) forca += 10;
    if (letrasMa) forca += 10;
    if (letrasMi) forca += 10;
    if (letrasMa && letrasMi) forca += 20;
    if (numero) forca += 20;
    if (especial) forca += 20;

    return forca;
}
</script>
@endsection
