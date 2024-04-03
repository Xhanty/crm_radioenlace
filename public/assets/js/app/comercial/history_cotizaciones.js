$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btnDelete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "history_cotizaciones_delete",
                    data: { id: id },
                    type: "POST",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Observación eliminada con éxito");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar la observación");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar la observación");
                        console.log(error);
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEdit", function () {
        let id = $(this).data("id");
        let observacion = $(this).data("mensaje");

        $("#observacion_id").val(id);
        $("#observacion_edit").val(observacion);
        $("#modalEdit").modal("show");
    });

    $("#btnGuardar").click(function () {
        let id = $("#cotizacion_id").val();
        let tipo = $("#tipo_observacion").val();
        let observacion = $("#observacion_add").val();
        let adjunto = $("#adjunto_add")[0].files[0];
        let valid = true;

        if (tipo == 1) {
            if (observacion == "") {
                valid = false;
                toastr.error("Debe ingresar una observación");
            }
        }

        if (tipo != 1) {
            if (adjunto == undefined) {
                valid = false;
                toastr.error("Debe seleccionar un archivo");
            }
        }

        if (!valid) return false;

        let formData = new FormData();
        formData.append("id", id);
        formData.append("tipo", tipo);
        formData.append("observacion", observacion);
        formData.append("adjunto", adjunto);

        $("#btnGuardar").attr("disabled", true);
        $("#btnGuardar").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "history_cotizaciones_add",
            data: formData,
            contentType: false,
            processData: false,
            type: "POST",
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Observación guardada con éxito");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $("#btnGuardar").attr("disabled", false);
                    $("#btnGuardar").html("Guardar");
                    toastr.error("Error al guardar la observación");
                }
            },
            error: function (error) {
                $("#btnGuardar").attr("disabled", false);
                $("#btnGuardar").html("Guardar");
                toastr.error("Error al guardar la observación");
                console.log(error);
            },
        });
    });

    $("#btnGuardarEdit").click(function () {
        let id = $("#observacion_id").val();
        let observacion = $("#observacion_edit").val();

        if (observacion == "") {
            toastr.error("Debe ingresar una observación");
        } else {
            $("#btnGuardarEdit").attr("disabled", true);
            $("#btnGuardarEdit").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "history_cotizaciones_edit",
                data: { id: id, observacion: observacion },
                type: "POST",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Observación editada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#btnGuardarEdit").attr("disabled", false);
                        $("#btnGuardarEdit").html("Guardar");
                        toastr.error("Error al editar la observación");
                    }
                },
                error: function (error) {
                    $("#btnGuardarEdit").attr("disabled", false);
                    $("#btnGuardarEdit").html("Guardar");
                    toastr.error("Error al editar la observación");
                    console.log(error);
                },
            });
        }
    });

    $("#btnCloseVista").click(function () {
        window.close();
    });

    $("#tipo_observacion").change(function () {
        let tipo = $(this).val();

        if (tipo == 1) {
            $("#content_adjunto_add").hide();
            $("#content_observacion_add").show();
        } else {
            $("#content_adjunto_add").show();
            $("#content_observacion_add").hide();
        }
    });

    $(document).on("change", ".checkAprobados", function () {
        let id = $(this).data("id");
        let tipo = $(this).data("tipo");
        let check = $(this).prop("checked") ? 1 : 0;

        $.ajax({
            url: "history_cotizaciones_contable",
            data: {
                id: id,
                tipo: tipo,
                check: check,
            },
            type: "POST",
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Modificación realizada con éxito");
                } else {
                    toastr.error("Error al modificar");
                }
            },
            error: function (error) {
                toastr.error("Error al modificar");
                console.log(error);
            },
        });
    });
});
