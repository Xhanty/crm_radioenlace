$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#div_content_empleado_edit").hide();
    $(".open-toggle").trigger("click");

    $("#back_table_empleado_edit").click(function () {
        $("#div_list_empleados").show();
        $("#div_content_empleado_edit").hide();
    });

    $(".nav-link-1").click(function () {
        $(this).addClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-3").removeClass("active");
        $(".nav-link-4").removeClass("active");
        $(".nav-link-5").removeClass("active");

        $("#one_detail").addClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").removeClass("active");
        $("#four_detail").removeClass("active");
        $("#five_detail").removeClass("active");
    });

    $(".nav-link-2").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-3").removeClass("active");
        $(".nav-link-4").removeClass("active");
        $(".nav-link-5").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").addClass("active");
        $("#three_detail").removeClass("active");
        $("#four_detail").removeClass("active");
        $("#five_detail").removeClass("active");
    });

    $(".nav-link-3").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-4").removeClass("active");
        $(".nav-link-5").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").addClass("active");
        $("#four_detail").removeClass("active");
        $("#five_detail").removeClass("active");
    });

    $(".nav-link-4").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-3").removeClass("active");
        $(".nav-link-5").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").removeClass("active");
        $("#five_detail").removeClass("active");
        $("#four_detail").addClass("active");
    });

    $(".nav-link-5").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-3").removeClass("active");
        $(".nav-link-4").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").removeClass("active");
        $("#four_detail").removeClass("active");
        $("#five_detail").addClass("active");
    });
});
