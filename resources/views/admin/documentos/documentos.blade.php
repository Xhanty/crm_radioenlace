@extends('layouts.menu')

@section('content')
    <!--<div class="col-lg-4 col-xl-3">
        <div class="card">
            <div class="main-content-left main-content-left-mail card-body">
                <a class="btn btn-primary btn-compose" id="btnCompose" data-bs-target="#createfile" data-bs-toggle="modal"><i
                        class="fa fa-plus mx-2"></i> Crear Carpeta</a>
                <div class="main-mail-menu">
                    <nav class="nav main-nav-column">
                        <a class="nav-link thumb active " href="javascript:void(0);"><i class="fe fe-folder"></i>
                            Clientes </a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> Gerencia</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> SubGerencia</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i>
                            Contabilidad</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i>
                            Cartera</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i>
                            Tesorería</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> Recursos
                            Humanos</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> Coordinación
                            Comercial </a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> Gerente
                            Comercial</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> Laboratorio</a>
                        <a class="nav-link thumb" href="javascript:void(0);"><i class="fe fe-folder"></i> SST</a>
                    </nav>
                </div>
                <div class=" border rounded-5 mt-3">
                    <div class="card-header bg-transparent font-weight-bold"><i
                            class="fe fe-hard-drive me-2"></i>Almacenamiento</div>
                    <div class="card-body pt-0">
                        <div class="progress fileprogress mg-b-10">
                            <div class="progress-bar progress-bar-xs wd-15p" role="progressbar" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="text-muted font-weight-semibold tx-13 mb-1">26.24 GB Usado de 100 GB</div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

    <div class="main-container container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Documentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Documentos</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div id="fm" style="height: 750px; width: 100%"></div>
        </div>
    </div>
@endsection
