@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body">
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                        <div class="ml-4">
                            <span>Chamados Pendentes</span>
                            <h4 class="mb-0 font-weight-medium">{{$ticketsPending}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body">
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-credit-card"></i></div>
                        <div class="ml-4">
                            <span>Chamados em Tratamento</span>
                            <h4 class="mb-0 font-weight-medium">{{$ticketsWorking}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body">
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-users"></i></div>
                        <div class="ml-4">
                            <span>Chamados Concluídos</span>
                            <h4 class="mb-0 font-weight-medium">{{$ticketsFinish}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
