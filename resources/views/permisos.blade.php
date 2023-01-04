@extends('layouts.menu')

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
                        <div class="card-title" id="name_empleado">Settings</div>
                    </div>
                    <div class="main-content-left main-content-left-mail card-body pt-0 ">
                        <div class="main-settings-menu">
                            <nav class="nav main-nav-column">
                                <a class="nav-link thumb active mb-1" href="javascript:void(0);">
                                    <i class="fe fe-check"></i> Asignaciones
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-user"></i> Actividades Diarias
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-credit-card"></i> Puntos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-truck"></i> Vehículos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-user"></i> Clientes
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-users"></i> Empleados
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-briefcase"></i> Proveedores
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-package"></i> Inventario
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-shopping-cart"></i> Movimientos Inventario
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-sliders"></i> Solicitudes Inventario
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-shield"></i> Proyectos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-bar-chart"></i> Seguimientos Clientes
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-layers"></i> Reparaciones
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-folder"></i> Documentos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-file-text"></i> Comercial
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-dollar-sign"></i> Contabilidad
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-globe"></i> Gastos
                                </a>
                                <a class="nav-link border-top-0 thumb mb-1" href="javascript:void(0);">
                                    <i class="fe fe-settings"></i> Configuración
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div id="asignaciones_div" class="col-lg-8 col-xl-10 div-list-ocult">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Asignaciones Generales</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-asig-gen-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar
                                                            sus asignaciones</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input checked disabled type="checkbox" class="form-switch-input">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Gestionar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar las asignaciones</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-asig-gen-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="far fa-handshake"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Asignar Puntos
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Asignar
                                                            puntos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-asig-gen-2">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Asignaciones Proyectos</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-asig-pro-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar
                                                            sus asignaciones</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input checked disabled type="checkbox" class="form-switch-input">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Gestionar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar las asignaciones</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-asig-pro-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="far fa-handshake"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Asignar Puntos
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Asignar
                                                            puntos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-asig-pro-2">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="actividades_div" class="col-lg-8 col-xl-10 div-list-ocult">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Actividades Diarias</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-act-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar
                                                            sus actividades</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input checked disabled type="checkbox" class="form-switch-input">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Gestionar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar las actividades</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-act-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="puntos_div" class="col-lg-8 col-xl-10 div-list-ocult">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Puntos</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-punt-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar
                                                            sus puntos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input checked disabled type="checkbox" class="form-switch-input">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Gestionar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar los puntos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-punt-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="vehiculos_div" class="col-lg-8 col-xl-10 div-list-ocult">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Vehículos</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-veh-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar
                                                            los vehículos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-veh-5">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Gestionar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar los vehículos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-veh-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="far fa-envelope"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Enviar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Enviar los checklist de los vehículos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-veh-2">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fe fe-check"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Checklist
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar los checklist de vehículos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-veh-3">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-file"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Salud
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar las encuestas de salud</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-veh-4">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="clientes_div" class="col-lg-8 col-xl-10 div-list-ocult">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Clientes</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-clie-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar clientes</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-plus"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Agregar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Agregar clientes</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-2">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Modificar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Modificar clientes</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-3">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-file"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Anexos
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar Anexos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-4">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="clientes_div" class="col-lg-8 col-xl-10 div-list-ocult">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                            <div class="col-6" style="padding: 0px;">
                                <div class="card-title" style="margin-bottom: 0px">Empleados</div>
                            </div>
                            <div class="col-6" style="padding: 0px;">
                                <label class="form-switch float-end mb-0">
                                    <input type="checkbox" class="form-switch-input check-emp-0">
                                    <span class="form-switch-indicator custom-radius"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin-left: 6px">
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Ver</p>
                                                        <p class="tx-13 text-muted mb-0">Visualizar clientes</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-1">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-plus"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Agregar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Agregar clientes</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-2">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-pencil-alt"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Modificar
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Modificar clientes</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-3">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex">
                                                    <div class="settings-main-icon me-4 mt-1"><i
                                                            class="fa fa-file"></i>
                                                    </div>
                                                    <div>
                                                        <p class="tx-20 font-weight-semibold d-flex mb-0">Anexos
                                                        </p>
                                                        <p class="tx-13 text-muted mb-0">Gestionar Anexos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-3">
                                        <label class="form-switch float-end mb-0">
                                            <input type="checkbox" class="form-switch-input check-clie-4">
                                            <span class="form-switch-indicator custom-radius"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Seleccionar Empleado -->
        <div class="modal  fade" id="modalSelect">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Asignar Permisos</h6>
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/permisos.js') }}"></script>
    <script src="{{ asset('assets/js/app/permisos_cheks.js') }}"></script>
@endsection
