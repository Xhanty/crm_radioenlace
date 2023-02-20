<!-- row Edit -->
<div class="row row-sm d-none" id="div_formas_pago">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Formas de pago</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body" style="margin-top: -18px;">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Forma de pago</label>
                        <input class="form-control" id="forma_pago_organizacion" placeholder="Forma de pago"
                            type="text">
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn ripple btn-primary" id="btnFormaPago" type="button">Agregar Nuevo</button>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="tbl_formas_pago" class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Creador</th>
                                <th>Status</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
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
