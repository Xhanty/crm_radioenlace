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
                                        <th class="wd-10p border-bottom-0">Marca</th>
                                        <th class="wd-10p border-bottom-0">Modelo</th>
                                        <th class="wd-10p border-bottom-0">Serial</th>
                                        <th class="wd-10p border-bottom-0">Cod Interno</th>
                                        <th class="wd-15p border-bottom-0">Cnt.</th>
                                        <th class="wd-10p border-bottom-0">Cnt. Asig.</th>
                                        <th class="wd-15p border-bottom-0">Categoria</th>
                                        <th class="wd-15p border-bottom-0">Ubicacion</th>
                                        <th class="wd-15p border-bottom-0">Ubicacion REF</th>
                                        <th class="wd-15p border-bottom-0">Fecha Act.</th>
                                        <th class="wd-15p border-bottom-0">Creador</th>
                                        <th class="wd-10p border-bottom-0">Status</th>
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/gestion_inventario.js') }}"></script>
@endsection
