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
            @shield('prioridade.create')
                <a href="{{route('prioridade.create')}}" class="btn btn-outline-primary float-right mb-2"><i class="fa fa-plus-circle"></i>Novo</a>
            @endshield
        </div>
        <div class="col-12">
            <table class="table header-border table-hover table-custom spacing5">
                <thead>
                    <tr>
                        <th style="width:3%;">#</th>
                        <th>Nome</th>
                        <th>Sla</th>
                        <th style="width:10%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($priorities as $priority)
                    <tr>
                        <td>{{$priority->id}}</td>
                        <td>{{$priority->name}}</td>
                        <td>{{$priority->sla}}</td>
                        <td>
                            <div class="btn-group">
                                @shield('prioridade.edit')
                                    <a href="{{ route('prioridade.editar', $priority->id) }}"
                                       class="btn btn-outline-info" data-toggle="tooltip" title="Editar"
                                       data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endshield
                                @shield('prioridade.destroy')
                                    <a href="javascript:;"
                                       class="btn btn-outline-danger" data-toggle="tooltip" title="Remover"
                                       data-placement="top"  onclick="event.preventDefault(); document.getElementById('excluir_{{$priority->id}}').submit();">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{ route('prioridade.deletar',[$priority->id]) }}" method="post" id="excluir_{{$priority->id}}" style="display:inline-block;">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                @endshield
                            </div>
                        </td>
                    </tr>
                    @empty
                        @include('dashboard.inc.not_found_register',['colspan'=>4])
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">{{ $priorities->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
