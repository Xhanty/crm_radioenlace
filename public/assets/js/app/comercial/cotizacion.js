$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var clientes = JSON.parse(localStorage.getItem("clientes"));
    var productos = JSON.parse(localStorage.getItem("productos"));

    let concat =
        '<div class="row row-sm mt-3 border-top-color">' +
        '<div class="col-6">' +
        '<select class="form-select producto_add">' +
        '<option value="">Seleccione un producto</option>' +
        productos.map((cliente) => {
            return (
                '<option value="' +
                cliente.id +
                '">' +
                cliente.nombre +
                "</option>"
            );
        }) +
        "</select>" +
        '<input class="form-control mt-3 cantidad_add" type="number" min="1" step="1"' +
        'placeholder="Cantidad">' +
        '<input class="form-control mt-3 precio_add" type="text"' +
        'placeholder="Precio">' +
        "</div>" +
        '<div class="col-6">' +
        '<div class="d-flex">' +
        '<div class="col-lg">' +
        '<select class="form-select divisa_add">' +
        '<option value="">Seleccione un tipo de divisa' +
        "</option>" +
        '<option value="1">COP</option>' +
        '<option value="2">USD</option>' +
        "</select>" +
        '<div class="mt-3">' +
        '<select class="form-select mt-2 tipo_add">' +
        '<option value="">Seleccione un tipo' +
        "</option>" +
        '<option value="1">Alquiler</option>' +
        '<option value="2">Transporte</option>' +
        '<option value="3">Venta</option>' +
        '<option value="4">Visita Tecnica</option>' +
        "</select>" +
        "</div>" +
        '<textarea class="form-control mt-3 descripcion_add" placeholder="Descripción" rows="3"' +
        'style="height: 60px; resize: none"></textarea>' +
        "</div>" +
        '<div class="d-flex">' +
        '<a class="center-vertical mg-s-10 delete_row_producto" href="javascript:void(0)">' +
        '<i class="fa fa-trash"></i>' +
        "</a>" +
        "</div>" +
        "</div>" +
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

    $(document).on("click", ".delete_row_producto", function () {
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

    $("#finish").click(function () {
        let cliente = $("#cliente_add").val();
        let duracion = $("#duracion_add").val();
        let validez = $("#validez_add").val();
        let tipo_entrega = $("#tiempo_add").val();
        let forma_pago = $("#formapago_add").val();
        let descuento = $("#descuento_add").val();
        let descripcion_general = $("#descripcion_add").val();
        let incluye = $("#incluye_add").val();
        let valid_products = 0;
        let valid_cantidad = 0;

        // PRODUCTOS
        let productos = [];
        let divisa = [];
        let cantidad = [];
        let tipo = [];
        let precio = [];
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
                $(this).val() <= 0
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

        $(".descripcion_add").each(function () {
            descripciones.push($(this).val());
        });

        console.log(productos);
        console.log(divisa);
        console.log(tipo);
        console.log(cantidad);
        console.log(precio);
        console.log(descripciones);

        if (valid_products > 0) {
            toastr.error("Debe ingresar todos los datos de los productos");
            return false;
        } else if (valid_products > 0) {
            toastr.error("La cantidad del producto debe ser mayor a 0");
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
                    tipo_entrega: tipo_entrega,
                    forma_pago: forma_pago,
                    descuento: descuento,
                    descripcion_general: descripcion_general,
                    incluye: incluye,
                    productos: productos,
                    divisa: divisa,
                    cantidad: cantidad,
                    tipo: tipo,
                    precio: precio,
                    descripciones: descripciones,
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
});
