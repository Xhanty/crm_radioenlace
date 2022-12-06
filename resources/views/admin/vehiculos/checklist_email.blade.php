@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Vehículos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Enviar Checklist Email</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- row -->
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Seleccione el vehiculo</label>
                                <select id="vehiculoadd" class="form-select">
                                    @foreach ($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }} {{ $vehiculo->modelo }} | {{ $vehiculo->placa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Seleccione el tipo de checklist</label>
                                <select id="tipoadd" class="form-select">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="0">Checklist Gruas</option>
                                    <option value="1">Checklist Técnico</option>
                                    <option value="2">Inspección</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">Emails a enviar</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control emailadd" placeholder="Email" type="email">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_email"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_email"></div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btn_save_email" type="button">Enviar Checklist Email</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/checklist_email.js') }}"></script>
@endsection