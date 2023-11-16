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

        $("#tbl_data_detail tbody tr").each(function () {
            var compromiso = $(this).find(".compromiso_add").val();
            var asistente = $(this).find(".asistente_compromiso_add").val();
            var fecha = $(this).find(".fecha_compromiso_add").val();

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
