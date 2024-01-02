$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let encargados = JSON.parse(localStorage.getItem("encargados"));
    let categorias = JSON.parse(localStorage.getItem("categorias"));
    let accesorios = JSON.parse(localStorage.getItem("accesorios"));

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

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

    $(".open-toggle").trigger("click");

    // Ver
    $(document).on("click", ".btnView", function () {
        let id = $(this).attr("data-id");

        $("#global-loader").fadeIn("slow");

        $.ajax({
            url: "reparaciones_info",
            type: "POST",
            data: { id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                if (response.info == 1) {
                    let data = response.data;
                    let detalle = response.detalle;

                    $("#cliente_view").val(data.cliente_id).trigger("change");
                    $("#correos_view").val(data.correos);

                    $("#div_reparaciones_view").html("");

                    detalle.forEach(element => {
                        let foto = '<input class="form-control foto_view" type="file" accept="image/*" disabled>';
                        if (element.foto && element.foto != "") {
                            foto = '<img src="images/reparaciones/' + element.foto + '" width="100px" height="100px">';
                        }
                        let accesorios_data = JSON.parse(element.accesorios);
                        for (let i = 0; i < accesorios_data.length; i++) {
                            accesorios_data[i] = parseInt(accesorios_data[i]);
                        }
                        $("#div_reparaciones_view").append('<div style="display: flex;" class="mt-3">' +
                            '<div style="width: 100%; border-bottom: 2px solid #ccc;">' +
                            '<div class="row row-sm">' +
                            '<div class="col-lg">' +
                            '<label for="">Persona que recibe</label>' +
                            '<select class="form-select encargado_view" disabled>' +
                            '<option value="">Seleccione una opción</option>' +
                            encargados.map((encargado) => {
                                if (encargado.id == element.encargado_id) {
                                    return `<option selected value="${encargado.id}">${encargado.nombre}</option>`;
                                } else {
                                    return `<option value="${encargado.id}">${encargado.nombre}</option>`;
                                }
                            }) +
                            '</select>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Categoría</label>' +
                            '<select class="form-select categoria_view" disabled>' +
                            '<option value="">Seleccione una opción</option>' +
                            categorias.map((categoria) => {
                                if (categoria.id == element.categoria_id) {
                                    return `<option selected value="${categoria.id}">${categoria.categoria}</option>`;
                                } else {
                                    return `<option value="${categoria.id}">${categoria.categoria}</option>`;
                                }
                            }) +
                            '</select>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Accesorios</label>' +
                            '<select multiple class="form-select accesorios_view" disabled>' +
                            '<option value="">Seleccione una opción</option>' +
                            accesorios.map((accesorio) => {
                                if (accesorios_data.includes(accesorio.id)) {
                                    return `<option selected value="${accesorio.id}">${accesorio.accesorio}</option>`;
                                } else {
                                    return `<option value="${accesorio.id}">${accesorio.accesorio}</option>`;
                                }
                            }) +
                            '</select>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg">' +
                            '<label for="">Modelo</label>' +
                            '<input class="form-control modelo_view" value="' + element.modelo + '" placeholder="Modelo" type="text" disabled>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Serie</label>' +
                            '<input class="form-control serie_view" value="' + element.serie + '" placeholder="Serie" type="text" disabled>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Foto</label>' +
                            foto +
                            '</div>' +
                            '</div>' +
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg">' +
                            '<label for="">Observaciones</label>' +
                            '<textarea disabled class="form-control observaciones_view" placeholder="Observaciones" rows="3"' +
                            'style="height: 90px; resize: none">' + element.observacion + '</textarea>' +
                            '</div>' +
                            '</div>' +
                            '<br>' +
                            '</div>' +
                            '<div style="display: flex;"">' +
                            '</div>' +
                            '</div>');
                    });

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });

                    $("#modalView").modal("show");
                } else {
                    toastr.error("Ocurrió un error al obtener la información");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Ocurrió un error al obtener la información");
                console.log(error);
            }
        });
    });

    // Completar
    $(document).on("click", ".btnConfirmar", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, completar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "reparaciones_aprobado",
                    type: "POST",
                    data: { id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Se completó correctamente");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ocurrió un error al completar");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ocurrió un error al completar");
                        console.log(error);
                    }
                });
            }
        });
    });

    // Avances
    $(document).on("click", ".btnAddAvances", function () {
        let id = $(this).attr("data-id");
        $("#id_reparacion_avance").val(id);

        $.ajax({
            url: "reparaciones_avances",
            type: "POST",
            data: { id },
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;

                    if ($.fn.DataTable.isDataTable("#avances_tbl")) {
                        $("#avances_tbl").DataTable().destroy();
                    }

                    $("#avances_tbl tbody").empty();

                    data.forEach((element) => {
                        let adjunto = "";
                        let fecha = element.created_at.split(" ");
                        fecha = fecha[0].split("-").reverse().join("/");

                        if (element.adjunto != null) {
                            adjunto = '<a href="' + url_general + "images/anexos_reparaciones/" + element.adjunto + '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
                        } else {
                            adjunto = '<button class="btn btn-sm btn-secondary" disabled><i class="fa fa-eye"></i></button>';
                        }

                        $("#avances_tbl tbody").append('<tr>' +
                            '<td class="text-center">' + element.observacion + '</td>' +
                            '<td class="text-center">' + element.empleado + '</td>' +
                            '<td class="text-center">' + fecha + '</td>' +
                            '<td class="text-center">' + adjunto + '</td>' +
                            '<td class="text-center"> <button title="Eliminar" data-reparacion="' + id + '" class="btn btn-sm btn-danger btnDeleteAvance" data-id="' + element.id + '"><i class="fa fa-trash"></i></button></td>' +
                            '</tr>');
                    });

                    $("#avances_tbl").DataTable({
                        language: language,
                        responsive: true,
                        order: [],
                    });

                    $("#modalAvances").modal("show");
                } else {
                    toastr.error("Ocurrió un error al obtener la información");
                }
            },
            error: function (error) {
                toastr.error("Ocurrió un error al obtener la información");
                console.log(error);
            }
        });
    });

    $("#btnGuardarAvance").click(function () {
        let id = $("#id_reparacion_avance").val();
        let observacion = $("#observaciones_avance").val();

        if (observacion == "") {
            toastr.error("Ingrese un informe");
            return false;
        } else {
            let formData = new FormData();
            formData.append("id", id);
            formData.append("observacion", observacion);
            formData.append("adjunto", $("#anexo_avance_add")[0].files[0]);

            $("#btnGuardarAvance").prop("disabled", true);
            $("#btnGuardarAvance").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

            $.ajax({
                url: "reparaciones_avances_add",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        $("#observaciones_avance").val("");
                        $("#anexo_avance_add").val("");

                        $("#btnGuardarAvance").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Terminando...');
                        cargarAvances(id);
                        setTimeout(() => {
                            $("#btnGuardarAvance").prop("disabled", false);
                            $("#btnGuardarAvance").html("Agregar Informe");
                        }, 900);
                        toastr.success("Se guardó correctamente");
                    } else {
                        toastr.error("Ocurrió un error al guardar");
                        $("#btnGuardarAvance").prop("disabled", false);
                        $("#btnGuardarAvance").html("Agregar Informe");
                    }
                },
                error: function (error) {
                    toastr.error("Ocurrió un error al guardar");
                    $("#btnGuardarAvance").prop("disabled", false);
                    $("#btnGuardarAvance").html("Agregar Informe");
                    console.log(error);
                }
            });
        }
    });

    function cargarAvances(id) {
        $.ajax({
            url: "reparaciones_avances",
            type: "POST",
            data: { id },
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;

                    if ($.fn.DataTable.isDataTable("#avances_tbl")) {
                        $("#avances_tbl").DataTable().destroy();
                    }

                    $("#avances_tbl tbody").empty();

                    data.forEach((element) => {
                        let adjunto = "";
                        let fecha = element.created_at.split(" ");
                        fecha = fecha[0].split("-").reverse().join("/");

                        if (element.adjunto != null) {
                            adjunto = '<a href="' + url_general + "images/anexos_reparaciones/" + element.adjunto + '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
                        } else {
                            adjunto = '<button class="btn btn-sm btn-secondary" disabled><i class="fa fa-eye"></i></button>';
                        }

                        $("#avances_tbl tbody").append('<tr>' +
                            '<td class="text-center">' + element.observacion + '</td>' +
                            '<td class="text-center">' + element.empleado + '</td>' +
                            '<td class="text-center">' + fecha + '</td>' +
                            '<td class="text-center">' + adjunto + '</td>' +
                            '<td class="text-center"> <button title="Eliminar" data-reparacion="' + id + '" class="btn btn-sm btn-danger btnDeleteAvance" data-id="' + element.id + '"><i class="fa fa-trash"></i></button></td>' +
                            '</tr>');
                    });

                    $("#avances_tbl").DataTable({
                        language: language,
                        responsive: true,
                        order: [],
                    });

                } else {
                    toastr.error("Ocurrió un error al obtener la información");
                }
            },
            error: function (error) {
                toastr.error("Ocurrió un error al obtener la información");
                console.log(error);
            }
        });
    }

    $(document).on("click", ".btnDeleteAvance", function () {
        let reparacion = $(this).data("reparacion");
        $("#modalAvances").modal("hide");
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).data("id");

                $.ajax({
                    url: "reparaciones_avances_delete",
                    type: "POST",
                    data: { id },
                    success: function (response) {
                        if (response.info == 1) {
                            cargarAvances(reparacion);
                            toastr.success("Se eliminó correctamente");
                            $("#modalAvances").modal("show");
                        } else {
                            toastr.error("Ocurrió un error al eliminar");
                            $("#modalAvances").modal("show");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ocurrió un error al eliminar");
                        console.log(error);
                    }
                });
            } else {
                $("#modalAvances").modal("show");
            }
        }
        );
    });

    $(document).on("click", ".btnRepuestos", function () {
        let id = $(this).attr("data-id");
        $("#id_reparacion_repuestos").val(id);

        $.ajax({
            url: "reparaciones_repuestos",
            type: "POST",
            data: { id },
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;

                    if ($.fn.DataTable.isDataTable("#reparaciones_tbl")) {
                        $("#reparaciones_tbl").DataTable().destroy();
                    }

                    $("#reparaciones_tbl tbody").empty();

                    data.forEach((element) => {
                        let fecha = element.created_at.split(" ");
                        fecha = fecha[0].split("-").reverse().join("/");

                        $("#reparaciones_tbl tbody").append('<tr>' +
                            '<td class="text-center">' + element.producto + ' (' + element.marca + ' - ' + element.modelo + ')</td>' +
                            '<td class="text-center">' + element.cantidad + '</td>' +
                            '<td class="text-center">' + fecha + '</td>' +
                            '</tr>');
                    });

                    $("#reparaciones_tbl").DataTable({
                        language: language,
                        responsive: true,
                        order: [],
                    });

                    $("#modalRepuesto").modal("show");
                } else {
                    toastr.error("Ocurrió un error al obtener la información");
                }
            },
            error: function (error) {
                toastr.error("Ocurrió un error al obtener la información");
                console.log(error);
            }
        });
    });
});
