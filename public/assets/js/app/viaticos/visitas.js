$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnGuardarVisita").click(function () {
        let cliente = $("#cliente_add").val();
        let responsable = $("#responsable_add").val();
        let motivo = $("#motivo_add").val();
        let destino = $("#destino_add").val();
        let vehiculos = $("#vehiculos_add").val();
        let tecnicos = $("#tecnicos_add").val();
        let salida = $("#salida_add").val();
        let llegada = $("#llegada_add").val();
        let km_salida = $("#km_salida_add").val();
        let observaciones = $("#observaciones_add").val();

        // Validaciones
        if (!cliente || cliente === "") {
            toastr.error("Falta información: Cliente");
            return;
        }

        if (!responsable || responsable === "") {
            toastr.error("Falta información: Responsable");
            return;
        }

        if (!motivo || motivo === "") {
            toastr.error("Falta información: Motivo");
            return;
        }

        if (!destino || destino === "") {
            toastr.error("Falta información: Destino");
            return;
        }

        if (!vehiculos || vehiculos.length === 0) {
            toastr.error("Falta información: Vehículos");
            return;
        }

        if (!tecnicos || tecnicos.length === 0) {
            toastr.error("Falta información: Técnicos");
            return;
        }

        if (!salida || salida === "") {
            toastr.error("Falta información: Salida");
            return;
        }

        if (!llegada || llegada === "") {
            toastr.error("Falta información: Llegada");
            return;
        }

        if (km_salida <= 0) {
            toastr.error("Falta información: Kilometraje de salida");
            return;
        }

        $.ajax({
            type: "POST",
            url: "visitas_viaticos_add",
            data: {
                cliente: cliente,
                responsable: responsable,
                motivo: motivo,
                destino: destino,
                vehiculos: vehiculos,
                tecnicos: tecnicos,
                salida: salida,
                llegada: llegada,
                km_salida: km_salida,
                observaciones: observaciones,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Visita registrada correctamente");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al registrar visita");
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    // Ver información de visita
    $(document).on("click", ".btnView", function () {
        let id = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: "visitas_viaticos_data",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                $("#id_view").val(response.data.id);
                $("#cliente_view")
                    .val(response.data.cliente_id)
                    .trigger("change");
                $("#responsable_view")
                    .val(response.data.empleado_id)
                    .trigger("change");
                $("#motivo_view").val(response.data.motivo).trigger("change");
                $("#destino_view").val(response.data.destino);
                $("#vehiculos_view")
                    .val(response.data.vehiculos)
                    .trigger("change");
                $("#tecnicos_view")
                    .val(response.data.tecnicos)
                    .trigger("change");
                $("#salida_view").val(response.data.fecha_salida);
                $("#llegada_view").val(response.data.fecha_llegada);
                $("#km_salida_view").val(response.data.km_salida);
                $("#km_llegada_view").val(response.data.km_llegada);
                $("#observaciones_view").val(response.data.observaciones);

                $("#modalView").modal("show");
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    // Editar información de visita
    $(document).on("click", ".btnEdit", function () {
        let id = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: "visitas_viaticos_data",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                $("#id_edit").val(response.data.id);
                $("#cliente_edit")
                    .val(response.data.cliente_id)
                    .trigger("change");
                $("#responsable_edit")
                    .val(response.data.empleado_id)
                    .trigger("change");
                $("#motivo_edit").val(response.data.motivo).trigger("change");
                $("#destino_edit").val(response.data.destino);
                $("#vehiculos_edit")
                    .val(response.data.vehiculos)
                    .trigger("change");
                $("#tecnicos_edit")
                    .val(response.data.tecnicos)
                    .trigger("change");
                $("#salida_edit").val(response.data.fecha_salida);
                $("#llegada_edit").val(response.data.fecha_llegada);
                $("#km_salida_edit").val(response.data.km_salida);
                $("#km_llegada_edit").val(response.data.km_llegada);
                $("#observaciones_edit").val(response.data.observaciones);

                $("#modalEdit").modal("show");
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    // Eliminar visita
    $(document).on("click", ".btnDelete", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "visitas_viaticos_delete",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Visita eliminada correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar visita");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        });
    });

    // Completar visita
    $(document).on("click", ".btnConfirmar", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Sí, completar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "visitas_viaticos_completar",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Visita completada correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al completar visita");
                        }
                    },  
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        });
    });

    $("#btnEditVisita").click(function () {
        let id = $("#id_edit").val();
        let cliente = $("#cliente_edit").val();
        let responsable = $("#responsable_edit").val();
        let motivo = $("#motivo_edit").val();
        let destino = $("#destino_edit").val();
        let vehiculos = $("#vehiculos_edit").val();
        let tecnicos = $("#tecnicos_edit").val();
        let salida = $("#salida_edit").val();
        let llegada = $("#llegada_edit").val();
        let km_salida = $("#km_salida_edit").val();
        let km_llegada = $("#km_llegada_edit").val();
        let observaciones = $("#observaciones_edit").val();

        // Validaciones
        if (!cliente || cliente === "") {
            toastr.error("Falta información: Cliente");
            return;
        }

        if (!responsable || responsable === "") {
            toastr.error("Falta información: Responsable");
            return;
        }

        if (!motivo || motivo === "") {
            toastr.error("Falta información: Motivo");
            return;
        }

        if (!destino || destino === "") {
            toastr.error("Falta información: Destino");
            return;
        }

        if (!vehiculos || vehiculos.length === 0) {
            toastr.error("Falta información: Vehículos");
            return;
        }

        if (!tecnicos || tecnicos.length === 0) {
            toastr.error("Falta información: Técnicos");
            return;
        }

        if (!salida || salida === "") {
            toastr.error("Falta información: Salida");
            return;
        }

        if (!llegada || llegada === "") {
            toastr.error("Falta información: Llegada");
            return;
        }

        if (km_salida <= 0) {
            toastr.error("Falta información: Kilometraje de salida");
            return;
        }

        $.ajax({
            type: "POST",
            url: "visitas_viaticos_edit",
            data: {
                id: id,
                cliente: cliente,
                responsable: responsable,
                motivo: motivo,
                destino: destino,
                vehiculos: vehiculos,
                tecnicos: tecnicos,
                salida: salida,
                llegada: llegada,
                km_salida: km_salida,
                km_llegada: km_llegada,
                observaciones: observaciones,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Visita editada correctamente");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al editar visita");
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
