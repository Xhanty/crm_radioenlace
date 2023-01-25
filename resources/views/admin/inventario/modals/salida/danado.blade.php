<div class="modal  fade" id="modalDanado">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="title_prodc_danado">Dañado</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" disabled readonly id="producto_id_danado">
                <div class="d-flex justify-content-center">
                    <img id="imagen_danado" src="{{ asset('images/productos/noimagen.png') }}"
                        style="width: 150px; height: 150px;" loading="lazy">
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Serial</label>
                        <select id="serial_danado" class="form-select">
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Cantidad</label>
                        <input type="number" min="1" step="1" class="form-control" id="cantidad_danado">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Observaciones (Opcional)</label>
                        <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_danado"
                            style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnDanadoProducto" type="button">Guardar</button>
            </div>
        </div>
    </div>
</div>
