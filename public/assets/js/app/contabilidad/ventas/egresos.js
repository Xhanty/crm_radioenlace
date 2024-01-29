$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    var rete_fuentes = JSON.parse(localStorage.getItem("rete_fuentes"));
    var rete_ivas = JSON.parse(localStorage.getItem("rete_iva"));
    var rete_icas = JSON.parse(localStorage.getItem("rete_ica"));

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

    $(document).on("keyup", ".input_dinner_valor", function () {
        $(this).val(function (index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    $(document).on("change", ".input_dinner_valor", function () {
        let valor = $(this).val();
        valor = valor.replaceAll('.', '');
        valor = parseInt(valor);
        valor = valor + "00";

        let v = valor.replace(/\D+/g, '');
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v.replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, '$1.'));
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
                        let total_pg = 0;
                        let total_pendiente = 0;

                        $("#tbl_facturas_list").empty();
                        facturas.forEach((element) => {
                            let valor = element.valor_total.split(",");
                            valor = valor[0];
                            valor = valor.replaceAll(".", "");
                            total += parseInt(valor);
                            total_pg = parseInt(valor);
                            let pendiente = parseInt(valor);
                            let impuestos_1 = JSON.parse(element.impuestos_1);
                            let sum_impuestos_1 = 0;
                            let factura_id = element.id;

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

                            let valor_rte_fuente = 0;
                            let valor_rte_iva = 0;
                            let valor_rte_ica = 0;
                            
                            if (element.pagos && element.pagos.length > 0) {
                                element.pagos.forEach((element) => {
                                    let facturas_json = JSON.parse(element.grupo_facturas);
                                    facturas_json.forEach((element2) => {
                                        if(element2.id == factura_id) {
                                            let rte_fuente_val = element2.rte_fuente ?? null;
                                            let rte_iva_val = element2.rte_iva ?? null;
                                            let rte_ica_val = element2.rte_ica ?? null;
                                            let valor = element2.valor.split(",");
                                            valor = valor[0];
                                            valor = valor.replaceAll(".", "");
                                            pendiente = pendiente - parseInt(valor);
                                            
                                            // Buscar los option por data-id y seleccionarlos
                                            if(rte_fuente_val) {
                                                valor_rte_fuente = rte_fuente_val;
                                            }

                                            if(rte_iva_val) {
                                                valor_rte_iva = rte_iva_val;
                                            }

                                            if(rte_ica_val) {
                                                valor_rte_ica = rte_ica_val;
                                            }
                                        }
                                    });
                                });
                            }

                            retenciones_html += '<div class="row"><div class="col-6">' +
                                    '<select data-total="' + total_pg + '" data-pendiente="' + pendiente + '" data-id="' + factura_id + '" data-subtotal="' + subtotal_num + '" title="Rte Fte: (%)" class="form-select rte_fuente">' +
                                    '<option value="">Selecciona una opción</option>' +
                                    rete_fuentes.map((element) => {
                                        /*if(valor_rte_fuente > 0 && element.id == valor_rte_fuente) {
                                            return '<option data-id="' + element.id + '" value="' + element.tarifa + '" selected>' + element.nombre + '</option>';
                                        }*/
                                        return '<option data-id="' + element.id + '" value="' + element.tarifa + '">' + element.nombre + '</option>';
                                    }) +
                                    '</select></div>' +
                                    '<div class="col-6"><span class="txt_rte_fte">Rte Fte: 0% <b>(0.00)</b></span><br></div></div><br>';

                            retenciones_html += '<div class="row"><div class="col-6">' +
                                    '<select data-total="' + total_pg + '" data-pendiente="' + pendiente + '" data-id="' + factura_id + '" data-subtotal="' + sum_impuestos_1 + '" title="Rte Iva: (%)" class="form-select rte_iva">' +
                                    '<option value="">Selecciona una opción</option>' +
                                    rete_ivas.map((element) => {
                                        /*if(valor_rte_iva > 0 && element.id == valor_rte_iva) {
                                            return '<option data-id="' + element.id + '" value="' + element.tarifa + '" selected>' + element.nombre + '</option>';
                                        }*/
                                        return '<option data-id="' + element.id + '" value="' + element.tarifa + '">' + element.nombre + '</option>';
                                    }) +
                                    '</select></div>' +
                                    '<div class="col-6"><span class="txt_rte_iva">Rte Iva: 0% <b>(0.00)</b></span><br></div></div><br>';

                            retenciones_html += '<div class="row"><div class="col-6">' +
                                    '<select data-total="' + total_pg + '" data-pendiente="' + pendiente + '" data-id="' + factura_id + '" data-subtotal="' + subtotal_num + '" title="Rte Ica: (%)" class="form-select rte_ica">' +
                                    '<option value="">Selecciona una opción</option>' +
                                    rete_icas.map((element) => {
                                        /*if(valor_rte_ica > 0 && element.id == valor_rte_ica) {
                                            return '<option data-id="' + element.id + '" value="' + element.tarifa + '" selected>' + element.nombre + '</option>';
                                        }*/
                                        return '<option data-id="' + element.id + '" value="' + element.tarifa + '">' + element.nombre + '</option>';
                                    }) +
                                    '</select></div>' +
                                    '<div class="col-6"><span class="txt_rte_ica">Rte Ica: 0% <b>(0.00)</b></span><br></div></div><br>';

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
                                    '<td class="text-center saldo_total pad-4">' +
                                    element.valor_total +
                                    "</td>" +
                                    '<td class="text-center saldo_pendiente pad-4">' +
                                    pendiente.toLocaleString("de-DE", {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }) +
                                    "</td>" +
                                    '<td class="text-center pad-4"><input type="text" disabled style="text-align: right"; class="form-control input_dinner valor_add" placeholder="Ingrese un valor"></td>'
                            );
                        });

                        $("#cliente_add").val(cliente).trigger("change");

                        $("#valor_facturas").html(
                            total.toLocaleString("de-DE", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            })
                        );

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

                        $(".form-select").each(function () {
                            $(this).select2({
                                dropdownParent: $(this).parent(),
                                placeholder: "Seleccione",
                                searchInputPlaceholder: "Buscar",
                                allowClear: true,
                            });
                        });

                        $(".rte_fuente").trigger("change");
                        $(".rte_iva").trigger("change");
                        $(".rte_ica").trigger("change");

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
            let valor_pagar = $(this).closest("tr").find("td").eq(5).html();
            console.log(valor_pagar);
            $(this)
                .closest("tr")
                .find("input[type=text]")
                .prop("disabled", false);

            $(this).closest("tr").find("input[type=text]").val(valor_pagar);
            $(".valor_add").trigger("change");
        } else {
            $(this)
                .closest("tr")
                .find("input[type=text]")
                .prop("disabled", true);
            $(this).closest("tr").find("input[type=text]").val("");
            $(".valor_add").trigger("change");
        }
    });

    $(document).on("change", ".check_fc_edit", function () {
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
            $(".valor_edit").trigger("change");
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

    $(document).on("change", ".valor_edit", function () {
        // Recorrer los inputs
        let total = 0;
        $(".valor_edit").each(function () {
            let v = $(this).val();
            v = v.split(",");
            v = v[0];
            v = v.replaceAll(".", "");
            v = parseInt(v);

            if (v > 0) {
                total += v;
            }
        });
        $("#saldo_pagado_edit").html(
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
                let rte_fuente = $(this).closest("tr").find(".rte_fuente option:selected").data("id");
                let rte_iva = $(this).closest("tr").find(".rte_iva option:selected").data("id");
                let rte_ica = $(this).closest("tr").find(".rte_ica option:selected").data("id");
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
                            rte_fuente: rte_fuente,
                            rte_iva: rte_iva,
                            rte_ica: rte_ica,
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
        }/* else if (numero_siigo < 1) {
            toastr.error("Ingrese un número siigo");
            return false;
        }*/ else if (forma_pago == "") {
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
        } /*else if (observacion == "") {
            toastr.error("Ingrese una observación");
            return false;
        }*/ else {
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
    
    $(document).on("change", ".rte_fuente", function () {
        let valor = $(this).val();
        let valor_total = $(this).data("subtotal");
        let total = $(this).data("total");
        let pendiente = $(this).data("pendiente");
        pendiente = parseInt(pendiente);
        total = parseInt(total);
        valor_total_num = parseInt(valor_total);

        if (valor > 0) {
            total = total - (valor_total_num * (valor / 100));
            valor_rte_txt = (valor_total_num * (valor / 100));
            let valor_rte = (valor_total_num * (valor / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $(this).closest("tr").find(".txt_rte_fte").html("Rte Fte: " + valor + "% <b>(" + valor_rte + ")</b>");
            $(this).closest("tr").find(".saldo_total").html(total.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $(this).closest("tr").find(".saldo_pendiente").html((pendiente - valor_rte_txt).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $(this).closest("tr").find(".txt_rte_fte").html("Rte Fte: 0% <b>(0.00)</b>");
        }
    });

    $(document).on("change", ".rte_iva", function () {
        let valor = $(this).val();
        let valor_total = $(this).data("subtotal");
        let total = $(this).data("total");
        let pendiente = $(this).data("pendiente");
        pendiente = parseInt(pendiente);
        total = parseInt(total);
        valor_total_num = parseInt(valor_total);

        if (valor > 0) {
            total = total - (valor_total_num * (valor / 100));
            valor_rte_txt = (valor_total_num * (valor / 100));
            let valor_rte = (valor_total_num * (valor / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $(this).closest("tr").find(".txt_rte_iva").html("Rte Iva: " + valor + "% <b>(" + valor_rte + ")</b>");
            $(this).closest("tr").find(".saldo_total").html(total.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $(this).closest("tr").find(".saldo_pendiente").html((pendiente - valor_rte_txt).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $(this).closest("tr").find(".txt_rte_iva").html("Rte Iva: 0% <b>(0.00)</b>");
        }
    });

    $(document).on("change", ".rte_ica", function () {
        let valor = $(this).val();
        let valor_total = $(this).data("subtotal");
        let total = $(this).data("total");
        let pendiente = $(this).data("pendiente");
        pendiente = parseInt(pendiente);
        total = parseInt(total);
        valor_total_num = parseInt(valor_total);

        if (valor > 0) {
            total = total - (valor_total_num * valor) / 1000;
            valor_rte_txt = (valor_total_num * valor) / 1000;
            let valor_rte = ((valor_total_num * valor) / 1000).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $(this).closest("tr").find(".txt_rte_ica").html("Rte Ica: " + valor + "% <b>(" + valor_rte + ")</b>");
            $(this).closest("tr").find(".saldo_total").html(total.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $(this).closest("tr").find(".saldo_pendiente").html((pendiente - valor_rte_txt).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $(this).closest("tr").find(".txt_rte_ica").html("Rte Ica: 0% <b>(0.00)</b>");
        }
    });

    $(document).on("click", ".btn_options_factura", function () {
        let id = $(this).attr("data-id");
        let opcion = $(this).attr("data-opcion");

        if (opcion == 0) {
            modificar_pago(id);
        } else if (opcion == 1) {
            anular_pago(id);
        }
    });

    // ANULAR PAGO
    function anular_pago(id) {
        Swal.fire({
            title: '¿Está seguro de anular este recibo de caja?',
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
                    url: "anular_recibo_caja",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success('Recibo de caja anulado con éxito');
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

    // MODIFICAR PAGO
    function modificar_pago(id) {
        $.ajax({
            url: "data_recibos_info",
            type: "POST",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1 && response.facturas.length > 0) {
                    let facturas = response.facturas;
                    let recibo = response.recibo;
                    let cliente = recibo.cliente_id;
                    let total = 0;
                    let total_pg = 0;
                    let total_pendiente = 0;

                    $("#id_edit_pago").val(id);
                    $("#tipo_edit").val(1).trigger("change");
                    $("#fecha_edit").val(recibo.fecha_elaboracion);
                    $("#numero_edit").val(recibo.numero);
                    $("#numero_siigo_edit").val(recibo.numero_siigo);
                    $("#transaccion_edit").val(1);
                    $("#formas_pago_edit").val(recibo.forma_pago).trigger("change");
                    $("#valor_edit").val(recibo.valor);
                    $("#observaciones_edit").val(recibo.observacion);

                    $("#tbl_facturas_list_edit").empty();
                    facturas.forEach((element) => {
                        let valor = element.valor_total.split(",");
                        valor = valor[0];
                        valor = valor.replaceAll(".", "");
                        total += parseInt(valor);
                        total_pg = parseInt(valor);
                        let pendiente = parseInt(valor);
                        let impuestos_1 = JSON.parse(element.impuestos_1);
                        let sum_impuestos_1 = 0;
                        let factura_id = element.id;

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

                        let valor_rte_fuente = 0;
                        let valor_rte_iva = 0;
                        let valor_rte_ica = 0;
                        let valor_pago = 0;
                        
                        if (element.pagos && element.pagos.length > 0) {
                            element.pagos.forEach((element) => {
                                let facturas_json = JSON.parse(element.grupo_facturas);
                                facturas_json.forEach((element2) => {
                                    if(element2.id == factura_id) {
                                        let rte_fuente_val = element2.rte_fuente ?? null;
                                        let rte_iva_val = element2.rte_iva ?? null;
                                        let rte_ica_val = element2.rte_ica ?? null;
                                        let valor = element2.valor.split(",");
                                        valor = valor[0];
                                        valor = valor.replaceAll(".", "");
                                        pendiente = pendiente - parseInt(valor);
                                        valor_pago = parseInt(valor);
                                        
                                        // Buscar los option por data-id y seleccionarlos
                                        if(rte_fuente_val) {
                                            valor_rte_fuente = rte_fuente_val;
                                        }

                                        if(rte_iva_val) {
                                            valor_rte_iva = rte_iva_val;
                                        }

                                        if(rte_ica_val) {
                                            valor_rte_ica = rte_ica_val;
                                        }
                                    }
                                });
                            });
                        }

                        retenciones_html += '<div class="row"><div class="col-6">' +
                                '<select data-total="' + total_pg + '" data-pendiente="' + pendiente + '" data-id="' + factura_id + '" data-subtotal="' + subtotal_num + '" title="Rte Fte: (%)" class="form-select rte_fuente_edit">' +
                                '<option value="">Selecciona una opción</option>' +
                                rete_fuentes.map((element) => {
                                    if(valor_rte_fuente > 0 && element.id == valor_rte_fuente) {
                                        return '<option data-id="' + element.id + '" value="' + element.tarifa + '" selected>' + element.nombre + '</option>';
                                    }
                                    return '<option data-id="' + element.id + '" value="' + element.tarifa + '">' + element.nombre + '</option>';
                                }) +
                                '</select></div>' +
                                '<div class="col-6"><span class="txt_rte_fte_edit">Rte Fte: 0% <b>(0.00)</b></span><br></div></div><br>';

                        retenciones_html += '<div class="row"><div class="col-6">' +
                                '<select data-total="' + total_pg + '" data-pendiente="' + pendiente + '" data-id="' + factura_id + '" data-subtotal="' + sum_impuestos_1 + '" title="Rte Iva: (%)" class="form-select rte_iva_edit">' +
                                '<option value="">Selecciona una opción</option>' +
                                rete_ivas.map((element) => {
                                    if(valor_rte_iva > 0 && element.id == valor_rte_iva) {
                                        return '<option data-id="' + element.id + '" value="' + element.tarifa + '" selected>' + element.nombre + '</option>';
                                    }
                                    return '<option data-id="' + element.id + '" value="' + element.tarifa + '">' + element.nombre + '</option>';
                                }) +
                                '</select></div>' +
                                '<div class="col-6"><span class="txt_rte_iva_edit">Rte Iva: 0% <b>(0.00)</b></span><br></div></div><br>';

                        retenciones_html += '<div class="row"><div class="col-6">' +
                                '<select data-total="' + total_pg + '" data-pendiente="' + pendiente + '" data-id="' + factura_id + '" data-subtotal="' + subtotal_num + '" title="Rte Ica: (%)" class="form-select rte_ica_edit">' +
                                '<option value="">Selecciona una opción</option>' +
                                rete_icas.map((element) => {
                                    if(valor_rte_ica > 0 && element.id == valor_rte_ica) {
                                        return '<option data-id="' + element.id + '" value="' + element.tarifa + '" selected>' + element.nombre + '</option>';
                                    }
                                    return '<option data-id="' + element.id + '" value="' + element.tarifa + '">' + element.nombre + '</option>';
                                }) +
                                '</select></div>' +
                                '<div class="col-6"><span class="txt_rte_ica_edit">Rte Ica: 0% <b>(0.00)</b></span><br></div></div><br>';

                        total_pendiente += pendiente;

                        let html_pago = '<td class="text-center pad-4"><input type="text" disabled style="text-align: right"; class="form-control input_dinner valor_edit" placeholder="Ingrese un valor"></td>';
                        let html_check = '<td class="text-center pad-4"><input data-id="' + element.id + '" type="checkbox" class="check_fc_edit"></td>';

                        if(valor_pago > 0) {
                            html_pago = '<td class="text-center pad-4"><input type="text" style="text-align: right"; class="form-control input_dinner valor_edit" placeholder="Ingrese un valor" value="' + valor_pago.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '"></td>';
                        }

                        if(valor_pago > 0) {
                            html_check = '<td class="text-center pad-4"><input data-id="' + element.id + '" type="checkbox" class="check_fc_edit" checked></td>';
                        }

                        $("#tbl_facturas_list_edit").append(
                            "<tr>" +
                                html_check +
                                '<td class="text-center pad-4"><a href="' + url_general + 'pdf_factura_venta?token=' + element.id + '" target="_blank">FE-' +
                                element.numero +
                                "</a></td>" +
                                '<td class="text-center pad-4">' +
                                retenciones_html +
                                "</td>" +
                                '<td class="text-center pad-4">' +
                                element.valor_total +
                                "</td>" +
                                '<td class="text-center saldo_total_edit pad-4">' +
                                element.valor_total +
                                "</td>" +
                                '<td class="text-center saldo_pendiente_edit pad-4">' +
                                pendiente.toLocaleString("de-DE", {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }) +
                                "</td>" +
                                html_pago
                        );
                    });

                    $("#cliente_edit").val(cliente).trigger("change");

                    $("#valor_facturas_edit").html(
                        total.toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );

                    $("#total_saldo_edit").html(
                        total.toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );

                    $("#total_saldo_pendiente_edit").html(
                        total_pendiente.toLocaleString("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );

                    $("#content_list").addClass("d-none");
                    $("#content_edit").removeClass("d-none");

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });

                    $(".rte_fuente_edit").trigger("change");
                    $(".rte_iva_edit").trigger("change");
                    $(".rte_ica_edit").trigger("change");

                } else if (
                    response.info == 1 &&
                    response.facturas.length < 1
                ) {
                    toastr.error("Error al cargar los datos del recibo");
                } else {
                    toastr.error("Error al cargar los datos del recibo");
                }
            },
        });
    }

    $(document).on("change", ".rte_fuente_edit", function () {
        let valor = $(this).val();
        let valor_total = $(this).data("subtotal");
        let total = $(this).data("total");
        let pendiente = $(this).data("pendiente");
        pendiente = parseInt(pendiente);
        total = parseInt(total);
        valor_total_num = parseInt(valor_total);

        if (valor > 0) {
            total = total - (valor_total_num * (valor / 100));
            valor_rte_txt = (valor_total_num * (valor / 100));
            let valor_rte = (valor_total_num * (valor / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $(this).closest("tr").find(".txt_rte_fte_edit").html("Rte Fte: " + valor + "% <b>(" + valor_rte + ")</b>");
            $(this).closest("tr").find(".saldo_total_edit").html(total.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $(this).closest("tr").find(".saldo_pendiente_edit").html((pendiente - valor_rte_txt).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $(this).closest("tr").find(".txt_rte_fte_edit").html("Rte Fte: 0% <b>(0.00)</b>");
        }
    });

    $(document).on("change", ".rte_iva_edit", function () {
        let valor = $(this).val();
        let valor_total = $(this).data("subtotal");
        let total = $(this).data("total");
        let pendiente = $(this).data("pendiente");
        pendiente = parseInt(pendiente);
        total = parseInt(total);
        valor_total_num = parseInt(valor_total);

        if (valor > 0) {
            total = total - (valor_total_num * (valor / 100));
            valor_rte_txt = (valor_total_num * (valor / 100));
            let valor_rte = (valor_total_num * (valor / 100)).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $(this).closest("tr").find(".txt_rte_iva_edit").html("Rte Iva: " + valor + "% <b>(" + valor_rte + ")</b>");
            $(this).closest("tr").find(".saldo_total_edit").html(total.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $(this).closest("tr").find(".saldo_pendiente_edit").html((pendiente - valor_rte_txt).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $(this).closest("tr").find(".txt_rte_iva_edit").html("Rte Iva: 0% <b>(0.00)</b>");
        }
    });

    $(document).on("change", ".rte_ica_edit", function () {
        let valor = $(this).val();
        let valor_total = $(this).data("subtotal");
        let total = $(this).data("total");
        let pendiente = $(this).data("pendiente");
        pendiente = parseInt(pendiente);
        total = parseInt(total);
        valor_total_num = parseInt(valor_total);

        if (valor > 0) {
            total = total - (valor_total_num * valor) / 1000;
            valor_rte_txt = (valor_total_num * valor) / 1000;
            let valor_rte = ((valor_total_num * valor) / 1000).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $(this).closest("tr").find(".txt_rte_ica_edit").html("Rte Ica: " + valor + "% <b>(" + valor_rte + ")</b>");
            $(this).closest("tr").find(".saldo_total_edit").html(total.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $(this).closest("tr").find(".saldo_pendiente_edit").html((pendiente - valor_rte_txt).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $(this).closest("tr").find(".txt_rte_ica_edit").html("Rte Ica: 0% <b>(0.00)</b>");
        }
    });

    $("#btnEditPago").click(function () {
        let id = $("#id_edit_pago").val();
        let cliente = $("#cliente_edit").val();
        let tipo = $("#tipo_edit").val();
        let fecha = $("#fecha_edit").val();
        let numero = $("#numero_edit").val();
        let numero_siigo = $("#numero_siigo_edit").val();
        let transaccion = $("#transaccion_edit").val();
        let forma_pago = $("#formas_pago_edit").val();
        let pagado = $("#valor_edit").val();
        let total_pagado = $("#saldo_pagado_edit").html();
        let observacion = $("#observaciones_edit").val();

        let facturas = [];
        let validar = 0;

        $(".check_fc_edit").each(function () {
            if ($(this).prop("checked")) {
                let id = $(this).data("id");
                let pendiente = $(this).closest("tr").find("td").eq(2).html();
                let rte_fuente = $(this).closest("tr").find(".rte_fuente_edit option:selected").data("id");
                let rte_iva = $(this).closest("tr").find(".rte_iva_edit option:selected").data("id");
                let rte_ica = $(this).closest("tr").find(".rte_ica_edit option:selected").data("id");
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
                            rte_fuente: rte_fuente,
                            rte_iva: rte_iva,
                            rte_ica: rte_ica,
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
        }/* else if (numero_siigo < 1) {
            toastr.error("Ingrese un número siigo");
            return false;
        }*/ else if (forma_pago == "") {
            toastr.error("Seleccione dónde ingresa el dinero");
            return false;
        } else if (pagado < 1) {
            toastr.error("Ingrese un valor a pagar");
            return false;
        } else if (validar == 1) {
            toastr.error("Revisa los valores a pagar");
            return false;
        }/* else if (observacion == "") {
            toastr.error("Ingrese una observación");
            return false;
        }*/ else {
            let formData = new FormData();
            formData.append("id", id);
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
            formData.append("archivo", $("#factura_edit")[0].files[0]);

            $("#btnEditPago").prop("disabled", true);
            $("#btnEditPago").html(
                '<i class="fa fa-spinner fa-spin"></i> Procesando...'
            );
            $.ajax({
                url: "recibo_pago_grupo_edit",
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

                    $("#btnEditPago").prop("disabled", false);
                    $("#btnEditPago").html("Guardar Pago");
                },
                error: function (error) {
                    toastr.error("Error al guardar el pago");
                    $("#btnEditPago").prop("disabled", false);
                    $("#btnEditPago").html("Guardar Pago");
                },
            });
        }
    });
});

$("#btn_filtrar").click(function () {
    let cliente = $("#cliente_select").val();
    let fecha_inicio = $("#inicio_select").val();
    let fecha_fin = $("#fin_select").val();

    // Validar si todos los campos están vacíos
    if (!cliente && !fecha_inicio && !fecha_fin) {
        toastr.error('Debe ingresar al menos un filtro');
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

    // Validar que la fecha de inicio no sea mayor a la fecha de fin
    if (fecha_inicio && fecha_fin) {
        let fecha_inicio = new Date($("#inicio_select").val());
        let fecha_fin = new Date($("#fin_select").val());

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
            fecha_inicio: fecha_inicio,
            fecha_fin: fecha_fin,
        },
        dataType: "JSON",
        success: function (response) {
            $("#global-loader").fadeOut('slow');
            $("#modalSelectFilter").modal('show');
            if (response.info == 1) {
                let facturas = response.facturas;

                if (!facturas) {
                    toastr.error('No se encontraron recibos de caja');
                } else {
                    console.log(facturas);
                    $("#mainInvoiceList").html("");
                    $("#cant_facturas").html(facturas.length);

                    facturas.forEach(function (factura) {
                        let bg = "";
                        let favorito = "";
                        let tipo = "FE-";
                        let mora_html = "";

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

                        if (factura.status == 0) {
                            bg = "bg-cancel";
                        } else if (factura.status == 2) {
                            bg = "bg-paid";
                        } else {
                            bg = "bg-pending";
                            mora_html = '<span style="color: white" class="badge ' + color + '">' + diasPasados + '</span>';
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

                    //$(".center-div .pagination").remove();
                    //paginacionFacturas();
                    $("#content_factura").addClass("d-none");
                    $("#modalSelectFilter").modal('hide');
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