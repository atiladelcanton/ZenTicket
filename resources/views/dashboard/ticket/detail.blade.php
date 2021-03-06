@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('chamados')}}">Chamado</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$pageTitle}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            <div class="card c_grid c_yellow">
                <div class="body text-center">
                    <div class="circle" style="background:url({{asset($ticket->project->logo)}});background-size: cover;background-position: center center;">

                    </div>
                    <h6 class="mt-3 mb-0">{{$ticket->userOpen->name}}</h6>
                    <span>{{$ticket->userOpen->email}}</span>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h2>Informações do Chamado</h2>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <small class="text-muted">Chamado: </small>
                        <p class="mb-0">{{$ticket->title}}</p>
                    <input type="hidden" id="ticket_number" value="{{$ticket->ticket_number}}" />
                    </li>
                    <li class="list-group-item">
                        <small class="text-muted">Prioridade: </small>
                        <p class="mb-0">
                            <span class="badge" style="background: transparent; color:{{$ticket->priority->color}}; border: 1px solid {{$ticket->priority->color}};">{{$ticket->priority->name}}</span>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <small class="text-muted">Tipo: </small>
                        <p class="mb-0"><span class="badge badge-default" style="background: transparent; color:{{$ticket->type->color}}; border: 1px solid {{$ticket->type->color}};">{{$ticket->type->name}}</p>
                    </li>
                    <li class="list-group-item">
                        <small class="text-muted">Impacto: </small>
                        <p class="mb-0"><span class="badge badge-danger" style="background: transparent; color:{{$ticket->impact->color}}; border: 1px solid {{$ticket->impact->color}};">{{$ticket->impact->name}}</span></p>
                    </li>
                    <li class="list-group-item">
                        <small class="text-muted">Data Abertura: </small>
                        <p class="mb-0">{{$ticket->created_at->format('d/m/Y  h:i:s') }}</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="body" style="    max-height: 446px;overflow: scroll;">
                    {!! $ticket->description !!}
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h2>Documentos do chamado</h2>
                </div>
                <div class="body">
                        <div class="row" style="display: flex;justify-content: start;align-items: center;">
                            @include('dashboard.ticket.inc.documents',['documents'=>$ticket->documents])
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            <div class="card c_grid c_yellow" style=" max-height: 615px;height: 615px;">
                <div class="body text-center" style="height: 100%;">
                    <ul class="list-group">
                            @if($ticket->getOriginal('status') == 'T')
                                @if(!is_null($ticket->responsible_ticket) && auth()->user()->id === $ticket->responsible_ticket)
                                    <li class="list-group-item" id="li_actions">
                                        <small class="text-muted">Ações: </small>
                                        <p class="mb-0">
                                            <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Iniciar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="play" class="btn btn-outline-info mb-2 btn-action" title="Save"><span class="sr-only">Save</span> <i class="fa fa-play"></i></button>
                                            <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Pausar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="pause" class="btn btn-outline-warning mb-2 btn-action" title="Pausar Tarefa" ><span class="sr-only">Pausar Tarefa</span> <i class="fa fa-pause"></i></button>
                                            <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Finalizar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="finish" class="btn btn-outline-success mb-2 btn-action" title="Save"><span class="sr-only">Save</span> <i class="fa fa-eject"></i></button>
                                        </p>
                                    </li>
                                @endif
                            @elseif(is_null($ticket->responsible_ticket))
                                <li class="list-group-item" id="li_actions">
                                    <small class="text-muted">Ações: </small>
                                    <p class="mb-0">
                                        <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Iniciar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="play" class="btn btn-outline-info mb-2 btn-action" title="Save"><span class="sr-only">Save</span> <i class="fa fa-play"></i></button>

                                        <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Pausar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="pause" class="btn btn-outline-warning mb-2 btn-action" title="Pausar Tarefa" ><span class="sr-only">Pausar Tarefa</span> <i class="fa fa-pause"></i></button>
                                        <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Finalizar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="finish" class="btn btn-outline-success mb-2 btn-action" title="Save"><span class="sr-only">Save</span> <i class="fa fa-eject"></i></button>
                                    </p>
                                </li>
                            @endif
                        <li class="list-group-item">
                            <small class="text-muted">Tempo investido no atendimento:&nbsp;&nbsp; </small>

                            <strong id="trackTimeTotal">{{$trackTime}}</strong>
                        </li>

                        <li class="list-group-item">
                            <small class="text-muted">Extrato de Horas </small>
                                <table class="table header-border table-hover table-custom spacing5">
                                    <thead>
                                        <th>Data</th>
                                        <th>Inicio</th>
                                        <th>Parada</th>
                                        <th>Tempo Gasto</th>
                                    </thead>
                                    <tbody id="body_track">
                                        @foreach($ticket->timeLineTicket as $timeLine)

                                            <tr>
                                                <td>{{$timeLine->created_at->format('d/m/Y')}}</td>
                                                <td>{{$timeLine->start->format('H:i:s')}}</td>
                                                <td>{{$timeLine->stop ? $timeLine->stop->format('H:i:s'):''}}</td>
                                                <td>
                                                    {{$timeLine->stop ? $timeLine->stop->diff($timeLine->start)->format('%H:%I:%S'): ''}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


            <div class="col-lg-8 col-md-12">
                <form action="{{ route('chamados.registrar-ocorrencia') }}" method="post" id="frm_cadastro">
                    {{ @csrf_field() }}
                    <div class="card">
                        <div class="body">
                            <h5 for="title" class="control-label">Envie os arquivos como evidencias, referencias por aqui</h5>
                            <div class="dropzone dropzone-previews" id="my-dropzone-occurence"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <textarea id="description" name="description">{{old('description')}}</textarea>
                            <input type="hidden" name="ticketNumber" value="{{$ticket->ticket_number}}" />
                            <button type="submit" class="btn btn-block btn-outline-success mb-2 mt-3">Incluir Ocorrência</button>
                        </div>
                    </div>
                </form>
            </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Ocorrências</h2>
                    <ul class="header-dropdown dropdown">
                        <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <ul class="timeline timeline-split">
                        @if($ticket->ocurrences)
                            @foreach($ticket->ocurrences as $occurrence)
                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>{{$occurrence->created_at->format('d/m/Y H:i:s')}}</span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content" style="width: 100%">
                                    <p>{!! $occurrence->description!!}</p>
                                            <div class="row" style="display: flex;justify-content: start;align-items: center;">
                                                @include('dashboard.ticket.inc.documents',['documents'=>$occurrence->documentsOccurences])
                                            </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')

<link rel="stylesheet" href="{{asset('assets/vendor/dropzone/dist/min/dropzone.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/vendor/dropzone/dist/min/basic.min.css')}}"/>
<style>

    .light_version .table.table-custom thead th{
        background:#f7f7f7;
    }
    .light_version .table tr td, .light_version .table tr th{
        background: #e6e6e6;
    }
    .dropzone{
        background: #f4f7f6;
        border:0px;
    }
</style>
@endsection
@section('scripts')
<script src="{{asset('assets/vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(function () {
            let hour_start;
            $('[data-toggle="tooltip"]').tooltip()

            $('.selectize').selectize({
                create: false,
                sortField: {
                    field: 'text',
                    direction: 'asc'
                },
                dropdownParent: 'body'
            });

            $('#description').summernote({
                tabsize: 2,
                lang: 'pt-BR',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'video']],
                    ['view', ['help']]
                ]
            });
            var uploadedDocumentMap = {}
            $("#my-dropzone").dropzone({url: "/chamados/evidences",
                maxFilesize: 3,  // 3 mb
                acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.docx,zip",
                addRemoveLinks: true,
                paramName: "file",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function (file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                },
            });
            var uploadedDocumentMapOccurence = {}
            $("#my-dropzone-occurence").dropzone({url: "/chamados/evidences",
                maxFilesize: 3,  // 3 mb
                acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.docx,zip",
                addRemoveLinks: true,
                paramName: "file",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    $('form').append('<input type="hidden" name="document_occurence[]" value="' + response.name + '">');
                    uploadedDocumentMapOccurence[file.name] = response.name
                },
                removedfile: function (file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMapOccurence[file.name]
                    }
                    $('form').find('input[name="document_occurence[]"][value="' + name + '"]').remove()
                },
            });

            $('.btn-action').on('click',function(){
                let action = $(this).data('action');
                axios.post(`/chamados/actions`,{
                    'ticketNumber':$('#ticket_number').val(),
                    'action':action
                })
                .then((response)=>{
                        let data = response.data.data;

                        $('#trackTimeTotal').html(data.time_total);
                        $('#body_track').html('');
                        data.track.forEach((t) => {
                            $("#body_track").append(`<tr>
                                <td>${t.created_at}</td>
                                <td>${t.start}</td>
                                <td>${t.stop}</td>
                                <td>${t.diff}</td>
                            </tr>`);
                        });
                        if(action == 'finish'){
                            $('#li_actions').remove();
                        }
                })
                .catch((error) =>{
                    alert('Ocoreu algum problema, veja o log!');
                });
            })
        });
    </script>
@endsection
