$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnGuardarAlmacen").click(function () {
        let nombre = $("#almacenadd").val();
        let ubicacion = $("#general_add").val();
        let nivel = $("#nivel_ingreso_add").val();
        let cliente = $("#cliente_add").val();
        let nivel1 = $("#nivel_uno_add").val();
        let nivel2 = $("#nivel_dos_add").val();
        let observacion = $("#observacion_add").val();

        if (ubicacion == 2 && cliente == null) {
            toastr.error("El campo cliente es obligatorio");
        } else if (nivel == 2 && nivel1 == null) {
            toastr.error("El campo nivel 1 es obligatorio");
        } else if (nivel == 3 && nivel1 == null) {
            toastr.error("El campo nivel 1 es obligatorio");
        } else if (nivel == 3 && nivel2 == null) {
            toastr.error("El campo nivel 2 es obligatorio");
        } else if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {

            $("#btnGuardarAlmacen").attr("disabled", true);
            $.ajax({
                url: "almacenes_create",
                type: "POST",
                data: {
                    ubicacion: ubicacion,
                    nivel: nivel,
                    cliente: cliente,
                    nivel1: nivel1,
                    nivel2: nivel2,
                    nombre: nombre,
                    observacion: observacion,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnGuardarAlmacen").attr("disabled", false);
                        toastr.error("Error al guardar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnGuardarAlmacen").attr("disabled", false);
                    toastr.error("Error al guardar el almacén");
                },
            });
        }
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");
        let nivel = $(this).data("nivel");
        let cliente = $(this).data("cliente");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: "¡No, cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "almacenes_delete",
                    type: "POST",
                    data: { id: id, nivel: nivel, cliente: cliente },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.warning(response.success);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar el almacén");
                    },
                });
            }
        });
    });

    $("#general_add").on("change", function () {
        let val = $(this).val();

        if (val == 1) {
            $("#cliente_add").parent().addClass("d-none");
            $("#nivel_ingreso_add").val(1).change();
            $("#nivel_ingreso_add option[value='3']").attr("disabled", false);
            cargarNivel1(1, $("#nivel_ingreso_add").val(), 0);
        } else if (val == 2) {
            $("#cliente_add").parent().removeClass("d-none");
            $("#nivel_ingreso_add").val(1).change();
            $("#nivel_ingreso_add option[value='3']").attr("disabled", true);
            cargarNivel1(
                2,
                $("#nivel_ingreso_add").val(),
                $("#cliente_add").val()
            );
        }
    });

    $("#nivel_ingreso_add").on("change", function () {
        let val = $(this).val();
        let ubicacion = $("#general_add").val();

        if (val == 1) {
            $("#nivel_uno_add").parent().parent().addClass("d-none");
            $("#nivel_dos_add").parent().addClass("d-none");
            cargarNivel1(ubicacion, val, $("#cliente_add").val());
        } else if (val == 2) {
            $("#nivel_uno_add").parent().parent().removeClass("d-none");
            $("#nivel_uno_add").parent().removeClass("d-none");
            $("#nivel_dos_add").parent().addClass("d-none");
            cargarNivel1(ubicacion, val, $("#cliente_add").val());
        } else if (val == 3) {
            $("#nivel_uno_add").parent().parent().removeClass("d-none");
            $("#nivel_uno_add").parent().removeClass("d-none");
            $("#nivel_dos_add").parent().removeClass("d-none");
            cargarNivel1(ubicacion, val, 0);
        }
    });

    $("#cliente_add").on("change", function () {
        let val = $(this).val();
        cargarNivel1(2, $("#nivel_ingreso_add").val(), val);
    });

    $("#nivel_uno_add").on("change", function () {
        let data = $(this).find(":selected").data("options");
        let nivel = $("#nivel_ingreso_add").val();

        if (nivel == 3) {
            cargarNivel2(JSON.parse(JSON.stringify(data)));
        }
    });

    function cargarNivel1(ubicacion, nivel, cliente) {
        if (ubicacion == 1 && nivel > 1) {
            $.ajax({
                url: "almacenes_sede",
                type: "POST",
                data: { nivel: nivel },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        $("#nivel_uno_add").empty();
                        $("#nivel_dos_add").empty();
                        data.forEach((element) => {
                            $("#nivel_uno_add").append(
                                `<option data-options='${JSON.stringify(
                                    element.estantes
                                )}' value="${element.id}">${
                                    element.nombre
                                }</option>`
                            );
                        });

                        if (nivel == 3 && data[0].estantes) {
                            cargarNivel2(data[0].estantes);
                        }
                    } else {
                        toastr.error("Error al cargar el nivel 1");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al cargar el nivel 1");
                },
            });
        } else if (ubicacion == 2 && nivel > 1) {
            $.ajax({
                url: "almacenes_cliente",
                type: "POST",
                data: { nivel: nivel, cliente: cliente },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        $("#nivel_uno_add").empty();
                        data.forEach((element) => {
                            $("#nivel_uno_add").append(
                                `<option value="${element.id}">${element.nombre}</option>`
                            );
                        });
                    } else {
                        toastr.error("Error al cargar el nivel 1");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al cargar el nivel 1");
                },
            });
        }
    }

    function cargarNivel2(data) {
        $("#nivel_dos_add").empty();

        if (data.length > 0) {
            data.forEach((element) => {
                $("#nivel_dos_add").append(
                    `<option value="${element.id}">${element.nombre}</option>`
                );
            });
        }
    }

    $(document).on("click", ".btn_Edit", function () {
        let id = $(this).data("id");
        let nivel = $(this).data("nivel");
        let nombre = $(this).data("nombre");
        let observaciones = $(this).data("observaciones");

        $("#id_almacen_edit").val(id);
        $("#nivel_almacen_edit").val(nivel);
        $("#almacenedit").val(nombre);
        $("#observacion_edit").val(observaciones);

        $("#modalEdit").modal("show");
    });

    $(document).on("click", ".btn_Edit", function () {
        let id = $(this).data("id");
        let nivel = $(this).data("nivel");
        let nombre = $(this).data("nombre");
        let observaciones = $(this).data("observaciones");

        $("#id_almacen_edit").val(id);
        $("#nivel_almacen_edit").val(nivel);
        $("#almacenedit").val(nombre);
        $("#observacion_edit").val(observaciones);
        $("#cliente_almacen_edit").val(0);

        $("#modalEdit").modal("show");
    });

    $(document).on("click", ".btn_Edit_Cliente", function () {
        let id = $(this).data("id");
        let nivel = $(this).data("nivel");
        let nombre = $(this).data("nombre");
        let observaciones = $(this).data("observaciones");

        $("#id_almacen_edit").val(id);
        $("#nivel_almacen_edit").val(nivel);
        $("#almacenedit").val(nombre);
        $("#observacion_edit").val(observaciones);
        $("#cliente_almacen_edit").val(1);

        $("#modalEdit").modal("show");
    });

    $("#btnModificarAlmacen").click(function () {
        let id = $("#id_almacen_edit").val();
        let nombre = $("#almacenedit").val();
        let nivel = $("#nivel_almacen_edit").val();
        let observacion = $("#observacion_edit").val();
        let cliente = $("#cliente_almacen_edit").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnModificarAlmacen").attr("disabled", true);
            $.ajax({
                url: "almacenes_update",
                type: "POST",
                data: {
                    cliente: cliente,
                    id: id,
                    nombre: nombre,
                    nivel: nivel,
                    observacion: observacion,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnModificarAlmacen").attr("disabled", false);
                        toastr.error("Error al modificar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnModificarAlmacen").attr("disabled", false);
                    toastr.error("Error al modificar el almacén");
                },
            });
        }
    });
});
