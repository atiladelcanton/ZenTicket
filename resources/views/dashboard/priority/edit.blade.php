@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ $pageTitle }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('prioridade')}}">Status Ticket</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo {{$pageTitle}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="body">
                    <form action="{{ route('prioridade.alterar',[$priority->id]) }}" method="post">
                        {{ @csrf_field() }}
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="name" class="col-md-12 control-label">Descrição</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="name" name="name" value="{{$priority->name}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="time" class="col-md-12 control-label">Sla</label>
                                    <div class="col-md-12">
                                        <input type="time" class="form-control" id="sla" name="sla" value="{{$priority->sla}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="col-md-12 control-label">Cor</label>
                                    <div class="col-md-12">
                                        <input type="color" class="form-control" id="color" name="color" value="{{$priority->color}}">
                                    </div>
                                </div>
                            </div>
                        <br/>
                        <div class="form-group">
                            <button type='button' class="btn btn-outline-warning"
                                    onclick="location.href =  '{{route('impactos')}}' ">Voltar
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

@endsection
