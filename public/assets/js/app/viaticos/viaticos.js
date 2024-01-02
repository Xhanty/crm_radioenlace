$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ADD
    $("#new_row_alimentacion").click(function () {
        $("#div_list_alimentacion").append(
            '<div style="display: flex; margin-top: 12px">' +
            '<select class="form-select alimentacionadd">' +
            '<option value="">Seleccione</option>' +
            '<option value="1">Desayuno</option>' +
            '<option value="2">Almuerzo</option>' +
            '<option value="3">Comida</option>' +
            "</select>" +
            '<input class="form-control valoralimentacionadd" placeholder="Valor" type="number"' +
            'style="margin-left: 12px; margin-right: 12px">' +
            '<input class="form-control fechaalimentacionadd" placeholder="Fecha" type="date">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
            'class="fa fa-trash"></i></a>' +
            "</div>"
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

    $("#new_row_movilidad").click(function () {
        $("#div_list_movilidad").append(
            '<div style="display: flex; margin-top: 12px">' +
            '<select class="form-select movilidadadd">' +
            '<option value="">Seleccione</option>' +
            '<option value="1">Peajes</option>' +
            '<option value="2">Alojamiento</option>' +
            '<option value="3">Combustible</option>' +
            '<option value="4">Bestia</option>' +
            '<option value="5">Taxi</option>' +
            '<option value="6">Bus</option>' +
            "</select>" +
            '<input class="form-control idamovilidadadd" placeholder="Valor Ida" type="number"' +
            'style="margin-left: 12px; margin-right: 12px">' +
            '<input class="form-control vueltamovilidadadd" placeholder="Valor Vuelta" type="number">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
            'class="fa fa-trash"></i></a>' +
            "</div>"
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

    $("#new_row_gastos").click(function () {
        $("#div_list_gastos").append(
            '<div style="display: flex; margin-top: 12px">' +
            '<input class="form-control referenciagastosadd" placeholder="Referencia" type="text">' +
            '<input class="form-control valorgastosadd" placeholder="Valor" type="number"' +
            'style="margin-left: 12px; margin-right: 12px">' +
            '<input class="form-control observaciongastosadd" placeholder="Observación" type="text">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
            'class="fa fa-trash"></i></a>' +
            "</div>"
        );
    });

    // EDIT
    $(document).on("click", "#new_row_alimentacion_edit", function () {
        $("#div_list_alimentacion_edit").append(
            '<div style="display: flex; margin-top: 12px">' +
            '<select class="form-select alimentacionedit">' +
            '<option value="">Seleccione</option>' +
            '<option value="1">Desayuno</option>' +
            '<option value="2">Almuerzo</option>' +
            '<option value="3">Comida</option>' +
            "</select>" +
            '<input class="form-control valoralimentacionedit" placeholder="Valor" type="number"' +
            'style="margin-left: 12px; margin-right: 12px">' +
            '<input class="form-control fechaalimentacionedit" placeholder="Fecha" type="date">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
            'class="fa fa-trash"></i></a>' +
            "</div>"
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

    $(document).on("click", "#new_row_movilidad_edit", function () {
        $("#div_list_movilidad_edit").append(
            '<div style="display: flex; margin-top: 12px">' +
            '<select class="form-select movilidadedit">' +
            '<option value="">Seleccione</option>' +
            '<option value="1">Peajes</option>' +
            '<option value="2">Alojamiento</option>' +
            '<option value="3">Combustible</option>' +
            '<option value="4">Bestia</option>' +
            '<option value="5">Taxi</option>' +
            '<option value="6">Bus</option>' +
            "</select>" +
            '<input class="form-control idamovilidadedit" placeholder="Valor Ida" type="number"' +
            'style="margin-left: 12px; margin-right: 12px">' +
            '<input class="form-control vueltamovilidadedit" placeholder="Valor Vuelta" type="number">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
            'class="fa fa-trash"></i></a>' +
            "</div>"
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

    $(document).on("click", "#new_row_gastos_edit", function () {
        $("#div_list_gastos_edit").append(
            '<div style="display: flex; margin-top: 12px">' +
            '<input class="form-control referenciagastosedit" placeholder="Referencia" type="text">' +
            '<input class="form-control valorgastosedit" placeholder="Valor" type="number"' +
            'style="margin-left: 12px; margin-right: 12px">' +
            '<input class="form-control observaciongastosedit" placeholder="Observación" type="text">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
            'class="fa fa-trash"></i></a>' +
            "</div>"
        );
    });

    $(document).on("click", ".delete_row", function () {
        $(this).parent().remove();
    });

    // Guardar viaticos
    $("#btnGuardarViatico").click(function () {
        var visita_id = $("#visita_id").val();
        var alimentacion = [];
        var valoralimentacion = [];
        var fechaalimentacion = [];
        var movilidad = [];
        var idamovilidad = [];
        var vueltamovilidad = [];
        var gastos = [];
        var valorgastos = [];
        var observacionesgastos = [];
        var error = false;
        var total = 0;

        if (visita_id == "") {
            error = true;
        }

        // Alimentacion
        $(".alimentacionadd").each(function () {
            if ($(this).val() == "") {
                error = true;
            }
            alimentacion.push($(this).val());
        });

        $(".valoralimentacionadd").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            valoralimentacion.push($(this).val());
            total += parseInt($(this).val());
        });

        $(".fechaalimentacionadd").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            fechaalimentacion.push($(this).val());
        });

        // Movilidad
        $(".movilidadadd").each(function () {
            if ($(this).val() == "") {
                error = true;
            }
            movilidad.push($(this).val());
        });

        $(".idamovilidadadd").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            idamovilidad.push($(this).val());
            total += parseInt($(this).val());
        });

        $(".vueltamovilidadadd").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            vueltamovilidad.push($(this).val());
            total += parseInt($(this).val());
        });

        // Gastos
        $(".referenciagastosadd").each(function () {
            gastos.push($(this).val());
        });

        $(".valorgastosadd").each(function () {
            valorgastos.push($(this).val());
            if ($(this).val() > 0) {
                total += parseInt($(this).val());
            }
        });

        $(".observaciongastosadd").each(function () {
            observacionesgastos.push($(this).val());
        });

        if (error) {
            toastr.error("Debe llenar todos los campos");
            return false;
        } else {

            //Unir arrays en un solo array
            var data_alimentacion = [];
            var data_movilidad = [];
            var data_gastos = [];

            for (var i = 0; i < alimentacion.length; i++) {
                data_alimentacion.push({
                    alimentacion: alimentacion[i],
                    valoralimentacion: valoralimentacion[i],
                    fechaalimentacion: fechaalimentacion[i],
                });
            }

            for (var i = 0; i < movilidad.length; i++) {
                data_movilidad.push({
                    movilidad: movilidad[i],
                    idamovilidad: idamovilidad[i],
                    vueltamovilidad: vueltamovilidad[i],
                });
            }

            for (var i = 0; i < gastos.length; i++) {
                data_gastos.push({
                    gastos: gastos[i],
                    valorgastos: valorgastos[i],
                    observacionesgastos: observacionesgastos[i],
                });
            }


            $.ajax({
                url: "viaticos_add",
                type: "POST",
                data: {
                    visita_id: visita_id,
                    alimentacion: data_alimentacion,
                    movilidad: data_movilidad,
                    gastos: data_gastos,
                    total: total,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Viaticos registrados correctamente");
                        setTimeout(function () {
                            window.location.href = "viaticos";
                        }, 1000);
                    } else {
                        toastr.error("Ha ocurrido un error al registrar los viaticos");
                    }
                },
                error: function (response) {
                    toastr.error("Ha ocurrido un error al registrar los viaticos");
                },
            });
        }
    });

    // Ver viaticos
    $(document).on("click", ".btnView", function () {
        var id = $(this).attr("data-id");

        $.ajax({
            url: "viaticos_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#visita_id_view").val(response.data.visita_id).trigger("change");

                    // Alimentacion
                    var html_alimentacion = "";
                    for (var i = 0; i < response.data.alimentacion.length; i++) {
                        html_alimentacion +=
                            '<div style="display: flex; margin-top: 12px">' +
                            '<select class="form-select" disabled>' +
                            '<option value="">Seleccione</option>' +
                            '<option value="1" ' +
                            (response.data.alimentacion[i].alimentacion == 1
                                ? "selected"
                                : "") +
                            ">Desayuno</option>" +
                            '<option value="2" ' +
                            (response.data.alimentacion[i].alimentacion == 2
                                ? "selected"
                                : "") +
                            ">Almuerzo</option>" +
                            '<option value="3" ' +
                            (response.data.alimentacion[i].alimentacion == 3
                                ? "selected"
                                : "") +
                            ">Comida</option>" +
                            "</select>" +
                            '<input class="form-control" disabled placeholder="Valor" type="number"' +
                            'style="margin-left: 12px; margin-right: 12px" value="' +
                            response.data.alimentacion[i].valoralimentacion +
                            '">' +
                            '<input class="form-control" disabled placeholder="Fecha" type="date" value="' +
                            response.data.alimentacion[i].fechaalimentacion +
                            '">' +
                            "</div>";
                    }
                    $("#div_list_alimentacion_view").html(html_alimentacion);

                    // Movilidad
                    var html_movilidad = "";
                    for (var i = 0; i < response.data.movilidad.length; i++) {
                        html_movilidad +=
                            '<div style="display: flex; margin-top: 12px">' +
                            '<select class="form-select" disabled>' +
                            '<option value="">Seleccione</option>' +
                            '<option value="1" ' +
                            (response.data.movilidad[i].movilidad == 1
                                ? "selected"
                                : "") +
                            ">Peajes</option>" +
                            '<option value="2" ' +
                            (response.data.movilidad[i].movilidad == 2
                                ? "selected"
                                : "") +
                            ">Alojamiento</option>" +
                            '<option value="3" ' +
                            (response.data.movilidad[i].movilidad == 3
                                ? "selected"
                                : "") +
                            ">Combustible</option>" +
                            '<option value="4" ' +
                            (response.data.movilidad[i].movilidad == 4
                                ? "selected"
                                : "") +
                            ">Bestia</option>" +
                            '<option value="5" ' +
                            (response.data.movilidad[i].movilidad == 5
                                ? "selected"
                                : "") +
                            ">Taxi</option>" +
                            '<option value="6" ' +
                            (response.data.movilidad[i].movilidad == 6
                                ? "selected"
                                : "") +
                            ">Bus</option>" +
                            "</select>" +
                            '<input class="form-control" disabled placeholder="Valor Ida" type="number"' +
                            'style="margin-left: 12px; margin-right: 12px" value="' +
                            response.data.movilidad[i].idamovilidad +
                            '">' +
                            '<input class="form-control" disabled placeholder="Valor Vuelta" type="number" value="' +
                            response.data.movilidad[i].vueltamovilidad +
                            '">' +
                            "</div>";
                    }
                    $("#div_list_movilidad_view").html(html_movilidad);

                    // Gastos
                    var html_gastos = "";
                    if (response.data.otros && response.data.otros.length > 0) {
                        for (var i = 0; i < response.data.otros.length; i++) {
                            if (response.data.otros[i].valorgastos > 0) {
                                html_gastos +=
                                    '<div style="display: flex; margin-top: 12px">' +
                                    '<input class="form-control" disabled placeholder="Referencia" type="text" value="' +
                                    response.data.otros[i].gastos +
                                    '">' +
                                    '<input class="form-control" disabled placeholder="Valor" type="number"' +
                                    'style="margin-left: 12px; margin-right: 12px" value="' +
                                    response.data.otros[i].valorgastos +
                                    '">' +
                                    '<input class="form-control" disabled placeholder="Observación" type="text" value="' +
                                    response.data.otros[i].observacionesgastos +
                                    '">' +
                                    "</div>";
                            }
                        }
                    }
                    $("#div_list_gastos_view").html(html_gastos);

                    $("#modalView").modal("show");

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                }
            }
        });
    });

    // Editar viaticos
    $(document).on("click", ".btnEdit", function () {
        var id = $(this).attr("data-id");

        $.ajax({
            url: "viaticos_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#id_edit").val(response.data.id);
                    $("#visita_id_edit").val(response.data.visita_id).trigger("change");

                    // Alimentacion
                    var html_alimentacion = "";
                    for (var i = 0; i < response.data.alimentacion.length; i++) {
                        if (i == 0) {
                            html_alimentacion +=
                                '<div style="display: flex; margin-top: 12px">' +
                                '<select class="form-select alimentacionedit">' +
                                '<option value="">Seleccione</option>' +
                                '<option value="1" ' +
                                (response.data.alimentacion[i].alimentacion == 1
                                    ? "selected"
                                    : "") +
                                ">Desayuno</option>" +
                                '<option value="2" ' +
                                (response.data.alimentacion[i].alimentacion == 2
                                    ? "selected"
                                    : "") +
                                ">Almuerzo</option>" +
                                '<option value="3" ' +
                                (response.data.alimentacion[i].alimentacion == 3
                                    ? "selected"
                                    : "") +
                                ">Comida</option>" +
                                "</select>" +
                                '<input class="form-control valoralimentacionedit" placeholder="Valor" type="number"' +
                                'style="margin-left: 12px; margin-right: 12px" value="' +
                                response.data.alimentacion[i].valoralimentacion +
                                '">' +
                                '<input class="form-control fechaalimentacionedit" placeholder="Fecha" type="date" value="' +
                                response.data.alimentacion[i].fechaalimentacion +
                                '">' +
                                '<a class="center-vertical mg-s-10" id="new_row_alimentacion_edit" href="javascript:void(0)"><i ' +
                                'class="fa fa-plus"></i></a>' +
                                "</div>";
                        } else {
                            html_alimentacion +=
                                '<div style="display: flex; margin-top: 12px">' +
                                '<select class="form-select alimentacionedit">' +
                                '<option value="">Seleccione</option>' +
                                '<option value="1" ' +
                                (response.data.alimentacion[i].alimentacion == 1
                                    ? "selected"
                                    : "") +
                                ">Desayuno</option>" +
                                '<option value="2" ' +
                                (response.data.alimentacion[i].alimentacion == 2
                                    ? "selected"
                                    : "") +
                                ">Almuerzo</option>" +
                                '<option value="3" ' +
                                (response.data.alimentacion[i].alimentacion == 3
                                    ? "selected"
                                    : "") +
                                ">Comida</option>" +
                                "</select>" +
                                '<input class="form-control valoralimentacionedit" placeholder="Valor" type="number"' +
                                'style="margin-left: 12px; margin-right: 12px" value="' +
                                response.data.alimentacion[i].valoralimentacion +
                                '">' +
                                '<input class="form-control fechaalimentacionedit" placeholder="Fecha" type="date" value="' +
                                response.data.alimentacion[i].fechaalimentacion +
                                '">' +
                                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
                                'class="fa fa-trash"></i></a>' +
                                "</div>";
                        }
                    }
                    $("#div_list_alimentacion_edit").html(html_alimentacion);

                    // Movilidad
                    var html_movilidad = "";
                    for (var i = 0; i < response.data.movilidad.length; i++) {
                        if (i == 0) {
                            html_movilidad +=
                                '<div style="display: flex; margin-top: 12px">' +
                                '<select class="form-select movilidadedit">' +
                                '<option value="">Seleccione</option>' +
                                '<option value="1" ' +
                                (response.data.movilidad[i].movilidad == 1
                                    ? "selected"
                                    : "") +
                                ">Peajes</option>" +
                                '<option value="2" ' +
                                (response.data.movilidad[i].movilidad == 2
                                    ? "selected"
                                    : "") +
                                ">Alojamiento</option>" +
                                '<option value="3" ' +
                                (response.data.movilidad[i].movilidad == 3
                                    ? "selected"
                                    : "") +
                                ">Combustible</option>" +
                                '<option value="4" ' +
                                (response.data.movilidad[i].movilidad == 4
                                    ? "selected"
                                    : "") +
                                ">Bestia</option>" +
                                '<option value="5" ' +
                                (response.data.movilidad[i].movilidad == 5
                                    ? "selected"
                                    : "") +
                                ">Taxi</option>" +
                                '<option value="6" ' +
                                (response.data.movilidad[i].movilidad == 6
                                    ? "selected"
                                    : "") +
                                ">Bus</option>" +
                                "</select>" +
                                '<input class="form-control idamovilidadedit" placeholder="Valor Ida" type="number"' +
                                'style="margin-left: 12px; margin-right: 12px" value="' +
                                response.data.movilidad[i].idamovilidad +
                                '">' +
                                '<input class="form-control vueltamovilidadedit" placeholder="Valor Vuelta" type="number" value="' +
                                response.data.movilidad[i].vueltamovilidad +
                                '">' +
                                '<a class="center-vertical mg-s-10" id="new_row_movilidad_edit" href="javascript:void(0)"><i ' +
                                'class="fa fa-plus"></i></a>' +
                                "</div>";
                        } else {
                            html_movilidad +=
                                '<div style="display: flex; margin-top: 12px">' +
                                '<select class="form-select movilidadedit">' +
                                '<option value="">Seleccione</option>' +
                                '<option value="1" ' +
                                (response.data.movilidad[i].movilidad == 1
                                    ? "selected"
                                    : "") +
                                ">Peajes</option>" +
                                '<option value="2" ' +
                                (response.data.movilidad[i].movilidad == 2
                                    ? "selected"
                                    : "") +
                                ">Alojamiento</option>" +
                                '<option value="3" ' +
                                (response.data.movilidad[i].movilidad == 3
                                    ? "selected"
                                    : "") +
                                ">Combustible</option>" +
                                '<option value="4" ' +
                                (response.data.movilidad[i].movilidad == 4
                                    ? "selected"
                                    : "") +
                                ">Bestia</option>" +
                                '<option value="5" ' +
                                (response.data.movilidad[i].movilidad == 5
                                    ? "selected"
                                    : "") +
                                ">Taxi</option>" +
                                '<option value="6" ' +
                                (response.data.movilidad[i].movilidad == 6
                                    ? "selected"
                                    : "") +
                                ">Bus</option>" +
                                "</select>" +
                                '<input class="form-control idamovilidadedit" placeholder="Valor Ida" type="number"' +
                                'style="margin-left: 12px; margin-right: 12px" value="' +
                                response.data.movilidad[i].idamovilidad +
                                '">' +
                                '<input class="form-control vueltamovilidadedit" placeholder="Valor Vuelta" type="number" value="' +
                                response.data.movilidad[i].vueltamovilidad +
                                '">' +
                                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
                                'class="fa fa-trash"></i></a>' +
                                "</div>";
                        }
                    }
                    $("#div_list_movilidad_edit").html(html_movilidad);

                    // Gastos
                    var html_gastos = "";
                    for (var i = 0; i < response.data.otros.length; i++) {
                        var gasto = "";
                        var valor = null;
                        var observacion = "";

                        if (response.data.otros[i].valorgastos > 0) {
                            gasto = response.data.otros[i].gastos;
                            valor = response.data.otros[i].valorgastos;
                            observacion = response.data.otros[i].observacionesgastos;
                        }

                        if (i == 0) {
                            html_gastos +=
                                '<div style="display: flex; margin-top: 12px">' +
                                '<input class="form-control referenciagastosedit" placeholder="Referencia" type="text" value="' +
                                gasto +
                                '">' +
                                '<input class="form-control valorgastosedit" placeholder="Valor" type="number"' +
                                'style="margin-left: 12px; margin-right: 12px" value="' +
                                valor +
                                '">' +
                                '<input class="form-control observaciongastosedit" placeholder="Observación" type="text" value="' +
                                observacion +
                                '">' +
                                '<a class="center-vertical mg-s-10" id="new_row_gastos_edit" href="javascript:void(0)"><i ' +
                                'class="fa fa-plus"></i></a>' +
                                "</div>";
                        } else {
                            html_gastos +=
                                '<div style="display: flex; margin-top: 12px">' +
                                '<input class="form-control referenciagastosedit" placeholder="Referencia" type="text" value="' +
                                gasto +
                                '">' +
                                '<input class="form-control valorgastosedit" placeholder="Valor" type="number"' +
                                'style="margin-left: 12px; margin-right: 12px" value="' +
                                valor +
                                '">' +
                                '<input class="form-control observaciongastosedit" placeholder="Observación" type="text" value="' +
                                observacion +
                                '">' +
                                '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i ' +
                                'class="fa fa-trash"></i></a>' +
                                "</div>";
                        }
                    }
                    $("#div_list_gastos_edit").html(html_gastos);

                    $("#modalEdit").modal("show");

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                }
            }
        });
    });

    // Actualizar viaticos
    $("#btnEditViatico").click(function () {
        var id = $("#id_edit").val();
        var visita_id = $("#visita_id_edit").val();
        var alimentacion = [];
        var valoralimentacion = [];
        var fechaalimentacion = [];
        var movilidad = [];
        var idamovilidad = [];
        var vueltamovilidad = [];
        var gastos = [];
        var valorgastos = [];
        var observacionesgastos = [];
        var error = false;
        var total = 0;

        if (id == "" || visita_id == "") {
            error = true;
        }

        // Alimentacion
        $(".alimentacionedit").each(function () {
            if ($(this).val() == "") {
                error = true;
            }
            alimentacion.push($(this).val());
        });

        $(".valoralimentacionedit").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            valoralimentacion.push($(this).val());
            total += parseInt($(this).val());
        });

        $(".fechaalimentacionedit").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            fechaalimentacion.push($(this).val());
        });

        // Movilidad
        $(".movilidadedit").each(function () {
            if ($(this).val() == "") {
                error = true;
            }
            movilidad.push($(this).val());
        });

        $(".idamovilidadedit").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            idamovilidad.push($(this).val());
            total += parseInt($(this).val());
        });

        $(".vueltamovilidadedit").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            vueltamovilidad.push($(this).val());
            total += parseInt($(this).val());
        });

        // Gastos
        $(".referenciagastosedit").each(function () {
            gastos.push($(this).val());
        });

        $(".valorgastosedit").each(function () {
            valorgastos.push($(this).val());
            if ($(this).val() > 0) {
                total += parseInt($(this).val());
            }
        });

        $(".observaciongastosedit").each(function () {
            observacionesgastos.push($(this).val());
        });

        if (error) {
            toastr.error("Debe llenar todos los campos");
            return false;
        } else {

            //Unir arrays en un solo array
            var data_alimentacion = [];
            var data_movilidad = [];
            var data_gastos = [];

            for (var i = 0; i < alimentacion.length; i++) {
                data_alimentacion.push({
                    alimentacion: alimentacion[i],
                    valoralimentacion: valoralimentacion[i],
                    fechaalimentacion: fechaalimentacion[i],
                });
            }

            for (var i = 0; i < movilidad.length; i++) {
                data_movilidad.push({
                    movilidad: movilidad[i],
                    idamovilidad: idamovilidad[i],
                    vueltamovilidad: vueltamovilidad[i],
                });
            }

            for (var i = 0; i < gastos.length; i++) {
                data_gastos.push({
                    gastos: gastos[i],
                    valorgastos: valorgastos[i],
                    observacionesgastos: observacionesgastos[i],
                });
            }

            $.ajax({
                url: "viaticos_edit",
                type: "POST",
                data: {
                    id: id,
                    visita_id: visita_id,
                    alimentacion: data_alimentacion,
                    movilidad: data_movilidad,
                    gastos: data_gastos,
                    total: total,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Viaticos actualizados correctamente");
                        setTimeout(function () {
                            window.location.href = "viaticos";
                        }, 1000);
                    } else {
                        toastr.error("Ha ocurrido un error al actualizar los viaticos");
                    }
                },
                error: function (response) {
                    toastr.error("Ha ocurrido un error al actualizar los viaticos");
                },
            });
        }
    });

    // Eliminar viaticos
    $(document).on("click", ".btnDelete", function () {
        var id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Se eliminarán los viaticos",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "No, cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "viaticos_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Viaticos eliminados correctamente");
                            setTimeout(function () {
                                window.location.href = "viaticos";
                            }, 1000);
                        } else {
                            toastr.error(
                                "Ha ocurrido un error al eliminar los viaticos"
                            );
                        }
                    },
                    error: function (response) {
                        toastr.error(
                            "Ha ocurrido un error al eliminar los viaticos"
                        );
                    },
                });
            }
        });
    });

    // Rechazar viaticos
    $(document).on("click", ".btnRechazar", function () {
        var id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Se rechazarán los viaticos",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, rechazar",
            cancelButtonText: "No, cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "viaticos_reject",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Viaticos rechazados correctamente");
                            setTimeout(function () {
                                window.location.href = "viaticos";
                            }, 1000);
                        } else {
                            toastr.error(
                                "Ha ocurrido un error al rechazar los viaticos"
                            );
                        }
                    },
                    error: function (response) {
                        toastr.error(
                            "Ha ocurrido un error al rechazar los viaticos"
                        );
                    },
                });
            }
        });
    });

    // Aceptar viaticos
    $(document).on("click", ".btnAceptar", function () {
        let valor = $(this).attr("data-valor");
        let tercero = $(this).attr("data-tercero");
        let id = $(this).attr("data-id");

        $("#tercero_aceptar").val(tercero).trigger("change");
        $("#valor_aceptar").val(valor);
        $("#id_aceptar").val(id);

        $("#modalAceptar").modal("show");
    });

    $("#btnAceptarViatico").click(function () {
        var id = $("#id_aceptar").val();
        let forma_pago = $("#formas_pago_aceptar").val();

        if (forma_pago == "") {
            toastr.error("Debe seleccionar una forma de pago");
            return false;
        } else {
            $.ajax({
                url: "viaticos_accept",
                type: "POST",
                data: {
                    id: id,
                    forma_pago: forma_pago,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Viaticos aceptados correctamente");
                        setTimeout(function () {
                            window.location.href = "viaticos";
                        }, 1000);
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al aceptar los viaticos"
                        );
                    }
                },
                error: function (response) {
                    toastr.error(
                        "Ha ocurrido un error al aceptar los viaticos"
                    );
                },
            });
        }
    });

    // Legalizar viaticos
    // Editar viaticos
    $(document).on("click", ".btnLegalizar", function () {
        var id = $(this).attr("data-id");

        $.ajax({
            url: "viaticos_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#id_legalizar").val(response.data.id);
                    $("#visita_id_legalizar").val(response.data.visita_id).trigger("change");

                    // Alimentacion
                    var html_alimentacion = "";
                    for (var i = 0; i < response.data.alimentacion.length; i++) {
                        html_alimentacion +=
                            '<div style="display: flex; margin-top: 12px">' +
                            '<select class="form-select" disabled>' +
                            '<option value="">Seleccione</option>' +
                            '<option value="1" ' +
                            (response.data.alimentacion[i].alimentacion == 1
                                ? "selected"
                                : "") +
                            ">Desayuno</option>" +
                            '<option value="2" ' +
                            (response.data.alimentacion[i].alimentacion == 2
                                ? "selected"
                                : "") +
                            ">Almuerzo</option>" +
                            '<option value="3" ' +
                            (response.data.alimentacion[i].alimentacion == 3
                                ? "selected"
                                : "") +
                            ">Comida</option>" +
                            "</select>" +
                            '<input class="form-control" disabled placeholder="Valor" type="number"' +
                            'style="margin-left: 12px; margin-right: 12px" value="' +
                            response.data.alimentacion[i].valoralimentacion +
                            '">' +
                            '<input class="form-control" disabled placeholder="Fecha" type="date" value="' +
                            response.data.alimentacion[i].fechaalimentacion +
                            '">' +
                            '<a class="center-vertical mg-s-10" href="javascript:void(0)"><i ' +
                            'class="fa fa-file"></i></a>' +
                            "</div>";
                    }

                    $("#div_list_alimentacion_legalizar").html(html_alimentacion);

                    // Movilidad
                    var html_movilidad = "";
                    for (var i = 0; i < response.data.movilidad.length; i++) {
                        html_movilidad +=
                            '<div style="display: flex; margin-top: 12px">' +
                            '<select class="form-select" disabled>' +
                            '<option value="">Seleccione</option>' +
                            '<option value="1" ' +
                            (response.data.movilidad[i].movilidad == 1
                                ? "selected"
                                : "") +
                            ">Peajes</option>" +
                            '<option value="2" ' +
                            (response.data.movilidad[i].movilidad == 2
                                ? "selected"
                                : "") +
                            ">Alojamiento</option>" +
                            '<option value="3" ' +
                            (response.data.movilidad[i].movilidad == 3
                                ? "selected"
                                : "") +
                            ">Combustible</option>" +
                            '<option value="4" ' +
                            (response.data.movilidad[i].movilidad == 4
                                ? "selected"
                                : "") +
                            ">Bestia</option>" +
                            '<option value="5" ' +
                            (response.data.movilidad[i].movilidad == 5
                                ? "selected"
                                : "") +
                            ">Taxi</option>" +
                            '<option value="6" ' +
                            (response.data.movilidad[i].movilidad == 6
                                ? "selected"
                                : "") +
                            ">Bus</option>" +
                            "</select>" +
                            '<input class="form-control" disabled placeholder="Valor Ida" type="number"' +
                            'style="margin-left: 12px; margin-right: 12px" value="' +
                            response.data.movilidad[i].idamovilidad +
                            '">' +
                            '<input class="form-control" disabled placeholder="Valor Vuelta" type="number" value="' +
                            response.data.movilidad[i].vueltamovilidad +
                            '">' +
                            '<a class="center-vertical mg-s-10" href="javascript:void(0)"><i ' +
                            'class="fa fa-file"></i></a>' +
                            "</div>";
                    }

                    $("#div_list_movilidad_legalizar").html(html_movilidad);

                    // Gastos
                    var html_gastos = "";
                    for (var i = 0; i < response.data.otros.length; i++) {
                        var gasto = "";
                        var valor = null;
                        var observacion = "";

                        if (response.data.otros[i].valorgastos > 0) {
                            gasto = response.data.otros[i].gastos;
                            valor = response.data.otros[i].valorgastos;
                            observacion = response.data.otros[i].observacionesgastos;
                        }

                        html_gastos +=
                            '<div style="display: flex; margin-top: 12px">' +
                            '<input class="form-control" disabled placeholder="Referencia" type="text" value="' +
                            gasto +
                            '">' +
                            '<input class="form-control" disabled placeholder="Valor" type="number"' +
                            'style="margin-left: 12px; margin-right: 12px" value="' +
                            valor +
                            '">' +
                            '<input class="form-control" disabled placeholder="Observación" type="text" value="' +
                            observacion +
                            '">' +
                            '<a class="center-vertical mg-s-10" href="javascript:void(0)"><i ' +
                            'class="fa fa-file"></i></a>' +
                            "</div>";
                    }
                    $("#div_list_gastos_legalizar").html(html_gastos);

                    $("#modalLegalizar").modal("show");

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });
                }
            }
        });
    });
});
