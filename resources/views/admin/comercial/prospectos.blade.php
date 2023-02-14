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
                        <li class="breadcrumb-item active" aria-current="page"> Prospectos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Prospectos</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                Añadir Nuevo
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbl_data"
                                class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Tipo Cliente</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Celular</th>
                                        <th>Fecha<br>Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prospectos as $prospecto)
                                        <tr>
                                            <td>{{ $prospecto->tipo_cliente = $prospecto->tipo_cliente == 0 ? 'Posible Cliente' : 'Cliente Existente' }}
                                            </td>
                                            <td>{{ $prospecto->nombres }}</td>
                                            <td>{{ $prospecto->apellidos }}</td>
                                            <td>{{ $prospecto->email }}</td>
                                            <td>{{ $prospecto->celular }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($prospecto->created_at)) }}</td>
                                            <td>
                                                <a title="Ver" href="javascript:void(0);" data-id="{{ $prospecto->id }}"
                                                    class="btn btn-primary btn-sm btnView">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a title="Modificar" href="javascript:void(0);"
                                                    data-id="{{ $prospecto->id }}" class="btn btn-warning btn-sm btnEdit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Eliminar" href="javascript:void(0);"
                                                    data-id="{{ $prospecto->id }}" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a title="WhatsApp" href="javascript:void(0);"
                                                    data-id="{{ $prospecto->id }}" class="btn btn-success btn-sm btnWhatsapp">
                                                    <i class="fab fa-whatsapp"></i>
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
                        <h6 class="modal-title">Nuevo prospecto</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Cliente *</label>
                                <select class="form-select" id="tipocliente_add">
                                    <option value="">Seleccione una opción</option>
                                    <option value="0">Posible Cliente</option>
                                    <option value="1">Cliente Existente</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Empresa</label>
                                <input class="form-control" type="text" id="empresa_add" placeholder="Empresa">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nombres *</label>
                                <input class="form-control" type="text" id="nombres_add" placeholder="Nombres">
                            </div>
                            <div class="col-lg">
                                <label for="">Apellidos</label>
                                <input class="form-control" type="text" id="apellidos_add" placeholder="Apellidos">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Email</label>
                                <input class="form-control" type="email" id="email_add" placeholder="Email">
                            </div>
                            <div class="col-lg">
                                <label for="">Cargo</label>
                                <input class="form-control" type="text" id="cargo_add" placeholder="Cargo">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Celular</label>
                                <input class="form-control" type="text" id="celular_add" placeholder="Celular">
                            </div>
                            <div class="col-lg">
                                <label for="">Tel Fijo</label>
                                <input class="form-control" type="text" id="telfijo_add" placeholder="Tel Fijo">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Fecha Nacimiento</label>
                                <input class="form-control" type="date" id="fechanacimiento_add"
                                    placeholder="Fecha Nacimiento">
                            </div>
                            <div class="col-lg">
                                <label for="">Dirección</label>
                                <input class="form-control" type="text" id="direccion_add" placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Facebook</label>
                                <input class="form-control" type="text" id="facebook_add" placeholder="Facebook">
                            </div>
                            <div class="col-lg">
                                <label for="">WhatsApp</label>
                                <input class="form-control" type="text" id="whatsapp_add" placeholder="WhatsApp">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Instagram</label>
                                <input class="form-control" type="text" id="instagram_add" placeholder="Instagram">
                            </div>
                            <div class="col-lg">
                                <label for="">Referido</label>
                                <input class="form-control" type="text" id="referido_add" placeholder="Referido">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardar" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar prospecto</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_prospecto_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Cliente *</label>
                                <select class="form-select" id="tipocliente_edit">
                                    <option value="">Seleccione una opción</option>
                                    <option value="0">Posible Cliente</option>
                                    <option value="1">Cliente Existente</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Empresa</label>
                                <input class="form-control" type="text" id="empresa_edit" placeholder="Empresa">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nombres *</label>
                                <input class="form-control" type="text" id="nombres_edit" placeholder="Nombres">
                            </div>
                            <div class="col-lg">
                                <label for="">Apellidos</label>
                                <input class="form-control" type="text" id="apellidos_edit" placeholder="Apellidos">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Email</label>
                                <input class="form-control" type="email" id="email_edit" placeholder="Email">
                            </div>
                            <div class="col-lg">
                                <label for="">Cargo</label>
                                <input class="form-control" type="text" id="cargo_edit" placeholder="Cargo">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Celular</label>
                                <input class="form-control" type="text" id="celular_edit" placeholder="Celular">
                            </div>
                            <div class="col-lg">
                                <label for="">Tel Fijo</label>
                                <input class="form-control" type="text" id="telfijo_edit" placeholder="Tel Fijo">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Fecha Nacimiento</label>
                                <input class="form-control" type="date" id="fechanacimiento_edit"
                                    placeholder="Fecha Nacimiento">
                            </div>
                            <div class="col-lg">
                                <label for="">Dirección</label>
                                <input class="form-control" type="text" id="direccion_edit" placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Facebook</label>
                                <input class="form-control" type="text" id="facebook_edit" placeholder="Facebook">
                            </div>
                            <div class="col-lg">
                                <label for="">WhatsApp</label>
                                <input class="form-control" type="text" id="whatsapp_edit" placeholder="WhatsApp">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Instagram</label>
                                <input class="form-control" type="text" id="instagram_edit" placeholder="Instagram">
                            </div>
                            <div class="col-lg">
                                <label for="">Referido</label>
                                <input class="form-control" type="text" id="referido_edit" placeholder="Referido">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificar" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver prospecto</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tipo Cliente *</label>
                                <select class="form-select" id="tipocliente_view" disabled>
                                    <option value="">Seleccione una opción</option>
                                    <option value="0">Posible Cliente</option>
                                    <option value="1">Cliente Existente</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Empresa</label>
                                <input class="form-control" type="text" id="empresa_view" disabled placeholder="Empresa">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nombres *</label>
                                <input class="form-control" type="text" id="nombres_view" disabled placeholder="Nombres">
                            </div>
                            <div class="col-lg">
                                <label for="">Apellidos</label>
                                <input class="form-control" type="text" id="apellidos_view" disabled placeholder="Apellidos">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Email</label>
                                <input class="form-control" type="email" id="email_view" disabled placeholder="Email">
                            </div>
                            <div class="col-lg">
                                <label for="">Cargo</label>
                                <input class="form-control" type="text" id="cargo_view" disabled placeholder="Cargo">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Celular</label>
                                <input class="form-control" type="text" id="celular_view" disabled placeholder="Celular">
                            </div>
                            <div class="col-lg">
                                <label for="">Tel Fijo</label>
                                <input class="form-control" type="text" id="telfijo_view" disabled placeholder="Tel Fijo">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Fecha Nacimiento</label>
                                <input class="form-control" type="date" id="fechanacimiento_view" disabled
                                    placeholder="Fecha Nacimiento">
                            </div>
                            <div class="col-lg">
                                <label for="">Dirección</label>
                                <input class="form-control" type="text" id="direccion_view" disabled placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Facebook</label>
                                <input class="form-control" type="text" id="facebook_view" disabled placeholder="Facebook">
                            </div>
                            <div class="col-lg">
                                <label for="">WhatsApp</label>
                                <input class="form-control" type="text" id="whatsapp_view" disabled placeholder="WhatsApp">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Instagram</label>
                                <input class="form-control" type="text" id="instagram_view" disabled placeholder="Instagram">
                            </div>
                            <div class="col-lg">
                                <label for="">Referido</label>
                                <input class="form-control" type="text" id="referido_view" disabled placeholder="Referido">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/comercial/prospectos.js') }}"></script>
@endsection
