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

    $(document).on("click", ".btn_Ingreso", function () {
        let id = $(this).data("id");

        $("#producto_id_ingreso").val(id);
        $("#modalIngreso").modal("show");
    });

    $(document).on("click", ".btn_Salida", function () {
        let id = $(this).data("id");

        $("#producto_id_salida").val(id);
        $("#modalSalida").modal("show");
    });

    $("#btnIngresoProducto").click(function () {
        let producto_id = $("#producto_id_ingreso").val();
        let opcion = $("#tipoingreso_select").val();

        if (opcion == 1) {
            $("#modalIngreso").modal("hide");
            $("#global-loader").fadeIn("slow");
            $("#producto_id_compra").val(producto_id);
            $.ajax({
                url: "data_detalle_producto",
                type: "POST",
                data: { id: producto_id },
                success: function (response) {
                    $("#global-loader").fadeOut("slow");
                    let data = response.data;
                    let inventario = data.inventario;
                    if (response.info == 1) {
                        $("#title_prodc_compra").text(
                            data.nombre + " " + data.marca + " - " + data.modelo
                        );
                        $("#imagen_compra").attr(
                            "src",
                            url_general + "images/productos/" + data.imagen
                        );
                        $("#serialexistente_compra").empty();
                        $("#serialexistente_compra").append(
                            '<option value="0">Ninguno</option>'
                        );
                        inventario.forEach((element) => {
                            $("#serialexistente_compra").append(
                                "<option value='" +
                                    element.id +
                                    "'>" +
                                    element.serial +
                                    " (Cantidad: " +
                                    element.cantidad +
                                    ")" +
                                    "</option>"
                            );
                        });

                        $("#modalCompra").modal("show");
                    }
                },
                error: function (error) {
                    $("#global-loader").fadeOut("slow");
                    console.log(error);
                },
            });
        } else if (opcion == 2) {
            $("#modalIngreso").modal("hide");
            $("#global-loader").fadeIn("slow");
            $.ajax({
                url: "data_detalle_producto",
                type: "POST",
                data: { id: producto_id },
                success: function (response) {
                    $("#global-loader").fadeOut("slow");
                    let data = response.data;
                    let inventario = data.inventario;
                    if (response.info == 1) {
                        $("#title_prodc_reingreso").text(
                            data.nombre + " " + data.marca + " - " + data.modelo
                        );
                        $("#imagen_reingreso").attr(
                            "src",
                            url_general + "images/productos/" + data.imagen
                        );
                        $("#producto_reingreso").empty();

                        inventario.forEach((element) => {
                            let salidas = element.salidas;
                            salidas.forEach((element2) => {
                                $("#producto_reingreso").append(
                                    "<option data-cantidad='" +
                                        element2.cantidad +
                                        "' value='" +
                                        element2.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element2.cantidad +
                                        ") " +
                                        "</option>"
                                );
                            });
                        });
                        $("#modalReingreso").modal("show");
                    }
                },
                error: function (error) {
                    $("#global-loader").fadeOut("slow");
                    console.log(error);
                },
            });
        }
    });

    $("#serialexistente_compra").change(function () {
        let serial = $(this).val();
        if (serial != 0) {
            $("#serial_compra").parent().addClass("d-none");
        } else {
            $("#serial_compra").parent().removeClass("d-none");
        }
    });

    $("#btnCompraProducto").click(function () {
        let producto_id = $("#producto_id_compra").val();
        let serial = $("#serialexistente_compra").val();
        let precio_venta = $("#precio_compra").val();
        let precio_compra = $("#precio_compra").val();
        let serial_compra = $("#serial_compra").val();
        let cantidad = $("#cantidad_compra").val();
        let observaciones = $("#cantidad_compra").val();

        if (serial == 0 || serial == null) {
            if (serial_compra == "") {
                toastr.error("Debe ingresar el serial del producto");
                return false;
            }
        }

        if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else {
            $("#btnCompraProducto").attr("disabled", true);
            $.ajax({
                url: "ingreso_inventario",
                type: "POST",
                data: {
                    producto_id: producto_id,
                    serial: serial,
                    precio_venta: precio_venta,
                    precio_compra: precio_compra,
                    serial_compra: serial_compra,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnCompraProducto").attr("disabled", false);
                    if (response.info == 1) {
                        $("#modalCompra").modal("hide");
                        $("#modalIngreso").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Ingreso realizado correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar el ingreso");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar el ingreso");
                    $("#btnCompraProducto").attr("disabled", false);
                    console.log(error);
                },
            });
        }
    });

    $("#btnReIngresoProducto").click(function () {
        let serial = $("#producto_reingreso").val();
        let cantidad_old = $("#producto_reingreso")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_reingreso").val();
        let observaciones = $("#observacion_reingreso").val();

        if (serial == 0 || serial == null) {
            toastr.error("Debe seleccionar un serial existente");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error(
                "La cantidad ingresada no puede ser mayor a la cantidad de salida"
            );
            return false;
        } else {
            $("#btnReIngresoProducto").attr("disabled", true);
            $.ajax({
                url: "reingreso_inventario",
                type: "POST",
                data: {
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnReIngresoProducto").attr("disabled", false);
                    if (response.info == 1) {
                        $("#modalIngreso").modal("hide");
                        $("#modalReingreso").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Reingreso realizado correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar el reingreso");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar el reingreso");
                    $("#btnReIngresoProducto").attr("disabled", false);
                    console.log(error);
                },
            });
        }
    });
});
