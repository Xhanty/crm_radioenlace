<div class="modal  fade" id="modalModificarProducto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Producto</h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" disabled readonly id="producto_id_modificar">
                <input type="hidden" disabled readonly id="movimiento_producto_id_modificar">
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Proveedor (Opcional)</label>
                        <select id="proveedor_prodc_modif" class="form-select">
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
                        <input type="text" class="form-control" id="codigo_interno_prodc_modif">
                    </div>
                    <div class="col-lg">
                        <label for="">Serial</label>
                        <input type="text" class="form-control" id="serial_prodc_modif">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Precio Venta (Opcional)</label>
                        <input type="text" class="form-control" id="precioventa_prodc_modif">
                    </div>
                    <div class="col-lg">
                        <label for="">Precio Compra (Opcional)</label>
                        <input type="text" class="form-control" id="preciocompra_prodc_modif">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Observaciones (Opcional)</label>
                        <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacion_prodc_modif"
                            style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" id="btnModificarSerialProducto" type="button">Modificar</button>
            </div>
        </div>
    </div>
</div>
