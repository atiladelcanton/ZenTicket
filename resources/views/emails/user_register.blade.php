@extends('emails.base')

@section('content')
    <table>
        <tr>
            <td>
                <h3>Olá,  {{$name}}</h3>
                <p class="lead">Dados para acesso ao sistema {{env('APP_NAME')}}</p>
                <p>Abaixo estão os dados para que você faça seu login para poder utilizar o sistema da <strong>{{env('APP_NAME')}}</strong></p>
                <p><i>Após fazer seu primeiro acesso, recomendamos que você altere a senha para uma que sejá facil memorização para você</i></p>
                <!-- Callout Panel -->
                <p class="callout">
                    <strong>Usuário:&nbsp;</strong>{{$email}}<br/>
                    <strong>Senha:&nbsp;</strong>{{$password}}
                </p><!-- /Callout Panel -->
                <p class=""><a href="{{env('APP_URL')}}" class="soc-btn fb" style="padding:5px 7px;">ACESSAR O SISTEMA</a></p>

            </td>
        </tr>
    </table>
@endsection