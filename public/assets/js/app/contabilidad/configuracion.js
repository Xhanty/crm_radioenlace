$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    load_pucs();

    $(".open-toggle").trigger("click");

    $("#btnOrganizacion").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_organizacion").removeClass("d-none");
    });

    $("#btnFormasPago").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_formas_pago").removeClass("d-none");
    });

    $("#btnPuc").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_pucs").removeClass("d-none");
    });

    $("#btnClientes").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_clientes").removeClass("d-none");
    });

    $("#btnProveedores").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_proveedores").removeClass("d-none");
    });

    $("#btnEmpleados").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_empleados").removeClass("d-none");
    });

    $("#btnCentrosCostos").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_centros_costos").removeClass("d-none");
    });

    $(document).on("click", ".back_to_menu", function () {
        $("#div_general").removeClass("d-none");
        $("#div_organizacion").addClass("d-none");
        $("#div_formas_pago").addClass("d-none");
        $("#div_pucs").addClass("d-none");
        $("#div_clientes").addClass("d-none");
        $("#div_proveedores").addClass("d-none");
        $("#div_empleados").addClass("d-none");
        $("#div_centros_costos").addClass("d-none");
    });

    $(".nav-link-1").click(function () {
        $(this).addClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-3").removeClass("active");

        $("#one_detail").addClass("active");
        $("#two_detail").removeClass("active");
    });

    $(".nav-link-2").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-3").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").addClass("active");
    });

    function load_pucs() {
        var columns = [
            {
                title: '',
                target: 0,
                className: 'treegrid-control text-center',
                data: function (item) {
                    if (item.children) {
                        return '<span><i class="fa fa-plus"></i></span>';
                    }
                    return '';
                }
            },
            {
                title: 'Código',
                target: 1,
                data: function (item) {
                    return '<a target="_BLANK" href="https://puc.com.co/' + item.code + '">' + item.code + '</a>';
                }
            },
            {
                title: 'Nombre',
                target: 2,
                data: function (item) {
                    return item.nombre;
                }
            },
        ];

        $('#data_pucs_view').DataTable({
            'columns': columns,
            'order': [],
            'ajax': 'pucs_data',
            'treeGrid': {
                'left': 10,
                'expandIcon': '<span><i class="fa fa-plus"></i></span>',
                'collapseIcon': '<span><i class="fa fa-minus"></i></span>',
            }
        });
    }

    //ORGANIZACIÓN
    $("#tipo_doc_organizacion").on("change", function () {
        var tipo_doc = $(this).val();
        if (tipo_doc == 5) {
            $("#digito_verifi_organizacion").parent().removeClass("d-none");
        } else {
            $("#digito_verifi_organizacion").parent().addClass("d-none");
        }
    });
});