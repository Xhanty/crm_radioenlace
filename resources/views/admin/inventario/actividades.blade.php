@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Actividades Inventario</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <style>
            #tbl_actividades_inventario tbody tr td:nth-child(2) div{
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Actividades Inventario</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="tbl_actividades_inventario">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Usuario a cargo</th>
                                        <th class="wd-20p border-bottom-0">Producto</th>
                                        <th class="wd-15p border-bottom-0">Cantidad</th>
                                        <th class="wd-15p border-bottom-0">Fecha</th>
                                        <th class="wd-15p border-bottom-0">Tipo</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Registro de Almacén</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Nombre de Almacén</label>
                                <input class="form-control" id="almacenadd" placeholder="Nombre de Almacén" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarAlmacen" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/almacenes.js') }}"></script>
@endsection
