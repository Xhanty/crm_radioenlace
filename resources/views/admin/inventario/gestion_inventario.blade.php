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
                            <h3 class="card-title mt-2">Lista de Productos</h3>
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/gestion_inventario.js') }}"></script>
@endsection
