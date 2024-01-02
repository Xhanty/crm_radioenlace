$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var productos = JSON.parse(localStorage.getItem("productos"));

    let concat = '<div class="row row-sm mt-2">' +
        '<div class="col-5" >' +
        '<select class="form-select producto_add">' +
        '<option value="">Seleccione un producto</option>' +
        productos.map(function (producto) {
            return '<option value="' + producto.id + '">' + producto.nombre + ' (' + producto.modelo + ')</option>';
        }).join('') +
        '</select>' +
        '</div>' +
        '<div class="col-2">' +
        '<input type="number" class="form-control cantidad_add" min="1" step="1" placeholder="Cantidad" >' +
        '</div>' +
        '<div class="col-4">' +
        '<input type="text" class="form-control nota_add" placeholder="Nota (Opcional)" >' +
        '</div>' +
        '<div class="center-vertical col-1">' +
        '<a class="btn_delete_row" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i></a>' +
        '</div>' +
        '</div >';

    let concat_edit = '<div class="row row-sm mt-2">' +
        '<div class="col-5" >' +
        '<select class="form-select producto_edit">' +
        '<option value="">Seleccione un producto</option>' +
        productos.map(function (producto) {
            return '<option value="' + producto.id + '">' + producto.nombre + ' (' + producto.modelo + ')</option>';
        }).join('') +
        '</select>' +
        '</div>' +
        '<div class="col-2">' +
        '<input type="number" class="form-control cantidad_edit" min="1" step="1" placeholder="Cantidad" >' +
        '</div>' +
        '<div class="col-4">' +
        '<input type="text" class="form-control nota_edit" placeholder="Nota (Opcional)" >' +
        '</div>' +
        '<div class="center-vertical col-1">' +
        '<a class="btn_delete_row" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i></a>' +
        '</div>' +
        '</div >';

    let concat_email =
        '<div class="row row-sm mt-2">' +
        '<div class="col-lg" style="display: flex">' +
        '<input class="form-control emailadd" placeholder="Email" type="email">' +
        '<a class="center-vertical mg-s-10 btn_delete_row_email" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    $("#new_row_email").click(function () {
        $("#div_list_email").append(concat_email);
    });

    $(document).on("click", "#new_edit_row_producto", function () {
        $("#div_list_productos_edit").append(concat_edit);
        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".btn_delete_row_email", function () {
        $(this).closest(".row").remove();
    });

    $("#new_row_producto").click(function () {
        $("#div_list_productos_add").append(concat);
        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });
    });

    $(document).on("click", ".btn_delete_row", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".btnDelete", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "precios_proveedores_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (data.info == 1) {
                            toastr.success("Eliminado con éxito");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el registro.");
                        }
                    },
                    error: function (data) {
                        toastr.error("Error al eliminar el registro.");
                    }
                });
            }
        });
    });

    $(document).on("click", ".btnEmail", function () {
        let id = $(this).attr("data-id");
        $("#id_precio_email").val(id);
        $("#modalEmail").modal("show");
    });

    $(document).on("click", ".btnView", function () {
        let id = $(this).attr("data-id");
        $("#global-loader").fadeIn("slow");
        $.ajax({
            url: "precios_proveedores_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                let data = response.data;
                let productos = response.productos;
                $("#global-loader").fadeOut("slow");
                if (response.info == 1) {
                    $("#proveedor_view").val(data.proveedor_id).trigger("change");
                    $("#moneda_view").val(data.moneda).trigger("change");
                    $("#fecha_view").val(data.fecha_limite);
                    $("#div_list_productos_view").html("");
                    productos.forEach(function (producto) {
                        producto.nota = producto.nota == null ? "" : producto.nota;
                        let concat = '<div class="row row-sm mt-2">' +
                            '<div class="col-5" >' +
                            '<input type="text" class="form-control" value="' + producto.nombre + ' (' + producto.modelo + ')" placeholder="Producto" readonly>' +
                            '</div>' +
                            '<div class="col-3">' +
                            '<input type="number" class="form-control" value="' + producto.cantidad_requerida + '" placeholder="Cantidad" readonly>' +
                            '</div>' +
                            '<div class="col-4">' +
                            '<input type="text" class="form-control" value="' + producto.nota + '" placeholder="Nota (Opcional)" readonly>' +
                            '</div>' +
                            '</div >';
                        $("#div_list_productos_view").append(concat);
                    });
                    $("#modalView").modal("show");
                } else {
                    $("#global-loader").fadeOut("slow");
                    toastr.error("Error al obtener los datos.");
                }
            },
            error: function (data) {
                $("#global-loader").fadeOut("slow");
                toastr.error("Error al obtener los datos.");
            }
        });
    });

    $(document).on("click", ".btnEdit", function () {
        let id = $(this).attr("data-id");
        $("#global-loader").fadeIn("slow");
        $.ajax({
            url: "precios_proveedores_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                let data = response.data;
                let productos_data = response.productos;
                $("#global-loader").fadeOut("slow");
                if (response.info == 1) {
                    $("#id_solicitud_edit").val(data.id);
                    $("#proveedor_edit").val(data.proveedor_id).trigger("change");
                    $("#moneda_edit").val(data.moneda).trigger("change");
                    $("#fecha_edit").val(data.fecha_limite);
                    $("#div_list_productos_edit").html("");
                    let html = "";
                    for (let i = 0; i < productos_data.length; i++) {
                        productos_data[i].nota = productos_data[i].nota == null ? "" : productos_data[i].nota;
                        let button = '<div class="center-vertical col-1">' +
                            '<a href="javascript:void(0)" id="new_edit_row_producto"> <i class="fa fa-plus"></i></a>' +
                            '</div>';

                        let spacing = "";

                        if (i > 0) {
                            spacing = "mt-3";
                            button = '<div class="center-vertical col-1">' +
                                '<a href="javascript:void(0)" class="btn_delete_row"> <i class="fa fa-trash"></i></a>' +
                                '</div>';
                        }

                        html += `<div class="row row-sm ${spacing}">
                                        <div class="col-5">
                                            <select data-value="${productos_data[i].producto_id}" title="Producto" class="form-select producto_edit">
                                            <option value="">Seleccione un producto</option>` +
                            productos.map((producto) => {
                                return (
                                    '<option value="' +
                                    producto.id +
                                    '">' +
                                    producto.nombre +
                                    ' (' + producto.marca + ' - ' + producto.modelo + ')' +
                                    "</option>"
                                );
                            }) +
                            `</select>
                                        </div>
                                        <div class="col-2">
                                            <input type="number" class="form-control cantidad_edit" value="${productos_data[i].cantidad_requerida}" placeholder="Cantidad">
                                        </div>
                                        <div class="col-4">
                                            <input type="text" class="form-control nota_edit" value="${productos_data[i].nota}" placeholder="Nota (Opcional)">
                                        </div>
                                        ${button}
                                    </div>
                            `;
                    }
                    $("#div_list_productos_edit").append(html);

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                            allowClear: true,
                        });
                    });

                    $(".producto_edit").each(function () {
                        let value = $(this).data("value");

                        if (value) {
                            $(this).val(value).trigger("change");
                        }
                    });

                    $("#modalEdit").modal("show");
                } else {
                    $("#global-loader").fadeOut("slow");
                    toastr.error("Error al obtener los datos.");
                }
            },
            error: function (data) {
                $("#global-loader").fadeOut("slow");
                toastr.error("Error al obtener los datos.");
            }
        });
    });

    $("#btnGuardar").click(function () {
        let proveedor = $("#proveedor_add").val();
        let moneda = $("#moneda_add").val();
        let fecha = $("#fecha_add").val();
        let productos = [];
        let cantidades = [];
        let notas = [];
        let val = 0;
        $(".producto_add").each(function () {
            if ($(this).val() == "") {
                val++;
            }
            productos.push($(this).val());
        });

        $(".cantidad_add").each(function () {
            if ($(this).val() == "") {
                val++;
            }
            cantidades.push($(this).val());
        });

        $(".nota_add").each(function () {
            notas.push($(this).val());
        });

        if (proveedor == "") {
            toastr.error("Debe seleccionar un proveedor");
        } else if (moneda == "") {
            toastr.error("Debe seleccionar una moneda");
        } else if (fecha == "") {
            toastr.error("Debe seleccionar una fecha límite");
        } else if (val > 0) {
            toastr.error("Debe completar todos los campos de los productos");
        } else {
            $("#btnGuardar").attr("disabled", true);
            $("#btnGuardar").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "precios_proveedores_add",
                type: "POST",
                data: {
                    proveedor: proveedor,
                    moneda: moneda,
                    fecha: fecha,
                    productos: productos,
                    cantidades: cantidades,
                    notas: notas,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Guardado con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al guardar");
                        $("#btnGuardar").attr("disabled", false);
                        $("#btnGuardar").html("Guardar");
                    }
                },
                error: function (data) {
                    toastr.error("Error al guardar");
                    $("#btnGuardar").attr("disabled", false);
                    $("#btnGuardar").html("Guardar");
                }
            });
        }
    });

    $("#btnUpdate").click(function () {
        let id = $("#id_solicitud_edit").val();
        let proveedor = $("#proveedor_edit").val();
        let moneda = $("#moneda_edit").val();
        let fecha = $("#fecha_edit").val();
        let productos = [];
        let cantidades = [];
        let notas = [];
        let val = 0;

        $(".producto_edit").each(function () {
            if ($(this).val() == "") {
                val++;
            }
            productos.push($(this).val());
        });

        $(".cantidad_edit").each(function () {
            if ($(this).val() == "") {
                val++;
            }
            cantidades.push($(this).val());
        });

        $(".nota_edit").each(function () {
            notas.push($(this).val());
        });

        if (proveedor == "") {
            toastr.error("Debe seleccionar un proveedor");
        } else if (moneda == "") {
            toastr.error("Debe seleccionar una moneda");
        } else if (fecha == "") {
            toastr.error("Debe seleccionar una fecha límite");
        } else if (val > 0) {
            toastr.error("Debe completar todos los campos de los productos");
        } else {
            $("#btnUpdate").attr("disabled", true);
            $("#btnUpdate").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "precios_proveedores_edit",
                type: "POST",
                data: {
                    id: id,
                    proveedor: proveedor,
                    moneda: moneda,
                    fecha: fecha,
                    productos: productos,
                    cantidades: cantidades,
                    notas: notas,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Guardado con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al guardar");
                        $("#btnUpdate").attr("disabled", false);
                        $("#btnUpdate").html("Modificar");
                    }
                },
                error: function (data) {
                    toastr.error("Error al guardar");
                    $("#btnUpdate").attr("disabled", false);
                    $("#btnUpdate").html("Modificar");
                }
            });
        }

    });
    $("#btnSendEmail").click(function () {
        let id = $("#id_precio_email").val();
        let emails = [];
        let val = 0;
        $(".emailadd").each(function () {
            if ($(this).val() == "") {
                val++;
            }
            emails.push($(this).val());
        });

        if (val > 0) {
            toastr.error("Debe ingresar los emails");
        } else {
            $("#btnSendEmail").attr("disabled", true);
            $("#btnSendEmail").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'
            );
            $.ajax({
                url: "precios_proveedores_send_email",
                type: "POST",
                data: {
                    id: id,
                    emails: emails,
                },
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Enviado con éxito");
                        $("#modalEmail").modal("hide");
                        $("#btnSendEmail").attr("disabled", false);
                        $("#btnSendEmail").html("Enviar");
                        $(".emailadd").each(function () {
                            $(this).val("");
                        });
                    } else {
                        toastr.error("Error al enviar");
                        $("#btnSendEmail").attr("disabled", false);
                        $("#btnSendEmail").html("Enviar");
                    }
                },
                error: function (data) {
                    toastr.error("Error al enviar");
                    $("#btnSendEmail").attr("disabled", false);
                    $("#btnSendEmail").html("Enviar");
                }
            });
        }
    });
});
