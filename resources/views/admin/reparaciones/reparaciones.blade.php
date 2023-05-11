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
                        <li class="breadcrumb-item active" aria-current="page"> Reparaciones</li>
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
                            <h3 class="card-title mt-2">Lista de Equipos en Reparación</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Registrar Recepción</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Técnico Asignado</th>
                                        <th>Productos</th>
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
                            <h3 class="card-title mt-2">Lista de Equipos Reparados</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Fecha Recibido</th>
                                        <th>Fecha Reparación</th>
                                        <th>Fecha Entrega</th>
                                        <th>Técnico Asignado</th>
                                        <th>Status</th>
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

        <!-- Modal Add -->
    <div class="modal  fade" id="modalAdd">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Registro de recepción</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Cliente</label>
                            <select id="cliente_add" class="form-select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }} ({{ $cliente->nit }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Introduzca los correos separados por coma (,) los cuales recibiran el certificado de recepción de productos</label>
                            <input class="form-control" id="correos_add" placeholder="Correos electrónicos para enviar informe separados por coma (,)" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Persona que recibe</label>
                            <select id="encargado_add" class="form-select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Categoría</label>
                            <select id="categoria_add" class="form-select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Modelo</label>
                            <input class="form-control" id="modelo_add" placeholder="Modelo" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Serie</label>
                            <input class="form-control" id="serie_add" placeholder="Serie" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Accesorios</label>
                            <select id="accesorios_add" multiple class="form-select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($accesorios as $accesorio)
                                    <option value="{{ $accesorio->id }}">{{ $accesorio->accesorio }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones" rows="3" id="observaciones_add"
                                style="height: 90px; resize: none"></textarea>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Foto</label>
                            <input class="form-control" id="foto_add" type="file" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnGuardarVehiculo" type="button">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/reparaciones/reparaciones.js') }}"></script>
@endsection
