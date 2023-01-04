$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#modalSelect").modal({
        backdrop: "static",
        keyboard: false,
    });

    //$("#modalSelect").modal("show");

    $("#empleado_select").on("change", function () {
        let empleado = $(this).val();

        if (empleado == "") {
            toastr.warning("Debe seleccionar un empleado");
        } else {
            $("#modalSelect").modal("hide");

            $("#global-loader").fadeIn("fast");

            $.ajax({
                url: "permisos_empleado",
                type: "POST",
                data: { empleado: empleado },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        console.log(data);

                        $("#empleado_id").val(empleado);
                        $("#name_empleado").html(
                            $("#empleado_select option:selected").text()
                        );

                        $("#global-loader").fadeOut("fast");
                    } else {
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Ocurrió un error al cargar los datos");
                    }
                },
                error: function (error) {
                    $("#global-loader").fadeOut("fast");
                    toastr.error("Ocurrió un error al cargar los datos");
                },
            });
        }
    });
});
