$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btn_AgregarAlmacen", function () {
        $("#parent_add").val(0);
        $("#nivel_almacen_add").val(0);

        $("#modalAdd").modal("show");
    });

    $(document).on("click", ".btn_AddNivel", function () {
        let parent = $(this).data("id");
        $("#parent_add").val(parent);
        $("#nivel_almacen_add").val(1);

        $("#modalAdd").modal("show");
    });

    $("#btnGuardarAlmacen").click(function () {
        let nivel = $("#nivel_almacen_add").val();
        let parent = $("#parent_add").val();
        let nombre = $("#almacenadd").val();
        let observacion = $("#observacion_add").val();

        if (nombre.trim().length == 0) {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnGuardarAlmacen").attr("disabled", true);
            $("#btnGuardarAlmacen").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "almacenes_create",
                type: "POST",
                data: {
                    nivel: nivel,
                    parent: parent,
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
                        $("#btnGuardarAlmacen").html("Guardar");
                        toastr.error("Error al guardar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnGuardarAlmacen").attr("disabled", false);
                    $("#btnGuardarAlmacen").html("Guardar");
                    toastr.error("Error al guardar el almacén");
                },
            });
        }
    });

    $(document).on("click", ".btn_Edit", function () {
        let id = $(this).data("id");
        let nombre = $(this).data("nombre");
        let observaciones = $(this).data("observaciones");

        $("#id_almacen_edit").val(id);
        $("#almacenedit").val(nombre);
        $("#observacion_edit").val(observaciones);

        $("#modalEdit").modal("show");
    });

    $("#btnModificarAlmacen").click(function () {
        let id = $("#id_almacen_edit").val();
        let nombre = $("#almacenedit").val();
        let observacion = $("#observacion_edit").val();

        if (nombre.trim().length == 0) {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnModificarAlmacen").attr("disabled", true);
            $("#btnModificarAlmacen").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "almacenes_update",
                type: "POST",
                data: {
                    id: id,
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
                        $("#btnModificarAlmacen").attr("disabled", false);
                        $("#btnModificarAlmacen").html("Modificar");
                        toastr.error("Error al modificar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnModificarAlmacen").attr("disabled", false);
                    $("#btnModificarAlmacen").html("Modificar");
                    toastr.error("Error al modificar el almacén");
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
});
