@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Proveedores</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm" id="div_list_proveedores">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Lista de Proveedores</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="btnNewProveedor">Registrar Proveedor</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Razón Social</th>
                                        <th>Contacto</th>
                                        <th>Celular</th>
                                        <th>E-Mail</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $item)
                                        <tr>
                                            <td><img src="{{ asset('images/proveedores/' . $item->avatar) }}"
                                                    alt="img" class="avatar avatar-md brround"></td>
                                            <td>{{ $item->razon_social }}</td>
                                            <td>{{ $item->contacto }}</td>
                                            <td>{{ $item->celular }}</td>
                                            <td>
                                                <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                            </td>
                                            <td>
                                                @if ($item->estado == 1)
                                                    <span class="badge bg-success side-badge">Activo</span>
                                                @else
                                                    <span class="badge bg-danger side-badge">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button data-id="{{ $item->id }}"
                                                    class="btn btn-primary btn-sm btnEditar" title="Editar"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                                <button data-id="{{ $item->id }}"
                                                    class="btn btn-danger btn-sm btnEliminar" title="Eliminar"><i
                                                        class="fa fa-trash"></i></button>
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

        <!-- row Add -->
        <div class="row row-sm" id="div_content_prov_add">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Agregar Proveedor</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="back_table_prov_add">&times;</button>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -18px;">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">NIT</label>
                                <input class="form-control" id="nit_add" placeholder="NIT" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Código Verificación</label>
                                <input class="form-control" id="codigo_add" placeholder="Código Verificación"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Razón Social</label>
                                <input class="form-control" id="razon_social_add" placeholder="Razón Social" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Dirección</label>
                                <input class="form-control" id="direccion_add" placeholder="Dirección" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Teléfono Fijo</label>
                                <input class="form-control" id="telefono_add" placeholder="Teléfono Fijo" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Celular</label>
                                <input class="form-control" id="celular_add" placeholder="Celular" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Contacto</label>
                                <input class="form-control" id="contacto_add" placeholder="Contacto" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">E-Mail</label>
                                <input class="form-control" id="email_add" placeholder="E-Mail" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">E-Mail Comercial</label>
                                <input class="form-control" id="email_comercial_add" placeholder="E-Mail Comercial"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Tipo Regimen</label>
                                <input class="form-control" id="tipo_regimen_add" placeholder="Tipo Regimen"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Ciudad</label>
                                <input class="form-control" id="ciudad_add" placeholder="Ciudad" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Observaciones</label>
                                <input class="form-control" id="observaciones_add" placeholder="Observaciones"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Logo/Avatar</label>
                                <input class="form-control" id="avataradd" type="file">
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btnAddProveedor" type="button">Agregar
                                Proveedor</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->

        <!-- row Edit -->
        <div class="row row-sm" id="div_content_prov_edit">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2" id="title_proveedor_edit"></h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="back_table_prov_edit">&times;</button>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -18px;">
                        <div class="d-flex justify-content-center">
                            <img id="img_proveedor_edit" class="avatar border rounded-circle"
                                style="width: 14pc; height: 14pc;"
                                src="{{ asset('images/clientes/noavatar.png') }}">
                        </div>
                        <br>
                        <input type="hidden" readonly disabled id="id_proveedor_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">NIT</label>
                                <input class="form-control" id="nit_edit" placeholder="NIT" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Código Verificación</label>
                                <input class="form-control" id="codigo_edit" placeholder="Código Verificación"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Razón Social</label>
                                <input class="form-control" id="razon_social_edit" placeholder="Razón Social"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Dirección</label>
                                <input class="form-control" id="direccion_edit" placeholder="Dirección" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Teléfono Fijo</label>
                                <input class="form-control" id="telefono_edit" placeholder="Teléfono Fijo"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Celular</label>
                                <input class="form-control" id="celular_edit" placeholder="Celular" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Contacto</label>
                                <input class="form-control" id="contacto_edit" placeholder="Contacto" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">E-Mail</label>
                                <input class="form-control" id="email_edit" placeholder="E-Mail" type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">E-Mail Comercial</label>
                                <input class="form-control" id="email_comercial_edit" placeholder="E-Mail Comercial"
                                    type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Tipo Regimen</label>
                                <input class="form-control" id="tipo_regimen_edit" placeholder="Tipo Regimen"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Ciudad</label>
                                <input class="form-control" id="ciudad_edit" placeholder="Ciudad" type="text">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Observaciones</label>
                                <input class="form-control" id="observaciones_edit" placeholder="Observaciones"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Logo/Avatar</label>
                                <input class="form-control" id="avataredit" type="file">
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btnEditProveedor" type="button">Modificar Proveedor</button>
                        </div>
                        <br>
                        <div class="d-flex justify-content-end">
                            <button class="btn ripple btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale" type="button">Agregar Anexo</button>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t"
                                id="tbl_anexos_proveedores" style="cursor: pointer">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Creado Por</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
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
                                <select id="tipodocumento_anexoadd" class="form-select">
                                    <option value="0">Camara de comercio</option>
                                    <option value="1">RUT</option>
                                    <option value="2">Cedula del representante Legal</option>
                                    <option value="3">Remisiones</option>
                                    <option value="4">Otros</option>
                                    <option value="5">Certificación Bancaria</option>
                                </select>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Documento</label>
                                <input class="form-control" id="archivo_anexoadd" type="file">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción</label>
                                <textarea class="form-control" placeholder="Descripción" rows="3" id="descripcion_anexoadd"
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
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/app/proveedores.js') }}"></script>
@endsection
