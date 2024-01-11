@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Gestión Humana</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de documentos</h3>
                        </div>
                        <!--<div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Nuevo Formato</button>
                        </div>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Formato</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>HP01</td>
                                        <td>Selección de personal</td>
                                        <td>
                                            <button title="Registros" class="btn btn-primary btn-sm btnListado"
                                                data-id="">
                                                <i class="fa fa-list"></i>
                                            </button>
                                            <button title="Nuevo Registro" class="btn btn-secondary btn-sm btnNewRegistro"
                                                data-id="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Certificado de inducción y reinducción SST</td>
                                        <td>
                                            <button title="Registros" class="btn btn-primary btn-sm btnListado"
                                                data-id="">
                                                <i class="fa fa-list"></i>
                                            </button>
                                            <button title="Nuevo Registro" class="btn btn-secondary btn-sm btnNewRegistro"
                                                data-id="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Evaluación de inducción SST</td>
                                        <td>
                                            <button title="Registros" class="btn btn-primary btn-sm btnListado"
                                                data-id="">
                                                <i class="fa fa-list"></i>
                                            </button>
                                            <button title="Nuevo Registro" class="btn btn-secondary btn-sm btnNewRegistro"
                                                data-id="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Consentimiento informado sociodemográfico</td>
                                        <td>
                                            <button title="Registros" class="btn btn-primary btn-sm btnListado"
                                                data-id="">
                                                <i class="fa fa-list"></i>
                                            </button>
                                            <button title="Nuevo Registro" class="btn btn-secondary btn-sm btnNewRegistro"
                                                data-id="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
@endsection
