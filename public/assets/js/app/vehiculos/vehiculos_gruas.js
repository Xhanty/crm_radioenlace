$(function () {

    $(".kit-carretera-0").on("change" , function () {
        let check = $(this).prop("checked");
        let cantidad = 10;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".kit-carretera-" + i).prop("checked", true);
            } else {
                $(".kit-carretera-" + i).prop("checked", false);
            }
        }
    });

    $(".caja-herramienta-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 6;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".caja-herramienta-" + i).prop("checked", true);
            } else {
                $(".caja-herramienta-" + i).prop("checked", false);
            }
        }
    });

    $(".electricidad-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 11;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".electricidad-" + i).prop("checked", true);
            } else {
                $(".electricidad-" + i).prop("checked", false);
            }
        }
    });

    $(".general-cabina-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 7;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".general-cabina-" + i).prop("checked", true);
            } else {
                $(".general-cabina-" + i).prop("checked", false);
            }
        }
    });

    $(".motor-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 13;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".motor-" + i).prop("checked", true);
            } else {
                $(".motor-" + i).prop("checked", false);
            }
        }
    });

    $(".estado-general-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 15;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".estado-general-" + i).prop("checked", true);
            } else {
                $(".estado-general-" + i).prop("checked", false);
            }
        }
    });

    $(".hidraulicos-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 6;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".hidraulicos-" + i).prop("checked", true);
            } else {
                $(".hidraulicos-" + i).prop("checked", false);
            }
        }
    });

    $(".documentos-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 5;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".documentos-" + i).prop("checked", true);
            } else {
                $(".documentos-" + i).prop("checked", false);
            }
        }
    });

    $(".general-content-check input").on("change", function () {
        let check = $(this).prop("checked");

        if (check) {
            $(this).parent("label").next("div").removeClass("d-none");
        } else {
            $(this).parent("label").next("div").addClass("d-none");
        }
    });
});