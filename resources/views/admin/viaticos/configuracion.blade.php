@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Viáticos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Configuración Viáticos</li>
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
                            <h3 class="card-title mt-2">Lista de valores</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Alimentación</th>
                                        <th class="wd-15p border-bottom-0">Valor</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($valores as $value)
                                        <tr>
                                            <td>{{ $value->nombre }}</td>
                                            <td>{{ $value->valor }}</td>
                                            <td>
                                                <a data-id="{{ $value->id }}" data-nombre="{{ $value->nombre }}"
                                                    data-valor="{{ $value->valor }}" title="Editar"
                                                    class="btn btn-primary btn-sm btn_Edit"><i
                                                        class="fa fa-pencil-alt"></i></a>
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

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Valor</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Alimentación</label>
                                <input class="form-control" id="nombreedit" placeholder="Alimentación" type="text" disabled>
                            </div>
                            <div class="col-lg">
                                <label for="">Valor</label>
                                <input class="form-control" id="valoredit" placeholder="Valor" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnEditar" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/viaticos/configuracion.js') }}"></script>
@endsection
