@extends('layouts.menu')

@section('css')
    <link href="{{ asset('assets/css/app/tables_img.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-container container-fluid">
        <!-- Input Edit Admin -->
        <input type="hidden" disabled readonly id="edit_empleados_admin"
            value="{{ auth()->user()->hasPermissionTo('gestionar_empleados') }}">

        <!-- Input Clave Admin -->
        <input type="hidden" disabled readonly id="clave_empleados_admin"
            value="{{ auth()->user()->hasPermissionTo('gestionar_empleados') }}">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Empleados</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm" id="div_list_empleados">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de Empleados</h3>
                        </div>
                        @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                            <div class="div-2-tables-header">
                                <button class="btn btn-primary" id="addNewEmpleado">Registrar Empleado</button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="table_empleados_img">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Código Empleado</th>
                                        <th>Teléfono</th>
                                        <th>Rol</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- row Edit -->
        <div class="row row-sm" id="div_content_empleado_edit">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2" id="title_empleado_edit"></h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="back_table_empleado_edit">&times;</button>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -18px;">
                        <div class="d-flex justify-content-center">
                            <img id="img_empleado_edit" class="avatar border rounded-circle"
                                style="width: 14pc; height: 14pc;" src="{{ asset('images/clientes/noavatar.png') }}">
                        </div>
                        <br>
                        <input type="hidden" readonly disabled id="id_empleado_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Código Empleado</label>
                                <input class="form-control" id="codigo_empleado_edit" placeholder="Código Empleado"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Nombre</label>
                                <input class="form-control" id="nombre_empleado_edit" placeholder="Nombre" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cargo</label>
                                <input class="form-control" id="cargo_empleado_edit" placeholder="Cargo" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Rol</label>
                                <select id="rol_empleado_edit" class="form-select">
                                    <option value="">Seleccione un rol</option>
                                    <option value="0">A0</option>
                                    <option value="1">A1</option>
                                    <option value="2">A2</option>
                                    <option value="3">A3</option>
                                    <option value="4">A4</option>
                                    <option value="5">A5</option>
                                    <option value="6">A6</option>
                                    <option value="7">A7</option>
                                    <option value="8">A8</option>
                                    <option value="9">A9</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">E-Mail</label>
                                <input class="form-control" id="email_edit" placeholder="E-Mail" type="email">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Teléfono Fijo</label>
                                <input class="form-control" id="telefono_fij_edit" placeholder="Teléfono Fijo"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Teléfono Celular</label>
                                <input class="form-control" id="telefono_cel_edit" placeholder="Teléfono Celular"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Dirección</label>
                                <input class="form-control" id="direccion_edit" placeholder="Dirección" type="text">
                            </div>
                        </div>
                        <br>

                        <!-- ACÁ PARA ABAJO -->
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fecha Ingreso</label>
                                <input class="form-control" id="fecha_ingreso_edit" placeholder="Fecha Ingreso"
                                    type="date">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Fecha Retiro</label>
                                <input class="form-control" id="fecha_retiro_edit" placeholder="Fecha Retiro"
                                    type="date">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fecha Nacimiento</label>
                                <input class="form-control" id="fecha_nacimiento_edit" placeholder="Fecha Nacimiento"
                                    type="date">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">EPS</label>
                                <input class="form-control" id="eps_edit" placeholder="EPS" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Caja Compensación</label>
                                <input class="form-control" id="caja_compensacion_edit" placeholder="Caja Compensación"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">ARL</label>
                                <input class="form-control" id="arl_edit" placeholder="ARL" type="text">
                            </div>
                        </div>
                        <br>

                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fondo Pensión</label>
                                <input class="form-control" id="fondo_pension_edit" placeholder="Fondo Pensión"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Riesgos Profesionales</label>
                                <select class="form-select" id="riesgos_prof_edit">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Avatar / Foto</label>
                                <input class="form-control" id="avataredit" type="file" accept="image/*">
                            </div>
                        </div>
                        <br>
                        @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                            <div class="text-center">
                                <button class="btn ripple btn-primary" id="btnModificarEmpleado1"
                                    type="button">Modificar
                                    Datos Básicos</button>
                            </div>

                            <br>
                        @endif

                        <div class="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-detail mt-3 tab-card">
                                        <div class="card-header tab-card-header" style="border: 1px solid #ccc;">
                                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link nav-link-1 active" href="javascript:void(0)">Otra
                                                        Información</a>
                                                </li>
                                                @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                                                    <li class="nav-item">
                                                        <a class="nav-link nav-link-2"
                                                            href="javascript:void(0)">Configurar
                                                            Nomina</a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                                                    <li class="nav-item">
                                                        <a class="nav-link nav-link-3" href="javascript:void(0)">Reportar
                                                            Novedad</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link nav-link-4" href="javascript:void(0)">Reportar
                                                            Horas Trabajadas</a>
                                                    </li>
                                                @endif
                                                @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                                                    <li class="nav-item">
                                                        <a class="nav-link nav-link-5" id="three-tab"
                                                            href="javascript:void(0)">Anexos</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show p-3 active" id="one_detail">
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Observaciones</label>
                                                        <input class="form-control" id="observaciones_otra_info_edit"
                                                            placeholder="Observaciones" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Prestamo</label>
                                                        <select id="prestamo_otra_info_edit" class="form-select">
                                                            <option value="0">No</option>
                                                            <option value="1">Sí</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Periodo Dotación</label>
                                                        <input class="form-control" id="periodo_dotacion_otra_info_edit"
                                                            placeholder="Periodo Dotación" type="date">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Número Licencia Conducción</label>
                                                        <input class="form-control" id="licencia_otra_info_edit"
                                                            placeholder="Número Licencia Conducción" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Vencimiento Licencia Conducción</label>
                                                        <input class="form-control" id="vencimiento_otra_info_edit"
                                                            placeholder="Vencimiento Licencia Conducción" type="date">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Multas Tránsito Pendientes</label>
                                                        <select id="multas_pend_otra_info_edit" class="form-select">
                                                            <option value="0">No</option>
                                                            <option value="1">Sí</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Implementos Seguridad</label>
                                                        <input class="form-control" id="implementos_otra_info_edit"
                                                            placeholder="Código Empleado" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Fecha Culminación Contrato</label>
                                                        <input class="form-control" id="fecha_culminacion_otra_info_edit"
                                                            placeholder="Fecha Culminación Contrato" type="date">
                                                    </div>
                                                </div>
                                                <br>
                                                @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                                                    <div class="text-center">
                                                        <button class="btn ripple btn-primary" id="btnModificarEmpleado2"
                                                            type="button">Modificar Otra Información</button>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="tab-pane fade show p-3" id="two_detail">
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Sueldo</label>
                                                        <input class="form-control" id="suelto_nomina_edit"
                                                            placeholder="Sueldo" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Incapacidad Retroactivo</label>
                                                        <input class="form-control" id="incapacidad_nomina_edit"
                                                            placeholder="Incapacidad Retroactivo" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Día de Trabajo</label>
                                                        <input class="form-control" id="dia_trabajo_nomina_edit"
                                                            placeholder="Día de Trabajo" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Total Devengado</label>
                                                        <input class="form-control" id="total_devengado_nomina_edit"
                                                            placeholder="Total Devengado" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Días Laborados</label>
                                                        <input class="form-control" id="dias_laborados_nomina_edit"
                                                            placeholder="Días Laborados" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Salud</label>
                                                        <input class="form-control" id="salud_nomina_edit"
                                                            placeholder="Salud" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Quincena</label>
                                                        <input class="form-control" id="quincena_nomina_edit"
                                                            placeholder="Quincena" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Pensión</label>
                                                        <input class="form-control" id="pension_nomina_edit"
                                                            placeholder="Pensión" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Extras</label>
                                                        <input class="form-control" id="extras_nomina_edit"
                                                            placeholder="Extras" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">% FSP</label>
                                                        <input class="form-control" id="fps_nomina_edit"
                                                            placeholder="% FSP" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Subsidio Transporte</label>
                                                        <input class="form-control" id="subsidio_transporte_nomina_edit"
                                                            placeholder="Subsidio Transporte" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">% Retencion FTE</label>
                                                        <input class="form-control" id="retencion_fte_nomina_edit"
                                                            placeholder="% Retencion FTE" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label for="">Transporte Adicional</label>
                                                        <input class="form-control" id="transporte_adicional_nomina_edit"
                                                            placeholder="Transporte Adicional" type="text">
                                                    </div>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label for="">Total Global</label>
                                                        <input class="form-control" id="total_global_nomina_edit"
                                                            placeholder="Total Global" type="text">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="text-center">
                                                    <button class="btn ripple btn-primary" id="btnModificarEmpleado3"
                                                        type="button">Modificar Configuración Nomina</button>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade show p-3" id="three_detail">
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn ripple btn-primary"
                                                        data-bs-target="#modalAddNovedad" data-bs-toggle="modal"
                                                        data-bs-effect="effect-scale" type="button">Reportar
                                                        Novedad</button>
                                                </div>
                                                <br>
                                                <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                                    id="table_novedades_edit">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-15p border-bottom-0">Motivo</th>
                                                            <th class="wd-20p border-bottom-0">Días</th>
                                                            <th class="wd-15p border-bottom-0">Fecha</th>
                                                            <th class="wd-15p border-bottom-0">Status</th>
                                                            <th class="wd-10p border-bottom-0">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane fade show p-3" id="four_detail">
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn ripple btn-primary" data-bs-target="#modalAddHoras"
                                                        data-bs-toggle="modal" data-bs-effect="effect-scale"
                                                        type="button">Reportar Horas Trabajadas</button>
                                                </div>
                                                <br>
                                                <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                                    id="table_horas_trabajadas_edit">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-15p border-bottom-0">Motivo</th>
                                                            <th class="wd-20p border-bottom-0">Días</th>
                                                            <th class="wd-15p border-bottom-0">Fecha</th>
                                                            <th class="wd-15p border-bottom-0">Status</th>
                                                            <th class="wd-10p border-bottom-0">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane fade show p-3" id="five_detail">
                                                @if (auth()->user()->hasPermissionTo('gestionar_empleados'))
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn ripple btn-primary"
                                                            data-bs-target="#modalAddAnexo" data-bs-toggle="modal"
                                                            data-bs-effect="effect-scale" type="button">Agregar
                                                            Anexo</button>
                                                    </div>
                                                    <br>
                                                @endif
                                                <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                                    id="table_anexos_edit">
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

        <!-- row Add -->
        <div class="row row-sm" id="div_content_empleado_add">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Agregar Empleado</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="back_table_empleado_add">&times;</button>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -18px;">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Código Empleado</label>
                                <input class="form-control" id="codigo_empleado_add" placeholder="Código Empleado"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Nombre</label>
                                <input class="form-control" id="nombre_empleado_add" placeholder="Nombre"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cargo</label>
                                <input class="form-control" id="cargo_empleado_add" placeholder="Cargo" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Rol</label>
                                <select id="rol_empleado_add" class="form-select">
                                    <option value="0">A0</option>
                                    <option value="1">A1</option>
                                    <option value="2">A2</option>
                                    <option value="3">A3</option>
                                    <option value="4">A4</option>
                                    <option value="5">A5</option>
                                    <option value="6">A6</option>
                                    <option value="7">A7</option>
                                    <option value="8">A8</option>
                                    <option value="9">A9</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">E-Mail</label>
                                <input class="form-control" id="email_add" placeholder="E-Mail" type="email">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Teléfono Fijo</label>
                                <input class="form-control" id="telefono_fij_add" placeholder="Teléfono Fijo"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Teléfono Celular</label>
                                <input class="form-control" id="telefono_cel_add" placeholder="Teléfono Celular"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Dirección</label>
                                <input class="form-control" id="direccion_add" placeholder="Dirección" type="text">
                            </div>
                        </div>
                        <br>

                        <!-- ACÁ PARA ABAJO -->
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fecha Ingreso</label>
                                <input class="form-control" id="fecha_ingreso_add" placeholder="Fecha Ingreso"
                                    type="date">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Fecha Retiro</label>
                                <input class="form-control" id="fecha_retiro_add" placeholder="Fecha Retiro"
                                    type="date">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fecha Nacimiento</label>
                                <input class="form-control" id="fecha_nacimiento_add" placeholder="Fecha Nacimiento"
                                    type="date">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">EPS</label>
                                <input class="form-control" id="eps_add" placeholder="EPS" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Caja Compensación</label>
                                <input class="form-control" id="caja_compensacion_add" placeholder="Caja Compensación"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">ARL</label>
                                <input class="form-control" id="arl_add" placeholder="ARL" type="text">
                            </div>
                        </div>
                        <br>

                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fondo Pensión</label>
                                <input class="form-control" id="fondo_pension_add" placeholder="Fondo Pensión"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Riesgos Profesionales</label>
                                <select class="form-select" id="riesgos_prof_add">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Avatar / Foto</label>
                                <input class="form-control" id="avataradd" type="file" accept="image/*">
                            </div>
                        </div>
                        <br>

                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btnAgregarEmpleado" type="button">Agregar
                                Empleado</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->

        <!-- Modal Add Novedad -->
        <div class="modal  fade" id="modalAddNovedad">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Novedad</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Motivo</label>
                                <textarea class="form-control" placeholder="Motivo" rows="3" id="motivoadd"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Días a descontar</label>
                                <input class="form-control" id="dias_descontar_add" placeholder="Días a descontar"
                                    type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnAgregarNovedad" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Horas -->
        <div class="modal  fade" id="modalAddHoras">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Reportar Horas Trabajadas</h6><button aria-label="Close"
                            class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Festivo</label>
                                <select class="form-select" id="festivo_add">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Desde</label>
                                <input class="form-control" id="desde_horas_add" type="date">
                            </div>
                            <div class="col-lg">
                                <label for="">Hasta</label>
                                <input class="form-control" id="hasta_horas_add" type="date">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Motivo</label>
                                <textarea class="form-control" placeholder="Motivo" rows="3" id="motivoadd"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnAgregarHoras" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Anexo -->
        <div class="modal  fade" id="modalAddAnexo">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Anexo</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Documento</label>
                                <select class="form-select" required id="tipo_document_anexo_add">
                                    <option value="0">Hoja de vida</option>
                                    <option value="1">Afiliaciones</option>
                                    <option value="2">Contrato</option>
                                    <option value="3">Examenes Ocupacionales</option>
                                    <option value="4">Curso de altura</option>
                                    <option value="5">Capacitaciones</option>
                                    <option value="6">Procesos disciplinarios</option>
                                    <option value="7">Vacaciones</option>
                                    <option value="8">Carnet de vacunación</option>
                                    <option value="9">Primas</option>
                                    <option value="10">Código de ética y buen gobierno</option>
                                    <option value="11">Autorización tratamiento de datos personales</option>
                                    <option value="12">Hoja de vida empresarial</option>
                                    <option value="13">Control de selección</option>
                                    <option value="14">Entrega de carnet</option>
                                    <option value="15">Requisitos laborales</option>
                                    <option value="16">Entrenamiento y preparación incorporación</option>
                                    <option value="17">Registro de inducción</option>
                                    <option value="18">Plan formación inducción</option>
                                    <option value="19">Evidencia Fotográfoca de las capacitaciones</option>
                                    <option value="21">Formatos varios (word excel pdf)</option>
                                    <option value="22">Implementos de seguridad</option>
                                    <option value="23">Incapacidades</option>
                                    <option value="24">Datos Personales</option>
                                    <option value="25">Dotación</option>
                                    <option value="26">Seguridad Social</option>
                                    <option value="27">Prestamo a Empleados</option>
                                    <option value="28">Otros</option>
                                </select>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Documento</label>
                                <input class="form-control" id="archivoadd" type="file">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción</label>
                                <textarea class="form-control" placeholder="Descripción" rows="3" id="descripcion_anexo_add"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnAgregarAnexo" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Change Clave -->
        <div class="modal  fade" id="modalChangeClave">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Cambiar Clave</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_empleado_clave">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="new_clave_empleado">Clave</label>
                                <input class="form-control" id="new_clave_empleado" type="password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnChangeClave" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/empleados.js') }}"></script>
@endsection
