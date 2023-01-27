$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#menu_otro_asignaciones").addClass("is-expanded");
    $("#1_otro_asignaciones").show();
    $("#2_1_otro_asignaciones").show();
    $(".open-toggle").trigger("click");

    $(document).on("click", ".btn_openAvances", function () {
        $("#global-loader").show();
        let id = $(this).data("idshow");
        let asignacion = $(this).data("asignacion");
        $("#tbl_avances tbody").empty();
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

                    $("#tbl_avances tbody").append(`
                        <tr>
                            <td>${avance.fecha}</td>
                            <td>${file_archivo}</td>
                            <td>${avance.descripcion}</td>
                            <td>${status}</td>
                            <td><a href="javascript:void(0)" title="Eliminar" class="btn btn-sm btn-primary btn_DeleteAvance" data-idpadre="${id}" data-id="${avance.id}"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    `);
                });

                $("#asignacion_id_add").val(id);
                $("#modalAdd").modal("show");
                $("#global-loader").hide();
            },
            error: function (data) {
                $("#global-loader").hide();
                console.log(data);
            },
        });
    });

    $(document).on("click", ".btn_DeleteAvance", function () {
        let idpadre = $(this).data("idpadre");
        let id = $(this).data("id");
        $("#modalAdd").modal("hide");
        Swal.fire({
            title: "¿Estas seguro?",
            text: "No podras revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, Eliminar",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").show();
                $.ajax({
                    url: "asignaciones_avances_delete",
                    type: "POST",
                    data: { id: id },
                    success: function (data) {
                        if (data.info == 1) {
                            $('*[data-idshow="' + idpadre + '"]').click();
                            $("#global-loader").hide();
                            toastr.success("Se eliminó correctamente");
                        } else {
                            $("#global-loader").hide();
                            toastr.error("Ocurrió un error");
                            $("#modalAdd").modal("show");
                        }
                    },
                    error: function (data) {
                        $("#global-loader").hide();
                        toastr.error("Ocurrió un error");
                        $("#modalAdd").modal("show");
                    },
                });
            } else {
                $("#modalAdd").modal("show");
            }
        });
    });

    $(document).on("click", "#btnGuardarAvance", function () {
        let id = $("#asignacion_id_add").val();
        let descripcion = $("#descripcion_add").val();
        let status = $("#status_add").val();

        if (descripcion == "") {
            toastr.error("Debes ingresar una descripción");
            return false;
        } else {
            $("#global-loader").show();
            $("#modalAdd").modal("hide");
            let formData = new FormData();
            formData.append("asignacion_id", id);
            formData.append("descripcion", descripcion);
            formData.append("archivo", $("#archivo_add")[0].files[0]);
            formData.append("status", status);
            $.ajax({
                url: "asignaciones_avances_add",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.info == 1) {
                        $("#global-loader").hide();
                        $("#modalAdd").modal("hide");
                        $("#descripcion_add").val("");
                        $("#archivo_add").val("");
                        $('*[data-idshow="' + id + '"]').click();
                        toastr.success("Se guardó correctamente");

                        if (data.recargar == 1) {
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    } else {
                        $("#global-loader").hide();
                        $("#modalAdd").modal("show");
                        toastr.error("Ocurrió un error");
                    }
                },
                error: function (data) {
                    $("#global-loader").hide();
                    $("#modalAdd").modal("show");
                    toastr.error("Ocurrió un error");
                },
            });
        }
    });

    $(document).on("click", ".btn_viewAvances", function () {
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

    $(document).on("click", ".btn_openDetalles", function () {
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
                $("#asignacion_show").val(asignacion.asignacion);
                $("#cliente_show").val(asignacion.id_cliente).trigger("change");
                $("#observacion_show").val(asignacion.descripcion);
                $("#fecha_inicio_show").val(asignacion.fecha);
                $("#fecha_fin_show").val(asignacion.fecha_culminacion);
                archivos.forEach((archivo) => {
                    $("#tbl_anexos_asignacion tbody").append(`
                        <tr>
                            <td><a href="images/asignaciones/${archivo.archivo}" target="_blank">Ver Archivo</a></td>
                        </tr>
                    `);
                });
                $("#global-loader").hide();
                $("#modalDetalles").modal("show");
            },
            error: function (data) {
                toastr.error("Error al obtener datos de la asignación");
                $("#global-loader").hide();
            },
        });
    });
});
