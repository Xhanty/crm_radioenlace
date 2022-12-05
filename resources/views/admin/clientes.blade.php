@extends('layouts.menu')

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

        <style>
            .cards tbody tr {
                float: left;
                width: 19rem;
                margin: 0.5rem;
                border: 0.0625rem solid rgba(0, 0, 0, .125);
                border-radius: .25rem;
                box-shadow: 0.25rem 0.25rem 0.5rem rgba(0, 0, 0, 0.25);
            }

            .cards tbody tr td:first-child {
                display: flex;
                justify-content: center;
            }

            .cards td:before {
                content: attr(data-label);
                position: relative;
                float: left;
                color: #808080;
                margin-left: 0;
                margin-right: 0.5rem;
                text-align: left;
            }

            .cards tbody {
                display: flex;
                flex-wrap: wrap;
                padding: 0.5rem;
                justify-content: center;
            }

            .cards tbody td {
                display: block;
                cursor: pointer;
            }

            .cards thead {
                display: none;
            }

            .table .avatar {
                width: 100px;
                height: 100px;
            }

            .cards .avatar {
                width: 150px;
                height: 150px;
                margin: 15px;
            }

            /* DETAIL CLIENTE */
            .card-detail {
                background-color: #ffffff;
                border: 1px solid rgba(0, 34, 51, 0.1);
                box-shadow: 2px 4px 10px 0 rgba(0, 34, 51, 0.05), 2px 4px 10px 0 rgba(0, 34, 51, 0.05);
                border-radius: 0.15rem;
            }

            /* Tabs Card */

            .tab-card {
                border: 1px solid #eee;
            }

            .tab-card-header {
                background: none;
            }

            /* Default mode */
            .tab-card-header>.nav-tabs {
                border: none;
                margin: 0px;
            }

            .tab-card-header>.nav-tabs>li {
                margin-right: 2px;
            }

            .tab-card-header>.nav-tabs>li>a {
                border: 0;
                border-bottom: 2px solid transparent;
                margin-right: 0;
                color: #737373;
                padding: 2px 15px;
            }

            .tab-card-header>.nav-tabs>li>a.show {
                border-bottom: 2px solid #007bff;
                color: #007bff;
            }

            .tab-card-header>.nav-tabs>li>a:hover {
                color: #007bff;
            }

            .tab-card-header>.tab-content {
                padding-bottom: 0;
            }
        </style>
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
                                <input class="form-control" id="tipo_regimenadd" placeholder="Tipo Régimen" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Código Sucursal</label>
                                <input class="form-control" id="codigo_sucursaladd" placeholder="Código Sucursal" type="text">
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

                        <div class="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-detail mt-3 tab-card">
                                        <div class="card-header tab-card-header">
                                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="one-tab" data-toggle="tab" href="#one"
                                                        role="tab" aria-controls="One" aria-selected="true">Datos Facturación</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="two-tab" data-toggle="tab" href="#two"
                                                        role="tab" aria-controls="Two" aria-selected="false">Datos Técnicos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="three-tab" data-toggle="tab" href="#three"
                                                        role="tab" aria-controls="Three"
                                                        aria-selected="false">Anexos</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active p-3" id="one" role="tabpanel"
                                                aria-labelledby="one-tab">
                                                <h5 class="card-title">Tab Card One</h5>
                                                <p class="card-text">Some quick example text to build on the card title and
                                                    make up
                                                    the bulk of the card's content.</p>
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
