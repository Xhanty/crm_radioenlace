<div class="modal  fade" id="modalVender">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="title_prodc_vender">Vender</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" disabled readonly id="producto_id_vender">
                <div class="d-flex justify-content-center">
                    <img id="imagen_vender" src="{{ asset('images/productos/noimagen.png') }}"
                        style="width: 150px; height: 150px;" loading="lazy">
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Cliente</label>
                        <select id="cliente_vender" class="form-select">
                            <option value="*">Seleccione una opción</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Serial</label>
                        <select id="serial_vender" class="form-select">
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Cantidad</label>
                        <input type="number" min="1" step="1" class="form-control" id="cantidad_vender">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Observaciones (Opcional)</label>
                        <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_vender"
                            style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnVenderProducto" type="button">Guardar</button>
            </div>
        </div>
    </div>
</div>
