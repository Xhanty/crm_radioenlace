@extends('layouts.menu')

@section('css')
    <link href="{{ asset('assets/css/app/tables_img.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Clientes</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm" id="div_list_clientes">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de Clientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Registrar Cliente</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="table_clientes_img" style="cursor: pointer">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Razon Social</th>
                                        <th>Contacto</th>
                                        <th>Celular</th>
                                        <th>E-Mail</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- row -->
        <div class="row row-sm" id="div_content_cliente_edit">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2" id="title_cliente_edit"></h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="back_table_cliente_edit">&times;</button>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -18px;">
                        <div class="d-flex justify-content-center">
                            <img src="https://formrad.com/radio_enlace/avatares_clientes/noavatar.png">
                        </div>
                        <br>
                        <input type="hidden" readonly disabled id="id_cliente_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Cliente</label>
                                <select id="tipo_cliente_edit" class="form-select">
                                    <option value="">Seleccione un tipo de cliente</option>
                                    <option value="1">Empresa</option>
                                    <option value="0">Persona Natural</option>
                                </select>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Ciudad</label>
                                <input class="form-control" id="ciudad_cliente_edit" placeholder="Ciudad" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Documento</label>
                                <select id="tipo_doc_cliente_edit" class="form-select">
                                    <option value="">Seleccione un tipo de documento</option>
                                    <option value="1">Cédula</option>
                                    <option value="0">NIT</option>
                                </select>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Documento</label>
                                <input class="form-control" id="documento_cliente_edit" placeholder="Documento"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Razón Social</label>
                                <input class="form-control" id="razon_social_edit" placeholder="Razón Social"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Dirección</label>
                                <input class="form-control" id="direccion_edit" placeholder="Dirección" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Teléfono Fijo</label>
                                <input class="form-control" id="telefono_edit" placeholder="Teléfono Fijo" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Celular</label>
                                <input class="form-control" id="celular_edit" placeholder="Celular" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Contacto</label>
                                <input class="form-control" id="contacto_edit" placeholder="Contacto" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">E-Mail</label>
                                <input class="form-control" id="email_edit" placeholder="E-Mail" type="email">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Régimen</label>
                                <input class="form-control" id="tipo_regimenadd" placeholder="Tipo Régimen"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Código Sucursal</label>
                                <input class="form-control" id="codigo_sucursaladd" placeholder="Código Sucursal"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Indicativo Teléfono</label>
                                <input class="form-control" id="indicativo_telefonoadd" placeholder="Indicativo Teléfono"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Extensión</label>
                                <input class="form-control" id="extencionadd" placeholder="Extensión" type="text">
                            </div>
                        </div>
                        <br>

                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btnModificarCliente1" type="button">Modificar
                                Datos Básicos</button>
                        </div>

                        <br>

                        <div class="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-detail mt-3 tab-card">
                                        <div class="card-header tab-card-header" style="border: 1px solid #ccc;">
                                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link nav-link-1 active" href="javascript:void(0)">Datos
                                                        Facturación</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link nav-link-2" href="javascript:void(0)">Datos
                                                        Técnicos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link nav-link-3" id="three-tab"
                                                        href="javascript:void(0)">Anexos</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show p-3 active" id="one_detail">
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Nombre</label>
                                                        <input class="form-control" id="nombre_fact_edit"
                                                            placeholder="Nombre" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Teléfono</label>
                                                        <input class="form-control" id="telefono_fact_edit"
                                                            placeholder="Teléfono" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Apellido</label>
                                                        <input class="form-control" id="apellido_fact_edit"
                                                            placeholder="Apellido" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Extensión</label>
                                                        <input class="form-control" id="extension_fact_edit"
                                                            placeholder="Extensión" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">E-Mail</label>
                                                        <input class="form-control" id="email_fact_edit"
                                                            placeholder="E-Mail" type="email">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Código Postal</label>
                                                        <input class="form-control" id="codigo_fact_edit"
                                                            placeholder="Código Postal" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Tipo Régimen</label>
                                                        <input class="form-control" id="regimen_fact_edit"
                                                            placeholder="Tipo Régimen" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Responsabilidad Fiscal</label>
                                                        <input class="form-control" id="responsable_fact_edit"
                                                            placeholder="Responsabilidad Fiscal" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-6">
                                                        <label for="">Indicativo Teléfono</label>
                                                        <input class="form-control" id="indicativo_fact_edit"
                                                            placeholder="Indicativo Teléfono" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="text-center">
                                                    <button class="btn ripple btn-primary" id="btnModificarCliente2"
                                                        type="button">Modificar Datos Facturación</button>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade show p-3" id="two_detail">
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Nombre</label>
                                                        <input class="form-control" id="nombre_tecn_edit"
                                                            placeholder="Nombre" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Indicativo Teléfono</label>
                                                        <input class="form-control" id="indicativo_tecn_edit"
                                                            placeholder="Teléfono" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Apellido</label>
                                                        <input class="form-control" id="apellido_tecn_edit"
                                                            placeholder="Apellido" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Teléfono</label>
                                                        <input class="form-control" id="telefono_tecn_edit"
                                                            placeholder="Teléfono" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">E-Mail</label>
                                                        <input class="form-control" id="email_tecn_edit"
                                                            placeholder="E-Mail" type="email">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Extensión</label>
                                                        <input class="form-control" id="extension_tecn_edit"
                                                            placeholder="Extensión" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="text-center">
                                                    <button class="btn ripple btn-primary" id="btnModificarCliente3"
                                                        type="button">Modificar Datos Técnicos</button>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade show p-3" id="three_detail">
                                                <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="table_anexos_edit">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-15p border-bottom-0">Tipo</th>
                                                            <th class="wd-20p border-bottom-0">Fecha</th>
                                                            <th class="wd-15p border-bottom-0">Descripción</th>
                                                            <th class="wd-15p border-bottom-0">Creado Por</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/clientes.js') }}"></script>
@endsection
