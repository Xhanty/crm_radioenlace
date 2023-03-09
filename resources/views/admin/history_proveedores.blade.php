@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Historial Observaciones Proveedor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Proveedor ° {{ $proveedores->razon_social }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div style="text-align: right">
                        <i id="btnCloseVista" title="Cerrar" class="fa fa-times-circle"
                            style="font-size: 30px; color: #0d6efd; cursor: pointer; margin-right: 10px;"></i>
                    </div>
                    <div class="card-body">
                        <div class="vtimeline">
                            @foreach ($proveedores->observaciones as $key => $value)
                                @if ($key % 2 === 0)
                                    <div class="timeline-wrapper timeline-wrapper-primary">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btnCloseVista').click(function() {
                window.close();
            });
        });
    </script>
@endsection
