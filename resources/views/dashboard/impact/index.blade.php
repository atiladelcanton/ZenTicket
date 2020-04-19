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
            @shield('status-ticket.create')
                <a href="{{route('impactos.create')}}" class="btn btn-outline-primary float-right mb-2"><i class="fa fa-plus-circle"></i>Novo</a>
            @endshield
        </div>
        <div class="col-12">
            <table class="table header-border table-hover table-custom spacing5">
                <thead>
                    <tr>
                        <th style="width:3%;">#</th>
                        <th>Nome</th>
                        <th style="width:10%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($impacts as $impact)
                    <tr>
                        <td>{{$impact->id}}</td>
                        <td>{{$impact->name}}</td>
                        <td>
                            <div class="btn-group">
                                @shield('status-ticket.edit')
                                    <a href="{{ route('impactos.editar', $impact->id) }}"
                                       class="btn btn-outline-info" data-toggle="tooltip" title="Editar"
                                       data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endshield
                                @shield('status-ticket.destroy')
                                    <a href="javascript:;"
                                       class="btn btn-outline-danger" data-toggle="tooltip" title="Remover"
                                       data-placement="top"  onclick="event.preventDefault(); document.getElementById('excluir_{{$impact->id}}').submit();">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{ route('impactos.deletar',[$impact->id]) }}" method="post" id="excluir_{{$impact->id}}" style="display:inline-block;">
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
                        <td colspan="9">{{ $impacts->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
