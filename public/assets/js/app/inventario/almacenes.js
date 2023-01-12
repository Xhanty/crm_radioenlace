$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnGuardarAlmacen").click(function () {
        let nombre = $("#almacenadd").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $.ajax({
                url: "almacenes_create",
                type: "POST",
                data: { nombre: nombre },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al guardar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al guardar el almacén");
                },
            });
        }
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");

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
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el almacén");
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
            cargarNivel1(1, $("#nivel_ingreso_add").val(), 0);
        } else {
            $("#cliente_add").parent().removeClass("d-none");
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
            cargarNivel1(ubicacion, val, $("#cliente_add").val());
        }
    });

    $("#cliente_add").on("change", function () {
        let val = $(this).val();
        cargarNivel1(2, $("#nivel_ingreso_add").val(), val);
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

                        console.log(data);
                        $("#nivel_uno_add").empty();
                        $("#nivel_dos_add").empty();
                        data.forEach((element) => {
                            $("#nivel_uno_add").append(
                                `<option value="${element.id}">${element.nombre}</option>`
                            );
                        });

                        if (nivel == 3) {
                            cargarNivel2(ubicacion, data[0].estantes);
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

                        console.log(data);
                        $("#nivel_uno_add").empty();
                        $("#nivel_dos_add").empty();
                        data.forEach((element) => {
                            $("#nivel_uno_add").append(
                                `<option value="${element.id}">${element.nombre}</option>`
                            );
                        });

                        if (nivel == 3) {
                            cargarNivel2(ubicacion, data[0].estantes);
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
        }
    }

    function cargarNivel2(ubicacion, data) {
        if (ubicacion == 1) {
            $("#nivel_dos_add").empty();

            data.forEach((element) => {
                $("#nivel_dos_add").append(
                    `<option value="${element.id}">${element.nombre}</option>`
                );
            });
        } else if (ubicacion == 2) {
            $("#nivel_dos_add").empty();
            data.forEach((element) => {
                $("#nivel_dos_add").append(
                    `<option value="${element.id}">${element.nombre}</option>`
                );
            });
        }
    }
});
