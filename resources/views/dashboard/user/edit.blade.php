@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('usuarios')}}">Usuários</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo Usuário</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="body">
                    <form action="{{ route('usuarios.editar',['user' => $user->id]) }}" method="post" id="frm_cadastro">
                        {{ @csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <label for="role_id" class="control-label">Grupo</label>
                                <div class="col-md-12">
                                    <select name="role_id"
                                            class="form-control @error('role_id') 'has-error' @enderror"
                                            required>
                                        <option value="">-- Selecione --</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected':''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group  @error('name') 'has-error' @enderror">
                                    <label name="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                           value="{{old('name')?old('name') : $user->name}}">
                                    @error('name')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group  @error('email') 'has-error' @enderror">
                                    <label name="name">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           required value="{{old('email') ? old('email') : $user->email}}">
                                    @error('email')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type='button' class="btn btn-outline-warning"
                                            onclick="location.href =  '{{url('usuarios')}}' ">Voltar
                                    </button>
                                    <button type="submit" class="btn btn-outline-success mr-2 float-right">Salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#frm_cadastro').parsley();
        });
    </script>
@endsection
