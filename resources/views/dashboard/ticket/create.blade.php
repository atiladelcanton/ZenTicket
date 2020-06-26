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
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="body">
                    <form action="{{ route('chamados.registrar') }}" method="post" id="frm_cadastro">
                        {{ @csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                <label name="priority_id">Prioridade</label>
                                <select name="priority_id" id="priority_id" class="form-control selectize ">
                                    <option value="0">-- Selecione --</option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{$priority->id}}" {{old('priority_id') == $priority->id ? 'selected':'' }}>{{$priority->name}}</option>
                                    @endforeach
                                </select>
                                @error('priority_id')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label name="priority_id">Tipo de Chamado</label>
                                <select name="type_id" class="form-control selectize">
                                    <option value="0">-- Selecione --</option>
                                    @forelse ($types as $type)
                                        <option value="{{$type->id}}" {{old('type_id') == $type->id ? 'selected':'' }}>{{$type->name}}</option>
                                    @empty
                                        <option>Nenhum Tipo encontrado</option>>
                                    @endforelse
                                </select>
                                @error('type_id')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label name="priority_id">Impacto</label>
                                <select name="impact_id" class="form-control selectize">
                                    <option  value="0">-- Selecione --</option>
                                    @forelse ($impacts as $impact)
                                        <option value="{{$impact->id}}" {{old('impact_id') == $impact->id ? 'selected':'' }}>{{$impact->name}}</option>
                                    @empty
                                        <option>Nenhum Impacto encontrado</option>>
                                    @endforelse
                                </select>
                                @error('impact_id')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="control-label">Titulo do Chamado</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">
                                </div>
                                @error('title')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 for="title" class="control-label">Descreva o detalhadamente o motivo do chamado</h5>
                                <textarea id="description" name="description">{{old('description')}}</textarea>
                                @error('impact_id')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 for="title" class="control-label">Envie os arquivos como evidencias, referencias por aqui</h5>
                                <div class="dropzone dropzone-previews" id="my-dropzone"></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type='button' class="btn btn-outline-warning" onclick="location.href =  '{{url('chamados')}}' ">Voltar</button>
                                    <button type="submit" class="btn btn-outline-success mr-2 float-right">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/dropzone/dist/min/dropzone.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/vendor/dropzone/dist/min/basic.min.css')}}"/>
    <style>
        .dropzone{
            background: #f4f7f6;
            border:0px;
        }
    </style>
@endsection

@section('scripts')

<script src="{{asset('assets/vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        $(function () {
            $('.selectize').selectize({
                create: false,
                sortField: {
                    field: 'text',
                },
                dropdownParent: 'body'
            });

            $('#description').summernote({
                tabsize: 2,
                lang: 'pt-BR',
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
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            var uploadedDocumentMap = {}

            $("#my-dropzone").dropzone({url: "/chamados/evidences",
                maxFilesize: 3,  // 3 mb
                acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.docx,zip,rar",
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
