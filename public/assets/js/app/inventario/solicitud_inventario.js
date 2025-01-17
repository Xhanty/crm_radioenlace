$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    // ALMACENES INGRESO
    var id_almacen_salida = 0;
    let btn_View = 0;
    let data_seriales_gestion = [];
    let productos = JSON.parse(localStorage.getItem("productos"));

    let concat_add = '<div class="row row-sm mt-2">' +
        '<div class="col-8" >' +
        '<select class="form-select elementoadd">' +
        '<option value="">Seleccione una opción</option>' +
        productos.map((element) => {
            return '<option value="' + element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')">' +
                element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')</option>';
        }) +
        '</select>' +
        '</div>' +
        '<div class="col-3">' +
        '<input class="form-control cantidadadd" placeholder="Cantidad" type="number" min="1" step="1">' +
        '</div>' +
        '<div class="col-1 center-vertical">' +
        '<a class="btn_delete_row_add" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        '</a>' +
        '</div>' +
        '</div>';

    let concat_edit = '<div class="row row-sm mt-2">' +
        '<div class="col-8" >' +
        '<select class="form-select elementoedit">' +
        '<option value="">Seleccione una opción</option>' +
        productos.map((element) => {
            return '<option value="' + element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')">' +
                element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')</option>';
        }) +
        '</select>' +
        '</div>' +
        '<div class="col-3">' +
        '<input class="form-control cantidadedit" placeholder="Cantidad" type="number" min="1" step="1">' +
        '</div>' +
        '<div class="col-1 center-vertical">' +
        '<a class="btn_delete_row_add" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        '</a>' +
        '</div>' +
        '</div>';

    $("#new_row_elemento").click(function () {
        $("#div_list_elementos").append(concat_add);
        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $("#new_row_serial").click(function () {
        let datos = "";

        data_seriales_gestion.forEach((element) => {
            datos += '<option data-cantidad="' + element.cantidad + '" value="' + element.id + '">' + element.serial + ' (Disponible: ' + element.cantidad + ')' + '</option>';
        }) +

            $("#div_list_seriales").append('<div class="row row-sm mt-2">' +
                '<div class="col-8">' +
                '<select class="form-select elemento_gestion">' +
                '<option value="">Seleccione un opción</option>' +
                datos +
                '</select>' +
                '</div>' +
                '<div class="col-3">' +
                '<input type="number" class="form-control cantidad_gestion" min="1" step="1" placeholder="Cantidad">' +
                '</div>' +
                '<div class="col-1 d-flex">' +
                '<a class="center-vertical mg-s-10 btn_delete_row_add" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
                '</div>' +
                '</div>');

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $("#new_row_elemento_edit").click(function () {
        $("#div_list_elementos_edit").append(concat_edit);
        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".btn_delete_row_add", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".btn_delete_row_edit", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".btnView", function () {
        let id = $(this).attr("data-id");
        btn_View = id;
        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "data_solicitud_inventario",
            type: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                $("#global-loader").fadeOut("fast");
                if (data.info == 1) {
                    let solicitud = data.solicitud;
                    let elementos = data.elementos;
                    var URLactual = window.location.pathname;

                    $("#tiposalida_selectview").val(solicitud.tipo).trigger("change");

                    if (solicitud.tipo == 6) {
                        $("#clienteview").parent().addClass("d-none");
                        $("#reparacionview").parent().removeClass("d-none");
                        setTimeout(() => {
                            $("#reparacionview").val(solicitud.reparacion_id).trigger("change");
                        }, 1111);
                    } else {
                        $("#reparacionview").parent().addClass("d-none");
                        $("#clienteview").parent().removeClass("d-none");
                        $("#clienteview").val(solicitud.cliente_id).trigger("change");
                    }
                    $("#descripcionview").val(solicitud.descripcion);

                    let concat_view = "Elementos";
                    elementos.forEach((elemento) => {
                        var action = "";
                        var col = "col-4";

                        if (URLactual == "/gestion_solicitudes" && elemento.status == 0) {
                            action = '<div class="col-1" style="display: flex; justify-content: center; margin-top: 6px;">' +
                                '<a title="Asignar" style="margin-right: 12px" class="btnAsignarIndividual" data-elemento="' + elemento.elemento + '" data-cantidad="' + elemento.cantidad + '" data-id="' + elemento.id + '" href="javascript:void(0)">' + '<i class="fa fa-check"></i>' + '</a>' +
                                '<a title="Asignar" style="margin-right: 12px" class="btnRechazarIndividual" data-elemento="' + elemento.elemento + '" data-cantidad="' + elemento.cantidad + '" data-id="' + elemento.id + '" href="javascript:void(0)">' + '<i class="fa fa-times"></i>' + '</a>' +
                                '</div>';
                            col = "col-3";
                        } else if (URLactual == "/solicitud_inventario" && elemento.status == 0) {
                            action = '<div class="col-1"><span class="badge bg-success side-badge bg-warning" style="margin-top: 8px; margin-left: -8px;">Pendiente</span></div>';
                            col = "col-3";
                        }

                        if (elemento.status == 1) {
                            action = '<div class="col-1"><span class="badge bg-success side-badge bg-success" style="margin-top: 8px; margin-left: -8px;">Asignado</span></div>';
                            col = "col-3";
                        }

                        if (elemento.status == 2) {
                            action = '<div class="col-1"><span class="badge bg-danger side-badge bg-danger" style="margin-top: 8px; margin-left: -8px;">Rechazado</span></div>';
                            col = "col-3";
                        }

                        concat_view += '<div class="row row-sm mt-2">' +
                            '<div class="col-8" >' +
                            '<input class="form-control" title="Elemento" placeholder="Elemento" type="text" value="' + elemento.elemento + '" readonly>' +
                            '</div>' +
                            '<div class="' + col + '">' +
                            '<input class="form-control" title="Cantidad" placeholder="Cantidad" type="number" min="1" step="1" value="' + elemento.cantidad + '" readonly>' +
                            '</div>' +
                            action +
                            '</div > ';
                    });

                    $("#div_list_elementos_view").html(concat_view);

                    $("#modalView").modal("show");
                } else {
                    toastr.error("Error al cargar la solicitud");
                }
            },
            error: function (data) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar la solicitud");
            },
        });
    });

    $(document).on("click", ".btnEditar", function () {
        let id = $(this).attr("data-id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "data_solicitud_inventario",
            type: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                $("#global-loader").fadeOut("fast");
                if (data.info == 1) {
                    let solicitud = data.solicitud;
                    let elementos = data.elementos;
                    let primer_elemento = elementos[0];
                    let val = 1;

                    $("#solicitudid").val(solicitud.id);
                    $("#tiposalida_selectedit").val(solicitud.tipo).trigger("change");
                    $("#clienteedit").val(solicitud.cliente_id).trigger("change");
                    $("#descripcionedit").val(solicitud.descripcion);

                    $(".elementoedit").val(primer_elemento.elemento).trigger("change");
                    $(".cantidadedit").val(primer_elemento.cantidad);

                    let concat_view = "";

                    elementos.forEach((elemento) => {
                        if (val > 1) {
                            concat_view += '<div class="row row-sm mt-2">' +
                                '<div class="col-8" >' +
                                '<select class="form-select elementoedit">' +
                                '<option value="">Seleccione una opción</option>' +
                                productos.map((element) => {
                                    var valid_name = element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')';
                                    if (valid_name == elemento.elemento) {
                                        return '<option selected value="' + element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')">' +
                                            element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')</option>';
                                    } else {
                                        return '<option value="' + element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')">' +
                                            element.nombre + ' (' + element.marca + ' - ' + element.modelo + ')</option>';
                                    }
                                }) +
                                '</select>' +
                                '</div>' +
                                '<div class="col-3">' +
                                '<input class="form-control cantidadedit" title="Cantidad" placeholder="Cantidad" type="number" min="1" step="1" value="' + elemento.cantidad + '">' +
                                '</div>' +
                                '<div class="col-1 center-vertical">' +
                                '<a class="btn_delete_row_edit" href="javascript:void(0)">' +
                                '<i class="fa fa-trash"></i>' +
                                '</a>' +
                                '</div>' +
                                '</div > ';
                        }
                        val++;
                    });

                    $("#div_list_elementos_edit").html(concat_view);

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                    setTimeout(function () {
                        $("#reparacionedit").val(solicitud.reparacion_id).trigger("change");
                    }, 1111);
                    $("#modalEdit").modal("show");
                } else {
                    toastr.error("Error al cargar la solicitud");
                }
            },
            error: function (data) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar la solicitud");
            },
        });
    });

    $(document).on("click", ".btnEliminar", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("fast");
                $.ajax({
                    url: "delete_solicitud_inventario",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        $("#global-loader").fadeOut("fast");
                        if (data.info == 1) {
                            toastr.success("Solicitud eliminada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else if (data.info == 2) {
                            toastr.error("No se puede eliminar la solicitud, ya que tiene elementos asignados");
                        } else {
                            toastr.error("Error al eliminar la solicitud");
                        }
                    },
                    error: function (data) {
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al eliminar la solicitud");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnRechazar", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, rechazar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("fast");
                $.ajax({
                    url: "rechazar_solicitud_inventario",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        $("#global-loader").fadeOut("fast");
                        if (data.info == 1) {
                            toastr.success("Solicitud rechazada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(data.mensaje);
                        }
                    },
                    error: function (data) {
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al rechazar la solicitud");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnAsignarIndividual", function () {
        let id = $(this).attr("data-id");
        let elemento = $(this).attr("data-elemento");
        let cantidad = $(this).attr("data-cantidad");

        $("#id_solicitud_gestion").val(id);
        $("#elemento_solicitud_gestion").val(elemento);
        $("#cantidad_solicitud_gestion").val(cantidad);

        $("#modalView").modal("hide");
        $("#modalAsignar").modal({ backdrop: "static", keyboard: false });
        $("#modalAsignar").modal("show");
    });

    $(document).on("click", ".btnRechazarIndividual", function () {
        let id = $(this).attr("data-id");
        $("#modalView").modal("hide");
        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, rechazar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("fast");
                $("#modalView").modal("hide");
                $.ajax({
                    url: "solicitud_inventario_rechazar",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            $("#modalView").modal("hide");
                            if (response.reload == 1) {
                                toastr.success("Todos los elementos han sido gestionados");
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.success("Elemento rechazado con éxito");
                                $(document).find(".btnView[data-id=" + btn_View + "]").click();
                            }
                        } else {
                            toastr.error("Error al gestionar el elemento");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al gestionar el elemento");
                        $("#btnAsignarElemento").attr("disabled", false);
                        $("#btnAsignarElemento").html("Asignar Elemento");
                        console.log(error);
                    },
                });
            } else {
                $(document).find(".btnView[data-id=" + btn_View + "]").click();
            }
        }
        );
    });

    $("#btnCloseAsignar").click(function () {
        $("#modalAsignar").modal("hide");
        $("#modalView").modal("show");
    });

    $("#btn_save_solicitud").click(function () {
        let tipo = $("#tiposalida_selectadd").val();
        let cliente = $("#clienteadd").val();
        let reparacion = $("#reparacionadd").val();
        let descripcion = $("#descripcionadd").val();
        let elementos = [];
        let cantidad = [];
        let error = false;

        $(".elementoadd").each(function () {
            if ($(this).val().trim().length == 0) {
                error = true;
            } else {
                elementos.push($(this).val());
            }
        });

        $(".cantidadadd").each(function () {
            if ($(this).val().trim().length == 0 || $(this).val() < 1) {
                error = true;
            } else {
                cantidad.push($(this).val());
            }
        });

        if (tipo == "") {
            toastr.error("Seleccione un motivo");
            return;
        } else if (tipo != 6 && cliente == "") {
            toastr.error("Seleccione un cliente");
            return;
        } else if (descripcion == "" || descripcion == null) {
            toastr.error("Ingrese una descripción");
            return;
        } else if (error) {
            toastr.error("Verifique los elementos y cantidades");
            return;
        } else if (tipo == 6 && reparacion == "") {
            toastr.error("Seleccione una reparación");
            return;
        } else {
            $("#btn_save_solicitud").attr("disabled", true);
            $("#btn_save_solicitud").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "solicitud_inventario_add",
                type: "POST",
                data: {
                    tipo: tipo,
                    cliente: cliente,
                    reparacion: reparacion,
                    descripcion: descripcion,
                    elementos: elementos,
                    cantidad: cantidad,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Solicitud guardada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        $("#btn_save_solicitud").attr("disabled", false);
                        $("#btn_save_solicitud").html("Guardar");
                        toastr.error("Error al guardar la solicitud");
                    }
                },
                error: function (data) {
                    $("#btn_save_solicitud").attr("disabled", false);
                    $("#btn_save_solicitud").html("Guardar");
                    toastr.error("Error al guardar la solicitud");
                },
            });
        }
    });

    $("#btn_update_solicitud").click(function () {
        let id = $("#solicitudid").val();
        let tipo = $("#tiposalida_selectedit").val();
        let cliente = $("#clienteedit").val();
        let reparacion = $("#reparacionedit").val();
        let descripcion = $("#descripcionedit").val();
        let elementos = [];
        let cantidad = [];
        let error = false;

        $(".elementoedit").each(function () {
            if ($(this).val().trim().length == 0) {
                error = true;
            } else {
                elementos.push($(this).val());
            }
        });

        $(".cantidadedit").each(function () {
            if ($(this).val().trim().length == 0 || $(this).val() < 1) {
                error = true;
            } else {
                cantidad.push($(this).val());
            }
        });

        if (tipo == "") {
            toastr.error("Seleccione un motivo");
            return;
        } else if (tipo != 6 && cliente == "") {
            toastr.error("Seleccione un cliente");
            return;
        } else if (descripcion == "" || descripcion == null) {
            toastr.error("Ingrese una descripción");
            return;
        } else if (error) {
            toastr.error("Verifique los elementos y cantidades");
            return;
        } else if (tipo == 6 && reparacion == "") {
            toastr.error("Seleccione una reparación");
            return;
        } else {
            $("#btn_update_solicitud").attr("disabled", true);
            $("#btn_update_solicitud").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...'
            );
            $.ajax({
                url: "solicitud_inventario_update",
                type: "POST",
                data: {
                    id: id,
                    tipo: tipo,
                    cliente: cliente,
                    reparacion: reparacion,
                    descripcion: descripcion,
                    elementos: elementos,
                    cantidad: cantidad,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Solicitud actualizada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else if (data.info == 2) {
                        $("#btn_update_solicitud").attr("disabled", false);
                        $("#btn_update_solicitud").html("Modificar");
                        toastr.warning("No se puede modificar los elementos de la solicitud, porque ya se encuentra en proceso");
                    } else {
                        $("#btn_update_solicitud").attr("disabled", false);
                        $("#btn_update_solicitud").html("Modificar");
                        toastr.error("Error al actualizar la solicitud");
                    }
                },
                error: function (data) {
                    $("#btn_update_solicitud").attr("disabled", false);
                    $("#btn_update_solicitud").html("Modificar");
                    toastr.error("Error al actualizar la solicitud");
                },
            });
        }
    });

    // OTROS
    $(document).on("click", ".btn_AlmacenSalida", function () {
        id_almacen_salida = $(this).data("id");

        $(".btn_AlmacenSalida").parent().css("color", "#56546d");
        $(this).parent().css("color", "#0ba360");
    });

    $("#producto_gestion").change(function () {
        let producto = $(this).val();

        if (producto != "") {
            $.ajax({
                url: "data_detalle_producto",
                type: "POST",
                data: { id: producto },
                success: function (response) {
                    let data = response.data;
                    let inventario = data.inventario;
                    if (response.info == 1) {

                        $(".elemento_gestion").empty();
                        inventario.forEach((element) => {
                            if (element.cantidad > 0) {
                                $(".elemento_gestion").append(
                                    "<option data-cantidad='" +
                                    element.cantidad +
                                    "' value='" +
                                    element.id +
                                    "'>" +
                                    element.serial +
                                    " (Disponible: " +
                                    element.cantidad +
                                    ")" +
                                    "</option>"
                                );

                                data_seriales_gestion.push({
                                    id: element.id,
                                    serial: element.serial,
                                    cantidad: element.cantidad,
                                });
                            }
                        });

                        $("#btnAsignarElemento").attr("disabled", false);
                    } else {
                        toastr.error("Error al cargar los datos");
                    }
                },
                error: function (error) {
                    toastr.error("Error al cargar los datos");
                    console.log(error);
                },
            });
        } else {
            $(".elemento_gestion").empty();
            $("#btnAsignarElemento").attr("disabled", true);
        }
    });

    $("#btnAsignarElemento").click(function () {
        let solicitud = $("#id_solicitud_gestion").val();
        let producto = $("#producto_gestion").val();
        let data = [];
        let valid = false;
        let valid_2 = false;
        let max_cantidad = $("#cantidad_solicitud_gestion").val();
        let cantidad_all = 0;

        $(".elemento_gestion").each(function () {
            let serial = $(this).val();
            let disponible = $(this).find("option:selected").data("cantidad");
            let cantidad = $(this)
                .parent()
                .parent()
                .find(".cantidad_gestion")
                .val();

            if (serial != "" && serial != null && cantidad > 0) {
                if (cantidad > disponible) {
                    valid = true;
                }

                data.push({
                    serial: serial,
                    cantidad: parseInt(cantidad),
                });
                cantidad_all += parseInt(cantidad);
            } else {
                valid = true;
            }
        });

        data_seriales_gestion.forEach((element) => {
            let count = 0;
            data.forEach((element_2) => {
                if (element.id == element_2.serial) {
                    count++;
                }
            });

            if (count > 1) {
                valid_2 = true;
            }
        });

        if (producto == "" || producto == null) {
            toastr.error("Debe seleccionar un producto");
            return false;
        } else if (valid) {
            toastr.error("Verifique los elementos y cantidades");
            return false;
        } else if (valid_2) {
            toastr.error("No puede asignar el mismo elemento más de una vez");
            return false;
        } else if (cantidad_all != max_cantidad) {
            toastr.error("Las cantidades asignadas no coincide con la cantidad de la solicitud");
            return false;
        } else if (id_almacen_salida == 0) {
            toastr.error("Debe seleccionar un almacén de salida");
            return false;
        } else {
            $("#btnAsignarElemento").attr("disabled", true);
            $("#btnAsignarElemento").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "solicitud_inventario_asignado",
                type: "POST",
                data: {
                    solicitud: solicitud,
                    producto: producto,
                    data: data,
                    almacen: id_almacen_salida,
                },
                success: function (response) {
                    $("#btnAsignarElemento").attr("disabled", false);
                    $("#btnAsignarElemento").html("Asignar Elemento");
                    if (response.info == 1) {


                        $("#elemento_gestion").empty();
                        $("#btnAsignarElemento").attr("disabled", true);
                        $("#producto_gestion").val("").trigger("change");
                        $("#modalAsignar").modal("hide");

                        if (response.reload == 1) {
                            toastr.success("Todos los elementos han sido asignados");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.success("Elemento asignado con éxito");
                            $(document).find(".btnView[data-id=" + btn_View + "]").click();
                        }
                    } else {
                        toastr.error("Error al gestionar el elemento");
                    }
                },
                error: function (error) {
                    toastr.error("Error al gestionar el elemento");
                    $("#btnAsignarElemento").attr("disabled", false);
                    $("#btnAsignarElemento").html("Asignar Elemento");
                    console.log(error);
                },
            });
        }
    });

    $("#tiposalida_selectadd").change(function () {
        let val = $(this).val();

        if (val == 6) {
            $("#reparacionadd").parent().removeClass("d-none");
            $("#clienteadd").parent().addClass("d-none");
            $("#clienteadd").val("").trigger("change");
            $("#reparacionadd").val("").trigger("change");

            $.ajax({
                url: "mis_reparaciones",
                type: "POST",
                success: function (response) {
                    let data = response.data;
                    if (response.info == 1) {
                        $("#reparacionadd").empty();
                        $("#reparacionadd").append("<option value=''>Seleccione</option>");
                        data.forEach((element) => {
                            $("#reparacionadd").append(
                                "<option value='" + element.id + "'>" + element.token + "</option>"
                            );
                        });
                    }

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                },
                error: function (error) {
                    toastr.error("Error al cargar los datos");
                    console.log(error);
                },
            });
        } else {
            $("#clienteadd").parent().removeClass("d-none");
            $("#reparacionadd").parent().addClass("d-none");
            $("#reparacionadd").val("").trigger("change");
            $("#clienteadd").val("").trigger("change");
        }
    });

    $("#tiposalida_selectedit").change(function () {
        let val = $(this).val();

        if (val == 6) {
            $("#reparacionedit").parent().removeClass("d-none");
            $("#clienteedit").parent().addClass("d-none");
            $("#clienteedit").val("").trigger("change");
            $("#reparacionedit").val("").trigger("change");

            $.ajax({
                url: "mis_reparaciones",
                type: "POST",
                success: function (response) {
                    let data = response.data;
                    if (response.info == 1) {
                        $("#reparacionedit").empty();
                        $("#reparacionedit").append("<option value=''>Seleccione</option>");
                        data.forEach((element) => {
                            $("#reparacionedit").append(
                                "<option value='" + element.id + "'>" + element.token + "</option>"
                            );
                        });
                    }

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                },
                error: function (error) {
                    toastr.error("Error al cargar los datos");
                    console.log(error);
                },
            });
        } else {
            $("#clienteedit").parent().removeClass("d-none");
            $("#reparacionedit").parent().addClass("d-none");
            $("#reparacionedit").val("").trigger("change");
            $("#clienteedit").val("").trigger("change");
        }
    });

    $("#tiposalida_selectview").change(function () {
        let val = $(this).val();

        if (val == 6) {
            $("#reparacionview").parent().removeClass("d-none");
            $("#clienteview").parent().addClass("d-none");
            $("#clienteview").val("").trigger("change");
            $("#reparacionview").val("").trigger("change");

            $.ajax({
                url: "mis_reparaciones",
                type: "POST",
                success: function (response) {
                    let data = response.data;
                    if (response.info == 1) {
                        $("#reparacionview").empty();
                        $("#reparacionview").append("<option value=''>Seleccione</option>");
                        data.forEach((element) => {
                            $("#reparacionview").append(
                                "<option value='" + element.id + "'>" + element.token + "</option>"
                            );
                        });
                    }

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                },
                error: function (error) {
                    toastr.error("Error al cargar los datos");
                    console.log(error);
                },
            });
        } else {
            $("#clienteview").parent().removeClass("d-none");
            $("#reparacionview").parent().addClass("d-none");
            $("#reparacionview").val("").trigger("change");
            $("#clienteview").val("").trigger("change");
        }
    });
});
