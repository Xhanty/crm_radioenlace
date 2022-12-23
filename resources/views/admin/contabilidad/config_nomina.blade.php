@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Configuración Nómina</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- row Add -->
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Configuración de la nomina</h3>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -18px;">
                        <input type="hidden" id="id_config_add" readonly disabled value="{{ $data->id }}">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">% Salud</label>
                                <input class="form-control" id="salud_add" placeholder="% Salud" type="text"
                                    value="{{ $data->porcentaje_salud }}">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">% Pension</label>
                                <input class="form-control" id="pension_add" placeholder="% Pension" type="text"
                                    value="{{ $data->porcentaje_pension }}">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="">Monto Base para aplicar FTE</label>
                                <input onkeyup="onk(event)" class="form-control" id="monto_add"
                                    placeholder="Monto Base para aplicar FTE" type="float"
                                    value="{{ number_format($data->monto_base_fte, 2) }}">
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btnUpdateConfig" type="button">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/contabilidad/config_nomina.js') }}"></script>
    <script>
        function onk(event) {
            $(event.target).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, "$1.$2")
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    </script>
@endsection
