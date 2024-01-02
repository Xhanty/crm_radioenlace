<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--- Favicon --->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />
    <title>Sagrilaft | Clientes</title>
</head>
<style>
    h1 {
        text-align: center;
    }

    h2 {
        margin: 0;
    }

    #multi-step-form-container {
        margin-top: 5rem;
    }

    .text-center {
        text-align: center;
    }

    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    .pl-0 {
        padding-left: 0;
    }

    .button {
        padding: 0.7rem 1.5rem;
        border: 1px solid #DA251D;
        background-color: #DA251D;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .submit-btn {
        border: 1px solid #3F5D16;
        background-color: #3F5D16;
    }

    .mt-3 {
        margin-top: 2rem;
    }

    .d-none {
        display: none;
    }

    .form-step {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        padding: 3rem;
    }

    .font-normal {
        font-weight: normal;
    }

    ul.form-stepper {
        counter-reset: section;
        margin-bottom: 3rem;
    }

    ul.form-stepper .form-stepper-circle {
        position: relative;
    }

    ul.form-stepper .form-stepper-circle span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
    }

    .form-stepper-horizontal {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    ul.form-stepper>li:not(:last-of-type) {
        margin-bottom: 0.625rem;
        -webkit-transition: margin-bottom 0.4s;
        -o-transition: margin-bottom 0.4s;
        transition: margin-bottom 0.4s;
    }

    .form-stepper-horizontal>li:not(:last-of-type) {
        margin-bottom: 0 !important;
    }

    .form-stepper-horizontal li {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: start;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    }

    .form-stepper-horizontal li:not(:last-child):after {
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        height: 1px;
        content: "";
        top: 32%;
    }

    .form-stepper-horizontal li:after {
        background-color: #dee2e6;
    }

    .form-stepper-horizontal li.form-stepper-completed:after {
        background-color: #4da3ff;
    }

    .form-stepper-horizontal li:last-child {
        flex: unset;
    }

    ul.form-stepper li a .form-stepper-circle {
        display: inline-block;
        width: 40px;
        height: 40px;
        margin-right: 0;
        line-height: 1.7rem;
        text-align: center;
        background: rgba(0, 0, 0, 0.38);
        border-radius: 50%;
    }

    .form-stepper .form-stepper-active .form-stepper-circle {
        background-color: #DA251D !important;
        color: #fff;
    }

    .form-stepper .form-stepper-active .label {
        color: #DA251D !important;
    }

    .form-stepper .form-stepper-active .form-stepper-circle:hover {
        background-color: #DA251D !important;
        color: #fff !important;
    }

    .form-stepper .form-stepper-unfinished .form-stepper-circle {
        background-color: #f8f7ff;
    }

    .form-stepper .form-stepper-completed .form-stepper-circle {
        background-color: #3F5D16 !important;
        color: #fff;
    }

    .form-stepper .form-stepper-completed .label {
        color: #3F5D16 !important;
    }

    .form-stepper .form-stepper-completed .form-stepper-circle:hover {
        background-color: #3F5D16 !important;
        color: #fff !important;
    }

    .form-stepper .form-stepper-active span.text-muted {
        color: #fff !important;
    }

    .form-stepper .form-stepper-completed span.text-muted {
        color: #fff !important;
    }

    .form-stepper .label {
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .form-stepper a {
        cursor: default;
    }

    a {
        text-decoration: none !important;
    }
</style>

<body>
    @php
        $view_data = false;

        if ($send == 0) {
            $view_data = true;
        } else {
            $view_data = false;
        }
    @endphp
    <div style="padding: 33px">
        <h1>Registro y actualización de información comercial y financiera</h1>
        <div id="multi-step-form-container">
            <!-- Form Steps / Progress Bar -->
            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                <!-- Step 1 -->
                <li class="form-stepper-active text-center form-stepper-list" step="1">
                    <a class="mx-2">
                        <span class="form-stepper-circle">
                            <span>1</span>
                        </span>
                        <div class="label">Información Básica</div>
                    </a>
                </li>
                <!-- Step 2 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>2</span>
                        </span>
                        <div class="label text-muted">Información Financiera</div>
                    </a>
                </li>
                <!-- Step 3 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>3</span>
                        </span>
                        <div class="label text-muted">Documentos</div>
                    </a>
                </li>
            </ul>
            <!-- Step Wise Form Content -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('sagrilaft_clientes_save') }}">
                @csrf
                <input type="hidden" name="sagrilaft_send" id="sagrilaft_send" value="{{ $sagrilaft->id }}">
                <!-- Step 1 Content -->
                <section id="step-1" class="form-step">
                    <h2 class="font-normal">Información Básica</h2>
                    <!-- Step 1 input fields -->
                    <div class="mt-3">
                        <select name="tipo_persona" id="tipo_persona" class="form-select" required>
                            <option value="0">Tipo de Persona</option>
                            <option value="1">Persona Natural</option>
                            <option value="2">Persona Jurídica</option>
                        </select>
                        <br>
                        <hr>
                        <br>
                        <div class="info_basica_natural d-none">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="nombre_natural" id="nombre_natural"
                                        placeholder="Nombre">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="tipodoc_natural"
                                        id="tipodoc_natural" placeholder="Tipo Documento">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="documento_natural"
                                        id="documento_natural" placeholder="N° de Documento">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="expedicion_natural"
                                        id="expedicion_natural" placeholder="Expedición">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="lugar_natural" id="lugar_natural"
                                        placeholder="Lugar">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="date" class="form-control" name="fnacimiento_natural"
                                        id="fnacimiento_natural" placeholder="Fecha Nacimiento" title="Fecha Nacimiento">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="nacionalidad_natural"
                                        id="nacionalidad_natural" placeholder="Nacionalidad">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ocupacion_natural"
                                        id="ocupacion_natural" placeholder="Ocupación">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="actividad_natural"
                                        id="actividad_natural" placeholder="Actividad Económica">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ciiu_natural" id="ciiu_natural"
                                        placeholder="CIIU">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="empresa_natural"
                                        id="empresa_natural" placeholder="Empresa donde trabaja">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="cargo_natural"
                                        id="cargo_natural" placeholder="Área y cargo">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ciudadtr_natural"
                                        id="ciudadtr_natural" placeholder="Ciudad y Dirección de Trabajo">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="telefono_natural"
                                        id="telefono_natural" placeholder="Teléfono">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="fax_natural" id="fax_natural"
                                        placeholder="Fax">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="domicilio_natural"
                                        id="domicilio_natural" placeholder="Domicilio">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ciudad_natural"
                                        id="ciudad_natural" placeholder="Ciudad">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="departamento_natural"
                                        id="departamento_natural" placeholder="Departamento">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="fijo_natural" id="fijo_natural"
                                        placeholder="Teléfono Fijo y Celular">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="email_natural"
                                        id="email_natural" placeholder="E-mail">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="emailfact_natural"
                                        id="emailfact_natural" placeholder="E-mail facturación">
                                </div>
                            </div>
                        </div>

                        <div class="info_basica_juridica d-none">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="razonsocial_juridica"
                                        id="razonsocial_juridica" placeholder="Razón Social">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="nit_juridica" id="nit_juridica"
                                        placeholder="Nit">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="clase_juridica"
                                        id="clase_juridica" placeholder="Clase de Sociedad">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="escritura_juridica"
                                        id="escritura_juridica" placeholder="Escritura de Constitución">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="matricula_juridica"
                                        id="matricula_juridica" placeholder="Matricula N°">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="representante_juridica"
                                        id="representante_juridica" placeholder="Representante Legal">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="tipodoc_juridica"
                                        id="tipodoc_juridica" placeholder="Tipo de Documento">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="documento_juridica"
                                        id="documento_juridica" placeholder="N° de Documento">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="expedicion_juridica"
                                        id="expedicion_juridica" placeholder="Expedición">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="lugar_juridica"
                                        id="lugar_juridica" placeholder="Lugar">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="fnacimiento_juridica"
                                        id="fnacimiento_juridica" placeholder="Fecha de Nacimiento">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="oficina_juridica"
                                        id="oficina_juridica" placeholder="Dirección Oficina Principal">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ciudad_juridica"
                                        id="ciudad_juridica" placeholder="Ciudad">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="departamento_juridica"
                                        id="departamento_juridica" placeholder="Departamento">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="fax_juridica" id="fax_juridica"
                                        placeholder="Fax">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="tipoempresa_juridica"
                                        id="tipoempresa_juridica" placeholder="Tipo de Empresa">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ciiu_juridica"
                                        id="ciiu_juridica" placeholder="CIIU">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="actividad_juridica"
                                        id="actividad_juridica" placeholder="Actividad Económica">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="email_juridica"
                                        id="email_juridica" placeholder="E-mail">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="telfono_juridica"
                                        id="telfono_juridica" placeholder="Teléfono">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="contacto_juridica"
                                        id="contacto_juridica" placeholder="Persona Contacto">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="cargo_juridica"
                                        id="cargo_juridica" placeholder="Cargo">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="emailfact_juridica"
                                        id="emailfact_juridica" placeholder="E-mail Facturación">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex" style="justify-content: end">
                        <button class="button btn-navigate-form-step btn-success"
                            style="background: #3F5D16; border: 0" type="button" step_number="2">Siguiente</button>
                    </div>
                </section>
                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-2" class="form-step d-none">
                    <h2 class="font-normal">Información Financiera</h2>
                    <!-- Step 2 input fields -->
                    <div class="mt-3">
                        <br>
                        <hr>
                        <br>
                        <div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="ingresos" id="ingresos"
                                        placeholder="Ingresos Mensuales (Pesos)">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="egresos" id="egresos"
                                        placeholder="Egresos Mensuales (Pesos)">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="activos" id="activos"
                                        placeholder="Activos (Pesos)">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="pasivos" id="pasivos"
                                        placeholder="Pasivos (Pesos)">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="patrimonio" id="patrimonio"
                                        placeholder="Patrimonio (Pesos)">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="revisor_fiscal"
                                        id="revisor_fiscal" placeholder="Revisoría Fiscal">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" name="otros_ingresos"
                                        id="otros_ingresos" placeholder="Otros Ingresos (Pesos)">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control" placeholder="Concepto Otros Ingresos">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <select name="operaciones_internacionales" class="form-control"
                                        id="operaciones_internacionales">
                                        <option value="">Operaciones Internacionales</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="operaciones_cual"
                                        id="operaciones_cual" placeholder="Cuál">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="mercancia_exportada"
                                        id="mercancia_exportada"
                                        placeholder="Clase de Mercancías Importadas y/o Exportadas">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex" style="justify-content: end">
                        <button class="button btn-navigate-form-step" style="margin-right: 20px" type="button"
                            step_number="1">Regresar</button>
                        <button class="button btn-navigate-form-step" style="background: #3F5D16; border: 0"
                            type="button" step_number="3">Siguiente</button>
                    </div>
                </section>
                <!-- Step 3 Content, default hidden on page load. -->
                <section id="step-3" class="form-step d-none">
                    <h2 class="font-normal">Documentos</h2>
                    <!-- Step 3 input fields -->
                    <div class="mt-3">
                        <br>
                        <hr>
                        <br>
                        <div class="info_basica_natural d-none">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Fotocopia de la Cédula de Ciudadanía</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="cc_natural" id="cc_natural" class="form-control mt-2">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Declaración de Renta de los 2 últimos periodos</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="renta_natural" id="renta_natural" class="form-control mt-2">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Certificado de Ingresos y retenciones del año
                                        inmediatamente anterior</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="ingresos_natural" id="ingresos_natural" class="form-control mt-2">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Fotocopia del Registro Único Tributario (RUT)</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="rut_natural" id="rut_natural" class="form-control mt-2">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <label for="">2 Referencias Comerciales</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="comercial_natural" id="comercial_natural" class="form-control mt-2">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="">1 Referencia Bancaria</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="bancaria_natural" id="bancaria_natural" class="form-control mt-2">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="">Portafolio de Servicios</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="portafolio_natural" id="portafolio_natural" class="form-control mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="info_basica_juridica d-none">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Certificado de Existencia y Representación Legal, no mayor de
                                        1 mes</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="existencia_juridica" id="existencia_juridica"
                                        class="form-control mt-2">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Fotocopia del Registro Único Tributario (RUT)</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="rut_juridica" id="rut_juridica" class="form-control mt-2">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Fotocopia de la C.C. del Representante Legal</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="cc_juridica" id="cc_juridica" class="form-control mt-2">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Declaración de Renta de los 2 últimos periodos</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="renta_juridica" id="renta_juridica" class="form-control mt-2">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <label for="">Estados de Financieros firmados por el Contador o Revisor
                                        Fiscal</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="estados_juridica" id="estados_juridica" class="form-control mt-2">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="">Certificados de calidad (BASC, ISO. BPM)</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="calidad_juridica" id="calidad_juridica" class="form-control mt-2">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="">Certificación Operador Económico Autorizado</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="operador_juridica" id="operador_juridica" class="form-control mt-2">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <label for="">2 Referencias Comerciales</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="comercial_juridica" id="comercial_juridica" class="form-control mt-2">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="">1 Referencia Bancaria y portafolios de servicios</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="bancaria_juridica" id="bancaria_juridica" class="form-control mt-2">
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="">Documento de cumplimiento de requisitos legales
                                        (permisos-licencias)</label>
                                    <input type="file" accept="application/pdf,application/vnd.ms-excel"
                                        name="licencias_juridica" id="licencias_juridica" class="form-control mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex" style="justify-content: end">
                        <button class="button btn-navigate-form-step" style="margin-right: 20px" type="button"
                            step_number="2">Regresar</button>
                        <button class="button submit-btn" style="background: #3F5D16; border: 0"
                            type="submit">Guardar</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /**
         * Define a function to navigate betweens form steps.
         * It accepts one parameter. That is - step number.
         */
        const navigateToFormStep = (stepNumber) => {
            /**
             * Hide all form steps.
             */
            document.querySelectorAll(".form-step").forEach((formStepElement) => {
                formStepElement.classList.add("d-none");
            });
            /**
             * Mark all form steps as unfinished.
             */
            document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
                formStepHeader.classList.add("form-stepper-unfinished");
                formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
            });
            /**
             * Show the current form step (as passed to the function).
             */
            document.querySelector("#step-" + stepNumber).classList.remove("d-none");
            /**
             * Select the form step circle (progress bar).
             */
            const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
            /**
             * Mark the current form step as active.
             */
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
            formStepCircle.classList.add("form-stepper-active");
            /**
             * Loop through each form step circles.
             * This loop will continue up to the current step number.
             * Example: If the current step is 3,
             * then the loop will perform operations for step 1 and 2.
             */
            for (let index = 0; index < stepNumber; index++) {
                /**
                 * Select the form step circle (progress bar).
                 */
                const formStepCircle = document.querySelector('li[step="' + index + '"]');
                /**
                 * Check if the element exist. If yes, then proceed.
                 */
                if (formStepCircle) {
                    /**
                     * Mark the form step as completed.
                     */
                    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
                    formStepCircle.classList.add("form-stepper-completed");
                }
            }
        };
        /**
         * Select all form navigation buttons, and loop through them.
         */
        document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
            /**
             * Add a click event listener to the button.
             */
            formNavigationBtn.addEventListener("click", () => {
                /**
                 * Get the value of the step.
                 */
                const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
                /**
                 * Call the function to navigate to the target form step.
                 */
                navigateToFormStep(stepNumber);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Preguntar tipo de persona al cargar la página
            $("#tipo_persona").focus();
            var view_data = "{{ $view_data }}";

            $(".btn-navigate-form-step").attr("disabled", true);

            // Evita que se envíe el formulario al presionar enter
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            // Oculta o muestra los campos según el tipo de persona
            $("#tipo_persona").change(function() {
                var tipo_persona = $(this).val();

                if (tipo_persona == 1) {
                    $(".info_basica_natural").removeClass("d-none");
                    $(".info_basica_juridica").addClass("d-none");
                    $(".btn-navigate-form-step").attr("disabled", false);
                } else if (tipo_persona == 2) {
                    $(".info_basica_natural").addClass("d-none");
                    $(".info_basica_juridica").removeClass("d-none");
                    $(".btn-navigate-form-step").attr("disabled", false);
                } else {
                    $(".info_basica_natural").addClass("d-none");
                    $(".info_basica_juridica").addClass("d-none");
                    $(".btn-navigate-form-step").attr("disabled", true);
                }
            });

            if (view_data) {
                $('input[type="text"]').attr('readonly', true);
                $('input[type="date"]').attr('readonly', true);
                $('input[type="file"]').attr('disabled', true);
                $('select').attr('disabled', true);
                // Boton submit
                $('.submit-btn').attr('disabled', true);

                let sagrilaft = @json($sagrilaft);

                console.log(sagrilaft);

                $('#tipo_persona').val(sagrilaft.tipo_persona).trigger('change');
                
                if(sagrilaft.tipo_persona == 1) {
                    // Natura
                    $('#nombre_natural').val(sagrilaft.naturales.nombre);
                    $('#tipodoc_natural').val(sagrilaft.naturales.tipo_documento);
                    $('#documento_natural').val(sagrilaft.naturales.documento);
                    $('#expedicion_natural').val(sagrilaft.naturales.expedicion);
                    $('#lugar_natural').val(sagrilaft.naturales.lugar);
                    $('#fnacimiento_natural').val(sagrilaft.naturales.fecha_nacimiento);
                    $('#nacionalidad_natural').val(sagrilaft.naturales.nacionalidad);
                    $('#ocupacion_natural').val(sagrilaft.naturales.ocupacion);
                    $('#actividad_natural').val(sagrilaft.naturales.actividad_economica);
                    $('#ciiu_natural').val(sagrilaft.naturales.ciiu);
                    $('#empresa_natural').val(sagrilaft.naturales.donde_trabaja);
                    $('#cargo_natural').val(sagrilaft.naturales.cargo);
                    $('#ciudadtr_natural').val(sagrilaft.naturales.direccion_trabajo);
                    $('#telefono_natural').val(sagrilaft.naturales.telefono_trabajo);
                    $('#fax_natural').val(sagrilaft.naturales.fax_trabajo);
                    $('#domicilio_natural').val(sagrilaft.naturales.domicilio);
                    $('#ciudad_natural').val(sagrilaft.naturales.ciudad);
                    $('#departamento_natural').val(sagrilaft.naturales.departamento);
                    $('#fijo_natural').val(sagrilaft.naturales.telefono);
                    $('#email_natural').val(sagrilaft.naturales.email);
                    $('#emailfact_natural').val(sagrilaft.naturales.email_facturacion);
                } else {
                    // Juridica
                    $('#razonsocial_juridica').val(sagrilaft.juridicas.razon_social);
                    $('#nit_juridica').val(sagrilaft.juridicas.nit);
                    $('#clase_juridica').val(sagrilaft.juridicas.clase_sociedad);
                    $('#escritura_juridica').val(sagrilaft.juridicas.constitucion);
                    $('#matricula_juridica').val(sagrilaft.juridicas.n_matricula);
                    $('#representante_juridica').val(sagrilaft.juridicas.representante_legal);
                    $('#tipodoc_juridica').val(sagrilaft.juridicas.tipo_documento);
                    $('#documento_juridica').val(sagrilaft.juridicas.documento);
                    $('#expedicion_juridica').val(sagrilaft.juridicas.expedicion);
                    $('#lugar_juridica').val(sagrilaft.juridicas.lugar);
                    $('#fnacimiento_juridica').val(sagrilaft.juridicas.fecha_nacimiento);
                    $('#oficina_juridica').val(sagrilaft.juridicas.direccion_oficina);
                    $('#ciudad_juridica').val(sagrilaft.juridicas.ciudad);
                    $('#departamento_juridica').val(sagrilaft.juridicas.departamento);
                    $('#fax_juridica').val(sagrilaft.juridicas.fax);
                    $('#tipoempresa_juridica').val(sagrilaft.juridicas.tipo_empresa);
                    $('#ciiu_juridica').val(sagrilaft.juridicas.ciiu);
                    $('#actividad_juridica').val(sagrilaft.juridicas.actividad_economica);
                    $('#email_juridica').val(sagrilaft.juridicas.email);
                    $('#telfono_juridica').val(sagrilaft.juridicas.telefono);
                    $('#contacto_juridica').val(sagrilaft.juridicas.persona_contacto);
                    $('#cargo_juridica').val(sagrilaft.juridicas.cargo);
                    $('#emailfact_juridica').val(sagrilaft.juridicas.email_factura);
                }

                $('#ingresos').val(sagrilaft.ingresos_mensuales);
                $('#egresos').val(sagrilaft.egresos_mensuales);
                $('#activos').val(sagrilaft.activos);
                $('#pasivos').val(sagrilaft.pasivos);
                $('#patrimonio').val(sagrilaft.patrimonio);
                $('#revisor_fiscal').val(sagrilaft.revisor_fiscal);
                $('#otros_ingresos').val(sagrilaft.otros_ingresos);
                $('#operaciones_internacionales').val(sagrilaft.operaciones_internacionales);
                $('#operaciones_cual').val(sagrilaft.descrip_internacional);
                $('#mercancia_exportada').val(sagrilaft.mercancia_internacional);
            }
        });
    </script>
</body>

</html>
