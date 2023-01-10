$(function () {
    $(".open-toggle").trigger("click");

    // CHECKS
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
        let cantidad = 5;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-clie-" + i).prop("checked", true);
            } else {
                $(".check-clie-" + i).prop("checked", false);
            }
        }
    });

    $(".check-emp-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 7;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-emp-" + i).prop("checked", true);
            } else {
                $(".check-emp-" + i).prop("checked", false);
            }
        }
    });

    $(".check-prov-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 4;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-prov-" + i).prop("checked", true);
            } else {
                $(".check-prov-" + i).prop("checked", false);
            }
        }
    });

    $(".check-inv-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 6;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-inv-" + i).prop("checked", true);
            } else {
                $(".check-inv-" + i).prop("checked", false);
            }
        }
    });

    $(".check-mov-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 7;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-mov-" + i).prop("checked", true);
            } else {
                $(".check-mov-" + i).prop("checked", false);
            }
        }
    });

    $(".check-sol-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 3;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-sol-" + i).prop("checked", true);
            } else {
                $(".check-sol-" + i).prop("checked", false);
            }
        }
    });

    $(".check-pro-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 6;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-pro-" + i).prop("checked", true);
            } else {
                $(".check-pro-" + i).prop("checked", false);
            }
        }
    });

    $(".check-seg-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 4;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-seg-" + i).prop("checked", true);
            } else {
                $(".check-seg-" + i).prop("checked", false);
            }
        }
    });

    $(".check-rep-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 4;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-rep-" + i).prop("checked", true);
            } else {
                $(".check-rep-" + i).prop("checked", false);
            }
        }
    });

    $(".check-doc-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 3;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-doc-" + i).prop("checked", true);
            } else {
                $(".check-doc-" + i).prop("checked", false);
            }
        }
    });

    $(".check-com-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 12;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-com-" + i).prop("checked", true);
            } else {
                $(".check-com-" + i).prop("checked", false);
            }
        }
    });

    $(".check-con-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 15;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-con-" + i).prop("checked", true);
            } else {
                $(".check-con-" + i).prop("checked", false);
            }
        }
    });

    $(".check-gas-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 4;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-gas-" + i).prop("checked", true);
            } else {
                $(".check-gas-" + i).prop("checked", false);
            }
        }
    });

    $(".check-con-0").on("change", function () {
        let check = $(this).prop("checked");
        let cantidad = 2;

        for (let i = 1; i <= cantidad; i++) {
            if (check) {
                $(".check-con-" + i).prop("checked", true);
            } else {
                $(".check-con-" + i).prop("checked", false);
            }
        }
    });

    // BTNS
    $("#btn_asignaciones").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#asignaciones_div").show();
        $(this).addClass("active");
    });

    $("#btn_actividades").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#actividades_div").show();
        $(this).addClass("active");
    });

    $("#btn_puntos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#puntos_div").show();
        $(this).addClass("active");
    });

    $("#btn_vehiculos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#vehiculos_div").show();
        $(this).addClass("active");
    });

    $("#btn_clientes").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#clientes_div").show();
        $(this).addClass("active");
    });

    $("#btn_empleados").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#empleados_div").show();
        $(this).addClass("active");
    });

    $("#btn_proveedores").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#proveedores_div").show();
        $(this).addClass("active");
    });

    $("#btn_inventario").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#inventario_div").show();
        $(this).addClass("active");
    });

    $("#btn_movimientos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#movimientos_div").show();
        $(this).addClass("active");
    });

    $("#btn_solicitudes").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#solicitudes_div").show();
        $(this).addClass("active");
    });

    $("#btn_proyectos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#proyectos_div").show();
        $(this).addClass("active");
    });

    $("#btn_seguimientos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#seguimientos_div").show();
        $(this).addClass("active");
    });

    $("#btn_reparaciones").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#reparaciones_div").show();
        $(this).addClass("active");
    });

    $("#btn_documentos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#documentos_div").show();
        $(this).addClass("active");
    });

    $("#btn_comercial").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#comercial_div").show();
        $(this).addClass("active");
    });

    $("#btn_contabilidad").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#contabilidad_div").show();
        $(this).addClass("active");
    });

    $("#btn_gastos").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#gastos_div").show();
        $(this).addClass("active");
    });

    $("#btn_config").on("click", function () {
        $(".select_div").removeClass("active");
        $(".div-list-ocult").hide();
        $("#config_div").show();
        $(this).addClass("active");
    });

    $(".div-list-ocult").hide();
    $("#asignaciones_div").show();
});
