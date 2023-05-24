<!-- row Edit -->
<div class="row row-sm d-none" id="div_tributos">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(212, 86%, 64%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Tributos</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_add_tributo" placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tributo</label>
                        <input class="form-control" id="nombre_add_tributo" placeholder="Tributo" type="text">
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn ripple btn-primary" id="btnAddTributo" type="button">Agregar
                        Tributo</button>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="tbl_tributos"
                        class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th style="width: 500px">Nombre</th>
                                <th>Creador</th>
                                <th>Fecha</th>
                                <th>Status</th>
                                <th class="text-center">Acciones</th>
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

<!-- Modal -->
<div class="modal fade" id="modalEditTributo">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Tributo</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit_tributo" disabled readonly>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_edit_tributo" placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tributo</label>
                        <input class="form-control" id="nombre_edit_tributo" placeholder="Tributo" type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnEditTributo" type="button">Actualizar Tributo</button>
            </div>
        </div>
    </div>
</div>
