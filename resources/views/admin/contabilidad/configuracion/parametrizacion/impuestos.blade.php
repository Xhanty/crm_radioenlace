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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddImpuesto">Adicionar Impuesto</button>
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddRetencion">Adicionar Autoretención</button>
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
                                            <th class="text-center">Tipo<br>Impuesto</th>
                                            <th class="text-center">Tarifa</th>
                                            <th class="text-center">Cuenta<br>Débito</th>
                                            <th class="text-center">Cuenta<br>Crédito</th>
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

<!-- Modal Add Impuesto -->
<div class="modal fade" id="modalAddImpuesto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Adicionar Impuesto</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_add_impuesto" placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Nombre</label>
                        <input class="form-control" id="nombre_add_impuesto" placeholder="Nombre" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tipo Impuesto</label>
                        <select id="tipo_add_impuesto" class="form-select">
                            <option value="">Selecciona una opción</option>
                            <option value="1">Iva</option>
                            <option value="2">ReteFuente</option>
                            <option value="3">ReteIva</option>
                            <option value="4">ReteIca</option>
                            <option value="5">Impoconsumo</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">¿Por Valor?</label>
                        <select id="por_valor_add_impuesto" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tarifa</label>
                        <input class="form-control" id="tarifa_add_impuesto" placeholder="Tarifa" type="number">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable (Ventas)</label>
                        <select id="ventas_add_impuesto" class="form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable (Compras)</label>
                        <select id="compras_add_impuesto" class="form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable (Devolución Ventas)</label>
                        <select id="dev_ventas_add_impuesto" class="form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable (Devolución Compras)</label>
                        <select id="dev_compras_add_impuesto" class="form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnAddImpuesto" type="button">Adicionar Impuesto</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Retención -->
<div class="modal fade" id="modalAddRetencion">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Adicionar Autorretención</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Código</label>
                        <input class="form-control" id="codigo_add_retencion" placeholder="Código" type="text">
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Nombre</label>
                        <input class="form-control" id="nombre_add_retencion" placeholder="Nombre" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tipo Impuesto</label>
                        <select id="tipo_add_retencion" class="form-select">
                            <option value="1">Autorretención</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Tarifa</label>
                        <input class="form-control" id="tarifa_add_retencion" placeholder="Tarifa" type="number">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable (Débito)</label>
                        <select id="debito_add_retencion" class="form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Cuenta Contable (Crédito)</label>
                        <select id="credito_add_retencion" class="form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cuentas_contables as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->code }} | {{ $cuenta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnAddRetencion" type="button">Adicionar Autorretención</button>
            </div>
        </div>
    </div>
</div>