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
                                    <option value="">Seleccione un tipo</option>
                                    <option value="0">Chevrolet</option>
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
                                <input class="form-control" id="marcaadd" placeholder="Email" type="email">
                                <a class="center-vertical mg-s-10" href="#" id="new_row_empleado"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
@endsection
