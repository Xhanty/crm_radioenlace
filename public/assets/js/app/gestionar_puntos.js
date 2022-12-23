$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let datefilter1 = [];
    let datefilter2 = [];

    let language = {
        format: "DD/MM/YYYY",
        separator: " - ",
        applyLabel: "Aceptar",
        cancelLabel: "Cancelar",
        fromLabel: "Desde",
        toLabel: "Hasta",
        customRangeLabel: "Personalizar",
        daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        firstDay: 1,
    };

    $("#rangofilter1").daterangepicker(
        {
            autoUpdateInput: false,
            locale: language,
        },
        function (start, end, label) {
            datefilter1[0] = start.format("YYYY-MM-DD");
            datefilter1[1] = end.format("YYYY-MM-DD");
            let empleado = $("#empleadofilter1").val();
            $("#rangofilter1").val(datefilter1[0] + " - " + datefilter1[1]);
            traerPuntos(datefilter1, 0, empleado);
        }
    );

    $("#rangofilter2").daterangepicker(
        {
            locale: language,
            autoUpdateInput: false,
        },
        function (start, end, label) {
            datefilter2[0] = start.format("YYYY-MM-DD");
            datefilter2[1] = end.format("YYYY-MM-DD");
            let empleado = $("#empleadofilter2").val();
            $("#rangofilter2").val(datefilter2[0] + " - " + datefilter2[1]);
            traerPuntos(datefilter2, 1, empleado);
        }
    );

    $("#empleadofilter1").change(function () {
        let empleado = $(this).val();
        traerPuntos(datefilter1, 0, empleado);
    });

    $("#empleadofilter2").change(function () {
        let empleado = $(this).val();
        traerPuntos(datefilter2, 1, empleado);
    });

    $("#btnGuardarPuntos").click(function () {
        let empleado = $("#empleadoadd").val();
        let fecha = $("#fechaadd").val();
        let puntos = $("#puntosadd").val();
        let tipo = $("#tipopuntosadd").val();
        let observacion = $("#observacionesadd").val();

        if (fecha == "") {
            toastr.error("Debe ingresar una fecha");
            return false;
        } else if (puntos == "" || puntos < 0) {
            toastr.error("Debe ingresar una cantidad de puntos válida");
            return false;
        } else {
            $("#btnGuardarPuntos").attr("disabled", true);
            $.ajax({
                url: "puntos_add",
                type: "POST",
                data: {
                    empleado: empleado,
                    fecha: fecha,
                    puntos: puntos,
                    tipo: tipo,
                    observacion: observacion,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Puntos asignados correctamente");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnGuardarPuntos").attr("disabled", false);
                        toastr.error("Error al asignar los puntos");
                    }
                },
                error: function (data) {
                    $("#btnGuardarPuntos").attr("disabled", false);
                    toastr.error("Error al asignar los puntos");
                },
            });
        }
    });

    $(document).on("click", ".btn_eliminar", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar estos puntos?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "puntos_delete",
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
                            toastr.error("Error al eliminar los puntos");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar los puntos");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_editar", function () {
        let id = $(this).data("id");
        let empleado = $(this).data("empleado");
        let fecha = $(this).data("fecha");
        let puntos = $(this).data("puntos");
        let tipo = $(this).data("tipo");
        let observacion = $(this).data("descripcion");

        $("#idpuntosedit").val(id);
        $("#empleadoedit").val(empleado);
        $("#fechaedit").val(fecha);
        $("#puntosedit").val(puntos);
        $("#tipopuntosedit").val(tipo);
        $("#observacionesedit").val(observacion);
        $("#modalEdit").modal("show");
    });

    $("#btnModificarPuntos").click(function () {
        let id = $("#idpuntosedit").val();
        let empleado = $("#empleadoedit").val();
        let fecha = $("#fechaedit").val();
        let puntos = $("#puntosedit").val();
        let tipo = $("#tipopuntosedit").val();
        let observacion = $("#observacionesedit").val();

        if (fecha == "") {
            toastr.error("Debe ingresar una fecha");
            return false;
        } else if (puntos == "" || puntos < 0) {
            toastr.error("Debe ingresar una cantidad de puntos válida");
            return false;
        } else {
            $("#btnModificarPuntos").attr("disabled", true);
            $.ajax({
                url: "puntos_edit",
                type: "POST",
                data: {
                    id: id,
                    empleado: empleado,
                    fecha: fecha,
                    puntos: puntos,
                    tipo: tipo,
                    observacion: observacion,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Puntos modificados correctamente");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnModificarPuntos").attr("disabled", false);
                        toastr.error("Error al modificar los puntos");
                    }
                },
                error: function (data) {
                    $("#btnModificarPuntos").attr("disabled", false);
                    toastr.error("Error al modificar los puntos");
                },
            });
        }
    });

    $("#btnRealizarCorte").click(function () {
        Swal.fire({
            title: "¿Deseas realizar el corte de los puntos?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Confirmar",
            denyButtonText: `Cancelar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "corte_puntos",
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al realizar el corte de los puntos");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al realizar el corte de los puntos");
                    },
                });
            }
        });
    });

    function traerPuntos(fechas, tipo, empleado) {
        $.ajax({
            url: "puntos_data",
            type: "POST",
            data: {
                fechas: fechas,
                tipo: tipo,
                empleado: empleado,
            },
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;

                    if (tipo == 0) {
                        $("#tbl_pendientes").DataTable().destroy();
                        $("#tbl_pendientes tbody").empty();

                        data.forEach((element) => {
                            let fecha = element.fecha;
                            let tipo_badge = "";
                            let cantidad_badge =
                                '<span class="text-success">' +
                                element.cantidad +
                                "</span>";

                            if (element.tipo == 0) {
                                tipo_badge =
                                    '<span class="badge bg-success">Fijos</span>';
                            } else if (element.tipo == 1) {
                                tipo_badge =
                                    '<span class="badge bg-warning">Ocasionales</span>';
                            } else {
                                tipo_badge =
                                    '<span class="badge bg-danger">Negativos</span>';
                                cantidad_badge =
                                    '<span class="text-danger">' +
                                    element.cantidad +
                                    "</span>";
                            }
                            $("#tbl_pendientes tbody").append(
                                "<tr>" +
                                    "<td>" +
                                    fecha.toLocaleString() +
                                    "</td>" +
                                    "<td>" +
                                    element.nombre_empleado +
                                    "</td>" +
                                    "<td>" +
                                    element.descripcion +
                                    "</td>" +
                                    "<td>" +
                                    tipo_badge +
                                    "</td>" +
                                    "<td>" +
                                    cantidad_badge +
                                    "</td>" +
                                    "<td>" +
                                    element.nombre_creador +
                                    "</td>" +
                                    "<td>" +
                                    '<a class="d-flex btn_editar" data-id="' +
                                    element.id +
                                    '"' +
                                    'data-fecha="' +
                                    element.fecha +
                                    '"' +
                                    'data-empleado="' +
                                    element.id_empleado +
                                    '"' +
                                    'data-descripcion="' +
                                    element.descripcion +
                                    '"' +
                                    'data-tipo="' +
                                    element.tipo +
                                    '" data-puntos="' +
                                    element.cantidad +
                                    '"' +
                                    'href="javascript:void(0);"><i ' +
                                    'class="fa fa-pencil-alt"></i>&nbsp;Editar</a>' +
                                    '<a class="d-flex btn_eliminar" data-id="' + element.id + '"' +
                                    'href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                    "</td>" +
                                    "</tr>"
                            );
                        });

                        $("#tbl_pendientes").DataTable({
                            order: [],
                        });
                    } else if (tipo == 1) {
                        $("#tbl_completados").DataTable().destroy();
                        $("#tbl_completados tbody").empty();

                        data.forEach((element) => {
                            let fecha = element.fecha;
                            let tipo_badge = "";
                            let cantidad_badge =
                                '<span class="text-success">' +
                                element.cantidad +
                                "</span>";

                            if (element.tipo == 0) {
                                tipo_badge =
                                    '<span class="badge bg-success">Fijos</span>';
                            } else if (element.tipo == 1) {
                                tipo_badge =
                                    '<span class="badge bg-warning">Ocasionales</span>';
                            } else {
                                tipo_badge =
                                    '<span class="badge bg-danger">Negativos</span>';
                                cantidad_badge =
                                    '<span class="text-danger">' +
                                    element.cantidad +
                                    "</span>";
                            }
                            $("#tbl_completados tbody").append(
                                "<tr>" +
                                    "<td>" +
                                    fecha.toLocaleString() +
                                    "</td>" +
                                    "<td>" +
                                    element.nombre_empleado +
                                    "</td>" +
                                    "<td>" +
                                    element.descripcion +
                                    "</td>" +
                                    "<td>" +
                                    tipo_badge +
                                    "</td>" +
                                    "<td>" +
                                    cantidad_badge +
                                    "</td>" +
                                    "<td>" +
                                    element.nombre_creador +
                                    "</td>" +
                                    "<td>" +
                                    '<a class="d-flex btn_editar" data-id="' +
                                    element.id +
                                    '"' +
                                    'data-fecha="' +
                                    element.fecha +
                                    '"' +
                                    'data-empleado="' +
                                    element.id_empleado +
                                    '"' +
                                    'data-descripcion="' +
                                    element.descripcion +
                                    '"' +
                                    'data-tipo="' +
                                    element.tipo +
                                    '" data-puntos="' +
                                    element.cantidad +
                                    '"' +
                                    'href="javascript:void(0);"><i ' +
                                    'class="fa fa-pencil-alt"></i>&nbsp;Editar</a>' +
                                    '<a class="d-flex btn_eliminar" data-id="' +
                                    element.id +
                                    '"' +
                                    'href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                    "</td>" +
                                    "</tr>"
                            );
                        });

                        $("#tbl_completados").DataTable({
                            order: [],
                        });
                    }
                    console.log(data);
                } else {
                    toastr.error("Error al cargar los puntos");
                }
            },
            error: function (data) {
                toastr.error("Error al cargar los puntos");
            },
        });
    }
});
