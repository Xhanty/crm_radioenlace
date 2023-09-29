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

    $(document).on("click", ".comprobante_btn", function () {
        let id = $(this).data("id");
        $("#content_loader").removeClass("d-none");
        $("#content_factura").addClass("d-none");

        $(".comprobante_btn").removeClass("selected");
        $(this).addClass("selected");

        $.ajax({
            url: "compras_info_pago",
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

                    valor_1 = valor_1.split(',');
                    valor_1 = valor_1[0];
                    valor_1 = valor_1.replaceAll('.', '');
                    valor_1 = parseInt(valor_1);

                    valor_2 = valor_2.split(',');
                    valor_2 = valor_2[0];
                    valor_2 = valor_2.replaceAll('.', '');
                    valor_2 = parseInt(valor_2);


                    total_final = valor_1 - valor_2;

                    var fecha_compra = new Date(data.fecha_elaboracion);
                    $("#proveedor_view").html(data.proveedor);
                    $("#nit_view").html(data.nit + '-' + data.codigo_verificacion + "<br>" + data.telefono_fijo + "<br>" + data.ciudad + ' - Colombia');

                    $("#num_fact_view").html(data.numero);
                    $("#compra_view").html(fecha_compra.getDate() + "/" + (fecha_compra.getMonth() + 1) + "/" + fecha_compra.getFullYear());
                    $("#vencimiento_view").html(data.forma_pago);
                    $("#pagar_view").html(data.valor);
                    $(".btn_imprimir_factura").attr("href", "comprobante_egreso_pdf?token=" + data.id);

                    $(".btn_options_factura").attr("data-id", data.id);

                    $("#title_factura").html("COMPROBANTE EGRESO");
                    $("#factura_tlt_2").html("Comprobante No.");

                    $("#productos_view").empty();

                    if (lleva) {
                        lleva.forEach(element => {
                            let valor = element.valor;
                            valor = valor.split(',');
                            valor = valor[0];
                            valor = valor.replaceAll('.', '');
                            valor = parseInt(valor);

                            valor_1 = valor_1 - valor;
                            total_final = total_final - valor;
                        });
                    }

                    $("#productos_view").append(
                        '<tr>' +
                        '<td colspan="5">' +
                        '<span>Abono' + '</span>' +
                        '<span style="margin-left:111px">' + data.factura_proveedor + '-' + data.num_factura_proveedor + '</span>' +
                        '<span style="margin-left:60px">Cuota ' + response.cuota + '</span>' +
                        '<span style="margin-left:22px">' + fecha_compra.getDate() + "/" + (fecha_compra.getMonth() + 1) + "/" + fecha_compra.getFullYear() + '</span>' +
                        '<br>' +
                        '<br>' +
                        data.forma_pago +
                        '</td>' +
                        '<td style="text-align: right;">' +
                        valor_1.toLocaleString('de-DE', {
                            minimumFractionDigits: 2, maximumFractionDigits: 2
                        }) +
                        '<br>' +
                        '<b>-' + data.valor + '</b>' +
                        '<br>' +
                        '<b>Total COP:</b>&nbsp&nbsp&nbsp&nbsp&nbsp' + total_final.toLocaleString('de-DE', {
                            minimumFractionDigits: 2, maximumFractionDigits: 2
                        }) + '' +
                        '</td>' +
                        '</tr>'
                    );

                    if (data.observacion) {
                        data.observacion = '<label class="main-content-label tx-13">Observaciones</label>' +
                            '<p>' + data.observacion + '</p>';
                    } else {
                        data.observacion = '';
                    }

                    if (data.adjunto_pdf) {
                        data.adjunto_pdf = '<label class="main-content-label tx-13">Adjunto</label><br>' +
                            '<a href="' + url_general + 'images/contabilidad/comprobantes_egreso/' + data.adjunto_pdf + '" target="_blank">Visualizar</a>';
                    } else {
                        data.adjunto_pdf = '';
                    }

                    $("#productos_view").append(
                        '<tr>' +
                        '<td class="valign-middle" colspan="4" rowspan="2">' +
                        '<div class="invoice-notes">' +
                        data.observacion +
                        '<br>' +
                        data.adjunto_pdf +
                        '</div>' +
                        '</td>' +
                        '</tr>'
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
    });
});
