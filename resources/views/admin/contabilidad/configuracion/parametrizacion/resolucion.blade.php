<!-- Modal Resolución Factura -->
<div class="modal  fade" id="modalResolucionAdd">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Resolución Factura Venta</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Número Resolución</label>
                        <input type="number" placeholder="0000" value="{{ $num_resoluc_fv }}" class="form-control" id="num_resoluc_venta_add">
                    </div>
                    <div class="col-lg">
                        <label for="">Fecha Vencimiento</label>
                        <input type="date" class="form-control" value="{{ $fecha_resoluc_fv }}" id="date_resoluc_venta_add">
                    </div>
                </div>
                <br>
                <div class="d-flex" style="justify-content: center;">
                    <button class="btn btn-primary mg-b-10" id="btnAddResolucionVenta">Adicionar Resolución</button>
                </div>
            </div>
        </div>
    </div>
</div>
