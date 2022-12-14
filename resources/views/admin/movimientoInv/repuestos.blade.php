@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Movimientos Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Repuestos Reparación</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Productos utilizados como repuestos en reparaciones</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Producto</th>
                                        <th class="wd-10p border-bottom-0">Serial</th>
                                        <th class="wd-10p border-bottom-0">Cod. Int</th>
                                        <th class="wd-10p border-bottom-0">Cantidad</th>
                                        <th class="wd-15p border-bottom-0">Cliente</th>
                                        <th class="wd-15p border-bottom-0">Tipo</th>
                                        <th class="wd-15p border-bottom-0">Creado Por</th>
                                        <th class="wd-10p border-bottom-0">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($repuestos as $value)
                                        <tr>
                                            <td>{{ $value->nombre }}</td>
                                            <td>{{ $value->serial }}</td>
                                            <td>{{ $value->cod_interno }}</td>
                                            <td>{{ $value->cantidad }}</td>
                                            <td>{{ $value->cantidad }}</td>
                                            <td>Producto Reparación</td>
                                            <td>{{ $value->cantidad }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->fecha)) }}</td>
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
