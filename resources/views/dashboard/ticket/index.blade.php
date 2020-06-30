@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$pageTitle}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            @shield('chamados.create')
            <a href="{{route('chamados.create')}}" class="btn btn-outline-primary float-right mb-2"><i
                    class="fa fa-plus-circle"></i>Novo</a>
            @endshield
        </div>
        <div class="col-12">
            <div class="card">
                @include('dashboard.ticket.inc.filter')
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table header-border table-hover table-custom spacing5">
                    <thead>
                    <tr>
                        <th>N Ticket</th>
                        <th>Projeto</th>
                        <th>Titulo</th>
                        <th>Prioridade</th>
                        <th>Tipo</th>
                        <th>Impacto</th>
                        <th>Responsavel</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $key => $ticket)

                            <tr>
                                <td><a href="{{route('chamados.detail',$ticket->ticket_number)}}">{{$ticket->ticket_number}}</a></td>
                                <td><img class="rounded mr-3" src="{{$ticket->project->logo ?asset($ticket->project->logo)  : ''}}" style="width: 50px;"/></td>
                                <td>{{$ticket->title}}</td>
                                <td><span class="badge" style="background: transparent; color:{{$ticket->priority->color}}; border: 1px solid {{$ticket->priority->color}};">{{$ticket->priority->name}}</span></td>
                                <td><span class="badge badge-default" style="background: transparent; color:{{$ticket->type->color}}; border: 1px solid {{$ticket->type->color}};">{{$ticket->type->name}}</span></td>
                                <td><span class="badge badge-danger" style="background: transparent; color:{{$ticket->impact->color}}; border: 1px solid {{$ticket->impact->color}};">{{$ticket->impact->name}}</span></td>
                                <td>{{$ticket->userResponsible ? $ticket->userResponsible->name : 'Aguardando...' }}</td>

                                <td>
                                    @if($ticket->getOriginal('status') === 'E')
                                        <span class="badge badge-warning">{{$ticket->status}}</span>
                                    @elseif($ticket->getOriginal('status') === 'T')
                                        <span class="badge badge-info">{{$ticket->status}}</span>
                                    @else
                                        <span class="badge badge-success">{{$ticket->status}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
          integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>

@endsection
@section('scripts')
    <script src="{{asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('.input-daterange').datepicker({
                language: 'pt-BR'
            });
            $('.selectize').selectize({
                create: false,
                sortField: {
                    field: 'text',
                    direction: 'asc'
                },
                dropdownParent: 'body'
            });
        });
    </script>
@endsection
