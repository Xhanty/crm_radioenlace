@extends('layouts.menu')

@section('css')
    <style>
        tr td:nth-child(1) {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Productos</li>
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
                            <h3 class="card-title mt-2">Lista de Productos</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Crear Producto</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                                id="table_productos_img">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Imagen</th>
                                        <th class="border-bottom-0">Cod Producto</th>
                                        <th class="border-bottom-0">Nombre</th>
                                        <th class="border-bottom-0">Categoría</th>
                                        <th class="border-bottom-0">SubCategoría</th>
                                        <th class="border-bottom-0">Marca</th>
                                        <th class="border-bottom-0">Modelo</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

    <!-- Modal Add -->
    <div class="modal  fade" id="modalAdd">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Registro de Producto</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Código Producto</label>
                            <input class="form-control" id="codigoadd" disabled placeholder="Código" type="text">
                        </div>
                        <div class="col-lg mg-lg-t-0">
                            <label for="">Marca</label>
                            <input class="form-control" id="marcadd" placeholder="Marca" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Categoría</label>
                            <select id="categoriaadd" class="form-select">
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option data-options='{{ $categoria->subcategorias }}' value="{{ $categoria->id }}">
                                        {{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">SubCategoría</label>
                            <select id="subcategoriaadd" class="form-select">
                                <option value="">Seleccione una subcategoría</option>
                            </select>
                        </div>

                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Modelo</label>
                            <input class="form-control" id="modeloadd" placeholder="Modelo" type="text">
                        </div>
                        <div class="col-lg mg-lg-t-0">
                            <label for="">Nombre</label>
                            <input class="form-control" id="nombreadd" placeholder="Nombre" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">

                        <div class="col-lg mg-lg-t-0">
                            <label for="">Foto</label>
                            <input class="form-control" id="fotoadd" type="file" accept="image/*">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacionesadd"
                                style="height: 90px; resize: none"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnGuardarProducto" type="button">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal  fade" id="modalEdit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Modificar Producto</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img id="imagenedit" src="{{ asset('images/vehiculos/18876865131801587359.png') }}"
                            style="width: 222px" loading="lazy">
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Código Producto</label>
                            <input type="hidden" id="id_producto" disabled readonly>
                            <input class="form-control" disabled id="codigoedit" placeholder="Código" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Marca</label>
                            <input class="form-control" id="marcaedit" placeholder="Marca" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Categoría</label>
                            <select id="categoriaedit" class="form-select">
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option data-options="{{ $categoria->subcategorias }}" value="{{ $categoria->id }}">
                                        {{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">SubCategoría</label>
                            <select id="subcategoriaedit" class="form-select">
                                <option value="">Seleccione una subcategoría</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Modelo</label>
                            <input class="form-control" id="modeloedit" placeholder="Modelo" type="text">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Nombre</label>
                            <input class="form-control" id="nombreedit" placeholder="Nombre" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Foto</label>
                            <input class="form-control" id="fotoedit" type="file" accept="image/*">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacionesedit"
                                style="height: 90px; resize: none"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnEditarProducto" type="button">Modificar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/inventario.js') }}"></script>
@endsection
