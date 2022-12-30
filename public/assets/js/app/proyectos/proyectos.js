$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    $("#btnGuardarProyecto").click(function () {
        let categoria = $("#categoria_add").val();
        let cliente = $("#cliente_add").val();
        let nombre = $("#nombre_add").val();
        let facturacion = $("#facturacion_add").val();
        let puntos = $("#puntos_add").val();
        let puntos_mensuales = $("#puntos_mensuales_add").val();
        let porcentaje_tecnico = $("#porcentaje_tecnico_add").val();
        let porcentaje_participante = $("#porcentaje_participante_add").val();
        let fecha_inicio = $("#fecha_inicio_add").val();
        let fecha_culminacion = $("#fecha_culminacion_add").val();
        let descripcion = $("#descripcion_add").val();

        if (nombre == "") {
            toastr.error("El nombre del proyecto es obligatorio");
            return false;
        } else if (fecha_inicio == "") {
            toastr.error("La fecha de inicio es obligatoria");
            return false;
        } else {
            $("#btnGuardarProyecto").attr("disabled", true);
            $.ajax({
                url: "proyectos_add",
                type: "POST",
                data: {
                    categoria: categoria,
                    cliente: cliente,
                    nombre: nombre,
                    facturacion: facturacion,
                    puntos: puntos,
                    puntos_mensuales: puntos_mensuales,
                    porcentaje_tecnico: porcentaje_tecnico,
                    porcentaje_participante: porcentaje_participante,
                    fecha_inicio: fecha_inicio,
                    fecha_culminacion: fecha_culminacion,
                    descripcion: descripcion,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Proyecto agregado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al agregar el proyecto");
                        $("#btnGuardarProyecto").attr("disabled", false);
                    }
                },
                error: function (response) {
                    toastr.error("Error al agregar el proyecto");
                    console.log(response);
                    $("#btnGuardarProyecto").attr("disabled", false);
                },
            });
        }
    });

    $("#btnModificarProyecto").click(function () {
        let proyecto = $("#id_proyect_edit").val();
        let categoria = $("#categoria_edit").val();
        let cliente = $("#cliente_edit").val();
        let nombre = $("#nombre_edit").val();
        let facturacion = $("#facturacion_edit").val();
        let puntos = $("#puntos_edit").val();
        let puntos_mensuales = $("#puntos_mensuales_edit").val();
        let porcentaje_tecnico = $("#porcentaje_tecnico_edit").val();
        let porcentaje_participante = $("#porcentaje_participante_edit").val();
        let fecha_inicio = $("#fecha_inicio_edit").val();
        let fecha_culminacion = $("#fecha_culminacion_edit").val();
        let descripcion = $("#descripcion_edit").val();

        if (nombre == "") {
            toastr.error("El nombre del proyecto es obligatorio");
            return false;
        } else if (fecha_inicio == "") {
            toastr.error("La fecha de inicio es obligatoria");
            return false;
        } else {
            $("#btnModificarProyecto").attr("disabled", true);
            $.ajax({
                url: "proyectos_edit",
                type: "POST",
                data: {
                    id: proyecto,
                    categoria: categoria,
                    cliente: cliente,
                    nombre: nombre,
                    facturacion: facturacion,
                    puntos: puntos,
                    puntos_mensuales: puntos_mensuales,
                    porcentaje_tecnico: porcentaje_tecnico,
                    porcentaje_participante: porcentaje_participante,
                    fecha_inicio: fecha_inicio,
                    fecha_culminacion: fecha_culminacion,
                    descripcion: descripcion,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Proyecto modificado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al modificar el proyecto");
                        $("#btnModificarProyecto").attr("disabled", false);
                    }
                },
                error: function (response) {
                    toastr.error("Error al modificar el proyecto");
                    console.log(response);
                    $("#btnModificarProyecto").attr("disabled", false);
                },
            });
        }
    });

    $(document).on("click", ".btn_editar", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "proyectos_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;

                    console.log(data);
                    $("#id_proyect_edit").val(data.id);
                    $("#categoria_edit").val(data.id_categoria);
                    $("#cliente_edit").val(data.id_cliente);
                    $("#nombre_edit").val(data.nombre);
                    $("#facturacion_edit").val(data.facturacion);
                    $("#puntos_edit").val(data.puntos);
                    $("#puntos_mensuales_edit").val(data.puntos_mensuales);
                    $("#porcentaje_tecnico_edit").val(
                        data.porcentaje_tecnico
                    );
                    $("#porcentaje_participante_edit").val(
                        data.porcentaje_participante
                    );
                    $("#fecha_inicio_edit").val(data.fecha_inicio);
                    $("#fecha_culminacion_edit").val(
                        data.fecha_culminacion
                    );
                    $("#descripcion_edit").val(data.descripcion);

                    $("#global-loader").fadeOut("fast");

                    $("#modalEdit").modal("show");
                } else {
                    $("#global-loader").fadeOut("fast");
                    toastr.error("Error al obtener los datos del proyecto");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al obtener los datos del proyecto");
                console.log(response);
            },
        });
    });
});
