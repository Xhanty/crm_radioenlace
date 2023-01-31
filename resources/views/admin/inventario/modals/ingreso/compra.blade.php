<div class="modal  fade" id="modalCompra">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="title_prodc_compra">Ingreso Compra</h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" disabled readonly id="producto_id_compra">
                <div class="d-flex justify-content-center">
                    <img id="imagen_compra" src="{{ asset('images/productos/noimagen.png') }}"
                        style="width: 150px; height: 150px;" loading="lazy">
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Serial Existente (Opcional)</label>
                        <select id="serialexistente_compra" class="form-select">
                            <option value="0">Ninguno</option>
                        </select>
                    </div>
                    <div class="col-lg">
                        <label for="">Proveedor (Opcional)</label>
                        <select id="proveedor_compra" class="form-select">
                            <option value="*">Seleccione una opción</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Código Interno</label>
                        <input type="text" class="form-control" id="codigo_interno_compra">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Serial</label>
                        <input type="text" class="form-control" id="serial_compra">
                    </div>
                    <div class="col-lg">
                        <label for="">Cantidad</label>
                        <input type="number" min="1" step="1" class="form-control" id="cantidad_compra">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Precio Venta (Opcional)</label>
                        <input type="text" class="form-control" id="precioventa_compra">
                    </div>
                    <div class="col-lg">
                        <label for="">Precio Compra (Opcional)</label>
                        <input type="text" class="form-control" id="preciocompra_compra">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Observaciones (Opcional)</label>
                        <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_compra"
                            style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnCompraProducto" type="button">Guardar</button>
            </div>
        </div>
    </div>
</div>
