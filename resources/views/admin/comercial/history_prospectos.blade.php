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
                        <li class="breadcrumb-item active" aria-current="page">{{ $prospecto->nombres }} {{ $prospecto->apellidos }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <input type="hidden" disabled readonly id="prospecto_id" value="{{ $prospecto->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div style="text-align: right">
                        <i title="Agregar Observación" data-bs-toggle="modal" data-bs-target="#modalAdd" class="fa fa-plus-circle"
                            style="font-size: 30px; color: #0d6efd; cursor: pointer; margin: 10px;"></i>
                        <i id="btnCloseVista" title="Cerrar" class="fa fa-times-circle" style="font-size: 30px; color: #0d6efd; cursor: pointer; margin-right: 10px;"></i>
                    </div>
                    <div class="card-body">
                        <div class="vtimeline">
                            @foreach ($prospecto->observaciones as $key => $value)
                                @if ($key % 2 === 0)
                                    <div class="timeline-wrapper timeline-wrapper-primary">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading" style="text-align: right">
                                                <a href="javascript:void(0);" class="btnEdit" data-id="{{ $value->id }}"
                                                    data-mensaje="{{ $value->observacion }}">
                                                    <i class="fa fa-pencil-alt text-muted me-1"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btnDelete"
                                                    data-id="{{ $value->id }}" data-mensaje="{{ $value->observacion }}">
                                                    <i class="fa fa-trash text-muted me-1"></i>
                                                </a>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Observación:</strong> {{ $value->observacion }}
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
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
                                                <a href="javascript:void(0);" class="btnEdit" data-id="{{ $value->id }}"
                                                    data-mensaje="{{ $value->observacion }}">
                                                    <i class="fa fa-pencil-alt text-muted me-1"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btnDelete"
                                                    data-id="{{ $value->id }}"
                                                    data-mensaje="{{ $value->observacion }}">
                                                    <i class="fa fa-trash text-muted me-1"></i>
                                                </a>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Observación:</strong> {{ $value->observacion }}
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
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
                                <label for="">Observación</label>
                                <textarea class="form-control" placeholder="Observaciones" rows="4" id="observacion_add"
                                    style="height: 120px; resize: none"></textarea>
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
    <script src="{{ asset('assets/js/app/comercial/history_prospectos.js') }}"></script>
@endsection
