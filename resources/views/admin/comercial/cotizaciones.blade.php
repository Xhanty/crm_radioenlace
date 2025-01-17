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
                        <li class="breadcrumb-item active" aria-current="page"> Cotizaciones</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Pendientes -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Cotizaciones Pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Crear Cotización</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Creador</th>
                                        <th>Cliente</th>
                                        <th style="width: 37%">Descripción</th>
                                        <th>Fecha</th>
                                        <th>Cant.<br>Productos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizaciones_pendientes as $cotizacion)
                                        <tr>
                                            <td>{{ $cotizacion->code }}</td>
                                            <td>{{ $cotizacion->creador }}</td>
                                            <td>{{ $cotizacion->razon_social }}</td>
                                            <td>{{ $cotizacion->descripcion }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($cotizacion->created_at)) }}</td>
                                            <td>{{ $cotizacion->productos }}</td>
                                            <td class="text-center">
                                                <!--<a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                                    title="Ver Detalles" class="btn btn-primary btn-sm btnView"><i
                                                                        class="fa fa-eye"></i></a>-->
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Modificar" class="btn btn-warning btn-sm btnEdit"><i
                                                        class="fa fa-edit"></i></a>
                                                <!--<a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                            title="Completar" class="btn btn-success btn-sm btnCompletar"><i
                                                                class="fa fa-check"></i></a>-->
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Eliminar" class="btn btn-danger btn-sm btnEliminar"><i
                                                        class="fa fa-trash"></i></a>
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Enviar por correo" class="btn btn-success btn-sm btnEmail"><i
                                                        class="fa fa-envelope"></i></a>
                                                <a target="_BLANK"
                                                    href="{{ route('cotizaciones_print') }}?token={{ $cotizacion->id }}"
                                                    title="Ver o Imprimir" class="btn btn-primary btn-sm btnPrint"><i
                                                        class="fa fa-print"></i></a>
                                                <a target="_BLANK"
                                                    href="{{ route('history_cotizaciones') }}?token={{ $cotizacion->id }}"
                                                    title="Avances y/o Anexos" class="btn btn-success btn-sm btnHistory"><i
                                                        class="fa fa-book"></i></a>
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

        <!-- Pendientes de aprobar -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-info" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Cotizaciones Pendientes de Aprobar</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <!--<button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                        data-bs-effect="effect-scale">Crear Cotización</button>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Creador</th>
                                        <th>Cliente</th>
                                        <th style="width: 37%">Descripción</th>
                                        <th>Fecha</th>
                                        <th>Cant.<br>Productos</th>
                                        <th class="text-center">¿Aprobada?</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizaciones_para_aprobar as $cotizacion)
                                        <tr>
                                            <td>{{ $cotizacion->code }}</td>
                                            <td>{{ $cotizacion->creador }}</td>
                                            <td>{{ $cotizacion->razon_social }}</td>
                                            <td>{{ $cotizacion->descripcion }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($cotizacion->created_at)) }}</td>
                                            <td>{{ $cotizacion->productos }}</td>
                                            <td class="text-center">
                                                <select class="form-control aprobado_select"
                                                    data-id="{{ $cotizacion->id }}">
                                                    <option value="0"
                                                        {{ $cotizacion->aprobado == 0 ? 'selected' : '' }}>Pendiente
                                                    </option>
                                                    <option value="2"
                                                        {{ $cotizacion->aprobado == 2 ? 'selected' : '' }}>No</option>
                                                    <option value="1"
                                                        {{ $cotizacion->aprobado == 1 ? 'selected' : '' }}>Sí</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <!--<a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                                    title="Ver Detalles" class="btn btn-primary btn-sm btnView"><i
                                                                        class="fa fa-eye"></i></a>-->
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Eliminar" class="btn btn-danger btn-sm btnEliminar"><i
                                                        class="fa fa-trash"></i></a>
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Enviar por correo" class="btn btn-success btn-sm btnEmail"><i
                                                        class="fa fa-envelope"></i></a>
                                                <a target="_BLANK"
                                                    href="{{ route('cotizaciones_print') }}?token={{ $cotizacion->id }}"
                                                    title="Ver o Imprimir" class="btn btn-primary btn-sm btnPrint"><i
                                                        class="fa fa-print"></i></a>
                                                <a target="_BLANK"
                                                    href="{{ route('history_cotizaciones') }}?token={{ $cotizacion->id }}"
                                                    title="Avances y/o Anexos"
                                                    class="btn btn-success btn-sm btnHistory"><i
                                                        class="fa fa-book"></i></a>
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

        <!-- Completadas -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Cotizaciones Completadas</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <!-- Excel -->
                            <a href="{{ route('cotizaciones_excel') }}" class="btn btn-primary">Generar Excel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Creador</th>
                                        <th>Cliente</th>
                                        <th style="width: 37%">Descripción</th>
                                        <th>Fecha</th>
                                        <th>Cant.<br>Productos</th>
                                        <th class="text-center">¿Aprobada?</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizaciones_aprobadas as $cotizacion)
                                        @php
                                            $aprobado = $cotizacion->aprobado;
                                            $color = '';
                                            $color_fecha = '';

                                            if ($aprobado == 0) {
                                                $color = 'rgb(255 193 7 / 30%);';
                                            } elseif ($aprobado == 1) {
                                                $color = 'rgb(11 163 96 / 30%);';
                                            } elseif ($aprobado == 2) {
                                                $color = 'rgb(245 60 91 / 30%);';
                                            }

                                            if ($cotizacion->fecha_revision) {
                                                $color_fecha = 'rgb(245 60 91 / 30%);';
                                            }
                                        @endphp
                                        <tr style="background: {{ $color }}">
                                            <td>{{ $cotizacion->code }}</td>
                                            <td>{{ $cotizacion->creador }}</td>
                                            <td>{{ $cotizacion->razon_social }}</td>
                                            <td>{{ $cotizacion->descripcion }}</td>
                                            <td>{{ date('d-m-Y', strtotime($cotizacion->created_at)) }}</td>
                                            <td>{{ $cotizacion->productos }}</td>
                                            <td class="text-center">
                                                <select class="form-control aprobado_select"
                                                    data-id="{{ $cotizacion->id }}">
                                                    <option value="0"
                                                        {{ $cotizacion->aprobado == 0 ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="2"
                                                        {{ $cotizacion->aprobado == 2 ? 'selected' : '' }}>No</option>
                                                    <option value="1"
                                                        {{ $cotizacion->aprobado == 1 ? 'selected' : '' }}>Sí</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" data-id="{{ $cotizacion->id }}"
                                                    title="Fecha Revisión" style="background: {{ $color_fecha }}"
                                                    placeholder="Fecha Revisión" onfocus="(this.type='date')"
                                                    class="form-control mb-2 date_revision text-center"
                                                    value="{{ $cotizacion->fecha_revision }}">
                                                <!--<a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                                    title="Ver Detalles" class="btn btn-primary btn-sm btnView"><i
                                                                        class="fa fa-eye"></i></a>-->
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Modificar" class="btn btn-warning btn-sm btnEdit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0);" data-id="{{ $cotizacion->id }}"
                                                    title="Enviar por correo" class="btn btn-success btn-sm btnEmail"><i
                                                        class="fa fa-envelope"></i></a>
                                                <a target="_BLANK"
                                                    href="{{ route('cotizaciones_print') }}?token={{ $cotizacion->id }}"
                                                    title="Ver o Imprimir" class="btn btn-primary btn-sm btnPrint"><i
                                                        class="fa fa-print"></i></a>
                                                <a target="_BLANK"
                                                    href="{{ route('history_cotizaciones') }}?token={{ $cotizacion->id }}"
                                                    title="Avances y/o Anexos"
                                                    class="btn btn-success btn-sm btnHistory"><i
                                                        class="fa fa-book"></i></a>
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

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Crear Cotización</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="wizard2" role="application" class="wizard clearfix">
                            <div class="steps clearfix">
                                <ul role="tablist">
                                    <li role="tab" class="done">
                                        <a href="javascript:void(0);" id="title_basica">
                                            <span class="number">1</span>
                                            <span class="title">Información Básica</span>
                                        </a>
                                    </li>
                                    <li role="tab" class="first current" id="title_productos">
                                        <a href="javascript:void(0);">
                                            <span class="number">2</span>
                                            <span class="title">Productos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="content clearfix">
                                <div id="div_informacion">
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="">Cliente</label>
                                            <select id="cliente_add" class="form-select">
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Duración del contrato (Opcional)</label>
                                            <input class="form-control" id="duracion_add" type="text"
                                                placeholder="Duración del contrato (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Validez de la oferta</label>
                                            <input class="form-control" id="validez_add" type="text"
                                                placeholder="Validez de la oferta">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Tiempo de entrega (Opcional)</label>
                                            <input class="form-control" id="tiempo_add" type="text"
                                                placeholder="Tiempo de entrega (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Forma de pago</label>
                                            <input class="form-control" id="formapago_add" type="text"
                                                placeholder="Forma de pago">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Descuento % (Opcional)</label>
                                            <input class="form-control" id="descuento_add" type="text"
                                                placeholder="Descuento % (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Descripción (Opcional)</label>
                                            <textarea class="form-control" placeholder="Descripción de la cotización (Opcional)" rows="3"
                                                id="descripcion_add" style="height: 70px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Incluye (Opcional)</label>
                                            <textarea class="form-control" placeholder="Incluye (Opcional)" rows="3" id="incluye_add"
                                                style="height: 70px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Garantía (Opcional)</label>
                                            <textarea class="form-control" placeholder="Garantía de la cotización (Opcional)" rows="2" id="garantia_add"
                                                style="height: 60px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Envío (Opcional)</label>
                                            <textarea class="form-control" placeholder="Envío (Opcional)" rows="2" id="envio_add"
                                                style="height: 60px; resize: none"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_productos" class="d-none">
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="">Productos</label>
                                                </div>
                                                <div class="col-4 d-flex" style="justify-content: end">
                                                    <div class="d-flex">
                                                        <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                            id="new_row_producto">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                        <a class="center-vertical mg-s-10" title="Agregar Título"
                                                            href="javascript:void(0)" id="new_row_titulo">
                                                            <i class="fa fa-font"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="div_list_productos"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions clearfix">
                                <ul role="menu">
                                    <li class="disabled">
                                        <a href="javascript:void(0);" id="previus" role="menuitem">Anterior</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="next" role="menuitem">Siguiente</a>
                                    </li>
                                    <li class="d-none">
                                        <a href="javascript:void(0);" id="finish" role="menuitem">Guardar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver Cotización</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="wizard2" role="application" class="wizard clearfix">
                            <div class="steps clearfix">
                                <ul role="tablist">
                                    <li role="tab" class="done">
                                        <a href="javascript:void(0);" id="title_basica_view">
                                            <span class="number">1</span>
                                            <span class="title">Información Básica</span>
                                        </a>
                                    </li>
                                    <li role="tab" class="first current" id="title_productos_view">
                                        <a href="javascript:void(0);">
                                            <span class="number">2</span>
                                            <span class="title">Productos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="content clearfix">
                                <div id="div_informacion_view">
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="">Cliente</label>
                                            <select id="cliente_view" disabled class="form-select">
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Duración del contrato (Opcional)</label>
                                            <input class="form-control" id="duracion_view" disabled type="text"
                                                placeholder="Duración del contrato (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Validez de la oferta</label>
                                            <input class="form-control" id="validez_view" disabled type="text"
                                                placeholder="Validez de la oferta">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Tiempo de entrega (Opcional)</label>
                                            <input class="form-control" id="tiempo_view" disabled type="text"
                                                placeholder="Tiempo de entrega (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Forma de pago</label>
                                            <input class="form-control" id="formapago_view" disabled type="text"
                                                placeholder="Forma de pago">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Descuento % (Opcional)</label>
                                            <input class="form-control" id="descuento_view" disabled type="text"
                                                placeholder="Descuento % (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Descripción (Opcional)</label>
                                            <textarea class="form-control" placeholder="Descripción de la cotización (Opcional)" rows="3"
                                                id="descripcion_view" disabled style="height: 70px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Incluye (Opcional)</label>
                                            <textarea class="form-control" placeholder="Incluye (Opcional)" rows="3" id="incluye_view" disabled
                                                style="height: 70px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Garantía (Opcional)</label>
                                            <textarea class="form-control" disabled placeholder="Garantía de la cotización (Opcional)" rows="2"
                                                id="garantia_view" style="height: 60px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Envío (Opcional)</label>
                                            <textarea class="form-control" disabled placeholder="Envío (Opcional)" rows="2" id="envio_view"
                                                style="height: 60px; resize: none"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_productos_view" class="d-none">
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="">Productos</label>
                                            <div id="div_list_productos_view"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions clearfix">
                                <ul role="menu">
                                    <li class="disabled">
                                        <a href="javascript:void(0);" id="previus_view" role="menuitem">Anterior</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="next_view" role="menuitem">Siguiente</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Cotización</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="wizard2" role="application" class="wizard clearfix">
                            <div class="steps clearfix">
                                <ul role="tablist">
                                    <li role="tab" class="done">
                                        <a href="javascript:void(0);" id="title_basica_edit">
                                            <span class="number">1</span>
                                            <span class="title">Información Básica</span>
                                        </a>
                                    </li>
                                    <li role="tab" class="first current" id="title_productos_edit">
                                        <a href="javascript:void(0);">
                                            <span class="number">2</span>
                                            <span class="title">Productos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="content clearfix">
                                <div id="div_informacion_edit">
                                    <input id="id_cotizacion_edit" type="hidden" disabled readonly>
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="">Cliente</label>
                                            <select id="cliente_edit" class="form-select">
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Duración del contrato (Opcional)</label>
                                            <input class="form-control" id="duracion_edit" type="text"
                                                placeholder="Duración del contrato (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Validez de la oferta</label>
                                            <input class="form-control" id="validez_edit" type="text"
                                                placeholder="Validez de la oferta">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Tiempo de entrega (Opcional)</label>
                                            <input class="form-control" id="tiempo_edit" type="text"
                                                placeholder="Tiempo de entrega (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Forma de pago</label>
                                            <input class="form-control" id="formapago_edit" type="text"
                                                placeholder="Forma de pago">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="">Descuento % (Opcional)</label>
                                            <input class="form-control" id="descuento_edit" type="text"
                                                placeholder="Descuento % (Opcional)">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Descripción (Opcional)</label>
                                            <textarea class="form-control" placeholder="Descripción de la cotización (Opcional)" rows="3"
                                                id="descripcion_edit" style="height: 70px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Incluye (Opcional)</label>
                                            <textarea class="form-control" placeholder="Incluye (Opcional)" rows="3" id="incluye_edit"
                                                style="height: 70px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Garantía (Opcional)</label>
                                            <textarea class="form-control" placeholder="Garantía de la cotización (Opcional)" rows="2" id="garantia_edit"
                                                style="height: 60px; resize: none"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg">
                                            <label for="">Envío (Opcional)</label>
                                            <textarea class="form-control" placeholder="Envío (Opcional)" rows="2" id="envio_edit"
                                                style="height: 60px; resize: none"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_productos_edit" class="d-none">
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="">Productos</label>
                                                </div>
                                                <div class="col-4 d-flex" style="justify-content: end">
                                                    <div class="d-flex">
                                                        <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                            id="new_edit_row_producto">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                        <a class="center-vertical mg-s-10" title="Agregar Título"
                                                            href="javascript:void(0)" id="new_edit_row_titulo">
                                                            <i class="fa fa-font"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="div_list_productos_edit"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions clearfix">
                                <ul role="menu">
                                    <li class="disabled">
                                        <a href="javascript:void(0);" id="previus_edit" role="menuitem">Anterior</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="next_edit" role="menuitem">Siguiente</a>
                                    </li>
                                    <li class="d-none">
                                        <a href="javascript:void(0);" id="finish_edit" role="menuitem">Guardar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Email -->
        <div class="modal  fade" id="modalEmail">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Enviar Cotización</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_cotizacion_email">
                        @php
                            $fecha_recordatorio = date('Y-m-d');
                            $fecha_recordatorio = date('Y-m-d', strtotime($fecha_recordatorio . ' + 5 days'));
                        @endphp
                        <div class="row row-sm">
                            <label for="">Fecha recordatorio</label>
                            <div class="col-lg">
                                <input class="form-control" value="{{ $fecha_recordatorio }}"
                                    id="fecha_email_recordatorio" type="date">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">Emails</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control emailadd" placeholder="Email" type="email">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_email"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_email"></div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btn_save_email" type="button">Enviar
                                Cotización</button>
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
            var clientes = @json($clientes);
            var productos = @json($productos);

            localStorage.setItem('clientes', JSON.stringify(clientes));
            localStorage.setItem('productos', JSON.stringify(productos));
        });
    </script>
    <script src="{{ asset('assets/js/app/comercial/cotizacion.js') }}"></script>
@endsection
