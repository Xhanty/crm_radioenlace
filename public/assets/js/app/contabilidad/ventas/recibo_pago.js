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
        let v = $(this).val().replace(/\D+/g, '');
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v.replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, '$1.'));
    });

    $(document).on("keyup", "#valor_add", function () {
        $("#td_valor_pagado").html($(this).val());
    });

    $("#btnAddPago").click(function () {
        let id = $("#id_add").val();
        let tipo = $("#tipo_add").val();
        let fecha = $("#fecha_add").val();
        let numero = $("#numero_add").val();
        let transaccion = $("#transaccion_add").val();
        let forma_pago = $("#formas_pago_add").val();
        let total = $("#vlv_pagar").val();
        let pagado = $("#valor_add").val();
        let observacion = $("#observaciones_add").val();

        pagado = pagado.split(',');
        pagado = pagado[0];
        pagado = pagado.replaceAll('.', '');
        pagado = parseInt(pagado);

        if (tipo == "") {
            toastr.error("Seleccione un tipo");
            return false;
        } else if (forma_pago == "") {
            toastr.error("Seleccione una forma de pago");
            return false;
        } else if (pagado < 1) {
            toastr.error("Ingrese un valor a pagar");
            return false;
        } else if (pagado > total) {
            toastr.error("El valor a pagar no puede ser mayor al valor total");
            return false;
        } else if (observacion == "") {
            toastr.error("Ingrese una observación");
            return false;
        } else {
            let terminado = 0;
            if (pagado == total) {
                terminado = 1;
            } else {
                terminado = 0;
            }

            let formData = new FormData();
            formData.append("id", id);
            formData.append("tipo", tipo);
            formData.append("fecha", fecha);
            formData.append("numero", numero);
            formData.append("transaccion", transaccion);
            formData.append("forma_pago", forma_pago);
            formData.append("total", total);
            formData.append("pagado", pagado.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            formData.append("terminado", terminado);
            formData.append("observacion", observacion);
            formData.append("archivo", $("#factura_add")[0].files[0]);

            $("#btnAddPago").prop("disabled", true);
            $("#btnAddPago").html('<i class="fa fa-spinner fa-spin"></i> Procesando...');
            $.ajax({
                url: "recibo_pago_add",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        if (terminado == 1) {
                            toastr.success("Pago guardado correctamente");
                            window.location.href = url_general + "factura_venta";
                        } else {
                            toastr.success("Pago guardado correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    } else {
                        toastr.error("Error al guardar el pago");
                    }

                    $("#btnAddPago").prop("disabled", false);
                    $("#btnAddPago").html('Guardar Pago');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al guardar el pago");
                    $("#btnAddPago").prop("disabled", false);
                    $("#btnAddPago").html('Guardar Pago');
                }
            });
        }
    });
});
