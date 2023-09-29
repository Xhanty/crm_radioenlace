$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let permisosCheck = [];
    let empleadoGeneral = 0;

    $("#modalSelect").modal("show");

    $("#empleado_select").on("change", function () {
        let empleado = $(this).val();

        if (empleado == "") {
            toastr.warning("Debe seleccionar un empleado");
        } else {
            $("#modalSelect").modal("hide");

            $("#global-loader").fadeIn("fast");
            empleadoGeneral = empleado;
            $.ajax({
                url: "permisos_empleado",
                type: "POST",
                data: { empleado: empleado },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        let permisos = [];

                        data.forEach((element) => {
                            permisos.push(element.modulo);
                        });

                        $("input[type=checkbox]").each(function () {
                            if (permisos.includes(this.value)) {
                                this.checked = true;
                            } else {
                                this.checked = false;
                            }
                        });

                        console.log(permisos);

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

    $("input[type=checkbox]").on("change", function () {
        setTimeout(() => {
            checksPermisos();
        }, 1);
    });

    $("#select_usuarios_cotizaciones").on("change", function() {
        let empleados = $(this).val();

        $.ajax({
            url: "permisos_user_update",
            type: "POST",
            data: {
                type: 'cotizaciones',
                empleado: empleadoGeneral,
                empleados: empleados,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Permisos actualizados correctamente");
                } else {
                    toastr.error(
                        "Ocurrió un error al actualizar los permisos"
                    );
                }
            },
            error: function (error) {
                toastr.error("Ocurrió un error al actualizar los permisos");
            },
        });
    });

    function checksPermisos() {
        permisosCheck = [];

        $("input[type=checkbox]:checked").each(function () {
            if (
                this.value != "on" &&
                this.value != "off" &&
                this.value != "undefined" &&
                this.value != "null" &&
                this.value != ""
            ) {
                permisosCheck.push(this.value);
            }
        });

        updatePermisos(permisosCheck);

        //console.log(permisosCheck);
    }

    function updatePermisos(permisos) {
        if (empleadoGeneral == 0) {
            toastr.warning("Debe seleccionar un empleado");
            return false;
        } else {
            $.ajax({
                url: "permisos_user_update",
                type: "POST",
                data: {
                    permisos: permisos,
                    empleado: empleadoGeneral,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Permisos actualizados correctamente");
                    } else {
                        toastr.error(
                            "Ocurrió un error al actualizar los permisos"
                        );
                    }
                },
                error: function (error) {
                    toastr.error("Ocurrió un error al actualizar los permisos");
                },
            });
        }
    }
});
