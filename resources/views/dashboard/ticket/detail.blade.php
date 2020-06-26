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
                        <div class="row" style="display: flex;justify-content: center;align-items: center;">
                            @foreach($ticket->documents as $document)
                                <div class="col-md-2">
                                        <div class="icon bg-warning hvr-float-shadow" style="display: flex;justify-content: center;align-items: center;border-radius: 5px;">
                                            <a href="javascript:;" style="color: #fff;font-weight: bold;text-transform: uppercase;">
                                                @if(in_array($document->extension_document,['jpg','png','jpeg']))
                                                    <img src="{{asset('img/files/jpg.svg')}}" style="width: 43px;padding: 5px;"/>
                                                @elseif(in_array($document->extension_document,['doc','docx']))
                                                    <img src="{{asset('img/files/doc.svg')}}" style="width: 43px;padding: 5px;"/>
                                                @elseif($document->extension_document == 'pdf')
                                                    <img src="{{asset('img/files/pdf.svg')}}" style="width: 43px;padding: 5px;"/>
                                                @elseif(in_array($document->extension_document,['xls','xlsx','csv']))
                                                    <img src="{{asset('img/files/tablet.svg')}}" style="width: 43px;padding: 5px;"/>
                                                @endif
                                                Baixar
                                            </a>
                                        </div>
                                </div>
                            @endforeach
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
                        <li class="list-group-item">
                            <small class="text-muted">Ações: </small>
                            <p class="mb-0">
                                <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Iniciar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="play" class="btn btn-outline-info mb-2 btn-action" title="Save"><span class="sr-only">Save</span> <i class="fa fa-play"></i></button>
                                <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Pausar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="pause" class="btn btn-outline-warning mb-2 btn-action" title="Save" disabled><span class="sr-only">Save</span> <i class="fa fa-pause"></i></button>
                                <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>Finalizar Tarefa</strong>" data-ticket={{$ticket->ticket_number}} data-action="finish" class="btn btn-outline-success mb-2 btn-action" title="Save"><span class="sr-only">Save</span> <i class="fa fa-eject"></i></button>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Tempo investido no atendimento:&nbsp;&nbsp; </small>
                            @if($trackTime != 0)
                                <strong>{{$trackTime}}</strong>
                            @else
                                <strong>0</strong>
                            @endif
                        </li>

                        <li class="list-group-item">
                            <small class="text-muted">Extrato de Horas </small>
                                <table class="table header-border table-hover table-custom spacing5">
                                    <thead>
                                        <th>Data</th>
                                        <th>Inicio</th>
                                        <th>Parada</th>
                                    </thead>
                                    <tbody>
                                        @foreach($ticket->timeLineTicket as $timeLine)
                                            <tr>
                                                <td>{{$timeLine->created_at->format('d/m/Y')}}</td>
                                                <td>{{$timeLine->start}}</td>
                                                <td>{{$timeLine->stop}}</td>
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
                        <div class="dropzone dropzone-previews" id="my-dropzone"></div>
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
                        <li class="timeline-item">
                            <div class="timeline-info">
                                <span>25 de Junho 2018 23:23</span>
                            </div>
                            <div class="timeline-marker"></div>
                            <div class="timeline-content" style="width: 100%">
                                <h3 class="timeline-title">Revisão Deploy</h3>
                                <p>Foi realizado os ajuste conforme solicitado, segue evidencias de ajustes.</p>
                                    <div class="row" style="display: flex;justify-content: center;align-items: center;">
                                        @foreach($ticket->documents as $document)
                                            <div class="col-md-2">
                                                    <div class="icon bg-warning hvr-float-shadow" style="display: flex;justify-content: center;align-items: center;border-radius: 5px;">
                                                        <a href="javascript:;" style="color: #fff;font-weight: bold;text-transform: uppercase;">
                                                            @if(in_array($document->extension_document,['jpg','png','jpeg']))
                                                                <img src="{{asset('img/files/jpg.svg')}}" style="width: 43px;padding: 5px;"/>
                                                            @elseif(in_array($document->extension_document,['doc','docx']))
                                                                <img src="{{asset('img/files/doc.svg')}}" style="width: 43px;padding: 5px;"/>
                                                            @elseif($document->extension_document == 'pdf')
                                                                <img src="{{asset('img/files/pdf.svg')}}" style="width: 43px;padding: 5px;"/>
                                                            @elseif(in_array($document->extension_document,['xls','xlsx','csv']))
                                                                <img src="{{asset('img/files/tablet.svg')}}" style="width: 43px;padding: 5px;"/>
                                                            @endif
                                                            Baixar
                                                        </a>
                                                    </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                        </li>
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
        });
    </script>
@endsection
