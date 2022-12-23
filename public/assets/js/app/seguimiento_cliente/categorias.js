$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btnDeleteCategoria", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var seguimientos = $(this).data("seguimientos");

        if (seguimientos > 0) {
            toastr.error(
                "No se puede eliminar la categoría porque tiene seguimientos asociados"
            );
        } else {
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
                        url: "categorias_seguimientos_delete",
                        type: "POST",
                        data: {
                            id: id,
                        },
                        success: function (response) {
                            if (response.info == 1) {
                                toastr.success(
                                    "Categoría eliminada correctamente"
                                );
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.error(
                                    "Ha ocurrido un error al eliminar la categoría"
                                );
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
        }
    });

    $("#btnGuardarCategoria").click(function (e) {
        e.preventDefault();
        var nombre = $("#categoriaadd").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnGuardarCategoria").attr("disabled", true);
            $.ajax({
                url: "categorias_seguimientos_add",
                type: "POST",
                data: {
                    nombre: nombre,
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
});
