$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $("#btn_filtrar").click(function () {
        let factura = $("#factura_select").val();
        let proveedor = $("#proveedor_select").val();
        let empleado = $("#empleado_select").val();
        let fecha_inicio = $("#inicio_select").val();
        let fecha_fin = $("#fin_select").val();

        $("#btn_filtrar").attr("disabled", true);
        $("#btn_filtrar").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...'
        );
        $.ajax({
            url: "reportes_compras_filtro",
            type: "POST",
            data: {
                factura: factura,
                proveedor: proveedor,
                empleado: empleado,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
            },
            success: function (response) {
                if(response.info = 1) {
                    let data = response.data;
                    console.log(data);

                    $("#modalSelect").modal("hide");
                } else {
                    toasr.error("Error al filtrar los datos");
                }
                $("#btn_filtrar").attr("disabled", false);
                $("#btn_filtrar").html("Filtrar");
            },
            error: function (response) {
                toasr.error("Error al filtrar los datos");
                $("#btn_filtrar").attr("disabled", false);
                $("#btn_filtrar").html("Filtrar");
            },
        });
    });
});