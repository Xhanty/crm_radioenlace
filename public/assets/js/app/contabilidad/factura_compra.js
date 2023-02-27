$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    $("#btnNew").click(function () {
        $("#div_general").addClass("d-none");
        $("#div_form_add").removeClass("d-none");
    });

    $(".back_home").click(function () {
        $("#div_general").removeClass("d-none");
        $("#div_form_add").addClass("d-none");
    });
});
