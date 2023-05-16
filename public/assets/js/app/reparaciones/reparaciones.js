$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let encargados = JSON.parse(localStorage.getItem("encargados"));
    let categorias = JSON.parse(localStorage.getItem("categorias"));
    let accesorios = JSON.parse(localStorage.getItem("accesorios"));

    $(".open-toggle").trigger("click");

    $("#new_row_add").click(function () {
        $("#div_reparaciones_add").append('<div style="display: flex;" class="mt-3">' +
            '<div style="width: 99%; border-bottom: 2px solid #ccc;">' +
            '<div class="row row-sm">' +
            '<div class="col-lg">' +
            '<label for="">Persona que recibe</label>' +
            '<select class="form-select encargado_add">' +
            '<option value="">Seleccione una opción</option>' +
            encargados.map((encargado) => {
                return `<option value="${encargado.id}">${encargado.nombre}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Categoría</label>' +
            '<select class="form-select categoria_add">' +
            '<option value="">Seleccione una opción</option>' +
            categorias.map((categoria) => {
                return `<option value="${categoria.id}">${categoria.categoria}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Accesorios</label>' +
            '<select multiple class="form-select accesorios_add">' +
            '<option value="">Seleccione una opción</option>' +
            accesorios.map((accesorio) => {
                return `<option value="${accesorio.id}">${accesorio.accesorio}</option>`;
            }) +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="row row-sm mt-2">' +
            '<div class="col-lg">' +
            '<label for="">Modelo</label>' +
            '<input class="form-control modelo_add" placeholder="Modelo" type="text">' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Serie</label>' +
            '<input class="form-control serie_add" placeholder="Serie" type="text">' +
            '</div>' +
            '<div class="col-lg">' +
            '<label for="">Foto</label>' +
            '<input class="form-control foto_add" type="file" accept="image/*">' +
            '</div>' +
            '</div>' +
            '<div class="row row-sm mt-2">' +
            '<div class="col-lg">' +
            '<label for="">Observaciones</label>' +
            '<textarea class="form-control observaciones_add" placeholder="Observaciones" rows="3"' +
            'style="height: 90px; resize: none"></textarea>' +
            '</div>' +
            '</div>' +
            '<br>' +
            '</div>' +
            '<div style="display: flex;"">' +
            '<a class="center-vertical delete_row" style="margin-left: 20px; margin-top: -22px;"' +
            'href="javascript:void(0);"><i class="fa fa-trash"></i></a>' +
            '</div>' +
            '</div> ');

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione una opción",
                searchInputPlaceholder: "Buscar",
            });
        });
    });
    
    $(document).on("click", ".delete_row", function () {
        $(this).parent().parent().remove();
    });

    $("#btnGuardarRepacion").click(function () {
        let cliente = $("#cliente_add").val();
        let correos = $("#correos_add").val();
        let valid = false;

        let reparaciones = [];

        $(".encargado_add").each(function () {
            let encargado = $(this).val();
            let categoria = $(this).parent().parent().find(".categoria_add").val();
            let accesorios = $(this).parent().parent().find(".accesorios_add").val();
            let modelo = $(this).parent().parent().parent().find(".modelo_add").val();
            let serie = $(this).parent().parent().parent().find(".serie_add").val();
            let observaciones = $(this).parent().parent().parent().find(".observaciones_add").val();
            let foto = $(this).parent().parent().parent().find(".foto_add")[0].files[0];

            if (encargado == "" || categoria == "") {
                valid = true;
            }

            reparaciones.push({
                encargado,
                categoria,
                accesorios,
                modelo,
                serie,
                observaciones,
                foto,
            });
        });
    });
});
