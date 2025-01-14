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
            allowClear: true,
        });
    });

    var productos = JSON.parse(localStorage.getItem("productos"));
    var formas_pago = JSON.parse(localStorage.getItem("formas_pago"));
    var impuestos_cargos = JSON.parse(localStorage.getItem("impuestos_cargos"));
    var impuestos_retencion = JSON.parse(localStorage.getItem("impuestos_retencion"));

    let impuestos_1_general = [];
    let impuestos_2_general = [];

    let impuestos_1_general_edit = [];
    let impuestos_2_general_edit = [];

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    paginacionFacturas();

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
        '</div> ';

    var contact_forma_pago_edit = '<div class="row row-sm mt-2">' +
        '<div class="col-lg-6" >' +
        '<select class="form-select formas_pago_edit">' +
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
        'class="form-control col-8 text-end input_dinner forma_pago_input_edit">' +
        '</div>' +
        '<div class="col-lg-1 d-flex" style="justify-content: center">' +
        '<a class="center-vertical mg-s-10 delete_row_forma" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        '</div>' +
        '</div> ';

    $("#new_row").click(function () {
        $("#tbl_data_detail tbody").append(
            '<tr style="background: #f9f9f9;">' +
            '<td class="center-text pad-4">1</td>' +
            '<td class="pad-4">' +
            '<select class="form-select producto_add">' +
            '<option value="">Seleccione una opción</option>' +
            productos.map((item) => {
                return (
                    '<option value="' + item.id + '">' + item.nombre + ' ' + item.marca + ' - ' + item.modelo + "</option>"
                );
            }) +
            '</select>' +
            '<textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_add" cols="30" rows="5"></textarea>' +
            '</td>' +
            '<td class="pad-4">' +
            '<textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="7"></textarea>' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="number" placeholder="Cantidad" step="1"' +
            'min="1" value="1"' +
            'class="form-control text-end cantidad_add" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" placeholder="Valor Unitario" value=""' +
            'class="form-control text-end valor_add input_dinner_valor"' +
            'style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" placeholder="Descuento" value="0.00"' +
            'class="form-control text-end descuento_add input_dinner"' +
            'style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select cargo_add">' +
            '<option value="">Seleccione una opción</option>' +
            impuestos_cargos.map((item) => {
                return (
                    '<option data-impuesto="' + item.tarifa + '" value="' + item.id + '">' + item.nombre + "</option>"
                );
            }) +
            '</select>' +
            '</td>' +
            /*'<td class="pad-4">' +
            '<select class="form-select retencion_add">' +
            '<option value="">Seleccione una opción</option>' +
            impuestos_retencion.map((item) => {
                return (
                    '<option data-impuesto="' + item.tarifa + '" value="' + item.id + '">' + item.nombre + "</option>"
                );
            }) +
            '</select>' +
            '</td>' +*/
            '<td class="text-center d-flex pad-4">' +
            '<input disabled type="text" placeholder="0.00"' +
            'class="form-control text-end total_add input_dinner"' +
            'style="border: 0">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
            '&nbsp;' +
            '</td>' +
            '</tr>'
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });

        numero_filas();
    });

    $("#new_row_edit").click(function () {
        $("#tbl_data_detail_edit tbody").append(
            '<tr style="background: #f9f9f9;">' +
            '<td class="center-text pad-4">1</td>' +
            '<td class="pad-4">' +
            '<select class="form-select producto_edit">' +
            '<option value="">Seleccione una opción</option>' +
            productos.map((item) => {
                return (
                    '<option value="' + item.id + '">' + item.nombre + ' ' + item.marca + ' - ' + item.modelo + "</option>"
                );
            }) +
            '</select>' +
            '<textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_edit" cols="30" rows="5"></textarea>' +
            '</td>' +
            '<td class="pad-4">' +
            '<textarea placeholder="Descripción" class="form-control descripcion_edit" style="border: 0" rows="7"></textarea>' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="number" placeholder="Cantidad" step="1"' +
            'min="1" value="1"' +
            'class="form-control text-end cantidad_edit" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" placeholder="Valor Unitario" value=""' +
            'class="form-control text-end valor_edit input_dinner"' +
            'style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" placeholder="Descuento" value="0.00"' +
            'class="form-control text-end descuento_edit input_dinner"' +
            'style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select cargo_edit">' +
            '<option value="">Seleccione una opción</option>' +
            impuestos_cargos.map((item) => {
                return (
                    '<option data-impuesto="' + item.tarifa + '" value="' + item.id + '">' + item.nombre + "</option>"
                );
            }) +
            '</select>' +
            '</td>' +
            /*'<td class="pad-4">' +
            '<select class="form-select retencion_edit">' +
            '<option value="">Seleccione una opción</option>' +
            impuestos_retencion.map((item) => {
                return (
                    '<option data-impuesto="' + item.tarifa + '" value="' + item.id + '">' + item.nombre + "</option>"
                );
            }) +
            '</select>' +
            '</td>' +*/
            '<td class="text-center d-flex pad-4">' +
            '<input disabled type="text" placeholder="0.00"' +
            'class="form-control text-end total_edit input_dinner"' +
            'style="border: 0">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
            '&nbsp;' +
            '</td>' +
            '</tr>'
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });

        numero_filas_edit();
    });

    $("#new_row_forma").click(function () {
        $("#list_formas_pago").append(contact_forma_pago);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $("#new_row_forma_edit").click(function () {
        $("#list_formas_pago_edit").append(contact_forma_pago_edit);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".delete_row", function () {
        $(this).parent().parent().remove();
        numero_filas();
        if (impuestos_1_general_edit.length > 0) {
            totales_edit();
        } else {
            totales();
        }
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

    function numero_filas_edit() {
        var num = 1;
        $("#tbl_data_detail_edit tbody tr").each(function () {
            $(this).find("td:first").text(num);
            num++;
        });
    }

    $("#btnNew").click(function () {
        $("#div_general").addClass("d-none");
        $("#div_form_add").removeClass("d-none");
    });

    $(".back_home").click(function () {
        location.reload();
        $("#div_general").removeClass("d-none");
        $("#div_form_add").addClass("d-none");
        $("#div_form_edit").addClass("d-none");
    });

    $("#cliente_add").change(function () {
        var id = $(this).val();

        if (id != "") {
            $.ajax({
                url: "info_cliente",
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
                        toastr.error("Error al cargar los datos del cliente");
                        $("#contacto_add").val("");
                    }
                },
                error: function (data) {
                    toastr.error("Error al cargar los datos del cliente");
                    $("#contacto_add").val("");
                },
            });
        } else {
            toastr.error("Debe seleccionar un cliente");
            $("#contacto_add").val("");
        }
    });

    $("#cliente_edit").change(function () {
        var id = $(this).val();

        if (id != "") {
            $.ajax({
                url: "info_cliente",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        $("#contacto_edit").val(data.contacto);
                    } else {
                        toastr.error("Error al cargar los datos del cliente");
                        $("#contacto_edit").val("");
                    }
                },
                error: function (data) {
                    toastr.error("Error al cargar los datos del cliente");
                    $("#contacto_edit").val("");
                },
            });
        } else {
            toastr.error("Debe seleccionar un cliente");
            $("#contacto_edit").val("");
        }
    });

    $(document).on("keyup", ".input_dinner", function () {
        let v = $(this).val().replace(/\D+/g, '');
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v.replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, '$1.'));
    });
    
    $(document).on("keyup", ".input_dinner_valor", function () {
        $(this).val(function (index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    /*$(document).on("change", ".input_dinner_valor", function () {
        let valor = $(this).val();
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);
        valor = valor + "00";

        let v = valor.replace(/\D+/g, '');
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v.replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, '$1.'));
    });*/

    $(document).on("click", ".factura_btn", function () {
        let id = $(this).data("id");
        $("#content_loader").removeClass("d-none");
        $("#content_factura").addClass("d-none");

        $(".factura_btn").removeClass("selected");
        $(this).addClass("selected");

        $.ajax({
            url: "info_factura_venta",
            type: "POST",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    let factura = response.factura;
                    let productos = factura.productos;

                    // Format the price above to USD using the locale, style, and currency.
                    let USDollar = new Intl.NumberFormat('es-ES', {
                        style: 'currency',
                        currency: 'COP',
                    });

                    var fecha_compra = new Date(factura.fecha_elaboracion);
                    $("#cliente_view").html(factura.razon_social);
                    $("#nit_view").html(factura.nit + '-' + factura.codigo_verificacion + "<br>" + factura.telefono_fijo + "<br>" + factura.ciudad + ' - Colombia');

                    $("#num_fact_view").html("FERE-" + factura.numero);
                    $("#compra_view").html(fecha_compra.getDate() + "/" + (fecha_compra.getMonth() + 1) + "/" + fecha_compra.getFullYear());
                    $("#pagar_view").html(factura.valor_total);
                    $(".btn_imprimir_factura").attr("href", "pdf_factura_venta?token=" + factura.id);

                    if (factura.status == 1) {
                        $(".btn_options_factura").attr("data-id", factura.id);
                        $(".btn_pago_factura").attr("data-id", factura.id);

                        $(".btn_options_factura").removeClass("disabled");
                        $(".btn_pago_factura").removeClass("disabled");
                    } else {
                        $(".btn_options_factura").addClass("disabled");
                        $(".btn_pago_factura").addClass("disabled");

                        $(".btn_option_nota_credito").addClass("disabled");
                    }

                    $(".btn_option_duplicar").removeClass("disabled");

                    if (productos) {
                        $("#productos_view").empty();
                        let count = 1;
                        let total_bruto = factura.valor_total; //factura.total_bruto;
                        let descuentos = factura.descuentos;
                        let subtotal = factura.valor_total; //factura.subtotal;
                        let impuestos_1 = JSON.parse(factura.impuestos_1);
                        let impuestos_2 = JSON.parse(factura.impuestos_2);
                        let total = factura.valor_total;
                        productos.forEach((item) => {
                            let detalle = item.detalle;
                            let serial = item.serial_producto;

                            if(serial == null || serial == '') {
                                serial = "";
                            } else {
                                serial = "S/N: " + serial.toUpperCase();
                            }

                            item.code_siigo = item.code_siigo == null ? "" : item.code_siigo;

                            if (item.producto) {
                                $("#productos_view").append(
                                    '<tr>' +
                                    '<td>' + count + ' - (' + item.code_siigo + ')' + '</td>' +
                                    '<td class="tx-13">' +
                                    detalle.nombre + " (" + detalle.marca + " - " + detalle.modelo + ")" +
                                    '<br>' +
                                    serial +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    parseInt(item.cantidad) +
                                    '</td>' +
                                    '<td style="text-align: center;">' +
                                    item.impuesto_cargo +
                                    '%</td>' +
                                    '<td style="text-align: right;">' +
                                    USDollar.format(item.valor_total) +
                                    '</td>' +
                                    '</tr>'
                                );
                            } else {
                                $("#productos_view").append(
                                    '<tr>' +
                                    '<td>' + count + ' - (' + item.code_siigo + ')' + '</td>' +
                                    '<td class="tx-13">' +
                                    item.description +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    parseInt(item.cantidad) +
                                    '</td>' +
                                    '<td style="text-align: center;">' +
                                    item.impuesto_cargo +
                                    '%</td>' +
                                    '<td style="text-align: right;">' +
                                    USDollar.format(item.valor_total) +
                                    '</td>' +
                                    '</tr>'
                                );
                            }
                            count++;
                        });

                        let subtotal_num = subtotal.split(',');
                        subtotal_num = subtotal_num[0];
                        subtotal_num = subtotal_num.replaceAll('.', '');
                        subtotal_num = parseInt(subtotal_num);

                        let pagos = '';

                        let sum_impuestos_1 = 0;

                        let impuestos_1_total = '';
                        let impuestos_2_total = '';
                        let rowspan = 7;

                        if (impuestos_1) {
                            rowspan = impuestos_1.length > 0 ? rowspan + 1 : rowspan;

                            for (var i = 0; i < impuestos_1.length; i++) {
                                let valor = parseInt(impuestos_1[i][1]);
                                sum_impuestos_1 += valor;
                                valor = valor.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                                impuestos_1_total = '<tr>' +
                                    '<td class="tx-right" style="font-weight: 700; color: #7987a1;">' + impuestos_1[i][0] + '</td>' +
                                    '<td class="tx-right" colspan="2">' + valor + '</td>' +
                                    '</tr>'
                            }
                        }

                        if (impuestos_2) {
                            rowspan = impuestos_2.length > 0 ? rowspan + 1 : rowspan;

                            for (var i = 0; i < impuestos_2.length; i++) {
                                let valor = parseInt(impuestos_2[i][1]);
                                valor = valor.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                                impuestos_2_total = '<tr>' +
                                    '<td class="tx-right" style="font-weight: 700; color: #7987a1;">' + impuestos_2[i][0] + '</td>' +
                                    '<td class="tx-right" colspan="2">' + valor + '</td>' +
                                    '</tr>'
                            }
                        }

                        if (factura.observaciones) {
                            factura.observaciones = '<label class="main-content-label tx-13">Observaciones</label>' +
                                '<p>' + factura.observaciones + '</p>';
                        } else {
                            factura.observaciones = '';
                        }

                        if(factura.pagos) {
                            pagos += '<label class="main-content-label tx-13">Pagos recibidos</label><br>';
                            factura.pagos.forEach((item) => {
                                pagos += '<a href="/recibos_pagos_pdf?token=' + item.id + '" target="_blank">Recibo #' + item.numero + '</a><br>';
                            });
                        }

                        if (factura.adjunto_pdf) {
                            factura.adjunto_pdf = '<label class="main-content-label tx-13">Adjunto</label><br>' +
                                '<a href="' + url_general + 'images/contabilidad/facturas_venta/' + factura.adjunto_pdf + '" target="_blank">Visualizar</a>';
                        } else {
                            factura.adjunto_pdf = '';
                        }

                        let retefuente = '';
                        let reteiva = '';
                        let reteica = '';

                        if(factura.valor_retefuente != null) {
                            let valor = (subtotal_num * (factura.valor_retefuente / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            retefuente = '<tr>' +
                                '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Rte Fte</td>' +
                                '<td class="tx-right" colspan="2">' + valor + '</td>' +
                                '</tr>';
                        }

                        if(factura.valor_reteiva != null) {
                            let valor = (sum_impuestos_1 * (factura.valor_reteiva / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            reteiva = '<tr>' +
                                '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Rte Iva</td>' +
                                '<td class="tx-right" colspan="2">' + valor  + '</td>' +
                                '</tr>';
                        }

                        if(factura.valor_reteica != null) {
                            let valor = ((subtotal_num *  factura.valor_reteica) / 1000).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            reteica = '<tr>' +
                                '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Rte Ica</td>' +
                                '<td class="tx-right" colspan="2">' + valor + '</td>' +
                                '</tr>';
                        }

                        $("#productos_view").append(
                            '<tr>' +
                            '<td class="valign-middle" colspan="3" rowspan="' + rowspan + '">' +
                            '<div class="invoice-notes">' +
                            factura.observaciones +
                            pagos +
                            '<br>' +
                            factura.adjunto_pdf +
                            '</div>' +
                            '</td>' +
                            '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Total Bruto</td>' +
                            '<td class="tx-right" colspan="2">' + USDollar.format(total_bruto) + '</td>' +
                            '</tr>'
                        );

                        $("#productos_view").append(
                            '<tr>' +
                            '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Descuentos</td>' +
                            '<td class="tx-right" colspan="2">' + USDollar.format(descuentos) + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Subtotal</td>' +
                            '<td class="tx-right" colspan="2">' + USDollar.format(subtotal) + '</td>' +
                            '</tr>' +
                            impuestos_1_total +
                            /*impuestos_2_total +*/
                            retefuente +
                            reteiva +
                            reteica +
                            '<tr>' +
                            '<td class="tx-right tx-uppercase tx-bold tx-inverse">Total Neto</td>' +
                            '<td class="tx-right" colspan="2">' +
                            '<h4 class="tx-primary tx-bold">' + USDollar.format(total) + '</h4>' +
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

    // ADD
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

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

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

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

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

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

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

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    $(document).on("change", ".retencion_add", function () {
        let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).find(":selected").data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_add").val(total + "00").trigger("keyup");

        totales();
    });

    function totales() {
        let bruto = 0;
        let descuento = 0;
        let subtotal = 0;
        let impuesto_cargo = [];
        let impuesto_retencion = [];
        let total = 0;

        $(".total_add").each(function () {
            let valor = $(this).val();
            if (valor == "") valor = "0,00";
            valor = valor.split(',');
            valor = valor[0];
            valor = valor.replaceAll('.', '');
            valor = parseInt(valor);
            total += valor;
        });

        $(".cantidad_add").each(function () {
            let cantidad = $(this).val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();

            valor_unitario = valor_unitario.split(',');
            valor_unitario = valor_unitario[0];
            valor_unitario = valor_unitario.replaceAll('.', '');
            valor_unitario = parseInt(valor_unitario);

            bruto += (cantidad * valor_unitario);
        });

        $(".descuento_add").each(function () {
            let cantidad = $(this).parent().parent().find(".cantidad_add").val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();
            let descuento_1 = $(this).val();
            descuento_1 = descuento_1.split(',');
            descuento_1 = descuento_1[0];
            descuento_1 = descuento_1.replaceAll('.', '');
            descuento_1 = parseInt(descuento_1);

            descuento += descuento_1;
        });

        $(".cargo_add").each(function () {
            let impuesto = [];
            let valor = $(this).find(":selected").data("impuesto") ?? 0;
            let texto = $(this).find(":selected").text();
            let cantidad = $(this).parent().parent().find(".cantidad_add").val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(',');
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll('.', '');
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = (cantidad * valor_unitario);

                valor_unitario = (valor_unitario * (valor / 100));

                impuesto.push(texto);
                impuesto.push(valor_unitario);

                let existe = false;
                let index = 0;

                for (let i = 0; i < impuesto_cargo.length; i++) {
                    if (impuesto_cargo[i][0] == texto) {
                        existe = true;
                        index = i;
                    }
                }

                if (existe) {
                    impuesto_cargo[index][1] += valor_unitario;
                } else {
                    impuesto_cargo.push(impuesto);
                }
            }
        });

        $(".retencion_add").each(function () {
            let impuesto = [];
            let valor = $(this).find(":selected").data("impuesto") ?? 0;
            let texto = $(this).find(":selected").text();
            let cantidad = $(this).parent().parent().find(".cantidad_add").val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(',');
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll('.', '');
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = (cantidad * valor_unitario);

                valor_unitario = (valor_unitario * (valor / 100));

                impuesto.push(texto);
                impuesto.push(valor_unitario);

                let existe = false;
                let index = 0;

                for (let i = 0; i < impuesto_retencion.length; i++) {
                    if (impuesto_retencion[i][0] == texto) {
                        existe = true;
                        index = i;
                    }
                }

                if (existe) {
                    impuesto_retencion[index][1] += valor_unitario;
                } else {
                    impuesto_retencion.push(impuesto);
                }
            }
        });

        subtotal = bruto - descuento;

        $("#total_bruto_add").html((bruto).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_descuentos_add").html((descuento).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_subtotal_add").html((subtotal).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

        $("#impuestos_1_add").html('');
        for (let i = 0; i < impuesto_cargo.length; i++) {
            $("#impuestos_1_add").append('<div class="col-lg-12 d-flex" style="justify-content: end">' +
                '<div class="text-end col-6">' +
                '<p class="font-20">' + impuesto_cargo[i][0] + ':</p>' +
                '</div>' +
                '<div class="col-4 text-end">' +
                '<p class="font-20">' + (impuesto_cargo[i][1]).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</p>' +
                '</div>' +
                '</div>');
        }

        $("#impuestos_2_add").html('');
        for (let i = 0; i < impuesto_retencion.length; i++) {
            $("#impuestos_2_add").append('<div class="col-lg-12 d-flex" style="justify-content: end">' +
                '<div class="text-end col-6">' +
                '<p class="font-20">' + impuesto_retencion[i][0] + ':</p>' +
                '</div>' +
                '<div class="col-4 text-end">' +
                '<p class="font-20">' + (impuesto_retencion[i][1]).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</p>' +
                '</div>' +
                '</div>');
        }
        
        $("#total_neto_add").html((total).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $(".formas_pago_add").trigger("change");
        impuestos_1_general = impuesto_cargo;
        impuestos_2_general = impuesto_retencion;

        $("#retefte_add").trigger("change");
        $("#reteiva_add").trigger("change");
        $("#reteica_add").trigger("change");
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
            $(".forma_pago_input_add").val((total).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $("#total_formas_pago_add").html((total).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }
    });

    $(document).on("click", "#btnAddFactura", function () {
        let tipo = $("#tipo_add").val();
        let fecha = $("#fecha_add").val();
        let vendedor = $("#vendedor_add").val();
        let consecutivo = $("#consecutivo_add").val();
        let cliente = $("#cliente_add").val();
        let total_bruto = $("#total_bruto_add").html();
        let descuentos = $("#total_descuentos_add").html();
        let retefuente = $("#retefte_add").val();
        let reteiva = $("#reteiva_add").val();
        let reteica = $("#reteica_add").val();
        let subtotal = $("#total_subtotal_add").html();
        let total = $("#total_neto_add").html();
        let observaciones = $("#observaciones_add").val();
        let valid = false;

        let productos_send = [];

        $(".producto_add").each(function () {
            let producto = $(this).val();
            //let serial = $(this).parent().parent().find(".serial_producto_add").val();
            let seriales = $(this).parent().parent().find(".seriales_add").val();
            let descripcion = $(this).parent().parent().find(".descripcion_add").val();
            let cantidad = $(this).parent().parent().find(".cantidad_add").val();
            let valor_unitario = $(this).parent().parent().find(".valor_add").val();
            let descuento = $(this).parent().parent().find(".descuento_add").val();
            let impuesto_cargo = $(this).parent().parent().find(".cargo_add :selected").data("impuesto") ?? 0;
            let impuesto_retencion = $(this).parent().parent().find(".retencion_add :selected").data("impuesto") ?? 0;
            let total = $(this).parent().parent().find(".total_add").val();

            if (!producto) {
                valid = true;
            }

            if (cantidad < 1) {
                valid = true;
            }

            /*if (tipo == 1 && serial.trim().length < 1) {
                valid = true;
            }*/

            productos_send.push({
                producto: producto,
                //serial: serial,
                seriales: seriales,
                descripcion: descripcion,
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
        } else if (!vendedor) {
            toastr.error('Debe seleccionar un vendendor');
            return false;
        } else if (consecutivo <= 0) {
            toastr.error('Debe ingresar un consecutivo válido');
            return false;
        } else if (!cliente) {
            toastr.error('Debe seleccionar un cliente');
            return false;
        } else if (total == "0.00" || total == "0" || total == "0,00" || total == "NaN") {
            toastr.error('Debe ingresar al menos un producto');
            return false;
        } else if (valid) {
            toastr.error('Debe ingresar todos los datos de los productos');
            return false;
        } else if (observaciones.trim().length < 1) {
            toastr.error('Debe ingresar una observación');
            return false;
        } else {
            $("#btnAddFactura").attr("disabled", true);
            $("#btnAddFactura").html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

            let formData = new FormData();
            formData.append("tipo", tipo);
            formData.append("fecha", fecha);
            formData.append("vendedor", vendedor);
            formData.append("consecutivo", consecutivo);
            formData.append("cliente", cliente);
            formData.append("productos", JSON.stringify(productos_send));
            formData.append("total_bruto", total_bruto);
            formData.append("descuentos", descuentos);
            formData.append("subtotal", subtotal);
            formData.append("impuestos_1", JSON.stringify(impuestos_1_general));
            formData.append("impuestos_2", JSON.stringify(impuestos_2_general));
            formData.append("retefuente", retefuente);
            formData.append("reteiva", reteiva);
            formData.append("reteica", reteica);
            formData.append("total", total);
            formData.append("observaciones", observaciones);
            formData.append("factura", $("#factura_add")[0].files[0]);

            $.ajax({
                url: "add_factura_venta",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
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

    //EDIT
    $(document).on("change", ".cantidad_edit", function () {
        let cantidad = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let impuesto_cargo = $(this).parent().parent().find(".cargo_edit :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_edit :selected").data("impuesto") ?? 0;

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_edit").val(total + "00").trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".valor_edit", function () {
        let valor = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let impuesto_cargo = $(this).parent().parent().find(".cargo_edit :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_edit :selected").data("impuesto") ?? 0;

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_edit").val(total + "00").trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".descuento_edit", function () {
        let descuento = $(this).val();
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let impuesto_cargo = $(this).parent().parent().find(".cargo_edit :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_edit :selected").data("impuesto") ?? 0;

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_edit").val(total + "00").trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".cargo_edit", function () {
        let impuesto_cargo = $(this).find(":selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).parent().parent().find(".retencion_edit :selected").data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_edit").val(total + "00").trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".retencion_edit", function () {
        let impuesto_cargo = $(this).parent().parent().find(".cargo_edit :selected").data("impuesto") ?? 0;
        let impuesto_retencion = $(this).find(":selected").data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();

        valor = valor.split(',');
        valor = valor[0];
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);

        let total = (cantidad * valor);

        descuento = descuento.split(',');
        descuento = descuento[0];
        descuento = descuento.replaceAll('.', '');
        descuento = parseInt(descuento);
        total = total - descuento;

        var impuesto_1 = (total * (impuesto_cargo / 100));
        var impuesto_2 = (total * (impuesto_retencion / 100));

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this).parent().parent().find(".total_edit").val(total + "00").trigger("keyup");

        totales_edit();
    });

    function totales_edit() {
        let bruto = 0;
        let descuento = 0;
        let subtotal = 0;
        let impuesto_cargo = [];
        let impuesto_retencion = [];
        let total = 0;

        $(".total_edit").each(function () {
            let valor = $(this).val();
            valor = valor.split(',');
            valor = valor[0];
            valor = valor.replaceAll('.', '');
            valor = parseInt(valor);
            total += valor;
        });

        $(".cantidad_edit").each(function () {
            let cantidad = $(this).val();
            let valor_unitario = $(this).parent().parent().find(".valor_edit").val();

            valor_unitario = valor_unitario.split(',');
            valor_unitario = valor_unitario[0];
            valor_unitario = valor_unitario.replaceAll('.', '');
            valor_unitario = parseInt(valor_unitario);

            bruto += (cantidad * valor_unitario);
        });

        $(".descuento_edit").each(function () {
            let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
            let valor_unitario = $(this).parent().parent().find(".valor_edit").val();
            let descuento_1 = $(this).val();
            descuento_1 = descuento_1.split(',');
            descuento_1 = descuento_1[0];
            descuento_1 = descuento_1.replaceAll('.', '');
            descuento_1 = parseInt(descuento_1);

            descuento += descuento_1;
        });

        $(".cargo_edit").each(function () {
            let impuesto = [];
            let valor = $(this).find(":selected").data("impuesto") ?? 0;
            let texto = $(this).find(":selected").text();
            let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
            let valor_unitario = $(this).parent().parent().find(".valor_edit").val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(',');
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll('.', '');
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = (cantidad * valor_unitario);

                valor_unitario = (valor_unitario * (valor / 100));

                impuesto.push(texto);
                impuesto.push(valor_unitario);

                let existe = false;
                let index = 0;

                for (let i = 0; i < impuesto_cargo.length; i++) {
                    if (impuesto_cargo[i][0] == texto) {
                        existe = true;
                        index = i;
                    }
                }

                if (existe) {
                    impuesto_cargo[index][1] += valor_unitario;
                } else {
                    impuesto_cargo.push(impuesto);
                }
            }
        });

        $(".retencion_edit").each(function () {
            let impuesto = [];
            let valor = $(this).find(":selected").data("impuesto") ?? 0;
            let texto = $(this).find(":selected").text();
            let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
            let valor_unitario = $(this).parent().parent().find(".valor_edit").val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(',');
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll('.', '');
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = (cantidad * valor_unitario);

                valor_unitario = (valor_unitario * (valor / 100));

                impuesto.push(texto);
                impuesto.push(valor_unitario);

                let existe = false;
                let index = 0;

                for (let i = 0; i < impuesto_retencion.length; i++) {
                    if (impuesto_retencion[i][0] == texto) {
                        existe = true;
                        index = i;
                    }
                }

                if (existe) {
                    impuesto_retencion[index][1] += valor_unitario;
                } else {
                    impuesto_retencion.push(impuesto);
                }
            }
        });

        subtotal = bruto - descuento;

        $("#total_bruto_edit").html((bruto).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_descuentos_edit").html((descuento).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_subtotal_edit").html((subtotal).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

        $("#impuestos_1_edit").html('');
        for (let i = 0; i < impuesto_cargo.length; i++) {
            $("#impuestos_1_edit").append('<div class="col-lg-12 d-flex" style="justify-content: end">' +
                '<div class="text-end col-6">' +
                '<p class="font-20">' + impuesto_cargo[i][0] + ':</p>' +
                '</div>' +
                '<div class="col-4 text-end">' +
                '<p class="font-20">' + (impuesto_cargo[i][1]).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</p>' +
                '</div>' +
                '</div>');
        }

        $("#impuestos_2_edit").html('');
        for (let i = 0; i < impuesto_retencion.length; i++) {
            $("#impuestos_2_edit").append('<div class="col-lg-12 d-flex" style="justify-content: end">' +
                '<div class="text-end col-6">' +
                '<p class="font-20">' + impuesto_retencion[i][0] + ':</p>' +
                '</div>' +
                '<div class="col-4 text-end">' +
                '<p class="font-20">' + (impuesto_retencion[i][1]).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</p>' +
                '</div>' +
                '</div>');
        }

        $("#total_neto_edit").html((total).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $(".formas_pago_edit").trigger("change");
        impuestos_1_general_edit = impuesto_cargo;
        impuestos_2_general_edit = impuesto_retencion;

        $("#retefte_edit").trigger("change");
        $("#reteiva_edit").trigger("change");
        $("#reteica_edit").trigger("change");
    }

    $(document).on("change", ".formas_pago_edit", function () {
        let count = 0;
        let total = $("#total_neto_edit").html();

        total = total.split(',');
        total = total[0];
        total = total.replaceAll('.', '');
        total = parseInt(total);

        $(".formas_pago_edit").each(function () {
            count++;
        });

        if (count == 1) {
            $(".forma_pago_input_edit").val((total).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $("#total_formas_pago_edit").html((total).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }
    });

    $(document).on("click", "#btnEditFactura", function () {
        let id = $("#id_factura_edit").val();
        let tipo = $("#tipo_edit").val();
        let fecha = $("#fecha_edit").val();
        let vendedor = $("#vendedor_edit").val();
        let consecutivo = $("#consecutivo_edit").val();
        let cliente = $("#cliente_edit").val();
        let total_bruto = $("#total_bruto_edit").html();
        let descuentos = $("#total_descuentos_edit").html();
        let retefuente = $("#retefte_edit").val();
        let reteiva = $("#reteiva_edit").val();
        let reteica = $("#reteica_edit").val();
        let subtotal = $("#total_subtotal_edit").html();
        let total = $("#total_neto_edit").html();
        let observaciones = $("#observaciones_edit").val();
        let valid = false;

        let productos = [];

        $(".producto_edit").each(function () {
            let producto = $(this).val();
            //let serial = $(this).parent().parent().find(".serial_producto_edit").val();
            let seriales = $(this).parent().parent().find(".seriales_edit").val();
            let descripcion = $(this).parent().parent().find(".descripcion_edit").val();
            let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
            let valor_unitario = $(this).parent().parent().find(".valor_edit").val();
            let descuento = $(this).parent().parent().find(".descuento_edit").val();
            let impuesto_cargo = $(this).parent().parent().find(".cargo_edit :selected").data("impuesto") ?? 0;
            let impuesto_retencion = $(this).parent().parent().find(".retencion_edit :selected").data("impuesto") ?? 0;
            let total = $(this).parent().parent().find(".total_edit").val();

            if (!producto) {
                valid = true;
            }

            if (cantidad < 1) {
                valid = true;
            }

            /*if (tipo == 1 && serial.trim().length < 1) {
                valid = true;
            }*/

            productos.push({
                producto: producto,
                //serial: serial,
                seriales: seriales,
                descripcion: descripcion,
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
        } else if (!vendedor) {
            toastr.error('Debe seleccionar un vendedor');
            return false;
        } else if (consecutivo < 0) {
            toastr.error('Debe ingresar un consecutivo válido');
            return false;
        } else if (!cliente) {
            toastr.error('Debe seleccionar un cliente');
            return false;
        } else if (total == "0.00" || total == "0" || total == "0,00" || total == "NaN") {
            toastr.error('Debe ingresar al menos un producto');
            return false;
        } else if (valid) {
            toastr.error('Debe ingresar todos los datos de los productos');
            return false;
        } else if (observaciones.trim().length < 1) {
            toastr.error('Debe ingresar una observación');
            return false;
        } else {
            $("#btnEditFactura").attr("disabled", true);
            $("#btnEditFactura").html('<i class="fa fa-spinner fa-spin"></i> Guardando...');

            let formData = new FormData();
            formData.append("id", id);
            formData.append("tipo", tipo);
            formData.append("fecha", fecha);
            formData.append("vendedor", vendedor);
            formData.append("consecutivo", consecutivo);
            formData.append("cliente", cliente);
            formData.append("productos", JSON.stringify(productos));
            formData.append("total_bruto", total_bruto);
            formData.append("descuentos", descuentos);
            formData.append("subtotal", subtotal);
            formData.append("impuestos_1", JSON.stringify(impuestos_1_general_edit));
            formData.append("impuestos_2", JSON.stringify(impuestos_2_general_edit));
            formData.append("retefuente", retefuente);
            formData.append("reteiva", reteiva);
            formData.append("reteica", reteica);
            formData.append("total", total);
            formData.append("observaciones", observaciones);
            formData.append("factura", $("#factura_edit")[0].files[0]);

            $.ajax({
                url: "edit_factura_venta",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success('Factura modificada con éxito');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else if (response.info == 2) {
                        toastr.error('La factura ya tiene un pago asociado');
                        $("#btnEditFactura").attr("disabled", false);
                        $("#btnEditFactura").html('Modificar Factura');
                    } else {
                        toastr.error('Ha ocurrido un error');
                        $("#btnEditFactura").attr("disabled", false);
                        $("#btnEditFactura").html('Modificar Factura');
                    }
                },
                error: function (error) {
                    toastr.error('Ha ocurrido un error');
                    $("#btnEditFactura").attr("disabled", false);
                    $("#btnEditFactura").html('Modificar Factura');
                }
            });
        }
    });

    $(document).on("click", ".btn_options_factura", function () {
        let id = $(this).attr("data-id");
        let opcion = $(this).attr("data-opcion");

        if (opcion == 0) {
            modificar_factura(id);
        } else if (opcion == 1) {
            duplicar_factura(id);
        } else if (opcion == 2) {
            anular_factura(id);
        } else if (opcion == 3) {
            nota_credito_factura(id);
        } else if (opcion == 4) {
            contabilizacion_factura(id);
        }
    });

    // MODIFICAR FACTURA
    function modificar_factura(id) {
        $("#global-loader").fadeIn('slow');

        let formData = new FormData();
        formData.append("id", id);

        $.ajax({
            url: "info_factura_venta",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    let data = response.factura;
                    let productos = data.productos;

                    $("#id_factura_edit").val(data.id);
                    $("#tipo_edit").val(data.tipo).trigger("change");
                    $("#fecha_edit").val(data.fecha_elaboracion);
                    $("#consecutivo_edit").val(data.numero);
                    $("#vendedor_edit").val(data.vendedor_id).trigger("change");
                    $("#cliente_edit").val(data.cliente_id).trigger("change");
                    $("#observaciones_edit").val(data.observaciones);

                    //PAGOS
                    $("#total_bruto_edit").html(data.total_bruto);
                    $("#total_descuentos_edit").html(data.descuentos);
                    $("#total_subtotal_edit").html(data.subtotal);

                    $("#total_formas_pago_edit").html(data.valor_total);
                    $("#total_neto_edit").html(data.valor_total);

                    $("#impuestos_1_edit").empty();
                    $("#impuestos_2_edit").empty();

                    let p_borrar = $('#tbl_data_detail_edit tbody tr').length;

                    if (p_borrar > 1) {
                        for (let i = 0; i < p_borrar; i++) {
                            //console.log("Borrando fila " + i);
                            $('#tbl_data_detail_edit tbody tr:eq(' + i + ')').remove();
                        }
                    }

                    //PRODUCTOS
                    let contador = 0;
                    productos.forEach(producto => {
                        if (contador == 0) {
                            setTimeout(() => {
                                $(".producto_edit").val(producto.producto).trigger("change");
                            }, 1000);
                            //$(".serial_producto_edit").val(producto.serial_producto);
                            $(".seriales_edit").val(producto.serial_producto);
                            $(".descripcion_edit").val(producto.description);
                            //console.log("P1: " + producto.description);
                            $(".cantidad_edit").val(producto.cantidad);
                            $(".valor_edit").val(producto.valor_unitario);
                            $(".descuento_edit").val(producto.descuento);
                            $(".cargo_edit option[data-impuesto='" + producto.impuesto_cargo + "']").attr("selected", true).trigger("change");
                            $(".retencion_edit option[data-impuesto='" + producto.impuesto_retencion + "']").attr("selected", true).trigger("change");
                        }
                        contador++;
                    });

                    for (let i = 0; i < contador - 1; i++) {
                        //console.log("P2: " + productos[i + 1].description);
                        //console.log(productos[i + 1].impuesto_cargo);
                        $("#new_row_edit").trigger("click");
                        setTimeout(() => {
                            $(".producto_edit").eq(i + 1).val(productos[i + 1].producto).trigger("change");
                        }, 1000);
                        //$(".serial_producto_edit").eq(i + 1).val(productos[i + 1].serial_producto);
                        $(".seriales_edit").eq(i + 1).val(productos[i + 1].serial_producto);
                        $(".descripcion_edit").eq(i + 1).val(productos[i + 1].description);
                        $(".cantidad_edit").eq(i + 1).val(productos[i + 1].cantidad);
                        $(".valor_edit").eq(i + 1).val(productos[i + 1].valor_unitario);
                        $(".descuento_edit").eq(i + 1).val(productos[i + 1].descuento);
                        $(".cargo_edit option[data-impuesto='" + productos[i + 1].impuesto_cargo + "']").eq(i + 1).attr("selected", true).trigger("change");
                        $(".retencion_edit option[data-impuesto='" + productos[i + 1].impuesto_retencion + "']").eq(i + 1).attr("selected", true).trigger("change");
                    }

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });

                    numero_filas_edit();

                    $("#retefte_edit").val(data.valor_retefuente).trigger("change");
                    $("#reteiva_edit").val(data.valor_reteiva).trigger("change");
                    $("#reteica_edit").val(data.valor_reteica).trigger("change");

                    $("#global-loader").fadeOut('slow');
                    $("#div_general").addClass("d-none");
                    $("#div_form_edit").removeClass("d-none");
                } else {
                    $("#global-loader").fadeOut('slow');
                    toastr.error('Ha ocurrido un error');
                }
            },
            error: function (error) {
                toastr.error('Ha ocurrido un error');
                $("#global-loader").fadeOut('slow');
            }
        });
    }

    // DUPLICAR FACTURA
    function duplicar_factura(id) {
        $("#global-loader").fadeIn('slow');

        let formData = new FormData();
        formData.append("id", id);

        $.ajax({
            url: "info_factura_venta",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                $("#global-loader").fadeOut('slow');
                if (response.info == 1) {
                    let data = response.factura;
                    let productos = data.productos;

                    $("#tipo_add").val(data.tipo).trigger("change");
                    $("#fecha_add").val(data.fecha_elaboracion);
                    //$("#consecutivo_add").val(data.numero);
                    //$("#vendedor_add").val(data.vendedor_id).trigger("change");
                    $("#cliente_add").val(data.cliente_id).trigger("change");
                    $("#observaciones_add").val(data.observaciones);

                    //PAGOS
                    $("#total_bruto_add").html(data.total_bruto);
                    $("#total_descuentos_add").html(data.descuentos);
                    $("#total_subtotal_add").html(data.subtotal);

                    $("#total_formas_pago_add").html(data.valor_total);
                    $("#total_neto_add").html(data.valor_total);

                    $("#impuestos_1_add").empty();
                    $("#impuestos_2_add").empty();

                    let p_borrar = $('#tbl_data_detail tbody tr').length;

                    if (p_borrar > 1) {
                        for (let i = 0; i < p_borrar; i++) {
                            //console.log("Borrando fila " + i);
                            $('#tbl_data_detail tbody tr:eq(' + i + ')').remove();
                        }
                    }

                    //PRODUCTOS
                    let contador = 0;
                    productos.forEach(producto => {
                        if (contador == 0) {
                            setTimeout(() => {
                                $(".producto_add").val(producto.producto).trigger("change");
                            }, 1000);
                            //$(".serial_producto_add").val(producto.serial_producto);
                            $(".seriales_add").val(producto.serial_producto);
                            $(".descripcion_add").val(producto.description);
                            //console.log("P1: " + producto.description);
                            $(".cantidad_add").val(producto.cantidad);
                            $(".valor_add").val(producto.valor_unitario);
                            $(".descuento_add").val(producto.descuento);
                            $(".cargo_add option[data-impuesto='" + producto.impuesto_cargo + "']").attr("selected", true).trigger("change");
                            $(".retencion_add option[data-impuesto='" + producto.impuesto_retencion + "']").attr("selected", true).trigger("change");
                        }
                        contador++;
                    });

                    for (let i = 0; i < contador - 1; i++) {
                        //console.log("P2: " + productos[i + 1].description);
                        //console.log(productos[i + 1].impuesto_cargo);
                        $("#new_row").trigger("click");
                        setTimeout(() => {
                            $(".producto_add").eq(i + 1).val(productos[i + 1].producto).trigger("change");
                        }, 1000);
                        //$(".serial_producto_add").eq(i + 1).val(productos[i + 1].serial_producto);
                        $(".seriales_add").eq(i + 1).val(productos[i + 1].serial_producto);
                        $(".descripcion_add").eq(i + 1).val(productos[i + 1].description);
                        $(".cantidad_add").eq(i + 1).val(productos[i + 1].cantidad);
                        $(".valor_add").eq(i + 1).val(productos[i + 1].valor_unitario);
                        $(".descuento_add").eq(i + 1).val(productos[i + 1].descuento);
                        $(".cargo_add option[data-impuesto='" + productos[i + 1].impuesto_cargo + "']").eq(i + 1).attr("selected", true).trigger("change");
                        $(".retencion_add option[data-impuesto='" + productos[i + 1].impuesto_retencion + "']").eq(i + 1).attr("selected", true).trigger("change");
                    }

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });

                    numero_filas();

                    $("#retefte_add").val(data.valor_retefuente).trigger("change");
                    $("#reteiva_add").val(data.valor_reteiva).trigger("change");
                    $("#reteica_add").val(data.valor_reteica).trigger("change");

                    $("#global-loader").fadeOut('slow');
                    $("#div_general").addClass("d-none");
                    $("#div_form_add").removeClass("d-none");

                    console.log(data);
                } else {
                    $("#global-loader").fadeOut('slow');
                    toastr.error('Ha ocurrido un error');
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut('slow');
                toastr.error('Ha ocurrido un error');
            }
        });
    }

    // ANULAR FACTURA
    function anular_factura(id) {
        Swal.fire({
            title: '¿Está seguro de anular esta factura?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Anular',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn('slow');
                let formData = new FormData();
                formData.append("id", id);

                $.ajax({
                    url: "anular_factura_venta",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success('Factura anulada con éxito');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error('Ha ocurrido un error');
                        }
                    },
                    error: function (error) {
                        toastr.error('Ha ocurrido un error');
                    }
                });
            }
        });
    }

    // NOTA CRÉDITO
    function nota_credito_factura(id) {
        Swal.fire({
            title: '¿Está seguro de generar una nota de crédito para esta factura?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Generar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(url_general + 'nota_credito_venta?id=' + id, '_blank');
            }
        });
    }

    // CONTABILIZACION
    function contabilizacion_factura(id) {
        $("#global-loader").fadeIn('slow');

        let formData = new FormData();
        formData.append("id", id);

        $.ajax({
            url: "contabilidad_factura_venta",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                $("#global-loader").fadeOut('slow');
                if (response.info == 1) {
                    let data = response.data;
                    //console.log(data);
                    $("#modal_contabilizacion").modal('show');
                } else {
                    toastr.error('Ha ocurrido un error');
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut('slow');
                toastr.error('Ha ocurrido un error');
            }
        });
    }

    // PAGINACIÓN
    function paginacionFacturas() {
        //Limpiar paginación
        $('.center-div').remove();

        var facturasPorPagina = 10;
        var $todasFacturas = $('.main-invoice-list').children('.media');
        var numTotalFacturas = $todasFacturas.length;
        var numPaginas = Math.ceil(numTotalFacturas / facturasPorPagina);
        var paginaActual = 1;
    
        function mostrarPagina(pagina) {
            var primerItem = (pagina - 1) * facturasPorPagina;
            var ultimoItem = Math.min(primerItem + facturasPorPagina, numTotalFacturas);
    
            $todasFacturas.hide();
            $todasFacturas.slice(primerItem, ultimoItem).show();
        }
    
        var $paginacion = $('<nav class="center-div" aria-label="Facturas"></nav>');
        var $ul = $('<ul class="pagination"></ul>');
    
        $paginacion.append('<button class="page-link" id="btnAnterior"><</button>');
        $paginacion.append('<button class="page-link" id="btnSiguiente">></button>');
    
        $('.main-invoice-list').after($paginacion);
    
        // Manejar el clic en "Anterior"
        $('#btnAnterior').click(function () {
            if (paginaActual > 1) {
                paginaActual--;
                mostrarPagina(paginaActual);
            }
        });
    
        // Manejar el clic en "Siguiente"
        $('#btnSiguiente').click(function () {
            if (paginaActual < numPaginas) {
                paginaActual++;
                mostrarPagina(paginaActual);
            }
        });
    
        // Mostrar la primera página al cargar
        mostrarPagina(paginaActual);
    }

    // FAVORITOS
    $(document).on("click", ".btn_favorite", function () {
        if ($(this).hasClass('far')) {
            $(this).removeClass('far');
            $(this).addClass('fas');
            $(this).addClass('orange');

            $.ajax({
                url: "favorito_factura_venta",
                type: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    favorito: 1,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success('Factura agregada a favoritos');
                    } else {
                        toastr.error('Ha ocurrido un error');
                    }
                },
                error: function (error) {
                    toastr.error('Ha ocurrido un error');
                }
            });
        } else {
            $(this).removeClass('fas');
            $(this).addClass('far');
            $(this).removeClass('orange');

            $.ajax({
                url: "favorito_factura_venta",
                type: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    favorito: 0,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success('Factura agregada a favoritos');
                    } else {
                        toastr.error('Ha ocurrido un error');
                    }
                },
                error: function (error) {
                    toastr.error('Ha ocurrido un error');
                }
            });
        }
    });

    // VISTO BUENO
    $(document).on("click", ".btn_visto_bueno", function () {
        if ($(this).hasClass('far')) {
            $(this).removeClass('far');
            $(this).addClass('fas');
            $(this).addClass('orange');

            $.ajax({
                url: "visto_bueno_factura_venta",
                type: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    visto_bueno: 1,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        //toastr.success('Factura agregada a favoritos');
                    } else {
                        toastr.error('Ha ocurrido un error');
                    }
                },
                error: function (error) {
                    toastr.error('Ha ocurrido un error');
                }
            });
        } else {
            $(this).removeClass('fas');
            $(this).addClass('far');
            $(this).removeClass('orange');

            $.ajax({
                url: "visto_bueno_factura_venta",
                type: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    visto_bueno: 0,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        //toastr.success('Factura agregada a favoritos');
                    } else {
                        toastr.error('Ha ocurrido un error');
                    }
                },
                error: function (error) {
                    toastr.error('Ha ocurrido un error');
                }
            });
        }
    });

    // RECIBIR PAGO
    $(document).on("click", ".btn_pago_factura", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: '¿Está seguro de recibir el pago de esta factura?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Recibir Pago',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url_general + 'recibo_pago?fc=' + id;
            }
        });
    });

    // ADD
    $("#retefte_add").on("change", function () {
        let subtotal = $("#total_subtotal_add").text();
        let reteiva = $("#total_reteiva_add").text();
        let reteica = $("#total_reteica_add").text();
        let impuestos = impuestos_1_general;
        let iva = 0;

        reteiva = reteiva.split(',');
        reteiva = reteiva[0];
        reteiva = reteiva.replaceAll('.', '');
        reteiva = parseInt(reteiva);

        reteica = reteica.split(',');
        reteica = reteica[0];
        reteica = reteica.replaceAll('.', '');
        reteica = parseInt(reteica);

        for (let i = 0; i < impuestos.length; i++) {
            iva += impuestos[i][1];
        }

        subtotal = subtotal.split(',');
        subtotal = subtotal[0];
        subtotal = subtotal.replaceAll('.', '');
        subtotal = parseInt(subtotal);

        // Porcentaje
        let retefte = $(this).val();

        // Valor
        let valor = (subtotal * (retefte / 100));

        $("#total_retefte_add").html((valor).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_neto_add").html((subtotal - valor - reteiva - reteica + iva).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });

    $("#reteiva_add").on("change", function () {
        let subtotal = $("#total_subtotal_add").text();
        let retefte = $("#total_retefte_add").text();
        let reteica = $("#total_reteica_add").text();
        let impuestos = impuestos_1_general;
        let iva = 0;

        retefte = retefte.split(',');
        retefte = retefte[0];
        retefte = retefte.replaceAll('.', '');
        retefte = parseInt(retefte);

        reteica = reteica.split(',');
        reteica = reteica[0];
        reteica = reteica.replaceAll('.', '');
        reteica = parseInt(reteica);

        for (let i = 0; i < impuestos.length; i++) {
            iva += impuestos[i][1];
        }

        subtotal = subtotal.split(',');
        subtotal = subtotal[0];
        subtotal = subtotal.replaceAll('.', '');
        subtotal = parseInt(subtotal);

        // Porcentaje
        let reteiva = $(this).val();

        // Valor
        let valor = (iva * (reteiva / 100));

        $("#total_reteiva_add").html((valor).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_neto_add").html((subtotal - valor - retefte - reteica + iva).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });

    $("#reteica_add").on("change", function () {
        let subtotal = $("#total_subtotal_add").text();
        let retefte = $("#total_retefte_add").text();
        let reteiva = $("#total_reteiva_add").text();
        let impuestos = impuestos_1_general;
        let iva = 0;

        retefte = retefte.split(',');
        retefte = retefte[0];
        retefte = retefte.replaceAll('.', '');
        retefte = parseInt(retefte);

        reteiva = reteiva.split(',');
        reteiva = reteiva[0];
        reteiva = reteiva.replaceAll('.', '');
        reteiva = parseInt(reteiva);

        for (let i = 0; i < impuestos.length; i++) {
            iva += impuestos[i][1];
        }

        subtotal = subtotal.split(',');
        subtotal = subtotal[0];
        subtotal = subtotal.replaceAll('.', '');
        subtotal = parseInt(subtotal);

        // Porcentaje
        let reteica = $(this).val();

        // Valor
        let valor = ((subtotal * reteica) / 1000);

        $("#total_reteica_add").html((valor).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_neto_add").html((subtotal - valor - reteiva - retefte + iva).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });

    // EDIT
    $("#retefte_edit").on("change", function () {
        let subtotal = $("#total_subtotal_edit").text();
        let reteiva = $("#total_reteiva_edit").text();
        let reteica = $("#total_reteica_edit").text();
        let impuestos = impuestos_1_general_edit;
        let iva = 0;

        reteiva = reteiva.split(',');
        reteiva = reteiva[0];
        reteiva = reteiva.replaceAll('.', '');
        reteiva = parseInt(reteiva);

        reteica = reteica.split(',');
        reteica = reteica[0];
        reteica = reteica.replaceAll('.', '');
        reteica = parseInt(reteica);

        for (let i = 0; i < impuestos.length; i++) {
            iva += impuestos[i][1];
        }

        subtotal = subtotal.split(',');
        subtotal = subtotal[0];
        subtotal = subtotal.replaceAll('.', '');
        subtotal = parseInt(subtotal);

        // Porcentaje
        let retefte = $(this).val();

        // Valor
        let valor = (subtotal * (retefte / 100));

        $("#total_retefte_edit").html((valor).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_neto_edit").html((subtotal - valor - reteiva - reteica + iva).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });

    $("#reteiva_edit").on("change", function () {
        let subtotal = $("#total_subtotal_edit").text();
        let retefte = $("#total_retefte_edit").text();
        let reteica = $("#total_reteica_edit").text();
        let impuestos = impuestos_1_general_edit;
        let iva = 0;

        retefte = retefte.split(',');
        retefte = retefte[0];
        retefte = retefte.replaceAll('.', '');
        retefte = parseInt(retefte);

        reteica = reteica.split(',');
        reteica = reteica[0];
        reteica = reteica.replaceAll('.', '');
        reteica = parseInt(reteica);

        for (let i = 0; i < impuestos.length; i++) {
            iva += impuestos[i][1];
        }

        subtotal = subtotal.split(',');
        subtotal = subtotal[0];
        subtotal = subtotal.replaceAll('.', '');
        subtotal = parseInt(subtotal);

        // Porcentaje
        let reteiva = $(this).val();

        // Valor
        let valor = (iva * (reteiva / 100));

        $("#total_reteiva_edit").html((valor).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_neto_edit").html((subtotal - valor - retefte - reteica + iva).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });

    $("#reteica_edit").on("change", function () {
        let subtotal = $("#total_subtotal_edit").text();
        let retefte = $("#total_retefte_edit").text();
        let reteiva = $("#total_reteiva_edit").text();
        let impuestos = impuestos_1_general_edit;
        let iva = 0;

        retefte = retefte.split(',');
        retefte = retefte[0];
        retefte = retefte.replaceAll('.', '');
        retefte = parseInt(retefte);

        reteiva = reteiva.split(',');
        reteiva = reteiva[0];
        reteiva = reteiva.replaceAll('.', '');
        reteiva = parseInt(reteiva);

        for (let i = 0; i < impuestos.length; i++) {
            iva += impuestos[i][1];
        }

        subtotal = subtotal.split(',');
        subtotal = subtotal[0];
        subtotal = subtotal.replaceAll('.', '');
        subtotal = parseInt(subtotal);

        // Porcentaje
        let reteica = $(this).val();

        // Valor
        let valor = ((subtotal * reteica) / 1000);

        $("#total_reteica_edit").html((valor).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $("#total_neto_edit").html((subtotal - valor - reteiva - retefte + iva).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });

    // Filtros
    $("#btn_filtrar").on("click", function () {
        let cliente = $("#cliente_select").val();
        let estado = $("#estado_select").val();
        let producto = $("#producto_select").val();
        let num_factura = $("#num_factura_select").val();
        let cons_inicio = $("#cons_inicio_select").val();
        let cons_fin = $("#cons_fin_select").val();
        let fecha_inicio = $("#fecha_inicio_select").val();
        let fecha_fin = $("#fecha_fin_select").val();
        let mayor_menor_mora = $("#mayor_menor_select").val();
        let dia_mora = $("#dia_mora_select").val();
        let palabra_clave = $("#palabra_clave_select").val();

        // Validar si todos los campos están vacíos
        if (!cliente && !estado && !producto && !num_factura && !cons_inicio && !cons_fin && !fecha_inicio && !fecha_fin && !mayor_menor_mora && !dia_mora && !palabra_clave) {
            toastr.error('Debe ingresar al menos un filtro');
            return false;
        }

        if(cons_inicio && !cons_fin){
            toastr.error('Debe ingresar el consecutivo final');
            return false;
        }

        if(!cons_inicio && cons_fin){
            toastr.error('Debe ingresar el consecutivo inicial');
            return false;
        }

        if(fecha_inicio && !fecha_fin){
            toastr.error('Debe ingresar la fecha final');
            return false;
        }

        if(!fecha_inicio && fecha_fin){
            toastr.error('Debe ingresar la fecha inicial');
            return false;
        }

        if(!mayor_menor_mora && dia_mora){
            toastr.error('Debe ingresar si es mayor o menor');
            return false;
        }

        if(mayor_menor_mora && !dia_mora){
            toastr.error('Debe ingresar los días de mora');
            return false;
        }

        // Validar que la fecha de inicio no sea mayor a la fecha de fin
        if (fecha_inicio && fecha_fin) {
            let fecha_inicio = new Date($("#fecha_inicio_select").val());
            let fecha_fin = new Date($("#fecha_fin_select").val());

            if (fecha_inicio > fecha_fin) {
                toastr.error("La fecha de inicio no puede ser mayor a la fecha de fin");
                return false;
            }
        }

        $("#modalSelect").modal('hide');
        $("#global-loader").fadeIn('slow');

        $.ajax({
            url: "filtrar_facturas_ventas",
            type: "POST",
            data: {
                cliente: cliente,
                estado: estado,
                producto: producto,
                num_factura: num_factura,
                cons_inicio: cons_inicio,
                cons_fin: cons_fin,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
                mayor_menor_mora: mayor_menor_mora,
                dia_mora: dia_mora,
                palabra_clave: palabra_clave
            },
            dataType: "JSON",
            success: function (response) {
                $("#global-loader").fadeOut('slow');
                $("#modalSelectFilter").modal('show');
                if (response.info == 1) {
                    let token = response.token;
                    let facturas = response.facturas;

                    if (!token && !facturas) {
                        toastr.error('No se encontraron facturas');
                    } else {
                        if (token) {
                            toastr.success('Factura filtrada con éxito');
                            window.open(url_general + 'pdf_factura_venta?token=' + token, '_blank');
                        } else {
                            //console.log(facturas);
                            $("#mainInvoiceList").html("");
                            $("#cant_facturas").html(facturas.length);
                            let valor_completados = 0;
                            let valor_pendientes = 0;

                            let USDollar = new Intl.NumberFormat('es-ES', {
                                style: 'currency',
                                currency: 'COP',
                            });

                            facturas.forEach(function (factura) {
                                let bg = "";
                                let favorito = "";
                                let tipo = "FERE-";
                                let mora_html = "";

                                let fechaVencimiento = new Date(factura.fecha_elaboracion);
                                let fechaActual = new Date();
                                let diasPasados = Math.floor((fechaActual - fechaVencimiento) / (1000 * 60 * 60 * 24));
                                
                                // Fecha elaboración
                                var partesFecha = factura.fecha_elaboracion.split('-');
                                var fecha_elaboracion = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2]);
                                var dia_elaboracion = fecha_elaboracion.getDate();
                                var mes_elaboracion = fecha_elaboracion.getMonth() + 1; // Se suma 1 porque los meses van de 0 a 11 en JavaScript
                                var año_elaboracion = fecha_elaboracion.getFullYear();

                                // Asegurarse de que el día y el mes tengan dos dígitos
                                if (dia_elaboracion < 10) {
                                    dia_elaboracion = '0' + dia_elaboracion;
                                }

                                if (mes_elaboracion < 10) {
                                    mes_elaboracion = '0' + mes_elaboracion;
                                }

                                var fechaFormateada = dia_elaboracion + '/' + mes_elaboracion + '/' + año_elaboracion;

                                let color = "";
                                if (diasPasados < 20) {
                                    color = "badge-success";
                                } else if (diasPasados < 28) {
                                    color = "badge-warning";
                                } else {
                                    color = "badge-danger";
                                }

                                if (factura.status == 0) {
                                    bg = "bg-cancel";
                                } else if (factura.status == 2) {
                                    bg = "bg-paid";
                                    valor_completados += parseFloat(factura.valor_total);
                                } else {
                                    bg = "bg-pending";
                                    mora_html = '<span style="color: white" class="badge ' + color + '">' + diasPasados + '</span>';
                                    valor_pendientes += parseFloat(factura.valor_total);
                                }

                                if (factura.favorito == 1) {
                                    favorito = "fas fa-star orange";
                                } else {
                                    favorito = "far fa-star";
                                }

                                let html = '<div class="media factura_btn ' + bg + '" data-id="' + factura.id + '">' +
                                    '<div class="media-icon">' +
                                    '<i class="far fa-file-alt"></i>' +
                                    '</div>' +
                                    '<div class="media-body">' +
                                    '<h6><span>' + tipo + factura.numero + mora_html + '</span>' +
                                    '<span>' + USDollar.format(factura.valor_total) +
                                    '<i data-id="' + factura.id + '" class="' + favorito + ' btn_favorite"></i></span>' +
                                    '</h6>' +
                                    '<div>' +
                                    '<p><span>Fecha:</span>' + fechaFormateada + '</p>' +
                                    '<p>' + factura.razon_social + '(NIT: ' + factura.nit + '-' + factura.codigo_verificacion + ')</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                                $("#mainInvoiceList").append(html);
                            });
                            //console.log(valor_completados);
                            //console.log(valor_pendientes);
                            $("#txt_valor_completados").html("$ " + USDollar.format(valor_completados));
                            $("#txt_valor_pendientes").html("$ " + USDollar.format(valor_pendientes));

                            $(".center-div .pagination").remove();
                            paginacionFacturas();
                            $("#content_factura").addClass("d-none");
                            $("#modalSelectFilter").modal('hide');
                        }
                    }
                } else {
                    toastr.error('Ha ocurrido un error');
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut('slow');
                toastr.error('Ha ocurrido un error');
                $("#modalSelect").modal('show');
            }
        });
    });

    /*traerfacturasSiigo();

    function traerfacturasSiigo() {
        var all_data = [];
        var cantidad = 46;

        for(var i = 1; i <= cantidad; i++) {
            var settings = {
                url:
                    "https://cors-anywhere.herokuapp.com/https://api.siigo.com/v1/invoices?page_size=100&page=" + i,
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "Partner-Id": "CRM",
                    "Authorization":
                        "Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IkYyRDQ2NTgyMUY1QjE2QTU3QkZENDQ3NUVBNzgwRTk1MzlGMTFEOThSUzI1NiIsInR5cCI6ImF0K2p3dCIsIng1dCI6Ijh0UmxnaDliRnFWN19VUjE2bmdPbFRueEhaZyJ9.eyJuYmYiOjE3MTI4NTU1OTgsImV4cCI6MTcxNTQ0NzU5OCwiaXNzIjoiaHR0cDovL21zLXNlY3VyaXR5OjUwMDAiLCJhdWQiOiJodHRwOi8vbXMtc2VjdXJpdHk6NTAwMC9yZXNvdXJjZXMiLCJjbGllbnRfaWQiOiJTaWlnb0FQSSIsInN1YiI6IjYwMzg5NiIsImF1dGhfdGltZSI6MTcxMjg1NTU5OCwiaWRwIjoibG9jYWwiLCJuYW1lIjoiZ2NvbWVyY2lhbEByYWRpb2VubGFjZXNhcy5jb20iLCJtYWlsX3NpaWdvIjoiZ2NvbWVyY2lhbEByYWRpb2VubGFjZXNhcy5jb20iLCJjbG91ZF90ZW5hbnRfY29tcGFueV9rZXkiOiJSQURJT0VOTEFDRVNBUyIsInVzZXJzX2lkIjoiNTk0IiwidGVuYW50X2lkIjoiMHgwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDIxMDYxNyIsInVzZXJfbGljZW5zZV90eXBlIjoiMCIsInBsYW5fdHlwZSI6IjE0IiwidGVuYW50X3N0YXRlIjoiMiIsIm11bHRpdGVuYW50X2lkIjoiMTUzIiwiY29tcGFuaWVzIjoiMCIsImFwaV9zdWJzY3JpcHRpb25fa2V5IjoiZTFiMDllMzY2NGNlNGY5MGEzYWVhOGE4ZGM2YjlkOGMiLCJhcGlfdXNlcl9jcmVhdGVkX2F0IjoiMTY3NjY1NjQ4NCIsImFjY291bnRhbnQiOiJmYWxzZSIsImp0aSI6IjU5ODk2N0Q4ODZGMkJCRkYwRDUzOTE5RTI1MDM0OTQ1IiwiaWF0IjoxNzEyODU1NTk4LCJzY29wZSI6WyJTaWlnb0FQSSJdLCJhbXIiOlsiY3VzdG9tIl19.U5sUe0TgiAHEI8Cp-EhdWmo6reeY2bBzuUH3slje4m-d2HGw9qyC9jnX345B84CWKOC01O7LK9_5ht-r95s4v_WlembWAcmdW_Edyl4y9sb9A1inWbpU1YJwnXAllLKhY4g-e1ZjS98cTAeP9pdZSucxvVOA1qquwNxSpvzRS7JPdWmFwRhqhTBcFGI8N_d3uzr_f3_bLIUZkQ_09oedtBHIN_Ju7PJbqQv09099cJGQHj613IFvNIrtobPdVIoSXyneV475PjjS7h7d7NAMBBAcqx3pWjATDVgll2TZ9r1FknufCaRh34F844JV2GQVV3RXASh9EGYs3_9WVKVARg",
                },
            };
    
            $.ajax(settings).done(function (response) {
                let data = response.results;
    
                all_data.push(data);
            });
        }

        setTimeout(() => {
            console.log(all_data);
        }, 100000);
    }*/
});
