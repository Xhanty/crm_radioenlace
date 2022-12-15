$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnGuardarArchivo").click(function () {
        let cliente = $("#clienteadd").val();
        let categoria = $("#categoriaadd").val();

        let formData = new FormData();
        formData.append("cliente", cliente);
        formData.append("categoria", categoria);
        formData.append("archivo", $("#documentoadd")[0].files[0]);

        if ($("#documentoadd").val() == "" || $("#documentoadd").val() == null) {
            toastr.error("Debe seleccionar un archivo");
            return false;
        } else {
            $("#btnGuardarArchivo").attr("disabled", true);
            $.ajax({
                url: "archivos_add",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Archivo guardado correctamente");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al guardar el archivo");
                        $("#btnGuardarArchivo").attr("disabled", false);
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al guardar el archivo");
                    $("#btnGuardarArchivo").attr("disabled", false);
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
                    url: "archivos_delete",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Archivo eliminado correctamente");
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el archivo");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar el archivo");
                    },
                });
            }
        });
    });
});
