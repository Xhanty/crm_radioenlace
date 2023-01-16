@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Categorias Calendario</a></li>
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
                            <h3 class="card-title mt-2">Lista de Categorías</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Registrar Categoría</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Nombre</th>
                                        <th class="wd-15p border-bottom-0">Color Texto</th>
                                        <th class="wd-15p border-bottom-0">Color Fondo</th>
                                        <th class="wd-20p border-bottom-0">Creada Por</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $value)
                                        <tr>
                                            <td>{{ $value->nombre }}</td>
                                            <td><input type="color" style="border: 0" disabled
                                                    value="{{ $value->color }}"></td>
                                            <td><input type="color" style="border: 0" disabled
                                                    value="{{ $value->bgColor }}"></td>
                                            <td>{{ $value->creador }}</td>
                                            <td><a data-id="{{ $value->id }}" title="Eliminar"
                                                    class="delete btn btn-danger btn-sm btn_Delete"><i
                                                        class="fa fa-trash"></i></a></td>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Registro de Categoría</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Nombre de Categoría</label>
                                <input class="form-control" id="categoriaadd" placeholder="Nombre de Categoría"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Color Texto</label>
                                <input class="form-control" style="border: 0; height: 50px" id="color_text_add"
                                    type="color">
                            </div>
                            <div class="col-lg">
                                <label for="">Color Fondo</label>
                                <input class="form-control" style="border: 0; height: 50px" id="color_fondo_add"
                                    type="color">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarCategoria" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/categorias_calendario.js') }}"></script>
@endsection
