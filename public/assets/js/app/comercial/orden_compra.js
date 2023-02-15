$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    var clientes = JSON.parse(localStorage.getItem("clientes"));
    var productos = JSON.parse(localStorage.getItem("productos"));
    var proveedores = JSON.parse(localStorage.getItem("proveedores"));

    let concat =
        '<div class="row row-sm mt-3 border-top-color">' +
        '<div class="col-6">' +
        '<select title="Producto" class="form-select producto_add">' +
        '<option value="">Seleccione un producto</option>' +
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
        "</select>" +
        '<input title="Cantidad" class="form-control mt-3 cantidad_add" type="number" min="1" step="1"' +
        'placeholder="Cantidad">' +
        '<input title="Precio" class="form-control mt-3 mb-3 precio_add" type="text"' +
        'placeholder="Precio">' +
        '<select title="Proveedor" class="form-select proveedor_add">' +
        '<option value="">Seleccione un proveedor</option>' +
        proveedores.map((proveedor) => {
            return (
                '<option value="' +
                proveedor.id +
                '">' +
                proveedor.razon_social +
                "</option>"
            );
        }) +
        "</select>" +
        "</div>" +
        '<div class="col-6">' +
        '<div class="d-flex">' +
        '<div class="col-lg">' +
        '<input title="IVA" class="form-control iva_add" type="number" placeholder="% IVA">' +
        '<div class="mt-3">' +
        '<input title="Retención" class="form-control mt-3 retencion_add" type="number" placeholder="% Retención">' +
        "</div>" +
        '<textarea title="Descripción" class="form-control mt-3 descripcion_add" placeholder="Descripción" rows="3"' +
        'style="height: 84px; resize: none"></textarea>' +
        "</div>" +
        '<div class="d-flex">' +
        '<a class="center-vertical mg-s-10 delete_row_producto" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>";

    let concat_edit =
        '<div class="row row-sm mt-3 border-top-color">' +
        '<div class="col-6">' +
        '<select title="Producto" class="form-select producto_edit">' +
        '<option value="">Seleccione un producto</option>' +
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
        "</select>" +
        '<input title="Cantidad" class="form-control mt-3 cantidad_edit" type="number" min="1" step="1"' +
        'placeholder="Cantidad">' +
        '<input title="Precio" class="form-control mt-3 mb-3 precio_edit" type="text"' +
        'placeholder="Precio">' +
        '<select title="Proveedor" class="form-select proveedor_edit">' +
        '<option value="">Seleccione un proveedor</option>' +
        proveedores.map((proveedor) => {
            return (
                '<option value="' +
                proveedor.id +
                '">' +
                proveedor.razon_social +
                "</option>"
            );
        }) +
        "</select>" +
        "</div>" +
        '<div class="col-6">' +
        '<div class="d-flex">' +
        '<div class="col-lg">' +
        '<input title="IVA" class="form-control iva_edit" type="number" placeholder="% IVA">' +
        '<div class="mt-3">' +
        '<input title="Retención" class="form-control mt-3 retencion_edit" type="number" placeholder="% Retención">' +
        "</div>" +
        '<textarea title="Descripción" class="form-control mt-3 descripcion_edit" placeholder="Descripción" rows="3"' +
        'style="height: 84px; resize: none"></textarea>' +
        "</div>" +
        '<div class="d-flex">' +
        '<a class="center-vertical mg-s-10 delete_edit_row_producto" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>";

    let concat_email =
        '<div class="row row-sm mt-2">' +
        '<div class="col-lg" style="display: flex">' +
        '<input class="form-control emailadd" placeholder="Email" type="email">' +
        '<a class="center-vertical mg-s-10 btn_delete_row_email" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    $("#new_row_producto").click(function () {
        $("#div_list_productos").append(concat);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $(document).on("click", "#new_edit_row_producto", function () {
        $("#div_list_productos_edit").append(concat_edit);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $(document).on("click", ".delete_row_producto", function () {
        $(this).closest(".row").remove();
    });

    $(document).on("click", ".delete_edit_row_producto", function () {
        $(this).closest(".row").remove();
    });

    $("#new_row_email").click(function () {
        $("#div_list_email").append(concat_email);
    });

    $(document).on("click", ".btn_delete_row_email", function () {
        $(this).closest(".row").remove();
    });

    $("#next").click(function () {
        let cliente = $("#cliente_add").val();

        if (cliente == null || cliente == "" || cliente == "*") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else {
            $("#div_informacion").addClass("d-none");
            $("#div_productos").removeClass("d-none");
            $("#finish").parent().removeClass("d-none");
            $("#previus").parent().removeClass("disabled");
            $("#title_productos").addClass("done");

            $(this).parent().addClass("d-none");
        }
    });

    $("#previus").click(function () {
        $("#div_informacion").removeClass("d-none");
        $("#div_productos").addClass("d-none");
        $("#finish").parent().addClass("d-none");
        $("#next").parent().removeClass("d-none");
        $("#title_productos").removeClass("done");

        $(this).parent().addClass("disabled");
    });

    $("#next_view").click(function () {
        $("#div_informacion_view").addClass("d-none");
        $("#div_productos_view").removeClass("d-none");
        $("#previus_view").parent().removeClass("disabled");
        $("#title_productos_view").addClass("done");

        $(this).parent().addClass("d-none");
    });

    $("#previus_view").click(function () {
        $("#div_informacion_view").removeClass("d-none");
        $("#div_productos_view").addClass("d-none");
        $("#next_view").parent().removeClass("d-none");
        $("#title_productos_view").removeClass("done");

        $(this).parent().addClass("disabled");
    });

    $("#next_edit").click(function () {
        let cliente = $("#cliente_edit").val();

        if (cliente == null || cliente == "" || cliente == "*") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else {
            $("#div_informacion_edit").addClass("d-none");
            $("#div_productos_edit").removeClass("d-none");
            $("#finish_edit").parent().removeClass("d-none");
            $("#previus_edit").parent().removeClass("disabled");
            $("#title_productos_edit").addClass("done");

            $(this).parent().addClass("d-none");
        }
    });

    $("#previus_edit").click(function () {
        $("#div_informacion_edit").removeClass("d-none");
        $("#div_productos_edit").addClass("d-none");
        $("#finish_edit").parent().addClass("d-none");
        $("#next_edit").parent().removeClass("d-none");
        $("#title_productos_edit").removeClass("done");

        $(this).parent().addClass("disabled");
    });

    $("#finish").click(function () {
        let cliente = $("#cliente_add").val();
        let descripcion_general = $("#descripcion_add").val();
        let valid_products = 0;
        let valid_proveedores = 0;
        let valid_cantidad = 0;

        // PRODUCTOS
        let productos = [];
        let cantidad = [];
        let precio = [];
        let proveedores = [];
        let iva = [];
        let retencion = [];
        let descripciones = [];

        $(".producto_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            productos.push($(this).val());
        });

        $(".cantidad_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() < 1
            ) {
                valid_cantidad++;
            }
            cantidad.push($(this).val());
        });

        $(".precio_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val().trim().length == 0
            ) {
                valid_products++;
            }
            precio.push($(this).val());
        });

        $(".proveedor_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_proveedores++;
            }
            proveedores.push($(this).val());
        });

        $(".iva_add").each(function () {
            iva.push($(this).val());
        });

        $(".retencion_add").each(function () {
            retencion.push($(this).val());
        });

        $(".descripcion_add").each(function () {
            descripciones.push($(this).val());
        });

        if (valid_products > 0) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } else if (valid_cantidad > 0) {
            toastr.error("La cantidad del producto debe ser mayor a 0");
            return false;
        } else if (valid_proveedores > 0) {
            toastr.error("Debe ingresar todos los datos de los proveedores");
            return false;
        } else {
            $("#modalAdd").modal("hide");
            $("#global-loader").fadeIn("fast");
            $.ajax({
                type: "POST",
                url: "orden_compra_create",
                data: {
                    cliente: cliente,
                    descripcion_general: descripcion_general,
                    productos: productos,
                    cantidades: cantidad,
                    precios: precio,
                    proveedores: proveedores,
                    ivas: iva,
                    retenciones: retencion,
                    descripciones: descripciones,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Orden de compra creada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#modalAdd").modal("show");
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al crear la orden de compra");
                    }
                },
                error: function (response) {
                    $("#modalAdd").modal("show");
                    $("#global-loader").fadeOut("fast");
                    toastr.error("Error al crear la orden de compra");
                },
            });
        }
    });

    $("#finish_edit").click(function () {
        let id = $("#id_orden_edit").val();
        let cliente = $("#cliente_edit").val();
        let descripcion_general = $("#descripcion_edit").val();
        let valid_products = 0;
        let valid_proveedores = 0;
        let valid_cantidad = 0;

        // PRODUCTOS
        let productos = [];
        let cantidad = [];
        let proveedores = [];
        let precio = [];
        let iva = [];
        let retencion = [];
        let descripciones = [];

        $(".producto_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            productos.push($(this).val());
        });

        $(".cantidad_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() < 1
            ) {
                valid_cantidad++;
            }
            cantidad.push($(this).val());
        });

        $(".precio_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val().trim().length == 0
            ) {
                valid_products++;
            }
            precio.push($(this).val());
        });

        $(".proveedor_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_proveedores++;
            }
            proveedores.push($(this).val());
        });

        $(".iva_edit").each(function () {
            iva.push($(this).val());
        });

        $(".retencion_edit").each(function () {
            retencion.push($(this).val());
        });

        $(".descripcion_edit").each(function () {
            descripciones.push($(this).val());
        });

        if (valid_products > 0) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } else if (valid_cantidad > 0) {
            toastr.error("La cantidad del producto debe ser mayor a 0");
            return false;
        } else if (valid_proveedores > 0) {
            toastr.error("Debe ingresar todos los datos de los proveedores");
            return false;
        } else {
            $("#modalEdit").modal("hide");
            $("#global-loader").fadeIn("fast");
            $.ajax({
                type: "POST",
                url: "orden_compra_edit",
                data: {
                    id: id,
                    cliente: cliente,
                    descripcion_general: descripcion_general,
                    productos: productos,
                    cantidades: cantidad,
                    precios: precio,
                    proveedores: proveedores,
                    ivas: iva,
                    retenciones: retencion,
                    descripciones: descripciones,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Orden de compra editada con éxito");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#modalEdit").modal("show");
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al editar la orden de compra");
                    }
                },
                error: function (response) {
                    $("#modalEdit").modal("show");
                    $("#global-loader").fadeOut("fast");
                    toastr.error("Error al editar la orden de compra");
                },
            });
        }
    });

    $(document).on("click", ".btnView", function () {
        let id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            type: "POST",
            url: "orden_compra_data",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.orden;
                let productos = data.detalle;

                if (response.info == 1) {
                    $("#cliente_view").val(data.cliente_id).trigger("change");
                    $("#descripcion_view").val(data.descripcion);

                    if (productos.length > 0) {
                        let html = "";
                        for (let i = 0; i < productos.length; i++) {
                            let spacing = "";

                            if (i > 0) {
                                spacing = "mt-3";
                            }

                            html += `<div class="row row-sm ${spacing}">
                                        <div class="col-6">
                                            <select title="Producto" class="form-select" disabled>
                                                <option value="1">${productos[i].producto} (${productos[i].modelo})</option>
                                            </select>
                                            <input title="Cantidad" class="form-control mt-3" value="${productos[i].cantidad}" disabled type="number" min="1"
                                                step="1" placeholder="Cantidad">
                                            <input title="Precio" class="form-control mt-3 mb-3" value="${productos[i].precio}" disabled type="text" placeholder="Precio">
                                            <select title="Proveedor" class="form-select" disabled>
                                                <option value="1">${productos[i].name_proveedor}</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="col-lg">
                                                    <input title="IVA" class="form-control" value="${productos[i].iva}" disabled type="text" placeholder="% IVA">
                                                    <div class="mt-3">
                                                        <input title="Retención" class="form-control mt-3" value="${productos[i].retencion}" disabled type="text" placeholder="% Retención">
                                                    </div>
                                                    <textarea title="Descripción" disabled class="form-control mt-3" placeholder="Descripción" rows="3" style="height: 84px; resize: none">${productos[i].descripcion ? productos[i].descripcion : ''}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        }
                        $("#div_list_productos_view").html(html);

                        $(".form-select").each(function () {
                            $(this).select2({
                                dropdownParent: $(this).parent(),
                                placeholder: "Seleccione una opción",
                                searchInputPlaceholder: "Buscar",
                            });
                        });
                    }

                    $("#modalView").modal("show");
                } else {
                    toastr.error("Error al cargar la cotización");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar la cotización");
            },
        });
    });

    $(document).on("click", ".btnEdit", function () {
        let id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            type: "POST",
            url: "orden_compra_data",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.orden;
                let productos_data = data.detalle;

                if (response.info == 1) {
                    $("#id_orden_edit").val(data.id);
                    $("#cliente_edit").val(data.cliente_id).trigger("change");
                    $("#descripcion_edit").val(data.descripcion);

                    if (productos_data.length > 0) {
                        let html = "";
                        for (let i = 0; i < productos_data.length; i++) {
                            let button = '<div class="d-flex">' +
                                '<a class="center-vertical mg-s-10" href="javascript:void(0)" id="new_edit_row_producto">' +
                                '<i class="fa fa-plus"></i>' +
                                '</a>' +
                                '</div>';
                            let spacing = "";

                            if (i > 0) {
                                spacing = "mt-3";
                                button = '<div class="d-flex">' +
                                    '<a class="center-vertical mg-s-10 delete_edit_row_producto" href="javascript:void(0)">' +
                                    '<i class="fa fa-trash"></i>' +
                                    '</a>' +
                                    '</div>';
                            }

                            html += `<div class="row row-sm ${spacing} border-top-color">
                                        <div class="col-6">
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
                                            <input title="Cantidad" class="form-control mt-3 cantidad_edit" value="${productos_data[i].cantidad}" type="number" min="1"
                                                step="1" placeholder="Cantidad">
                                            <input title="Precio" class="form-control mt-3 mb-3 precio_edit" value="${productos_data[i].precio}" type="text" placeholder="Precio">
                                            <select data-value="${productos_data[i].proveedor}" title="Proveedor" class="form-select proveedor_edit">
                                            <option value="">Seleccione un proveedor</option>` +
                                proveedores.map((proveedor) => {
                                                return (
                                                    '<option value="' +
                                                    proveedor.id +
                                                    '">' +
                                                    proveedor.razon_social +
                                                    "</option>"
                                                );
                                            }) +
                                            `</select>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="col-lg">
                                                    <input title="IVA" class="form-control iva_edit" value="${productos_data[i].iva}" type="number" placeholder="% IVA">
                                                    <div class="mt-3">
                                                        <input title="Retención" class="form-control retencion_edit" value="${productos_data[i].retencion}" type="number" placeholder="% Retención">
                                                    </div>
                                                    <textarea title="Descripción" class="form-control mt-3 descripcion_edit" placeholder="Descripción" rows="3" style="height: 84px; resize: none">${productos_data[i].descripcion ? productos_data[i].descripcion : ''}</textarea>
                                                </div>
                                                ${button}
                                            </div>
                                        </div>
                                    </div>`;
                        }
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

                        $(".proveedor_edit").each(function () {
                            let value = $(this).data("value");

                            if (value) {
                                $(this).val(value).trigger("change");
                            }
                        });

                        $(".divisa_edit").each(function () {
                            let value = $(this).data("value");
                            if (value) {
                                $(this).val(value).trigger("change");
                            }
                        });

                        $(".tipo_edit").each(function () {
                            let value = $(this).data("value");
                            if (value) {
                                $(this).val(value).trigger("change");
                            }
                        });
                    }

                    $("#modalEdit").modal("show");
                } else {
                    toastr.error("Error al cargar la cotización");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar la cotización");
            },
        });
    });

    $(document).on("click", ".btnCompletar", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Está seguro de completar la orden de compra?",
            text: "No podrá revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, completar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "orden_compra_completar",
                    data: { id: id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(
                                "Orden de compra completada correctamente"
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al completar la orden de compra");
                        }
                    },
                    error: function (response) {
                        toastr.error("Error al completar la orden de compra");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEliminar", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Está seguro de eliminar la orden de compra?",
            text: "No podrá revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "orden_compra_delete",
                    data: { id: id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(
                                "Orden de compra eliminada correctamente"
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar la orden de compra");
                        }
                    },
                    error: function (response) {
                        toastr.error("Error al eliminar la orden de compra");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEmail", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("fast");
        $.ajax({
            type: "POST",
            url: "orden_compra_data_proveedores",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.data;

                if (response.info == 1) {
                    $("#id_orden_email").val(id);
                    $("#proveedor_email").empty();
                    data.forEach((item) => {
                        $("#proveedor_email").append(
                            `<option value="${item.id}">${item.razon_social}</option>`
                        );
                    });

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                        });
                    });

                    $("#modalEmail").modal("show");
                } else {
                    toastr.error("Error al cargar los proveedores");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar los proveedores");
            },
        });
    });

    $(document).on("click", ".btnPrint", function () {
        let id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            type: "POST",
            url: "orden_compra_data_proveedores",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.data;

                if (response.info == 1) {
                    $("#id_orden_open").val(id);
                    $("#proveedor_view").empty();
                    data.forEach((item) => {
                        $("#proveedor_view").append(
                            `<option value="${item.id}">${item.razon_social}</option>`
                        );
                    });

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                        });
                    });

                    $("#modalOpen").modal("show");
                } else {
                    toastr.error("Error al cargar los proveedores");
                }
            },
            error: function (response) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar los proveedores");
            },
        });
    });

    $("#btn_save_email").click(function () {
        let id = $("#id_orden_email").val();
        let proveeedor = $("#proveedor_email").val();
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

        if (proveeedor == "" || proveeedor == null) {
            toastr.error("Debe seleccionar un proveedor");
            return false;
        } else if (valid == 1) {
            toastr.error("Debe ingresar un correo válido");
            return false;
        } else {
            $("#btn_save_email").attr("disabled", true);
            $.ajax({
                type: "POST",
                url: "orden_compra_email",
                data: { id: id, emails: emails, proveedor: proveeedor },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Correo enviado correctamente");
                        $(".emailadd").val("");
                        $("#modalEmail").modal("hide");
                        $("#btn_save_email").attr("disabled", false);
                    } else {
                        toastr.error("Error al enviar el correo");
                        $("#btn_save_email").attr("disabled", false);
                    }
                },
                error: function (response) {
                    toastr.error("Error al enviar el correo");
                    $("#btn_save_email").attr("disabled", false);
                },
            });
        }
    });

    $("#btn_open_pdf").click(function () {
        let id = $("#id_orden_open").val();
        let proveedor = $("#proveedor_view").val();

        if (proveedor == "") {
            toastr.error("Debe seleccionar un proveedor");
            return false;
        } else {
            window.open(
                `ordenes_print?token=${id}&recibed=${proveedor}`,
                "_blank"
            );
        }
    });

    $(document).on("change", ".aprobado_select", function () {
        let id = $(this).data("id");
        let val = $(this).val();

        $.ajax({
            type: "POST",
            url: "orden_compra_aprobado",
            data: { id: id, aprobado: val },
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Cambio realizado correctamente");
                } else {
                    toastr.error("Error al realizar el cambio");
                }
            },
            error: function (response) {
                toastr.error("Error al realizar el cambio");
            }
        });
    });
});
