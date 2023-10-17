@extends('layouts.menu')

@section('css')
    <style>
        tr td:nth-child(1) {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Inventario (Stock)</li>
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
                            <h3 class="card-title mt-2">Lista de Productos</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                                <div class="input-group">
                                    <input class="form-control text-center" id="serial_search"
                                        placeholder="Serial o Código Interno" type="text">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" id="btnSearchSerial" type="button">
                                            <span class="input-group-btn">
                                                <i class="fa fa-search" style="display: inline-block !important"></i>
                                            </span>
                                        </button>
                                    </span>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="table_productos_gestion_img">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Imagen</th>
                                        <th class="border-bottom-0">Cod Producto</th>
                                        <th class="border-bottom-0">Nombre</th>
                                        <th class="border-bottom-0">Categoría</th>
                                        <th class="border-bottom-0">SubCategoría</th>
                                        <th class="border-bottom-0">Marca</th>
                                        <th class="border-bottom-0">Modelo</th>
                                        <th class="border-bottom-0">Disponible</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Acciones</th>
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

        <!-- Modal Ingreso -->
        <div class="modal  fade" id="modalIngreso">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Tipo Ingreso</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="producto_id_ingreso">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Ingreso</label>
                                <select id="tipoingreso_select" class="form-select">
                                    <option value="*">Seleccione una opción</option>
                                    <option value="1">Compra</option>
                                    <option value="2">Reingreso</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        @include('admin.inventario.modals.ingreso.almacenes')
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnIngresoProducto" type="button">Seleccionar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Salida -->
        <div class="modal  fade" id="modalSalida">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Tipo Salida</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="producto_id_salida">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Salida</label>
                                <select id="tiposalida_select" class="form-select">
                                    <option value="*">Seleccione una opción</option>
                                    <option value="1">Alquiler</option>
                                    <option value="2">Asignación</option>
                                    <option value="3">Préstamo</option>
                                    <option value="4">Instalación</option>
                                    <option value="5">Venta</option>
                                    <option value="6">Dado de baja</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        @include('admin.inventario.modals.salida.almacenes')
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnSalidaProducto" type="button">Seleccionar</button>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.inventario.modals.visualizar')
        @include('admin.inventario.modals.modificar_serial')


        @include('admin.inventario.modals.ingreso.compra')
        @include('admin.inventario.modals.ingreso.reingreso')


        @include('admin.inventario.modals.salida.alquiler')
        @include('admin.inventario.modals.salida.asignado')
        @include('admin.inventario.modals.salida.danado')
        @include('admin.inventario.modals.salida.instalacion')
        @include('admin.inventario.modals.salida.prestamo')
        @include('admin.inventario.modals.salida.venta')

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/gestion_inventario.js') }}"></script>
    <script src="{{ asset('assets/plugins/treeview/treeview.js') }}"></script>
    <script>
        setTimeout(() => {
            // Obtener la URL de la página actual
            var url = new URL(window.location.href);

            // Obtener el valor del parámetro 'pr'
            var prParam = url.searchParams.get("pr");

            // Validar si 'pr' está presente
            if (prParam !== null) {
                console.log("El parámetro 'pr' está presente con el valor: " + prParam);
                $("#table_productos_gestion_img_filter input").val(prParam).trigger("keyup");
            } else {
                console.log("El parámetro 'pr' no está presente en la URL.");
            }
        }, 2000);
    </script>
@endsection
