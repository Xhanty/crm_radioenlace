$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var language = {
        searchPlaceholder: "Buscar...",
        sSearch: "",
        decimal: "",
        emptyTable: "No hay información",
        info: "Mostrando _START_ a _END_ de _TOTAL_ Resultados",
        infoEmpty: "Mostrando 0 to 0 de 0 Resultados",
        infoFiltered: "(Filtrado de _MAX_ total resultados)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "Mostrar _MENU_ Resultados",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "Sin resultados encontrados",
        paginate: {
            first: "Primero",
            last: "Ultimo",
            next: "Siguiente",
            previous: "Anterior",
        },
        select: {
            rows: {
                _: "%d filas seleccionadas",
                0: "",
                1: "1 fila seleccionada",
            },
        },
    };

    var tbl_pucs_cliente = null;
    var tbl_pucs_all_cliente = null;

    load_pucs_cliente();
    load_pucs();
    load_ciudades();
    load_formas_pago();
    load_tipo_empresa();
    load_tipo_regimen();
    load_tipo_documento();
    load_centros_costos();
    load_actividad_economica();

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

    $("#btnCentrosCostos").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_centros_costos").removeClass("d-none");
    });

    $("#btnAdminTipoEmpresa").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_tipos_empresas").removeClass("d-none");
    });

    $("#btnAdminTipoRegimen").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_tipos_regimenes").removeClass("d-none");
    });

    $("#btnAdminActividadEconomica").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_actividades_economicas").removeClass("d-none");
    });

    $("#btnAdminTipoDocumento").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_tipos_documentos").removeClass("d-none");
    });

    $("#btnAdminCiudades").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_ciudades").removeClass("d-none");
    });

    $("#btnPucCliente").on("click", function () {
        $("#div_general").addClass("d-none");
        $("#div_config_pucs").removeClass("d-none");
    });

    $(document).on("click", ".back_to_menu", function () {
        $("#div_general").removeClass("d-none");
        $("#div_organizacion").addClass("d-none");
        $("#div_formas_pago").addClass("d-none");
        $("#div_pucs").addClass("d-none");
        $("#div_centros_costos").addClass("d-none");
        $("#div_tipos_empresas").addClass("d-none");
        $("#div_tipos_regimenes").addClass("d-none");
        $("#div_actividades_economicas").addClass("d-none");
        $("#div_tipos_documentos").addClass("d-none");
        $("#div_ciudades").addClass("d-none");
        $("#div_config_pucs").addClass("d-none");
        $("#div_param_cuentas").addClass("d-none");
    });

    $(document).on("click", ".back_to_menu_param_doc", function () {
        $("#div_general").removeClass("d-none");
        $("#div_param_cuentas").addClass("d-none");

        $("#regimen_param_cuenta").val("").trigger("change");

        $("#tbl_cuentas_param tbody").empty();

        if ($.fn.DataTable.isDataTable("#tbl_cuentas_param")) {
            $("#tbl_cuentas_param").DataTable().destroy();
        }

        $("#tbl_cuentas_param tbody").empty();

        $("#tbl_cuentas_param").DataTable({
            "responsive": true,
            "language": language,
            "order": [],
        });
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
        $("#four_detail").addClass("active");
        $("#five_detail").removeClass("active");
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

    // CARGAR INFORMACIÓN
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
            'language': language,
            'ajax': 'pucs_data',
            'treeGrid': {
                'left': 14,
                'expandIcon': '<span><i class="fa fa-plus"></i></span>',
                'collapseIcon': '<span><i class="fa fa-minus"></i></span>',
            }
        });
    }

    function load_pucs_cliente() {
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
                    if (item.auxiliar == 1) {
                        return item.code;
                    } else {
                        return '<a target="_BLANK" href="https://puc.com.co/' + item.code + '">' + item.code + '</a>';
                    }
                }
            },
            {
                title: 'Nombre',
                target: 2,
                data: function (item) {
                    return item.nombre;
                }
            },
            {
                title: 'Status',
                target: 3,
                className: 'text-center',
                data: function (item) {
                    if (item.status == 1) {
                        return '<span class="badge badge-success bg-success">Activo</span>';
                    } else {
                        return '<span class="badge badge-danger bg-danger">Inactivo</span>';
                    }
                }
            },
            {
                title: 'Acción',
                target: 4,
                className: 'text-center',
                data: function (item) {
                    let id = item.id;
                    let parent_id = item.parent_id;
                    let code = item.code;
                    let nombre = item.nombre;

                    if (item.acciones == 1) {
                        return '<button title="Agregar Auxiliar" class="btn btn-sm btn-primary btnAddChildPucCliente" data-id="' + id +
                            '" data-parent="' + parent_id + '" data-code="' + code + '" data-nombre="' + nombre + '"><i class="fa fa-plus"></i></button>';
                    } else if (item.auxiliar == 1) {
                        return '<button title="Modificar" class="btn btn-sm btn-warning btnEditChildPucCliente" data-id="' + id +
                            '" data-code="' + item.code_child + '" data-nombre="' + nombre + '"><i class="fa fa-pencil-alt"></i></button>&nbsp;' +
                            '<button title="Eliminar" class="btn btn-sm btn-danger btnDeleteChildPucCliente" data-id="' + id +
                            '" data-code="' + code + '"><i class="fa fa-trash"></i></button>';
                    } else {
                        return '';
                    }
                }
            },
        ];

        var columns_all = [
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
            {
                title: 'Status',
                target: 3,
                className: 'text-center',
                data: function (item) {
                    if (item.status == 1) {
                        return '<span class="badge badge-success bg-success">Activo</span>';
                    } else {
                        return '<span class="badge badge-danger bg-danger">Inactivo</span>';
                    }
                }
            },
        ];

        tbl_pucs_cliente = $('#data_pucs_config_view').DataTable({
            'select': {
                'style': 'multi',
                'selector': 'td:not(:first-child, :last-child)'
            },
            'columns': columns,
            'order': [],
            'language': language,
            'ajax': 'pucs_clientes_data',
            'treeGrid': {
                'left': 14,
                'expandIcon': '<span><i class="fa fa-plus"></i></span>',
                'collapseIcon': '<span><i class="fa fa-minus"></i></span>',
            }
        });

        tbl_pucs_all_cliente = $('#data_pucs_all_config_view').DataTable({
            'select': {
                'style': 'multi',
                'selector': 'td:not(:first-child)'
            },
            'columns': columns_all,
            'order': [],
            'language': language,
            'ajax': 'pucs_all_clientes_data',
            'treeGrid': {
                'left': 14,
                'expandIcon': '<span><i class="fa fa-plus"></i></span>',
                'collapseIcon': '<span><i class="fa fa-minus"></i></span>',
            }
        });
    }

    function load_tipo_empresa() {
        $.ajax({
            url: "tipo_empresa_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        let status = '';
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditTipoEmpresa" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusTipoEmpresa" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_tipos_empresas")) {
                        $("#tbl_tipos_empresas").DataTable().destroy();
                    }

                    $("#tbl_tipos_empresas tbody").empty();

                    $("#tbl_tipos_empresas tbody").html(html);

                    $("#tbl_tipos_empresas").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    function load_tipo_regimen() {
        $.ajax({
            url: "tipo_regimen_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        let status = '';
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].code + '</td>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditTipoRegimen" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '" data-code="' + data[i].code + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusTipoRegimen" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_tipos_regimenes")) {
                        $("#tbl_tipos_regimenes").DataTable().destroy();
                    }

                    $("#tbl_tipos_regimenes tbody").empty();

                    $("#tbl_tipos_regimenes tbody").html(html);

                    $("#tbl_tipos_regimenes").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    function load_tipo_documento() {
        $.ajax({
            url: "tipo_documento_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        let status = '';
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditTipoDocumento" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusTipoDocumento" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_tipos_documentos")) {
                        $("#tbl_tipos_documentos").DataTable().destroy();
                    }

                    $("#tbl_tipos_documentos tbody").empty();

                    $("#tbl_tipos_documentos tbody").html(html);

                    $("#tbl_tipos_documentos").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    function load_actividad_economica() {
        $.ajax({
            url: "actividades_economicas_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        let status = '';
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].code + '</td>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditActividadEconomica" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '" data-code="' + data[i].code + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusActividadEconomica" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_actividades_economicas")) {
                        $("#tbl_actividades_economicas").DataTable().destroy();
                    }

                    $("#tbl_actividades_economicas tbody").empty();

                    $("#tbl_actividades_economicas tbody").html(html);

                    $("#tbl_actividades_economicas").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    function load_ciudades() {
        $.ajax({
            url: "ciudades_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        let status = '';
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].departamento + '</td>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditCiudad" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '" data-departamento="' + data[i].departamento_id + '" data-codigo_postal="' + data[i].codigo_postal + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusCiudad" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_ciudades")) {
                        $("#tbl_ciudades").DataTable().destroy();
                    }

                    $("#tbl_ciudades tbody").empty();

                    $("#tbl_ciudades tbody").html(html);

                    $("#tbl_ciudades").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    function load_formas_pago() {
        $.ajax({
            url: "formas_pago_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        let status = '';
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditFormaPago" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusFormaPago" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_formas_pago")) {
                        $("#tbl_formas_pago").DataTable().destroy();
                    }

                    $("#tbl_formas_pago tbody").empty();

                    $("#tbl_formas_pago tbody").html(html);

                    $("#tbl_formas_pago").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    function load_centros_costos() {
        $.ajax({
            url: "centros_costos_data",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    var data = response.data;
                    var html = '';

                    for (let i = 0; i < data.length; i++) {
                        data[i].created_at = new Date(data[i].created_at);
                        data[i].created_at = data[i].created_at.toLocaleDateString('es-CO') + ' ' + data[i].created_at.toLocaleTimeString('es-CO');
                        let status = '';
                        if (data[i].status == 1) {
                            status = '<span class="badge bg-success side-badge">Activo</span>';
                        } else {
                            status = '<span class="badge bg-danger side-badge">Inactivo</span>';
                        }
                        html += '<tr>';
                        html += '<td>' + data[i].code + '</td>';
                        html += '<td>' + data[i].nombre + '</td>';
                        html += '<td>' + data[i].creador + '</td>';
                        html += '<td>' + data[i].created_at + '</td>';
                        html += '<td>' + status + '</td>';
                        html += '<td class="text-center">';
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditCentroCosto" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '" data-code="' + data[i].code + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning btnStatusCentroCosto" title="Cambiar Status" data-id="' + data[i].id + '" data-status="' + data[i].status + '"><i class="fa fa-times"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    if ($.fn.DataTable.isDataTable("#tbl_centros_costos")) {
                        $("#tbl_centros_costos").DataTable().destroy();
                    }

                    $("#tbl_centros_costos tbody").empty();

                    $("#tbl_centros_costos tbody").html(html);

                    $("#tbl_centros_costos").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al cargar la información");

                }
                $("#tipo_empresa").html(data);
            },
            error: function (data) {
                toastr.error("Error al cargar la información");
                console.log(data);
            },
        });
    }

    //ACTIVIDADES ECONOMICAS
    $(document).on("click", "#btnAddActividadEconomica", function () {
        let code = $("#codigo_add_actividadecono").val();
        let name = $("#actividad_economica_add_actividadecono").val();

        if (code.trim().length == 0) {
            toastr.error("El código es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddActividadEconomica").attr("disabled", true);
            $("#btnAddActividadEconomica").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_actividad_economica",
                type: "POST",
                dataType: "json",
                data: {
                    code: code,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Actividad económica agregada correctamente");
                        $("#codigo_add_actividadecono").val('');
                        $("#actividad_economica_add_actividadecono").val('');
                        load_actividad_economica();
                    } else {
                        toastr.error("Error al agregar la actividad económica");
                    }
                    $("#btnAddActividadEconomica").attr("disabled", false);
                    $("#btnAddActividadEconomica").html("Agregar Actividad Económica");
                },
                error: function (data) {
                    $("#btnAddActividadEconomica").attr("disabled", false);
                    $("#btnAddActividadEconomica").html("Agregar Actividad Económica");
                    toastr.error("Error al agregar la actividad económica");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditActividadEconomica", function () {
        let id = $(this).data("id");
        let code = $(this).data("code");
        let name = $(this).data("nombre");

        $("#id_edit_actividadecono").val(id);
        $("#codigo_edit_actividadecono").val(code);
        $("#actividad_economica_edit_actividadecono").val(name);
        $("#modalEditActividadEconomica").modal("show");
    });

    $(document).on("click", "#btnEditActividadEconomica", function () {
        let id = $("#id_edit_actividadecono").val();
        let code = $("#codigo_edit_actividadecono").val();
        let name = $("#actividad_economica_edit_actividadecono").val();

        if (code.trim().length == 0) {
            toastr.error("El código es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditActividadEconomica").attr("disabled", true);
            $("#btnEditActividadEconomica").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_actividad_economica",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    code: code,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_actividad_economica();
                        $("#modalEditActividadEconomica").modal("hide");
                        $("#id_edit_actividadecono").val('');
                        $("#codigo_edit_actividadecono").val('');
                        $("#actividad_economica_edit_actividadecono").val('');
                        toastr.success("Actividad económica actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la actividad económica");
                    }
                    $("#btnEditActividadEconomica").attr("disabled", false);
                    $("#btnEditActividadEconomica").html("Actualizar Actividad Económica");
                },
                error: function (data) {
                    $("#btnEditActividadEconomica").attr("disabled", false);
                    $("#btnEditActividadEconomica").html("Actualizar Actividad Económica");
                    toastr.error("Error al actualizar la actividad económica");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusActividadEconomica", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusActividadEconomica").attr("disabled", true);
        $(".btnStatusActividadEconomica").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_actividad_economica",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_actividad_economica();
                    toastr.success("Actividad económica actualizada correctamente");
                } else {
                    $(".btnStatusActividadEconomica").attr("disabled", false);
                    $(".btnStatusActividadEconomica").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar la actividad económica");
                }
            },
            error: function (data) {
                $(".btnStatusActividadEconomica").attr("disabled", false);
                $(".btnStatusActividadEconomica").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar la actividad económica");
                console.log(data);
            },
        });
    });

    //TIPOS DOCUMENTOS
    $(document).on("click", "#btnAddTipoDocumento", function () {
        let name = $("#tipo_documento_add_tipodoc").val();

        if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddTipoDocumento").attr("disabled", true);
            $("#btnAddTipoDocumento").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_tipo_documento",
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_tipo_documento();
                        $("#tipo_documento_add_tipodoc").val('');
                        toastr.success("Tipo de documento agregado correctamente");
                    } else {
                        toastr.error("Error al agregar el tipo de documento");
                    }
                    $("#btnAddTipoDocumento").attr("disabled", false);
                    $("#btnAddTipoDocumento").html("Agregar Tipo Documento");
                },
                error: function (data) {
                    $("#btnAddTipoDocumento").attr("disabled", false);
                    $("#btnAddTipoDocumento").html("Agregar Tipo Documento");
                    toastr.error("Error al agregar el tipo de documento");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditTipoDocumento", function () {
        let id = $(this).data("id");
        let name = $(this).data("nombre");

        $("#id_edit_tipodoc").val(id);
        $("#tipo_documento_edit_tipodoc").val(name);
        $("#modalEditTipoDocumento").modal("show");
    });

    $(document).on("click", "#btnEditTipoDocumento", function () {
        let id = $("#id_edit_tipodoc").val();
        let name = $("#tipo_documento_edit_tipodoc").val();

        if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditTipoDocumento").attr("disabled", true);
            $("#btnEditTipoDocumento").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_tipo_documento",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_tipo_documento();
                        $("#modalEditTipoDocumento").modal("hide");
                        $("#id_edit_tipodoc").val('');
                        $("#tipo_documento_edit_tipodoc").val('');
                        toastr.success("Tipo de documento actualizado correctamente");
                    } else {
                        toastr.error("Error al actualizar el tipo de documento");
                    }
                    $("#btnEditTipoDocumento").attr("disabled", false);
                    $("#btnEditTipoDocumento").html("Actualizar Tipo Documento");
                },
                error: function (data) {
                    $("#btnEditTipoDocumento").attr("disabled", false);
                    $("#btnEditTipoDocumento").html("Actualizar Tipo Documento");
                    toastr.error("Error al actualizar el tipo de documento");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusTipoDocumento", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusTipoDocumento").attr("disabled", true);
        $(".btnStatusTipoDocumento").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_tipo_documento",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_tipo_documento();
                    toastr.success("Tipo de documento actualizado correctamente");
                } else {
                    $(".btnStatusTipoDocumento").attr("disabled", false);
                    $(".btnStatusTipoDocumento").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar el tipo de documento");
                }
            },
            error: function (data) {
                $(".btnStatusTipoDocumento").attr("disabled", false);
                $(".btnStatusTipoDocumento").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar el tipo de documento");
                console.log(data);
            },
        });
    });

    //TIPOS REGIMENES
    $(document).on("click", "#btnAddTipoRegimen", function () {
        let code = $("#codigo_add_tiporegi").val();
        let name = $("#tipo_regimen_add_tiporegi").val();

        if (code.trim().length == 0) {
            toastr.error("El código es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddTipoRegimen").attr("disabled", true);
            $("#btnAddTipoRegimen").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_tipo_regimen",
                type: "POST",
                dataType: "json",
                data: {
                    code: code,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_tipo_regimen();
                        $("#codigo_add_tiporegi").val('');
                        $("#tipo_regimen_add_tiporegi").val('');
                        toastr.success("Tipo de régimen agregado correctamente");
                    } else {
                        toastr.error("Error al agregar el tipo de régimen");
                    }
                    $("#btnAddTipoRegimen").attr("disabled", false);
                    $("#btnAddTipoRegimen").html("Agregar Tipo Régimen");
                },
                error: function (data) {
                    $("#btnAddTipoRegimen").attr("disabled", false);
                    $("#btnAddTipoRegimen").html("Agregar Tipo Régimen");
                    toastr.error("Error al agregar el tipo de régimen");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditTipoRegimen", function () {
        let id = $(this).data("id");
        let code = $(this).data("code");
        let name = $(this).data("nombre");

        $("#id_edit_tiporegi").val(id);
        $("#codigo_edit_tiporegi").val(code);
        $("#tipo_regimen_edit_tiporegi").val(name);
        $("#modalEditTipoRegimen").modal("show");
    });

    $(document).on("click", "#btnEditTipoRegimen", function () {
        let id = $("#id_edit_tiporegi").val();
        let code = $("#codigo_edit_tiporegi").val();
        let name = $("#tipo_regimen_edit_tiporegi").val();

        if (code.trim().length == 0) {
            toastr.error("El código es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditTipoRegimen").attr("disabled", true);
            $("#btnEditTipoRegimen").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_tipo_regimen",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    code: code,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_tipo_regimen();
                        $("#codigo_edit_tiporegi").val('');
                        $("#tipo_regimen_edit_tiporegi").val('');
                        $("#modalEditTipoRegimen").modal("hide");
                        toastr.success("Tipo de régimen actualizado correctamente");
                    } else {
                        toastr.error("Error al actualizar el tipo de régimen");
                    }
                    $("#btnEditTipoRegimen").attr("disabled", false);
                    $("#btnEditTipoRegimen").html("Actualizar Tipo Régimen");
                },
                error: function (data) {
                    $("#btnEditTipoRegimen").attr("disabled", false);
                    $("#btnEditTipoRegimen").html("Actualizar Tipo Régimen");
                    toastr.error("Error al actualizar el tipo de régimen");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusTipoRegimen", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusTipoRegimen").attr("disabled", true);
        $(".btnStatusTipoRegimen").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_tipo_regimen",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_tipo_regimen();
                    toastr.success("Tipo de régimen actualizado correctamente");
                } else {
                    $(".btnStatusTipoRegimen").attr("disabled", false);
                    $(".btnStatusTipoRegimen").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar el tipo de régimen");
                }
            },
            error: function (data) {
                $(".btnStatusTipoRegimen").attr("disabled", false);
                $(".btnStatusTipoRegimen").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar el tipo de régimen");
                console.log(data);
            },
        });
    });

    //TIPOS EMPRESAS
    $(document).on("click", "#btnAddTipoEmpresa", function () {
        let name = $("#tipo_empresa_add_tipoempresa").val();

        if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddTipoEmpresa").attr("disabled", true);
            $("#btnAddTipoEmpresa").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_tipo_empresa",
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_tipo_empresa();
                        $("#tipo_empresa_add_tipoempresa").val('');
                        toastr.success("Tipo de empresa agregado correctamente");
                    } else {
                        toastr.error("Error al agregar el tipo de empresa");
                    }
                    $("#btnAddTipoEmpresa").attr("disabled", false);
                    $("#btnAddTipoEmpresa").html("Agregar Tipo Empresa");
                },
                error: function (data) {
                    $("#btnAddTipoEmpresa").attr("disabled", false);
                    $("#btnAddTipoEmpresa").html("Agregar Tipo Empresa");
                    toastr.error("Error al agregar el tipo de empresa");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditTipoEmpresa", function () {
        let id = $(this).data("id");
        let name = $(this).data("nombre");

        $("#id_edit_tipoempresa").val(id);
        $("#tipo_empresa_edit_tipoempresa").val(name);
        $("#modalEditTipoEmpresa").modal("show");
    });

    $(document).on("click", "#btnEditTipoEmpresa", function () {
        let id = $("#id_edit_tipoempresa").val();
        let name = $("#tipo_empresa_edit_tipoempresa").val();

        if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditTipoEmpresa").attr("disabled", true);
            $("#btnEditTipoEmpresa").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_tipo_empresa",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_tipo_empresa();
                        $("#tipo_empresa_edit_tipoempresa").val('');
                        $("#modalEditTipoEmpresa").modal("hide");
                        toastr.success("Tipo de empresa actualizado correctamente");
                    } else {
                        toastr.error("Error al actualizar el tipo de empresa");
                    }
                    $("#btnEditTipoEmpresa").attr("disabled", false);
                    $("#btnEditTipoEmpresa").html("Actualizar Tipo Empresa");
                },
                error: function (data) {
                    $("#btnEditTipoEmpresa").attr("disabled", false);
                    $("#btnEditTipoEmpresa").html("Actualizar Tipo Empresa");
                    toastr.error("Error al actualizar el tipo de empresa");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusTipoEmpresa", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusTipoEmpresa").attr("disabled", true);
        $(".btnStatusTipoEmpresa").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_tipo_empresa",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_tipo_empresa();
                    toastr.success("Tipo de empresa actualizado correctamente");
                } else {
                    $(".btnStatusTipoEmpresa").attr("disabled", false);
                    $(".btnStatusTipoEmpresa").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar el tipo de empresa");
                }
            },
            error: function (data) {
                $(".btnStatusTipoEmpresa").attr("disabled", false);
                $(".btnStatusTipoEmpresa").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar el tipo de empresa");
                console.log(data);
            },
        });
    });

    //FORMA PAGO
    $(document).on("click", "#btnAddFormaPago", function () {
        let name = $("#forma_pago_add_formaspago").val();

        if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddFormaPago").attr("disabled", true);
            $("#btnAddFormaPago").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_forma_pago",
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_formas_pago();
                        $("#forma_pago_add_formaspago").val('');
                        toastr.success("Forma de pago agregada correctamente");
                    } else {
                        toastr.error("Error al agregar la forma de pago");
                    }
                    $("#btnAddFormaPago").attr("disabled", false);
                    $("#btnAddFormaPago").html("Agregar Forma de Pago");
                },
                error: function (data) {
                    $("#btnAddFormaPago").attr("disabled", false);
                    $("#btnAddFormaPago").html("Agregar Forma de Pago");
                    toastr.error("Error al agregar la forma de pago");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditFormaPago", function () {
        let id = $(this).data("id");
        let name = $(this).data("nombre");

        $("#id_edit_formapago").val(id);
        $("#forma_pago_edit_formaspago").val(name);
        $("#modalEditFormaPago").modal("show");
    });

    $(document).on("click", "#btnEditFormaPago", function () {
        let id = $("#id_edit_formapago").val();
        let name = $("#forma_pago_edit_formaspago").val();

        if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditFormaPago").attr("disabled", true);
            $("#btnEditFormaPago").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_forma_pago",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_formas_pago();
                        $("#forma_pago_edit_formaspago").val('');
                        $("#modalEditFormaPago").modal("hide");
                        toastr.success("Forma de pago actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la forma de pago");
                    }
                    $("#btnEditFormaPago").attr("disabled", false);
                    $("#btnEditFormaPago").html("Actualizar Forma de Pago");
                },
                error: function (data) {
                    $("#btnEditFormaPago").attr("disabled", false);
                    $("#btnEditFormaPago").html("Actualizar Forma de Pago");
                    toastr.error("Error al actualizar la forma de pago");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusFormaPago", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusFormaPago").attr("disabled", true);
        $(".btnStatusFormaPago").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_forma_pago",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_formas_pago();
                    toastr.success("Forma de pago actualizada correctamente");
                } else {
                    $(".btnStatusFormaPago").attr("disabled", false);
                    $(".btnStatusFormaPago").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar la forma de pago");
                }
            },
            error: function (data) {
                $(".btnStatusFormaPago").attr("disabled", false);
                $(".btnStatusFormaPago").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar la forma de pago");
                console.log(data);
            },
        });
    });

    //CIUDADES
    $(document).on("click", "#btnAddCiudad", function () {
        let departamento = $("#departamento_add_ciudad").val();
        let name = $("#ciudad_add_ciudad").val();
        let codigo_postal = $("#cdpostal_add_ciudad").val();

        if (departamento == "") {
            toastr.error("El departamento es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddCiudad").attr("disabled", true);
            $("#btnAddCiudad").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_ciudad",
                type: "POST",
                dataType: "json",
                data: {
                    departamento: departamento,
                    name: name,
                    codigo_postal: codigo_postal,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_ciudades();
                        $("#departamento_add_ciudad").val('').trigger('change');
                        $("#ciudad_add_ciudad").val('');
                        $("#cdpostal_add_ciudad").val('');
                        toastr.success("Ciudad agregada correctamente");
                    } else {
                        toastr.error("Error al agregar la ciudad");
                    }
                    $("#btnAddCiudad").attr("disabled", false);
                    $("#btnAddCiudad").html("Agregar Ciudad");
                },
                error: function (data) {
                    $("#btnAddCiudad").attr("disabled", false);
                    $("#btnAddCiudad").html("Agregar Ciudad");
                    toastr.error("Error al agregar la ciudad");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditCiudad", function () {
        let id = $(this).data("id");
        let departamento = $(this).data("departamento");
        let name = $(this).data("nombre");
        let codigo_postal = $(this).data("codigo_postal");

        $("#id_edit_ciudad").val(id);
        $("#departamento_edit_ciudad").val(departamento).trigger("change");
        $("#ciudad_edit_ciudad").val(name);
        $("#cdpostal_edit_ciudad").val(codigo_postal);
        $("#modalEditCiudad").modal("show");
    });

    $(document).on("click", "#btnEditCiudad", function () {
        let id = $("#id_edit_ciudad").val();
        let departamento = $("#departamento_edit_ciudad").val();
        let name = $("#ciudad_edit_ciudad").val();
        let codigo_postal = $("#cdpostal_edit_ciudad").val();

        if (departamento == "") {
            toastr.error("El departamento es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditCiudad").attr("disabled", true);
            $("#btnEditCiudad").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_ciudad",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    departamento: departamento,
                    name: name,
                    codigo_postal: codigo_postal,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_ciudades();
                        $("#departamento_edit_ciudad").val('');
                        $("#ciudad_edit_ciudad").val('');
                        $("#modalEditCiudad").modal("hide");
                        toastr.success("Ciudad actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la ciudad");
                    }
                    $("#btnEditCiudad").attr("disabled", false);
                    $("#btnEditCiudad").html("Actualizar Ciudad");
                },
                error: function (data) {
                    $("#btnEditCiudad").attr("disabled", false);
                    $("#btnEditCiudad").html("Actualizar Ciudad");
                    toastr.error("Error al actualizar la ciudad");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusCiudad", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusCiudad").attr("disabled", true);
        $(".btnStatusCiudad").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_ciudad",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_ciudades();
                    toastr.success("Ciudad actualizada correctamente");
                } else {
                    $(".btnStatusCiudad").attr("disabled", false);
                    $(".btnStatusCiudad").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar la ciudad");
                }
            },
            error: function (data) {
                $(".btnStatusCiudad").attr("disabled", false);
                $(".btnStatusCiudad").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar la ciudad");
                console.log(data);
            },
        });
    });

    //CENTROS COSTOS
    $(document).on("click", "#btnAddCentroCosto", function () {
        let code = $("#codigo_add_centrocosto").val();
        let name = $("#tipo_regimen_add_centrocosto").val();

        if (code.trim().length == 0) {
            toastr.error("El código es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnAddCentroCosto").attr("disabled", true);
            $("#btnAddCentroCosto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_centros_costos",
                type: "POST",
                dataType: "json",
                data: {
                    code: code,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_centros_costos();
                        $("#codigo_add_centrocosto").val('');
                        $("#tipo_regimen_add_centrocosto").val('');
                        toastr.success("Centro de costo agregado correctamente");
                    } else {
                        toastr.error("Error al agregar el centro de costo");
                    }
                    $("#btnAddCentroCosto").attr("disabled", false);
                    $("#btnAddCentroCosto").html("Agregar Centro Costo");
                },
                error: function (data) {
                    $("#btnAddCentroCosto").attr("disabled", false);
                    $("#btnAddCentroCosto").html("Agregar Centro Costo");
                    toastr.error("Error al agregar el centro de costo");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnEditCentroCosto", function () {
        let id = $(this).data("id");
        let code = $(this).data("code");
        let name = $(this).data("nombre");

        $("#id_edit_centrocosto").val(id);
        $("#codigo_edit_centrocosto").val(code);
        $("#tipo_regimen_edit_centrocosto").val(name);
        $("#modalEditCentroCosto").modal("show");
    });

    $(document).on("click", "#btnEditCentroCosto", function () {
        let id = $("#id_edit_centrocosto").val();
        let code = $("#codigo_edit_centrocosto").val();
        let name = $("#tipo_regimen_edit_centrocosto").val();

        if (code.trim().length == 0) {
            toastr.error("El código es obligatorio");
            return false;
        } else if (name.trim().length == 0) {
            toastr.error("El nombre es obligatorio");
            return false;
        } else {
            $("#btnEditCentroCosto").attr("disabled", true);
            $("#btnEditCentroCosto").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "edit_centros_costos",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    code: code,
                    name: name,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_centros_costos();
                        $("#id_edit_centrocosto").val('');
                        $("#codigo_edit_centrocosto").val('');
                        $("#tipo_regimen_edit_centrocosto").val('');
                        $("#modalEditCentroCosto").modal("hide");
                        toastr.success("Centro de costo actualizado correctamente");
                    } else {
                        toastr.error("Error al actualizar el centro de costo");
                    }
                    $("#btnEditCentroCosto").attr("disabled", false);
                    $("#btnEditCentroCosto").html("Actualizar Centro Costo");
                },
                error: function (data) {
                    $("#btnEditCentroCosto").attr("disabled", false);
                    $("#btnEditCentroCosto").html("Actualizar Centro Costo");
                    toastr.error("Error al actualizar el centro de costo");
                    console.log(data);
                },
            });
        }
    });

    $(document).on("click", ".btnStatusCentroCosto", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        $(".btnStatusCentroCosto").attr("disabled", true);
        $(".btnStatusCentroCosto").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: "status_centros_costos",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {
                if (response.info == 1) {
                    load_centros_costos();
                    toastr.success("Centro de costo actualizado correctamente");
                } else {
                    $(".btnStatusCentroCosto").attr("disabled", false);
                    $(".btnStatusCentroCosto").html('<i class="fa fa-times"></i>');
                    toastr.error("Error al actualizar el centro de costo");
                }
            },
            error: function (data) {
                $(".btnStatusCentroCosto").attr("disabled", false);
                $(".btnStatusCentroCosto").html('<i class="fa fa-times"></i>');
                toastr.error("Error al actualizar el centro de costo");
                console.log(data);
            },
        });
    });

    //ORGANIZACION
    $("#tipo_doc_organizacion").on("change", function () {
        var tipo_doc = $(this).val();
        if (tipo_doc == 5) {
            $("#digito_verifi_organizacion").parent().removeClass("d-none");
        } else {
            $("#digito_verifi_organizacion").parent().addClass("d-none");
        }
    });

    $("#actividades_tribu_organizacion").change(function () {
        let value = $(this).val();

        if (value.length > 4) {
            toastr.error("Solo se permiten 4 actividades tributarias");
            value.pop();
            $(this).val(value).trigger('change');
        }
    });

    $("#btnModificarOrganizacion1").on("click", function () {
        let tipo_empresa = $("#tipo_empresa_organizacion").val();
        let organizacion = $("#nombre_organizacion").val();
        let tipo_documento = $("#tipo_doc_organizacion").val();
        let documento = $("#documento_organizacion").val();
        let digito = $("#digito_verifi_organizacion").val();
        let ciudad = $("#ciudad_organizacion").val();
        let direccion = $("#direccion_organizacion").val();
        let tipo_regimen = $("#tipo_regimen_organizacion").val();
        let telefono = $("#telefono_organizacion").val();
        let contacto = $("#contacto_organizacion").val();
        let email_contacto = $("#email_contacto_organizacion").val();
        let pagina_web = $("#pagina_web_organizacion").val();
        let avatar = $("#avatar_organizacion").val();

        if (tipo_empresa == "") {
            toastr.error("El tipo de empresa es obligatorio");
            return false;
        } else if (organizacion.trim().length == 0) {
            toastr.error("El nombre de la organización es obligatorio");
            return false;
        } else if (tipo_documento == "") {
            toastr.error("El tipo de documento es obligatorio");
            return false;
        } else if (documento.trim().length == 0) {
            toastr.error("El documento es obligatorio");
            return false;
        } else if (ciudad == "") {
            toastr.error("La ciudad es obligatoria");
            return false;
        } else if (tipo_regimen == "") {
            toastr.error("El tipo de régimen es obligatorio");
            return false;
        } else if (telefono.trim().length == 0) {
            toastr.error("El teléfono es obligatorio");
            return false;
        } else if (contacto.trim().length == 0) {
            toastr.error("El contacto es obligatorio");
            return false;
        } else if (email_contacto.trim().length == 0) {
            toastr.error("El email de contacto es obligatorio");
            return false;
        } else {

            var formData = new FormData();
            formData.append("tipo", 1);
            formData.append("tipo_empresa", tipo_empresa);
            formData.append("organizacion", organizacion);
            formData.append("tipo_documento", tipo_documento);
            formData.append("documento", documento);
            formData.append("digito", digito);
            formData.append("ciudad", ciudad);
            formData.append("direccion", direccion);
            formData.append("tipo_regimen", tipo_regimen);
            formData.append("telefono", telefono);
            formData.append("contacto", contacto);
            formData.append("email_contacto", email_contacto);
            formData.append("pagina_web", pagina_web);
            formData.append("avatar", $("#avatar_organizacion")[0].files[0]);

            $("#btnModificarOrganizacion1").attr("disabled", true);
            $("#btnModificarOrganizacion1").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );

            $.ajax({
                url: "edit_organizacion",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        if ($("#avatar_organizacion") != "") {
                            $("#avatar_organizacion").val("");
                            $("#img_organizacion").attr("src", 'images/logo_organizacion/' + response.avatar);
                        }
                        toastr.success("Organización actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la organización");
                    }
                    $("#btnModificarOrganizacion1").attr("disabled", false);
                    $("#btnModificarOrganizacion1").html("Actualizar Información");
                },
                error: function (data) {
                    $("#btnModificarOrganizacion1").attr("disabled", false);
                    $("#btnModificarOrganizacion1").html("Actualizar Información");
                    toastr.error("Error al actualizar la organización");
                    console.log(data);
                }
            });
        }
    });

    $("#btnModificarOrganizacion2").on("click", function () {
        let actividades = $("#actividades_tribu_organizacion").val();
        let ica = $("#ica_tribu_organizacion").val();
        let aiu = $("#maneja_aiu_tribu_organizacion").val();
        let impuestos = $("#nimpuestos_tribu_organizacion").val();
        let iva = $("#retenedor_tribu_organizacion").val();
        let valorem = $("#impuesto_valorem_tribu_organizacion").val();
        let responsabilidad_fiscal = $("#responsabilidades_tribu_organizacion").val();
        let tributos = $("#tributos_tribu_organizacion").val();

        if (actividades.length < 1) {
            toastr.error("Las actividades tributarias son obligatorias");
            return false;
        } else {
            $("#btnModificarOrganizacion2").attr("disabled", true);
            $("#btnModificarOrganizacion2").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            var formData = new FormData();
            formData.append("tipo", 2);
            formData.append("actividades", actividades);
            formData.append("ica", ica);
            formData.append("aiu", aiu);
            formData.append("impuestos", impuestos);
            formData.append("iva", iva);
            formData.append("valorem", valorem);
            formData.append("responsabilidad_fiscal", responsabilidad_fiscal);
            formData.append("tributos", tributos);
            formData.append("anexo_dian", $("#anexo_dian_organizacion")[0].files[0]);

            $.ajax({
                url: "edit_organizacion",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        if ($("#anexo_dian_organizacion") != "") {
                            $("#anexo_dian_organizacion").val("");
                            $("#link_anexo_dian").attr("href", 'images/anexos_organizacion/' + response.anexo);
                            $("#link_anexo_dian").parent().parent().removeClass("d-none");
                        }
                        toastr.success("Organización actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la organización");
                    }
                    $("#btnModificarOrganizacion2").attr("disabled", false);
                    $("#btnModificarOrganizacion2").html("Actualizar Información");
                },
                error: function (data) {
                    $("#btnModificarOrganizacion2").attr("disabled", false);
                    $("#btnModificarOrganizacion2").html("Actualizar Información");
                    toastr.error("Error al actualizar la organización");
                    console.log(data);
                }
            });
        }
    });

    $("#btnModificarOrganizacion3").on("click", function () {
        let nombres = $("#nombres_repre_organizacion").val();
        let apellidos = $("#apellidos_repre_organizacion").val();
        let tipo_documento = $("#tipo_doc_repre_organizacion").val();
        let documento = $("#documento_repre_organizacion").val();

        if (nombres.trim().length == 0) {
            toastr.error("El nombre del representante es obligatorio");
            return false;
        } else if (apellidos.trim().length == 0) {
            toastr.error("El apellido del representante es obligatorio");
            return false;
        } else if (tipo_documento == "") {
            toastr.error("El tipo de documento del representante es obligatorio");
            return false;
        } else if (documento.trim().length == 0) {
            toastr.error("El documento del representante es obligatorio");
            return false;
        } else {
            $("#btnModificarOrganizacion3").attr("disabled", true);
            $("#btnModificarOrganizacion3").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            var formData = new FormData();
            formData.append("tipo", 3);
            formData.append("nombres", nombres);
            formData.append("apellidos", apellidos);
            formData.append("tipo_documento", tipo_documento);
            formData.append("documento", documento);

            $.ajax({
                url: "edit_organizacion",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Organización actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la organización");
                    }
                    $("#btnModificarOrganizacion3").attr("disabled", false);
                    $("#btnModificarOrganizacion3").html("Actualizar Información");
                },
                error: function (data) {
                    $("#btnModificarOrganizacion3").attr("disabled", false);
                    $("#btnModificarOrganizacion3").html("Actualizar Información");
                    toastr.error("Error al actualizar la organización");
                    console.log(data);
                }
            });
        }
    });

    $("#btnModificarOrganizacion4").on("click", function () {
        let nombres = $("#nombres_represuple_organizacion").val();
        let apellidos = $("#apellidos_represuple_organizacion").val();
        let tipo_documento = $("#tipo_doc_represuple_organizacion").val();
        let documento = $("#documento_represuple_organizacion").val();

        if (nombres.trim().length == 0) {
            toastr.error("El nombre del representante suplente es obligatorio");
            return false;
        } else if (apellidos.trim().length == 0) {
            toastr.error("El apellido del representante suplente es obligatorio");
            return false;
        } else if (tipo_documento == "") {
            toastr.error("El tipo de documento del representante suplente es obligatorio");
            return false;
        } else if (documento.trim().length == 0) {
            toastr.error("El documento del representante suplente es obligatorio");
            return false;
        } else {
            $("#btnModificarOrganizacion4").attr("disabled", true);
            $("#btnModificarOrganizacion4").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            var formData = new FormData();
            formData.append("tipo", 4);
            formData.append("nombres_suplente", nombres);
            formData.append("apellidos_suplente", apellidos);
            formData.append("tipo_documento_suplente", tipo_documento);
            formData.append("documento_suplente", documento);

            $.ajax({
                url: "edit_organizacion",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Organización actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la organización");
                    }
                    $("#btnModificarOrganizacion4").attr("disabled", false);
                    $("#btnModificarOrganizacion4").html("Actualizar Información");
                },
                error: function (data) {
                    $("#btnModificarOrganizacion4").attr("disabled", false);
                    $("#btnModificarOrganizacion4").html("Actualizar Información");
                    toastr.error("Error al actualizar la organización");
                    console.log(data);
                }
            });
        }
    });

    $("#btnModificarOrganizacion5").on("click", function () {
        let nombres = $("#nombres_contador_organizacion").val();
        let apellidos = $("#apellidos_contador_organizacion").val();
        let tipo_documento = $("#tipo_doc_contador_organizacion").val();
        let documento = $("#documento_contador_organizacion").val();

        if (nombres.trim().length == 0) {
            toastr.error("El nombre del contador es obligatorio");
            return false;
        } else if (apellidos.trim().length == 0) {
            toastr.error("El apellido del contador es obligatorio");
            return false;
        } else if (tipo_documento == "") {
            toastr.error("El tipo de documento del contador es obligatorio");
            return false;
        } else if (documento.trim().length == 0) {
            toastr.error("El documento del contador es obligatorio");
            return false;
        } else {
            $("#btnModificarOrganizacion5").attr("disabled", true);
            $("#btnModificarOrganizacion5").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            var formData = new FormData();
            formData.append("tipo", 5);
            formData.append("nombres", nombres);
            formData.append("apellidos", apellidos);
            formData.append("tipo_documento", tipo_documento);
            formData.append("documento", documento);

            $.ajax({
                url: "edit_organizacion",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Organización actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la organización");
                    }
                    $("#btnModificarOrganizacion5").attr("disabled", false);
                    $("#btnModificarOrganizacion5").html("Actualizar Información");
                },
                error: function (data) {
                    $("#btnModificarOrganizacion5").attr("disabled", false);
                    $("#btnModificarOrganizacion5").html("Actualizar Información");
                    toastr.error("Error al actualizar la organización");
                    console.log(data);
                }
            });
        }
    });

    $("#btnModificarOrganizacion6").on("click", function () {
        let nombres = $("#nombres_revisor_organizacion").val();
        let apellidos = $("#apellidos_revisor_organizacion").val();
        let tipo_documento = $("#tipo_doc_revisor_organizacion").val();
        let documento = $("#documento_revisor_organizacion").val();

        if (nombres.trim().length == 0) {
            toastr.error("El nombre del revisor fiscal es obligatorio");
            return false;
        } else if (apellidos.trim().length == 0) {
            toastr.error("El apellido del revisor fiscal es obligatorio");
            return false;
        } else if (tipo_documento == "") {
            toastr.error("El tipo de documento del revisor fiscal es obligatorio");
            return false;
        } else if (documento.trim().length == 0) {
            toastr.error("El documento del revisor fiscal es obligatorio");
            return false;
        } else {
            $("#btnModificarOrganizacion6").attr("disabled", true);
            $("#btnModificarOrganizacion6").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            var formData = new FormData();
            formData.append("tipo", 6);
            formData.append("nombres", nombres);
            formData.append("apellidos", apellidos);
            formData.append("tipo_documento", tipo_documento);
            formData.append("documento", documento);

            $.ajax({
                url: "edit_organizacion",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Organización actualizada correctamente");
                    } else {
                        toastr.error("Error al actualizar la organización");
                    }
                    $("#btnModificarOrganizacion6").attr("disabled", false);
                    $("#btnModificarOrganizacion6").html("Actualizar Información");
                },
                error: function (data) {
                    $("#btnModificarOrganizacion6").attr("disabled", false);
                    $("#btnModificarOrganizacion6").html("Actualizar Información");
                    toastr.error("Error al actualizar la organización");
                    console.log(data);
                }
            });
        }
    });

    // CONFIGURACIÓN PUC
    $("#btnDeshabilitarPucConfig").on("click", function () {
        let pucs_seleccionados = tbl_pucs_cliente.rows(".selected").data().toArray();

        if (pucs_seleccionados.length == 0) {
            toastr.error("Debe seleccionar al menos un PUC");
            return false;
        } else {
            Swal.fire({
                title: "¿Está seguro de deshabilitar los PUC seleccionados?",
                text: "No podrá revertir esta acción",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, deshabilitar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    let pucs = [];
                    for (let i = 0; i < pucs_seleccionados.length; i++) {
                        pucs.push(pucs_seleccionados[i].id);
                    }
                    $("#btnDeshabilitarPucConfig").attr("disabled", true);
                    $("#btnDeshabilitarPucConfig").html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deshabilitando...'
                    );
                    $.ajax({
                        url: "deshabilitar_puc_cliente",
                        type: "POST",
                        dataType: "json",
                        data: {
                            pucs: pucs,
                        },
                        success: function (response) {
                            if (response.info == 1) {
                                tbl_pucs_cliente.ajax.reload();
                                toastr.success("PUC deshabilitados correctamente");
                            } else {
                                toastr.error("Error al deshabilitar los PUC");
                            }
                            $("#btnDeshabilitarPucConfig").attr("disabled", false);
                            $("#btnDeshabilitarPucConfig").html("Deshabilitar PUC");
                        },
                        error: function (data) {
                            $("#btnDeshabilitarPucConfig").attr("disabled", false);
                            $("#btnDeshabilitarPucConfig").html("Deshabilitar PUC");
                            toastr.error("Error al deshabilitar los PUC");
                            console.log(data);
                        }
                    });
                }
            });
        }
    });

    $("#btnHabilitarPucConfig").on("click", function () {
        let pucs_seleccionados = tbl_pucs_all_cliente.rows(".selected").data().toArray();

        if (pucs_seleccionados.length == 0) {
            toastr.error("Debe seleccionar al menos un PUC");
            return false;
        } else {
            Swal.fire({
                title: "¿Está seguro de habilitar los PUC seleccionados?",
                text: "No podrá revertir esta acción",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, habilitar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    let pucs = [];
                    for (let i = 0; i < pucs_seleccionados.length; i++) {
                        pucs.push(pucs_seleccionados[i].id);
                    }
                    $("#btnHabilitarPucConfig").attr("disabled", true);
                    $("#btnHabilitarPucConfig").html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Habilitando...'
                    );
                    $.ajax({
                        url: "habilitar_puc_cliente",
                        type: "POST",
                        dataType: "json",
                        data: {
                            pucs: pucs,
                        },
                        success: function (response) {
                            if (response.info == 1) {
                                tbl_pucs_all_cliente.ajax.reload();
                                toastr.success("PUC habilitados correctamente");
                            } else {
                                toastr.error("Error al habilitar los PUC");
                            }
                            $("#btnHabilitarPucConfig").attr("disabled", false);
                            $("#btnHabilitarPucConfig").html("Habilitar PUC");
                        },
                        error: function (data) {
                            $("#btnHabilitarPucConfig").attr("disabled", false);
                            $("#btnHabilitarPucConfig").html("Habilitar PUC");
                            toastr.error("Error al habilitar los PUC");
                            console.log(data);
                        }
                    });
                }
            });
        }
    });

    $("#select_options_config_puc").on("change", function () {
        let option = $(this).val();
        if (option == 1) {
            $("#div_all_config_puc").addClass("d-none");
            $("#puc_config_puc").removeClass("d-none");

            $("#btnHabilitarPucConfig").addClass("d-none");
            $("#btnDeshabilitarPucConfig").removeClass("d-none");
            tbl_pucs_cliente.ajax.reload();
        } else {
            $("#div_all_config_puc").removeClass("d-none");
            $("#puc_config_puc").addClass("d-none");

            $("#btnDeshabilitarPucConfig").addClass("d-none");
            $("#btnHabilitarPucConfig").removeClass("d-none");
            tbl_pucs_all_cliente.ajax.reload();
        }
    });

    $(document).on("click", ".btnAddChildPucCliente", function () {
        let id = $(this).data("id");
        let code = $(this).data("code");
        let nombre = $(this).data("nombre");
        let parent = $(this).data("parent");
        let tr_parent = $(this).closest("tr").attr("parent-index");

        $("#id_parent_puc_cliente").val(parent);
        $("#id_child_puc_cliente").val(id);
        $("#puc_parent_puc_cliente").val(code + " - " + nombre);
        $("#tr_parent_puc_cliente").val(tr_parent);
        $("#code_parent_puc_cliente").val(code);
        $("#modalAddChildPucCliente").modal("show");
    });

    $(document).on("click", ".btnDeleteChildPucCliente", function () {
        let id = $(this).data("id");
        let code = $(this).data("code");
        let context = $(this);

        Swal.fire({
            title: "¿Está seguro de eliminar el auxiliar " + code + "?",
            text: "No podrá revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "delete_child_puc_cliente",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            context.closest("tr").remove();
                            toastr.success("Auxiliar eliminado correctamente");
                        } else {
                            toastr.error("Error al eliminar el auxiliar");
                        }
                    },
                    error: function (data) {
                        toastr.error("Error al eliminar el auxiliar");
                        console.log(data);
                    }
                });
            }
        });
    });

    $(document).on("click", ".btnEditChildPucCliente", function () {
        let id = $(this).data("id");
        let code = $(this).data("code");
        let nombre = $(this).data("nombre");

        $("#id_edit_child_puc_cliente").val(id);
        $("#code_edit_child_puc_cliente").val(code);
        $("#nombre_edit_child_puc_cliente").val(nombre);
        $("#modalEditChildPucCliente").modal("show");
    });

    $("#btnAddChildPucCliente").on("click", function () {
        let id_child = $("#id_child_puc_cliente").val();
        let id_parent = $("#id_parent_puc_cliente").val();
        let tr_parent = $("#tr_parent_puc_cliente").val();

        let code_parent = $("#code_parent_puc_cliente").val();
        let code_child = $("#code_child_puc_cliente").val();

        let nombre = $("#nombre_child_puc_cliente").val();

        if (code_child < 1) {
            toastr.error("El código no puede ser menor a 1");
            return false;
        } else if (nombre.trim().length == 0) {
            toastr.error("El nombre no puede estar vacío");
            return false;
        } else {
            $("#btnAddChildPucCliente").attr("disabled", true);
            $("#btnAddChildPucCliente").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Agregando...'
            );
            $.ajax({
                url: "add_child_puc_cliente",
                type: "POST",
                dataType: "json",
                data: {
                    id_child: id_child,
                    id_parent: id_parent,
                    code_parent: code_parent,
                    code_child: code_child,
                    nombre: nombre,
                },
                success: function (response) {
                    if (response.info == 1) {
                        tbl_pucs_cliente.ajax.reload();

                        $("#code_child_puc_cliente").val("");
                        $("#nombre_child_puc_cliente").val("");
                        $("#modalAddChildPucCliente").modal("hide");
                        toastr.success("Auxiliar agregado correctamente");
                    } else {
                        toastr.error(response.mensaje);
                    }
                    $("#btnAddChildPucCliente").attr("disabled", false);
                    $("#btnAddChildPucCliente").html("Agregar Auxiliar");
                },
                error: function (data) {
                    $("#btnAddChildPucCliente").attr("disabled", false);
                    $("#btnAddChildPucCliente").html("Agregar Auxiliar");
                    toastr.error("Error al agregar el auxiliar");
                    console.log(data);
                }
            });
        }
    });

    $("#btnEditChildPucCliente").on("click", function () {
        let id = $("#id_edit_child_puc_cliente").val();
        let code = $("#code_edit_child_puc_cliente").val();
        let nombre = $("#nombre_edit_child_puc_cliente").val();

        if (code < 1) {
            toastr.error("El código no puede ser menor a 1");
            return false;
        } else if (nombre.trim().length == 0) {
            toastr.error("El nombre no puede estar vacío");
            return false;
        } else {
            $("#btnEditChildPucCliente").attr("disabled", true);
            $("#btnEditChildPucCliente").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Editando...'
            );
            $.ajax({
                url: "edit_child_puc_cliente",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    code: code,
                    nombre: nombre,
                },
                success: function (response) {
                    if (response.info == 1) {
                        let code_final = response.code;
                        let tr = $(document).find(".btnEditChildPucCliente[data-id='" + id + "']").closest("tr");

                        tr.find("td:eq(1)").html(code_final);
                        tr.find("td:eq(2)").html(nombre);
                        $("#modalEditChildPucCliente").modal("hide");
                        toastr.success("Auxiliar editado correctamente");
                    } else {
                        toastr.error("Error al editar el auxiliar");
                    }
                    $("#btnEditChildPucCliente").attr("disabled", false);
                    $("#btnEditChildPucCliente").html("Editar Auxiliar");
                },
                error: function (data) {
                    $("#btnEditChildPucCliente").attr("disabled", false);
                    $("#btnEditChildPucCliente").html("Editar Auxiliar");
                    toastr.error("Error al editar el auxiliar");
                    console.log(data);
                }
            });
        }
    });

    function load_parametrizacion_documentos(documento, tipo_parametrizacion, regimen) {
        $.ajax({
            url: "get_cuentas_parametrizacion",
            type: "POST",
            dataType: "json",
            data: {
                documento: documento,
                tipo_parametrizacion: tipo_parametrizacion,
                regimen: regimen,
            },
            success: function (response) {
                if (response.info == 1) {
                    let cuentas = response.cuentas;
                    let html = "";
                    $("#tbl_cuentas_param tbody").empty();

                    if ($.fn.DataTable.isDataTable("#tbl_cuentas_param")) {
                        $("#tbl_cuentas_param").DataTable().destroy();
                    }

                    $.each(cuentas, function (key, value) {
                        let naturaleza = value.naturaleza == 1 ? "Débito" : "Crédito";
                        let status = value.status == 1 ? "<span class='badge badge-success bg-success'>Activo</span>" : "<span class='badge badge-danger bg-danger'>Inactivo</span>";

                        html += "<tr>";
                        html += "<td>" + value.code + " | " + value.nombre + "</td>";
                        html += "<td>" + naturaleza + "</td>";
                        html += "<td>" + value.created_at + "</td>";
                        html += "<td>" + value.creador + "</td>";
                        html += "<td>" + status + "</td>";
                        html += "<td>";
                        html += '<button type="button" data-id="' + value.id + '" data-status="' + value.status + '" title="Cambiar Status" class="btn btn-warning btn-sm btnStatusParamCuenta" data-id="' + value.id + '"><i class="fas fa-times"></i></button>';
                        html += "</td>";
                        html += "</tr>";
                    });

                    $("#tbl_cuentas_param tbody").html(html);
                    $("#tbl_cuentas_param").DataTable({
                        "responsive": true,
                        "language": language,
                        "order": [],
                    });
                } else {
                    toastr.error("Error al obtener las cuentas");
                }
            },
            error: function (data) {
                toastr.error("Error al obtener las cuentas");
                console.log(data);
            }
        });
    }

    $("#regimen_param_cuenta").on("change", function () {
        let regimen = $(this).val();
        let documento = $("#param_cuenta_val").val();
        let tipo_parametrizacion = $("#tipo_param_cuenta_val").val();

        if (regimen > 0) {
            load_parametrizacion_documentos(documento, tipo_parametrizacion, regimen);
        }
    });

    $("#param_cuenta_select").on("change", function () {
        let valor = $(this).val();

        if (valor > 0) {
            if (valor == 1) {
                $("#param_cuenta_text").html("Documento (Comprobante de egreso");
            } else if (valor == 2) {
                $("#param_cuenta_text").html("Documento (Factura de compra");
            } else if (valor == 3) {
                $("#param_cuenta_text").html("Documento (Factura de venta");
            } else if (valor == 4) {
                $("#param_cuenta_text").html("Documento (Nómina");
            } else if (valor == 5) {
                $("#param_cuenta_text").html("Documento (Recibo de caja");
            }

            $("#param_tipo_cuenta_select").select2('destroy');
            $("#param_tipo_cuenta_select option").prop("disabled", true);

            $(".form-select").each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: "Seleccione una opción",
                    searchInputPlaceholder: "Buscar",
                });
            });

            $("#param_tipo_cuenta_select option[data-factura*='" + valor + "']").prop("disabled", false);
            $("#param_tipo_cuenta_select").val("").trigger("change");

            $("#param_cuenta_val").val(valor);
            $("#modalCuentas").modal("hide");
            $("#modalTipoCuentas").modal("show");
            $("#param_cuenta_select").val("").trigger("change");
        }
    });

    $("#param_tipo_cuenta_select").on("change", function () {
        let text = $(this).find("option:selected").text();
        let valor = $(this).val();

        if (valor > 0) {
            $("#param_cuenta_text").append(" - " + text + ")");
            $("#tipo_param_cuenta_val").val(valor);

            $("#div_general").addClass("d-none");
            $("#div_param_cuentas").removeClass("d-none");
            $("#param_cuenta_select").val("").trigger("change");
            $("#param_tipo_cuenta_select").val("").trigger("change");
            $("#modalTipoCuentas").modal("hide");
        }
    });

    $("#btnAddCuentaParam").on("click", function () {
        let documento = $("#param_cuenta_val").val();
        let tipo_parametrizacion = $("#tipo_param_cuenta_val").val();
        let tipo_regimen = $("#regimen_param_cuenta").val();
        let cuenta = $("#cuenta_param_cuenta").val();
        let naturaleza = $("#naturaleza_param_cuenta").val();

        if (tipo_regimen <= 0) {
            toastr.error("Debe seleccionar un régimen");
            return false;
        } else if (cuenta <= 0) {
            toastr.error("Debe seleccionar una cuenta");
            return false;
        } else if (naturaleza <= 0) {
            toastr.error("Debe seleccionar una naturaleza");
            return false;
        } else {
            $("#btnAddCuentaParam").attr("disabled", true);
            $("#btnAddCuentaParam").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Agregando...'
            );
            $.ajax({
                url: "add_cuenta_parametrizacion",
                type: "POST",
                dataType: "json",
                data: {
                    documento: documento,
                    tipo_parametrizacion: tipo_parametrizacion,
                    tipo_regimen: tipo_regimen,
                    cuenta: cuenta,
                    naturaleza: naturaleza,
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_parametrizacion_documentos(documento, tipo_parametrizacion, tipo_regimen);
                        toastr.success("Parametrización agregada correctamente");
                        $("#cuenta_param_cuenta").val("").trigger("change");
                        $("#naturaleza_param_cuenta").val("").trigger("change");
                    } else {
                        toastr.error("Error al parametrizar el documento");
                    }
                    $("#btnAddCuentaParam").attr("disabled", false);
                    $("#btnAddCuentaParam").html("Agregar Cuenta");
                },
                error: function (data) {
                    $("#btnAddCuentaParam").attr("disabled", false);
                    $("#btnAddCuentaParam").html("Agregar Cuenta");
                    toastr.error("Error al parametrizar la cuenta");
                    console.log(data);
                }
            });
        }
    });

    $(document).on("click", ".btnStatusParamCuenta", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");
        let documento = $("#param_cuenta_val").val();
        let tipo_parametrizacion = $("#tipo_param_cuenta_val").val();
        let tipo_regimen = $("#regimen_param_cuenta").val();

        if (status == 1) {
            status = 0;
        } else {
            status = 1;
        }

        Swal.fire({
            title: "¿Está seguro?",
            text: "Está a punto de cambiar el status de la cuenta",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, cambiar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "update_status_cuenta_parametrizacion",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            load_parametrizacion_documentos(documento, tipo_parametrizacion, tipo_regimen);
                            toastr.success("Status cambiado correctamente");
                        } else {
                            toastr.error("Error al cambiar el status de la cuenta");
                        }
                    },
                    error: function (data) {
                        toastr.error("Error al cambiar el status de la cuenta");
                        console.log(data);
                    }
                });
            }
        });
    });
});