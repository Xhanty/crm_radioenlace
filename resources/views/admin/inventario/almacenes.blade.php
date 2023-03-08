@extends('layouts.menu')

@section('css')
    <style>
        #tree1 {
            text-align: left;
        }

        #tree1 li {
            text-align: left;
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
                        <li class="breadcrumb-item active" aria-current="page"> Almacenes</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-end">
                        <a href="javascript:void(0);" class="btn_AgregarAlmacen" title="Agregar Almacén"><i
                                class="fa fa-plus"></i></a>
                        <div class="row">
                            <!-- col -->
                            <div class="col-auto mt-4 mt-lg-0">
                                <ul id="tree1">
                                    @foreach ($almacenes as $key => $almacen)
                                        <li><a href="javascript:void(0);">{{ $almacen->nombre }}</a>
                                            &nbsp;
                                            <a href="javascript:void(0);" class="btn_ViewProducts"
                                                data-nombre="{{ $almacen->nombre }}" data-id="{{ $almacen->id }}"
                                                title="Ver Productos">
                                                <i class="fe fe-package"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn_AddNivel" data-id="{{ $almacen->id }}"
                                                title="Agregar">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn_Edit"
                                                data-nombre="{{ $almacen->nombre }}"
                                                data-observaciones="{{ $almacen->observaciones }}"
                                                data-id="{{ $almacen->id }}" title="Editar">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn_Delete" data-id="{{ $almacen->id }}"
                                                title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @if (count($almacen->almacenes) > 0)
                                                <ul>
                                                    @foreach ($almacen->almacenes as $sub2)
                                                        <li style="cursor: pointer">{{ $sub2->nombre }}
                                                            &nbsp;
                                                            <a href="javascript:void(0);" class="btn_ViewProducts"
                                                                data-nombre="{{ $sub2->nombre }}"
                                                                data-id="{{ $sub2->id }}" title="Ver Productos">
                                                                <i class="fe fe-package"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn_AddNivel"
                                                                data-id="{{ $sub2->id }}" title="Agregar">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn_Edit"
                                                                data-nombre="{{ $sub2->nombre }}"
                                                                data-observaciones="{{ $sub2->observaciones }}"
                                                                data-id="{{ $sub2->id }}" title="Editar">
                                                                <i class="fa fa-pencil-alt"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn_Delete"
                                                                data-id="{{ $sub2->id }}" title="Eliminar">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            @if (count($sub2->almacenes) > 0)
                                                                <ul>
                                                                    @foreach ($sub2->almacenes as $sub3)
                                                                        <li style="cursor: pointer">{{ $sub3->nombre }}
                                                                            &nbsp;
                                                                            <a href="javascript:void(0);"
                                                                                class="btn_ViewProducts"
                                                                                data-nombre="{{ $sub3->nombre }}"
                                                                                data-id="{{ $sub3->id }}"
                                                                                title="Ver Productos">
                                                                                <i class="fe fe-package"></i>
                                                                            </a>
                                                                            <a href="javascript:void(0);"
                                                                                class="btn_AddNivel"
                                                                                data-id="{{ $sub3->id }}"
                                                                                title="Agregar">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="javascript:void(0);" class="btn_Edit"
                                                                                data-nombre="{{ $sub3->nombre }}"
                                                                                data-observaciones="{{ $sub3->observaciones }}"
                                                                                data-id="{{ $sub3->id }}"
                                                                                title="Editar">
                                                                                <i class="fa fa-pencil-alt"></i>
                                                                            </a>
                                                                            <a href="javascript:void(0);" class="btn_Delete"
                                                                                data-id="{{ $sub3->id }}"
                                                                                title="Eliminar">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                            @if (count($sub3->almacenes) > 0)
                                                                                <ul>
                                                                                    @foreach ($sub3->almacenes as $sub4)
                                                                                        <li style="cursor: pointer">
                                                                                            {{ $sub4->nombre }}
                                                                                            &nbsp;
                                                                                            <a href="javascript:void(0);"
                                                                                                data-nombre="{{ $sub4->nombre }}"
                                                                                                class="btn_ViewProducts"
                                                                                                data-id="{{ $sub4->id }}"
                                                                                                title="Ver Productos">
                                                                                                <i
                                                                                                    class="fe fe-package"></i>
                                                                                            </a>
                                                                                            <a href="javascript:void(0);"
                                                                                                class="btn_AddNivel"
                                                                                                data-id="{{ $sub4->id }}"
                                                                                                title="Agregar">
                                                                                                <i class="fa fa-plus"></i>
                                                                                            </a>
                                                                                            <a href="javascript:void(0);"
                                                                                                class="btn_Edit"
                                                                                                data-nombre="{{ $sub4->nombre }}"
                                                                                                data-observaciones="{{ $sub4->observaciones }}"
                                                                                                data-id="{{ $sub4->id }}"
                                                                                                title="Editar">
                                                                                                <i
                                                                                                    class="fa fa-pencil-alt"></i>
                                                                                            </a>
                                                                                            <a href="javascript:void(0);"
                                                                                                class="btn_Delete"
                                                                                                data-id="{{ $sub4->id }}"
                                                                                                title="Eliminar">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </a>
                                                                                            @if (count($sub4->almacenes) > 0)
                                                                                                <ul>
                                                                                                    @foreach ($sub4->almacenes as $sub5)
                                                                                                        <li
                                                                                                            style="cursor: pointer">
                                                                                                            {{ $sub5->nombre }}
                                                                                                            &nbsp;
                                                                                                            <a href="javascript:void(0);"
                                                                                                                data-nombre="{{ $sub5->nombre }}"
                                                                                                                class="btn_ViewProducts"
                                                                                                                data-id="{{ $sub5->id }}"
                                                                                                                title="Ver Productos">
                                                                                                                <i
                                                                                                                    class="fe fe-package"></i>
                                                                                                            </a>
                                                                                                            <a href="javascript:void(0);"
                                                                                                                class="btn_AddNivel"
                                                                                                                data-id="{{ $sub5->id }}"
                                                                                                                title="Agregar">
                                                                                                                <i
                                                                                                                    class="fa fa-plus"></i>
                                                                                                            </a>
                                                                                                            <a href="javascript:void(0);"
                                                                                                                class="btn_Edit"
                                                                                                                data-nombre="{{ $sub5->nombre }}"
                                                                                                                data-observaciones="{{ $sub5->observaciones }}"
                                                                                                                data-id="{{ $sub5->id }}"
                                                                                                                title="Editar">
                                                                                                                <i
                                                                                                                    class="fa fa-pencil-alt"></i>
                                                                                                            </a>
                                                                                                            <a href="javascript:void(0);"
                                                                                                                class="btn_Delete"
                                                                                                                data-id="{{ $sub5->id }}"
                                                                                                                title="Eliminar">
                                                                                                                <i
                                                                                                                    class="fa fa-trash"></i>
                                                                                                            </a>
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /col -->
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
                        <h6 class="modal-title">Agregar Almacén</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="parent_add">
                        <input type="hidden" disabled readonly id="nivel_almacen_add">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Nombre de Almacén</label>
                                <input class="form-control" id="almacenadd" placeholder="Nombre de Almacén"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Observaciones (Opcional)</label>
                                <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_add"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarAlmacen" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Almacén</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_almacen_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Nombre de Almacén</label>
                                <input class="form-control" id="almacenedit" placeholder="Nombre de Almacén"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Observaciones (Opcional)</label>
                                <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_edit"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificarAlmacen" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal  fade" id="modalViewProduct">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver Productos</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_almacen_view">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Almacén</label>
                                <input class="form-control" id="almacenview" readonly placeholder="Almacén"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t"
                                id="tbl_seriales_view">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 80px"></th>
                                        <th class="border-bottom-0">Código<br>Interno</th>
                                        <th class="border-bottom-0">Producto</th>
                                        <th class="border-bottom-0">Serial</th>
                                        <th class="border-bottom-0">Disponible</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0 text-center">Acciones</th>
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/almacenes.js') }}"></script>
    <script src="{{ asset('assets/plugins/treeview/treeview.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip.js') }}"></script>
@endsection
