@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Actas de Reuniones</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm" id="div_list_actas">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de Actas</h3>
                        </div>
                        @if (auth()->user()->hasPermissionTo('gestionar_actas'))
                        @endif
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="btnNewActa">Nueva Acta</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Asunto</th>
                                        <th>Participantes</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actas as $key => $item)
                                        @php
                                            // Contar asistentes separados por coma
                                            $asistentes = count(explode(',', $item->asistentes));
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->area }}</td>
                                            <td>{{ $item->asunto }}</td>
                                            <td>{{ $asistentes }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->fecha_elaboracion)) }}</td>
                                            <td class="text-center">
                                                <a target="_BLANK"
                                                    href="{{ route('actas_print') }}?token={{ $item->id }}"
                                                    title="Ver o Imprimir" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-print"></i></a>
                                                <a href="javascript:void(0)" title="Modificar" data-id="{{ $item->id }}"
                                                    class="btn btn-warning btn-sm btnEdit"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                                <a href="javascript:void(0)" title="Eliminar"
                                                    data-id="{{ $item->id }}" class="btn btn-danger btn-sm btnDelete"><i
                                                        class="fa fa-trash"></i></a>
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

        <!-- Add -->
        <div class="row row-sm d-none" id="div_new_acta">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Nueva acta</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary back_home">x</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body" style="margin-top: -18px;">
                                <div class="row row-sm">
                                    <div class="col-lg-4">
                                        <label for="">Fecha Elaboración</label>
                                        <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                            placeholder="Fecha Elaboración" type="date">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Hora Inicio</label>
                                        <input class="form-control" id="hora_ini_add" placeholder="Hora Inicio"
                                            type="time">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Hora Fin</label>
                                        <input class="form-control" id="hora_fin_add" placeholder="Hora Fin" type="time">
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg-4">
                                        <label for="">Area</label>
                                        <select class="form-select" id="area_add">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Administración</option>
                                            <option value="2">Comercial</option>
                                            <option value="3">Contabilidad</option>
                                            <option value="4">Gerencia</option>
                                            <option value="5">Operaciones</option>
                                            <option value="6">Tecnología</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Asunto</label>
                                        <input class="form-control" id="asunto_add" placeholder="Asunto" type="text">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Asistentes</label>
                                        <select class="form-select" id="asistentes_add" multiple>
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($usuarios as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row row-sm mt-5">
                                    <div class="table-responsive">
                                        <table id="tbl_data_detail"
                                            class="table border-top-0 table-bordered text-nowrap border-bottom">
                                            <thead>
                                                <tr class="bg-gray">
                                                    <th class="text-center">Compromiso</th>
                                                    <th class="text-center">Asistente</th>
                                                    <th class="text-center">Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background: #f9f9f9;">
                                                    <td class="pad-4">
                                                        <textarea placeholder="Compromiso" class="form-control compromiso_add" cols="30" rows="2"></textarea>
                                                    </td>
                                                    <td class="pad-4">
                                                        <select class="form-select asistente_compromiso_add">
                                                            <option value="">Seleccione una opción</option>
                                                            @foreach ($usuarios as $key => $item)
                                                                <option value="{{ $item->id }}">{{ $item->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center pad-4">
                                                        <div class="d-flex">
                                                            <input type="date" placeholder="Fecha"
                                                                class="form-control text-center fecha_compromiso_add"
                                                                style="border: 0">
                                                            <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                                id="new_row"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row row-sm">
                                    <div class="col-lg">
                                        <label for="">Observaciones</label>
                                        <textarea class="form-control" id="observaciones_add" placeholder="Observaciones" rows="5"
                                            style="resize: none"></textarea>
                                    </div>

                                    <div class="col-lg mt-4">
                                        <label for="">Adjunto</label>
                                        <input class="form-control" accept="application/pdf" id="adjunto_add"
                                            placeholder="Contacto" type="file">
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary" id="btnAddActa">Guardar Acta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var usuarios = @json($usuarios);

            localStorage.setItem('usuarios', JSON.stringify(usuarios));
        });
    </script>
    <script src="{{ asset('assets/js/app/actas_reuniones.js') }}"></script>
@endsection
