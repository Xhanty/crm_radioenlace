$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

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

    $(document).on("click", ".btn_Show", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("fast");

        $.ajax({
            url: "inventario_detail",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                $("#global-loader").fadeOut("fast");

                if (response.info == 1) {
                    let data = response.data;

                    console.log(data);

                    //$("#modal_edit").modal("show");
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

    $(document).on("click", ".btn_Baja", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        Swal.fire({
            title: "¿Estás seguro de cambiar el estado del producto?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Sí, cambiar!",
            cancelButtonText: "¡No, cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "inventario_change_status",
                    type: "POST",
                    data: { id: id, status: status },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al actualizar el producto");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al actualizar el producto");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");
        let asignado = $(this).data("asignado");

        if (asignado > 0) {
            toastr.error(
                "No se puede eliminar el producto porque tiene asignaciones"
            );
        } else {
            Swal.fire({
                title: "¿Estás seguro de eliminar el producto?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "¡Sí, eliminar!",
                cancelButtonText: "¡No, cancelar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "inventario_delete",
                        type: "POST",
                        data: { id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.info == 1) {
                                toastr.success(response.success);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                toastr.error("Error al eliminar el producto");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error("Error al eliminar el producto");
                        },
                    });
                }
            });
        }
    });
});
