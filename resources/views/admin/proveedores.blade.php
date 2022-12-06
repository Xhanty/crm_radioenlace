@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Empleados</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm" id="div_list_empleados">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de Empleados</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Registrar Empleado</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Razón Social</th>
                                        <th>Contacto</th>
                                        <th>Celular</th>
                                        <th>E-Mail</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $item)
                                        <tr>
                                            <td><img src="https://formrad.com/radio_enlace/avatares_proveedores/{{ $item->avatar }}" alt="img"
                                                    class="avatar avatar-md brround"></td>
                                            <td>{{ $item->razon_social }}</td>
                                            <td>{{ $item->contacto }}</td>
                                            <td>{{ $item->celular }}</td>
                                            <td>
                                                <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                            </td>
                                            <td>
                                                @if ($item->estado == 1)
                                                    <span class="badge bg-success side-badge">Activo</span>
                                                @else
                                                    <span class="badge bg-danger side-badge">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" title="Editar"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                                <button class="btn btn-danger btn-sm" title="Eliminar"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
@endsection
