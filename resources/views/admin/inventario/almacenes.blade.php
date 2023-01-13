@extends('layouts.menu')

@section('css')
    <style>
        .btn-flotante {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            border-radius: 5px;
            letter-spacing: 2px;
            background-color: #3858F9;
            padding: 18px 30px;
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .btn-flotante:hover {
            background-color: #3858F9;
            color: #ffffff;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-7px);
        }

        @media only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 14px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
            }
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
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            SEDE PRINCIPAL
                        </div>
                        <p class="mg-b-10"></p>
                        <div class="row">
                            <!-- col -->
                            <div class="col-auto mt-4 mt-lg-0">
                                <ul id="tree1">
                                    @foreach ($almacenes_sede as $sede)
                                        <li><a href="javascript:void(0);">{{ $sede->nombre }}</a>
                                            &nbsp;
                                            <a href="javascript:void(0);" class="btn_Edit" data-nombre="{{ $sede->nombre }}"
                                                data-observaciones="{{ $sede->observaciones }}" data-nivel="1"
                                                data-id="{{ $sede->id }}" title="Editar"><i
                                                    class="fa fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0);" class="btn_Delete" data-cliente="0" data-nivel="1"
                                                data-id="{{ $sede->id }}" title="Eliminar"><i
                                                    class="fa fa-trash"></i></a>
                                            @foreach ($sede->almacenes as $almacen)
                                                <ul>
                                                    <li style="cursor: pointer;">
                                                        {{ $almacen->nombre }}
                                                        &nbsp;
                                                        <a href="javascript:void(0);" class="btn_Edit"
                                                            data-nombre="{{ $almacen->nombre }}" data-nivel="2"
                                                            data-observaciones="{{ $almacen->observaciones }}"
                                                            data-id="{{ $almacen->id }}" title="Editar"><i
                                                                class="fa fa-pencil-alt"></i></a>
                                                        <a href="javascript:void(0);" class="btn_Delete" data-cliente="0"
                                                            data-nivel="2" data-id="{{ $almacen->id }}" title="Eliminar"><i
                                                                class="fa fa-trash"></i></a>
                                                        @if (count($almacen->estantes) > 0)
                                                            <ul>
                                                                @foreach ($almacen->estantes as $estante)
                                                                    <li style="cursor: pointer;" data-bs-placement="right"
                                                                        data-bs-toggle="tooltip-primary" title=""
                                                                        data-bs-original-title="{{ $estante->observaciones }}">
                                                                        {{ $estante->nombre }} &nbsp;
                                                                        <a href="javascript:void(0);" class="btn_Edit"
                                                                            data-nombre="{{ $estante->nombre }}"
                                                                            data-observaciones="{{ $estante->observaciones }}"
                                                                            data-nivel="3" data-id="{{ $estante->id }}"
                                                                            title="Editar"><i
                                                                                class="fa fa-pencil-alt"></i></a>
                                                                        <a href="javascript:void(0);" class="btn_Delete"
                                                                            data-cliente="0" data-nivel="3"
                                                                            data-id="{{ $estante->id }}"
                                                                            title="Eliminar"><i class="fa fa-trash"></i></a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                </ul>
                                            @endforeach
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5 d-flex">
                            CLIENTES
                        </div>
                        <p class="mg-b-10"></p>
                        <div class="row">
                            <!-- col -->
                            <div class="col-lg-auto mt-4 mt-lg-0">
                                <ul id="tree2">
                                    @foreach ($clientes as $cliente)
                                        <li><a href="javascript:void(0);">{{ $cliente->razon_social }}</a>
                                            @foreach ($cliente->almacenes as $almacen)
                                                <ul>
                                                    <li style="cursor: pointer;">
                                                        {{ $almacen->nombre }}
                                                        &nbsp;
                                                        <a href="javascript:void(0);" class="btn_Edit_Cliente"
                                                            data-nombre="{{ $almacen->nombre }}" data-nivel="1"
                                                            data-observaciones="{{ $almacen->observaciones }}"
                                                            data-id="{{ $almacen->id }}" title="Editar"><i
                                                                class="fa fa-pencil-alt"></i></a>
                                                        <a href="javascript:void(0);" class="btn_Delete" data-nivel="1"
                                                            data-cliente="1" data-id="{{ $almacen->id }}"
                                                            title="Eliminar"><i class="fa fa-trash"></i></a></a>
                                                        @if (count($almacen->estantes) > 0)
                                                            <ul>
                                                                @foreach ($almacen->estantes as $estante)
                                                                    <li style="cursor: pointer;" data-bs-placement="right"
                                                                        data-bs-toggle="tooltip-primary" title=""
                                                                        data-bs-original-title="{{ $estante->observaciones }}">
                                                                        {{ $estante->nombre }}
                                                                        <a href="javascript:void(0);"
                                                                            class="btn_Edit_Cliente"
                                                                            data-nombre="{{ $estante->nombre }}"
                                                                            data-observaciones="{{ $estante->observaciones }}"
                                                                            data-nivel="2" data-id="{{ $estante->id }}"
                                                                            title="Editar"><i
                                                                                class="fa fa-pencil-alt"></i></a>
                                                                        <a href="javascript:void(0);" class="btn_Delete"
                                                                            data-nivel="2" data-cliente="1"
                                                                            data-id="{{ $estante->id }}"
                                                                            title="Eliminar"><i
                                                                                class="fa fa-trash"></i></a></a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                </ul>
                                            @endforeach
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
                        <h6 class="modal-title">Registro de Almacén</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Ubicación</label>
                                <select id="general_add" class="form-select">
                                    <option value="1">Sede Principal</option>
                                    <option value="2">Cliente</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Nivel de ingreso</label>
                                <select id="nivel_ingreso_add" class="form-select">
                                    <option value="1">Nivel 1</option>
                                    <option value="2">Nivel 2</option>
                                    <option value="3">Nivel 3</option>
                                </select>
                            </div>
                            <div class="col-lg d-none">
                                <label for="">Cliente</label>
                                <select id="cliente_add" class="form-select">
                                    @foreach ($clientes_all as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row row-sm d-none mt-3">
                            <div class="col-lg d-none">
                                <label for="">Seleccione el nivel 1</label>
                                <select id="nivel_uno_add" class="form-select">
                                    @foreach ($almacenes_sede as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg d-none">
                                <label for="">Seleccione el nivel 2</label>
                                <select id="nivel_dos_add" class="form-select">
                                    <option value="1">Nivel 1</option>
                                </select>
                            </div>
                        </div>
                        <br>
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
                        <input type="hidden" disabled readonly id="cliente_almacen_edit">
                        <input type="hidden" disabled readonly id="nivel_almacen_edit">
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

        <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalAdd" data-bs-toggle="modal"
            data-bs-effect="effect-scale">Agregar Almacén</a>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/almacenes.js') }}"></script>
    <script src="{{ asset('assets/plugins/treeview/treeview.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip.js') }}"></script>
@endsection
