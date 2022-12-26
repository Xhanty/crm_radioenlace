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
                        <li class="breadcrumb-item active" aria-current="page"> Estadística Proveedores</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Estadisticas Proveedores</h3>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Rango de fecha</label>
                                    <input class="form-control" id="rangofilter" placeholder="Fechas" readonly>
                                </div>
                                <div class="col-lg">
                                    <label for="">Proveedor</label>
                                    <select id="empleadofilter2" class="form-select">
                                        <option value="">Todos</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                        @endforeach
                                    </select>
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
                                        <th>Fecha</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Precio IVA</th>
                                        <th>Precio Retención</th>
                                        <th>Precio Total</th>
                                        <th>Proveedor</th>
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
    <script src="{{ asset('assets/js/app/contabilidad/estadistica_proveedor.js') }}"></script>
@endsection
