@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Historial Observaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page">N ° {{ $cotizacion->code }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <input type="hidden" disabled readonly id="cotizacion_id" value="{{ $cotizacion->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div style="text-align: right">
                        <i title="Agregar Observación" data-bs-toggle="modal" data-bs-target="#modalAdd"
                            class="fa fa-plus-circle"
                            style="font-size: 30px; color: #0d6efd; cursor: pointer; margin: 10px;"></i>
                        <i id="btnCloseVista" title="Cerrar" class="fa fa-times-circle"
                            style="font-size: 30px; color: #0d6efd; cursor: pointer; margin-right: 10px;"></i>
                    </div>
                    <div class="card-body">
                        <div class="vtimeline">
                            @foreach ($cotizacion->observaciones as $key => $value)
                                @php
                                    $tipo = '';
                                    if ($value->tipo == 1) {
                                        $tipo = 'Observación';
                                    } elseif ($value->tipo == 2) {
                                        $tipo = 'Cotización Proveedor';
                                    } elseif ($value->tipo == 3) {
                                        $tipo = 'Orden de Compra';
                                    }
                                @endphp
                                @if ($key % 2 === 0)
                                    <div class="timeline-wrapper timeline-wrapper-primary">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading" style="text-align: right">
                                                @if ($value->tipo == 1)
                                                    <a href="javascript:void(0);" class="btnEdit"
                                                        data-id="{{ $value->id }}"
                                                        data-mensaje="{{ $value->observacion }}">
                                                        <i class="fa fa-pencil-alt text-muted me-1"></i>
                                                    </a>
                                                @endif
                                                <a href="javascript:void(0);" class="btnDelete"
                                                    data-id="{{ $value->id }}" data-mensaje="{{ $value->observacion }}">
                                                    <i class="fa fa-trash text-muted me-1"></i>
                                                </a>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Tipo:</strong> {{ $tipo }}
                                                    <br>
                                                    @if ($value->tipo == 1)
                                                        <strong>Observación:</strong> {{ $value->observacion }}
                                                    @else
                                                        <strong>Archivo:</strong> <a
                                                            href="{{ asset('images/cotizaciones/' . $value->adjunto) }}"
                                                            target="_blank">Ver Archivo</a>
                                                    @endif
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}

                                                    @if ($value->tipo != 1)
                                                        <br>
                                                        <!-- Aprobar Cotización -->
                                                        <div class="form-checkbox form-checkbox-primary">
                                                            <input type="checkbox" class="form-check-input checkAprobados"
                                                                @if ($value->check_comercial == 1) checked @endif
                                                                @if (!auth()->user()->hasPermissionTo('aprobacion_comercial_cotizacion')) disabled @endif
                                                                data-tipo="comercial" data-id="{{ $value->id }}"
                                                                style="margin-left: 0px !important;">
                                                            <label class="form-check label bold"
                                                                style="margin-left: 16px !important">Aprobación
                                                                Comercial</label>
                                                        </div>
                                                        <div class="form-checkbox form-checkbox-primary">
                                                            <input type="checkbox" class="form-check-input checkAprobados"
                                                                data-id="{{ $value->id }}" data-tipo="gerencia"
                                                                @if ($value->check_gerencia == 1) checked @endif
                                                                @if (!auth()->user()->hasPermissionTo('aprobacion_gerencia_cotizacion')) disabled @endif
                                                                style="margin-left: 0px !important;">
                                                            <label class="form-check label bold"
                                                                style="margin-left: 16px !important">Aprobación
                                                                Gerencia</label>
                                                        </div>
                                                        <div class="form-checkbox form-checkbox-primary">
                                                            <input type="checkbox" class="form-check-input checkAprobados"
                                                                data-id="{{ $value->id }}" data-tipo="contable"
                                                                @if ($value->check_contable == 1) checked @endif
                                                                @if (!auth()->user()->hasPermissionTo('aprobacion_contable_cotizacion')) disabled @endif
                                                                style="margin-left: 0px !important;">
                                                            <label class="form-check label bold"
                                                                style="margin-left: 16px !important">Aprobación
                                                                Contable</label>
                                                        </div>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>
                                                    {{ date('d-m-Y H:i A', strtotime($value->created_at)) }} </span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-primary">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading" style="text-align: right">
                                                @if ($value->tipo == 1)
                                                    <a href="javascript:void(0);" class="btnEdit"
                                                        data-id="{{ $value->id }}"
                                                        data-mensaje="{{ $value->observacion }}">
                                                        <i class="fa fa-pencil-alt text-muted me-1"></i>
                                                    </a>
                                                @endif
                                                <a href="javascript:void(0);" class="btnDelete"
                                                    data-id="{{ $value->id }}"
                                                    data-mensaje="{{ $value->observacion }}">
                                                    <i class="fa fa-trash text-muted me-1"></i>
                                                </a>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Tipo:</strong> {{ $tipo }}
                                                    <br>
                                                    @if ($value->tipo == 1)
                                                        <strong>Observación:</strong> {{ $value->observacion }}
                                                    @else
                                                        <strong>Archivo:</strong> <a
                                                            href="{{ asset('images/cotizaciones/' . $value->adjunto) }}"
                                                            target="_blank">Ver Archivo</a>
                                                    @endif
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
                                                    @if ($value->tipo != 1)
                                                        <br>
                                                        <!-- Aprobar Cotización -->
                                                        <div class="form-checkbox form-checkbox-primary">
                                                            <input type="checkbox" class="form-check-input checkAprobados"
                                                                data-id="{{ $value->id }}" data-tipo="comercial"
                                                                @if ($value->check_comercial == 1) checked @endif
                                                                @if (!auth()->user()->hasPermissionTo('aprobacion_comercial_cotizacion')) disabled @endif
                                                                style="margin-left: 0px !important;">
                                                            <label class="form-check label bold"
                                                                style="margin-left: 16px !important">Aprobación
                                                                Comercial</label>
                                                        </div>
                                                        <div class="form-checkbox form-checkbox-primary">
                                                            <input type="checkbox" class="form-check-input checkAprobados"
                                                                data-id="{{ $value->id }}" data-tipo="gerencia"
                                                                @if ($value->check_gerencia == 1) checked @endif
                                                                @if (!auth()->user()->hasPermissionTo('aprobacion_gerencia_cotizacion')) disabled @endif
                                                                style="margin-left: 0px !important;">
                                                            <label class="form-check label bold"
                                                                style="margin-left: 16px !important">Aprobación
                                                                Gerencia</label>
                                                        </div>
                                                        <div class="form-checkbox form-checkbox-primary">
                                                            <input type="checkbox" class="form-check-input checkAprobados"
                                                                data-id="{{ $value->id }}" data-tipo="contable"
                                                                @if ($value->check_contable == 1) checked @endif
                                                                @if (!auth()->user()->hasPermissionTo('aprobacion_contable_cotizacion')) disabled @endif
                                                                style="margin-left: 0px !important;">
                                                            <label class="form-check label bold"
                                                                style="margin-left: 16px !important">Aprobación
                                                                Contable</label>
                                                        </div>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>
                                                    {{ date('d-m-Y H:i A', strtotime($value->created_at)) }} </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Observación</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo</label>
                                <select id="tipo_observacion" class="form-select">
                                    <option value="1">Observación</option>
                                    <option value="2">Cotización Proveedor</option>
                                    <option value="3">Orden de Compra</option>
                                </select>
                            </div>
                        </div>
                        <div id="content_observacion_add" style="display: block">
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Observación</label>
                                    <textarea class="form-control" placeholder="Observaciones" rows="4" id="observacion_add"
                                        style="height: 120px; resize: none"></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="content_adjunto_add" style="display: none">
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Adjunto</label>
                                    <input type="file" class="form-control" id="adjunto_add"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardar" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Observación</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="observacion_id">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Observación</label>
                                <textarea class="form-control" placeholder="Observaciones" rows="4" id="observacion_edit"
                                    style="height: 120px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarEdit" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/comercial/history_cotizaciones.js') }}"></script>
@endsection
