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

    var proveedores_all = JSON.parse(localStorage.getItem("proveedores"));
    var centros_costos = JSON.parse(localStorage.getItem("centros_costos"));
    var productos = JSON.parse(localStorage.getItem("productos"));
    var formas_pago = JSON.parse(localStorage.getItem("formas_pago"));
    var cuentas_gastos = JSON.parse(localStorage.getItem("cuentas_gastos"));
    var impuestos_cargos = JSON.parse(localStorage.getItem("impuestos_cargos"));
    var impuestos_retencion = JSON.parse(
        localStorage.getItem("impuestos_retencion")
    );
    let facturas_compra_siigo = JSON.parse(
        localStorage.getItem("facturas_compra_siigo")
    );
    var descuento_porcentaje = 0;
    var descuento_porcentaje_edit = 0;

    let impuestos_1_general = [];
    let impuestos_2_general = [];

    let impuestos_1_general_edit = [];
    let impuestos_2_general_edit = [];

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    paginacionFacturas();

    $(".open-toggle").trigger("click");

    var contact_forma_pago =
        '<div class="row row-sm mt-2">' +
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
        "</select>" +
        "</div>" +
        '<div class="col-lg-2"></div>' +
        '<div class="col-lg-3 d-flex" style="justify-content: end">' +
        '<input type="text" placeholder="0.00"' +
        'class="form-control col-8 text-end input_dinner forma_pago_input_add">' +
        "</div>" +
        '<div class="col-lg-1 d-flex" style="justify-content: center">' +
        '<a class="center-vertical mg-s-10 delete_row_forma" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div> ";

    var contact_forma_pago_edit =
        '<div class="row row-sm mt-2">' +
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
        "</select>" +
        "</div>" +
        '<div class="col-lg-2"></div>' +
        '<div class="col-lg-3 d-flex" style="justify-content: end">' +
        '<input type="text" placeholder="0.00"' +
        'class="form-control col-8 text-end input_dinner forma_pago_input_edit">' +
        "</div>" +
        '<div class="col-lg-1 d-flex" style="justify-content: center">' +
        '<a class="center-vertical mg-s-10 delete_row_forma" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div> ";

    $("#new_row").click(function () {
        let descuento = "";

        if (descuento_porcentaje == 0) {
            descuento =
                '<input type="text" value="0.00" placeholder="Descuento" class="form-control text-end descuento_add input_dinner" style="border: 0">';
        } else {
            descuento =
                '<input type="number" value="0" min="0" max="100" placeholder="Descuento" class="form-control text-end descuento_add" style="border: 0">';
        }
        $("#tbl_data_detail tbody").append(
            '<tr style="background: #f9f9f9;">' +
                '<td class="center-text pad-4">1</td>' +
                '<td class="pad-4">' +
                '<select class="form-select tipo_add">' +
                '<option value="">Seleccione una opción</option>' +
                '<option value="1">Producto</option>' +
                '<option value="2">Activo Fijo</option>' +
                '<option value="3">Gasto / Cuenta contable</option>' +
                "</select>" +
                "</td>" +
                '<td class="pad-4">' +
                '<select class="form-select producto_add">' +
                '<option value="">Seleccione una opción</option>' +
                "</select>" +
                '<input type="text" class="form-control mt-2 serial_producto_add" disabled placeholder="Serial">' +
                "</td>" +
                '<td class="pad-4">' +
                '<textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="3"></textarea>' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="text" placeholder="Bodega" disabled class="form-control bodega_add" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="number" step="1" value="1" min="1" placeholder="Cantidad" class="form-control text-end cantidad_add" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="text" value="0.00" placeholder="Valor Unitario" class="form-control text-end valor_add input_dinner" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                descuento +
                "</td>" +
                '<td class="pad-4">' +
                '<select class="form-select cargo_add">' +
                '<option value="">Seleccione una opción</option>' +
                impuestos_cargos.map((item) => {
                    return (
                        '<option data-impuesto="' +
                        item.tarifa +
                        '" value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        "</option>"
                    );
                }) +
                "</select>" +
                "</td>" +
                /*'<td class="pad-4">' +
                '<select class="form-select retencion_add">' +
                '<option value="">Seleccione una opción</option>' +
                impuestos_retencion.map((item) => {
                    return (
                        '<option data-impuesto="' +
                        item.tarifa +
                        '" value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        "</option>"
                    );
                }) +
                "</select>" +
                "</td>" +*/
                '<td class="text-center d-flex pad-4">' +
                '<input disabled type="text" placeholder="0.00" class="form-control text-end total_add input_dinner" style="border: 0">' +
                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>&nbsp;' +
                "</td>" +
                "</tr>"
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
        let descuento = "";

        if (descuento_porcentaje_edit == 0) {
            descuento =
                '<input type="text" value="0.00" placeholder="Descuento" class="form-control text-end descuento_edit input_dinner" style="border: 0">';
        } else {
            descuento =
                '<input type="number" value="0" min="0" max="100" placeholder="Descuento" class="form-control text-end descuento_edit" style="border: 0">';
        }
        $("#tbl_data_detail_edit tbody").append(
            '<tr style="background: #f9f9f9;">' +
                '<td class="center-text pad-4">1</td>' +
                '<td class="pad-4">' +
                '<select class="form-select tipo_edit">' +
                '<option value="">Seleccione una opción</option>' +
                '<option value="1">Producto</option>' +
                '<option value="2">Activo Fijo</option>' +
                '<option value="3">Gasto / Cuenta contable</option>' +
                "</select>" +
                "</td>" +
                '<td class="pad-4">' +
                '<select class="form-select producto_edit">' +
                '<option value="">Seleccione una opción</option>' +
                "</select>" +
                '<input type="text" class="form-control mt-2 serial_producto_edit" disabled placeholder="Serial">' +
                "</td>" +
                '<td class="pad-4">' +
                '<textarea placeholder="Descripción" class="form-control descripcion_edit" style="border: 0" rows="3"></textarea>' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="text" placeholder="Bodega" class="form-control bodega_edit" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="number" step="1" value="1" min="1" placeholder="Cantidad" class="form-control text-end cantidad_edit" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="text" value="0.00" placeholder="Valor Unitario" class="form-control text-end valor_edit input_dinner" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                descuento +
                "</td>" +
                '<td class="pad-4">' +
                '<select class="form-select cargo_edit">' +
                '<option value="">Seleccione una opción</option>' +
                impuestos_cargos.map((item) => {
                    return (
                        '<option data-impuesto="' +
                        item.tarifa +
                        '" value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        "</option>"
                    );
                }) +
                "</select>" +
                "</td>" +
                /*'<td class="pad-4">' +
                '<select class="form-select retencion_edit">' +
                '<option value="">Seleccione una opción</option>' +
                impuestos_retencion.map((item) => {
                    return (
                        '<option data-impuesto="' +
                        item.tarifa +
                        '" value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        "</option>"
                    );
                }) +
                "</select>" +
                "</td>" + */
                '<td class="text-center d-flex pad-4">' +
                '<input disabled type="text" placeholder="0.00" class="form-control text-end total_edit input_dinner" style="border: 0">' +
                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>&nbsp;' +
                "</td>" +
                "</tr>"
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
        $("#div_general").removeClass("d-none");
        $("#div_form_add").addClass("d-none");
        $("#div_form_edit").addClass("d-none");
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

    $("#proveedor_edit").change(function () {
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
                        $("#contacto_edit").val(data.contacto);
                    } else {
                        toastr.error("Error al cargar los datos del proveedor");
                        $("#contacto_edit").val("");
                    }
                },
                error: function (data) {
                    toastr.error("Error al cargar los datos del proveedor");
                    $("#contacto_edit").val("");
                },
            });
        } else {
            toastr.error("Debe seleccionar un proveedor");
            $("#contacto_edit").val("");
        }
    });

    $(document).on("keyup", ".input_dinner", function () {
        let v = $(this).val().replace(/\D+/g, "");
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v
                .replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, "$1.")
        );
    });

    $(document).on("keyup", ".input_dinner_valor", function () {
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    $(document).on("change", ".input_dinner_valor", function () {
        let valor = $(this).val();
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);
        valor = valor + "00";

        let v = valor.replace(/\D+/g, "");
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v
                .replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, "$1.")
        );
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
                    $("#nit_view").html(
                        factura.nit +
                            "-" +
                            factura.codigo_verificacion +
                            "<br>" +
                            factura.telefono_fijo +
                            "<br>" +
                            factura.ciudad +
                            " - Colombia"
                    );

                    $("#num_fact_view").html(factura.numero);
                    $("#compra_view").html(
                        fecha_compra.getDate() +
                            "/" +
                            (fecha_compra.getMonth() + 1) +
                            "/" +
                            fecha_compra.getFullYear()
                    );
                    $("#vencimiento_view").html(
                        fecha_vencimiento.getDate() +
                            "/" +
                            (fecha_vencimiento.getMonth() + 1) +
                            "/" +
                            fecha_vencimiento.getFullYear()
                    );
                    $("#pagar_view").html(factura.valor_total);
                    $(".btn_imprimir_factura").attr(
                        "href",
                        "pdf_factura_compra?token=" + factura.id
                    );

                    if (factura.status == 1) {
                        $(".btn_options_factura").attr("data-id", factura.id);
                        $(".btn_pago_factura").attr("data-id", factura.id);

                        $(".btn_options_factura").removeClass("disabled");
                        $(".btn_pago_factura").removeClass("disabled");
                    } else {
                        $(".btn_options_factura").addClass("disabled");
                        $(".btn_pago_factura").addClass("disabled");
                    }

                    if (factura.tipo == 1) {
                        $("#title_factura").html("FACTURA COMPRA");
                        $("#factura_tlt_2").html("Factura No.");
                    } else {
                        $("#title_factura").html("DOCUMENTO SOPORTE");
                        $("#factura_tlt_2").html("Documento No.");
                    }

                    if (productos) {
                        $("#productos_view").empty();
                        let count = 1;
                        let total_bruto = factura.total_bruto;
                        let descuentos = factura.descuentos;
                        let subtotal = factura.subtotal;
                        let impuestos_1 = JSON.parse(factura.impuestos_1);
                        let impuestos_2 = JSON.parse(factura.impuestos_2);
                        let total = factura.valor_total;
                        productos.forEach((item) => {
                            let detalle = item.detalle;
                            item.tarifa_cargo = item.tarifa_cargo
                                ? item.tarifa_cargo
                                : 0;
                            item.tarifa_retencion = item.tarifa_retencion
                                ? item.tarifa_retencion
                                : 0;

                            let serial = item.serial_producto;

                            if (serial == null) {
                                serial = "";
                            } else {
                                serial = "S/N: " + serial;
                            }

                            if (item.producto) {
                                $("#productos_view").append(
                                    "<tr>" +
                                        "<td>" +
                                        count +
                                        "</td>" +
                                        '<td class="tx-13">' +
                                        detalle.nombre +
                                        " (" +
                                        detalle.marca +
                                        " - " +
                                        detalle.modelo +
                                        ")" +
                                        "<br>" +
                                        serial +
                                        "</td>" +
                                        '<td class="text-center">' +
                                        parseInt(item.cantidad) +
                                        "</td>" +
                                        '<td style="text-align: center;">' +
                                        item.tarifa_cargo +
                                        "%</td>" +
                                        '<td style="text-align: right;">' +
                                        item.valor_total +
                                        "</td>" +
                                        "</tr>"
                                );
                            } else {
                                $("#productos_view").append(
                                    "<tr>" +
                                        "<td>" +
                                        count +
                                        "</td>" +
                                        '<td class="tx-13">' +
                                        detalle.code +
                                        " | " +
                                        detalle.nombre +
                                        "</td>" +
                                        '<td class="text-center">' +
                                        parseInt(item.cantidad) +
                                        "</td>" +
                                        '<td style="text-align: center;">' +
                                        item.tarifa_cargo +
                                        "%</td>" +
                                        '<td style="text-align: right;">' +
                                        item.valor_total +
                                        "</td>" +
                                        "</tr>"
                                );
                            }
                            count++;
                        });

                        let impuestos_1_total = "";
                        let impuestos_2_total = "";
                        let rowspan = 4;

                        if (impuestos_1) {
                            rowspan =
                                impuestos_1.length > 0 ? rowspan + 1 : rowspan;

                            for (var i = 0; i < impuestos_1.length; i++) {
                                let valor = parseInt(impuestos_1[i][1]);
                                valor = valor.toLocaleString("de-DE", {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                });

                                impuestos_1_total =
                                    "<tr>" +
                                    '<td class="tx-right" style="font-weight: 700; color: #7987a1;">' +
                                    impuestos_1[i][0] +
                                    "</td>" +
                                    '<td class="tx-right" colspan="2">' +
                                    valor +
                                    "</td>" +
                                    "</tr>";
                            }
                        }

                        if (impuestos_2) {
                            rowspan =
                                impuestos_2.length > 0 ? rowspan + 1 : rowspan;

                            for (var i = 0; i < impuestos_2.length; i++) {
                                let valor = parseInt(impuestos_2[i][1]);
                                valor = valor.toLocaleString("de-DE", {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                });

                                impuestos_2_total =
                                    "<tr>" +
                                    '<td class="tx-right" style="font-weight: 700; color: #7987a1;">' +
                                    impuestos_2[i][0] +
                                    "</td>" +
                                    '<td class="tx-right" colspan="2">' +
                                    valor +
                                    "</td>" +
                                    "</tr>";
                            }
                        }

                        if (factura.observaciones) {
                            factura.observaciones =
                                '<label class="main-content-label tx-13">Observaciones</label>' +
                                "<p>" +
                                factura.observaciones +
                                "</p>";
                        } else {
                            factura.observaciones = "";
                        }

                        if (factura.adjunto_pdf) {
                            factura.adjunto_pdf =
                                '<label class="main-content-label tx-13">Adjunto</label><br>' +
                                '<a href="' +
                                url_general +
                                "images/contabilidad/facturas_compra/" +
                                factura.adjunto_pdf +
                                '" target="_blank">Visualizar</a>';
                        } else {
                            factura.adjunto_pdf = "";
                        }

                        $("#productos_view").append(
                            "<tr>" +
                                '<td class="valign-middle" colspan="3" rowspan="' +
                                rowspan +
                                '">' +
                                '<div class="invoice-notes">' +
                                factura.observaciones +
                                "<br>" +
                                factura.adjunto_pdf +
                                "</div>" +
                                "</td>" +
                                '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Total Bruto</td>' +
                                '<td class="tx-right" colspan="2">' +
                                total_bruto +
                                "</td>" +
                                "</tr>"
                        );

                        $("#productos_view").append(
                            "<tr>" +
                                '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Descuentos</td>' +
                                '<td class="tx-right" colspan="2">' +
                                descuentos +
                                "</td>" +
                                "</tr>" +
                                "<tr>" +
                                '<td class="tx-right" style="font-weight: 700; color: #7987a1;">Subtotal</td>' +
                                '<td class="tx-right" colspan="2">' +
                                subtotal +
                                "</td>" +
                                "</tr>" +
                                impuestos_1_total +
                                /*impuestos_2_total +*/
                                "<tr>" +
                                '<td class="tx-right tx-uppercase tx-bold tx-inverse">Total Neto</td>' +
                                '<td class="tx-right" colspan="2">' +
                                '<h4 class="tx-primary tx-bold">' +
                                total +
                                "</h4>" +
                                "</td>" +
                                "</tr>"
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

    //ADD
    $(document).on("change", ".tipo_add", function () {
        var value = $(this).val();

        if (value == 1) {
            $(this).parent().parent().find(".producto_add").empty();
            $(this)
                .parent()
                .parent()
                .find(".producto_add")
                .append(
                    productos.map((item) => {
                        return (
                            '<option value="' +
                            item.id +
                            '">' +
                            item.nombre +
                            " (" +
                            item.marca +
                            "-" +
                            item.modelo +
                            ")" +
                            "</option>"
                        );
                    })
                );
            $(this)
                .parent()
                .parent()
                .find(".serial_producto_add")
                .attr("disabled", false);
            $(this)
                .parent()
                .parent()
                .find(".bodega_add")
                .attr("disabled", false);
            $(this).parent().parent().find(".bodega_add").val("");
            $(this).parent().parent().find(".bodega_add").attr("data-id", "");
        } else {
            $(this).parent().parent().find(".producto_add").empty();
            $(this)
                .parent()
                .parent()
                .find(".producto_add")
                .append(
                    cuentas_gastos.map((item) => {
                        return (
                            '<option value="' +
                            item.id +
                            '">' +
                            item.code +
                            " | " +
                            item.nombre +
                            "</option>"
                        );
                    })
                );
            $(this)
                .parent()
                .parent()
                .find(".serial_producto_add")
                .attr("disabled", true);
            $(this)
                .parent()
                .parent()
                .find(".bodega_add")
                .attr("disabled", true);
            $(this).parent().parent().find(".bodega_add").val("");
            $(this).parent().parent().find(".bodega_add").attr("data-id", "");
        }
    });

    $(document).on("change", ".cantidad_add", function () {
        let cantidad = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();
        let valor = $(this).parent().parent().find(".valor_add").val();
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_add :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_add :selected")
                .data("impuesto") ?? 0;

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_add")
            .val(total + "00")
            .trigger("keyup");

        totales();
    });

    $(document).on("change", ".valor_add", function () {
        let valor = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_add :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_add :selected")
                .data("impuesto") ?? 0;

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_add")
            .val(total + "00")
            .trigger("keyup");

        totales();
    });

    $(document).on("change", ".descuento_add", function () {
        let descuento = $(this).val();
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_add :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_add :selected")
                .data("impuesto") ?? 0;

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_add")
            .val(total + "00")
            .trigger("keyup");

        totales();
    });

    $(document).on("change", ".cargo_add", function () {
        let impuesto_cargo = $(this).find(":selected").data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_add :selected")
                .data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_add")
            .val(total + "00")
            .trigger("keyup");

        totales();
    });

    $(document).on("change", ".retencion_add", function () {
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_add :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this).find(":selected").data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_add").val();
        let cantidad = $(this).parent().parent().find(".cantidad_add").val();
        let descuento = $(this).parent().parent().find(".descuento_add").val();

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_add")
            .val(total + "00")
            .trigger("keyup");

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
            valor = valor.split(",");
            valor = valor[0];
            valor = valor.replaceAll(".", "");
            valor = parseInt(valor);
            total += valor;
        });

        $(".cantidad_add").each(function () {
            let cantidad = $(this).val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_add")
                .val();

            valor_unitario = valor_unitario.split(",");
            valor_unitario = valor_unitario[0];
            valor_unitario = valor_unitario.replaceAll(".", "");
            valor_unitario = parseInt(valor_unitario);

            bruto += cantidad * valor_unitario;
        });

        $(".descuento_add").each(function () {
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_add")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_add")
                .val();
            if (descuento_porcentaje == 0) {
                let descuento_1 = $(this).val();
                descuento_1 = descuento_1.split(",");
                descuento_1 = descuento_1[0];
                descuento_1 = descuento_1.replaceAll(".", "");
                descuento_1 = parseInt(descuento_1);

                descuento += descuento_1;
            } else {
                valor_unitario = valor_unitario.split(",");
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll(".", "");
                valor_unitario = parseInt(valor_unitario);

                let total = cantidad * valor_unitario;
                let descuento_1 = $(this).val();

                descuento_1 = total * (descuento_1 / 100);

                descuento += descuento_1;
            }
        });

        $(".cargo_add").each(function () {
            let impuesto = [];
            let valor = $(this).find(":selected").data("impuesto") ?? 0;
            let texto = $(this).find(":selected").text();
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_add")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_add")
                .val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(",");
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll(".", "");
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = cantidad * valor_unitario;

                valor_unitario = valor_unitario * (valor / 100);

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
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_add")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_add")
                .val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(",");
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll(".", "");
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = cantidad * valor_unitario;

                valor_unitario = valor_unitario * (valor / 100);

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

        $("#total_bruto_add").html(
            bruto.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
        $("#total_descuentos_add").html(
            descuento.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
        $("#total_subtotal_add").html(
            subtotal.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );

        if (impuesto_cargo.length > 0) {
            $("#impuestos_1_add").html("");
            for (let i = 0; i < impuesto_cargo.length; i++) {
                $("#impuestos_1_add").append(
                    '<div class="col-lg-12 d-flex" style="justify-content: end">' +
                        '<div class="text-end col-6">' +
                        '<p class="font-20">' +
                        impuesto_cargo[i][0] +
                        ":</p>" +
                        "</div>" +
                        '<div class="col-4 text-end">' +
                        '<p class="font-20">' +
                        impuesto_cargo[i][1].toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }) +
                        "</p>" +
                        "</div>" +
                        "</div>"
                );
            }
        }

        if (impuesto_retencion.length > 0) {
            $("#impuestos_2_add").html("");
            for (let i = 0; i < impuesto_retencion.length; i++) {
                $("#impuestos_2_add").append(
                    '<div class="col-lg-12 d-flex" style="justify-content: end">' +
                        '<div class="text-end col-6">' +
                        '<p class="font-20">' +
                        impuesto_retencion[i][0] +
                        ":</p>" +
                        "</div>" +
                        '<div class="col-4 text-end">' +
                        '<p class="font-20">' +
                        impuesto_retencion[i][1].toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }) +
                        "</p>" +
                        "</div>" +
                        "</div>"
                );
            }
        }

        $("#total_neto_add").html(
            total.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
        $(".formas_pago_add").trigger("change");
        impuestos_1_general = impuesto_cargo;
        impuestos_2_general = impuesto_retencion;
    }

    $(document).on("change", ".formas_pago_add", function () {
        let count = 0;
        let total = $("#total_neto_add").html();

        total = total.split(",");
        total = total[0];
        total = total.replaceAll(".", "");
        total = parseInt(total);

        $(".formas_pago_add").each(function () {
            count++;
        });

        if (count == 1) {
            $(".forma_pago_input_add").val(
                total.toLocaleString("de-DE", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            );
            $("#total_formas_pago_add").html(
                total.toLocaleString("de-DE", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            );
        }
    });

    $("#chk_procentaje").change(function () {
        if ($(this).is(":checked")) {
            $(".descuento_add").removeClass("input_dinner");
            $(".descuento_add").attr("type", "number");
            $(".descuento_add").val(0).trigger("change");
            descuento_porcentaje = 1;
        } else {
            $(".descuento_add").addClass("input_dinner");
            $(".descuento_add").attr("type", "text");
            $(".descuento_add").val("0.00").trigger("change");
            descuento_porcentaje = 0;
        }
    });

    $(document).on("click", "#btnAddFactura", function () {
        let tipo = $("#tipo_add").val();
        let centro = $("#centro_costo_add").val();
        let fecha = $("#fecha_add").val();
        let proveedor = $("#proveedor_add").val();
        let factura_proveedor = $("#factura1_proveedor_add").val();
        let consecutivo_proveedor = $("#factura2_proveedor_add").val();
        let total_bruto = $("#total_bruto_add").html();
        let descuentos = $("#total_descuentos_add").html();
        let subtotal = $("#total_subtotal_add").html();
        let total = $("#total_neto_add").html();
        let observaciones = $("#observaciones_add").val();
        let valid = false;
        let tipo_count = 0;
        let bodega_count = 0;

        let productos = [];

        $(".producto_add").each(function () {
            let producto = $(this).val();
            let serial = $(this)
                .parent()
                .parent()
                .find(".serial_producto_add")
                .val();
            let tipo = $(this).parent().parent().find(".tipo_add").val();
            let descripcion = $(this)
                .parent()
                .parent()
                .find(".descripcion_add")
                .val();
            let bodega = $(this)
                .parent()
                .parent()
                .find(".bodega_add")
                .data("id");
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_add")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_add")
                .val();
            let descuento = $(this)
                .parent()
                .parent()
                .find(".descuento_add")
                .val();
            let impuesto_cargo =
                $(this).parent().parent().find(".cargo_add :selected").val() ??
                0;
            let impuesto_retencion =
                $(this)
                    .parent()
                    .parent()
                    .find(".retencion_add :selected")
                    .val() ?? 0;
            let total = $(this).parent().parent().find(".total_add").val();

            if (!producto || !tipo) {
                valid = true;
            }

            if (cantidad < 1) {
                valid = true;
            }

            if (tipo == 1 && serial.trim().length < 1) {
                valid = true;
            }

            if (tipo == 1) {
                tipo_count++;
            }

            if (bodega <= 0) {
                bodega_count++;
            }

            console.log(bodega);

            productos.push({
                tipo: tipo,
                producto: producto,
                serial: serial,
                descripcion: descripcion,
                bodega: bodega,
                cantidad: cantidad,
                valor_unitario: valor_unitario,
                descuento: descuento,
                impuesto_cargo: impuesto_cargo,
                impuesto_retencion: impuesto_retencion,
                total: total,
            });
        });

        console.log(tipo_count);
        console.log(bodega_count);
        //console.log(productos);

        if (!tipo) {
            toastr.error("Debe seleccionar un tipo de factura");
            return false;
        } else if (!centro) {
            toastr.error("Debe seleccionar un centro de costo");
            return false;
        } else if (!proveedor) {
            toastr.error("Debe seleccionar un proveedor");
            return false;
        } else if (factura_proveedor.trim().length < 1) {
            toastr.error("Debe ingresar el número de factura del proveedor");
            return false;
        } else if (consecutivo_proveedor.trim().length < 1) {
            toastr.error("Debe ingresar el consecutivo de la factura");
            return false;
        } else if (
            total == "0.00" ||
            total == "0" ||
            total == "0,00" ||
            total == "NaN"
        ) {
            toastr.error("Debe ingresar al menos un producto");
            return false;
        } else if (valid) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } /* else if (tipo_count != bodega_count) {
            toastr.error('Debe seleccionar una bodega para cada producto');
            return false;
        }*/ else if (observaciones.trim().length < 1) {
            toastr.error("Debe ingresar una observación");
            return false;
        } else {
            $("#btnAddFactura").attr("disabled", true);
            $("#btnAddFactura").html(
                '<i class="fa fa-spinner fa-spin"></i> Guardando...'
            );

            let formData = new FormData();
            formData.append("tipo", tipo);
            formData.append("centro", centro);
            formData.append("fecha", fecha);
            formData.append("proveedor", proveedor);
            formData.append("factura_proveedor", factura_proveedor);
            formData.append("consecutivo_proveedor", consecutivo_proveedor);
            formData.append("productos", JSON.stringify(productos));
            formData.append("total_bruto", total_bruto);
            formData.append("descuentos", descuentos);
            formData.append("subtotal", subtotal);
            formData.append("impuestos_1", JSON.stringify(impuestos_1_general));
            formData.append("impuestos_2", JSON.stringify(impuestos_2_general));
            formData.append("total", total);
            formData.append("observaciones", observaciones);
            formData.append("factura", $("#factura_add")[0].files[0]);

            $.ajax({
                url: "add_factura_compra",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Factura guardada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Ha ocurrido un error");
                        $("#btnAddFactura").attr("disabled", false);
                        $("#btnAddFactura").html("Guardar Factura");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error");
                    $("#btnAddFactura").attr("disabled", false);
                    $("#btnAddFactura").html("Guardar Factura");
                },
            });
        }
    });

    //EDIT
    $(document).on("change", ".tipo_edit", function () {
        var value = $(this).val();

        if (value == 1) {
            $(this).parent().parent().find(".producto_edit").empty();
            $(this)
                .parent()
                .parent()
                .find(".producto_edit")
                .append(
                    productos.map((item) => {
                        return (
                            '<option value="' +
                            item.id +
                            '">' +
                            item.nombre +
                            " (" +
                            item.marca +
                            "-" +
                            item.modelo +
                            ")" +
                            "</option>"
                        );
                    })
                );
            $(this)
                .parent()
                .parent()
                .find(".serial_producto_edit")
                .attr("disabled", false);
        } else {
            $(this).parent().parent().find(".producto_edit").empty();
            $(this)
                .parent()
                .parent()
                .find(".producto_edit")
                .append(
                    cuentas_gastos.map((item) => {
                        return (
                            '<option value="' +
                            item.id +
                            '">' +
                            item.code +
                            " | " +
                            item.nombre +
                            "</option>"
                        );
                    })
                );
            $(this)
                .parent()
                .parent()
                .find(".serial_producto_edit")
                .attr("disabled", true);
        }
    });

    $(document).on("change", ".cantidad_edit", function () {
        let cantidad = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_edit :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_edit :selected")
                .data("impuesto") ?? 0;

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_edit")
            .val(total + "00")
            .trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".valor_edit", function () {
        let valor = $(this).val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_edit :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_edit :selected")
                .data("impuesto") ?? 0;

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_edit")
            .val(total + "00")
            .trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".descuento_edit", function () {
        let descuento = $(this).val();
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_edit :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_edit :selected")
                .data("impuesto") ?? 0;

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_edit")
            .val(total + "00")
            .trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".cargo_edit", function () {
        let impuesto_cargo = $(this).find(":selected").data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this)
                .parent()
                .parent()
                .find(".retencion_edit :selected")
                .data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_edit")
            .val(total + "00")
            .trigger("keyup");

        totales_edit();
    });

    $(document).on("change", ".retencion_edit", function () {
        let impuesto_cargo =
            $(this)
                .parent()
                .parent()
                .find(".cargo_edit :selected")
                .data("impuesto") ?? 0;
        let impuesto_retencion =
            $(this).find(":selected").data("impuesto") ?? 0;
        let valor = $(this).parent().parent().find(".valor_edit").val();
        let cantidad = $(this).parent().parent().find(".cantidad_edit").val();
        let descuento = $(this).parent().parent().find(".descuento_edit").val();

        valor = valor.split(",");
        valor = valor[0];
        valor = valor.replaceAll(".", "");
        valor = parseInt(valor);

        let total = cantidad * valor;

        if (descuento_porcentaje == 0) {
            descuento = descuento.split(",");
            descuento = descuento[0];
            descuento = descuento.replaceAll(".", "");
            descuento = parseInt(descuento);
            total = total - descuento;
        } else {
            total = total - total * (descuento / 100);
        }

        var impuesto_1 = total * (impuesto_cargo / 100);
        var impuesto_2 = total * (impuesto_retencion / 100);

        total = total + impuesto_1;
        total = parseInt(total - impuesto_2);

        $(this)
            .parent()
            .parent()
            .find(".total_edit")
            .val(total + "00")
            .trigger("keyup");

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
            valor = valor.split(",");
            valor = valor[0];
            valor = valor.replaceAll(".", "");
            valor = parseInt(valor);
            total += valor;
        });

        $(".cantidad_edit").each(function () {
            let cantidad = $(this).val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_edit")
                .val();

            valor_unitario = valor_unitario.split(",");
            valor_unitario = valor_unitario[0];
            valor_unitario = valor_unitario.replaceAll(".", "");
            valor_unitario = parseInt(valor_unitario);

            bruto += cantidad * valor_unitario;
        });

        $(".descuento_edit").each(function () {
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_edit")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_edit")
                .val();
            if (descuento_porcentaje == 0) {
                let descuento_1 = $(this).val();
                descuento_1 = descuento_1.split(",");
                descuento_1 = descuento_1[0];
                descuento_1 = descuento_1.replaceAll(".", "");
                descuento_1 = parseInt(descuento_1);

                descuento += descuento_1;
            } else {
                valor_unitario = valor_unitario.split(",");
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll(".", "");
                valor_unitario = parseInt(valor_unitario);

                let total = cantidad * valor_unitario;
                let descuento_1 = $(this).val();

                descuento_1 = total * (descuento_1 / 100);

                descuento += descuento_1;
            }
        });

        $(".cargo_edit").each(function () {
            let impuesto = [];
            let valor = $(this).find(":selected").data("impuesto") ?? 0;
            let texto = $(this).find(":selected").text();
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_edit")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_edit")
                .val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(",");
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll(".", "");
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = cantidad * valor_unitario;

                valor_unitario = valor_unitario * (valor / 100);

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
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_edit")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_edit")
                .val();

            if (texto != "Seleccione una opción") {
                valor_unitario = valor_unitario.split(",");
                valor_unitario = valor_unitario[0];
                valor_unitario = valor_unitario.replaceAll(".", "");
                valor_unitario = parseInt(valor_unitario);

                valor_unitario = cantidad * valor_unitario;

                valor_unitario = valor_unitario * (valor / 100);

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

        $("#total_bruto_edit").html(
            bruto.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
        $("#total_descuentos_edit").html(
            descuento.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
        $("#total_subtotal_edit").html(
            subtotal.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );

        $("#impuestos_1_edit").html("");
        if (impuesto_cargo.length > 0) {
            for (let i = 0; i < impuesto_cargo.length; i++) {
                if (impuesto_cargo[i][0] != "") {
                    $("#impuestos_1_edit").append(
                        '<div class="col-lg-12 d-flex" style="justify-content: end">' +
                            '<div class="text-end col-6">' +
                            '<p class="font-20">' +
                            impuesto_cargo[i][0] +
                            ":</p>" +
                            "</div>" +
                            '<div class="col-4 text-end">' +
                            '<p class="font-20">' +
                            impuesto_cargo[i][1].toLocaleString("de-DE", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            }) +
                            "</p>" +
                            "</div>" +
                            "</div>"
                    );
                }
            }
        }

        $("#impuestos_2_edit").html("");
        if (impuesto_retencion.length > 0) {
            for (let i = 0; i < impuesto_retencion.length; i++) {
                if (impuesto_retencion[i][0] != "") {
                    $("#impuestos_2_edit").append(
                        '<div class="col-lg-12 d-flex" style="justify-content: end">' +
                            '<div class="text-end col-6">' +
                            '<p class="font-20">' +
                            impuesto_retencion[i][0] +
                            ":</p>" +
                            "</div>" +
                            '<div class="col-4 text-end">' +
                            '<p class="font-20">' +
                            impuesto_retencion[i][1].toLocaleString("de-DE", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            }) +
                            "</p>" +
                            "</div>" +
                            "</div>"
                    );
                }
            }
        }

        $("#total_neto_edit").html(
            total.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
        $(".formas_pago_edit").trigger("change");
        impuestos_1_general_edit = impuesto_cargo;
        impuestos_2_general_edit = impuesto_retencion;
    }

    $(document).on("change", ".formas_pago_edit", function () {
        let count = 0;
        let total = $("#total_neto_edit").html();

        total = total.split(",");
        total = total[0];
        total = total.replaceAll(".", "");
        total = parseInt(total);

        $(".formas_pago_edit").each(function () {
            count++;
        });

        if (count == 1) {
            $(".forma_pago_input_edit").val(
                total.toLocaleString("de-DE", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            );
            $("#total_formas_pago_edit").html(
                total.toLocaleString("de-DE", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            );
        }
    });

    $("#chk_procentaje_edit").change(function () {
        if ($(this).is(":checked")) {
            $(".descuento_edit").removeClass("input_dinner");
            $(".descuento_edit").attr("type", "number");
            $(".descuento_edit").val(0).trigger("change");
            descuento_porcentaje = 1;
        } else {
            $(".descuento_edit").addClass("input_dinner");
            $(".descuento_edit").attr("type", "text");
            $(".descuento_edit").val("0.00").trigger("change");
            descuento_porcentaje = 0;
        }
    });

    $(document).on("click", "#btnEditFactura", function () {
        let id = $("#id_factura_edit").val();
        let tipo = $("#tipo_edit").val();
        let centro = $("#centro_costo_edit").val();
        let fecha = $("#fecha_edit").val();
        let proveedor = $("#proveedor_edit").val();
        let factura_proveedor = $("#factura1_proveedor_edit").val();
        let consecutivo_proveedor = $("#factura2_proveedor_edit").val();
        let total_bruto = $("#total_bruto_edit").html();
        let descuentos = $("#total_descuentos_edit").html();
        let subtotal = $("#total_subtotal_edit").html();
        let total = $("#total_neto_edit").html();
        let observaciones = $("#observaciones_edit").val();
        let valid = false;

        let productos = [];

        $(".producto_edit").each(function () {
            let producto = $(this).val();
            let serial = $(this)
                .parent()
                .parent()
                .find(".serial_producto_edit")
                .val();
            let tipo = $(this).parent().parent().find(".tipo_edit").val();
            let descripcion = $(this)
                .parent()
                .parent()
                .find(".descripcion_edit")
                .val();
            let bodega = $(this).parent().parent().find(".bodega_edit").val();
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_edit")
                .val();
            let valor_unitario = $(this)
                .parent()
                .parent()
                .find(".valor_edit")
                .val();
            let descuento = $(this)
                .parent()
                .parent()
                .find(".descuento_edit")
                .val();
            let impuesto_cargo =
                $(this)
                    .parent()
                    .parent()
                    .find(".cargo_edit :selected")
                    .data("impuesto") ?? 0;
            let impuesto_retencion =
                $(this)
                    .parent()
                    .parent()
                    .find(".retencion_edit :selected")
                    .data("impuesto") ?? 0;
            let total = $(this).parent().parent().find(".total_edit").val();

            if (!producto || !tipo) {
                valid = true;
            }

            if (cantidad < 1) {
                valid = true;
            }

            if (tipo == 1 && serial.trim().length < 1) {
                valid = true;
            }

            productos.push({
                tipo: tipo,
                producto: producto,
                serial: serial,
                descripcion: descripcion,
                bodega: bodega,
                cantidad: cantidad,
                valor_unitario: valor_unitario,
                descuento: descuento,
                impuesto_cargo: impuesto_cargo,
                impuesto_retencion: impuesto_retencion,
                total: total,
            });
        });

        if (!tipo) {
            toastr.error("Debe seleccionar un tipo de factura");
            return false;
        } else if (!centro) {
            toastr.error("Debe seleccionar un centro de costo");
            return false;
        } else if (!proveedor) {
            toastr.error("Debe seleccionar un proveedor");
            return false;
        } else if (factura_proveedor.trim().length < 1) {
            toastr.error("Debe ingresar el número de factura del proveedor");
            return false;
        } else if (consecutivo_proveedor.trim().length < 1) {
            toastr.error("Debe ingresar el consecutivo de la factura");
            return false;
        } else if (
            total == "0.00" ||
            total == "0" ||
            total == "0,00" ||
            total == "NaN"
        ) {
            toastr.error("Debe ingresar al menos un producto");
            return false;
        } else if (valid) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } else if (observaciones.trim().length < 1) {
            toastr.error("Debe ingresar una observación");
            return false;
        } else {
            $("#btnEditFactura").attr("disabled", true);
            $("#btnEditFactura").html(
                '<i class="fa fa-spinner fa-spin"></i> Guardando...'
            );

            let formData = new FormData();
            formData.append("id", id);
            formData.append("tipo", tipo);
            formData.append("centro", centro);
            formData.append("fecha", fecha);
            formData.append("proveedor", proveedor);
            formData.append("factura_proveedor", factura_proveedor);
            formData.append("consecutivo_proveedor", consecutivo_proveedor);
            formData.append("productos", JSON.stringify(productos));
            formData.append("total_bruto", total_bruto);
            formData.append("descuentos", descuentos);
            formData.append("subtotal", subtotal);
            formData.append(
                "impuestos_1",
                JSON.stringify(impuestos_1_general_edit)
            );
            formData.append(
                "impuestos_2",
                JSON.stringify(impuestos_2_general_edit)
            );
            formData.append("total", total);
            formData.append("observaciones", observaciones);
            formData.append("factura", $("#factura_edit")[0].files[0]);

            $.ajax({
                url: "edit_factura_compra",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Factura modificada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else if (response.info == 2) {
                        toastr.error("La factura ya tiene un pago asociado");
                        $("#btnEditFactura").attr("disabled", false);
                        $("#btnEditFactura").html("Modificar Factura");
                    } else {
                        toastr.error("Ha ocurrido un error");
                        $("#btnEditFactura").attr("disabled", false);
                        $("#btnEditFactura").html("Modificar Factura");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error");
                    $("#btnEditFactura").attr("disabled", false);
                    $("#btnEditFactura").html("Modificar Factura");
                },
            });
        }
    });

    // FILTROS
    $("#btn_filtrar").click(function () {
        let proveedor = $("#proveedor_select").val();
        let estado = $("#estado_select").val();
        let num_factura = $("#num_factura_select").val();
        let cons_inicio = $("#cons_inicio_select").val();
        let cons_fin = $("#cons_fin_select").val();
        let fecha_inicio = $("#fecha_inicio_select").val();
        let fecha_fin = $("#fecha_fin_select").val();
        let mayor_menor_mora = $("#mayor_menor_select").val();
        let dia_mora = $("#dia_mora_select").val();

        // Validar si todos los campos están vacíos
        if (
            !proveedor &&
            !estado &&
            !num_factura &&
            !cons_inicio &&
            !cons_fin &&
            !fecha_inicio &&
            !fecha_fin &&
            !mayor_menor_mora &&
            !dia_mora
        ) {
            toastr.error("Debe ingresar al menos un filtro");
            return false;
        }

        if (cons_inicio && !cons_fin) {
            toastr.error("Debe ingresar el consecutivo final");
            return false;
        }

        if (!cons_inicio && cons_fin) {
            toastr.error("Debe ingresar el consecutivo inicial");
            return false;
        }

        if (fecha_inicio && !fecha_fin) {
            toastr.error("Debe ingresar la fecha final");
            return false;
        }

        if (!fecha_inicio && fecha_fin) {
            toastr.error("Debe ingresar la fecha inicial");
            return false;
        }

        if (!mayor_menor_mora && dia_mora) {
            toastr.error("Debe ingresar si es mayor o menor");
            return false;
        }

        if (mayor_menor_mora && !dia_mora) {
            toastr.error("Debe ingresar los días de mora");
            return false;
        }

        // Validar que la fecha de inicio no sea mayor a la fecha de fin
        if (fecha_inicio && fecha_fin) {
            let fecha_inicio = new Date($("#fecha_inicio_select").val());
            let fecha_fin = new Date($("#fecha_fin_select").val());

            if (fecha_inicio > fecha_fin) {
                toastr.error(
                    "La fecha de inicio no puede ser mayor a la fecha de fin"
                );
                return false;
            }
        }

        $("#modalSelect").modal('hide');
        $("#global-loader").fadeIn('slow');

        let formData = new FormData();
        formData.append("proveedor", proveedor);
        formData.append("estado", estado);
        formData.append("num_factura", num_factura);
        formData.append("cons_inicio", cons_inicio);
        formData.append("cons_fin", cons_fin);
        formData.append("fecha_inicio", fecha_inicio);
        formData.append("fecha_fin", fecha_fin);
        formData.append("mayor_menor_mora", mayor_menor_mora);
        formData.append("dia_mora", dia_mora);
        $.ajax({
            url: "filtrar_facturas_compras",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
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
                            window.open(url_general + 'pdf_factura_compra?token=' + token, '_blank');
                        } else {
                            //console.log(facturas);
                            $("#mainInvoiceList").html("");
                            $("#cant_facturas").html(facturas.length);

                            // REAL
                            facturas.forEach(function (factura) {
                                let bg = "";
                                let favorito = "";
                                let tipo = "Factura No.";
                                let mora_html = "";

                                if (factura.status == 0) {
                                    bg = "bg-cancel";
                                } else if (factura.status == 2) {
                                    bg = "bg-paid";
                                } else {
                                    bg = "bg-pending";
                                }

                                let fechaVencimiento = new Date(factura.fecha_elaboracion);
                                let fechaActual = new Date();
                                let diasPasados = Math.floor((fechaActual - fechaVencimiento) / (1000 * 60 * 60 * 24));

                                let color = "";
                                if (diasPasados < 20) {
                                    color = "badge-success";
                                } else if (diasPasados < 28) {
                                    color = "badge-warning";
                                } else {
                                    color = "badge-danger";
                                }

                                if (factura.favorito == 1) {
                                    favorito = "fas fa-star orange";
                                } else {
                                    favorito = "far fa-star";
                                }

                                if (factura.tipo == 2) {
                                    tipo = "Documento No.";
                                }

                                let html = '<div class="media factura_btn ' + bg + '" data-id="' + factura.id + '">' +
                                    '<div class="media-icon">' +
                                    '<i class="far fa-file-alt"></i>' +
                                    '</div>' +
                                    '<div class="media-body">' +
                                    '<h6><span>' + tipo + factura.numero + mora_html + '</span>' +
                                    '<span>' + factura.valor_total +
                                    '<i data-id="' + factura.id + '" class="' + favorito + ' btn_favorite"></i></span>' +
                                    '</h6>' +
                                    '<div>' +
                                    '<p><span>Fecha:</span>' + factura.fecha_elaboracion + '</p>' +
                                    '<p>' + factura.razon_social + '(NIT: ' + factura.nit + '-' + factura.codigo_verificacion + ')</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                                $("#mainInvoiceList").append(html);
                            });

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
            },
        });
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
            nota_debito_factura(id);
        } else if (opcion == 4) {
            contabilizacion_factura(id);
        }
    });

    // MODIFICAR FACTURA
    function modificar_factura(id) {
        $("#global-loader").fadeIn("slow");

        let formData = new FormData();
        formData.append("id", id);

        $.ajax({
            url: "info_factura_compra",
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
                    $("#centro_costo_edit")
                        .val(data.centro_costo)
                        .trigger("change");
                    $("#fecha_edit").val(data.fecha_elaboracion);
                    $("#numero_edit").val(data.numero);
                    $("#proveedor_edit")
                        .val(data.proveedor_id)
                        .trigger("change");
                    $("#factura1_proveedor_edit").val(data.factura_proveedor);
                    $("#factura2_proveedor_edit").val(
                        data.num_factura_proveedor
                    );
                    $("#observaciones_edit").val(data.observaciones);

                    //PAGOS
                    $("#total_bruto_edit").html(data.total_bruto);
                    $("#total_descuentos_edit").html(data.descuentos);
                    $("#total_subtotal_edit").html(data.subtotal);

                    $("#total_formas_pago_edit").html(data.valor_total);
                    $("#total_neto_edit").html(data.valor_total);

                    $("#impuestos_1_edit").empty();
                    $("#impuestos_2_edit").empty();

                    let p_borrar = $("#tbl_data_detail_edit tbody tr").length;

                    if (p_borrar > 1) {
                        for (let i = 0; i < p_borrar; i++) {
                            $(
                                "#tbl_data_detail_edit tbody tr:eq(" + i + ")"
                            ).remove();
                        }
                    }

                    //PRODUCTOS
                    let contador = 0;
                    productos.forEach((producto) => {
                        if (contador == 0) {
                            $(".tipo_edit")
                                .val(producto.tipo)
                                .trigger("change");
                            setTimeout(() => {
                                if (producto.tipo == 1) {
                                    $(".producto_edit")
                                        .val(producto.producto)
                                        .trigger("change");
                                } else {
                                    $(".producto_edit")
                                        .val(producto.cuenta)
                                        .trigger("change");
                                }
                            }, 1000);
                            $(".serial_producto_edit").val(
                                producto.serial_producto
                            );
                            $(".descripcion_edit").val(producto.description);
                            $(".bodega_edit").val(producto.bodega);
                            $(".cantidad_edit").val(producto.cantidad);
                            $(".valor_edit").val(producto.valor_unitario);
                            $(".descuento_edit").val(producto.descuento);
                            $(".cargo_edit")
                                .val(producto.impuesto_cargo)
                                .trigger("change");
                            $(".retencion_edit")
                                .val(producto.impuesto_retencion)
                                .trigger("change");
                        }
                        contador++;
                    });

                    for (let i = 0; i < contador - 1; i++) {
                        $("#new_row_edit").trigger("click");

                        $(".tipo_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].tipo)
                            .trigger("change");
                        setTimeout(() => {
                            if (productos[i + 1].tipo == 1) {
                                $(".producto_edit")
                                    .eq(i + 1)
                                    .val(productos[i + 1].producto)
                                    .trigger("change");
                            } else {
                                $(".producto_edit")
                                    .eq(i + 1)
                                    .val(productos[i + 1].cuenta)
                                    .trigger("change");
                            }
                        }, 1000);
                        $(".serial_producto_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].serial_producto);
                        $(".descripcion_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].description);
                        $(".bodega_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].bodega);
                        $(".cantidad_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].cantidad);
                        $(".valor_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].valor_unitario);
                        $(".descuento_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].descuento);
                        $(".cargo_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].impuesto_cargo)
                            .trigger("change");
                        $(".retencion_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].impuesto_retencion)
                            .trigger("change");
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

                    $("#global-loader").fadeOut("slow");
                    $("#div_general").addClass("d-none");
                    $("#div_form_edit").removeClass("d-none");
                } else {
                    $("#global-loader").fadeOut("slow");
                    toastr.error("Ha ocurrido un error");
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error");
                $("#global-loader").fadeOut("slow");
            },
        });
    }

    // DUPLICAR FACTURA
    function duplicar_factura(id) {
        $("#global-loader").fadeIn("slow");

        let formData = new FormData();
        formData.append("id", id);

        $.ajax({
            url: "get_factura_compra",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                $("#global-loader").fadeOut("slow");
                if (response.info == 1) {
                    let data = response.data;
                    console.log(data);
                } else {
                    toastr.error("Ha ocurrido un error");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                toastr.error("Ha ocurrido un error");
            },
        });
    }

    // ANULAR FACTURA
    function anular_factura(id) {
        Swal.fire({
            title: "¿Está seguro de anular esta factura?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Anular",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("slow");
                let formData = new FormData();
                formData.append("id", id);

                $.ajax({
                    url: "anular_factura_compra",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Factura anulada con éxito");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ha ocurrido un error");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ha ocurrido un error");
                    },
                });
            }
        });
    }

    // NOTA DEBITO
    function nota_debito_factura(id) {
        Swal.fire({
            title: "¿Está seguro de generar una nota de débito para esta factura?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Generar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(
                    url_general + "nota_debito_compra?id=" + id,
                    "_blank"
                );
            }
        });
    }

    // CONTABILIZACION
    function contabilizacion_factura(id) {
        $("#global-loader").fadeIn("slow");

        let formData = new FormData();
        formData.append("id", id);

        $.ajax({
            url: "contabilidad_factura_compra",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                $("#global-loader").fadeOut("slow");
                if (response.info == 1) {
                    let data = response.data;
                    console.log(data);
                    $("#modal_contabilizacion").modal("show");
                } else {
                    toastr.error("Ha ocurrido un error");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                toastr.error("Ha ocurrido un error");
            },
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
        if ($(this).hasClass("far")) {
            $(this).removeClass("far");
            $(this).addClass("fas");
            $(this).addClass("orange");

            $.ajax({
                url: "favorito_factura_compra",
                type: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    favorito: 1,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Factura agregada a favoritos");
                    } else {
                        toastr.error("Ha ocurrido un error");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error");
                },
            });
        } else {
            $(this).removeClass("fas");
            $(this).addClass("far");
            $(this).removeClass("orange");

            $.ajax({
                url: "favorito_factura_compra",
                type: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    favorito: 0,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Factura agregada a favoritos");
                    } else {
                        toastr.error("Ha ocurrido un error");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error");
                },
            });
        }
    });

    // RECIBIR PAGO
    $(document).on("click", ".btn_pago_factura", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Está seguro de recibir el pago de esta factura?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Recibir Pago",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    url_general + "comprobante_egreso?fc=" + id;
            }
        });
    });

    // BODEGA
    let selectBodega = [];
    let position = 0;

    $(document).on("click", ".bodega_add", function () {
        var tipo = $(this).parent().parent().find(".tipo_add").val();
        if (tipo == 1) {
            position = $(this).parent().parent().index() + 1;
            $("#bodegaAddModal").modal("show");
        }
    });

    $(document).on("keyup", ".bodega_add", function () {
        if (selectBodega.length < 1) {
            $(this).val("");
        } else {
            var id = 0;
            var name = "";
            $("#bodegaAddModal").modal("hide");
            for (var i = 0; i < selectBodega.length; i++) {
                if (selectBodega[i].position == position) {
                    id = selectBodega[i].id;
                    name = selectBodega[i].name;
                }
            }

            $(this).val(name);
            $(this).attr("data-id", id);
        }
    });

    $(document).on("click", ".btn_AlmacenAdd", function () {
        var id = $(this).data("id");
        var name = $(this).data("name");

        var object = {
            id: id,
            name: name,
            position: position,
        };

        //VALIDAR SI YA EXISTE
        var existe = false;
        for (var i = 0; i < selectBodega.length; i++) {
            if (selectBodega[i].position == position) {
                existe = true;
            }
        }

        if (!existe) {
            selectBodega.push(object);
        } else {
            for (var i = 0; i < selectBodega.length; i++) {
                if (selectBodega[i].position == position) {
                    selectBodega[i].id = id;
                    selectBodega[i].name = name;
                }
            }
        }

        $(".btn_AlmacenAdd").parent().css("color", "#56546d");
        $(this).parent().css("color", "#0ba360");
    });

    $("#AceptarBodegaAdd").click(function () {
        var id = 0;
        var name = "";
        $("#bodegaAddModal").modal("hide");
        for (var i = 0; i < selectBodega.length; i++) {
            if (selectBodega[i].position == position) {
                id = selectBodega[i].id;
                name = selectBodega[i].name;
            }
        }

        let tr = $("#tbl_data_detail tbody tr:nth-child(" + position + ")");
        tr.find(".bodega_add").val(name);
        tr.find(".bodega_add").attr("data-id", id);
    });

    $("#btnSiigo").click(function () {
        let facturas_all = facturas_compra_siigo;
        let inicial = 0;
        let final = 50;
        let facturas = facturas_all; //.slice(inicial, final);
        let all_data = [];
        let centros_filter = centros_costos;
        let proveedores_filter = proveedores_all;

        facturas.forEach(function (factura) {
            if (factura.Quantity && factura.Quantity > 0) {
                let id = factura.ACEntryID;
                let fc_text = "";
                let fc_number = "";
                let number_dc = factura.ExternalDocumentNumber;
                let numero_factura = factura.Consecutive;

                number_dc = number_dc.split("-");
                fc_text = number_dc[0];
                fc_number = number_dc[1];

                let tipo = 1;

                let centro = factura.CostCenter ?? "Grúas";

                if (centro == "Venta Repuestos y accesorios") {
                    centro = "Repuestos y accesorios";
                }

                centros_filter.forEach(function (centro_costo) {
                    if (centro_costo.nombre.match(new RegExp(centro, "i"))) {
                        centro = centro_costo.id;
                    }
                });

                let proveedor = factura.ClientIdentification;
                proveedores_filter.forEach(function (proveedor_filter) {
                    if (proveedor_filter.nit == proveedor) {
                        proveedor = proveedor_filter.id;
                    }
                });

                let fecha = factura.ElaborationDate;
                let factura_proveedor = fc_text;
                let consecutivo_proveedor = fc_number;
                let descuentos = 0;

                let subtotal = 0;

                if (factura.Quantity) {
                    subtotal = factura.Quantity * factura.UnitValue;
                }

                let total = factura.Value;
                let observaciones = factura.Description;
                let productos = [];

                var settings = {
                    url:
                        "https://services.siigo.com/ACEntryApi/api/v2/Purchase/GetItem?id=" +
                        id,
                    method: "GET",
                    timeout: 0,
                    headers: {
                        Authorization:
                            "Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IkYyRDQ2NTgyMUY1QjE2QTU3QkZENDQ3NUVBNzgwRTk1MzlGMTFEOThSUzI1NiIsInR5cCI6ImF0K2p3dCIsIng1dCI6Ijh0UmxnaDliRnFWN19VUjE2bmdPbFRueEhaZyJ9.eyJuYmYiOjE3MTM1MzkyODUsImV4cCI6MTcxNjEzMTI4NSwiaXNzIjoiaHR0cDovL21zLXNlY3VyaXR5OjUwMDAiLCJhdWQiOiJodHRwOi8vbXMtc2VjdXJpdHk6NTAwMC9yZXNvdXJjZXMiLCJjbGllbnRfaWQiOiJTaWlnb0FQSSIsInN1YiI6IjE5MTYzMTAiLCJhdXRoX3RpbWUiOjE3MTM1MzkyODUsImlkcCI6ImxvY2FsIiwibmFtZSI6Imdjb21lcmNpYWxAcmFkaW9lbmxhY2VzYXMuY29tIiwibWFpbF9zaWlnbyI6Imdjb21lcmNpYWxAcmFkaW9lbmxhY2VzYXMuY29tIiwiY2xvdWRfdGVuYW50X2NvbXBhbnlfa2V5IjoiUkFESU9FTkxBQ0VTQVMwMDEiLCJ1c2Vyc19pZCI6IjY2NyIsInRlbmFudF9pZCI6IjB4MDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDA4OTM4ODQiLCJ1c2VyX2xpY2Vuc2VfdHlwZSI6IjAiLCJwbGFuX3R5cGUiOiIxNCIsInRlbmFudF9zdGF0ZSI6IjEiLCJtdWx0aXRlbmFudF9pZCI6IjExNjMiLCJjb21wYW5pZXMiOiIwIiwiYXBpX3N1YnNjcmlwdGlvbl9rZXkiOiI5NjcwZGY5YTRjMGI0N2E1YTVkMmViNjE2ZjJjYzM0NCIsImFwaV91c2VyX2NyZWF0ZWRfYXQiOiIxNzA0NDY1NTc0IiwiYWNjb3VudGFudCI6ImZhbHNlIiwianRpIjoiMjU0ODZBRjAzRjAyOEY2NzlFQkY1RUQ3NDdCNTFFQkEiLCJpYXQiOjE3MTM1MzkyODUsInNjb3BlIjpbIlNpaWdvQVBJIl0sImFtciI6WyJjdXN0b20iXX0.IA0MrIgAaZfIkjfvv4VNPdlCH2aAgOC1X3VMF_PQe5QEVrnGX-WRNCq-e9L3SPAa3eDEAIvSdTJJd_QY2ZMkAwHqatdUbjiFdytCCRilPHfnWnZInF_UlDIL3hnGr6zx7nJSISYpwPNp5iNWJphCZ2q3YbGViT9a-_mc4hPTQGFtRzXlTyWMdEUvYWWpPtIbmPSaJwuspsQdkcPAtPxuEWiWuQk9gi1F7zii7MbaKpi_9BiUBmkWrPVew4xC_0UTXVgzylFHjNXjuRTxQL08VjipqhgunFGGlymHqOng1ei76L3t8umQbL1k9mPsWm9yrn3uIO3JiPXWkFPqeHncSA",
                    },
                };

                $.ajax(settings).done(function (response) {
                    productos = response.Items;

                    all_data.push({
                        id_siigo: id,
                        numero_factura: numero_factura,
                        tipo: tipo,
                        centro: centro,
                        fecha: fecha.substring(0, 10),
                        proveedor: proveedor,
                        factura_proveedor: factura_proveedor,
                        consecutivo_proveedor: consecutivo_proveedor,
                        descuentos: descuentos.toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }),
                        subtotal: subtotal.toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }),
                        total: total.toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }),
                        observaciones: observaciones,
                        productos: productos,
                    });
                });
            }
        });

        setTimeout(function () {
            saveDataSiigo(all_data);
        }, 10000);
    });

    function similarityScore(str1, str2) {
        const m = str1.length;
        const n = str2.length;
        const dp = Array.from(Array(m + 1), () => Array(n + 1).fill(0));

        for (let i = 1; i <= m; i++) {
            for (let j = 1; j <= n; j++) {
                if (str1[i - 1] === str2[j - 1]) {
                    dp[i][j] = dp[i - 1][j - 1] + 1;
                } else {
                    dp[i][j] = Math.max(dp[i - 1][j], dp[i][j - 1]);
                }
            }
        }

        return dp[m][n];
    }

    function saveDataSiigo(data) {
        data.forEach(function (factura) {
            let productos = [];
            let impuestos_1 = [];
            let impuestos_2 = [];

            factura.productos.forEach(function (producto) {
                if (producto.Quantity && producto.Quantity > 0) {
                    let tipo = 3;
                    let producto_name = producto.Description.trim();
                    let serial = null;
                    let descripcion = producto.Description.trim();
                    let bodega = null;
                    let cantidad = producto.Quantity;
                    let valor_unitario = producto.UnitValue.toLocaleString(
                        "de-DE",
                        { minimumFractionDigits: 2, maximumFractionDigits: 2 }
                    );
                    let descuento = producto.DiscountValue.toLocaleString(
                        "de-DE",
                        { minimumFractionDigits: 2, maximumFractionDigits: 2 }
                    );
                    let total = producto.Value;
                    let impuesto_retencion = 0;
                    let impuesto_cargo = 0;

                    if (producto.TaxAddName && producto.TaxAddName != "") {
                        let name = producto.TaxAddName;
                        let value = 0;
                        let tarifa = 0;
                        let mejorCoincidencia = null;
                        let mejorPuntuacion = 0;

                        impuestos_cargos.forEach(function (impuesto) {
                            const puntuacion = similarityScore(
                                impuesto.nombre,
                                name
                            );
                            if (puntuacion > mejorPuntuacion) {
                                mejorCoincidencia = impuesto;
                                mejorPuntuacion = puntuacion;
                            }
                        });

                        if (mejorCoincidencia) {
                            impuesto_cargo = mejorCoincidencia.id;
                            tarifa = mejorCoincidencia.tarifa;
                            encontro = true;
                        }

                        value = (total * tarifa) / 100;
                        value = parseInt(value);
                        let send = [name, value];
                        impuestos_1.push(send);
                    }

                    total = total.toLocaleString("de-DE", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });

                    productos.push({
                        tipo: tipo,
                        producto: producto_name,
                        serial: serial,
                        descripcion: descripcion,
                        bodega: bodega,
                        cantidad: cantidad,
                        valor_unitario: valor_unitario,
                        descuento: descuento,
                        total: total,
                        impuesto_retencion: impuesto_retencion,
                        impuesto_cargo: impuesto_cargo,
                    });
                }
            });

            factura.impuestos_1 = impuestos_1;
            factura.impuestos_2 = impuestos_2;
            factura.productos = productos;
        });

        data.forEach((element) => {
            let formData = new FormData();

            formData.append("tipo", element.tipo);
            formData.append("numero_factura_siigo", element.numero_factura);
            formData.append("centro", element.centro);
            formData.append("fecha", element.fecha);
            formData.append("proveedor", element.proveedor);
            formData.append("factura_proveedor", element.factura_proveedor);
            formData.append(
                "consecutivo_proveedor",
                element.consecutivo_proveedor
            );
            formData.append("productos", JSON.stringify(element.productos));
            formData.append("total_bruto", element.subtotal);
            formData.append("descuentos", element.descuentos);
            formData.append("subtotal", element.subtotal);
            formData.append("impuestos_1", JSON.stringify(element.impuestos_1));
            formData.append("impuestos_2", JSON.stringify(element.impuestos_2));
            formData.append("total", element.total);
            formData.append("observaciones", element.observaciones);
            formData.append("id_siigo", element.id_siigo);

            $.ajax({
                url: "add_factura_compra",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (response.info == 1) {
                        toastr.success("Factura guardada con éxito");
                    } else {
                        toastr.error("Ha ocurrido un error");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Ha ocurrido un error");
                },
            });
        });
    }
});
