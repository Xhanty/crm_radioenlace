$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let concat =
        '<div class="row row-sm mt-2">' +
        '<div class="col-lg" style="display: flex">' +
        '<input class="form-control subcategoriaadd" placeholder="SubCategoría" type="text">' +
        '<a class="center-vertical mg-s-10 btn_delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    let concat_2 =
        '<div class="row row-sm mt-2">' +
        '<div class="col-lg" style="display: flex">' +
        '<input class="form-control subcategoriaedit" placeholder="SubCategoría" type="text">' +
        '<a class="center-vertical mg-s-10 btn_delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    $("#new_row_subcategoria").click(function () {
        $("#div_list_subs").append(concat);
    });

    $("#edit_row_subcategoria").click(function () {
        $("#div_list_subs_edit").append(concat_2);
    });

    $(document).on("click", ".btn_delete_row", function () {
        $(this).closest(".row").remove();
    });

    $("#btnGuardarCategoria").click(function () {
        let nombre = $("#categoriaadd").val();
        let subcategorias = [];

        $(".subcategoriaadd").each(function () {
            subcategorias.push($(this).val());
        });

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else if (subcategorias.length == 0) {
            toastr.error("Debes agregar al menos una subcategoría");
        } else if (subcategorias.includes("")) {
            toastr.error("No puedes dejar campos vacíos");
        } else {
            $("#btnGuardarCategoria").attr("disabled", true);
            $.ajax({
                url: "categorias_create",
                type: "POST",
                data: { nombre: nombre, subcategorias: subcategorias },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnGuardarCategoria").attr("disabled", false);
                        toastr.error("Error al guardar la categoría");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnGuardarCategoria").attr("disabled", false);
                    toastr.error("Error al guardar la categoría");
                },
            });
        }
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");
        let productos = $(this).data("productos");

        if (productos > 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "No puedes eliminar una categoría con productos",
            });
        } else {
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
                        url: "categorias_delete",
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
        }
    });

    $(document).on("click", ".btn_Edit", function () {
        let id = $(this).data("id");
        let nombre = $(this).data("nombre");

        $("#id_categoria_edit").val(id);
        $("#categoriaedit").val(nombre);

        $.ajax({
            url: "subcategorias_get",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;
                    let concat = "";

                    $("#subcategoriaedit_uno").val(data[0].nombre);

                    for (let i = 1; i < data.length; i++) {
                        concat +=
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg" style="display: flex">' +
                            '<input class="form-control" disabled placeholder="SubCategoría" type="text" value="' +
                            data[i].nombre +
                            '">' +
                            '<!--<a class="center-vertical mg-s-10 btn_delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>-->' +
                            "</div>" +
                            "</div>";
                    }

                    $("#div_list_subs_edit").html(concat);
                    $("#modalEdit").modal("show");
                } else {
                    toastr.error("Error al obtener las subcategorías");
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error("Error al obtener las subcategorías");
            },
        });
    });

    $(document).on("click", ".btn_View", function () {
        let id = $(this).data("id");
        let nombre = $(this).data("nombre");
        $("#categoriashow").val(nombre);

        $.ajax({
            url: "subcategorias_get",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;
                    let concat = "";

                    $(".subcategoriashow").val(data[0].nombre);

                    for (let i = 1; i < data.length; i++) {
                        concat +=
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg" style="display: flex">' +
                            '<input class="form-control subcategoriashow" disabled placeholder="SubCategoría" type="text" value="' +
                            data[i].nombre +
                            '">' +
                            '<!--<a class="center-vertical mg-s-10 btn_delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>-->' +
                            "</div>" +
                            "</div>";
                    }

                    $("#div_list_subs_show").html(concat);
                    $("#modalShow").modal("show");
                } else {
                    toastr.error("Error al obtener las subcategorías");
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error("Error al obtener las subcategorías");
            },
        });
    });

    $("#btnModificarCategoria").click(function () {
        let id = $("#id_categoria_edit").val();
        let nombre = $("#categoriaedit").val();
        let subcategorias = [];

        $(".subcategoriaedit").each(function () {
            subcategorias.push($(this).val());
        });

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else if (subcategorias.includes("")) {
            toastr.error("No puedes dejar campos vacíos");
        } else {

            $("#btnModificarCategoria").attr("disabled", true);
            $.ajax({
                url: "categorias_edit",
                type: "POST",
                data: { id: id, nombre: nombre, subcategorias: subcategorias },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnModificarCategoria").attr("disabled", false);
                        toastr.error("Error al modificar la categoría");
                    }
                },
                error: function (error) {
                    console.log(error);
                     $("#btnModificarCategoria").attr("disabled", false);
                    toastr.error("Error al modificar la categoría");
                },
            });
        }
    });
});
