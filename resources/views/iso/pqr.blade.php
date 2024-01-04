@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Gestión Calidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> PQRS</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de PQR</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Registrar PQR</button>
                            <a href="{{ route('pqr_excel') }}" class="btn btn-success" style="margin-right: 8px">Excel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Empresa</th>
                                        <th>Fecha</th>
                                        <th>Status</th>
                                        <th>Creado Por</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pqrs as $pqr)
                                        <tr>
                                            <td>{{ $pqr->codigo }}</td>
                                            <td>{{ $pqr->cliente }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pqr->created_at)) }}</td>
                                            <td>
                                                @if ($pqr->status == 0)
                                                    <span class="badge bg-warning side-badge">Pendiente</span>
                                                @elseif($pqr->status == 1)
                                                    <span class="badge bg-success side-badge">Finalizado</span>
                                                @else
                                                    <span class="badge bg-danger side-badge">Cancelado</span>
                                                @endif
                                            </td>
                                            <td>{{ $pqr->empleado }}</td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $pqr->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                @if ($pqr->status == 0)
                                                    <button title="Modificar" class="btn btn-warning btn-sm btnEdit"
                                                        data-id="{{ $pqr->id }}">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>
                                                @endif

                                                @if ($pqr->tratamiento && $pqr->evidencia && $pqr->seguimiento && $pqr->correcion && $pqr->status == 0)
                                                    <button title="Aprobar" class="btn btn-success btn-sm btnAprobar"
                                                        data-id="{{ $pqr->id }}">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button title="Cancelar" class="btn btn-secondary btn-sm btnCancelar"
                                                        data-id="{{ $pqr->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                @elseif($pqr->status == 0)
                                                    <button title="Cancelar" class="btn btn-secondary btn-sm btnCancelar"
                                                        data-id="{{ $pqr->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                @endif

                                                @if ($pqr->status == 0)
                                                    <button title="Borrar" class="btn btn-danger btn-sm btnDelete"
                                                        data-id="{{ $pqr->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <br>
                                                    <br>
                                                    <div style="display: grid; justify-content: center">
                                                        <a class="d-flex btnTratamiento" data-id="{{ $pqr->id }}"
                                                            href="javascript:void(0);"><i
                                                                class="fa fa-pencil-alt"></i>&nbsp;Tratamiento</a>
                                                        <a class="d-flex btnEvidencia" data-id="{{ $pqr->id }}"
                                                            href="javascript:void(0);"><i
                                                                class="fa fa-pencil-alt"></i>&nbsp;Evidencia</a>
                                                        <a class="d-flex btnSeguimiento" data-id="{{ $pqr->id }}"
                                                            href="javascript:void(0);"><i
                                                                class="fa fa-pencil-alt"></i>&nbsp;Seguimiento</a>
                                                        <a class="d-flex btnCorrecion" data-id="{{ $pqr->id }}"
                                                            href="javascript:void(0);"><i
                                                                class="fa fa-pencil-alt"></i>&nbsp;Correción</a>
                                                    </div>
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

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <label for="">Empresa</label>
                                <select disabled class="form-select" id="cliente_view">
                                    <option value="">Seleccione</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Mes</label>
                                <input disabled class="form-control" id="mes_view" placeholder="Mes" type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Medio de comunicación</label>
                                <input disabled class="form-control" id="medio_view" placeholder="Medio de comunicación"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Queja</label>
                                <textarea disabled class="form-control" id="queja_view" rows="5" placeholder="Queja"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tratamiento</label>
                                <textarea disabled class="form-control" id="tratamiento_view" rows="5" placeholder="Tratamiento"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Evidencia</label>
                                <textarea disabled class="form-control" id="evidencia_view" rows="5" placeholder="Evidencia"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Seguimiento</label>
                                <textarea disabled class="form-control" id="seguimiento_view" rows="5" placeholder="Seguimiento"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Correción</label>
                                <textarea disabled class="form-control" id="correcion_view" rows="5" placeholder="Correción"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Registro de PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <label for="">Empresa</label>
                                <select class="form-select" id="cliente_add">
                                    <option value="">Seleccione</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Mes</label>
                                <input class="form-control" id="mes_add" placeholder="Mes" type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Medio de comunicación</label>
                                <input class="form-control" id="medio_add" placeholder="Medio de comunicación"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Queja</label>
                                <textarea class="form-control" id="queja_add" rows="7" placeholder="Queja"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnGuardar" type="button">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled id="id_edit">
                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <label for="">Empresa</label>
                                <select class="form-select" id="cliente_edit">
                                    <option value="">Seleccione</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Mes</label>
                                <input class="form-control" id="mes_edit" placeholder="Mes" type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Medio de comunicación</label>
                                <input class="form-control" id="medio_edit" placeholder="Medio de comunicación"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Queja</label>
                                <textarea class="form-control" id="queja_edit" rows="7" placeholder="Queja"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnModificar" type="button">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tratamiento -->
        <div class="modal  fade" id="modalTratamiento">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Tratamiento PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled id="id_tratamiento">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Código PQR</label>
                                <input class="form-control" disabled id="codigo_tratamiento" placeholder="Código PQR"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tratamiento</label>
                                <textarea class="form-control" id="tratamiento_add" rows="7" placeholder="Tratamiento"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnModificarTratamiento" type="button">Modificar
                                Tratamiento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Evidencia -->
        <div class="modal  fade" id="modalEvidencia">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Evidencia PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled id="id_evidencia">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Código PQR</label>
                                <input class="form-control" disabled id="codigo_evidencia" placeholder="Código PQR"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Evidencia</label>
                                <textarea class="form-control" id="evidencia_add" rows="7" placeholder="Evidencia"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm" style="display: none">
                            <div class="col-lg">
                                <label for="">Adjunto (Opcional)</label>
                                <input class="form-control" id="adjunto_evidencia" type="file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnModificarEvidencia" type="button">Modificar
                                Evidencia</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Seguimiento -->
        <div class="modal  fade" id="modalSeguimiento">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Seguimiento PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled id="id_seguimiento">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Código PQR</label>
                                <input class="form-control" disabled id="codigo_seguimiento" placeholder="Código PQR"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Seguimiento</label>
                                <textarea class="form-control" id="seguimiento_add" rows="7" placeholder="Seguimiento"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnModificarSeguimiento" type="button">Modificar
                                Seguimiento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Correción -->
        <div class="modal  fade" id="modalCorrecion">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Correción PQR</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled id="id_correcion">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Código PQR</label>
                                <input class="form-control" disabled id="codigo_correcion" placeholder="Código PQR"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Correción</label>
                                <textarea class="form-control" id="correcion_add" rows="7" placeholder="Correción"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnModificarCorrecion" type="button">Modificar
                                Correción</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/iso/pqr.js') }}"></script>
@endsection
