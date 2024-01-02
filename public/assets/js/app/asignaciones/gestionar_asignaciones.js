$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //$(".open-toggle").trigger("click");
    $("#menu_otro_asignaciones").addClass("is-expanded");
    $("#1_otro_asignaciones").show();
    $("#1_1_otro_asignaciones").show();

    let opciones = "";

    $(".empleadoadd option").each(function () {
        opciones += `<option value="${$(this).val()}">${$(
            this
        ).text()}</option>`;
    });

    let concat =
        '<div class="row row-sm">' +
        '<div class="col-lg center-vertical">' +
        '<select class="form-select empleadoadd">' +
        opciones +
        "</select>" +
        "</div>" +
        '<div class="col-lg mg-t-10" style="display: flex">' +
        '<textarea class="form-control observacionesadd" placeholder="Asignación individual de este empleado" rows="2"' +
        'style="height: 50px; resize: none"></textarea>' +
        '<a class="center-vertical mg-s-10 delete_row_empleado" href="#"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    $("#new_row_empleado").click(function () {
        $("#div_new_empleados").append(concat);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".delete_row_empleado", function () {
        $(this).parent().parent().remove();
    });

    $("#btnGuardarAsignacion").click(function (e) {
        e.preventDefault();
        let empleados = [];
        let observaciones = [];
        let observacion_general = $("#observacion_generaladd").val();
        let fecha_inicio = $("#fecha_inicioadd").val();
        let fecha_fin = $("#fecha_finadd").val();
        let anexos = $("#anexosadd").get(0).files;

        $(".empleadoadd").each(function () {
            empleados.push($(this).val());
        });

        $(".observacionesadd").each(function () {
            observaciones.push($(this).val());
        });

        let formData = new FormData();
        formData.append("empleados", empleados);
        formData.append("observaciones", observaciones);
        formData.append("observacion_general", observacion_general);
        formData.append("fecha_inicio", fecha_inicio);
        formData.append("fecha_fin", fecha_fin);

        for (var i = anexos.length - 1; i >= 0; i--) {
            formData.append("anexos[]", anexos[i]);
        }

        if (observacion_general == "") {
            toastr.warning("Debe agregar una observación general");
            return false;
        } else if (fecha_inicio == "") {
            toastr.warning("Debe agregar una fecha de inicio");
            return false;
        } else if (fecha_fin == "") {
            toastr.warning("Debe agregar una fecha de fin");
            return false;
        }

        $("#btnGuardarAsignacion").attr("disabled", true);
        $("#btnGuardarAsignacion").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "asignacion_add",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al crear la asignación");
                    $("#btnGuardarAsignacion").attr("disabled", false);
                    $("#btnGuardarAsignacion").html("Guardar");
                }
            },
            error: function (error) {
                toastr.error("Error al crear la asignación");
                $("#btnGuardarAsignacion").attr("disabled", false);
                $("#btnGuardarAsignacion").html("Guardar");
            },
        });
    });

    $(document).on("click", ".btn_completar", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Deseas completar la asignación?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "change_asignacion",
                    data: { id: id, status: 1 },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al completar la asignación");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al completar la asignación");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_rechazar", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Deseas rechazar la asignación?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "change_asignacion",
                    data: { id: id, status: 0 },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al rechazar la asignación");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al rechazar la asignación");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_eliminar", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Deseas eliminar la asignación?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "eliminar_asignacion",
                    data: { id: id },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar la asignación");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar la asignación");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_avances", function () {
        $("#global-loader").show();
        let id = $(this).data("id");
        $("#tbl_view_avances tbody").empty();
        $.ajax({
            url: "asignaciones_data",
            type: "POST",
            data: { id: id },
            success: function (data) {
                let avances = data.data;
                //console.log(avances);

                avances.forEach((avance) => {
                    let file_archivo = "Sin Archivo Adjunto";
                    let status = "";
                    if (avance.archivo != null && avance.archivo != "") {
                        file_archivo = `<a href="images/anexos_asignaciones/${avance.archivo}" target="_blank">Ver Archivo</a>`;
                    }

                    if (avance.id_status == 1) {
                        status = `<span class="badge bg-warning">En Progreso</span>`;
                    } else if (avance.id_status == 2) {
                        status = `<span class="badge bg-success">Completado</span>`;
                    } else if (avance.id_status == 0) {
                        status = `<span class="badge bg-danger">Asignado</span>`;
                    }

                    $("#tbl_view_avances tbody").append(`
                        <tr>
                            <td>${avance.fecha}</td>
                            <td>${file_archivo}</td>
                            <td>${avance.descripcion}</td>
                            <td>${status}</td>
                        </tr>
                    `);
                });

                $("#modalView").modal("show");
                $("#global-loader").hide();
            },
            error: function (data) {
                $("#global-loader").hide();
                console.log(data);
            },
        });
    });

    $(document).on("change", ".visto_bueno_check", function () {
        let id = $(this).data("id");
        let visto_bueno = $(this).is(":checked") ? 1 : 0;
        $.ajax({
            url: "change_visto_bueno",
            type: "POST",
            data: { id: id, visto_bueno: visto_bueno },
            success: function (data) {
                toastr.success("Visto bueno actualizado");
            },
            error: function (data) {
                toastr.error("Error al actualizar visto bueno");
            },
        });
    });

    $(document).on("click", ".btn_editar", function () {
        $("#global-loader").show();
        let id = $(this).data("id");
        $("#tbl_anexos_asignacion tbody").empty();
        $.ajax({
            url: "asignaciones_data",
            type: "POST",
            data: { id: id },
            success: function (data) {
                let asignacion = data.asignacion;
                let archivos = data.archivos;
                $("#idasignacionedit").val(asignacion.id);
                $("#empleadoedit").val(asignacion.id_empleado);
                $("#observacionesedit").val(asignacion.asignacion);
                $("#observacion_generaledit").val(asignacion.descripcion);
                $("#fecha_inicioedit").val(asignacion.fecha);
                $("#fecha_finedit").val(asignacion.fecha_culminacion);
                archivos.forEach((archivo) => {
                    $("#tbl_anexos_asignacion tbody").append(`
                        <tr>
                            <td><a href="images/asignaciones/${archivo.archivo}" target="_blank">Ver Archivo</a></td>
                            <td><button class="btn btn-danger btn-sm btn_eliminar_archivo" data-padre="${id}" data-id="${archivo.id}"><i class="fa fa-trash"></i></button></td>
                        </tr>
                    `);
                });
                $("#global-loader").hide();
                $("#modalEdit").modal("show");
            },
            error: function (data) {
                toastr.error("Error al obtener datos de la asignación");
                $("#global-loader").hide();
            },
        });
    });

    $(document).on("click", ".btn_eliminar_archivo", function () {
        let id = $(this).data("id");
        let id_asignacion = $(this).data("padre");
        $("#modalEdit").modal("hide");
        Swal.fire({
            title: "¿Deseas eliminar el archivo?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "eliminar_archivo_asignacion",
                    type: "POST",
                    data: { id: id },
                    success: function (data) {
                        if(data.info == 1) {
                            toastr.success("Archivo eliminado");
                            $(".btn_editar[data-id='" + id_asignacion + "']").click();
                            $("#modalEdit").modal("show");
                        } else {
                            toastr.error("Error al eliminar el archivo");
                        }
                    },
                    error: function (data) {
                        toastr.error("Error al eliminar el archivo");
                        $("#modalEdit").modal("show");
                    },
                });
            } else {
                $("#modalEdit").modal("show");
            }
        });
    });

    $("#btnEditarAsignacion").click(function (e) {
        e.preventDefault();
        let id = $("#idasignacionedit").val();
        let empleado = $("#empleadoedit").val();
        let observacion = $("#observacionesedit").val();
        let observacion_general = $("#observacion_generaledit").val();
        let fecha_inicio = $("#fecha_inicioedit").val();
        let fecha_fin = $("#fecha_finedit").val();
        let anexos = $("#anexosedit").get(0).files;

        let formData = new FormData();
        formData.append("id", id);
        formData.append("empleado", empleado);
        formData.append("observacion", observacion);
        formData.append("observacion_general", observacion_general);
        formData.append("fecha_inicio", fecha_inicio);
        formData.append("fecha_fin", fecha_fin);

        for (var i = anexos.length - 1; i >= 0; i--) {
            formData.append("anexos[]", anexos[i]);
        }

        if (observacion_general == "") {
            toastr.warning("Debe agregar una observación general");
            return false;
        } else if (fecha_inicio == "") {
            toastr.warning("Debe agregar una fecha de inicio");
            return false;
        } else if (fecha_fin == "") {
            toastr.warning("Debe agregar una fecha de fin");
            return false;
        }

        $("#btnEditarAsignacion").attr("disabled", true);
        $("#btnEditarAsignacion").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "asignacion_edit",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al modificar la asignación");
                    $("#btnEditarAsignacion").attr("disabled", false);
                    $("#btnEditarAsignacion").html("Modificar");
                }
            },
            error: function (error) {
                toastr.error("Error al modificar la asignación");
                $("#btnEditarAsignacion").attr("disabled", false);
                $("#btnEditarAsignacion").html("Modificar");
            },
        });
    });
});
