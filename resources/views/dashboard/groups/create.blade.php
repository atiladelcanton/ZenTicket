@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('grupos')}}">Grupos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo Grupos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="body">
                    <form action="{{ route('grupos.registrar') }}" method="post">
                        {{ @csrf_field() }}
                        <fieldset>
                            <legend>Dados do Grupo</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" class="col-md-12 control-label"> Nome do Grupo </label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Digite o nome" value="{{old('name')}}">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br/>
                        <fieldset>
                            <legend>Permissões</legend>
                            <table class="table header-border table-hover table-custom spacing5">
                                <thead>
                                <tr>
                                    <th style="width: 69px;"></th>
                                    <th>Modulo</th>
                                    <th style="width: 69px;">Listar</th>
                                    <th  style="width: 69px;">Criar</th>
                                    <th  style="width: 69px;">Alterar</th>
                                    <th  style="width: 69px;">Visualizar</th>
                                    <th  style="width: 69px;">Deletar</th>
                                </tr>
                                </thead>
                                @foreach($modules as $module)
                                    <tr>
                                        <td class="text-center">
                                            <div class="fancy-checkbox">
                                                <label><input class="form-control permissionChecked"type="checkbox"/><span>&nbsp;</span></label>
                                            </div>
                                        </td>
                                        <td>{{ $module->name }}</td>
                                        @foreach($module->permissions as $permission)

                                            <td class="text-center">
                                                <div class="fancy-checkbox">
                                                    <label><input class="form-control" type="checkbox" {{ request()->has('permissions') != null && in_array($permission->id, request()->get('permissions')) ? 'checked' : '' }} name="permissions[{{ $permission->id }}]"><span>&nbsp;</span></span></label>
                                                </div>

                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </fieldset>
                        <div class="form-group">
                            <button type='button' class="btn btn-outline-warning" onclick="location.href =  '{{url('grupos')}}' ">Voltar</button>
                            <button type="submit" class="btn btn-outline-success mr-2 float-right">Salvar</button>
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
            $('.permissionChecked').on("click", function () {

                var $table = $(this).closest('tr');
                if (this.checked) {
                    $table.find('input[type="checkbox"]').prop('checked', true);
                } else {
                    $table.find('input[type="checkbox"]').prop('checked', false)
                }
            });
        });
    </script>
@endsection
