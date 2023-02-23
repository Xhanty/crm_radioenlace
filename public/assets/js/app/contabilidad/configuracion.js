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
    };

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

    $(document).on("click", ".back_to_menu", function () {
        $("#div_general").removeClass("d-none");
        $("#div_organizacion").addClass("d-none");
        $("#div_formas_pago").addClass("d-none");
        $("#div_pucs").addClass("d-none");
        $("#div_clientes").addClass("d-none");
        $("#div_proveedores").addClass("d-none");
        $("#div_empleados").addClass("d-none");
        $("#div_centros_costos").addClass("d-none");
        $("#div_tipos_empresas").addClass("d-none");
        $("#div_tipos_regimenes").addClass("d-none");
        $("#div_actividades_economicas").addClass("d-none");
        $("#div_tipos_documentos").addClass("d-none");
        $("#div_ciudades").addClass("d-none");
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

    //ORGANIZACIÓN
    $("#tipo_doc_organizacion").on("change", function () {
        var tipo_doc = $(this).val();
        if (tipo_doc == 5) {
            $("#digito_verifi_organizacion").parent().removeClass("d-none");
        } else {
            $("#digito_verifi_organizacion").parent().addClass("d-none");
        }
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
                'left': 10,
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
                        html += '<button type="button" class="btn btn-sm btn-primary btnEditCiudad" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '" data-departamento="' + data[i].departamento_id + '"><i class="fa fa-edit"></i></button>&nbsp;';
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
                },
                success: function (response) {
                    if (response.info == 1) {
                        load_ciudades();
                        $("#departamento_add_ciudad").val('');
                        $("#ciudad_add_ciudad").val('');
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

        $("#id_edit_ciudad").val(id);
        $("#departamento_edit_ciudad").val(departamento).trigger("change");
        $("#ciudad_edit_ciudad").val(name);
        $("#modalEditCiudad").modal("show");
    });

    $(document).on("click", "#btnEditCiudad", function () {
        let id = $("#id_edit_ciudad").val();
        let departamento = $("#departamento_edit_ciudad").val();
        let name = $("#ciudad_edit_ciudad").val();

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
    $("#actividades_tribu_organizacion").change(function () {
        let value = $(this).val();

        if(value.length > 4){
            toastr.error("Solo se permiten 4 actividades tributarias");
            value.pop();
            $(this).val(value).trigger('change');
        }
    });
});