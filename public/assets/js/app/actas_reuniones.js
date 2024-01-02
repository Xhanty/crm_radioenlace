$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var usuarios = JSON.parse(localStorage.getItem("usuarios"));

    $("#btnNewActa").click(function () {
        $("#div_list_actas").addClass("d-none");
        $("#div_new_acta").removeClass("d-none");
    });

    $(document).on("click", ".back_home", function () {
        $("#div_list_actas").removeClass("d-none");
        $("#div_new_acta").addClass("d-none");
    });

    $(document).on("click", ".back_home_edit", function () {
        // Recargar la página
        location.reload();
    });

    $("#new_row").click(function () {
        $("#tbl_data_detail tbody").append(
            '<tr style="background: #f9f9f9;">' +
                '<td class="pad-4">' +
                '<textarea placeholder="Compromiso" class="form-control compromiso_add" cols="30"' +
                'rows="2"></textarea>' +
                "</td>" +
                '<td class="pad-4">' +
                '<select class="form-select asistente_compromiso_add">' +
                '<option value="">Seleccione una opción</option>' +
                usuarios.map((item) => {
                    return (
                        '<option value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        "</option>"
                    );
                }) +
                "</select>" +
                "</td>" +
                '<td class="text-center pad-4">' +
                '<div class="d-flex">' +
                '<input type="date" placeholder="Fecha"' +
                'class="form-control text-center fecha_compromiso_add"' +
                'style="border: 0">' +
                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"' +
                '><i class="fa fa-trash"></i></a>' +
                "</div>" +
                "</td>" +
                "</tr>"
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".add_row_edit", function () {
        $("#tbl_data_detail_edit tbody").append(
            '<tr style="background: #f9f9f9;">' +
                '<td class="pad-4">' +
                '<textarea placeholder="Compromiso" class="form-control compromiso_edit" cols="30"' +
                'rows="2"></textarea>' +
                "</td>" +
                '<td class="pad-4">' +
                '<select class="form-select asistente_compromiso_edit">' +
                '<option value="">Seleccione una opción</option>' +
                usuarios.map((item) => {
                    return (
                        '<option value="' +
                        item.id +
                        '">' +
                        item.nombre +
                        "</option>"
                    );
                }) +
                "</select>" +
                "</td>" +
                '<td class="text-center pad-4">' +
                '<div class="d-flex">' +
                '<input type="date" placeholder="Fecha"' +
                'class="form-control text-center fecha_compromiso_edit"' +
                'style="border: 0">' +
                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"' +
                '><i class="fa fa-trash"></i></a>' +
                "</div>" +
                "</td>" +
                "</tr>"
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".delete_row", function () {
        $(this).parent().parent().parent().remove();
    });

    $("#btnAddActa").click(function () {
        var fecha_elaboracion = $("#fecha_add").val();
        var hora_inicio = $("#hora_ini_add").val();
        var hora_fin = $("#hora_fin_add").val();
        var area = $("#area_add").val();
        var asunto = $("#asunto_add").val();
        var asistentes = $("#asistentes_add").val();
        var observaciones = $("#observaciones_add").val();
        var adjunto = $("#adjunto_add")[0].files[0];
        var data = [];
        var valid = true;

        $("#tbl_data_detail tbody tr").each(function () {
            var compromiso = $(this).find(".compromiso_add").val();
            var asistente = $(this).find(".asistente_compromiso_add").val();
            var fecha = $(this).find(".fecha_compromiso_add").val();

            if (compromiso == "") {
                valid = false;
            } else if (asistente == "") {
                valid = false;
            } else if (fecha == "") {
                valid = false;
            }

            data.push({
                compromiso: compromiso,
                asistente: asistente,
                fecha: fecha,
            });
        });

        var formData = new FormData();
        formData.append("fecha_elaboracion", fecha_elaboracion);
        formData.append("hora_inicio", hora_inicio);
        formData.append("hora_fin", hora_fin);
        formData.append("area", area);
        formData.append("asunto", asunto);
        formData.append("asistentes", asistentes);
        formData.append("observaciones", observaciones);
        formData.append("adjunto", adjunto);
        formData.append("data", JSON.stringify(data));

        if (fecha_elaboracion == "") {
            toastr.error("Debe ingresar la fecha de elaboración");
            return false;
        } else if (hora_inicio == "") {
            toastr.error("Debe ingresar la hora de inicio");
            return false;
        } else if (hora_fin == "") {
            toastr.error("Debe ingresar la hora de fin");
            return false;
        } else if (area == "") {
            toastr.error("Debe ingresar el área");
            return false;
        } else if (asunto == "") {
            toastr.error("Debe ingresar el asunto");
            return false;
        } else if (asistentes == "") {
            toastr.error("Debe ingresar los asistentes");
            return false;
        } else if (observaciones == "") {
            toastr.error("Debe ingresar las observaciones");
            return false;
        } else if (data.length == 0) {
            toastr.error("Debe agregar al menos un compromiso");
            return false;
        } else if (!valid) {
            toastr.error("Debe completar todos los campos de los compromisos");
            return false;
        }


        $("#btnAddActa").attr("disabled", true);
        $("#btnAddActa").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
        $.ajax({
            url: "add_acta_reunion",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Acta guardada con éxito");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error("Ha ocurrido un error");
                    $("#btnAddActa").attr("disabled", false);
                    $("#btnAddActa").html("Guardar Acta");
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error");
                $("#btnAddActa").attr("disabled", false);
                $("#btnAddActa").html("Guardar Acta");
            },
        });
    });

    $(document).on("click", ".btnEdit", function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url: "data_acta_reunion",
            type: "POST",
            data: {
                id: id,
            },
            dataType: "JSON",
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;
                    let detalle = data.detalle;

                    console.log(data);

                    $("#div_list_actas").addClass("d-none");
                    $("#div_edit_acta").removeClass("d-none");

                    $("#id_edit").val(data.id);
                    $("#fecha_edit").val(data.fecha_elaboracion);
                    $("#hora_ini_edit").val(data.hora_inicio);
                    $("#hora_fin_edit").val(data.hora_fin);
                    $("#area_edit").val(data.area).trigger("change");
                    $("#asunto_edit").val(data.asunto);
                    $("#asistentes_edit").val(data.asistentes.split(",")).trigger("change");
                    $("#observaciones_edit").val(data.observaciones);

                    $("#tbl_data_detail_edit tbody").html("");
                    $.each(detalle, function (index, item) {
                        let button = "";

                        if (index == 0) {
                            button = '<a class="center-vertical mg-s-10 add_row_edit" href="javascript:void(0)"><i class="fa fa-plus"></i></a>';
                        } else {
                            button = '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                        }

                        $("#tbl_data_detail_edit tbody").append(
                            '<tr style="background: #f9f9f9;">' +
                                '<td class="pad-4">' +
                                '<textarea placeholder="Compromiso" class="form-control compromiso_edit" cols="30"' +
                                'rows="2">' +
                                item.compromiso +
                                "</textarea>" +
                                "</td>" +
                                '<td class="pad-4">' +
                                '<select class="form-select asistente_compromiso_edit">' +
                                '<option value="">Seleccione una opción</option>' +
                                usuarios.map((item) => {
                                    return (
                                        '<option value="' +
                                        item.id +
                                        '">' +
                                        item.nombre +
                                        "</option>"
                                    );
                                }) +
                                "</select>" +
                                "</td>" +
                                '<td class="text-center pad-4">' +
                                '<div class="d-flex">' +
                                '<input type="date" placeholder="Fecha"' +
                                'class="form-control text-center fecha_compromiso_edit" value="' + item.fecha + '"' +
                                'style="border: 0">' +
                                button +
                                "</div>" +
                                "</td>" +
                                "</tr>"
                        );
                    });

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });

                    $(".asistente_compromiso_edit").each(function (index) {
                        $(this).val(detalle[index].asistente_id).trigger("change");
                    });
                } else {
                    toastr.error("Ha ocurrido un error");
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error");
            }
        });
    });

    $("#btnEditActa").click(function () {
        var id = $("#id_edit").val();
        var fecha_elaboracion = $("#fecha_edit").val();
        var hora_inicio = $("#hora_ini_edit").val();
        var hora_fin = $("#hora_fin_edit").val();
        var area = $("#area_edit").val();
        var asunto = $("#asunto_edit").val();
        var asistentes = $("#asistentes_edit").val();
        var observaciones = $("#observaciones_edit").val();
        var adjunto = $("#adjunto_edit")[0].files[0];
        var data = [];

        $("#tbl_data_detail_edit tbody tr").each(function () {
            var compromiso = $(this).find(".compromiso_edit").val();
            var asistente = $(this).find(".asistente_compromiso_edit").val();
            var fecha = $(this).find(".fecha_compromiso_edit").val();

            data.push({
                compromiso: compromiso,
                asistente: asistente,
                fecha: fecha,
            });
        });

        if (fecha_elaboracion == "") {
            toastr.error("Debe ingresar la fecha de elaboración");
            return false;
        } else if (hora_inicio == "") {
            toastr.error("Debe ingresar la hora de inicio");
            return false;
        } else if (hora_fin == "") {
            toastr.error("Debe ingresar la hora de fin");
            return false;
        } else if (area == "") {
            toastr.error("Debe ingresar el área");
            return false;
        } else if (asunto == "") {
            toastr.error("Debe ingresar el asunto");
            return false;
        } else if (asistentes == "") {
            toastr.error("Debe ingresar los asistentes");
            return false;
        } else if (observaciones == "") {
            toastr.error("Debe ingresar las observaciones");
            return false;
        } else if (data.length == 0) {
            toastr.error("Debe agregar al menos un compromiso");
            return false;
        }

        var formData = new FormData();
        formData.append("id", id);
        formData.append("fecha_elaboracion", fecha_elaboracion);
        formData.append("hora_inicio", hora_inicio);
        formData.append("hora_fin", hora_fin);
        formData.append("area", area);
        formData.append("asunto", asunto);
        formData.append("asistentes", asistentes);
        formData.append("observaciones", observaciones);
        formData.append("adjunto", adjunto);
        formData.append("data", JSON.stringify(data));

        $("#btnEditActa").attr("disabled", true);
        $("#btnEditActa").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Modificando...');
        $.ajax({
            url: "edit_acta_reunion",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Acta editada con éxito");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error("Ha ocurrido un error");
                    $("#btnEditActa").attr("disabled", false);
                    $("#btnEditActa").html("Modificar Acta");
                }
            },
            error: function (error) {
                toastr.error("Ha ocurrido un error");
                $("#btnEditActa").attr("disabled", false);
                $("#btnEditActa").html("Modificar Acta");
            },
        });
    });

    $(document).on("click", ".btnDelete", function () {
        Swal.fire({
            title: "¿Está seguro de eliminar el acta?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "delete_acta_reunion",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Acta eliminada con éxito");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ha ocurrido un error");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ha ocurrido un error");
                    },
                });
            }
        });
    });
});
