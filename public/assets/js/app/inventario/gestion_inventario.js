$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    // ALMACENES INGRESO
    var id_almacen_ingreso = 0;

    // ALMACENES SALIDA
    var id_almacen_salida = 0;

    var language = {
        searchPlaceholder: "Buscar...",
        sSearch: "",
        decimal: "",
        emptyTable: "No hay información",
        info: "Mostrando _START_ a _END_ de _TOTAL_ Resultados",
        infoEmpty: "Mostrando 0 to 0 de 0 Resultados",
        infoFiltered: "(Filtrado de _MAX_ total resultados)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "Mostrar _MENU_ Resultados",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "Sin resultados encontrados",
        paginate: {
            first: "Primero",
            last: "Ultimo",
            next: "Siguiente",
            previous: "Anterior",
        },
    };

    // VISUALIZAR
    $(document).on("click", ".btn_View", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("slow");
        $.ajax({
            url: "get_inventario",
            type: "POST",
            data: { id: id },
            success: function (response) {
                let data = response.data;
                let inventario = data.inventario;
                if (response.info == 1) {
                    $("#title_prodc_view").text(
                        data.nombre + " " + data.marca + " - " + data.modelo
                    );

                    $("#imagen_view").attr(
                        "src",
                        url_general + "images/productos/" + data.imagen
                    );

                    if ($.fn.DataTable.isDataTable("#tbl_seriales_view")) {
                        $("#tbl_seriales_view").DataTable().destroy();
                    }

                    $("#tbl_seriales_view tbody").empty();

                    inventario.forEach((element) => {
                        let estado = "";
                        if (element.status == 0) {
                            estado =
                                '<span class="badge bg-danger side-badge">Agotado</span>';
                        } else if (element.status == 1) {
                            estado =
                                '<span class="badge bg-success side-badge">Disponible</span>';
                        }

                        let tr = `<tr>
                            <td>${element.codigo_interno ? element.codigo_interno : ""}</td>
                            <td>${element.serial}</td>
                            <td>${element.almacen}</td>
                            <td>${element.cantidad}</td>
                            <td>${estado}</td>
                            <td>
                            <a href="${url_general +
                            "historial_serial?token=" +
                            element.id
                            }" target="_blank" class="btn btn-success btn-sm" title="Ver Historial"><i class="fa fa-book"></i></a>
                            <a data-id="${element.id}"
                            class="btn btn-warning btn-sm btn_EditarSerial" title="Modificar"><i class="fa fa-pencil-alt"></i></a>
                            <a data-id="${element.id
                            }" class="btn btn-danger btn-sm btn_EliminarSerial" title="Eliminar"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>`;
                        $("#tbl_seriales_view tbody").append(tr);
                    });

                    $("#tbl_seriales_view").DataTable({
                        responsive: true,
                        language: language,
                        order: [],
                    });

                    $("#modalVisualizar").modal("show");
                }

                $("#global-loader").fadeOut("slow");
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                console.log(error);
            },
        });
    });

    // ELIMINAR SERIAL
    $(document).on("click", ".btn_EliminarSerial", function () {
        let id = $(this).data("id");
        $("#modalVisualizar").modal("hide");

        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrá revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("slow");
                $.ajax({
                    url: "eliminar_serial",
                    type: "POST",
                    data: { id: id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        if (response.info == 1) {
                            Swal.fire(
                                "¡Eliminado!",
                                "El serial ha sido eliminado.",
                                "success"
                            ).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                "¡Error!",
                                "El serial no ha sido eliminado.",
                                "error"
                            );
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        Swal.fire(
                            "¡Error!",
                            "El serial no ha sido eliminado.",
                            "error"
                        );
                        console.log(error);
                    },
                });
            } else {
                $("#modalVisualizar").modal("show");
            }
        });
    });

    // MODIFICAR SERIAL
    $(document).on("click", ".btn_EditarSerial", function () {
        let id = $(this).data("id");

        $("#modalVisualizar").modal("hide");
        $("#global-loader").fadeIn("slow");
        $.ajax({
            url: "get_serial",
            type: "POST",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.data;
                if (response.info == 1) {
                    $("#producto_id_modificar").val(id);
                    $("#movimiento_producto_id_modificar").val(data.id_movimiento);
                    $("#serial_prodc_modif").val(data.serial);

                    $("#proveedor_prodc_modif").val(data.proveedor_id).trigger("change");
                    $("#codigo_interno_prodc_modif").val(data.codigo_interno);
                    $("#precioventa_prodc_modif").val(data.precio_venta);
                    $("#preciocompra_prodc_modif").val(data.precio_compra);
                    $("#observacion_prodc_modif").val(data.observaciones);

                    $("#modalModificarProducto").modal("show");
                } else {
                    toastr.error("El serial no ha sido encontrado.");
                    $("#modalVisualizar").modal("show");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("fast");
                $("#modalVisualizar").modal("show");
                toastr.error("El serial no ha sido encontrado.");
            },
        });
    });

    $("#btnModificarSerialProducto").click(function () {
        let id = $("#producto_id_modificar").val();
        let movimiento_id = $("#movimiento_producto_id_modificar").val();
        let proveedor = $("#proveedor_prodc_modif").val();
        let codigo_interno = $("#codigo_interno_prodc_modif").val();
        let serial = $("#serial_prodc_modif").val();
        let precio_venta = $("#precioventa_prodc_modif").val();
        let precio_compra = $("#preciocompra_prodc_modif").val();
        let observaciones = $("#observacion_prodc_modif").val();

        if (codigo_interno.trim().length < 1) {
            toastr.error("El código interno es obligatorio.");
            return false;
        } else if (serial.trim().length < 1) {
            toastr.error("El serial es obligatorio.");
            return false;
        } else {
            $("#btnModificarSerialProducto").attr("disabled", true);
            $("#btnModificarSerialProducto").html(
                '<i class="fa fa-spinner fa-spin"></i> Procesando...'
            );

            $.ajax({
                url: "modificar_serial",
                type: "POST",
                data: {
                    id: id,
                    movimiento_id: movimiento_id,
                    serial: serial,
                    proveedor: proveedor,
                    codigo_interno: codigo_interno,
                    precio_venta: precio_venta,
                    precio_compra: precio_compra,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnModificarSerialProducto").attr("disabled", false);
                    $("#btnModificarSerialProducto").html("Modificar");

                    if (response.info == 1) {
                        toastr.success("El serial ha sido modificado.");
                        $("#modalModificarProducto").modal("hide");
                    } else {
                        toastr.error("El serial no ha sido modificado.");
                    }
                },
                error: function (error) {
                    $("#btnModificarSerialProducto").attr("disabled", false);
                    $("#btnModificarSerialProducto").html("Modificar");
                    toastr.error("El serial no ha sido modificado.");
                },
            });
        }
    });

    // INGRESO
    $(document).on("click", ".btn_Ingreso", function () {
        let id = $(this).data("id");

        $("#producto_id_ingreso").val(id);
        $("#modalIngreso").modal("show");
    });

    $("#btnIngresoProducto").click(function () {
        let producto_id = $("#producto_id_ingreso").val();
        let opcion = $("#tipoingreso_select").val();

        if (id_almacen_ingreso != 0 && id_almacen_ingreso > 0) {
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
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
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
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else if (opcion == 2) {
                $("#modalIngreso").modal("hide");
                $("#global-loader").fadeIn("slow");
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id, opcion: opcion },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_reingreso").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_reingreso").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#producto_reingreso").empty();

                            inventario.forEach((element) => {
                                let salidas = element.salidas;

                                if (element.salidas) {
                                    salidas.forEach((element2) => {
                                        let tipo = "";
                                        if (element2.tipo == 1) {
                                            tipo = " (Alquilado)";
                                        } else if (element2.tipo == 2) {
                                            tipo = " (Asignado)";
                                        } else if (element2.tipo == 3) {
                                            tipo = " (Préstamo)";
                                        } else if (element2.tipo == 4) {
                                            tipo = " (Instalación)";
                                        } else if (element2.tipo == 5) {
                                            tipo = " (Venta)";
                                        } else if (element2.tipo == 6) {
                                            tipo = " (Dado de baja)";
                                        }

                                        $("#producto_reingreso").append(
                                            "<option data-cantidad='" +
                                            element2.cantidad +
                                            "' value='" +
                                            element2.id +
                                            "'>" +
                                            element.serial +
                                            " | (Cantidad: " +
                                            element2.cantidad +
                                            ") - " +
                                            tipo +
                                            "</option>"
                                        );
                                    });
                                }

                                if (element.cantidad > 0 && !element.salidas) {
                                    let tipo = " (Disponible)";

                                    $("#producto_reingreso").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " | (Cantidad: " +
                                        element.cantidad +
                                        ") - " +
                                        tipo +
                                        "</option>"
                                    );
                                }

                            });
                            $("#modalReingreso").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else {
                toastr.error("Debe seleccionar un tipo de ingreso");
            }
        } else {
            toastr.error("Debe seleccionar un almacén");
        }
    });

    $("#btnCompraProducto").click(function () {
        let producto_id = $("#producto_id_compra").val();
        let codigo_interno = $("#codigo_interno_compra").val();
        let serial = $("#serialexistente_compra").val();
        let proveedor = $("#proveedor_compra").val();
        let precio_venta = $("#precioventa_compra").val();
        let precio_compra = $("#preciocompra_compra").val();
        let serial_compra = $("#serial_compra").val();
        let cantidad = $("#cantidad_compra").val();
        let observaciones = $("#observacion_compra").val();

        if (serial == 0 || serial == null) {
            if (serial_compra == "") {
                toastr.error("Debe ingresar el serial del producto");
                return false;
            }
        }

        if (codigo_interno.trim().length == 0) {
            toastr.error("Debe ingresar el código interno del producto");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else {
            $("#btnCompraProducto").attr("disabled", true);
            $("#btnCompraProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            if (proveedor == "*" || proveedor == "") {
                proveedor = null;
            }
            $.ajax({
                url: "ingreso_inventario",
                type: "POST",
                data: {
                    tipo: 0,
                    codigo_interno: codigo_interno,
                    proveedor_id: proveedor,
                    almacen_id: id_almacen_ingreso,
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
                    $("#btnCompraProducto").html("Guardar");
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
                    $("#btnCompraProducto").html("Guardar");
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
            $("#btnReIngresoProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "reingreso_inventario",
                type: "POST",
                data: {
                    tipo: 1,
                    almacen_id: id_almacen_ingreso,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnReIngresoProducto").attr("disabled", false);
                    $("#btnReIngresoProducto").html("Guardar");
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
                    $("#btnReIngresoProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    // SALIDA
    $(document).on("click", ".btn_Salida", function () {
        let id = $(this).data("id");

        $("#producto_id_salida").val(id);
        $("#modalSalida").modal("show");
    });

    $("#btnSalidaProducto").click(function () {
        let tipo = $("#tiposalida_select").val();
        let producto_id = $("#producto_id_salida").val();

        if (id_almacen_salida != 0 && id_almacen_salida > 0) {
            if (tipo == 1) {
                $("#modalSalida").modal("hide");
                $("#global-loader").fadeIn("slow");
                $("#producto_id_alquiler").val(producto_id);
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_alquiler").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_alquiler").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#serial_alquiler").empty();

                            inventario.forEach((element) => {
                                if (element.cantidad > 0) {
                                    $("#serial_alquiler").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element.cantidad +
                                        ")" +
                                        "</option>"
                                    );
                                }
                            });

                            $("#modalAlquiler").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else if (tipo == 2) {
                $("#modalSalida").modal("hide");
                $("#global-loader").fadeIn("slow");
                $("#producto_id_asignado").val(producto_id);
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_asignado").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_asignado").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#serial_asignado").empty();

                            inventario.forEach((element) => {
                                if (element.cantidad > 0) {
                                    $("#serial_asignado").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element.cantidad +
                                        ")" +
                                        "</option>"
                                    );
                                }
                            });

                            $("#modalAsignado").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else if (tipo == 3) {
                $("#modalSalida").modal("hide");
                $("#global-loader").fadeIn("slow");
                $("#producto_id_prestamo").val(producto_id);
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_prestamo").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_prestamo").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#serial_prestamo").empty();

                            inventario.forEach((element) => {
                                if (element.cantidad > 0) {
                                    $("#serial_prestamo").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element.cantidad +
                                        ")" +
                                        "</option>"
                                    );
                                }
                            });

                            $("#modalPrestamo").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else if (tipo == 4) {
                $("#modalSalida").modal("hide");
                $("#global-loader").fadeIn("slow");
                $("#producto_id_instalar").val(producto_id);
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_instalar").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_instalar").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#serial_instalar").empty();

                            inventario.forEach((element) => {
                                if (element.cantidad > 0) {
                                    $("#serial_instalar").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element.cantidad +
                                        ")" +
                                        "</option>"
                                    );
                                }
                            });

                            $("#modalInstalar").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else if (tipo == 5) {
                $("#modalSalida").modal("hide");
                $("#global-loader").fadeIn("slow");
                $("#producto_id_vender").val(producto_id);
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_vender").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_vender").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#serial_vender").empty();

                            inventario.forEach((element) => {
                                if (element.cantidad > 0) {
                                    $("#serial_vender").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element.cantidad +
                                        ")" +
                                        "</option>"
                                    );
                                }
                            });

                            $("#modalVender").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else if (tipo == 6) {
                $("#modalSalida").modal("hide");
                $("#global-loader").fadeIn("slow");
                $("#producto_id_danado").val(producto_id);
                $.ajax({
                    url: "data_detalle_producto",
                    type: "POST",
                    data: { id: producto_id },
                    success: function (response) {
                        $("#global-loader").fadeOut("slow");
                        let data = response.data;
                        let inventario = data.inventario;
                        if (response.info == 1) {
                            $("#title_prodc_danado").text(
                                data.nombre +
                                " " +
                                data.marca +
                                " - " +
                                data.modelo
                            );
                            $("#imagen_danado").attr(
                                "src",
                                url_general + "images/productos/" + data.imagen
                            );
                            $("#serial_danado").empty();

                            inventario.forEach((element) => {
                                if (element.cantidad > 0) {
                                    $("#serial_danado").append(
                                        "<option data-cantidad='" +
                                        element.cantidad +
                                        "' value='" +
                                        element.id +
                                        "'>" +
                                        element.serial +
                                        " (Cantidad: " +
                                        element.cantidad +
                                        ")" +
                                        "</option>"
                                    );
                                }
                            });

                            $("#modalDanado").modal("show");
                        } else {
                            toastr.error("Error al cargar los datos");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Error al cargar los datos");
                        console.log(error);
                    },
                });
            } else {
                toastr.error("Debe seleccionar un tipo de salida");
            }
        } else {
            toastr.error("Debe seleccionar un almacén");
        }
    });

    $("#btnAlquilerProducto").click(function () {
        let producto_id = $("#producto_id_alquiler").val();
        let cliente = $("#cliente_alquiler").val();
        let serial = $("#serial_alquiler").val();
        let cantidad_old = $("#serial_alquiler")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_alquiler").val();
        let observaciones = $("#observacion_alquiler").val();

        if (cliente == "*" || cliente == null || cliente == "") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else if (serial == "*" || serial == null || serial == "") {
            toastr.error("Debe seleccionar un serial");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error("La cantidad no puede ser mayor a la disponible");
            return false;
        } else {
            $("#btnAlquilerProducto").attr("disabled", true);
            $("#btnAlquilerProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "salidas_inventario",
                type: "POST",
                data: {
                    tipo: 1,
                    almacen_id: id_almacen_salida,
                    producto_id: producto_id,
                    cliente: cliente,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnAlquilerProducto").attr("disabled", false);
                    $("#btnAlquilerProducto").html("Guardar");
                    if (response.info == 1) {
                        $("#modalAlquiler").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Alquiler realizado correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar el alquiler");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar el alquiler");
                    $("#btnAlquilerProducto").attr("disabled", false);
                    $("#btnAlquilerProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    $("#btnAsignadoProducto").click(function () {
        let producto_id = $("#producto_id_asignado").val();
        let empleado = $("#empleado_asignado").val();
        let serial = $("#serial_asignado").val();
        let cantidad_old = $("#serial_asignado")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_asignado").val();
        let observaciones = $("#observacion_asignado").val();

        if (empleado == "*" || empleado == null || empleado == "") {
            toastr.error("Debe seleccionar un empleado");
            return false;
        } else if (serial == "*" || serial == null || serial == "") {
            toastr.error("Debe seleccionar un serial");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error("La cantidad no puede ser mayor a la disponible");
            return false;
        } else {
            $("#btnAsignadoProducto").attr("disabled", true);
            $("#btnAsignadoProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "salidas_inventario",
                type: "POST",
                data: {
                    tipo: 2,
                    almacen_id: id_almacen_salida,
                    producto_id: producto_id,
                    empleado: empleado,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnAsignadoProducto").attr("disabled", false);
                    $("#btnAsignadoProducto").html("Guardar");
                    if (response.info == 1) {
                        $("#modalAsignado").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Asignado correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar al asignar");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar al asignar");
                    $("#btnAsignadoProducto").attr("disabled", false);
                    $("#btnAsignadoProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    $("#btnPrestamoProducto").click(function () {
        let producto_id = $("#producto_id_prestamo").val();
        let cliente = $("#cliente_prestamo").val();
        let empleado = $("#empleado_prestamo").val();
        let serial = $("#serial_prestamo").val();
        let cantidad_old = $("#serial_prestamo")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_prestamo").val();
        let observaciones = $("#observacion_prestamo").val();

        if (cliente > 1 && empleado > 1) {
            toastr.error("Debe seleccionar un cliente o un empleado");
            return false;
        } else if (cliente == "*" && empleado == "*") {
            toastr.error("Debe seleccionar un cliente o un empleado");
            return false;
        } else if (serial == "*" || serial == null || serial == "") {
            toastr.error("Debe seleccionar un serial");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error("La cantidad no puede ser mayor a la disponible");
            return false;
        } else {
            $("#btnPrestamoProducto").attr("disabled", true);
            $("#btnPrestamoProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );

            if (cliente == "*") {
                cliente = null;
            } else if (empleado == "*") {
                empleado = null;
            }

            $.ajax({
                url: "salidas_inventario",
                type: "POST",
                data: {
                    tipo: 3,
                    almacen_id: id_almacen_salida,
                    producto_id: producto_id,
                    empleado: empleado,
                    cliente: cliente,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnPrestamoProducto").attr("disabled", false);
                    $("#btnPrestamoProducto").html("Guardar");
                    if (response.info == 1) {
                        $("#modalPrestamo").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Préstamo realizado correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar al movimiento");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar al movimiento");
                    $("#btnPrestamoProducto").attr("disabled", false);
                    $("#btnPrestamoProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    $("#btnInstalarProducto").click(function () {
        let producto_id = $("#producto_id_instalar").val();
        let cliente = $("#cliente_instalar").val();
        let serial = $("#serial_instalar").val();
        let cantidad_old = $("#serial_instalar")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_instalar").val();
        let observaciones = $("#observacion_instalar").val();

        if (cliente == "*" || cliente == null || cliente == "") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else if (serial == "*" || serial == null || serial == "") {
            toastr.error("Debe seleccionar un serial");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error("La cantidad no puede ser mayor a la disponible");
            return false;
        } else {
            $("#btnInstalarProducto").attr("disabled", true);
            $("#btnInstalarProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "salidas_inventario",
                type: "POST",
                data: {
                    tipo: 4,
                    almacen_id: id_almacen_salida,
                    producto_id: producto_id,
                    cliente: cliente,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnInstalarProducto").attr("disabled", false);
                    $("#btnInstalarProducto").html("Guardar");
                    if (response.info == 1) {
                        $("#modalInstalar").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Instalación realizada correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar la instalación");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar la instalación");
                    $("#btnInstalarProducto").attr("disabled", false);
                    $("#btnInstalarProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    $("#btnVenderProducto").click(function () {
        let producto_id = $("#producto_id_vender").val();
        let cliente = $("#cliente_vender").val();
        let serial = $("#serial_vender").val();
        let cantidad_old = $("#serial_vender")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_vender").val();
        let observaciones = $("#observacion_vender").val();

        if (cliente == "*" || cliente == null || cliente == "") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else if (serial == "*" || serial == null || serial == "") {
            toastr.error("Debe seleccionar un serial");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error("La cantidad no puede ser mayor a la disponible");
            return false;
        } else {
            $("#btnVenderProducto").attr("disabled", true);
            $("#btnVenderProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "salidas_inventario",
                type: "POST",
                data: {
                    tipo: 5,
                    almacen_id: id_almacen_salida,
                    producto_id: producto_id,
                    cliente: cliente,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnVenderProducto").attr("disabled", false);
                    $("#btnVenderProducto").html("Guardar");
                    if (response.info == 1) {
                        $("#modalVender").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Venta realizada correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar la venta");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar la venta");
                    $("#btnVenderProducto").attr("disabled", false);
                    $("#btnVenderProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    $("#btnDanadoProducto").click(function () {
        let producto_id = $("#producto_id_danado").val();
        let serial = $("#serial_danado").val();
        let cantidad_old = $("#serial_danado")
            .find(":selected")
            .data("cantidad");
        let cantidad = $("#cantidad_danado").val();
        let observaciones = $("#observacion_danado").val();

        if (serial == "*" || serial == null || serial == "") {
            toastr.error("Debe seleccionar un serial");
            return false;
        } else if (cantidad == "" || cantidad < 1) {
            toastr.error("Debe ingresar una cantidad valida");
            return false;
        } else if (cantidad > cantidad_old) {
            toastr.error("La cantidad no puede ser mayor a la disponible");
            return false;
        } else {
            $("#btnDanadoProducto").attr("disabled", true);
            $("#btnDanadoProducto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "salidas_inventario",
                type: "POST",
                data: {
                    tipo: 6,
                    almacen_id: id_almacen_salida,
                    producto_id: producto_id,
                    serial: serial,
                    cantidad: cantidad,
                    observaciones: observaciones,
                },
                success: function (response) {
                    $("#btnDanadoProducto").attr("disabled", false);
                    $("#btnDanadoProducto").html("Guardar");
                    if (response.info == 1) {
                        $("#modalDanado").modal("hide");
                        Swal.fire({
                            icon: "success",
                            title: "Movimiento realizado correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        toastr.error("Error al realizar el movimiento");
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar el movimiento");
                    $("#btnDanadoProducto").attr("disabled", false);
                    $("#btnDanadoProducto").html("Guardar");
                    console.log(error);
                },
            });
        }
    });

    // OTROS
    $(document).on("click", ".btn_AlmacenIngreso", function () {
        id_almacen_ingreso = $(this).data("id");

        $(".btn_AlmacenIngreso").parent().css("color", "#56546d");
        $(this).parent().css("color", "#0ba360");
    });

    $(document).on("click", ".btn_AlmacenSalida", function () {
        id_almacen_salida = $(this).data("id");

        $(".btn_AlmacenSalida").parent().css("color", "#56546d");
        $(this).parent().css("color", "#0ba360");
    });

    $("#serialexistente_compra").change(function () {
        let serial = $(this).val();
        if (serial != 0) {
            $("#serial_compra").parent().addClass("d-none");
        } else {
            $("#serial_compra").parent().removeClass("d-none");
        }
    });

    $("#btnSearchSerial").click(function () {
        let serial = $("#serial_search").val();

        if (serial.trim().length <= 3) {
            toastr.error("Debe ingresar un serial o código interno valido");
            return false;
        } else {
            $("#btnSearchSerial").attr("disabled", true);
            $("#btnSearchSerial").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: "search_serial_inventario",
                type: "POST",
                data: {
                    serial: serial,
                },
                success: function (response) {
                    $("#btnSearchSerial").attr("disabled", false);
                    $("#btnSearchSerial").html('<span class="input-group-btn"><i class="fa fa-search" style="display: inline-block !important"></i></span>');
                    if (response.info == 1) {
                        let token = response.token;
                        window.open("historial_serial?token=" + token, "_blank");
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function (error) {
                    toastr.error("Error al realizar la busqueda");
                    $("#btnSearchSerial").attr("disabled", false);
                    $("#btnSearchSerial").html('<span class="input-group-btn"><i class="fa fa-search" style="display: inline-block !important"></i></span>');
                    console.log(error);
                },
            });
        }
    });
});
