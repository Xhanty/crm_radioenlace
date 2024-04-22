<div class="row row-sm d-none" id="div_param_comprobantes">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(180, 62%, 55%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2" id="param_cuenta_text">Tipos de comprobantes</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <div class="border">
                    <div class="bg-gray-300 nav-bg">
                        <nav class="nav nav-tabs">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabCont1">Tipos de comprobantes</a>
                        </nav>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane show active" id="tabCont1">
                            <div style="display: flex; justify-content: right;">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalAddComprobante">Adicionar tipo de comprobante</button>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="tbl_comprobantes"
                                    class="table border-top-0 table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Título</th>
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

<!-- Modal Add Tipos de comprobantes -->
<div class="modal fade" id="modalAddComprobante">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Adicionar Tipo de comprobante</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_add_comprobante" placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Título</label>
                        <input class="form-control" id="titulo_add_comprobante" placeholder="Título" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Numeración Automática</label>
                        <select id="numeracion_automatica_add_comprobante" class="form-select">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">¿Maneja centros de costo?</label>
                        <select id="centro_costo_add_comprobante" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Consecutivo</label>
                        <input class="form-control" id="consecutivo_add_comprobante" placeholder="Consecutivo"
                            type="number">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Comprobante aplica en libros oficiales</label>
                        <select id="libros_oficiales_add_comprobante" class="form-select">
                            <option value="0">Ninguno</option>
                            <option value="1">Libro ventas - Ventas</option>
                            <option value="2">Libro ventas - Devoluciones</option>
                            <option value="3">Libro compras - Compras</option>
                            <option value="4">Libro compras - Devoluciones</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Documento Soporte</label>
                        <select id="documento_soporte_add_comprobante" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">¿En uso?</label>
                        <select id="en_uso_add_comprobante" class="form-select">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnAddComprobante" type="button">Adicionar Tipo de
                    Comprobante</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Tipos de comprobantes -->
<div class="modal fade" id="modalEditComprobante">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Editar Tipo de comprobante</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" disabled readonly id="id_edit_comprobante">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_edit_comprobante" disabled placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Título</label>
                        <input class="form-control" id="titulo_edit_comprobante" placeholder="Título" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Numeración Automática</label>
                        <select id="numeracion_automatica_edit_comprobante" class="form-select">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">¿Maneja centros de costo?</label>
                        <select id="centro_costo_edit_comprobante" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Consecutivo</label>
                        <input class="form-control" id="consecutivo_edit_comprobante" placeholder="Consecutivo"
                            type="number">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Comprobante aplica en libros oficiales</label>
                        <select id="libros_oficiales_edit_comprobante" class="form-select">
                            <option value="0">Ninguno</option>
                            <option value="1">Libro ventas - Ventas</option>
                            <option value="2">Libro ventas - Devoluciones</option>
                            <option value="3">Libro compras - Compras</option>
                            <option value="4">Libro compras - Devoluciones</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Documento Soporte</label>
                        <select id="documento_soporte_edit_comprobante" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">¿En uso?</label>
                        <select id="en_uso_edit_comprobante" class="form-select">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnUpdateComprobante" type="button">Editar Tipo de
                    Comprobante</button>
            </div>
        </div>
    </div>
</div>
