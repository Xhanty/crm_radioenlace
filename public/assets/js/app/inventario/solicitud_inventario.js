$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    let concat_add = '<div class="row row-sm mt-2">' +
        '<div class="col-8" >' +
        '<input class="form-control elementoadd" placeholder="Elemento" type="text">' +
        '</div>' +
        '<div class="col-3">' +
        '<input class="form-control cantidadadd" placeholder="Cantidad" type="number" min="1" step="1">' +
        '</div>' +
        '<div class="col-1 center-vertical">' +
        '<a class="btn_delete_row_add" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        '</a>' +
        '</div>' +
        '</div > ';

    let concat_edit = '<div class="row row-sm mt-2">' +
        '<div class="col-8" >' +
        '<input class="form-control elementoedit" placeholder="Elemento" type="text">' +
        '</div>' +
        '<div class="col-3">' +
        '<input class="form-control cantidadedit" placeholder="Cantidad" type="number" min="1" step="1">' +
        '</div>' +
        '<div class="col-1 center-vertical">' +
        '<a class="btn_delete_row_add" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        '</a>' +
        '</div>' +
        '</div > ';

    $("#new_row_elemento").click(function () {
        $("#div_list_elementos").append(concat_add);
    });

    $("#new_row_elemento_edit").click(function () {
        $("#div_list_elementos_edit").append(concat_edit);
    });

    $(document).on("click", ".btn_delete_row_add", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".btn_delete_row_edit", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".btnView", function () {
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
                    var URLactual = window.location.pathname;

                    $("#clienteview").val(solicitud.cliente_id).trigger("change");
                    $("#descripcionview").val(solicitud.descripcion);

                    let concat_view = "Elementos";
                    elementos.forEach((elemento) => {
                        var action = "";
                        var col = "col-4";

                        if (URLactual == "/gestion_solicitudes") {
                            action = '<div class="col-1 center-vertical">' + '<a title="Asignar" class="btnAsignarIndividual" data-id="' + elemento.id + '" href="javascript:void(0)">' + '<i class="fa fa-check"></i>' + '</a>' + '</div>';
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
                    $("#clienteedit").val(solicitud.cliente_id).trigger("change");
                    $("#descripcionedit").val(solicitud.descripcion);

                    $(".elementoedit").val(primer_elemento.elemento);
                    $(".cantidadedit").val(primer_elemento.cantidad);

                    let concat_view = "";

                    elementos.forEach((elemento) => {
                        if (val > 1) {
                            concat_view += '<div class="row row-sm mt-2">' +
                                '<div class="col-8" >' +
                                '<input class="form-control elementoedit" title="Elemento" placeholder="Elemento" type="text" value="' + elemento.elemento + '">' +
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
                            toastr.error("Error al rechazar la solicitud");
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
    
    $(document).on("click", ".btnAceptar", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, aceptar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("fast");
                $.ajax({
                    url: "aceptar_solicitud_inventario",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        $("#global-loader").fadeOut("fast");
                        if (data.info == 1) {
                            toastr.success("Solicitud aceptada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function (data) {
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al aceptar la solicitud");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnAsignarIndividual", function () {
        let id = $(this).attr("data-id");
        $("#id_solicitud_gestion").val(id);
        $("#modalView").modal("hide");
        $("#modalAsignar").modal("show");
    });

    $("#btn_save_solicitud").click(function () {
        let cliente = $("#clienteadd").val();
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
        if (cliente == "" || cliente == null) {
            toastr.error("Seleccione un cliente");
            return;
        } else if (descripcion == "" || descripcion == null) {
            toastr.error("Ingrese una descripción");
            return;
        } else if (error) {
            toastr.error("Verifique los elementos y cantidades");
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
                    cliente: cliente,
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
        let cliente = $("#clienteedit").val();
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
        if (cliente == "" || cliente == null) {
            toastr.error("Seleccione un cliente");
            return;
        } else if (descripcion == "" || descripcion == null) {
            toastr.error("Ingrese una descripción");
            return;
        } else if (error) {
            toastr.error("Verifique los elementos y cantidades");
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
                    cliente: cliente,
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
});
