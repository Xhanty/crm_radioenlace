@extends('layouts.menu')

@section('css')
    <style>
        .btn-flotante {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            border-radius: 5px;
            letter-spacing: 2px;
            background-color: #3858F9;
            padding: 18px 30px;
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .btn-flotante:hover {
            background-color: #3858F9;
            color: #ffffff;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-7px);
        }

        @media only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 14px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Permisos Usuarios</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row">
            <div class="col-lg-4 col-xl-2">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title" id="name_empleado">Empleado</div>
                    </div>
                    <div class="main-content-left main-content-left-mail card-body pt-0 ">
                        <div class="main-settings-menu">
                            <nav class="nav main-nav-column">
                                <a class="nav-link active border-top-0 thumb mb-1 select_div" id="btn_documentos"
                                    href="javascript:void(0);">
                                    <i class="fe fe-folder"></i> Documentos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_calidad"
                                    href="javascript:void(0);">
                                    <i class="fe fe-clipboard"></i> Gestión Calidad
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_humana"
                                    href="javascript:void(0);">
                                    <i class="fe fe-user-check"></i> Gestión Humana
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_solicitudes"
                                    href="javascript:void(0);">
                                    <i class="fe fe-sliders"></i> Solicitudes Inventario
                                </a>
                                <a class="nav-link thumb mb-1 select_div" id="btn_asignaciones"
                                    href="javascript:void(0);">
                                    <i class="fe fe-check"></i> Asignaciones
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_comercial"
                                    href="javascript:void(0);">
                                    <i class="fe fe-file-text"></i> Comercial
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_vendedores"
                                    href="javascript:void(0);">
                                    <i class="fe fe-shopping-cart"></i> Vendedores
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_contabilidad"
                                    href="javascript:void(0);">
                                    <i class="fe fe-dollar-sign"></i> Contabilidad
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_inventario"
                                    href="javascript:void(0);">
                                    <i class="fe fe-package"></i> Inventario
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_proyectos"
                                    href="javascript:void(0);">
                                    <i class="fe fe-shield"></i> Proyectos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_puntos"
                                    href="javascript:void(0);">
                                    <i class="fe fe-credit-card"></i> Puntos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_reparaciones"
                                    href="javascript:void(0);">
                                    <i class="fe fe-layers"></i> Reparaciones
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_terceros"
                                    href="javascript:void(0);">
                                    <i class="fe fe-users"></i> Terceros
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_vehiculos"
                                    href="javascript:void(0);">
                                    <i class="fe fe-truck"></i> Vehículos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1 select_div" id="btn_config"
                                    href="javascript:void(0);">
                                    <i class="fe fe-settings"></i> Configuración
                                </a>                                                                
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @include('permisos.asignaciones')
            @include('permisos.terceros')
            @include('permisos.puntos')
            @include('permisos.vehiculos')
            @include('permisos.inventario')
            @include('permisos.solicitudes')
            @include('permisos.proyectos')
            @include('permisos.reparaciones')
            @include('permisos.documentos')
            @include('permisos.calidad')
            @include('permisos.gestion_humana')
            @include('permisos.comercial')
            @include('permisos.contabilidad')
            @include('permisos.configuracion')
            @include('permisos.vendedores')
        </div>

        <!-- Modal Seleccionar Empleado -->
        <div class="modal  fade" id="modalSelect">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Asignar Permisos</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Empleado</label>
                                <select class="form-select" id="empleado_select">
                                    <option value="">Seleccione un empleado</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelect" data-bs-toggle="modal"
            data-bs-effect="effect-scale">Empleado</a>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/permisos.js') }}"></script>
    <script src="{{ asset('assets/js/app/permisos_cheks.js') }}"></script>
@endsection
