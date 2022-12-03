$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

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

        $("#btnGuardarAsignacion").attr("disabled", true);
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
                    window.location.href = "gestionar_asignaciones";
                } else {
                    toastr.error("Error al crear la asignación");
                    $("#btnGuardarAsignacion").attr("disabled", false);
                }
            },
            error: function (error) {
                toastr.error("Error al crear la asignación");
                $("#btnGuardarAsignacion").attr("disabled", false);
            },
        });
    });

    $(".btn_completar").click(function () {
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
                            window.location.href = "gestionar_asignaciones";
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

    $(".btn_rechazar").click(function () {
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
                            window.location.href = "gestionar_asignaciones";
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

    $(".btn_eliminar").click(function () {
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
                            window.location.href = "gestionar_asignaciones";
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
});
