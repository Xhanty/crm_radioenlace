<!-- row Edit -->
<div class="row row-sm d-none" id="div_param_impuestos">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(180, 62%, 55%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2" id="param_cuenta_text">Impuestos</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <div class="border">
                    <div class="bg-gray-300 nav-bg">
                        <nav class="nav nav-tabs">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabCont1">Impuestos</a>
                            <a class="nav-link" data-bs-toggle="tab" href="#tabCont2">Autoretenciones</a>
                        </nav>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane show active" id="tabCont1">
                            <div style="display: flex; justify-content: right;">
                                <button class="btn btn-primary" id="btn_add_impuesto">Adicionar Impuesto</button>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="tbl_impuestos"
                                    class="table border-top-0 table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Tipo<br>Impuesto</th>
                                            <th class="text-center">Valor</th>
                                            <th class="text-center">Tarifa</th>
                                            <th class="text-center">Ventas</th>
                                            <th class="text-center">Compras</th>
                                            <th class="text-center">Devolución<br>Ventas</th>
                                            <th class="text-center">Devolución<br>Compras</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabCont2">
                            <div style="display: flex; justify-content: right;">
                                <button class="btn btn-primary" id="btn_add_retencion">Adicionar Autorretención</button>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="tbl_autoretenciones"
                                    class="table border-top-0 table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Tipo Impuesto</th>
                                            <th class="text-center">Tarifa</th>
                                            <th class="text-center">Cuenta Débito</th>
                                            <th class="text-center">Cuenta Crédito</th>
                                            <th class="text-center"></th>
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
    </div>
</div>

<!-- Modal -->
<!--<div class="modal fade" id="modalEditCentroCosto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Centro de Costo</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit_centrocosto" disabled readonly>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_edit_centrocosto" placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Actividad Económica</label>
                        <input class="form-control" id="tipo_regimen_edit_centrocosto" placeholder="Actividad Económica"
                            type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnEditCentroCosto" type="button">Actualizar Centro de
                    Costo</button>
            </div>
        </div>
    </div>
</div>-->
