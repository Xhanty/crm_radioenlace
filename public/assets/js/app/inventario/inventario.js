$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $("#btnGuardarProducto").on("click", function () {
        var codigo = $("#codigoadd").val();
        var nombre = $("#nombreadd").val();
        var categoria = $("#categoriaadd").val();
        var marca = $("#marcadd").val();
        var modelo = $("#modeloadd").val();
        var observaciones = $("#observacionesadd").val();
        var foto = $("#fotoadd")[0].files[0];

        var formData = new FormData();
        formData.append("codigo", codigo);
        formData.append("nombre", nombre);
        formData.append("categoria", categoria);
        formData.append("marca", marca);
        formData.append("modelo", modelo);
        formData.append("observaciones", observaciones);
        formData.append("foto", foto);

        $("#btnGuardarProducto").attr("disabled", true);
        $.ajax({
            url: "productos_create",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al guardar el producto");
                    $("#btnGuardarProducto").attr("disabled", false);
                }
            },
            error: function (error) {
                toastr.error("Error al guardar el producto");
                $("#btnGuardarProducto").attr("disabled", false);
            },
        });
    });

    $("#btnEditarProducto").on("click", function () {
        var id = $("#id_producto").val();
        var codigo = $("#codigoedit").val();
        var nombre = $("#nombreedit").val();
        var categoria = $("#categoriaedit").val();
        var marca = $("#marcaedit").val();
        var modelo = $("#modeloedit").val();
        var observaciones = $("#observacionesedit").val();
        var foto = $("#fotoedit")[0].files[0];

        var formData = new FormData();
        formData.append("id", id);
        formData.append("codigo", codigo);
        formData.append("nombre", nombre);
        formData.append("categoria", categoria);
        formData.append("marca", marca);
        formData.append("modelo", modelo);
        formData.append("observaciones", observaciones);
        formData.append("foto", foto);

        $("#btnEditarProducto").attr("disabled", true);
        $.ajax({
            url: "productos_edit",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al modificar el producto");
                    $("#btnEditarProducto").attr("disabled", false);
                }
            },
            error: function (error) {
                toastr.error("Error al modificar el producto");
                $("#btnEditarProducto").attr("disabled", false);
            },
        });
    });

    $(document).on("click", ".btn_Edit", function () {
        var id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "data_producto",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (data) {
                let producto = data.producto;

                $("#imagenedit").attr("src", url_general + "images/productos/" + producto.imagen);
                $("#id_producto").val(producto.id);
                $("#codigoedit").val(producto.cod_producto);
                $("#nombreedit").val(producto.nombre);
                $("#categoriaedit").val(producto.id_categoria);
                $("#marcaedit").val(producto.marca);
                $("#modeloedit").val(producto.modelo);
                $("#observacionesedit").val(producto.observaciones);

                $("#modalEdit").modal("show");
                $("#global-loader").fadeOut("fast");
            },
            error: function (data) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar los datos");
            },
        });
    });

    $(document).on("click", ".btn_Baja", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas cambiar el estado este producto?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Aceptar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "baja_producto",
                    data: { id: id },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al actualizar el producto");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al actualizar el producto");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar este producto?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Aceptar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "delete_producto",
                    data: { id: id },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el producto");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar el producto");
                    },
                });
            }
        });
    });
});
