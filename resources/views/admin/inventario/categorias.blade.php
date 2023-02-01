@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Categorías</li>
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
                                        <th class="wd-20p border-bottom-0">Creada Por</th>
                                        <th class="wd-20p border-bottom-0">Nombre</th>
                                        <th class="wd-15p border-bottom-0">Subcategorías</th>
                                        <th class="wd-15p border-bottom-0">Productos Asociados</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $value)
                                        <tr>
                                            <td>{{ $value->creador }}</td>
                                            <td>{{ $value->nombre }}</td>
                                            <td>{{ $value->total_subs }}</td>
                                            <td>{{ $value->total_productos }}</td>
                                            <td>
                                                <a data-id="{{ $value->id }}" data-nombre="{{ $value->nombre }}"
                                                    title="Ver" class="view btn btn-primary btn-sm btn_View"><i
                                                        class="fa fa-eye"></i></a>
                                                <a data-id="{{ $value->id }}" data-nombre="{{ $value->nombre }}"
                                                    title="Editar" class="edit btn btn-primary btn-sm btn_Edit"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                                <a data-id="{{ $value->id }}"
                                                    data-productos="{{ $value->total_productos }}" title="Eliminar"
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
                            <label for="">SubCategorías</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control subcategoriaadd" placeholder="SubCategoría" type="text">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_row_subcategoria"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_subs"></div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarCategoria" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Categoría</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_categoria_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Nombre de Categoría</label>
                                <input class="form-control" id="categoriaedit" placeholder="Nombre de Categoría"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">SubCategorías</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control" id="subcategoriaedit_uno" disabled placeholder="SubCategoría"
                                    type="text">
                                <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                id="edit_row_subcategoria"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="div_list_subs_edit"></div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificarCategoria"
                            type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal  fade" id="modalShow">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver Categoría</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Nombre de Categoría</label>
                                <input class="form-control" disabled id="categoriashow" placeholder="Nombre de Categoría"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <label for="">SubCategorías</label>
                            <div class="col-lg" style="display: flex">
                                <input class="form-control subcategoriashow" disabled placeholder="SubCategoría"
                                    type="text">
                                <!--<a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                id="edit_row_subcategoria"><i class="fa fa-plus"></i></a>-->
                            </div>
                        </div>
                        <div id="div_list_subs_show"></div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/categorias.js') }}"></script>
@endsection
