$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnGuardarCategoria").click(function () {
        let nombre = $("#categoriaadd").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $.ajax({
                url: "categorias_archivos_create",
                type: "POST",
                data: { nombre: nombre },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        window.location.href = "categorias_archivos";
                    } else {
                        toastr.error("Error al guardar la categoría");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al guardar la categoría");
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
                    url: "categorias_archivos_delete",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            window.location.href = "categorias_archivos";
                        } else {
                            toastr.error("Error al eliminar la categoría");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar la categoría");
                    },
                });
            }
        });
    });
});
