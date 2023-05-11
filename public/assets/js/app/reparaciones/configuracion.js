$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    $(document).on("click", ".btnDeleteCategoria", function (e) {
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
                    url: "categorias_reparaciones_delete",
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
                url: "categorias_reparaciones_add",
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

    $(document).on("click", ".btnDeleteAccesorio", function (e) {
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
                    url: "accesorios_reparaciones_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Accesorio eliminado correctamente");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ha ocurrido un error al eliminar el accesorio");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ha ocurrido un error al eliminar el accesorio");
                        console.log(error);
                    },
                });
            }
        });
    });

    $("#btnGuardarAccesorio").click(function (e) {
        e.preventDefault();
        var nombre = $("#accesorioadd").val();

        if (nombre == "") {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnGuardarAccesorio").attr("disabled", true);
            $("#btnGuardarAccesorio").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "accesorios_reparaciones_add",
                type: "POST",
                data: {
                    nombre: nombre,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Accesorio creado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Ha ocurrido un error al crear el accesorio");
                        $("#btnGuardarAccesorio").attr("disabled", false);
                        $("#btnGuardarAccesorio").html("Guardar");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al crear el accesorio");
                    $("#btnGuardarAccesorio").attr("disabled", false);
                    $("#btnGuardarAccesorio").html("Guardar");
                    console.log(error);
                },
            });
        }
    });
});
