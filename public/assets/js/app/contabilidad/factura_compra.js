$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".form-select").each(function () {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: "Seleccione",
            searchInputPlaceholder: "Buscar",
        });
    });

    var productos = JSON.parse(localStorage.getItem("productos"));
    var formas_pago = JSON.parse(localStorage.getItem("formas_pago"));

    $(".open-toggle").trigger("click");

    var contact_forma_pago = '<div class="row row-sm mt-2">' +
        '<div class="col-lg-6" >' +
        '<select class="form-select">' +
        '<option value="">Seleccione una opción</option>' +
        formas_pago.map((item) => {
            return (
                '<option value="' +
                item.id +
                '">' +
                item.nombre +
                "</option>"
            );
        }) +
        '</select>' +
        '</div>' +
        '<div class="col-lg-2"></div>' +
        '<div class="col-lg-3 d-flex" style="justify-content: end">' +
        '<input type="text" placeholder="0.00"' +
        'class="form-control col-8 text-end">' +
        '</div>' +
        '<div class="col-lg-1 d-flex" style="justify-content: center">' +
        '<a class="center-vertical mg-s-10 delete_row_forma" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        '</div>' +
        '</div > ';

    $("#new_row").click(function () {
        $("#tbl_data_detail tbody").append(
            '<tr style="background: #f9f9f9;">' +
            '<td class="center-text pad-4">1</td>' +
            '<td class="pad-4">' +
            '<select class="form-select tipo_add">' +
            '<option value="">Seleccione una opción</option>' +
            '<option value="1">Producto</option>' +
            '<option value="2">Activo Fijo</option>' +
            '<option value="3">Gasto / Cuenta contable</option>' +
            '</select>' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select producto_add">' +
            '<option value="">Seleccione una opción</option>' +
            productos.map((item) => {
                return (
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nombre + " (" + item.marca + "-" + item.modelo + ")" +
                    "</option>"
                );
            }) +
            '</select>' +
            '</td>' +
            '<td class="pad-4">' +
            '<textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="2"></textarea>' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="text" placeholder="Bodega" class="form-control bodega_add" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="number" placeholder="Cantidad" class="form-control text-end cantidad_add" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="number" placeholder="Valor Unitario" class="form-control text-end valor_add input_dinner" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<input type="number" placeholder="Descuento" class="form-control text-end descuento_add" style="border: 0">' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select cargo_add">' +
            '<option value="">Seleccione una opción</option>' +
            '<option value="1">IVA 19%</option>' +
            '<option value="2">Iva Serv 19%</option>' +
            '<option value="3">IVA 16%</option>' +
            '<option value="4">IVA 5%</option>' +
            '<option value="5">Impoconsumo 8%</option>' +
            '</select>' +
            '</td>' +
            '<td class="pad-4">' +
            '<select class="form-select retencion_add">' +
            '<option value="">Seleccione una opción</option>' +
            '<option value="1">Retefuente 11%</option>' +
            '<option value="2">Retefuente 10%</option>' +
            '<option value="3">Retefuente 7%</option>' +
            '<option value="4">Retefuente 6%</option>' +
            '<option value="5">Retención 5%</option>' +
            '<option value="6">Retefuente 4%</option>' +
            '<option value="8">Arriendos 4%</option>' +
            '<option value="9">Arriendos 3.5%</option>' +
            '<option value="10">Retefuente 3.5%</option>' +
            '<option value="11">Retefuente 2.5%</option>' +
            '<option value="12">Retefuente 2%</option>' +
            '<option value="13">Retefuente 1%</option>' +
            '<option value="14">Autoretención del cree 0.4%</option>' +
            '<option value="15">Retefuente 0.1%</option>' +
            '</select>' +
            '</td>' +
            '<td class="text-center d-flex pad-4">' +
            '<input disabled type="text" placeholder="0.00" class="form-control text-end total_add" style="border: 0">' +
            '<a class="center-vertical mg-s-10 delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>&nbsp;' +
            '</td>' +
            '</tr>'
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
            });
        });

        numero_filas();
    });

    $("#new_row_forma").click(function () {
        $("#list_formas_pago").append(contact_forma_pago);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $(document).on("click", ".delete_row", function () {
        $(this).parent().parent().remove();
        numero_filas();
    });

    $(document).on("click", ".delete_row_forma", function () {
        $(this).parent().parent().remove();
    });

    function numero_filas() {
        var num = 1;
        $("#tbl_data_detail tbody tr").each(function () {
            $(this).find("td:first").text(num);
            num++;
        });
    }

    $("#btnNew").click(function () {
        $("#div_general").addClass("d-none");
        $("#div_form_add").removeClass("d-none");
    });

    $(".back_home").click(function () {
        $("#div_general").removeClass("d-none");
        $("#div_form_add").addClass("d-none");
    });

    $("#proveedor_add").change(function () {
        var id = $(this).val();

        if (id != "") {
            $.ajax({
                url: "info_proveedor",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let data = response.data;
                        $("#contacto_add").val(data.contacto);
                    } else {
                        toastr.error("Error al cargar los datos del proveedor");
                        $("#contacto_add").val("");
                    }
                },
                error: function (data) {
                    toastr.error("Error al cargar los datos del proveedor");
                    $("#contacto_add").val("");
                },
            });
        } else {
            toastr.error("Debe seleccionar un proveedor");
            $("#contacto_add").val("");
        }
    });

    $(document).on("keyup", ".input_dinner", function () {
        // Obtener el valor ingresado por el usuario
        var inputVal = $(this).val();

        // Remover cualquier caracter que no sea número, punto decimal o coma
        inputVal = inputVal.replace(/[^\d.,]/g, '');

        // Reemplazar la coma por punto y el punto por coma
        inputVal = inputVal.replace(',', '#').replace('.', ',').replace('#', '.');

        // Separar los decimales y los miles
        var parts = inputVal.split(',');
        var intPart = parts[0];
        var decimalPart = parts.length > 1 ? ',' + parts[1] : '';

        // Formatear la parte entera con separador de miles
        intPart = intPart.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Combinar la parte entera y decimal formateados
        var formattedVal = intPart + decimalPart;

        // Actualizar el valor en el campo de entrada
        $(this).val(formattedVal);
    });
});
