@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Facturación</li>
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
                            <h3 class="card-title mt-2">Lista de Facturas</h3>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Rango de fecha</label>
                                    <input class="form-control" id="rangofilter1" readonly placeholder="Fechas">
                                </div>
                            </div>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Crear Factura</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t"
                                id="tbl_pendientes">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Nº Factura</th>
                                        <th>Descripción</th>
                                        <th>Creado Por</th>
                                        <th>Fecha</th>
                                        <th>Cant. Productos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                            <h3 class="card-title mt-2">Lista de Facturas Completadas</h3>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Rango de fecha</label>
                                    <input class="form-control" id="rangofilter2" placeholder="Fechas" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t"
                                id="tbl_completados">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Nº Factura</th>
                                        <th>Descripción</th>
                                        <th>Creado Por</th>
                                        <th>Fecha</th>
                                        <th>Cant. Productos</th>
                                        <th>Estado</th>
                                        <th>Subtotal</th>
                                        <th>IVA</th>
                                        <th>Retención</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
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
    <script src="{{ asset('assets/js/app/contabilidad/facturacion.js') }}"></script>
@endsection
