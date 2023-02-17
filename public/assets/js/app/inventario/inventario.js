$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#codigoadd").val("PR-" + makecode(8));
    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $(".open-toggle").trigger("click");

    $("#btnGuardarProducto").on("click", function () {
        var codigo = $("#codigoadd").val();
        var marca = $("#marcadd").val();
        var categoria = $("#categoriaadd").val();
        var subcategoria = $("#subcategoriaadd").val();
        var modelo = $("#modeloadd").val();
        var nombre = $("#nombreadd").val();
        var foto = $("#fotoadd")[0].files[0];
        var observaciones = $("#observacionesadd").val();

        var formData = new FormData();
        formData.append("codigo", codigo);
        formData.append("marca", marca);
        formData.append("categoria", categoria);
        formData.append("subcategoria", subcategoria);
        formData.append("modelo", modelo);
        formData.append("nombre", nombre);
        formData.append("foto", foto);
        formData.append("observaciones", observaciones);

        $("#btnGuardarProducto").attr("disabled", true);
        $("#btnGuardarProducto").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
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
                    $("#btnGuardarProducto").html("Guardar");
                }
            },
            error: function (error) {
                toastr.error("Error al guardar el producto");
                $("#btnGuardarProducto").attr("disabled", false);
                $("#btnGuardarProducto").html("Guardar");
            },
        });
    });

    $("#btnEditarProducto").on("click", function () {
        var id = $("#id_producto").val();
        var marca = $("#marcaedit").val();
        var nombre = $("#nombreedit").val();
        var categoria = $("#categoriaedit").val();
        var subcategoria = $("#subcategoriaedit").val();
        var modelo = $("#modeloedit").val();
        var foto = $("#fotoedit")[0].files[0];
        var observaciones = $("#observacionesedit").val();

        var formData = new FormData();
        formData.append("id", id);
        formData.append("marca", marca);
        formData.append("categoria", categoria);
        formData.append("subcategoria", subcategoria);
        formData.append("modelo", modelo);
        formData.append("nombre", nombre);
        formData.append("foto", foto);
        formData.append("observaciones", observaciones);

        $("#btnEditarProducto").attr("disabled", true);
        $("#btnEditarProducto").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
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
                    $("#btnEditarProducto").html("Modificar");
                }
            },
            error: function (error) {
                toastr.error("Error al modificar el producto");
                $("#btnEditarProducto").attr("disabled", false);
                $("#btnEditarProducto").html("Modificar");
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

                $("#imagenedit").attr(
                    "src",
                    url_general + "images/productos/" + producto.imagen
                );
                $("#id_producto").val(producto.id);
                $("#codigoedit").val(producto.cod_producto);
                $("#nombreedit").val(producto.nombre);
                $("#categoriaedit").val(producto.categoria).change();
                $("#subcategoriaedit").val(producto.sub_categoria);
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

    function makecode(length) {
        var result = "";
        var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(
                Math.floor(Math.random() * charactersLength)
            );
        }
        return result;
    }

    $("#categoriaadd").change(function () {
        var subcategorias = $(this).find(":selected").data("options");

        $("#subcategoriaadd").empty();

        if (!subcategorias) {
            $("#subcategoriaadd").append(
                $("<option></option>")
                    .attr("value", "")
                    .text("Seleccione una subcategoría")
            );
        } else {
            $.each(subcategorias, function (key, value) {
                $("#subcategoriaadd").append(
                    $("<option></option>")
                        .attr("value", value.id)
                        .text(value.nombre)
                );
            });
        }
    });

    $("#categoriaedit").change(function () {
        var subcategorias = $(this).find(":selected").data("options");

        $("#subcategoriaedit").empty();

        if (!subcategorias) {
            $("#subcategoriaedit").append(
                $("<option></option>")
                    .attr("value", "")
                    .text("Seleccione una subcategoría")
            );
        } else {
            $.each(subcategorias, function (key, value) {
                $("#subcategoriaedit").append(
                    $("<option></option>")
                        .attr("value", value.id)
                        .text(value.nombre)
                );
            });
        }
    });
});
