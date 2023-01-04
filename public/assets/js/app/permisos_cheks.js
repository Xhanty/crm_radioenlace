$(function () {
    $(".open-toggle").trigger("click");

    $(".check-asig-gen-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 2;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-asig-gen-" + i).prop("checked", true);
            } else {
                $(".check-asig-gen-" + i).prop("checked", false);
            }
        }
    });

    $(".check-asig-pro-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 2;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-asig-pro-" + i).prop("checked", true);
            } else {
                $(".check-asig-pro-" + i).prop("checked", false);
            }
        }
    });

    $(".check-act-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 1;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-act-" + i).prop("checked", true);
            } else {
                $(".check-act-" + i).prop("checked", false);
            }
        }
    });

    $(".check-punt-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 1;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-punt-" + i).prop("checked", true);
            } else {
                $(".check-punt-" + i).prop("checked", false);
            }
        }
    });

    $(".check-veh-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 5;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-veh-" + i).prop("checked", true);
            } else {
                $(".check-veh-" + i).prop("checked", false);
            }
        }
    });

    $(".check-clie-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 4;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-clie-" + i).prop("checked", true);
            } else {
                $(".check-clie-" + i).prop("checked", false);
            }
        }
    });

    $(".div-list-ocult").hide();
    $("#clientes_div").show();
});
