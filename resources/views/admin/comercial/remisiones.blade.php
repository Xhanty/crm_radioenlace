@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Comercial</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Remisiones</li>
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
                            <h3 class="card-title mt-2">Remisiones Pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                    class="fas fa-plus"></i> Crear Remisión</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Cliente</th>
                                        <th>Asunto</th>
                                        <th>Fecha</th>
                                        <th>Cant. Productos</th>
                                        <th>Creado Por</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($remisiones_pendientes as $value)
                                        <tr>
                                            <td>{{ $value->code }}</td>
                                            <td>{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td>{{ $value->asunto }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>{{ $value->cantidad_productos }}</td>
                                            <td>{{ $value->creador }}</td>
                                            <td>
                                                <a title="Ver" href="javascript:void(0);" data-id="{{ $value->id }}"
                                                    class="btn btn-primary btn-sm btnView">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a title="Modificar" href="javascript:void(0);"
                                                    data-id="{{ $value->id }}" class="btn btn-warning btn-sm btnEdit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a title="Completar" href="javascript:void(0);"
                                                    data-id="{{ $value->id }}"
                                                    class="btn btn-success btn-sm btnCompletar">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a title="Eliminar" href="javascript:void(0);"
                                                    data-id="{{ $value->id }}" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a title="Imprimir" target="_BLANK"
                                                    href="{{ route('remisiones_print') }}?token={{ $value->id }}"
                                                    class="btn btn-warning btn-sm btnPrint">
                                                    <i class="fa fa-print"></i>
                                                </a>
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
                            <h3 class="card-title mt-2">Remisiones Completadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Cliente</th>
                                        <th>Asunto</th>
                                        <th>Fecha</th>
                                        <th>Cant. Productos</th>
                                        <th>Creado Por</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($remisiones_aprobadas as $value)
                                        <tr>
                                            <td>{{ $value->code }}</td>
                                            <td>{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td>{{ $value->asunto }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>{{ $value->cantidad_productos }}</td>
                                            <td>{{ $value->creador }}</td>
                                            <td>
                                                <a title="Ver" href="javascript:void(0);" data-id="{{ $value->id }}"
                                                    class="btn btn-primary btn-sm btnView">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a title="Modificar" href="javascript:void(0);"
                                                    data-id="{{ $value->id }}" class="btn btn-warning btn-sm btnEdit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a title="Enviar por correo" href="javascript:void(0);"
                                                    data-id="{{ $value->id }}" class="btn btn-success btn-sm btnEmail">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                                <a title="Eliminar" href="javascript:void(0);"
                                                    data-id="{{ $value->id }}" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a title="Imprimir" target="_BLANK"
                                                    href="{{ route('remisiones_print') }}?token={{ $value->id }}"
                                                    class="btn btn-warning btn-sm btnPrint">
                                                    <i class="fa fa-print"></i>
                                                </a>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Crear Remisión</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente *</label>
                                <select class="form-select" id="cliente_add">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Asunto *</label>
                                <input class="form-control" type="text" id="asunto_add" placeholder="Asunto">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nota (Opcional)</label>
                                <textarea class="form-control" placeholder="Nota (Opcional)" rows="3" id="descripcion_add"
                                    style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        Productos
                        <div class="row row-sm">
                            <div class="col-11">
                                <div class="d-flex mt-2">
                                    <div class="col-6" style="padding-left: 0;">
                                        <select title="Producto" class="form-select producto_add">
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">{{ $producto->nombre }}
                                                    ({{ $producto->marca }} - {{ $producto->modelo }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input title="Cantidad" class="form-control cantidad_add" type="number"
                                            min="1" step="1" placeholder="Cantidad">
                                    </div>
                                </div>
                                <div class="col-12" style="padding-left: 0;">
                                    <textarea title="Descripción" class="form-control mt-2 descripcion_add" placeholder="Descripción" rows="3"
                                        style="height: 70px; resize: none"></textarea>
                                </div>
                            </div>
                            <div class="col-1 d-flex">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_producto">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div id="div_list_productos"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardar" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver Remisión</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente *</label>
                                <select class="form-select" disabled id="cliente_view">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Asunto *</label>
                                <input class="form-control" id="asunto_view" disabled type="text"
                                    placeholder="Asunto">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nota (Opcional)</label>
                                <textarea class="form-control" placeholder="Nota (Opcional)" rows="3" disabled id="descripcion_view"
                                    style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        Productos
                        <div id="div_list_productos_view"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Remisión</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_remision_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente *</label>
                                <select class="form-select" id="cliente_edit">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Asunto *</label>
                                <input class="form-control" type="text" id="asunto_edit" placeholder="Asunto">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nota (Opcional)</label>
                                <textarea class="form-control" placeholder="Nota (Opcional)" rows="3" id="descripcion_edit"
                                    style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        Productos
                        <div id="div_list_productos_edit"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnUpdate" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Email -->
        <div class="modal  fade" id="modalEmail">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Enviar Cotización</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_remision_email">
                        <div class="row row-sm">
                            <label for="">Emails</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control emailadd" placeholder="Email" type="email">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_email"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_email"></div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btn_save_email" type="button">Enviar
                                Remisión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var productos = @json($productos);

            localStorage.setItem('productos', JSON.stringify(productos));
        });
    </script>
    <script src="{{ asset('assets/js/app/comercial/remision.js') }}"></script>
@endsection
