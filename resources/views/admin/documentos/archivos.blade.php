@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Documentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Gestionar Documentos</li>
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
                            <h3 class="card-title mt-2">Lista de Documentos</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Agregar Documento</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-20p border-bottom-0">Creado Por</th>
                                        <th class="wd-15p border-bottom-0">Cliente</th>
                                        <th class="wd-15p border-bottom-0">Fecha</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anexos as $value)
                                        <tr>
                                            <td>{{ $value->creador }}</td>
                                            <td>{{ $value->cliente }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($value->fecha)) }}</td>
                                            <td><a title="Descargar"
                                                    href="https://formrad.com/radio_enlace/archivos_clientes/{{ $value->documento }}"
                                                    target="_BLANK" class="delete btn btn-primary btn-sm"><i
                                                        class="fa fa-download"></i></a>
                                                <a data-id="{{ $value->id }}" title="Eliminar"
                                                    class="delete btn btn-danger btn-sm btn_Delete"><i
                                                        class="fa fa-trash"></i></a>
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
                        <h6 class="modal-title">Agregar Documento</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente</label>
                                <select id="clienteadd" class="form-select">
                                    @foreach ($clientes as $value)
                                        <option value="{{ $value->id }}">{{ $value->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Categoría</label>
                                <select id="categoriaadd" class="form-select">
                                    @foreach ($categorias as $value)
                                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Documento</label>
                                <input type="file" id="documentoadd" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarArchivo" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/documentos/archivos.js') }}"></script>
@endsection
