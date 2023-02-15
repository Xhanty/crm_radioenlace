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

        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="vtimeline">
                            @foreach ($cotizacion->observaciones as $key => $value)
                                @if ($key % 2 === 0)
                                    <div class="timeline-wrapper timeline-wrapper-primary">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title">{{ $title }}</h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    <strong>Mensaje:</strong> {{ $value->observacion }}
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
                                                    <br>
                                                    <strong>Fecha:</strong> {{ $value->created_at }}
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
                                                    <strong>Mensaje:</strong> {{ $value->observacion }}
                                                    <br>
                                                    <strong>Usuario:</strong> {{ $value->creador }}
                                                    <br>
                                                    <strong>Fecha:</strong> {{ $value->created_at }}
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
@endsection
