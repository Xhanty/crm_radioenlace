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

    $(document).on("click", ".btn_Seleccionar", function () {
        let id = $(this).data("id");
        let img = $(this).data("img");
        let nombre = $(this).data("nombre");
        let producto = $(this).data("producto");
        let cantidad = $(this).data("cantidad");

        $("#id_select").val(id);
        $("#id_producto_select").val(producto);
        $("#cantidad_old_select").val(cantidad);
        $("#imagen_select").attr("src", url_general + "images/productos/" + img);
        $("#name_prod_select").text(nombre);

        $("#modal_seleccionar").modal("show");
    });

    $("#btnAddSeleccionar").click(function () {
        let id = $("#id_select").val();
        let producto = $("#id_producto_select").val();
        let cantidad_old = $("#cantidad_old_select").val();
        let tipo = $("#tipo_select").val();
        let cantidad = $("#cantidad_select").val();
        let proveedor = $("#proveedor_select").val();
        let ubicacion = $("#ubicacion_select").val();
        let ubicacion_ref = $("#ubicacion_ref_select").val();
        let precio_compra = $("#precio_compra_select").val();
        let precio_venta = $("#precio_venta_select").val();
        let serial = $("#serial_select").val();
        let codigo_interno = $("#codigo_interno_select").val();
        let empleado = $("#empleado_select").val();
        let cliente = $("#cliente_select").val();
        let descripcion = $("#descripcion_select").val();

        if (tipo == "" || tipo == null) {
            toastr.error("Debe seleccionar un tipo de transacción");
        } else if (cantidad < 1) {
            toastr.error("La cantidad debe ser mayor a 0");
        } else {
            $("#btnAddSeleccionar").attr("disabled", true);

            $.ajax({
                url: "inventario_update_select",
                type: "POST",
                data: {
                    id: id,
                    producto: producto,
                    tipo: tipo,
                    cantidad: cantidad,
                    cantidad_old: cantidad_old,
                    proveedor: proveedor,
                    ubicacion: ubicacion,
                    ubicacion_ref: ubicacion_ref,
                    precio_compra: precio_compra,
                    precio_venta: precio_venta,
                    serial: serial,
                    codigo_interno: codigo_interno,
                    empleado: empleado,
                    cliente: cliente,
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
                        $("#btnAddSeleccionar").attr("disabled", false);
                        toastr.error("Error al actualizar el inventario");
                    }
                },
                error: function (error) {
                    $("#btnAddSeleccionar").attr("disabled", false);
                    toastr.error("Error al actualizar el inventario");
                    console.log(error);
                },
            });
        }
    });

    $("#tipo_select").change(function () {
        let tipo = $(this).val();
        $(".form-change").addClass("d-none");

        if (tipo == "" || tipo == null) {
            toastr.error("Debe seleccionar un tipo de transacción");
        } else if (tipo == 0) {
            $("#proveedor_select").parent().parent().removeClass("d-none");
            $("#ubicacion_select").parent().parent().removeClass("d-none");
            $("#ubicacion_ref_select").parent().parent().removeClass("d-none");
            $("#precio_compra_select").parent().parent().removeClass("d-none");
            $("#precio_venta_select").parent().parent().removeClass("d-none");
            $("#serial_select").parent().parent().removeClass("d-none");
            $("#codigo_interno_select").parent().parent().removeClass("d-none");
        } else if (tipo == 1) {
            $("#proveedor_select").parent().parent().removeClass("d-none");
            $("#ubicacion_select").parent().parent().removeClass("d-none");
            $("#ubicacion_ref_select").parent().parent().removeClass("d-none");
            $("#precio_compra_select").parent().parent().removeClass("d-none");
            $("#precio_venta_select").parent().parent().removeClass("d-none");
            $("#serial_select").parent().parent().removeClass("d-none");
            $("#codigo_interno_select").parent().parent().removeClass("d-none");
        } else if (tipo == 2) {
            $("#cliente_select").parent().parent().removeClass("d-none");
        } else if (tipo == 3) {
            $("#cliente_select").parent().parent().removeClass("d-none");
        } else if (tipo == 4) {
            $("#empleado_select").parent().parent().removeClass("d-none");
            $("#cliente_select").parent().parent().removeClass("d-none");
        } else if (tipo == 5) {
            $("#empleado_select").parent().parent().removeClass("d-none");
        } else if (tipo == 6) {
            $("#cliente_select").parent().parent().removeClass("d-none");
        }

        console.log(tipo);
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
                    let productos_instalados = response.productos_instalados;
                    let productos_vendidos = response.productos_vendidos;
                    let productos_prestados = response.productos_prestados;
                    let productos_alquilados = response.productos_alquilados;
                    let productos_devueltos = response.productos_devueltos;
                    let productos_asignados = response.productos_asignados;

                    console.log(data);
                    console.log(productos_instalados);
                    console.log(productos_vendidos);
                    console.log(productos_prestados);
                    console.log(productos_alquilados);
                    console.log(productos_devueltos);
                    console.log(productos_asignados);

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
