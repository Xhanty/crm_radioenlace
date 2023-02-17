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

    $("#new_row_producto_edit").click(function () {
        $("#div_list_productos_edit").append(concat_edit);

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
            });
        });
    });

    $(document).on("click", ".delete_row", function () {
        $(this).closest(".row").remove();
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
});
