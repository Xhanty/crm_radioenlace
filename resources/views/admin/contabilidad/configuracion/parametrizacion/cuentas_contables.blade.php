<!-- row Edit -->
<div class="row row-sm d-none" id="div_param_cuentas">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(180, 62%, 55%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2" id="param_cuenta_text">Cuentas contables</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu_param_doc">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <input class="form-control" id="param_cuenta_val" type="hidden" disabled readonly>
                <input class="form-control" id="tipo_param_cuenta_val" type="hidden" disabled readonly>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Tipo Régimen</label>
                        <select class="form-select" id="regimen_param_cuenta">
                            <option value="">Seleccione un empleado</option>
                            @foreach ($tipos_regimenes as $regimen)
                                <option value="{{ $regimen->id }}">{{ $regimen->code }} | {{ $regimen->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable</label>
                        <select class="form-select" id="cuenta_param_cuenta">
                            <option value="">Seleccione un empleado</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Naturaleza</label>
                        <select class="form-select" id="naturaleza_param_cuenta">
                            <option value="">Seleccione un empleado</option>
                            <option value="1">Débito</option>
                            <option value="2">Crédito</option>
                        </select>
                    </div>
                </div>
                <br>
                <br>
                <div class="text-center">
                    <button class="btn ripple btn-primary" id="btnAddCuentaParam" type="button">Agregar Cuenta</button>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="tbl_cuentas_param"
                        class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                        <thead>
                            <tr>
                                <th>Código | Cuenta Contable</th>
                                <th>Naturaleza</th>
                                <th>Fecha</th>
                                <th>Creador</th>
                                <th>Status</th>
                                <th></th>
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
