$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#div_content_cliente_edit").hide();
    $(".open-toggle").trigger("click");

    $("#back_table_cliente_edit").click(function () {
        $("#div_list_clientes").show();
        $("#div_content_cliente_edit").hide();
    });

    $(".nav-link-1").click(function () {
        $(this).addClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-3").removeClass("active");

        $("#one_detail").addClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").removeClass("active");
    });

    $(".nav-link-2").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-3").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").addClass("active");
        $("#three_detail").removeClass("active");
    });

    $(".nav-link-3").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-2").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").addClass("active");
    });

    $("#btnModificarCliente1").click(function () {
        let id = $("#id_cliente_edit").val();
        let tipo_cliente = $("#tipo_cliente_edit").val();
        let ciudad = $("#ciudad_cliente_edit").val();
        let tipo_documento = $("#tipo_doc_cliente_edit").val();
        let documento = $("#documento_cliente_edit").val();
        let razon_social = $("#razon_social_edit").val();
        let direccion = $("#direccion_edit").val();
        let telefono = $("#telefono_edit").val();
        let celular = $("#celular_edit").val();
        let contacto = $("#contacto_edit").val();
        let email = $("#email_edit").val();
        let tipo_regimen = $("#tipo_regimenadd").val();
        let codigo = $("#codigo_sucursaladd").val();
        let indicativo = $("#indicativo_telefonoadd").val();
        let extension = $("#extencionadd").val();

        $.ajax({
            url: "clientes_update",
            type: "POST",
            data: {
                update_tipo: 1,
                id: id,
                tipo_cliente: tipo_cliente,
                ciudad: ciudad,
                tipo_documento: tipo_documento,
                documento: documento,
                razon_social: razon_social,
                direccion: direccion,
                telefono: telefono,
                celular: celular,
                contacto: contacto,
                email: email,
                tipo_regimen: tipo_regimen,
                codigo: codigo,
                indicativo: indicativo,
                extension: extension,
            },
            success: function (response) {
                if (response == "ok") {
                    $("#div_list_clientes").show();
                    $("#div_content_cliente_edit").hide();
                    $("#table_clientes").DataTable().ajax.reload();
                }
            }, 
            error: function (response) {
                console.log(response);
            },
        });
    });
});