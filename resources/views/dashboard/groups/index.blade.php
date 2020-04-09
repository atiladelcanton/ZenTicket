@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"> <a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Grupos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            @shield('grupos.create')
                <a href="{{route('grupos.create')}}" class="btn btn-outline-primary float-right mb-2"><i class="fa fa-plus-circle"></i>&nbsp;@lang('messages.new')</a>
            @endshield
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table header-border table-hover table-custom spacing5">
                    <thead>
                        <tr>
                            <th style="width:3%;">#</th>
                            <th>Grupo</th>
                            <th style="width:10%;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        @shield('grupos.edit')
                                        <a href="{{ route('grupos.editar', $role->id) }}"
                                           class="btn btn-outline-info" data-toggle="tooltip" title="{{ __('messages.edit') }}"
                                           data-placement="top">
                                            <i class="fa fa-edit"></i>
                                        </a>
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
