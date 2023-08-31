@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Viáticos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Visitas</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de visitas pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Registrar
                                Visita</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Motivo</th>
                                        <th class="text-center">Destino</th>
                                        <th class="text-center">Responsable</th>
                                        <th class="text-center">F. Salida</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitas_pendientes as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->consecutivo }}</td>
                                            <td class="text-center">{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td class="text-center">{{ $value->motivo }}</td>
                                            <td class="text-center">{{ $value->destino }}</td>
                                            <td class="text-center">{{ $value->encargado }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->fecha_salida)) }}
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                <button title="Modificar" class="btn btn-warning btn-sm btnEdit"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-pencil-alt"></i> Modificar
                                                </button>
                                                <br>
                                                <button title="Eliminar" class="btn btn-danger btn-sm btnDelete mt-1"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </button>
                                                @if ($value->status == 1)
                                                    <!--<br>
                                                                                <button title="Completar"
                                                                                    class="btn btn-success btn-sm btnConfirmar mt-1"
                                                                                    data-id="{{ $value->id }}">
                                                                                    <i class="fa fa-check"></i> Completar
                                                                                </button>-->
                                                @endif
                                                <br>
                                                <!--<a href="{{ route('reparacion_pdf') }}?token={{ $value->id }}"
                                                                                target="_BLANK" title="Imprimir" class="btn btn-success btn-sm mt-1"
                                                                                data-id="{{ $value->id }}">
                                                                                <i class="fa fa-print"></i> Imprimir
                                                                            </a>-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de visitas completadas</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <!-- Excel -->
                            <!--<a href="{{ route('reparaciones_excel') }}" class="btn btn-primary">Generar Excel</a>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Motivo</th>
                                        <th class="text-center">Destino</th>
                                        <th class="text-center">Responsable</th>
                                        <th class="text-center">F. Salida</th>
                                        <th class="text-center">F. Llegada</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitas_completadas as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->consecutivo }}</td>
                                            <td class="text-center">{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td class="text-center">{{ $value->motivo }}</td>
                                            <td class="text-center">{{ $value->destino }}</td>
                                            <td class="text-center">{{ $value->encargado }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->fecha_salida)) }}
                                            </td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->fecha_llegada)) }}
                                            </td>
                                            <td class="text-center">{{ $value->encargado }}</td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                <!--<a href="{{ route('reparacion_pdf') }}?token={{ $value->id }}"
                                                                        target="_BLANK" title="Imprimir" class="btn btn-success btn-sm"
                                                                        data-id="{{ $value->id }}">
                                                                        <i class="fa fa-print"></i> Imprimir
                                                                    </td>
                                                                </a>-->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar visita</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Empresa</label>
                                <select id="cliente_add" class="form-select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Responsable</label>
                                <select id="responsable_add" class="form-select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Motivo</label>
                                <select id="motivo_add" class="form-select">
                                    <option value="1">Estudio de cobertura</option>
                                    <option value="2">Instalación</option>
                                    <option value="3">Mantenimiento correctivo</option>
                                    <option value="4">Mantenimiento preventivo</option>
                                    <option value="5">Desinstalación</option>
                                    <option value="6">Mejoras en el servicio</option>
                                    <option value="7">Configuración de equipos</option>
                                    <option value="8">Instalación de anexos</option>
                                    <option value="9">Capacitación o inducción</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Destino</label>
                                <input id="destino_add" class="form-control" placeholder="Destino" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Vehículo</label>
                                <select id="vehiculo_add" class="form-select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Técnicos</label>
                                <select id="tecnicos_add" class="form-select" multiple>
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarRecepcion" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver recepción</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente</label>
                                <select id="cliente_view" disabled class="form-select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Ingrese los correos separados por (,) para enviar el certificado de
                                    recepción</label>
                                <input class="form-control" disabled id="correos_view"
                                    placeholder="Correos electrónicos para enviar informe separados por coma (,)"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div id="div_reparaciones_view"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar recepción</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_recepcion_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente</label>
                                <select id="cliente_edit" class="form-select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Ingrese los correos separados por (,) para enviar el certificado de
                                    recepción</label>
                                <input class="form-control" id="correos_edit"
                                    placeholder="Correos electrónicos para enviar informe separados por coma (,)"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div id="div_reparaciones_edit"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificarRecepcion"
                            type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let empleados = @json($empleados);
            let clientes = @json($clientes);

            localStorage.setItem('empleados', JSON.stringify(empleados));
            localStorage.setItem('clientes', JSON.stringify(clientes));
        });
    </script>
    <script src="{{ asset('assets/js/app/viaticos/visitas.js') }}"></script>
@endsection
