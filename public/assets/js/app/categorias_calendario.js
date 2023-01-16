$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btn_Delete", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "categorias_calendario_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Categoría eliminada correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function (error) {
                        toastr.error(
                            "Ha ocurrido un error al eliminar la categoría"
                        );
                        console.log(error);
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_Edit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var color_texto = $(this).data("color");
        var color_fondo = $(this).data("fondo");

        $("#categoriaedit").val(nombre);
        $("#color_text_edit").val(color_texto);
        $("#color_fondo_edit").val(color_fondo);
        $("#id_edit").val(id);

        $("#modalEdit").modal("show");
    });

    $("#btnGuardarCategoria").click(function (e) {
        e.preventDefault();
        var nombre = $("#categoriaadd").val();
        var color_texto = $("#color_text_add").val();
        var color_fondo = $("#color_fondo_add").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnGuardarCategoria").attr("disabled", true);
            $.ajax({
                url: "categorias_calendario_add",
                type: "POST",
                data: {
                    nombre: nombre,
                    color_texto: color_texto,
                    color_fondo: color_fondo,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Categoría creada correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al crear la categoría"
                        );
                        $("#btnGuardarCategoria").attr("disabled", false);
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al crear la categoría");
                    $("#btnGuardarCategoria").attr("disabled", false);
                    console.log(error);
                },
            });
        }
    });

    $("#btnEditarCategoria").click(function (e) {
        e.preventDefault();
        var nombre = $("#categoriaedit").val();
        var color_texto = $("#color_text_edit").val();
        var color_fondo = $("#color_fondo_edit").val();
        var id = $("#id_edit").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnEditarCategoria").attr("disabled", true);
            $.ajax({
                url: "categorias_calendario_update",
                type: "POST",
                data: {
                    nombre: nombre,
                    color_texto: color_texto,
                    color_fondo: color_fondo,
                    id: id,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Categoría modificada correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar la categoría"
                        );
                        $("#btnEditarCategoria").attr("disabled", false);
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al editar la categoría");
                    $("#btnEditarCategoria").attr("disabled", false);
                    console.log(error);
                },
            });
        }
    });
});
