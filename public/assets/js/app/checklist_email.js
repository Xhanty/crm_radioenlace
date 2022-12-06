$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let concat =
        '<div class="row row-sm mt-2">' +
        '<div class="col-lg" style="display: flex">' +
        '<input class="form-control emailadd" placeholder="Email" type="email">' +
        '<a class="center-vertical mg-s-10 btn_delete_row" href="javascript:void(0)"><i class="fa fa-trash"></i></a>' +
        "</div>" +
        "</div>";

    $("#new_row_email").click(function () {
        $("#div_list_email").append(concat);
    });

    $(document).on("click", ".btn_delete_row", function () {
        $(this).closest(".row").remove();
    });

    $("#btn_save_email").click(function () {
        let vehiculo = $("#vehiculoadd").val();
        let checklist = $("#tipoadd").val();
        let emails = [];
        $(".emailadd").each(function () {
            emails.push($(this).val());
        });

        console.log(emails);
    });
});
