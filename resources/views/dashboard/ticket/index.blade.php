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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $key => $ticket)

                            <tr>
                                <td><a href="{{route('chamados.detail',$ticket->ticket_number)}}">{{$ticket->ticket_number}}</a></td>
                                <td><img class="rounded mr-3" src="{{$ticket->logo ?asset($ticket->logo)  : ''}}" style="width: 50px;"/></td>
                                <td>{{$ticket->title}}</td>
                                <td><span class="badge" style="background: transparent; color:{{$ticket->priority_color}}; border: 1px solid {{$ticket->priority_color}};">{{$ticket->priority_name}}</span></td>
                                <td><span class="badge badge-default" style="background: transparent; color:{{$ticket->type_ticket_color}}; border: 1px solid {{$ticket->type_ticket_color}};">{{$ticket->type_ticket_name}}</span></td>
                                <td><span class="badge badge-danger" style="background: transparent; color:{{$ticket->impact_color}}; border: 1px solid {{$ticket->impact_color}};">{{$ticket->impact_name}}</span></td>
                                <td>{{$ticket->responsible_ticket? $ticket->responsible_ticket : 'Aguardando...' }}</td>

                                <td>
                                    @if($ticket->getOriginal('status') === 'E')
                                        <span class="badge badge-warning">{{$ticket->status}}</span>
                                    @elseif($ticket->getOriginal('status') === 'T')
                                        <span class="badge badge-info">{{$ticket->status}}</span>
                                    @else
                                        <span class="badge badge-success">{{$ticket->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @shield('chamados.edit')
                                        <a href="{{ route('chamados.editar', $ticket->ticket_number) }}"
                                           class="btn btn-outline-info" data-toggle="tooltip" title="Editar"
                                           data-placement="top">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endshield
                                        @shield('chamados.destroy')
                                        <a href="javascript:"
                                           class="btn btn-outline-danger" data-toggle="tooltip" title="Remover"
                                           data-placement="top"
                                           onclick="event.preventDefault(); document.getElementById('excluir_{{$ticket->id}}').submit();">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('chamados.deletar',[$ticket->id]) }}" method="post"
                                              id="excluir_{{$ticket->id}}" style="display:inline-block;">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                        @endshield
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                {{ $tickets->appends(request()->input())->links() }}
                            </td>
                        </tr>
                    </tfoot>
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
