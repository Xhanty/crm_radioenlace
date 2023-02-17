$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btnDeleteCategoria", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var proyectos = $(this).data("proyectos");

        if (proyectos > 0) {
            toastr.error("No se puede eliminar esta categoría porque tiene proyectos asociados");
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
                        url: "categorias_proyectos_delete",
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
                                toastr.error("Ha ocurrido un error al eliminar la categoría");
                            }
                        },
                        error: function (error) {
                            toastr.error("Ha ocurrido un error al eliminar la categoría");
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
            $("#btnGuardarCategoria").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "categorias_proyectos_add",
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
                        toastr.error("Ha ocurrido un error al crear la categoría");
                        $("#btnGuardarCategoria").attr("disabled", false);
                        $("#btnGuardarCategoria").html("Guardar");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al crear la categoría");
                    $("#btnGuardarCategoria").attr("disabled", false);
                    $("#btnGuardarCategoria").html("Guardar");
                    console.log(error);
                },
            });
        }
    });
});
