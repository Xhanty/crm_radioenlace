$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    let productos = JSON.parse(localStorage.getItem("productos"));

    let concat_add = '<div class="row row-sm border-top-color mt-3"><div class="col-11">' +
        '<div class="d-flex">' +
        '<div class="col-6" style="padding-left: 0;">' +
        '<select title="Producto" class="form-select producto_add">' +
        '<option value="">Seleccione una opción</option>' +
        productos.map((producto) => {
            return `<option value="${producto.id}">${producto.nombre} (${producto.marca} - ${producto.modelo})</option>`;
        }) +
        '</select>' +
        '</div>' +
        '<div class="col-6">' +
        '<input title="Cantidad" class="form-control cantidad_add" type="number" min="1"' +
        'step="1" placeholder="Cantidad">' +
        '</div>' +
        '</div>' +
        '<div class="col-12" style="padding-left: 0;">' +
        '<textarea title="Descripción" class="form-control mt-2 descripcion_add" placeholder="Descripción" rows="3"' +
        'style="height: 70px; resize: none"></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="col-1 d-flex">' +
        '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        '</a>' +
        '</div></div>';

    let concat_edit = '<div class="row row-sm border-top-color mt-3"><div class="col-11">' +
        '<div class="d-flex">' +
        '<div class="col-6" style="padding-left: 0;">' +
        '<select title="Producto" class="form-select producto_edit">' +
        '<option value="">Seleccione una opción</option>' +
        productos.map((producto) => {
            return `<option value="${producto.id}">${producto.nombre} (${producto.marca} - ${producto.modelo})</option>`;
        }) +
        '</select>' +
        '</div>' +
        '<div class="col-6">' +
        '<input title="Cantidad" class="form-control cantidad_edit" type="number" min="1"' +
        'step="1" placeholder="Cantidad">' +
        '</div>' +
        '</div>' +
        '<div class="col-12" style="padding-left: 0;">' +
        '<textarea title="Descripción" class="form-control mt-2 descripcion_edit" placeholder="Descripción" rows="3"' +
        'style="height: 70px; resize: none"></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="col-1 d-flex">' +
        '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        '</a>' +
        '</div></div>';

    let concat_email =
        '<div class="row row-sm mt-2">' +
        '<div class="col-lg" style="display: flex">' +
        '<input class="form-control emailadd" placeholder="Email" type="email">' +
        '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    $("#new_row_producto").click(function () {
        $("#div_list_productos").append(concat_add);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $(document).on("click", "#new_row_producto_edit", function () {
        $("#div_list_productos_edit").append(concat_edit);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $("#new_row_email").click(function () {
        $("#div_list_email").append(concat_email);
    });

    $(document).on("click", ".delete_row", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".btnDelete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Está seguro?",
            text: "¡No podrá revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, eliminar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "remisiones_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Registro eliminado");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("No se pudo eliminar el registro");
                        }
                    },
                    error: function (response) {
                        toastr.error("No se pudo eliminar el registro");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnView", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "remisiones_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                $("#global-loader").fadeOut("fast");

                if (response.info == 1) {
                    let data = response.remision;
                    $("#cliente_view").val(data.cliente_id).trigger("change");
                    $("#asunto_view").val(data.asunto);
                    $("#descripcion_view").val(data.observacion);

                    let data_productos = response.productos;
                    let html = "";

                    data_productos.map((value) => {
                        html +=
                            `<div class="row row-sm border-top-color mt-3"><div class="col-12">
                            <div class="d-flex">
                            <div class="col-6" style="padding-left: 0;">
                            <select data-value="${value.producto_id}" title="Producto" class="form-select producto_view" disabled>
                            <option value="">Seleccione una opción</option>` +
                            productos.map((producto) => {
                                return `<option value="${producto.id}">${producto.nombre} (${producto.marca} - ${producto.modelo})</option>`;
                            }) +
                            `</select>
                            </div>
                            <div class="col-6">
                            <input title="Cantidad" value="${value.cantidad}" class="form-control" disabled type="number" min="1"
                            step="1" placeholder="Cantidad">
                            </div>
                            </div>
                            <div class="col-12" style="padding-left: 0;">
                            <textarea title="Descripción" class="form-control mt-2" disabled placeholder="Descripción" rows="3"
                            style="height: 70px; resize: none">${value.descripcion ? value.descripcion : ""}</textarea>
                            </div>
                            </div>
                            </div>`;
                    });

                    $("#div_list_productos_view").html(html);

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                        });
                    });

                    $(".producto_view").each(function () {
                        let value = $(this).data("value");

                        if (value) {
                            $(this).val(value).trigger("change");
                        }
                    });


                    $("#modalView").modal("show");
                } else {
                    toastr.error("No se pudo obtener la información");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("No se pudo obtener la información");
            },
        });
    });

    $(document).on("click", ".btnFirma", function () {
        let id = $(this).data("id");

        $("#id_remision_firma").val(id);
        $("#modalFirma").modal("show");
    });

    $(document).on("click", ".btnEdit", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "remisiones_data",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                $("#global-loader").fadeOut("fast");

                if (response.info == 1) {
                    let data = response.remision;
                    $("#id_remision_edit").val(data.id);
                    $("#cliente_edit").val(data.cliente_id).trigger("change");
                    $("#asunto_edit").val(data.asunto);
                    $("#descripcion_edit").val(data.observacion);

                    let data_productos = response.productos;
                    let html = "";
                    let count = 0;

                    data_productos.map((value) => {
                        let button = '<a class="center-vertical mg-s-10" id="new_row_producto_edit" href="javascript:void(0)"><i class="fa fa-plus"></i></a>';
                        if (count > 0) {
                            button = '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                        }
                        html +=
                            `<div class="row row-sm border-top-color mt-3"><div class="col-11">
                            <div class="d-flex">
                            <div class="col-6" style="padding-left: 0;">
                            <select data-value="${value.producto_id}" title="Producto" class="form-select producto_edit">
                            <option value="">Seleccione una opción</option>` +
                            productos.map((producto) => {
                                return `<option value="${producto.id}">${producto.nombre} (${producto.marca} - ${producto.modelo})</option>`;
                            }) +
                            `</select>
                            </div>
                            <div class="col-6">
                            <input title="Cantidad" value="${value.cantidad}" class="form-control cantidad_edit" type="number" min="1" step="1" placeholder="Cantidad">
                            </div>
                            </div>
                            <div class="col-12" style="padding-left: 0;">
                            <textarea title="Descripción" class="form-control mt-2 descripcion_edit" placeholder="Descripción" rows="3"
                            style="height: 70px; resize: none">${value.descripcion ? value.descripcion : ""}</textarea>
                            </div>
                            </div>
                            <div class="col-1 d-flex">
                            ${button}
                            </div>
                            </div>`;
                        count++;
                    });

                    $("#div_list_productos_edit").html(html);

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
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
                    toastr.error("No se pudo obtener la información");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("No se pudo obtener la información");
            },
        });
    });

    $(document).on("click", ".btnCompletar", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Está seguro?",
            text: "Se completará la remisión",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, completar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#global-loader").fadeIn("fast");
                $.ajax({
                    url: "remisiones_completar",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        $("#global-loader").fadeOut("fast");

                        if (response.info == 1) {
                            toastr.success("Remisión completada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("No se pudo completar la remisión");
                        }
                    },
                    error: function (response) {
                        $("#global-loader").fadeOut("fast");
                        toastr.error("No se pudo completar la remisión");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEmail", function () {
        let id = $(this).data("id");
        $("#id_remision_email").val(id);
        $("#modalEmail").modal("show");
    });

    $("#btnGuardar").click(function () {
        let cliente = $("#cliente_add").val();
        let asunto = $("#asunto_add").val();
        let nota = $("#descripcion_add").val();
        let productos = [];
        let valid = 0;

        $(".producto_add").each(function () {
            let producto = $(this).val();
            let cantidad = $(this).closest(".row").find(".cantidad_add").val();
            let descripcion = $(this).closest(".row").find(".descripcion_add").val();

            if (producto != "" && cantidad < 1) {
                valid = 1;
            }

            if (producto != "" && cantidad > 0) {
                productos.push({
                    producto_id: producto,
                    cantidad: cantidad,
                    descripcion: descripcion,
                });
            }
        });

        if (cliente == "") {
            toastr.error("Debe seleccionar un cliente");
        } else if (asunto.trim().length == 0) {
            toastr.error("Debe ingresar un asunto");
        } else if (valid == 1) {
            toastr.error("Debe ingresar los datos de los productos");
        } else {
            $("#btnGuardar").attr("disabled", true);
            $("#btnGuardar").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "remisiones_add",
                type: "POST",
                data: {
                    cliente_id: cliente,
                    asunto: asunto,
                    nota: nota,
                    productos: productos,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al guardar la remisión");
                        $("#btnGuardar").attr("disabled", false);
                        $("#btnGuardar").html("Guardar");
                    }
                },
                error: function (error) {
                    toastr.error("Error al guardar la remisión");
                    $("#btnGuardar").attr("disabled", false);
                    $("#btnGuardar").html("Guardar");
                },
            });
        }
    });

    $("#btnUpdate").click(function () {
        let id = $("#id_remision_edit").val();
        let cliente = $("#cliente_edit").val();
        let asunto = $("#asunto_edit").val();
        let nota = $("#descripcion_edit").val();
        let productos = [];
        let valid = 0;

        $(".producto_edit").each(function () {
            let producto = $(this).val();
            let cantidad = $(this).closest(".row").find(".cantidad_edit").val();
            let descripcion = $(this).closest(".row").find(".descripcion_edit").val();

            if (producto != "" && cantidad < 1) {
                valid = 1;
            }

            if (producto != "" && cantidad > 0) {
                productos.push({
                    producto_id: producto,
                    cantidad: cantidad,
                    descripcion: descripcion,
                });
            }
        });

        if (cliente == "") {
            toastr.error("Debe seleccionar un cliente");
        } else if (asunto.trim().length == 0) {
            toastr.error("Debe ingresar un asunto");
        } else if (valid == 1) {
            toastr.error("Debe ingresar los datos de los productos");
        } else {
            $("#btnUpdate").attr("disabled", true);
            $("#btnUpdate").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "remisiones_edit",
                type: "POST",
                data: {
                    id: id,
                    cliente_id: cliente,
                    asunto: asunto,
                    observacion: nota,
                    productos: productos,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al modificar la remisión");
                        $("#btnUpdate").attr("disabled", false);
                        $("#btnUpdate").html("Guardar");
                    }
                },
                error: function (error) {
                    toastr.error("Error al modificar la remisión");
                    $("#btnUpdate").attr("disabled", false);
                    $("#btnUpdate").html("Guardar");
                },
            });
        }
    });

    $("#btn_save_email").click(function () {
        let id = $("#id_remision_email").val();
        let emails = [];
        let valid = 0;

        $(".emailadd").each(function () {
            let email = $(this).val();
            if (email && email.trim().length > 3) {
                emails.push(email);
            } else {
                valid = 1;
            }
        });

        if (valid == 1) {
            toastr.error("Debe ingresar un correo válido");
            return false;
        } else {
            $("#btn_save_email").attr("disabled", true);
            $("#btn_save_email").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'
            );
            $.ajax({
                type: "POST",
                url: "remisiones_email",
                data: { id: id, emails: emails },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Correo enviado correctamente");
                        $(".emailadd").val("");
                        $("#modalEmail").modal("hide");
                        $("#btn_save_email").attr("disabled", false);
                        $("#btn_save_email").html("Enviar Cotización");
                    } else {
                        toastr.error("Error al enviar el correo");
                        $("#btn_save_email").attr("disabled", false);
                        $("#btn_save_email").html("Enviar Cotización");
                    }
                },
                error: function (response) {
                    toastr.error("Error al enviar el correo");
                    $("#btn_save_email").attr("disabled", false);
                    $("#btn_save_email").html("Enviar Cotización");
                },
            });
        }
    });
});
