@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"> <a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$pageTitle}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            @shield('tipos-de-chamados.create')
                <a href="{{route('tipos-de-chamados.create')}}" class="btn btn-outline-primary float-right mb-2"><i class="fa fa-plus-circle"></i>Novo</a>
            @endshield
        </div>
        <div class="col-12">
            <table class="table header-border table-hover table-custom spacing5">
                <thead>
                    <tr>
                        <th style="width:3%;">#</th>
                        <th>Nome</th>
                        <th>Cor</th>
                        <th style="width:10%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($types as $type)
                    <tr>
                        <td>{{$type->id}}</td>
                        <td>{{$type->name}}</td>
                        <td><div style="    width: 30px; height: 30px;     border-radius: 50%; background-color:{{$type->color}}"></div></td>
                        <td>
                            <div class="btn-group">
                                @shield('tipos-de-chamados.edit')
                                    <a href="{{ route('tipos-de-chamados.editar', $type->id) }}"
                                       class="btn btn-outline-info" data-toggle="tooltip" title="Editar"
                                       data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endshield
                                @shield('tipos-de-chamados.destroy')
                                    <a href="javascript:;"
                                       class="btn btn-outline-danger" data-toggle="tooltip" title="Remover"
                                       data-placement="top"  onclick="event.preventDefault(); document.getElementById('excluir_{{$type->id}}').submit();">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{ route('tipos-de-chamados.deletar',[$type->id]) }}" method="post" id="excluir_{{$type->id}}" style="display:inline-block;">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                @endshield
                            </div>
                        </td>
                    </tr>
                    @empty
                        @include('dashboard.inc.not_found_register',['colspan'=>3])
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">{{ $types->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
