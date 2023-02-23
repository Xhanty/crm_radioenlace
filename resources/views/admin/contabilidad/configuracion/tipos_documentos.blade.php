<!-- row Edit -->
<div class="row row-sm d-none" id="div_tipos_documentos">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(34, 97%, 64%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Tipos Documentos</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tipo Documento</label>
                        <input class="form-control" id="tipo_documento_add_tipodoc" placeholder="Tipo Documento"
                            type="text">
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn ripple btn-primary" id="btnAddTipoDocumento" type="button">Agregar Tipo Documento</button>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="tbl_tipos_documentos" class="table border-top-0 table-bordered text-nowrap border-bottom">
                        <thead>
                            <tr>
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
<div class="modal fade" id="modalEditTipoDocumento">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Tipo de Documento</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit_tipodoc" disabled readonly>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tipo Documento</label>
                        <input class="form-control" id="tipo_documento_edit_tipodoc"
                            placeholder="Tipo Documento" type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnEditTipoDocumento" type="button">Actualizar Tipo Documento</button>
            </div>
        </div>
    </div>
</div>
