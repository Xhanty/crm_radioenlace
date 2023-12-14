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
                        <li class="breadcrumb-item active" aria-current="page"> Viáticos</li>
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
                            <h3 class="card-title mt-2">Lista de viáticos pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Registrar
                                Viático</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Visita</th>
                                        <th class="text-center">Encargado</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viaticos_pendientes as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->consecutivo }}</td>
                                            <td class="text-center">
                                                {{ $value->cs . ' - ' . $value->razon_social . ' (' . $value->destino . ')' }}
                                            </td>
                                            <td class="text-center">{{ $value->encargado }}</td>
                                            <td class="text-center">{{ number_format($value->valor, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($value->status == 0)
                                                    <span class="badge bg-warning side-badge">Pendiente</span>
                                                @elseif($value->status == 1)
                                                    <span class="badge bg-success side-badge">Aprobado</span>
                                                @else
                                                    <span class="badge bg-danger side-badge">Rechazado</span>
                                                @endif
                                            </td>
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
                                                <button title="Aceptar" class="btn btn-success btn-sm btnAceptar mt-1"
                                                    data-valor="{{ $value->valor }}" data-id="{{ $value->id }}" data-tercero="{{ $value->cretead_by }}">
                                                    <i class="fa fa-check"></i> Aceptar
                                                </button>
                                                <button title="Rechazar" class="btn btn-danger btn-sm btnRechazar mt-1"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-times"></i> Rechazar
                                                </button>
                                                <br>
                                                <button title="Eliminar" class="btn btn-danger btn-sm btnDelete mt-1"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </button>
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
                            <h3 class="card-title mt-2">Lista de viáticos completados</h3>
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
                                        <th class="text-center">Visita</th>
                                        <th class="text-center">Encargado</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viaticos_completados as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->consecutivo }}</td>
                                            <td class="text-center">
                                                {{ $value->cs . ' - ' . $value->razon_social . ' (' . $value->destino . ')' }}
                                            </td>
                                            <td class="text-center">{{ $value->encargado }}</td>
                                            <td class="text-center">{{ number_format($value->valor, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($value->status == 1)
                                                    <span class="badge bg-warning side-badge">Pendiente</span>
                                                @elseif($value->status == 2)
                                                    <span class="badge bg-danger side-badge">Rechazado</span>
                                                @elseif($value->status == 3)
                                                    <span class="badge bg-success side-badge">Legalizado</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                @if ($value->status == 1)
                                                    <button title="Legalizar" class="btn btn-success btn-sm btnLegalizar"
                                                        data-id="{{ $value->id }}">
                                                        <i class="fa fa-check"></i> Legalizar
                                                    </button>
                                                @endif
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

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar viático</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <label for="">Visita</label>
                            <select class="form-select" id="visita_id">
                                <option value="">Seleccione</option>
                                @foreach ($visitas_pendientes as $value)
                                    <option value="{{ $value->id }}">{{ $value->consecutivo }} -
                                        {{ $value->razon_social }} ({{ $value->destino }})</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">Alimentación</label>
                            <div class="col-lg" style="display: flex">
                                <select class="form-select alimentacionadd">
                                    <option value="">Seleccione</option>
                                    <option value="1">Desayuno</option>
                                    <option value="2">Almuerzo</option>
                                    <option value="3">Comida</option>
                                </select>
                                <input class="form-control valoralimentacionadd" placeholder="Valor" type="number"
                                    style="margin-left: 12px; margin-right: 12px">
                                <input class="form-control fechaalimentacionadd" placeholder="Fecha" type="date">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_alimentacion"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                            <div id="div_list_alimentacion"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Movilidad y estadía</label>
                            <div class="col-lg" style="display: flex">
                                <select class="form-select movilidadadd">
                                    <option value="">Seleccione</option>
                                    <option value="1">Peajes</option>
                                    <option value="2">Alojamiento</option>
                                    <option value="3">Combustible</option>
                                    <option value="4">Bestia</option>
                                    <option value="5">Taxi</option>
                                    <option value="6">Bus</option>
                                </select>
                                <input class="form-control idamovilidadadd" placeholder="Valor Ida" type="number"
                                    style="margin-left: 12px; margin-right: 12px">
                                <input class="form-control vueltamovilidadadd" placeholder="Valor Vuelta" type="number">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_movilidad"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                            <div id="div_list_movilidad"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Gastos adicionales</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control referenciagastosadd" placeholder="Referencia" type="text">
                                <input class="form-control valorgastosadd" placeholder="Valor" type="number"
                                    style="margin-left: 12px; margin-right: 12px">
                                <input class="form-control observaciongastosadd" placeholder="Observación"
                                    type="text">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_gastos"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                            <div id="div_list_gastos"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarViatico" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal fade" id="modalView">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver viático</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <label for="">Visita</label>
                            <select class="form-select" disabled id="visita_id_view">
                                <option value="">Seleccione</option>
                                @foreach ($visitas_pendientes as $value)
                                    <option value="{{ $value->id }}">{{ $value->consecutivo }} -
                                        {{ $value->razon_social }} ({{ $value->destino }})</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">Alimentación</label>
                            <div id="div_list_alimentacion_view"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Movilidad y estadía</label>
                            <div id="div_list_movilidad_view"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Gastos adicionales</label>
                            <div id="div_list_gastos_view"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar viático</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_edit">
                        <div class="row row-sm">
                            <label for="">Visita</label>
                            <select class="form-select" id="visita_id_edit">
                                <option value="">Seleccione</option>
                                @foreach ($visitas_pendientes as $value)
                                    <option value="{{ $value->id }}">{{ $value->consecutivo }} -
                                        {{ $value->razon_social }} ({{ $value->destino }})</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">Alimentación</label>
                            <div id="div_list_alimentacion_edit"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Movilidad y estadía</label>
                            <div id="div_list_movilidad_edit"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Gastos adicionales</label>
                            <div id="div_list_gastos_edit"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnEditViatico" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Aceptar -->
        <div class="modal  fade" id="modalAceptar">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Aceptar viático</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_aceptar">
                        <div class="row row-sm">
                            <div class="col">
                                <label for="">Tercero</label>
                                <select class="form-select" id="tercero_aceptar" disabled>
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" id="valor_aceptar" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">De donde sale el dinero</label>
                            <select class="form-select" id="formas_pago_aceptar">
                                <option value="">Seleccione una opción</option>
                                @foreach ($formas_pago as $forma_pago)
                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                        {{ $forma_pago->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnAceptarViatico" type="button">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Legalizar -->
        <div class="modal fade" id="modalLegalizar">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Legalizar viático</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_legalizar">
                        <div class="row row-sm">
                            <label for="">Visita</label>
                            <select class="form-select" disabled id="visita_id_legalizar">
                                <option value="">Seleccione</option>
                                @foreach ($visitas_pendientes as $value)
                                    <option value="{{ $value->id }}">{{ $value->consecutivo }} -
                                        {{ $value->razon_social }} ({{ $value->destino }})</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">Alimentación</label>
                            <div id="div_list_alimentacion_legalizar"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Movilidad y estadía</label>
                            <div id="div_list_movilidad_legalizar"></div>
                        </div>
                        <br>
                        <hr>
                        <div class="row row-sm">
                            <label for="">Gastos adicionales</label>
                            <div id="div_list_gastos_legalizar"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnLegalizarViatico" type="button">Legalizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //let empleados = /@ json($empleados);

            //localStorage.setItem('vehiculos', JSON.stringify(vehiculos));
        });
    </script>
    <script src="{{ asset('assets/js/app/viaticos/viaticos.js') }}"></script>
@endsection
