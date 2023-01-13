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

    $("#btnModificarInventario").click(function () {
        let id = $("#id_edit").val();
        let serial = $("#serial_edit").val();
        let codigo = $("#codigo_edit").val();
        let cantidad = $("#cantidad_edit").val();
        let cantidad_asig = $("#cantidad_asig_edit").val();
        let ubicacion = $("#ubicacion_edit").val();
        let ubicacion_ref = $("#ubicacion_ref_edit").val();
        let asignado = $("#asignado_edit").val();
        let descripcion = $("#descripcion_edit").val();

        if (ubicacion == "") {
            toastr.error("El campo ubicación es obligatorio");
        } else {
            $("#btnModificarInventario").attr("disabled", true);

            $.ajax({
                url: "inventario_update",
                type: "POST",
                data: {
                    id: id,
                    serial: serial,
                    codigo: codigo,
                    cantidad: cantidad,
                    cantidad_asig: cantidad_asig,
                    ubicacion: ubicacion,
                    ubicacion_ref: ubicacion_ref,
                    asignado: asignado,
                    descripcion: descripcion,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Inventario actualizado correctamente");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnModificarInventario").attr("disabled", false);
                        toastr.error("Error al actualizar el inventario");
                    }
                },
                error: function (error) {
                    $("#btnModificarInventario").attr("disabled", false);
                    toastr.error("Error al actualizar el inventario");
                    console.log(error);
                },
            });
        }
    });

    $(document).on("click", ".btn_Edit", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("fast");

        $.ajax({
            url: "inventario_data",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                $("#global-loader").fadeOut("fast");

                if (response.info == 1) {
                    let data = response.data;
                    $("#id_edit").val(data.id);
                    $("#serial_edit").val(data.serial);
                    $("#codigo_edit").val(data.codigo_interno);
                    $("#cantidad_edit").val(data.cantidad);
                    $("#cantidad_asig_edit").val(data.cantidad_asignada);
                    $("#ubicacion_edit").val(data.ubicacion);
                    $("#ubicacion_ref_edit").val(data.ubicacion_ref);
                    $("#asignado_edit").val(data.empleado_asignado);
                    $("#descripcion_edit").val(data.descripcion);
                    $("#modal_edit").modal("show");
                } else {
                    toastr.error("Error al obtener los datos del inventario");
                }
            },
            error: function (error) {
                toastr.error("Error al obtener los datos del inventario");
                console.log(error);
                $("#global-loader").fadeOut("fast");
            },
        });
    });
});
