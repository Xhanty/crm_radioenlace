$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

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
        });

        $(".vueltamovilidadadd").each(function () {
            if ($(this).val().trim() == "") {
                error = true;
            }
            vueltamovilidad.push($(this).val());
        });

        // Gastos
        $(".referenciagastosadd").each(function () {
            gastos.push($(this).val());
        });

        $(".valorgastosadd").each(function () {
            valorgastos.push($(this).val());
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
});
