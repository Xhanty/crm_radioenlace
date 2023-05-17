@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Reparaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Reparaciones Asignadas</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Mis Reparaciones Asignadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Productos</th>
                                        <th class="text-center">Fecha Entrega</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendientes as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->token }}</td>
                                            <td class="text-center">{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td class="text-center">{{ $value->cantidad }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                <button title="Avances" class="btn btn-warning btn-sm btnAvances"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-pencil-alt"></i> Avances
                                                </button>
                                                <br>
                                                <button title="Completar" class="btn btn-success btn-sm btnConfirmar mt-1"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-check"></i> Completar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Mis Reparaciones Completadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Productos</th>
                                        <th class="text-center">Fecha Entrega</th>
                                        <th class="text-center">Fecha Terminado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finalizadas as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->token }}</td>
                                            <td class="text-center">{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td class="text-center">{{ $value->cantidad }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->fecha_terminado)) }}</td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                <button title="Avances" class="btn btn-warning btn-sm btnAvances"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-pencil-alt"></i> Avances
                                                </button>
                                                <br>
                                                <button title="Imprimir" class="btn btn-success btn-sm btnImprimir mt-1"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-print"></i> Imprimir
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/reparaciones/mis_reparaciones.js') }}"></script>
@endsection
