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

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    var productos = JSON.parse(localStorage.getItem("productos"));
    var formas_pago = JSON.parse(localStorage.getItem("formas_pago"));
    var impuestos_cargos = JSON.parse(localStorage.getItem("impuestos_cargos"));

    let impuestos_1_general_edit = [];

    modificar_factura($("#id_factura_nt_fv").val());

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

    $("#new_row_edit").click(function () {
        $("#tbl_data_detail_edit tbody").append(
            '<tr style="background: #f9f9f9;">' +
                '<td class="center-text pad-4">1</td>' +
                '<td class="pad-4">' +
                '<select class="form-select producto_edit">' +
                '<option value="">Seleccione una opción</option>' +
                productos.map((item) => {
                    return (
                        '<option value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        " " +
                        item.marca +
                        " - " +
                        item.modelo +
                        "</option>"
                    );
                }) +
                "</select>" +
                '<textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_edit" cols="30" rows="5"></textarea>' +
                "</td>" +
                '<td class="pad-4">' +
                '<textarea placeholder="Descripción" class="form-control descripcion_edit" style="border: 0" rows="7"></textarea>' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="number" placeholder="Cantidad" step="1"' +
                'min="1" value="1"' +
                'class="form-control text-end cantidad_edit" style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="text" placeholder="Valor Unitario" value=""' +
                'class="form-control text-end valor_edit input_dinner"' +
                'style="border: 0">' +
                "</td>" +
                '<td class="pad-4">' +
                '<input type="text" placeholder="Descuento" value="0.00"' +
                'class="form-control text-end descuento_edit input_dinner"' +
                'style="border: 0">' +
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
                "&nbsp;" +
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
        $("#list_formas_pago").append(contact_forma_pago_edit);

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
        numero_filas_edit();
        totales_edit();
    });

    $(document).on("click", ".delete_row_forma", function () {
        $(this).parent().parent().remove();
    });

    function numero_filas_edit() {
        var num = 1;
        $("#tbl_data_detail_edit tbody tr").each(function () {
            $(this).find("td:first").text(num);
            num++;
        });
    }

    // MODIFICAR FACTURA
    function modificar_factura(id) {
        $("#global-loader").fadeIn("slow");

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

                    let p_borrar = $("#tbl_data_detail_edit tbody tr").length;

                    if (p_borrar > 1) {
                        for (let i = 0; i < p_borrar; i++) {
                            //console.log("Borrando fila " + i);
                            $(
                                "#tbl_data_detail_edit tbody tr:eq(" + i + ")"
                            ).remove();
                        }
                    }

                    //PRODUCTOS
                    let contador = 0;
                    productos.forEach((producto) => {
                        if (contador == 0) {
                            setTimeout(() => {
                                $(".producto_edit")
                                    .val(producto.producto)
                                    .trigger("change");
                            }, 1000);
                            //$(".serial_producto_edit").val(producto.serial_producto);
                            $(".seriales_edit").val(producto.serial_producto);
                            $(".descripcion_edit").val(producto.description);
                            //console.log("P1: " + producto.description);
                            $(".cantidad_edit").val(producto.cantidad);
                            $(".valor_edit").val(producto.valor_unitario);
                            $(".descuento_edit").val(producto.descuento);
                            $(
                                ".cargo_edit option[data-impuesto='" +
                                    producto.impuesto_cargo +
                                    "']"
                            )
                                .attr("selected", true)
                                .trigger("change");
                            $(
                                ".retencion_edit option[data-impuesto='" +
                                    producto.impuesto_retencion +
                                    "']"
                            )
                                .attr("selected", true)
                                .trigger("change");
                        }
                        contador++;
                    });

                    for (let i = 0; i < contador - 1; i++) {
                        //console.log("P2: " + productos[i + 1].description);
                        //console.log(productos[i + 1].impuesto_cargo);
                        $("#new_row_edit").trigger("click");
                        setTimeout(() => {
                            $(".producto_edit")
                                .eq(i + 1)
                                .val(productos[i + 1].producto)
                                .trigger("change");
                        }, 1000);
                        //$(".serial_producto_edit").eq(i + 1).val(productos[i + 1].serial_producto);
                        $(".seriales_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].serial_producto);
                        $(".descripcion_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].description);
                        $(".cantidad_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].cantidad);
                        $(".valor_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].valor_unitario);
                        $(".descuento_edit")
                            .eq(i + 1)
                            .val(productos[i + 1].descuento);
                        $(
                            ".cargo_edit option[data-impuesto='" +
                                productos[i + 1].impuesto_cargo +
                                "']"
                        )
                            .eq(i + 1)
                            .attr("selected", true)
                            .trigger("change");
                        $(
                            ".retencion_edit option[data-impuesto='" +
                                productos[i + 1].impuesto_retencion +
                                "']"
                        )
                            .eq(i + 1)
                            .attr("selected", true)
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

                    $("#retefte_edit")
                        .val(data.valor_retefuente)
                        .trigger("change");
                    $("#reteiva_edit")
                        .val(data.valor_reteiva)
                        .trigger("change");
                    $("#reteica_edit")
                        .val(data.valor_reteica)
                        .trigger("change");

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

    $(document).on("click", "#btnEditFactura", function () {
        /* DATOS NOTA CREDITO */
        let tipo_nc = $("#tipo_nc_edit").val();
        let fecha_nc = $("#fecha_nc_edit").val();
        let usuario_nc = $("#vendedor_nc_edit").val();
        let consecutivo_nc = $("#consecutivo_nc_edit").val();
        let motivo_nc = $("#motivo_nc_edit").val();

        /* DATOS FACTURA */
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

        if (!tipo_nc) {
            toastr.error('Debe seleccionar un tipo de nota crédito');
            return false;
        } else if (!fecha_nc) {
            toastr.error('Debe ingresar una fecha');
            return false;
        } else if (consecutivo_nc < 1) {
            toastr.error('Debe ingresar un consecutivo de nota crédito válido');
            return false;
        } else if (!motivo_nc) {
            toastr.error('Debe ingresar un motivo válido');
            return false;
        }

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
            formData.append("tipo_nc", tipo_nc);
            formData.append("fecha_nc", fecha_nc);
            formData.append("usuario_nc", usuario_nc);
            formData.append("consecutivo_nc", consecutivo_nc);
            formData.append("motivo_nc", motivo_nc);
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

            $.ajax({
                url: "nota_credito_venta_add",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success('Nota crédito creada con éxito');
                        setTimeout(function () {
                            window.location.href = "factura_venta";
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
});
