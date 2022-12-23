$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnUpdateConfig").click(function () {
        let id = $("#id_config_add").val();
        let salud = $("#salud_add").val();
        let pension = $("#pension_add").val();
        let monto = $("#monto_add").val();

        let monto2 = monto.split(".");
        monto = monto2[0].replaceAll(",", "");

        if (salud == "" || pension == "" || monto == "") {
            toastr.error("Todos los campos son obligatorios");
        } else {
            
            $("#btnUpdateConfig").attr("disabled", true);
            $.ajax({
                url: "update_config_nomina",
                type: "POST",
                data: {
                    id: id,
                    salud: salud,
                    pension: pension,
                    monto: monto,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(
                            "Configuración actualizada correctamente"
                        );
                        $("#btnUpdateConfig").attr("disabled", false);
                    } else {
                        toastr.error("Error al actualizar la configuración");
                        $("#btnUpdateConfig").attr("disabled", false);
                    }
                },
                error: function (error) {
                    toastr.error("Error al actualizar la configuración");
                    $("#btnUpdateConfig").attr("disabled", false);
                },
            });
        }
    });
});
