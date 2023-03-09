$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var clientes = JSON.parse(localStorage.getItem("clientes"));
    var productos = JSON.parse(localStorage.getItem("productos"));

    let concat =
        '<div data-order="0" class="row row-sm mt-3 border-top-color">' +
        '<div class="col-1" style="justify-content: center; display: flex;">' +
        '<div class="d-flex">' +
        '<a class="center-vertical subir_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-up"></i>' +
        '</a>&nbsp;&nbsp;' +
        '<a class="center-vertical bajar_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-down"></i>' +
        '</a>' +
        '</div>' +
        '</div>' +
        '<div class="col-5">' +
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
        '<div class="d-flex">' +
        '<input title="Cantidad" class="form-control mt-3 cantidad_add" type="number" min="1" step="1"' +
        'placeholder="Cantidad">' +
        '<input title="Precio" style="margin-left: 20px;" class="form-control mt-3 precio_add" type="text"' +
        'placeholder="Precio">' +
        "</div>" +
        '<div class="d-flex">' +
        '<input title="Iva" class="form-control mt-3 iva_add" type="text" placeholder="Iva (%)"' +
        'placeholder="Cantidad">' +
        '<input title="Retención" style="margin-left: 20px;" class="form-control mt-3 retencion_add" type="text"' +
        'placeholder="Retención (%)">' +
        "</div>" +
        '<input type="checkbox" class="mt-3 tipo_pago_add" data-value="0"> Pago Único' +
        '<input type="checkbox" style="margin-left: 50px;" class="mt-3 tipo_pago_add" data-value="1"> Pago Mensual' +
        '<input type="checkbox" style="margin-left: 50px;" class="mt-3 imagen_grande_add" data-value="1"> Imagen Grande' +
        "</div>" +
        '<div class="col-6">' +
        '<div class="d-flex">' +
        '<div class="col-lg">' +
        '<select title="Tipo Divisa" class="form-select divisa_add">' +
        '<option value="">Seleccione un tipo de divisa' +
        "</option>" +
        '<option value="1">COP</option>' +
        '<option value="2">USD</option>' +
        "</select>" +
        '<div class="mt-3">' +
        '<select title="Tipo Transacción" class="form-select mt-2 tipo_add">' +
        '<option value="">Seleccione un tipo' +
        "</option>" +
        '<option value="1">Alquiler</option>' +
        '<option value="2">Transporte</option>' +
        '<option value="3">Venta</option>' +
        '<option value="4">Visita Tecnica</option>' +
        "</select>" +
        "</div>" +
        '<textarea title="Descripción" class="form-control mt-3 descripcion_add" placeholder="Descripción" rows="3"' +
        'style="height: 100px; resize: none"></textarea>' +
        "</div>" +
        '<div class="d-flex">' +
        '<a class="center-vertical mg-s-10 delete_row_producto" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>";

    let concat_title_add =
        '<div data-order="1" class="row row-sm mt-3 border-top-color" style="margin-bottom: 20px">' +
        '<div class="col-1" style="justify-content: center; display: flex;">' +
        '<div class="d-flex">' +
        '<a class="center-vertical subir_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-up"></i>' +
        "</a>&nbsp;&nbsp;" +
        '<a class="center-vertical bajar_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-down"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        '<div class="col-10">' +
        '<input type="text" class="form-control title_add" placeholder="Titulo">' +
        "</div>" +
        '<div class="col-1" style="justify-content: center; display: flex;">' +
        '<div class="d-flex">' +
        '<a class="center-vertical delete_row_producto" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>";

    let concat_title_edit =
        '<div data-order="1" class="row row-sm mt-3 border-top-color" style="margin-bottom: 20px">' +
        '<div class="col-1" style="justify-content: center; display: flex;">' +
        '<div class="d-flex">' +
        '<a class="center-vertical subir_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-up"></i>' +
        "</a>&nbsp;&nbsp;" +
        '<a class="center-vertical bajar_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-down"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        '<div class="col-10">' +
        '<input type="text" class="form-control title_edit" placeholder="Titulo">' +
        "</div>" +
        '<div class="col-1" style="justify-content: center; display: flex;">' +
        '<div class="d-flex">' +
        '<a class="center-vertical delete_row_producto" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>";

    let concat_edit =
        '<div data-order="0" class="row row-sm mt-3 border-top-color">' +
        '<div class="col-1" style="justify-content: center; display: flex;">' +
        '<div class="d-flex">' +
        '<a class="center-vertical subir_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-up"></i>' +
        '</a>&nbsp;&nbsp;' +
        '<a class="center-vertical bajar_div" href="javascript:void(0)">' +
        '<i class="fa fa-caret-down"></i>' +
        '</a>' +
        '</div>' +
        '</div>' +
        '<div class="col-5">' +
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
        '<div class="d-flex">' +
        '<input title="Cantidad" class="form-control mt-3 cantidad_edit" type="number" min="1" step="1"' +
        'placeholder="Cantidad">' +
        '<input title="Precio" style="margin-left: 20px;" class="form-control mt-3 precio_edit" type="text"' +
        'placeholder="Precio">' +
        "</div>" +
        '<div class="d-flex">' +
        '<input title="Iva" class="form-control mt-3 iva_edit" type="text" placeholder="Iva (%)"' +
        'placeholder="Cantidad">' +
        '<input title="Retención" style="margin-left: 20px;" class="form-control mt-3 retencion_edit" type="text"' +
        'placeholder="Retención (%)">' +
        "</div>" +
        '<input type="checkbox" class="mt-3 tipo_pago_edit" data-value="0"> Pago Único' +
        '<input type="checkbox" style="margin-left: 50px;" class="mt-3 tipo_pago_edit" data-value="1"> Pago Mensual' +
        '<input type="checkbox" style="margin-left: 50px;" class="mt-3 imagen_grande_edit" data-value="1"> Imagen Grande' +
        "</div>" +
        '<div class="col-6">' +
        '<div class="d-flex">' +
        '<div class="col-lg">' +
        '<select title="Tipo Divisa" class="form-select divisa_edit">' +
        '<option value="">Seleccione un tipo de divisa' +
        "</option>" +
        '<option value="1">COP</option>' +
        '<option value="2">USD</option>' +
        "</select>" +
        '<div class="mt-3">' +
        '<select title="Tipo Transacción" class="form-select mt-2 tipo_edit">' +
        '<option value="">Seleccione un tipo' +
        "</option>" +
        '<option value="1">Alquiler</option>' +
        '<option value="2">Transporte</option>' +
        '<option value="3">Venta</option>' +
        '<option value="4">Visita Tecnica</option>' +
        "</select>" +
        "</div>" +
        '<textarea title="Descripción" class="form-control mt-3 descripcion_edit" placeholder="Descripción" rows="3"' +
        'style="height: 100px; resize: none"></textarea>' +
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

    $(".open-toggle").trigger("click");

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

    $("#new_row_titulo").click(function () {
        $("#div_list_productos").append(concat_title_add);
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

    $(document).on("click", ".subir_div", function () {
        let row = $(this).closest(".row");
        let row_prev = row.prev();

        if (row_prev.length > 0) {
            row.insertBefore(row_prev);
        }
    });

    $(document).on("click", ".bajar_div", function () {
        let row = $(this).closest(".row");
        let row_next = row.next();

        if (row_next.length > 0) {
            row.insertAfter(row_next);
        }
    });

    $(document).on("click", "#new_edit_row_titulo", function () {
        $("#div_list_productos_edit").append(concat_title_edit);
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
        let validez = $("#validez_add").val();
        let forma_pago = $("#formapago_add").val();

        if (cliente == null || cliente == "" || cliente == "*") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else if (validez.trim().length == 0) {
            toastr.error("Debe ingresar la validez de la oferta");
            return false;
        } else if (forma_pago.trim().length == 0) {
            toastr.error("Debe ingresar la forma de pago");
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
        let validez = $("#validez_edit").val();
        let forma_pago = $("#formapago_edit").val();

        if (cliente == null || cliente == "" || cliente == "*") {
            toastr.error("Debe seleccionar un cliente");
            return false;
        } else if (validez.trim().length == 0) {
            toastr.error("Debe ingresar la validez de la oferta");
            return false;
        } else if (forma_pago.trim().length == 0) {
            toastr.error("Debe ingresar la forma de pago");
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
        let duracion = $("#duracion_add").val();
        let validez = $("#validez_add").val();
        let tiempo_entrega = $("#tiempo_add").val();
        let forma_pago = $("#formapago_add").val();
        let descuento = $("#descuento_add").val();
        let descripcion_general = $("#descripcion_add").val();
        let incluye = $("#incluye_add").val();
        let garantia = $("#garantia_add").val();
        let envio = $("#envio_add").val();
        let valid_products = 0;
        let valid_cantidad = 0;
        let valid_title = 0;
        let count_1 = 0;
        let count_2 = 0;

        // PRODUCTOS
        let productos = [];
        let divisa = [];
        let cantidad = [];
        let tipo = [];
        let precio = [];
        let ivas = [];
        let retenciones = [];
        let tipo_pago = [];
        let img_grande = [];
        let descripciones = [];
        let titulos = [];
        let order = [];

        $(".producto_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            productos.push($(this).val());
            count_1++;
        });

        $(".divisa_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            divisa.push($(this).val());
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

        $(".tipo_add").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            tipo.push($(this).val());
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

        $(".iva_add").each(function () {
            let value = $(this).val();
            ivas.push(value);
        });

        $(".retencion_add").each(function () {
            let value = $(this).val();
            retenciones.push(value);
        });

        $(".tipo_pago_add:checked").each(function () {
            let value = $(this).data("value");
            tipo_pago.push(value);
            count_2++;
        });

        $(".imagen_grande_add").each(function () {
            if ($(this).is(":checked")) {
                img_grande.push(1);
            } else {
                img_grande.push(0);
            }
        });

        $(".descripcion_add").each(function () {
            descripciones.push($(this).val());
        });

        $(".title_add").each(function () {
            if ($(this).val().trim().length == 0) {
                valid_title++;
            }
            titulos.push($(this).val());
        });

        $("#div_list_productos div").each(function () {
            if ($(this).data("order") != undefined) {
                order.push($(this).data("order"));
            }
        });

        if (order.length == 0) {
            toastr.error("Debe ingresar al menos un producto");
            return false;
        } else if (valid_products > 0) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } else if (valid_cantidad > 0) {
            toastr.error("La cantidad del producto debe ser mayor a 0");
            return false;
        } else if (count_1 != count_2) {
            toastr.error("Debe seleccionar el tipo de pago de cada producto");
            return false;
        } else if (valid_title > 0) {
            toastr.error("Debe ingresar el titulo");
            return false;
        } else {
            $("#modalAdd").modal("hide");
            $("#global-loader").fadeIn("fast");
            $.ajax({
                type: "POST",
                url: "cotizacion_create",
                data: {
                    cliente: cliente,
                    duracion: duracion,
                    validez: validez,
                    tiempo_entrega: tiempo_entrega,
                    forma_pago: forma_pago,
                    descuento: descuento,
                    descripcion_general: descripcion_general,
                    incluye: incluye,
                    productos: productos,
                    divisas: divisa,
                    cantidades: cantidad,
                    tipos: tipo,
                    precios: precio,
                    ivas: ivas,
                    retenciones: retenciones,
                    descripciones: descripciones,
                    tipo_pago: tipo_pago,
                    img_grande: img_grande,
                    garantia: garantia,
                    envio: envio,
                    titulos: titulos,
                    order: order,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Cotización creada correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#modalAdd").modal("show");
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al crear la cotización");
                    }
                },
                error: function (response) {
                    $("#modalAdd").modal("show");
                    $("#global-loader").fadeOut("fast");
                    toastr.error("Error al crear la cotización");
                },
            });
        }
    });

    $("#finish_edit").click(function () {
        let id = $("#id_cotizacion_edit").val();
        let cliente = $("#cliente_edit").val();
        let duracion = $("#duracion_edit").val();
        let validez = $("#validez_edit").val();
        let tiempo_entrega = $("#tiempo_edit").val();
        let forma_pago = $("#formapago_edit").val();
        let descuento = $("#descuento_edit").val();
        let descripcion_general = $("#descripcion_edit").val();
        let incluye = $("#incluye_edit").val();
        let garantia = $("#garantia_edit").val();
        let envio = $("#envio_edit").val();
        let valid_products = 0;
        let valid_cantidad = 0;
        let valid_title = 0;
        let count_1 = 0;
        let count_2 = 0;

        // PRODUCTOS
        let productos = [];
        let divisa = [];
        let cantidad = [];
        let tipo = [];
        let precio = [];
        let ivas = [];
        let retenciones = [];
        let tipo_pago = [];
        let img_grande = [];
        let descripciones = [];
        let titulos = [];
        let order = [];

        $(".producto_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            productos.push($(this).val());
            count_1++;
        });

        $(".divisa_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            divisa.push($(this).val());
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

        $(".tipo_edit").each(function () {
            if (
                $(this).val() == null ||
                $(this).val() == "" ||
                $(this).val() == "*"
            ) {
                valid_products++;
            }
            tipo.push($(this).val());
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

        $(".iva_edit").each(function () {
            let value = $(this).val();
            ivas.push(value);
        });

        $(".retencion_edit").each(function () {
            let value = $(this).val();
            retenciones.push(value);
        });

        $(".tipo_pago_edit:checked").each(function () {
            let value = $(this).data("value");
            tipo_pago.push(value);
            count_2++;
        });

        $(".imagen_grande_edit").each(function () {
            if ($(this).is(":checked")) {
                img_grande.push(1);
            } else {
                img_grande.push(0);
            }
        });

        $(".descripcion_edit").each(function () {
            descripciones.push($(this).val());
        });

        $(".title_edit").each(function () {
            if ($(this).val().trim().length == 0) {
                valid_title++;
            }
            titulos.push($(this).val());
        });

        $("#div_list_productos_edit div").each(function () {
            if ($(this).data("order") != undefined) {
                order.push($(this).data("order"));
            }
        });


        if (order.length == 0) {
            toastr.error("Debe ingresar al menos un producto");
            return false;
        } else if (valid_products > 0) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } else if (valid_cantidad > 0) {
            toastr.error("La cantidad del producto debe ser mayor a 0");
            return false;
        } else if (count_1 != count_2) {
            toastr.error("Debe seleccionar el tipo de pago de cada producto");
            return false;
        } else if (valid_title > 0) {
            toastr.error("Debe ingresar el titulo");
            return false;
        } else {
            $("#modalEdit").modal("hide");
            $("#global-loader").fadeIn("fast");
            $.ajax({
                type: "POST",
                url: "cotizacion_edit",
                data: {
                    id: id,
                    cliente: cliente,
                    duracion: duracion,
                    validez: validez,
                    tiempo_entrega: tiempo_entrega,
                    forma_pago: forma_pago,
                    descuento: descuento,
                    descripcion_general: descripcion_general,
                    incluye: incluye,
                    productos: productos,
                    divisas: divisa,
                    cantidades: cantidad,
                    tipos: tipo,
                    precios: precio,
                    ivas: ivas,
                    retenciones: retenciones,
                    descripciones: descripciones,
                    tipo_pago: tipo_pago,
                    img_grande: img_grande,
                    garantia: garantia,
                    envio: envio,
                    titulos: titulos,
                    order: order,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Cotización modificada correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#modalEdit").modal("show");
                        $("#global-loader").fadeOut("fast");
                        toastr.error("Error al modificar la cotización");
                    }
                },
                error: function (response) {
                    $("#modalEdit").modal("show");
                    $("#global-loader").fadeOut("fast");
                    toastr.error("Error al modificar la cotización");
                },
            });
        }
    });

    $(document).on("click", ".btnView", function () {
        let id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            type: "POST",
            url: "cotizacion_data",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.data;
                let productos = data.detalle;

                if (response.info == 1) {
                    $("#cliente_view").val(data.cliente_id).trigger("change");
                    $("#duracion_view").val(data.duracion);
                    $("#validez_view").val(data.validez);
                    $("#tiempo_view").val(data.tiempo_entrega);
                    $("#formapago_view").val(data.forma_pago);
                    $("#descuento_view").val(data.descuento);
                    $("#descripcion_view").val(data.descripcion);
                    $("#incluye_view").val(data.incluye);
                    $("#garantia_view").val(data.garantia);
                    $("#envio_view").val(data.envio);

                    if (productos.length > 0) {
                        let html = "";
                        for (let i = 0; i < productos.length; i++) {
                            let check1 = "";
                            let check2 = "";
                            let check3 = "";

                            if (productos[i].tipo_pago == 0) {
                                check1 = "checked";
                            } else if (productos[i].tipo_pago == 1) {
                                check2 = "checked";
                            }

                            if (productos[i].img_grande == 1) {
                                check3 = "checked";
                            }

                            let tipo = productos[i].tipo_transaccion;
                            let spacing = "";

                            if (i > 0) {
                                spacing = "mt-3";
                            }

                            if (tipo == 1) {
                                tipo = "Alquiler";
                            } else if (tipo == 2) {
                                tipo = "Transporte";
                            } else if (tipo == 3) {
                                tipo = "Venta";
                            } else if (tipo == 4) {
                                tipo = "Visita Tecnica";
                            }

                            html += `<div class="row row-sm ${spacing} border-top-color">
                                        <div class="col-6">
                                            <select title="Producto" class="form-select" disabled>
                                                <option value="1">${productos[i].producto}</option>
                                            </select>
                                            <div class="d-flex">
                                                <input title="Cantidad" class="form-control mt-3" value="${productos[i].cantidad}" disabled type="number" min="1"
                                                    step="1" placeholder="Cantidad">
                                                <input title="Precio" style="margin-left:20px" class="form-control mt-3" value="${productos[i].precio}" disabled type="text" placeholder="Precio">
                                            </div>
                                            <div class="d-flex">
                                                <input title="Iva" value="${productos[i].iva}" class="form-control mt-3" disabled type="text" placeholder="Iva (%)"
                                                placeholder="Cantidad">
                                                <input title="Retención" value="${productos[i].retencion}" style="margin-left: 20px;" disabled class="form-control mt-3" type="text"
                                                placeholder="Retención (%)">
                                            </div>
                                            <input type="checkbox" disabled class="mt-3" ${check1} data-value="0"> Pago Único
                                            <input type="checkbox" disabled style="margin-left: 100px;" ${check2} class="mt-3" data-value="1"> Pago Mensual
                                            <input type="checkbox" disabled style="margin-left: 100px;" ${check3} class="mt-3" data-value="1"> Imagen Grande
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="col-lg">
                                                    <select title="Tipo Divisa" class="form-select" disabled>
                                                        <option value="1">${productos[i].tipo_divisa == 1 ? "COP" : "USD"}</option>
                                                    </select>
                                                    <div class="mt-3">
                                                        <select title="Tipo Transacción" class="form-select mt-2" disabled>
                                                            <option value="1">${tipo}</option>
                                                        </select>
                                                    </div>
                                                    <textarea title="Descripción" disabled class="form-control mt-3" placeholder="Descripción" rows="3" style="height: 100px; resize: none">${productos[i].descripcion ? productos[i].descripcion : ''}</textarea>
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
            url: "cotizacion_data",
            data: { id: id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                let data = response.data;
                let productos_data = data.detalle;

                if (response.info == 1) {
                    $("#id_cotizacion_edit").val(data.id);
                    $("#cliente_edit").val(data.cliente_id).trigger("change");
                    $("#duracion_edit").val(data.duracion);
                    $("#validez_edit").val(data.validez);
                    $("#tiempo_edit").val(data.tiempo_entrega);
                    $("#formapago_edit").val(data.forma_pago);
                    $("#descuento_edit").val(data.descuento);
                    $("#descripcion_edit").val(data.descripcion);
                    $("#incluye_edit").val(data.incluye);
                    $("#garantia_edit").val(data.garantia);
                    $("#envio_edit").val(data.envio);

                    if (productos_data.length > 0) {
                        let html = "";
                        for (let i = 0; i < productos_data.length; i++) {
                            let check1 = "";
                            let check2 = "";
                            let check3 = "";

                            if (productos_data[i].tipo_pago == 0) {
                                check1 = "checked";
                            } else if (productos_data[i].tipo_pago == 1) {
                                check2 = "checked";
                            }

                            if (productos_data[i].img_grande == 1) {
                                check3 = "checked";
                            }

                            let button = '';
                            let spacing = "";

                            if (i >= 0) {
                                spacing = "mt-3";
                                button = '<div class="d-flex">' +
                                    '<a class="center-vertical mg-s-10 delete_edit_row_producto" href="javascript:void(0)">' +
                                    '<i class="fa fa-trash"></i>' +
                                    '</a>' +
                                    '</div>';
                            }

                            if (productos_data[i].titulo) {
                                html += '<div data-order="1" class="row row-sm mt-3 border-top-color" style="margin-bottom: 20px">' +
                                    '<div class="col-1" style="justify-content: center; display: flex;">' +
                                    '<div class="d-flex">' +
                                    '<a class="center-vertical subir_div" href="javascript:void(0)">' +
                                    '<i class="fa fa-caret-up"></i>' +
                                    "</a>&nbsp;&nbsp;" +
                                    '<a class="center-vertical bajar_div" href="javascript:void(0)">' +
                                    '<i class="fa fa-caret-down"></i>' +
                                    "</a>" +
                                    "</div>" +
                                    "</div>" +
                                    '<div class="col-10">' +
                                    '<input type="text" class="form-control title_edit" value="' + productos_data[i].titulo + '" placeholder="Titulo">' +
                                    "</div>" +
                                    '<div class="col-1" style="justify-content: center; display: flex;">' +
                                    '<div class="d-flex">' +
                                    '<a class="center-vertical delete_row_producto" href="javascript:void(0)">' +
                                    '<i class="fa fa-trash"></i>' +
                                    "</a>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>";
                            } else {
                                html += `<div data-order="0" class="row row-sm ${spacing} border-top-color">
                                        <div class="col-1" style="justify-content: center; display: flex;">
                                        <div class="d-flex">
                                        <a class="center-vertical subir_div" href="javascript:void(0)">
                                        <i class="fa fa-caret-up"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="center-vertical bajar_div" href="javascript:void(0)">
                                        <i class="fa fa-caret-down"></i>
                                        </a>
                                        </div>
                                        </div>
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
                                <div class="d-flex">
                                            <input title="Cantidad" class="form-control mt-3 cantidad_edit" value="${productos_data[i].cantidad}" type="number" min="1"
                                                step="1" placeholder="Cantidad">
                                            <input title="Precio" style="margin-left: 20px;" class="form-control mt-3 precio_edit" value="${productos_data[i].precio}" type="text" placeholder="Precio">
                                        </div>
                                            <div class="d-flex">
                                                <input title="Iva" value="${productos_data[i].iva}" class="form-control mt-3 iva_edit" type="text" placeholder="Iva (%)"
                                                placeholder="Cantidad">
                                                <input title="Retención" value="${productos_data[i].retencion}" style="margin-left: 20px;" class="form-control mt-3 retencion_edit" type="text"
                                                placeholder="Retención (%)">
                                            </div>
                                            <input type="checkbox" class="mt-3 tipo_pago_edit" ${check1} data-value="0"> Pago Único
                                            <input type="checkbox" style="margin-left: 50px;" ${check2} class="mt-3 tipo_pago_edit" data-value="1"> Pago Mensual
                                            <input type="checkbox" style="margin-left: 50px;" ${check3} class="mt-3 imagen_grande_edit" data-value="1"> Imagen Grande
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="col-lg">
                                                    <select data-value="${productos_data[i].tipo_divisa}" title="Tipo Divisa" class="form-select divisa_edit">
                                                        <option value="">Seleccione un tipo de divisa></option>
                                                        <option value="1">COP</option>
                                                        <option value="2">USD</option>
                                                    </select>
                                                    <div class="mt-3">
                                                        <select data-value="${productos_data[i].tipo_transaccion}" title="Tipo Transacción" class="form-select mt-2 tipo_edit">
                                                            <option value="">Seleccione un tipo</option>
                                                            <option value="1">Alquiler</option>
                                                            <option value="2">Transporte</option>
                                                            <option value="3">Venta</option>
                                                            <option value="4">Visita Tecnica</option>
                                                        </select>
                                                    </div>
                                                    <textarea title="Descripción" class="form-control mt-3 descripcion_edit" placeholder="Descripción" rows="3" style="height: 100px; resize: none">${productos_data[i].descripcion ? productos_data[i].descripcion : ''}</textarea>
                                                </div>
                                                ${button}
                                            </div>
                                        </div>
                                    </div>`;
                            }
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
            title: "¿Está seguro de completar la cotización?",
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
                    url: "cotizacion_completar",
                    data: { id: id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(
                                "Cotización completada correctamente"
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al completar la cotización");
                        }
                    },
                    error: function (response) {
                        toastr.error("Error al completar la cotización");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEliminar", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Está seguro de eliminar la cotización?",
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
                    url: "cotizacion_delete",
                    data: { id: id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(
                                "Cotización eliminada correctamente"
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar la cotización");
                        }
                    },
                    error: function (response) {
                        toastr.error("Error al eliminar la cotización");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEmail", function () {
        let id = $(this).data("id");
        $("#id_cotizacion_email").val(id);
        $("#modalEmail").modal("show");
    });

    $("#btn_save_email").click(function () {
        let id = $("#id_cotizacion_email").val();
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
                url: "cotizacion_email",
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

    $(document).on("change", ".date_revision", function () {
        let id = $(this).data("id");
        let value = $(this).val();

        $.ajax({
            type: "POST",
            url: "cotizacion_fecha_revision",
            data: { id: id, fecha_revision: value },
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

    $(document).on("change", ".aprobado_select", function () {
        let id = $(this).data("id");
        let val = $(this).val();

        $.ajax({
            type: "POST",
            url: "cotizacion_aprobado",
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
