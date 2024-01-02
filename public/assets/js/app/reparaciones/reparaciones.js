$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let encargados = JSON.parse(localStorage.getItem("encargados"));
    let categorias = JSON.parse(localStorage.getItem("categorias"));
    let accesorios = JSON.parse(localStorage.getItem("accesorios"));

    $(".open-toggle").trigger("click");

    $("#new_row_add").click(function () {
        $("#div_reparaciones_add").append('<div style="display: flex;" class="mt-3">' +
            '<div style="width: 99%; border-bottom: 2px solid #ccc;">' +
            '<div class="row row-sm">' +
            '<div class="col-lg">' +
            '<label for="">Persona que recibe</label>' +
            '<select class="form-select encargado_add">' +
            '<option value="">Seleccione una opción</option>' +
            encargados.map((encargado) => {
                return `<option value="${encargado.id}">${encargado.nombre}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Categoría</label>' +
            '<select class="form-select categoria_add">' +
            '<option value="">Seleccione una opción</option>' +
            categorias.map((categoria) => {
                return `<option value="${categoria.id}">${categoria.categoria}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Accesorios</label>' +
            '<select multiple class="form-select accesorios_add">' +
            '<option value="">Seleccione una opción</option>' +
            accesorios.map((accesorio) => {
                return `<option value="${accesorio.id}">${accesorio.accesorio}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="row row-sm mt-2">' +
            '<div class="col-lg">' +
            '<label for="">Modelo</label>' +
            '<input class="form-control modelo_add" placeholder="Modelo" type="text">' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Serie</label>' +
            '<input class="form-control serie_add" placeholder="Serie" type="text">' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Foto</label>' +
            '<input class="form-control foto_add" type="file" accept="image/*">' +
            '</div>' +
            '</div>' +
            '<div class="row row-sm mt-2">' +
            '<div class="col-lg">' +
            '<label for="">Observaciones</label>' +
            '<textarea class="form-control observaciones_add" placeholder="Observaciones" rows="3"' +
            'style="height: 90px; resize: none"></textarea>' +
            '</div>' +
            '</div>' +
            '<br>' +
            '</div>' +
            '<div style="display: flex;"">' +
            '<a class="center-vertical delete_row" style="margin-left: 20px; margin-top: -22px;"' +
            'href="javascript:void(0);"><i class="fa fa-trash"></i></a>' +
            '</div>' +
            '</div> ');

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", "#new_row_edit", function () {
        $("#div_reparaciones_edit").append('<div style="display: flex;" class="mt-3">' +
            '<div style="width: 99%; border-bottom: 2px solid #ccc;">' +
            '<div class="row row-sm">' +
            '<div class="col-lg">' +
            '<label for="">Persona que recibe</label>' +
            '<select class="form-select encargado_edit">' +
            '<option value="">Seleccione una opción</option>' +
            encargados.map((encargado) => {
                return `<option value="${encargado.id}">${encargado.nombre}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Categoría</label>' +
            '<select class="form-select categoria_edit">' +
            '<option value="">Seleccione una opción</option>' +
            categorias.map((categoria) => {
                return `<option value="${categoria.id}">${categoria.categoria}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Accesorios</label>' +
            '<select multiple class="form-select accesorios_edit">' +
            '<option value="">Seleccione una opción</option>' +
            accesorios.map((accesorio) => {
                return `<option value="${accesorio.id}">${accesorio.accesorio}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="row row-sm mt-2">' +
            '<div class="col-lg">' +
            '<label for="">Modelo</label>' +
            '<input class="form-control modelo_edit" placeholder="Modelo" type="text">' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Serie</label>' +
            '<input class="form-control serie_edit" placeholder="Serie" type="text">' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Foto</label>' +
            '<input class="form-control foto_edit" type="file" accept="image/*">' +
            '</div>' +
            '</div>' +
            '<div class="row row-sm mt-2">' +
            '<div class="col-lg">' +
            '<label for="">Observaciones</label>' +
            '<textarea class="form-control observaciones_edit" placeholder="Observaciones" rows="3"' +
            'style="height: 90px; resize: none"></textarea>' +
            '</div>' +
            '</div>' +
            '<br>' +
            '</div>' +
            '<div style="display: flex;"">' +
            '<a class="center-vertical delete_row" style="margin-left: 20px; margin-top: -22px;"' +
            'href="javascript:void(0);"><i class="fa fa-trash"></i></a>' +
            '</div>' +
            '</div> ');

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".delete_row", function () {
        $(this).parent().parent().remove();
    });

    // Agregar
    $("#btnGuardarRecepcion").click(function () {
        let cliente = $("#cliente_add").val();
        let correos = $("#correos_add").val();
        let valid = false;

        let reparaciones = [];

        $(".encargado_add").each(function () {
            let encargado = $(this).val();
            let categoria = $(this).parent().parent().find(".categoria_add").val();
            let accesorios = $(this).parent().parent().find(".accesorios_add").val();
            let modelo = $(this).parent().parent().parent().find(".modelo_add").val();
            let serie = $(this).parent().parent().parent().find(".serie_add").val();
            let observaciones = $(this).parent().parent().parent().find(".observaciones_add").val();
            let foto = $(this).parent().parent().parent().find(".foto_add")[0].files[0];

            if (encargado == "" || categoria == "") {
                valid = true;
            }

            reparaciones.push({
                encargado,
                categoria,
                accesorios,
                modelo,
                serie,
                observaciones,
                foto,
            });

            if (cliente == "") {
                toastr.error("El campo cliente es obligatorio");
                return false;
            } else if (valid) {
                toastr.error("Debes llenar los campos obligatorios de cada recepción");
                return false;
            } else {
                $("#btnGuardarRecepcion").attr("disabled", true);
                $("#btnGuardarRecepcion").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

                let formData = new FormData();
                formData.append("cliente", cliente);
                formData.append("correos", correos);
                formData.append("reparaciones", JSON.stringify(reparaciones));

                $.ajax({
                    url: "reparaciones_add",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Recepción registrada correctamente");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ocurrió un error al registrar la recepción");
                            $("#btnGuardarRecepcion").attr("disabled", false);
                            $("#btnGuardarRecepcion").html("Guardar");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Ocurrió un error al registrar la recepción");
                        $("#btnGuardarRecepcion").attr("disabled", false);
                        $("#btnGuardarRecepcion").html("Guardar");
                    }
                });

                reparaciones = [];
            }
        });
    });

    // Modificar
    $("#btnModificarRecepcion").click(function () {
        let id = $("#id_recepcion_edit").val();
        let cliente = $("#cliente_edit").val();
        let correos = $("#correos_edit").val();
        let valid = false;

        let reparaciones = [];

        $(".encargado_edit").each(function () {
            let encargado = $(this).val();
            let categoria = $(this).parent().parent().find(".categoria_edit").val();
            let accesorios = $(this).parent().parent().find(".accesorios_edit").val();
            let modelo = $(this).parent().parent().parent().find(".modelo_edit").val();
            let serie = $(this).parent().parent().parent().find(".serie_edit").val();
            let observaciones = $(this).parent().parent().parent().find(".observaciones_edit").val();
            let foto = $(this).parent().parent().parent().find(".foto_edit")[0].files[0];

            if (encargado == "" || categoria == "") {
                valid = true;
            }

            reparaciones.push({
                encargado,
                categoria,
                accesorios,
                modelo,
                serie,
                observaciones,
                foto,
            });
        });

        if (cliente == "") {
            toastr.error("El campo cliente es obligatorio");
            return false;
        } else if (valid) {
            toastr.error("Debes llenar los campos obligatorios de cada recepción");
            return false;
        } else {
            $("#btnModificarRecepcion").attr("disabled", true);
            $("#btnModificarRecepcion").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

            let formData = new FormData();
            formData.append("id", id);
            formData.append("cliente", cliente);
            formData.append("correos", correos);
            formData.append("reparaciones", JSON.stringify(reparaciones));

            $.ajax({
                url: "reparaciones_edit",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Recepción modificada correctamente");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Ocurrió un error al modificar la recepción");
                        $("#btnModificarRecepcion").attr("disabled", false);
                        $("#btnModificarRecepcion").html("Guardar");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Ocurrió un error al modificar la recepción");
                    $("#btnModificarRecepcion").attr("disabled", false);
                    $("#btnModificarRecepcion").html("Guardar");
                }
            });
        }
    });

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
                            '<div style="width: 99%; border-bottom: 2px solid #ccc;">' +
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
                            '<a class="center-vertical" style="margin-left: 20px; margin-top: -42px;"' +
                            'href="javascript:void(0);"><i class="fa fa-trash"></i></a>' +
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

    // Modificar
    $(document).on("click", ".btnEdit", function () {
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

                    $("#id_recepcion_edit").val(data.id);
                    $("#cliente_edit").val(data.cliente_id).trigger("change");
                    $("#correos_edit").val(data.correos);

                    $("#div_reparaciones_edit").html("");

                    detalle.forEach(function (element, key) {
                        let accesorios_data = JSON.parse(element.accesorios);
                        let btn = '<a class="center-vertical delete_row" style="margin-left: 20px; margin-top: -42px;" href="javascript:void(0);"><i class="fa fa-trash"></i></a>';
                        for (let i = 0; i < accesorios_data.length; i++) {
                            accesorios_data[i] = parseInt(accesorios_data[i]);
                        }

                        if (key == 0) {
                            btn = '<a class="center-vertical" id="new_row_edit" style="margin-left: 20px; margin-top: -42px;" href="javascript:void(0);"><i class="fa fa-plus"></i></a>';
                        }

                        $("#div_reparaciones_edit").append('<div style="display: flex;" class="mt-3">' +
                            '<div style="width: 99%; border-bottom: 2px solid #ccc;">' +
                            '<div class="row row-sm">' +
                            '<div class="col-lg">' +
                            '<label for="">Persona que recibe</label>' +
                            '<select class="form-select encargado_edit">' +
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
                            '<select class="form-select categoria_edit">' +
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
                            '<select multiple class="form-select accesorios_edit">' +
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
                            '<input class="form-control modelo_edit" value="' + element.modelo + '" placeholder="Modelo" type="text">' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Serie</label>' +
                            '<input class="form-control serie_edit" value="' + element.serie + '" placeholder="Serie" type="text">' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Foto</label>' +
                            '<input class="form-control foto_edit" type="file" accept="image/*">' +
                            '</div>' +
                            '</div>' +
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg">' +
                            '<label for="">Observaciones</label>' +
                            '<textarea class="form-control observaciones_edit" placeholder="Observaciones" rows="3"' +
                            'style="height: 90px; resize: none">' + element.observacion + '</textarea>' +
                            '</div>' +
                            '</div>' +
                            '<br>' +
                            '</div>' +
                            '<div style="display: flex;"">' +
                            btn +
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

                    $("#modalEdit").modal("show");
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
                    url: "reparaciones_completar",
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

    // Reversar
    $(document).on("click", ".btnReversar", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, reversar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "reparaciones_reversar",
                    type: "POST",
                    data: { id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Se reversó correctamente");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ocurrió un error al reversar");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ocurrió un error al reversar");
                        console.log(error);
                    }
                });
            }
        });
    });

    // Eliminar
    $(document).on("click", ".btnDelete", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "reparaciones_delete",
                    type: "POST",
                    data: { id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Se eliminó correctamente");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ocurrió un error al eliminar");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ocurrió un error al eliminar");
                        console.log(error);
                    },
                });
            }
        }
        );
    });

    // Técnico
    $(document).on("click", ".btnTecnico", function () {
        let id = $(this).attr("data-id");
        let tecnico = $(this).attr("data-tecnico");

        if (tecnico != "") {
            $("#tecnico_add").val(tecnico).trigger("change");
        }

        $("#id_recepcion_tecnico").val(id);
        $("#modalTecnico").modal("show");
    });

    $("#btnTecnico").click(function () {
        let id = $("#id_recepcion_tecnico").val();
        let tecnico = $("#tecnico_add").val();

        if (tecnico == "") {
            toastr.error("Debe seleccionar un técnico");
            return false;
        } else {
            $("#btnTecnico").attr("disabled", true);
            $("#btnTecnico").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
            $.ajax({
                url: "reparaciones_tecnico",
                type: "POST",
                data: { id, tecnico },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Se asignó correctamente");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Ocurrió un error al asignar");
                    }
                }
            });
        }
    });
});
