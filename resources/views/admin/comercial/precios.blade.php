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
                        <li class="breadcrumb-item active" aria-current="page"> Precios Proveedores</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px;">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Precios Pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Solicitud Precios</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Proveedor</th>
                                        <th>Nit</th>
                                        <th>Fecha Creación</th>
                                        <th>Fecha Límite</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendientes as $pendiente)
                                        <tr>
                                            <td>{{ $pendiente->code }}</td>
                                            <td>{{ $pendiente->razon_social }}</td>
                                            <td>{{ $pendiente->nit }}-{{ $pendiente->codigo_verificacion }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pendiente->created_at)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pendiente->fecha_limite)) }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $pendiente->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm btnEdit"
                                                    data-id="{{ $pendiente->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnEmail"
                                                    data-id="{{ $pendiente->id }}">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDelete"
                                                    data-id="{{ $pendiente->id }}">
                                                    <i class="fa fa-trash"></i>
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
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px;">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Precios Completados</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Proveedor</th>
                                        <th>Nit</th>
                                        <th>Fecha Creación</th>
                                        <th>Fecha Límite</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aprobados as $aprobado)
                                        <tr>
                                            <td>{{ $aprobado->code }}</td>
                                            <td>{{ $aprobado->razon_social }}</td>
                                            <td>{{ $aprobado->nit }}-{{ $aprobado->codigo_verificacion }}</td>
                                            <td>{{ date('d-m-Y', strtotime($aprobado->created_at)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($aprobado->fecha_limite)) }}</td>
                                            <td>
                                                <a href="{{ route('precios_update') . '?token=' . $aprobado->code . '&id=' . $aprobado->id }}"
                                                    class="btn btn-primary btn-sm" target="_blank"
                                                    data-id="{{ $aprobado->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDelete"
                                                    data-id="{{ $aprobado->id }}">
                                                    <i class="fa fa-trash"></i>
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
                        <h6 class="modal-title">Solicitud Precios</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Proveedor</label>
                                <select class="form-select" id="proveedor_add">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Moneda</label>
                                <select class="form-select" id="moneda_add">
                                    <option value="">Seleccione una monda</option>
                                    <option value="COP">COP</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Fecha Límite</label>
                                <input class="form-control" type="date" id="fecha_add" placeholder="Fecha Límite">
                            </div>
                        </div>
                        <br>
                        <label for="">Productos</label>
                        <div class="row row-sm">
                            <div class="col-5">
                                <select class="form-select producto_add">
                                    <option value="">Seleccione un producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}
                                            ({{ $producto->modelo }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control cantidad_add" min="1" step="1"
                                    placeholder="Cantidad">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control nota_add" placeholder="Nota (Opcional)">
                            </div>
                            <div class="center-vertical col-1">
                                <a href="javascript:void(0)" id="new_row_producto"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_productos_add"></div>
                        <br>
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
                        <h6 class="modal-title">Ver Solicitud Precios</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Proveedor</label>
                                <select class="form-select" id="proveedor_view" disabled>
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Moneda</label>
                                <select class="form-select" id="moneda_view" disabled>
                                    <option value="">Seleccione una monda</option>
                                    <option value="COP">COP</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Fecha Límite</label>
                                <input class="form-control" disabled type="date" id="fecha_view" placeholder="Fecha Límite">
                            </div>
                        </div>
                        <br>
                        <label for="">Productos</label>
                        <div id="div_list_productos_view"></div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver Solicitud Precios</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_solicitud_edit" disabled readonly>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Proveedor</label>
                                <select class="form-select" id="proveedor_edit">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Moneda</label>
                                <select class="form-select" id="moneda_edit">
                                    <option value="">Seleccione una monda</option>
                                    <option value="COP">COP</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Fecha Límite</label>
                                <input class="form-control" type="date" id="fecha_edit" placeholder="Fecha Límite">
                            </div>
                        </div>
                        <br>
                        <label for="">Productos</label>
                        <div id="div_list_productos_edit"></div>
                        <br>
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
                        <h6 class="modal-title">Emails Proveedor</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_precio_email" disabled readonly>
                        <div class="row row-sm">
                            <label for="">Emails a enviar</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control emailadd" placeholder="Email" type="email">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_email"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_email"></div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnSendEmail" type="button">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var productos = @json($productos);
        var proveedores = @json($proveedores);

        localStorage.setItem('productos', JSON.stringify(productos));
    </script>
    <script src="{{ asset('assets/js/app/comercial/precios_proveedores.js') }}"></script>
@endsection
