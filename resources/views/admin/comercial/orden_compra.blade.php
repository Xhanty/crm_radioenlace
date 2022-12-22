@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Comercial</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Ordenes Compra</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px;">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de ordenes de Compra</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Crear orden de Compra</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Cliente</th>
                                        <th class="wd-15p border-bottom-0">Creador Por</th>
                                        <th class="wd-20p border-bottom-0">Descripción</th>
                                        <th class="wd-10p border-bottom-0">Fecha</th>
                                        <th class="wd-10p border-bottom-0">Cant. Productos</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenes_pendientes as $item)
                                        <tr>
                                            <td>{{ $item->nombre_cliente }}</td>
                                            <td>{{ $item->nombre_empleado }}</td>
                                            <td>{{ $item->descripcion }}</td>
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{ $item->cantidad }}</td>
                                            <td>
                                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-success">Completar</a>
                                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-primary">Ver</a>
                                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-warning">Editar</a>
                                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-danger">Eliminar</a>
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
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px;">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de ordenes de Compra Completadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Cliente</th>
                                        <th class="wd-15p border-bottom-0">Creador Por</th>
                                        <th class="wd-20p border-bottom-0">Descripción</th>
                                        <th class="wd-10p border-bottom-0">Fecha</th>
                                        <th class="wd-10p border-bottom-0">Cant. Productos</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenes_completadas as $item)
                                        <tr>
                                            <td>{{ $item->nombre_cliente }}</td>
                                            <td>{{ $item->nombre_empleado }}</td>
                                            <td>{{ $item->descripcion }}</td>
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{ $item->cantidad }}</td>
                                            <td>
                                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-primary">Ver</a>
                                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-danger">Eliminar</a>
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
    <script src="{{ asset('assets/js/app/comercial/orden_compra.js') }}"></script>
@endsection