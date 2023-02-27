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
                        <li class="breadcrumb-item active" aria-current="page"> Prospectos Personas</li>
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
                            <h3 class="card-title mt-2">Prospectos Personas</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <a title="Exportar" class="btn btn-warning" href="{{ route('prospectos_bd_excel') }}"
                                target="_blank">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg/826px-Microsoft_Office_Excel_%282019%E2%80%93present%29.svg.png"
                                    alt="" width="21px">
                            </a>
                            &nbsp;
                            <a title="Importar" class="btn btn-danger" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#modalImport">
                                <img src="https://cdn-icons-png.flaticon.com/512/3616/3616929.png" alt=""
                                    width="21px">
                            </a>
                            &nbsp;
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
                                        <th>Tipo</th>
                                        <th>País</th>
                                        <th>Empresa</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Celular</th>
                                        <th>Fecha<br>Creación</th>
                                        <th>Status</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
                                <label for="">País *</label>
                                <select class="form-select" id="pais_add">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
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
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Logo/Avatar</label>
                                <input class="form-control" type="file" id="logo_add" accept="image/*">
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
                        <div class="d-flex justify-content-center">
                            <img id="imagen_edit" src="{{ asset('images/prospectos_personas/noavatar.png') }}"
                                style="width: 140px; height: 140px;" loading="lazy">
                        </div>
                        <br>
                        <input type="hidden" disabled readonly id="id_prospecto_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">País *</label>
                                <select class="form-select" id="pais_edit">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
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
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Logo/Avatar</label>
                                <input class="form-control" type="file" id="logo_edit" accept="image/*">
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
                        <div class="d-flex justify-content-center">
                            <img id="imagen_view" src="{{ asset('images/prospectos_personas/noavatar.png') }}"
                                style="width: 140px; height: 140px;" loading="lazy">
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">País *</label>
                                <select class="form-select" disabled id="pais_view">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
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
                                <input class="form-control" type="text" id="empresa_view" disabled
                                    placeholder="Empresa">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Nombres *</label>
                                <input class="form-control" type="text" id="nombres_view" disabled
                                    placeholder="Nombres">
                            </div>
                            <div class="col-lg">
                                <label for="">Apellidos</label>
                                <input class="form-control" type="text" id="apellidos_view" disabled
                                    placeholder="Apellidos">
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
                                <input class="form-control" type="text" id="celular_view" disabled
                                    placeholder="Celular">
                            </div>
                            <div class="col-lg">
                                <label for="">Tel Fijo</label>
                                <input class="form-control" type="text" id="telfijo_view" disabled
                                    placeholder="Tel Fijo">
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
                                <input class="form-control" type="text" id="direccion_view" disabled
                                    placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Facebook</label>
                                <input class="form-control" type="text" id="facebook_view" disabled
                                    placeholder="Facebook">
                            </div>
                            <div class="col-lg">
                                <label for="">WhatsApp</label>
                                <input class="form-control" type="text" id="whatsapp_view" disabled
                                    placeholder="WhatsApp">
                            </div>
                        </div>
                        <div class="row row-sm mt-3">
                            <div class="col-lg">
                                <label for="">Instagram</label>
                                <input class="form-control" type="text" id="instagram_view" disabled
                                    placeholder="Instagram">
                            </div>
                            <div class="col-lg">
                                <label for="">Referido</label>
                                <input class="form-control" type="text" id="referido_view" disabled
                                    placeholder="Referido">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal File -->
        <div class="modal  fade" id="modalImport">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Importar prospectos</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Archivo (.xlsx) *</label>
                                <input type="file" class="form-control" id="file_import" accept=".xlsx">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="text-center">
                            <a href="{{ route('prospectos_bd_plantilla') }}" target="_blank">Descargar plantilla</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnSubirArchivo" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/comercial/prospectos.js') }}"></script>
@endsection
