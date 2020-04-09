@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"> <a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            @shield('usuarios.create')
            <a href="{{route('usuarios.create')}}" class="btn btn-outline-primary float-right mb-2"><i class="fa fa-plus-circle"></i>&nbsp;@lang('messages.new')</a>
            @endshield
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table header-border table-hover table-custom spacing5">
                    <thead>
                    <tr>
                        <th style="width:3%;">#</th>
                        <th>Grupo</th>
                        <th>Nome</th>
                        <th>E-mai</th>
                        <th>Data Cadastro</th>
                        <th style="width:10%;">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->roles[0]->name}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->format('d/m/Y')}}</td>
                            <td>
                                <div class="btn-group">
                                    @shield('usuarios.edit')
                                    <a href="{{ route('usuarios.editar', $user->id) }}"
                                       class="btn btn-outline-info" data-toggle="tooltip" title="{{ __('messages.edit') }}"
                                       data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endshield
                                    @shield('usuarios.destroy')
                                        <a href="javascript:;"
                                           class="btn btn-outline-danger" data-toggle="tooltip" title="{{ __('messages.destroy') }}"
                                           data-placement="top"  onclick="event.preventDefault(); document.getElementById('excluir_{{$user->id}}').submit();">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ url('usuarios',$user->id) }}" method="post" id="excluir_{{$user->id}}" style="display:inline-block;">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    @endshield
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
