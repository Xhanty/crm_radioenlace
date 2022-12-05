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
});
