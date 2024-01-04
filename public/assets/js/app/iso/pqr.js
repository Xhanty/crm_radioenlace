$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btnDelete", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "pqr_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("PQR eliminado correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function (error) {
                        toastr.error("Ha ocurrido un error al eliminar el PQR");
                        console.log(error);
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnCancelar", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, cancelar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "pqr_status",
                    type: "POST",
                    data: {
                        id: id,
                        status: 2,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("PQR cancelado correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function (error) {
                        toastr.error("Ha ocurrido un error al cancelar el PQR");
                        console.log(error);
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnAprobar", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, aprobar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "pqr_status",
                    type: "POST",
                    data: {
                        id: id,
                        status: 1,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("PQR finalizado correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function (error) {
                        toastr.error(
                            "Ha ocurrido un error al finalizar el PQR"
                        );
                        console.log(error);
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnView", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        $.ajax({
            url: "pqr_get",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#cliente_view")
                        .val(response.data.empresa)
                        .trigger("change");
                    $("#mes_view").val(response.data.mes);
                    $("#medio_view").val(response.data.medio_comunicacion);
                    $("#queja_view").val(response.data.queja);
                    $("#tratamiento_view").val(response.data.tratamiento);
                    $("#evidencia_view").val(response.data.evidencia);
                    $("#seguimiento_view").val(response.data.seguimiento);
                    $("#correcion_view").val(response.data.correcion);
                    $("#respuesta_view").val(response.data.respuesta);
                    $("#fecha_view").val(response.data.fecha);
                    $("#usuario_view").val(response.data.usuario);
                    $("#estado_view").val(response.data.estado);
                    $("#modalView").modal("show");
                } else {
                    toastr.error(response.error);
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error al obtener el PQR");
                console.log(error);
            },
        });
    });

    $(document).on("click", ".btnEdit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#id_edit").val(id);

        $.ajax({
            url: "pqr_get",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#cliente_edit")
                        .val(response.data.empresa)
                        .trigger("change");
                    $("#mes_edit").val(response.data.mes);
                    $("#medio_edit").val(response.data.medio_comunicacion);
                    $("#queja_edit").val(response.data.queja);
                    $("#respuesta_edit").val(response.data.respuesta);
                    $("#fecha_edit").val(response.data.fecha);
                    $("#usuario_edit").val(response.data.usuario);
                    $("#estado_edit").val(response.data.estado);
                    $("#modalEdit").modal("show");
                } else {
                    toastr.error(response.error);
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error al obtener el PQR");
                console.log(error);
            },
        });
    });

    $(document).on("click", ".btnTratamiento", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#id_tratamiento").val(id);

        $.ajax({
            url: "pqr_get",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#codigo_tratamiento").val(response.data.codigo);
                    $("#tratamiento_add").val(response.data.tratamiento);
                    $("#modalTratamiento").modal("show");
                } else {
                    toastr.error(response.error);
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error al obtener el PQR");
                console.log(error);
            },
        });
    });

    $(document).on("click", ".btnEvidencia", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#id_evidencia").val(id);

        $.ajax({
            url: "pqr_get",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#codigo_evidencia").val(response.data.codigo);
                    $("#evidencia_add").val(response.data.evidencia);
                    $("#modalEvidencia").modal("show");
                } else {
                    toastr.error(response.error);
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error al obtener el PQR");
                console.log(error);
            },
        });
    });

    $(document).on("click", ".btnSeguimiento", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#id_evidencia").val(id);

        $.ajax({
            url: "pqr_get",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#codigo_seguimiento").val(response.data.codigo);
                    $("#seguimiento_add").val(response.data.seguimiento);
                    $("#modalSeguimiento").modal("show");
                } else {
                    toastr.error(response.error);
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error al obtener el PQR");
                console.log(error);
            },
        });
    });

    $(document).on("click", ".btnCorrecion", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#id_evidencia").val(id);

        $.ajax({
            url: "pqr_get",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#codigo_correcion").val(response.data.codigo);
                    $("#correcion_add").val(response.data.correcion);
                    $("#modalCorrecion").modal("show");
                } else {
                    toastr.error(response.error);
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error al obtener el PQR");
                console.log(error);
            },
        });
    });

    $("#btnGuardar").click(function (e) {
        e.preventDefault();
        var empresa = $("#cliente_add").val();
        var mes = $("#mes_add").val();
        var medio = $("#medio_add").val();
        var queja = $("#queja_add").val();

        if (!empresa) {
            toastr.error("El campo empresa es obligatorio");
        } else if (mes.trim().length == 0) {
            toastr.error("El campo mes es obligatorio");
        } else if (medio.trim().length == 0) {
            toastr.error("El campo medio de comunicación es obligatorio");
        } else if (queja.trim().length == 0) {
            toastr.error("El campo queja es obligatorio");
        } else {
            $("#btnGuardar").attr("disabled", true);
            $("#btnGuardar").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "pqr_add",
                type: "POST",
                data: {
                    empresa: empresa,
                    mes: mes,
                    medio: medio,
                    queja: queja,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("PQR creado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Ha ocurrido un error al crear el PQR");
                        $("#btnGuardar").attr("disabled", false);
                        $("#btnGuardar").html("Modificar");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al crear el PQR");
                    $("#btnGuardar").attr("disabled", false);
                    $("#btnGuardar").html("Modificar");
                    console.log(error);
                },
            });
        }
    });

    $("#btnModificar").click(function (e) {
        e.preventDefault();
        var id = $("#id_edit").val();
        var empresa = $("#cliente_edit").val();
        var mes = $("#mes_edit").val();
        var medio = $("#medio_edit").val();
        var queja = $("#queja_edit").val();

        if (!empresa) {
            toastr.error("El campo empresa es obligatorio");
        } else if (mes.trim().length == 0) {
            toastr.error("El campo mes es obligatorio");
        } else if (medio.trim().length == 0) {
            toastr.error("El campo medio de comunicación es obligatorio");
        } else if (queja.trim().length == 0) {
            toastr.error("El campo queja es obligatorio");
        } else {
            $("#btnModificar").attr("disabled", true);
            $("#btnModificar").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "pqr_edit",
                type: "POST",
                data: {
                    id: id,
                    empresa: empresa,
                    mes: mes,
                    medio: medio,
                    queja: queja,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("PQR modificado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar el PQR"
                        );
                        $("#btnModificar").attr("disabled", false);
                        $("#btnModificar").html("Modificar");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al modificar el PQR");
                    $("#btnModificar").attr("disabled", false);
                    $("#btnModificar").html("Modificar");
                    console.log(error);
                },
            });
        }
    });

    // Guardar Tratamiento
    $("#btnModificarTratamiento").click(function (e) {
        e.preventDefault();
        var id = $("#id_tratamiento").val();
        var tratamiento = $("#tratamiento_add").val();

        if (tratamiento.trim().length == 0) {
            toastr.error("El campo tratamiento es obligatorio");
        } else {
            $("#btnModificarTratamiento").attr("disabled", true);
            $("#btnModificarTratamiento").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "pqr_tratamiento_update",
                type: "POST",
                data: {
                    id: id,
                    tratamiento: tratamiento,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(
                            "Tratamiento modificado correctamente"
                        );
                        $("#btnModificarTratamiento").attr(
                            "disabled",
                            false
                        );
                        $("#btnModificarTratamiento").html("Modificar Tratamiento");
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar el tratamiento"
                        );
                        $("#btnModificarTratamiento").attr(
                            "disabled",
                            false
                        );
                        $("#btnModificarTratamiento").html("Modificar Tratamiento");
                    }
                },
                error: function (error) {
                    toastr.error(
                        "Ha ocurrido un error al modificar el tratamiento"
                    );
                    $("#btnModificarTratamiento").attr("disabled", false);
                    $("#btnModificarTratamiento").html("Modificar Tratamiento");
                    console.log(error);
                },
            });
        }
    });

    // Guardar Evidencia
    $("#btnModificarEvidencia").click(function (e) {
        e.preventDefault();
        var id = $("#id_evidencia").val();
        var evidencia = $("#evidencia_add").val();

        if (evidencia.trim().length == 0) {
            toastr.error("El campo evidencia es obligatorio");
        } else {
            $("#btnModificarEvidencia").attr("disabled", true);
            $("#btnModificarEvidencia").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "pqr_evidencia_update",
                type: "POST",
                data: {
                    id: id,
                    evidencia: evidencia,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Evidencia modificada correctamente");
                        $("#btnModificarEvidencia").attr("disabled", false);
                        $("#btnModificarEvidencia").html("Modificar Evidencia");
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar la evidencia"
                        );
                        $("#btnModificarEvidencia").attr("disabled", false);
                        $("#btnModificarEvidencia").html("Modificar Evidencia");
                    }
                },
                error: function (error) {
                    toastr.error(
                        "Ha ocurrido un error al modificar la evidencia"
                    );
                    $("#btnModificarEvidencia").attr("disabled", false);
                    $("#btnModificarEvidencia").html("Modificar Evidencia");
                    console.log(error);
                },
            });
        }
    });

    // Guardar Seguimiento
    $("#btnModificarSeguimiento").click(function (e) {
        e.preventDefault();
        var id = $("#id_evidencia").val();
        var seguimiento = $("#seguimiento_add").val();

        if (seguimiento.trim().length == 0) {
            toastr.error("El campo seguimiento es obligatorio");
        } else {
            $("#btnModificarSeguimiento").attr("disabled", true);
            $("#btnModificarSeguimiento").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "pqr_seguimiento_update",
                type: "POST",
                data: {
                    id: id,
                    seguimiento: seguimiento,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(
                            "Seguimiento modificado correctamente"
                        );
                        $("#btnModificarSeguimiento").attr(
                            "disabled",
                            false
                        );
                        $("#btnModificarSeguimiento").html("Modificar Seguimiento");
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar el seguimiento"
                        );
                        $("#btnModificarSeguimiento").attr(
                            "disabled",
                            false
                        );
                        $("#btnModificarSeguimiento").html("Modificar Seguimiento");
                    }
                },
                error: function (error) {
                    toastr.error(
                        "Ha ocurrido un error al modificar el seguimiento"
                    );
                    $("#btnModificarSeguimiento").attr("disabled", false);
                    $("#btnModificarSeguimiento").html("Modificar Seguimiento");
                    console.log(error);
                },
            });
        }
    });

    // Guardar Correcion
    $("#btnModificarCorrecion").click(function (e) {
        e.preventDefault();
        var id = $("#id_evidencia").val();
        var correcion = $("#correcion_add").val();

        if (correcion.trim().length == 0) {
            toastr.error("El campo correcion es obligatorio");
        } else {
            $("#btnModificarCorrecion").attr("disabled", true);
            $("#btnModificarCorrecion").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "pqr_correcion_update",
                type: "POST",
                data: {
                    id: id,
                    correcion: correcion,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Correcion modificada correctamente");
                        $("#btnModificarCorrecion").attr("disabled", false);
                        $("#btnModificarCorrecion").html("Modificar Correcion");
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar la correcion"
                        );
                        $("#btnModificarCorrecion").attr("disabled", false);
                        $("#btnModificarCorrecion").html("Modificar Correcion");
                    }
                },
                error: function (error) {
                    toastr.error(
                        "Ha ocurrido un error al modificar la correcion"
                    );
                    $("#btnModificarCorrecion").attr("disabled", false);
                    $("#btnModificarCorrecion").html("Modificar Correcion");
                    console.log(error);
                },
            });
        }
    });
});
