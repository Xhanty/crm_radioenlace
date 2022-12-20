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
                        <li class="breadcrumb-item active" aria-current="page"> Inventario</li>
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
                            <h3 class="card-title mt-2">Existencias Inventario</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="tbl_inventario_existencias_img">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">Imagen</th>
                                        <th class="wd-20p border-bottom-0">Producto</th>
                                        <th class="wd-8p border-bottom-0">Marca</th>
                                        <th class="wd-8p border-bottom-0">Modelo</th>
                                        <th class="wd-8p border-bottom-0">Serial</th>
                                        <th class="wd-8p border-bottom-0">Cod Interno</th>
                                        <th class="wd-5p border-bottom-0">Cnt.</th>
                                        <th class="wd-5p border-bottom-0">Cnt.<br>Asig.</th>
                                        <th class="wd-15p border-bottom-0">Categoria</th>
                                        <th class="wd-15p border-bottom-0">Ubicacion</th>
                                        <th class="wd-15p border-bottom-0">Ubicacion<br>REF</th>
                                        <th class="wd-15p border-bottom-0">Creador</th>
                                        <th class="wd-10p border-bottom-0">Status</th>
                                        <th class="wd-20p border-bottom-0">Acciones</th>
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
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Gestionar Inventario</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="table_inventario_gestion_img">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">Imagen</th>
                                        <th class="wd-20p border-bottom-0">Nombre</th>
                                        <th class="wd-15p border-bottom-0">Categoria</th>
                                        <th class="wd-10p border-bottom-0">Cant. asociados</th>
                                        <th class="wd-15p border-bottom-0">Cod Producto</th>
                                        <th class="wd-15p border-bottom-0">Cod Interno</th>
                                        <th class="wd-15p border-bottom-0">Marca</th>
                                        <th class="wd-15p border-bottom-0">Modelo</th>
                                        <th class="wd-15p border-bottom-0">Serial</th>
                                        <th class="wd-10p border-bottom-0">Estatus</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
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

        <!-- Modal Edit -->
        <div class="modal  fade" id="modal_edit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Existencia de Inventario</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control" id="id_edit" type="hidden" disabled readonly>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Serial</label>
                                <input class="form-control" id="serial_edit" placeholder="Serial" type="text">
                            </div>
                            <div class="col-lg">
                                <label for="">Código Interno</label>
                                <input class="form-control" id="codigo_edit" placeholder="Código Interno" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cantidad</label>
                                <input class="form-control" id="cantidad_edit" placeholder="Cantidad" type="number">
                            </div>
                            <div class="col-lg">
                                <label for="">Cantidad Asignada</label>
                                <input class="form-control" id="cantidad_asig_edit" placeholder="Cantidad Asignada" type="number">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Ubicación</label>
                                <select class="form-select" id="ubicacion_edit">
                                    @foreach ($almacenes as $almacen)
                                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Ubicación Referencial</label>
                                <input class="form-control" id="ubicacion_ref_edit" placeholder="Ubicación Referencial" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Asignado a</label>
                                <select class="form-select" id="asignado_edit">
                                    @foreach ($empleados as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción</label>
                                <textarea class="form-control" placeholder="Descripción" rows="3" id="descripcion_edit"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificarInventario" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/gestion_inventario.js') }}"></script>
@endsection