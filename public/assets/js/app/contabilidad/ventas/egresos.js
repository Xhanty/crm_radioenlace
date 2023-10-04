$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $(".open-toggle").trigger("click");

    $(document).on("keyup", ".input_dinner", function () {
        let v = $(this).val().replace(/\D+/g, "");
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v
                .replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, "$1.")
        );
    });

    $(document).on("click", ".comprobante_btn", function () {
        let id = $(this).data("id");
        let grupo = $(this).data("grupo");
        $("#content_loader").removeClass("d-none");
        $("#content_factura").addClass("d-none");

        $(".comprobante_btn").removeClass("selected");
        $(this).addClass("selected");

        if (grupo == 1) {
            $.ajax({
                url: "recibos_info_pagos_grupales",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        let total_final = 0;
                        let valor = data.valor;

                        valor = valor.split(",");
                        valor = valor[0];
                        valor = valor.replaceAll(".", "");
                        valor = parseInt(valor);

                        total_final = valor;
                        var fecha_compra = new Date(data.fecha_elaboracion);
                        $("#proveedor_view").html(data.cliente);
                        $("#nit_view").html(
                            data.nit +
                                "-" +
                                data.codigo_verificacion +
                                "<br>" +
                                data.telefono_fijo +
                                "<br>" +
                                data.ciudad +
                                " - Colombia"
                        );

                        $("#num_fact_view").html(data.numero);
                        $("#num_fact_view_siigo").html(data.numero_siigo);
                        $("#compra_view").html(
                            fecha_compra.getDate() +
                                "/" +
                                (fecha_compra.getMonth() + 1) +
                                "/" +
                                fecha_compra.getFullYear()
                        );
                        $("#vencimiento_view").html(data.forma_pago);
                        $("#pagar_view").html(data.valor);
                        $(".btn_imprimir_factura").attr(
                            "href",
                            "recibos_pagos_pdf?token=" + data.id + "&grupal=1"
                        );

                        $(".btn_options_factura").attr("data-id", data.id);

                        $("#title_factura").html("RECIBO CAJA");
                        $("#factura_tlt_2").html("Recibo No.");

                        $("#productos_view").empty();
                        
                        let append_facturas = "";
                        let count = 0;
                        data.facturas.forEach((element) => {
                            if (count > 0) {
                                append_facturas += "<br>";
                            }

                            append_facturas += "<span>Abono" + "</span>" + '<span style="margin-left:111px">FE-' + element.factura.numero + "</span> <span style='margin-left:60px'>Valor: " + element.valor + "</span>";
                            count++;
                        });

                        $("#productos_view").append(
                            "<tr>" +
                                '<td colspan="5">' +
                                append_facturas +                                
                                "<br>" +
                                "<br>" +
                                data.forma_pago +
                                "</td>" +
                                '<td style="text-align: right;">' +
                                "<br>" +
                                "<b>Total COP:</b>&nbsp&nbsp&nbsp&nbsp&nbsp" +
                                total_final.toLocaleString("es-ES", {
                                    minimumFractionDigits: 2,
                                }) +
                                "" +
                                "</td>" +
                                "</tr>"
                        );

                        if (data.observacion) {
                            data.observacion =
                                '<label class="main-content-label tx-13">Observaciones</label>' +
                                "<p>" +
                                data.observacion +
                                "</p>";
                        } else {
                            data.observacion = "";
                        }

                        if (data.adjunto_pdf) {
                            data.adjunto_pdf =
                                '<label class="main-content-label tx-13">Adjunto</label><br>' +
                                '<a href="' +
                                url_general +
                                "images/contabilidad/recibos_caja/" +
                                data.adjunto_pdf +
                                '" target="_blank">Visualizar</a>';
                        } else {
                            data.adjunto_pdf = "";
                        }

                        $("#productos_view").append(
                            "<tr>" +
                                '<td class="valign-middle" colspan="4" rowspan="2">' +
                                '<div class="invoice-notes">' +
                                data.observacion +
                                "<br>" +
                                data.adjunto_pdf +
                                "</div>" +
                                "</td>" +
                                "</tr>"
                        );

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
        } else {
            $.ajax({
                url: "recibos_info_pagos",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        let lleva = response.cuotas;
                        let total_final = 0;
                        let valor_1 = data.valor_factura;
                        let valor_2 = data.valor;
                        
                        let factura = response.data.factura;
                        let impuestos_1 = JSON.parse(factura.impuestos_1);
                        let sum_impuestos_1 = 0;

                        let subtotal_num = factura.subtotal.split(',');
                        subtotal_num = subtotal_num[0];
                        subtotal_num = subtotal_num.replaceAll('.', '');
                        subtotal_num = parseInt(subtotal_num);

                        let retenciones_html = '';

                        if (impuestos_1) {
                            for (var i = 0; i < impuestos_1.length; i++) {
                                let valor = parseInt(impuestos_1[i][1]);
                                sum_impuestos_1 += valor;
                            }
                        }

                        if(factura.valor_retefuente) {
                            let valor = (subtotal_num * (factura.valor_retefuente / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            retenciones_html += '<span>Rte Fte: ' + factura.valor_retefuente + '% <b>(' + valor + ')</b></span><br>';
                        }
                        
                        if (factura.valor_reteiva) {
                            let valor = (sum_impuestos_1 * (factura.valor_reteiva / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            retenciones_html += '<span>Rte Iva: ' + factura.valor_reteiva + '% <b>(' + valor + ')</b></span><br>';
                        } 
                        
                        if (factura.valor_reteica) {
                            let valor = ((subtotal_num *  factura.valor_reteica) / 1000).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            retenciones_html += '<span>Rte Ica: ' + factura.valor_reteica + '% <b>(' + valor + ')</b></span><br>';
                        }

                        valor_1 = valor_1.split(",");
                        valor_1 = valor_1[0];
                        valor_1 = valor_1.replaceAll(".", "");
                        valor_1 = parseInt(valor_1);

                        valor_2 = valor_2.split(",");
                        valor_2 = valor_2[0];
                        valor_2 = valor_2.replaceAll(".", "");
                        valor_2 = parseInt(valor_2);

                        total_final = valor_1 - valor_2;

                        console.log(factura);


                        var fecha_compra = new Date(data.fecha_elaboracion);
                        $("#proveedor_view").html(data.cliente);
                        $("#nit_view").html(
                            data.nit +
                                "-" +
                                data.codigo_verificacion +
                                "<br>" +
                                data.telefono_fijo +
                                "<br>" +
                                data.ciudad +
                                " - Colombia"
                        );

                        $("#num_fact_view").html(data.numero);
                        $("#num_fact_view_siigo").html(data.numero_siigo);
                        $("#compra_view").html(
                            fecha_compra.getDate() +
                                "/" +
                                (fecha_compra.getMonth() + 1) +
                                "/" +
                                fecha_compra.getFullYear()
                        );
                        $("#vencimiento_view").html(data.forma_pago);
                        $("#pagar_view").html(data.valor);
                        $(".btn_imprimir_factura").attr(
                            "href",
                            "recibos_pagos_pdf?token=" + data.id
                        );

                        $(".btn_options_factura").attr("data-id", data.id);

                        $("#title_factura").html("RECIBO CAJA");
                        $("#factura_tlt_2").html("Recibo No.");

                        $("#productos_view").empty();

                        if (lleva) {
                            lleva.forEach((element) => {
                                let valor = element.valor;
                                valor = valor.split(",");
                                valor = valor[0];
                                valor = valor.replaceAll(".", "");
                                valor = parseInt(valor);

                                valor_1 = valor_1 - valor;
                                total_final = total_final - valor;
                            });
                        }

                        $("#productos_view").append(
                            "<tr>" +
                                '<td colspan="5">' +
                                "<span>Abono" +
                                "</span>" +
                                '<span style="margin-left:111px">FCE-' +
                                data.numero_factura +
                                "</span>" +
                                '<span style="margin-left:60px">Cuota ' +
                                response.cuota +
                                "</span>" +
                                '<span style="margin-left:22px">' +
                                fecha_compra.getDate() +
                                "/" +
                                (fecha_compra.getMonth() + 1) +
                                "/" +
                                fecha_compra.getFullYear() +
                                "</span>" +
                                //"<br>" +
                                //retenciones_html +
                                "<br>" +
                                "<br>" +
                                data.forma_pago +
                                "</td>" +
                                '<td style="text-align: right;">' +
                                valor_1.toLocaleString("es-ES", {
                                    minimumFractionDigits: 2,
                                }) +
                                "<br>" +
                                "<b>-" +
                                data.valor +
                                "</b>" +
                                "<br>" +
                                "<b>Total COP:</b>&nbsp&nbsp&nbsp&nbsp&nbsp" +
                                total_final.toLocaleString("es-ES", {
                                    minimumFractionDigits: 2,
                                }) +
                                "" +
                                "</td>" +
                                "</tr>"
                        );

                        if (data.observacion) {
                            data.observacion =
                                '<label class="main-content-label tx-13">Observaciones</label>' +
                                "<p>" +
                                data.observacion +
                                "</p>";
                        } else {
                            data.observacion = "";
                        }

                        if (data.adjunto_pdf) {
                            data.adjunto_pdf =
                                '<label class="main-content-label tx-13">Adjunto</label><br>' +
                                '<a href="' +
                                url_general +
                                "images/contabilidad/recibos_caja/" +
                                data.adjunto_pdf +
                                '" target="_blank">Visualizar</a>';
                        } else {
                            data.adjunto_pdf = "";
                        }

                        $("#productos_view").append(
                            "<tr>" +
                                '<td class="valign-middle" colspan="4" rowspan="2">' +
                                '<div class="invoice-notes">' +
                                data.observacion +
                                "<br>" +
                                data.adjunto_pdf +
                                "</div>" +
                                "</td>" +
                                "</tr>"
                        );

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
        }
    });

    $("#btnNew").click(function () {
        $("#cliente_select_add").val("").trigger("change");
        $("#modalCliente").modal("show");
    });

    $("#btn_select_add").click(function () {
        let cliente = $("#cliente_select_add").val();

        if (!cliente || cliente < 1) {
            toastr.error("Debe seleccionar un cliente");
        } else {
            $.ajax({
                url: "recibos_info_cliente",
                type: "POST",
                data: {
                    cliente: cliente,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1 && response.facturas.length > 0) {
                        let facturas = response.facturas;
                        let total = 0;
                        let total_pendiente = 0;

                        $("#tbl_facturas_list").empty();
                        facturas.forEach((element) => {
                            let valor = element.valor_total.split(",");
                            valor = valor[0];
                            valor = valor.replaceAll(".", "");
                            total += parseInt(valor);
                            let pendiente = parseInt(valor);
                            let impuestos_1 = JSON.parse(element.impuestos_1);
                            let sum_impuestos_1 = 0;

                            if (element.pagos && element.pagos.length > 0) {
                                element.pagos.forEach((element) => {
                                    let valor2 = element.valor.split(",");
                                    valor2 = valor2[0];
                                    valor2 = valor2.replaceAll(".", "");
                                    pendiente = pendiente - parseInt(valor2);
                                });
                            }

                            let subtotal_num = element.subtotal.split(',');
                            subtotal_num = subtotal_num[0];
                            subtotal_num = subtotal_num.replaceAll('.', '');
                            subtotal_num = parseInt(subtotal_num);

                            let retenciones_html = '';

                            if (impuestos_1) {
                                for (var i = 0; i < impuestos_1.length; i++) {
                                    let valor = parseInt(impuestos_1[i][1]);
                                    sum_impuestos_1 += valor;
                                }
                            }

                            if(element.valor_retefuente) {
                                let valor = (subtotal_num * (element.valor_retefuente / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                retenciones_html += '<span>Rte Fte: ' + element.valor_retefuente + '% <b>(' + valor + ')</b></span><br>';
                            }
                            
                            if (element.valor_reteiva) {
                                let valor = (sum_impuestos_1 * (element.valor_reteiva / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                retenciones_html += '<span>Rte Iva: ' + element.valor_reteiva + '% <b>(' + valor + ')</b></span><br>';
                            } 
                            
                            if (element.valor_reteica) {
                                let valor = ((subtotal_num *  element.valor_reteica) / 1000).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                retenciones_html += '<span>Rte Ica: ' + element.valor_reteica + '% <b>(' + valor + ')</b></span><br>';
                            }

                            total_pendiente += pendiente;
                            $("#tbl_facturas_list").append(
                                "<tr>" +
                                    '<td class="text-center pad-4"><input data-id="' +
                                    element.id +
                                    '" type="checkbox" class="check_fc_add"></td>' +
                                    '<td class="text-center pad-4"><a href="' + url_general + 'pdf_factura_venta?token=' + element.id + '" target="_blank">FE-' +
                                    element.numero +
                                    "</a></td>" +
                                    '<td class="text-center pad-4">' +
                                    retenciones_html +
                                    "</td>" +
                                    '<td class="text-center pad-4">' +
                                    element.valor_total +
                                    "</td>" +
                                    '<td class="text-center pad-4">' +
                                    pendiente.toLocaleString("de-DE", {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }) +
                                    "</td>" +
                                    '<td class="text-center pad-4"><input type="text" disabled style="text-align: right"; class="form-control input_dinner valor_add" placeholder="Ingrese un valor"></td>'
                            );
                        });

                        $("#cliente_add").val(cliente).trigger("change");
                        $("#total_saldo").html(
                            total.toLocaleString("de-DE", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            })
                        );
                        $("#total_saldo_pendiente").html(
                            total_pendiente.toLocaleString("de-DE", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            })
                        );
                        $("#content_list").addClass("d-none");
                        $("#content_add").removeClass("d-none");
                        $("#modalCliente").modal("hide");
                    } else if (
                        response.info == 1 &&
                        response.facturas.length < 1
                    ) {
                        $("#modalCliente").modal("hide");
                        toastr.error("El cliente no tiene facturas pendientes");
                    } else {
                        $("#modalCliente").modal("hide");
                        toastr.error("Error al cargar los datos del cliente");
                    }
                },
            });
        }
    });

    $(document).on("change", ".check_fc_add", function () {
        //Habilitar o deshabilitar el input
        let check = $(this).prop("checked");

        if (check) {
            $(this)
                .closest("tr")
                .find("input[type=text]")
                .prop("disabled", false);
        } else {
            $(this)
                .closest("tr")
                .find("input[type=text]")
                .prop("disabled", true);
            $(this).closest("tr").find("input[type=text]").val("");
            $(".valor_add").trigger("change");
        }
    });

    $(document).on("change", ".valor_add", function () {
        // Recorrer los inputs
        let total = 0;
        $(".valor_add").each(function () {
            let v = $(this).val();
            v = v.split(",");
            v = v[0];
            v = v.replaceAll(".", "");
            v = parseInt(v);

            if (v > 0) {
                total += v;
            }
        });
        $("#saldo_pagado").html(
            total.toLocaleString("de-DE", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
    });

    $("#btnAddPago").click(function () {
        let cliente = $("#cliente_add").val();
        let tipo = $("#tipo_add").val();
        let fecha = $("#fecha_add").val();
        let numero = $("#numero_add").val();
        let numero_siigo = $("#numero_siigo_add").val();
        let transaccion = $("#transaccion_add").val();
        let forma_pago = $("#formas_pago_add").val();
        let pagado = $("#valor_add").val();
        let total_pagado = $("#saldo_pagado").html();
        let observacion = $("#observaciones_add").val();

        let facturas = [];
        let validar = 0;

        $(".check_fc_add").each(function () {
            if ($(this).prop("checked")) {
                let id = $(this).data("id");
                let pendiente = $(this).closest("tr").find("td").eq(2).html();
                let valor = $(this)
                    .closest("tr")
                    .find("input[type=text]")
                    .val();

                pendiente = pendiente.split(",");
                pendiente = pendiente[0];
                pendiente = pendiente.replaceAll(".", "");
                pendiente = parseInt(pendiente);

                if (!valor) {
                    validar = 1;
                } else {
                    valor = valor.split(",");
                    valor = valor[0];
                    valor = valor.replaceAll(".", "");
                    valor = parseInt(valor);

                    if (valor > pendiente) {
                        validar = 1;
                    } else {
                        facturas.push({
                            id: id,
                            valor: valor.toLocaleString("de-DE", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            }),
                        });
                    }
                }
            }
        });

        pagado = pagado.split(",");
        pagado = pagado[0];
        pagado = pagado.replaceAll(".", "");
        pagado = parseInt(pagado);

        total_pagado = total_pagado.split(",");
        total_pagado = total_pagado[0];
        total_pagado = total_pagado.replaceAll(".", "");
        total_pagado = parseInt(total_pagado);

        if (tipo == "") {
            toastr.error("Seleccione un tipo");
            return false;
        } else if (numero_siigo < 1) {
            toastr.error("Ingrese un número siigo");
            return false;
        } else if (forma_pago == "") {
            toastr.error("Seleccione dónde ingresa el dinero");
            return false;
        } else if (pagado < 1) {
            toastr.error("Ingrese un valor a pagar");
            return false;
        } else if (pagado != total_pagado) {
            toastr.error("El valor a pagado no coincide con el valor total");
            return false;
        } else if (validar == 1) {
            toastr.error("Revisa los valores a pagar");
            return false;
        } else if (observacion == "") {
            toastr.error("Ingrese una observación");
            return false;
        } else {
            let formData = new FormData();
            formData.append("cliente", cliente);
            formData.append("tipo", tipo);
            formData.append("fecha", fecha);
            formData.append("numero", numero);
            formData.append("numero_siigo", numero_siigo);
            formData.append("transaccion", transaccion);
            formData.append("forma_pago", forma_pago);
            formData.append(
                "pagado",
                pagado.toLocaleString("de-DE", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            );
            formData.append("facturas", JSON.stringify(facturas));
            formData.append("observacion", observacion);
            formData.append("archivo", $("#factura_add")[0].files[0]);

            $("#btnAddPago").prop("disabled", true);
            $("#btnAddPago").html(
                '<i class="fa fa-spinner fa-spin"></i> Procesando...'
            );
            $.ajax({
                url: "recibo_pago_grupo_add",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Pago guardado correctamente");
                        window.location.href = url_general + "recibos_pagos";
                    } else {
                        toastr.error("Error al guardar el pago");
                    }

                    $("#btnAddPago").prop("disabled", false);
                    $("#btnAddPago").html("Guardar Pago");
                },
                error: function (error) {
                    toastr.error("Error al guardar el pago");
                    $("#btnAddPago").prop("disabled", false);
                    $("#btnAddPago").html("Guardar Pago");
                },
            });
        }
    });
});
