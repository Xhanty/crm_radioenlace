$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".form-select").each(function () {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: "Seleccione",
            searchInputPlaceholder: "Buscar",
        });
    });

    var productos = JSON.parse(localStorage.getItem("productos"));
    var formas_pago = JSON.parse(localStorage.getItem("formas_pago"));
    var cuentas_gastos = JSON.parse(localStorage.getItem("cuentas_gastos"));

    $(".open-toggle").trigger("click");

    var contact_forma_pago = '<div class="row row-sm mt-2">' +
        '<div class="col-lg-6" >' +
        '<select class="form-select formas_pago_add">' +
        '<option value="">Seleccione una opción</option>' +
        formas_pago.map((item) => {
            return (
                '<option value="' +
                item.id +
                '">' +
                item.code +
                " | " +
                item.nombre +
                "</option>"
            );
        }) +
        '</select>' +
        '</div>' +
        '<div class="col-lg-2"></div>' +
        '<div class="col-lg-3 d-flex" style="justify-content: end">' +
        '<input type="text" placeholder="0.00"' +
        'class="form-control col-8 text-end input_dinner forma_pago_input_add">' +
        '</div>' +
        '<div class="col-lg-1 d-flex" style="justify-content: center">' +
        '<a class="center-vertical mg-s-10 delete_row_forma" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        '</div>' +
        '</div > ';

    $("#new_row").click(function () {
        $("#tbl_data_detail tbody").append(
            '<tr style="background: #f9f9f9;">' +
            '<td class="center-text pad-4">1</td>' +
            '<td class="pad-4">' +
            '<select class="form-select tipo_add">' +
            '<option value="">Seleccione una opción</option>' +
            '<option value="1">Producto</option>' +
            '<option value="2">Activo Fijo</option>' +
            '<option value="3">Gasto / Cuenta contable</option>' +
            '</select>' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select producto_add">' +
            '<option value="">Seleccione una opción</option>' +
            '</select>' +
            '</td>' +
            '<td class="pad-4">' +
            '<textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="2"></textarea>' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" placeholder="Bodega" class="form-control bodega_add" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="number" step="1" value="1" min="1" placeholder="Cantidad" class="form-control text-end cantidad_add" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" value="0.00" placeholder="Valor Unitario" class="form-control text-end valor_add input_dinner" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" value="0.00" placeholder="Descuento" class="form-control text-end descuento_add input_dinner" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select cargo_add">' +
            '<option value="">Seleccione una opción</option>' +
            '<option data-impuesto="19" value="1">IVA 19%</option>' +
            '<option data-impuesto="19" value="2">Iva Serv 19%</option>' +
            '<option data-impuesto="16" value="3">IVA 16%</option>' +
            '<option data-impuesto="5" value="4">IVA 5%</option>' +
            '<option data-impuesto="8" value="5">Impoconsumo 8%</option>' +
            '</select>' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select retencion_add">' +
            '<option value="">Seleccione una opción</option>' +
            '<option data-impuesto="11" value="1">Retefuente 11%</option>' +
            '<option data-impuesto="10" value="2">Retefuente 10%</option>' +
            '<option data-impuesto="7" value="3">Retefuente 7%</option>' +
            '<option data-impuesto="6" value="4">Retefuente 6%</option>' +
            '<option data-impuesto="5" value="5">Retención 5%</option>' +
            '<option data-impuesto="4" value="6">Retefuente 4%</option>' +
            '<option data-impuesto="4" value="8">Arriendos 4%</option>' +
            '<option data-impuesto="3.5" value="9">Arriendos 3.5%</option>' +
            '<option data-impuesto="3.5" value="10">Retefuente 3.5%</option>' +
            '<option data-impuesto="2.5" value="11">Retefuente 2.5%</option>' +
            '<option data-impuesto="2" value="12">Retefuente 2%</option>' +
            '<option data-impuesto="1" value="13">Retefuente 1%</option>' +
            '<option data-impuesto="0.4" value="14">Autoretención del cree 0.4%</option>' +
            '<option data-impuesto="0.1" value="15">Retefuente 0.1%</option>' +
            '</select>' +
            '</td>' +
            '<td class="text-center d-flex pad-4">' +
            '<input disabled type="text" placeholder="0.00" class="form-control text-end total_add input_dinner" style="border: 0">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>&nbsp;' +
            '</td>' +
            '</tr>'
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
            });
        });

        numero_filas();
    });

    $("#new_row_forma").click(function () {
        $("#list_formas_pago").append(contact_forma_pago);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $(document).on("click", ".delete_row", function () {
        $(this).parent().parent().remove();
        numero_filas();
    });

    $(document).on("click", ".delete_row_forma", function () {
        $(this).parent().parent().remove();
    });

    function numero_filas() {
        var num = 1;
        $("#tbl_data_detail tbody tr").each(function () {
            $(this).find("td:first").text(num);
            num++;
        });
    }

    $("#btnNew").click(function () {
        $("#div_general").addClass("d-none");
        $("#div_form_add").removeClass("d-none");
    });

    $(".back_home").click(function () {
        $("#div_general").removeClass("d-none");
        $("#div_form_add").addClass("d-none");
    });

    $("#proveedor_add").change(function () {
        var id = $(this).val();

        if (id != "") {
            $.ajax({
                url: "info_proveedor",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        $("#contacto_add").val(data.contacto);
                    } else {
                        toastr.error("Error al cargar los datos del proveedor");
                        $("#contacto_add").val("");
                    }
                },
                error: function (data) {
                    toastr.error("Error al cargar los datos del proveedor");
                    $("#contacto_add").val("");
                },
            });
        } else {
            toastr.error("Debe seleccionar un proveedor");
            $("#contacto_add").val("");
        }
    });

    $(document).on("keyup", ".input_dinner", function () {
        let v = $(this).val().replace(/\D+/g, '');
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v.replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, '$1.'));
    });

    $(document).on("change", ".tipo_add", function () {
        var value = $(this).val();

        if (value == 1) {
            $(this).parent().parent().find(".producto_add").empty();
            $(this).parent().parent().find(".producto_add").append(
                productos.map((item) => {
                    return (
                        '<option value="' +
                        item.id +
                        '">' +
                        item.nombre + " (" + item.marca + "-" + item.modelo + ")" +
                        "</option>"
                    );
                })
            );
        } else {
            $(this).parent().parent().find(".producto_add").empty();
            $(this).parent().parent().find(".producto_add").append(
                cuentas_gastos.map((item) => {
                    return (
                        '<option value="' +
                        item.id +
                        '">' +
                        item.code +
                        ' | ' +
                        item.nombre +
                        "</option>"
                    );
                })
            );
        }
    });

    $(document).on("click", ".factura_btn", function () {
        let id = $(this).data("id");
        $("#content_loader").removeClass("d-none");
        $("#content_factura").addClass("d-none");

        $(".factura_btn").removeClass("selected");
        $(this).addClass("selected");

        $.ajax({
            url: "info_factura_compra",
            type: "POST",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    let factura = response.factura;
                    let productos = factura.productos;

                    var fecha_compra = new Date(factura.fecha_elaboracion);
                    var fecha_vencimiento = new Date(factura.fecha_vencimiento);
                    $("#proveedor_view").html(factura.razon_social);
                    $("#nit_view").html(factura.nit + '-' + factura.codigo_verificacion + "<br>" + factura.telefono_fijo + "<br>" + factura.ciudad + ' - Colombia');

                    $("#num_fact_view").html(factura.numero);
                    $("#compra_view").html(fecha_compra.getDate() + "/" + (fecha_compra.getMonth() + 1) + "/" + fecha_compra.getFullYear());
                    $("#vencimiento_view").html(fecha_vencimiento.getDate() + "/" + (fecha_vencimiento.getMonth() + 1) + "/" + fecha_vencimiento.getFullYear());
                    $("#pagar_view").html(factura.valor_total);
                    $(".btn-primary").attr("href", "pdf_factura_compra?token=" + factura.id);

                    if (productos) {
                        $("#productos_view").empty();
                        let count = 1;
                        let subtotal = 0;
                        let total = factura.valor_total;
                        productos.forEach((item) => {
                            subtotal += parseInt(item.valor_unitario);
                            let detalle = item.detalle;

                            if (item.producto) {
                                $("#productos_view").append(
                                    '<tr>' +
                                    '<td>' + count + '</td>' +
                                    '<td class="tx-13">' +
                                    detalle.nombre + " (" + detalle.marca + " - " + detalle.modelo + ")" +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    parseInt(item.cantidad) +
                                    '</td>' +
                                    '<td style="text-align: right;">' +
                                    item.valor_total +
                                    '</td>' +
                                    '</tr>'
                                );
                            } else {
                                $("#productos_view").append(
                                    '<tr>' +
                                    '<td>' + count + '</td>' +
                                    '<td class="tx-13">' +
                                    detalle.code + " | " + detalle.nombre +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    parseInt(item.cantidad) +
                                    '</td>' +
                                    '<td style="text-align: right;">' +
                                    item.valor_total +
                                    '</td>' +
                                    '</tr>'
                                );
                            }
                            count++;
                        });

                        $("#productos_view").append(
                            '<tr>' +
                            '<td class="valign-middle" colspan="2" rowspan="2">' +
                            '<div class="invoice-notes">' +
                            '<label class="main-content-label tx-13">Observaciones</label>' +
                            '<p>Este es un documento soporte en adquisiciones efectuadas a no ' +
                            'obligar a facturar. Autorización de facturación N° con vigencia hasta .' +
                            'Con el prefijo - Y númeración desde hasta .</p>' +
                            '</div>' +
                            '</td>' +
                            '</tr>'
                        );

                        $("#productos_view").append(
                            '<tr>' +
                            '<td class="tx-right tx-uppercase tx-bold tx-inverse">Total a Pagar</td>' +
                            '<td class="tx-right" colspan="2">' +
                            '<h4 class="tx-primary tx-bold" id="pagar_view">' + total + '</h4>' +
                            '</td>' +
                            '</tr>'
                        );
                    }
                    $("#content_loader").addClass("d-none");
                    $("#content_factura").removeClass("d-none");
                } else {
                    toastr.error("Error al cargar los datos de la factura");
                }
            },
            error: function (data) {
                toastr.error("Error al cargar los datos de la factura");
            },
        });
    });

    $(document).on("change", ".cantidad_add", function () {
        let cantidad = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();
        let valor = $(this).parent().parent().find(".valor_add").val();
        let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_add :selected").data("impuesto") ?? 0;

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);

        let total = (cantidad * valor) - descuento;

        total = total + (total * (impuesto_cargo / 100));
        total = parseInt(total - (total * (impuesto_retencion / 100)));

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    $(document).on("change", ".valor_add", function () {
        let valor = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_add :selected").data("impuesto") ?? 0;

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);

        let total = (cantidad * valor) - descuento;

        total = total + (total * (impuesto_cargo / 100));
        total = parseInt(total - (total * (impuesto_retencion / 100)));

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    $(document).on("change", ".descuento_add", function () {
        let descuento = $(this).val();
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_add :selected").data("impuesto") ?? 0;

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);

        let total = (cantidad * valor) - descuento;

        total = total + (total * (impuesto_cargo / 100));
        total = parseInt(total - (total * (impuesto_retencion / 100)));

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    $(document).on("change", ".cargo_add", function () {
        let impuesto_cargo = $(this).find(":selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_add :selected").data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);

        let total = (cantidad * valor) - descuento;

        total = total + (total * (impuesto_cargo / 100));
        total = parseInt(total - (total * (impuesto_retencion / 100)));

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    $(document).on("change", ".retencion_add", function () {
        let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).val() ?? 0;
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);

        let total = (cantidad * valor) - descuento;

        total = total + (total * (impuesto_cargo / 100));
        total = parseInt(total - (total * (impuesto_retencion / 100)));

        //console.log(total);
        //console.log(impuesto_retencion);
        //console.log(cantidad);

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    function totales() {
        let subtotal = 0;
        let descuento = 0;
        let total = 0;

        $(".total_add").each(function () {
            let valor = $(this).val();
            valor = valor.split(',');
            valor = valor[0];
            valor = valor.replaceAll('.', '');
            valor = parseInt(valor);
            total += valor;
        });

        $(".descuento_add").each(function () {
            let valor = $(this).val();
            valor = valor.split(',');
            valor = valor[0];
            valor = valor.replaceAll('.', '');
            valor = parseInt(valor);
            descuento += valor;
        });

        $(".cantidad_add").each(function () {
            let cantidad = $(this).val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();

            valor_unitario = valor_unitario.split(',');
            valor_unitario = valor_unitario[0];
            valor_unitario = valor_unitario.replaceAll('.', '');
            valor_unitario = parseInt(valor_unitario);

            subtotal += (cantidad * valor_unitario);
        });

        $("#total_subtotal_add").html((subtotal).toLocaleString('es-ES', { minimumFractionDigits: 2 }));
        $("#total_descuentos_add").html((descuento).toLocaleString('es-ES', { minimumFractionDigits: 2 }));
        $("#total_neto_add").html((total).toLocaleString('es-ES', { minimumFractionDigits: 2 }));
        $(".formas_pago_add").trigger("change");

    }

    $(document).on("change", ".formas_pago_add", function () {
        let count = 0;
        let total = $("#total_neto_add").html();

        total = total.split(',');
        total = total[0];
        total = total.replaceAll('.', '');
        total = parseInt(total);

        $(".formas_pago_add").each(function () {
            count++;
        });

        if (count == 1) {
            $(".forma_pago_input_add").val((total).toLocaleString('es-ES', { minimumFractionDigits: 2 }));
            $("#total_formas_pago_add").html((total).toLocaleString('es-ES', { minimumFractionDigits: 2 }));
        }
    });

    $(document).on("click", "#btnAddFactura", function () {
        let tipo = $("#tipo_add").val();
        let centro = $("#centro_costo_add").val();
        let fecha = $("#fecha_add").val();
        let proveedor = $("#proveedor_add").val();
        let factura_proveedor = $("#factura1_proveedor_add").val();
        let consecutivo_proveedor = $("#factura2_proveedor_add").val();
        let total = $("#total_neto_add").html();
        let valid = false;

        let productos = [];

        $(".producto_add").each(function () {
            let producto = $(this).val();
            let tipo = $(this).parent().parent().find(".tipo_add").val();
            let descripcion = $(this).parent().parent().find(".descripcion_add").val();
            let bodega = $(this).parent().parent().find(".bodega_add").val();
            let cantidad = $(this).parent().parent().find(".cantidad_add").val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();
            let descuento = $(this).parent().parent().find(".descuento_add").val();
            let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
            let impuesto_retencion = $(this).parent().parent().find(".retencion_add :selected").data("impuesto") ?? 0;
            let total = $(this).parent().parent().find(".total_add").val();

            if (!producto || !tipo) {
                valid = true;
            }

            if(cantidad < 1) {
                valid = true;
            }

            productos.push({
                tipo: tipo,
                producto: producto,
                descripcion: descripcion,
                bodega: bodega,
                cantidad: cantidad,
                valor_unitario: valor_unitario,
                descuento: descuento,
                impuesto_cargo: impuesto_cargo,
                impuesto_retencion: impuesto_retencion,
                total: total
            });
        });

        if (!tipo) {
            toastr.error('Debe seleccionar un tipo de factura');
            return false;
        } else if (!centro) {
            toastr.error('Debe seleccionar un centro de costo');
            return false;
        } else if (!proveedor) {
            toastr.error('Debe seleccionar un proveedor');
            return false;
        } else if (factura_proveedor.trim().length < 1) {
            toastr.error('Debe ingresar el número de factura del proveedor');
            return false;
        } else if (consecutivo_proveedor.trim().length < 1) {
            toastr.error('Debe ingresar el consecutivo de la factura');
            return false;
        } else if (total == "0.00" || total == "0" || total == "0,00" || total == "NaN") {
            toastr.error('Debe ingresar al menos un producto');
            return false;
        } else if (valid) {
            toastr.error('Debe ingresar todos los datos de los productos');
            return false;
        } else {
            $("#btnAddFactura").attr("disabled", true);
            $("#btnAddFactura").html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

            $.ajax({
                url: "add_factura_compra",
                type: "POST",
                data: {
                    tipo: tipo,
                    centro: centro,
                    fecha: fecha,
                    proveedor: proveedor,
                    factura_proveedor: factura_proveedor,
                    consecutivo_proveedor: consecutivo_proveedor,
                    total: total,
                    productos: productos
                },
                success: function (response) {
                    if(response.info == 1) {
                        toastr.success('Factura guardada con éxito');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error('Ha ocurrido un error');
                        $("#btnAddFactura").attr("disabled", false);
                        $("#btnAddFactura").html('Guardar Factura');
                    }
                },
                error: function (error) {
                    toastr.error('Ha ocurrido un error');
                    $("#btnAddFactura").attr("disabled", false);
                    $("#btnAddFactura").html('Guardar Factura');
                }
            });
        }
    });
});
