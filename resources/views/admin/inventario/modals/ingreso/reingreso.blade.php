<div class="modal  fade" id="modalReingreso">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="title_prodc_reingreso">Reingreso</h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img id="imagen_reingreso" src="{{ asset('images/productos/noimagen.png') }}"
                        style="width: 150px; height: 150px;" loading="lazy">
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Serial</label>
                        <select id="producto_reingreso" class="form-select">
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Cantidad</label>
                        <input type="number" min="1" step="1" class="form-control" id="cantidad_reingreso">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Observaciones (Opcional)</label>
                        <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_reingreso"
                            style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnReIngresoProducto" type="button">Guardar</button>
            </div>
        </div>
    </div>
</div>
