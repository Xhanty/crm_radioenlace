@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Puntos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Mis Puntos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mis Puntos Pendientes</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Fecha</th>
                                        <th class="wd-20p border-bottom-0">Descripción</th>
                                        <th class="wd-15p border-bottom-0">Tipo</th>
                                        <th class="wd-15p border-bottom-0">Cantidad</th>
                                        <th class="wd-10p border-bottom-0">Asignados Por</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($puntos_pendientes as $value)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($value->fecha)) }}</td>
                                            <td>{{ $value->descripcion }}</td>
                                            <td>
                                                @if ($value->tipo == 0)
                                                    Fijos
                                                @elseif($value->tipo == 1)
                                                    Ocasionales
                                                @else
                                                    Negativos
                                                @endif
                                            </td>
                                            <td>{{ $value->cantidad }}</td>
                                            <td>{{ $value->nombre }}</td>
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
                    <div class="card-header">
                        <h3 class="card-title">Mis Puntos Cobrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Fecha</th>
                                        <th class="wd-20p border-bottom-0">Descripción</th>
                                        <th class="wd-15p border-bottom-0">Tipo</th>
                                        <th class="wd-15p border-bottom-0">Cantidad</th>
                                        <th class="wd-10p border-bottom-0">Asignados Por</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($puntos_cobrados as $value)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($value->fecha)) }}</td>
                                            <td>{{ $value->descripcion }}</td>
                                            <td>
                                                @if ($value->tipo == 0)
                                                    Fijos
                                                @elseif($value->tipo == 1)
                                                    Ocasionales
                                                @else
                                                    Negativos
                                                @endif
                                            </td>
                                            <td>{{ $value->cantidad }}</td>
                                            <td>{{ $value->nombre }}</td>
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
