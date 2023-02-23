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
    load_tipo_empresa();
    load_tipo_regimen();
    load_tipo_documento();
    load_actividad_economica();
    load_ciudades();
    load_formas_pago();

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
                        html += '<button type="button" class="btn btn-sm btn-primary" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning" title="Cambiar Status" data-id="' + data[i].id + '"><i class="fa fa-times"></i></button>';
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
                        html += '<button type="button" class="btn btn-sm btn-primary" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning" title="Cambiar Status" data-id="' + data[i].id + '"><i class="fa fa-times"></i></button>';
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
                        html += '<button type="button" class="btn btn-sm btn-primary" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning" title="Cambiar Status" data-id="' + data[i].id + '"><i class="fa fa-times"></i></button>';
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
                        html += '<button type="button" class="btn btn-sm btn-primary" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning" title="Cambiar Status" data-id="' + data[i].id + '"><i class="fa fa-times"></i></button>';
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
                        html += '<button type="button" class="btn btn-sm btn-primary" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning" title="Cambiar Status" data-id="' + data[i].id + '"><i class="fa fa-times"></i></button>';
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
                        html += '<button type="button" class="btn btn-sm btn-primary" title="Modificar" data-id="' + data[i].id + '" data-nombre="' + data[i].nombre + '"><i class="fa fa-edit"></i></button>&nbsp;';
                        html += '<button type="button" class="btn btn-sm btn-warning" title="Cambiar Status" data-id="' + data[i].id + '"><i class="fa fa-times"></i></button>';
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
});