@extends('layouts.menu')

@section('css')
    <link href="{{ asset('assets/css/app/tables_img.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.2.6/css/select.dataTables.css" />
    <style>
        .box a {
            font-size: 16px;
            color: hsl(229, 6%, 66%);
            text-decoration: none;
        }

        .box h2 {
            font-size: 1.45rem;
            font-weight: 700;
            color: hsl(229, 31%, 21%);
        }

        .box {
            border-radius: 5px;
            background-color: white;
            box-shadow: 0px 30px 40px -20px hsl(229, 6%, 66%);
            padding: 30px;
            margin: 20px;
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop;
        }

        #div_organizacion {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_formas_pago {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_pucs {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_clientes {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_proveedores {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_empleados {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_centros_costos {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_tipos_empresas {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_tipos_regimenes {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_actividades_economicas {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_tipos_documentos {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_ciudades {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_config_pucs {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        @keyframes slideInFromTop {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .box:hover {
            box-shadow: 0px 30px 40px -20px hsl(229, 31%, 21%);
        }

        @media (max-width: 450px) {
            .box {
                height: 200px;
            }
        }

        @media (max-width: 950px) and (min-width: 450px) {
            .box {
                text-align: center;
                height: 180px;
            }
        }

        .cyan {
            border-top: 3px solid hsl(180, 62%, 55%);
        }

        .red {
            border-top: 3px solid hsl(0, 78%, 62%);
        }

        .blue {
            border-top: 3px solid hsl(212, 86%, 64%);
        }

        .orange {
            border-top: 3px solid hsl(34, 97%, 64%);
        }

        @media (min-width: 950px) {
            .row1-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .row2-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .box-down {
                position: relative;
                top: 150px;
            }

            .box {
                width: 20%;

            }
        }
    </style>
@endsection

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Configuración</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row row-sm" id="div_general">
            <div class="row1-container">
                <div class="box box-down cyan" style="border-top: 14px solid hsl(180, 62%, 55%)">
                    <h2 style="margin-top: -8px">Parametrización</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnImpuestos">Impuestos</a></li>
                        <li><a href="javascript:void(0);" data-bs-target="#modalResolucion" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Resolución</a></li>
                        <li><a href="javascript:void(0);" data-bs-target="#modalCuentas" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Documentos</a></li>
                        <li><a href="javascript:void(0);" id="btnComprobantes">Comprobantes</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-team-builder.svg"
                        alt="Terceros">
                </div>

                <div class="box red" style="border-top: 14px solid hsl(0, 78%, 62%)">
                    <h2 style="margin-top: -8px">General</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnOrganizacion">Organización</a></li>
                        <li><a href="javascript:void(0);" id="btnCentrosCostos">Centros Costos</a></li>
                        <li><a href="javascript:void(0);" id="btnPucCliente">Cuentas Contables</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-supervisor.svg"
                        alt="General">
                </div>

                <div class="box box-down blue" style="border-top: 14px solid hsl(212, 86%, 64%)">
                    <h2 style="margin-top: -8px">Catálogo Informativo</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnAdminTributos">Tributos</a></li>
                        <li><a href="javascript:void(0);" id="btnPuc">Cuentas Contables</a></li>
                        <li><a href="javascript:void(0);" id="btnAdminActividadEconomica">Actividades Económicas</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-karma.svg"
                        alt="Catálogo">
                </div>
            </div>
            <div class="row2-container">
                <div class="box orange" style="border-top: 14px solid hsl(34, 97%, 64%)">
                    <h2 style="margin-top: -8px">Administrativo</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnAdminCiudades">Ciudades</a></li>
                        <li><a href="javascript:void(0);" id="btnFormasPago">Formas Pago</a></li>
                        <li><a href="javascript:void(0);" id="btnAdminTipoEmpresa">Tipos Empresas</a></li>
                        <li><a href="javascript:void(0);" id="btnAdminTipoRegimen">Tipos Régimenes</a></li>
                        <li><a href="javascript:void(0);" id="btnAdminTipoDocumento">Tipos Documentos</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-calculator.svg"
                        alt="Opción">
                </div>
            </div>
        </div>

        @include('admin.contabilidad.configuracion.organizacion')
        @include('admin.contabilidad.configuracion.formas_pago')
        @include('admin.contabilidad.configuracion.pucs')
        @include('admin.contabilidad.configuracion.config_puc')
        @include('admin.contabilidad.configuracion.centros_costos')
        @include('admin.contabilidad.configuracion.actividades_economicas')
        @include('admin.contabilidad.configuracion.ciudades')
        @include('admin.contabilidad.configuracion.tipos_documentos')
        @include('admin.contabilidad.configuracion.tipos_empresas')
        @include('admin.contabilidad.configuracion.tipos_regimenes')
        @include('admin.contabilidad.configuracion.parametrizacion.cuentas_contables')
        @include('admin.contabilidad.configuracion.parametrizacion.impuestos')
        @include('admin.contabilidad.configuracion.parametrizacion.resolucion')
        @include('admin.contabilidad.configuracion.tributos')
        @include('admin.contabilidad.configuracion.parametrizacion.comprobantes')

        <!-- Modal Seleccionar Parametrización -->
        <div class="modal  fade" id="modalCuentas">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Parametrización de documentos</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Documento</label>
                                <select class="form-select" id="param_cuenta_select">
                                    <option value="">Seleccione un opción</option>
                                    <option value="1">Comprobante de egreso</option>
                                    <option value="2">Factura de compra</option>
                                    <option value="3">Factura de venta</option>
                                    <option value="4">Nómina</option>
                                    <option value="5">Recibos de caja</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .select2-container--default .select2-results__option[aria-disabled=true] {
                display: none;
            }
        </style>

        <!-- Modal Seleccionar Tipo Cuenta -->
        <div class="modal  fade" id="modalTipoCuentas">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Parametrización de documentos</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo de parametrización</label>
                                <select class="form-select" id="param_tipo_cuenta_select">
                                    <option value="">Seleccione un opción</option>
                                    <option disabled data-factura="[2,3]" value="1">Producto</option>
                                    <option disabled data-factura="[2,3]" value="2">Servicio</option>
                                    <option disabled data-factura="[2,3]" value="3">Activo</option>
                                    <option disabled data-factura="[2]" value="4">Gasto</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Resolución Factura -->
        <div class="modal  fade" id="modalResolucion">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Parametrización de resolución</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Documento</label>
                                <select class="form-select" id="resoluc_select">
                                    <option value="">Seleccione un opción</option>
                                    <option value="1">Factura Venta</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
    <script src="//cdn.datatables.net/select/1.2.6/js/dataTables.select.js"></script>
    <script src="https://homfen.github.io/dataTables.treeGrid.js/dataTables.treeGrid.js"></script>
    <script src="{{ asset('assets/js/app/contabilidad/configuracion.js') }}"></script>
@endsection
