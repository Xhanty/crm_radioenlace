@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Historial</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $inventario->producto }} -
                            {{ $inventario->modelo }} | (Serial: {{ $inventario->serial }} - Código Interno: {{ $inventario->codigo_interno }})</li>
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('gestion_inventario') . '?pr=' . $inventario->cod_producto }} "><i class="fa fa-eye"></i> Ver</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="vtimeline">
                            <!-- Check Visto Bueno -->
                            <input type="hidden" id="id_serial" disabled value="{{ $id }}">
                            <input type="checkbox" class="form-check-input" id="visto_bueno"
                                value="1" style="position: absolute; top: -16px; right: 14px;" @if ($inventario->visto_bueno == 1) checked @endif>
                            @foreach ($inventario->movimientos as $key => $value)
                                @php
                                    $title = '';
                                    if ($value->tipo == 0) {
                                        $title = 'Compra';
                                    } elseif ($value->tipo == 1) {
                                        $title = 'ReIngreso';
                                    } elseif ($value->tipo == 2) {
                                        $title = 'Alquiler';
                                    } elseif ($value->tipo == 3) {
                                        $title = 'Asignado';
                                    } elseif ($value->tipo == 4) {
                                        $title = 'Préstamo';
                                    } elseif ($value->tipo == 5) {
                                        $title = 'Instalación';
                                    } elseif ($value->tipo == 6) {
                                        $title = 'Venta';
                                    } elseif ($value->tipo == 7) {
                                        $title = 'Dado de baja';
                                    } elseif ($value->tipo == 8) {
                                        $title = 'Reparación';
                                    }
                                @endphp
                                @if ($key % 2 === 0)
                                    <div class="timeline-wrapper timeline-wrapper-primary">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title">{{ $title }}</h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Ubicación:</strong> {{ $value->ubicacion }}
                                                    <br>
                                                    @if ($value->tipo == 0)
                                                        <strong>Proveedor:</strong> {{ $value->proveedor }}
                                                        <br>
                                                    @endif
                                                    @if ($value->tipo > 1)
                                                        @if ($value->cliente)
                                                            <strong>Cliente:</strong> {{ $value->cliente }}
                                                            <br>
                                                        @else
                                                            <strong>Empleado:</strong> {{ $value->empleado }}
                                                            <br>
                                                        @endif
                                                    @endif
                                                    <strong>Cantidad:</strong> {{ $value->cantidad }}
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
                                                    <br>
                                                    <strong>Observaciones:</strong> {{ $value->observaciones }}
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
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title">{{ $title }}</h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Ubicación:</strong> {{ $value->ubicacion }}
                                                    <br>
                                                    @if ($value->tipo == 0)
                                                        <strong>Proveedor:</strong> {{ $value->proveedor }}
                                                        <br>
                                                    @endif
                                                    @if ($value->tipo > 1)
                                                        @if ($value->cliente)
                                                            <strong>Cliente:</strong> {{ $value->cliente }}
                                                            <br>
                                                        @else
                                                            <strong>Empleado:</strong> {{ $value->empleado }}
                                                            <br>
                                                        @endif
                                                    @endif
                                                    <strong>Cantidad:</strong> {{ $value->cantidad }}
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
                                                    <br>
                                                    <strong>Observaciones:</strong> {{ $value->observaciones }}
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
    </div>
@endsection

@section('scripts')
<script>
    $(function() {
        // Check Visto Bueno
        $('#visto_bueno').on('change', function() {
            let id_serial = $('#id_serial').val();
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "{{ route('visto_bueno_inventario') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        visto_bueno: 1,
                        id: id_serial
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data.info == 1) {
                            toastr.success(data.data);
                        } else {
                            toastr.error("Error al marcar como visto bueno.");
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('visto_bueno_inventario') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        visto_bueno: 0,
                        id: id_serial
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data.info == 1) {
                            toastr.success(data.data);
                        } else {
                            toastr.error("Error al marcar como no visto bueno.");
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
