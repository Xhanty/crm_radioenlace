$(document).ready(function () {
    $("#div_content_cliente_edit").hide();
    $(".open-toggle").trigger("click");

    $("#back_table_cliente_edit").click(function () {
        $("#div_list_clientes").show();
        $("#div_content_cliente_edit").hide();
    });
});
