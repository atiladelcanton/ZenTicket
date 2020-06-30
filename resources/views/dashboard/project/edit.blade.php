@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('projetos')}}">Projetos</a></li>
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
                    <form action="{{ route('projetos.editar',['id'=>$project->id]) }}" method="post" enctype="multipart/form-data">
                        {{ @csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="col-md-12 control-label">Nome do Projeto</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')? old('name'): $project->name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="col-md-12 control-label">Nome do Responsável</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="responsible_name"
                                           name="responsible_name" value="{{old('responsible_name') ? old('responsible_name') : $project->responsible_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="col-md-12 control-label">E-mail do Responsável</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="responsible_email"
                                           name="responsible_email" value="{{old('responsible_email') ? old('responsible_email') :  $project->responsible_email}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="col-md-12 control-label">Logo</label>
                                <div class="col-md-12">
                                    <input type="file" name="logo" id="logo" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="projects" class="control-label">Usuários(s)</label>
                                <div class="col-md-12">
                                    <select name="users[]" id="users" class="form-control selectize @error('users') 'has-error' @enderror" required multiple>
                                        <option value="">-- Selecione --</option>
                                        @foreach($users as $key => $user)

                                            <option value="{{$user->id}}" {{in_array($user->id,$project->usersProject->pluck('user_id')->toArray()) ? 'selected':''}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('users')
                                        <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br/>
                        <div class="form-group">
                            <button type='button' class="btn btn-outline-warning"
                                    onclick="location.href =  '{{route('prioridade')}}' ">Voltar
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
<script type="text/javascript">

    $(function () {
        $('#frm_cadastro').parsley();
        $('.selectize').selectize({
            create: false,
            plugins: ['remove_button'],
            sortField: {
                field: 'text',
            },
            dropdownParent: 'body'
        });


    });
    </script>
@endsection
