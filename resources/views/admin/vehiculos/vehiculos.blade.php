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
                        <li class="breadcrumb-item active" aria-current="page"> Vehículos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de Vehículos</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Registrar Vehículo</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="table_vehiculos_img">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Foto</th>
                                        <th class="wd-20p border-bottom-0">Marca</th>
                                        <th class="wd-15p border-bottom-0">Modelo</th>
                                        <th class="wd-15p border-bottom-0">Placa</th>
                                        <th class="wd-10p border-bottom-0">Año</th>
                                        <th class="wd-10p border-bottom-0">Estado</th>
                                        <th class="wd-10p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>


    <!-- Modal Add -->
    <div class="modal  fade" id="modalAdd">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Registro de Vehículo</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Marca</label>
                            <input class="form-control" id="marcaadd" placeholder="Marca" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Modelo</label>
                            <input class="form-control" id="modeloadd" placeholder="Modelo" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Tipo Combustible</label>
                            <select id="tipo_combustibleadd" class="form-select">
                                <option value="">Seleccione un tipo de combustible</option>
                                <option value="ACPM">ACPM</option>
                                <option value="Gasolina">Gasolina</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Año</label>
                            <input class="form-control" id="yearadd" placeholder="Año" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Soat</label>
                            <input class="form-control" id="soatadd" placeholder="Soat" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Placa</label>
                            <input class="form-control" id="placaadd" placeholder="Placa" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Tecnomecánica</label>
                            <input class="form-control" id="tecnomecanicaadd" placeholder="Tecnomecánica" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Color</label>
                            <input class="form-control" id="coloradd" placeholder="Color" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Seguro de riesgos</label>
                            <input class="form-control" id="seguroadd" placeholder="Seguro de riesgos" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Tipo</label>
                            <select id="tipoadd" class="form-select">
                                <option value="">Seleccione un tipo</option>
                                <option value="Automovil">Automovil</option>
                                <option value="Sedan">Sedan</option>
                                <option value="Camioneta">Camioneta</option>
                                <option value="Campero">Campero</option>
                                <option value="Grua Planchón">Grua Planchón</option>
                                <option value="Grua Pluma">Grua Pluma</option>
                                <option value="SUV">SUV</option>
                                <option value="Tractocamión">Tractocamión</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacionesadd"
                                style="height: 90px; resize: none"></textarea>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Foto</label>
                            <input class="form-control" id="fotoadd" type="file" accept="image/png, image/jpeg">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnGuardarVehiculo" type="button">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit y Show -->
    <div class="modal  fade" id="modalEdit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Datos del Vehículo</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idedit" readonly disabled>
                    <div class="d-flex justify-content-center">
                        <img id="imagenedit" src="http://127.0.0.1:8000/images/vehiculos/18876865131801587359.png"
                            style="width: 222px" loading="lazy">
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Marca</label>
                            <input class="form-control" id="marcaedit" placeholder="Marca" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Modelo</label>
                            <input class="form-control" id="modeloedit" placeholder="Modelo" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Tipo Combustible</label>
                            <select id="tipo_combustibleedit" class="form-select">
                                <option value="">Seleccione un tipo de combustible</option>
                                <option value="ACPM">ACPM</option>
                                <option value="Gasolina">Gasolina</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Año</label>
                            <input class="form-control" id="yearedit" placeholder="Año" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Soat</label>
                            <input class="form-control" id="soatedit" placeholder="Soat" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Placa</label>
                            <input class="form-control" id="placaedit" placeholder="Placa" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Tecnomecánica</label>
                            <input class="form-control" id="tecnomecanicaedit" placeholder="Tecnomecánica"
                                type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Color</label>
                            <input class="form-control" id="coloredit" placeholder="Color" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Seguro de riesgos</label>
                            <input class="form-control" id="seguroedit" placeholder="Seguro de riesgos" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Tipo</label>
                            <select id="tipoedit" class="form-select">
                                <option value="">Seleccione un tipo</option>
                                <option value="Automovil">Automovil</option>
                                <option value="Sedan">Sedan</option>
                                <option value="Camioneta">Camioneta</option>
                                <option value="Campero">Campero</option>
                                <option value="Grua Planchón">Grua Planchón</option>
                                <option value="Grua Pluma">Grua Pluma</option>
                                <option value="SUV">SUV</option>
                                <option value="Tractocamión">Tractocamión</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacionesedit"
                                style="height: 90px; resize: none"></textarea>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Foto</label>
                            <input class="form-control" id="fotoedit" type="file" accept="image/png, image/jpeg">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnEditarVehiculo" type="button">Modificar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Salud -->
    <div class="modal  fade" id="modalSalud">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Encuesta de Salud</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">¿Dolor de garganta? *</label>
                            <select id="dolor_garganta" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">¿Malestar general que te limite de las actividades de la vida diaria?
                                *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">¿Fiebre igual o mayor a 38 grados, medida con termómetro? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">¿Tos seca y persistente de inicio reciente? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">¿Pérdida del olfato y/o el gusto? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">¿Resides con alguien en proceso de diagnóstico de ser positivo para
                                COVID-19? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">¿En lo últimos 14 días has tenido contacto con alguien diagnosticado de
                                COVID-19? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">¿Reside con personas que prestan servicio al sector salud? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">¿Reside con personas mayores de 65 años? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">¿Alguien de su grupo familiar posee enfermedades o patologías crónicas?
                                *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">¿Botas de seguridad? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">¿Uniforme? *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Declaro que la información suministrada es verídica y me encuentro en
                                optimas condiciones de Salud para realizar mis funciones dentro de la empresa RADIO ENLACE
                                SAS. *</label>
                            <select id="" class="form-select">
                                <option value="">Seleccione una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="table_salud_vehiculos">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">Creado Por</th>
                                <th class="wd-20p border-bottom-0">Fecha Creación</th>
                                <th class="wd-10p border-bottom-0">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnEditarVehiculo" type="button">Modificar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/vehiculos/vehiculos.js') }}"></script>
@endsection