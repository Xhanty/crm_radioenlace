<!-- row Edit -->

<div class="row row-sm d-none" id="div_config_pucs">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(0, 78%, 62%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Cuentas Contables</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <!-- Options -->
                <div class="d-flex text-center" style="justify-content: end;">
                    <div class="col-lg-2 col-sm-12" style="margin-right: -12px;">
                        <select class="form-select" id="select_options_config_puc">
                            <option value="1">Habilitados</option>
                            <option value="2">Todos</option>
                        </select>
                    </div>
                </div>
                <br>
                <div id="puc_config_puc">
                    <table id="data_pucs_config_view" class="table border-top-0 table-bordered text-nowrap border-bottom"></table>
                </div>
                <div class="d-none" id="div_all_config_puc">
                    <table id="data_pucs_all_config_view" class="table border-top-0 table-bordered text-nowrap border-bottom"></table>
                </div>
                <br>
                <!-- Buttons -->
                <div class="row text-center">
                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                        <button class="btn btn-danger" id="btnDeshabilitarPucConfig">Deshabilitar PUC</button>
                        <button class="btn btn-success d-none" id="btnHabilitarPucConfig">Habilitar PUC</button>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddChildPucCliente">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Agregar Auxiliar</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_parent_puc_cliente" disabled readonly>
                <input type="hidden" id="tr_parent_puc_cliente" disabled readonly>
                <input type="hidden" id="id_child_puc_cliente" disabled readonly>
                <input type="hidden" id="code_parent_puc_cliente" disabled readonly>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">PUC</label>
                        <input class="form-control" id="puc_parent_puc_cliente" disabled placeholder="PUC"
                            type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="code_child_puc_cliente" placeholder="Código"
                            type="number" min="1" step="1">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Nombre</label>
                        <input class="form-control" id="nombre_child_puc_cliente" placeholder="Nombre"
                            type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnAddChildPucCliente" type="button">Agregar Auxiliar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditChildPucCliente">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Auxiliar</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit_child_puc_cliente" disabled readonly>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="code_edit_child_puc_cliente" placeholder="Código"
                            type="number" min="1" step="1">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Nombre</label>
                        <input class="form-control" id="nombre_edit_child_puc_cliente" placeholder="Nombre"
                            type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnEditChildPucCliente" type="button">Modificar Auxiliar</button>
            </div>
        </div>
    </div>
</div>