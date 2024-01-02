$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    let data_user = JSON.parse(localStorage.getItem("user"));

    $(".name_user_val").text(data_user.nombre);
    $(".cargo_user_val").text(data_user.cargo);

    let url = window.location.href;
    $("a[href='" + url + "']").addClass("active");
    $("a[href='" + url + "']")
        .parent("li")
        .parent("ul")
        .addClass("open");
    $("a[href='" + url + "']")
        .parent("li")
        .parent("ul")
        .parent("li")
        .addClass("is-expanded");

    $(document).on("click", ".btn_logout_sesion", function () {
        $.ajax({
            url: "logout_user",
            type: "POST",
            dataType: "json",
            success: function (data) {
                toastr.success("Hasta pronto!");
                localStorage.removeItem("user");
                localStorage.removeItem("notification_bienvenida");
                setTimeout(function () {
                    window.location.href = "/";
                }, 1000);
            },
            error: function (data) {
                toastr.error("Error al cerrar la sesión, recarga la página");
            },
        });
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

    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-bottom-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    
    $(".form-select").each(function () {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: "Seleccione una opción",
            searchInputPlaceholder: "Buscar",
            allowClear: true,
        });        
    });

    $(document).on('select2:open', function (e) {
        window.setTimeout(function () {
            document.querySelector('input.select2-search__field').focus();
        }, 0);
    });

    //______Basic Data Table
    var table_ll = $(".basic-datatable-t").DataTable({
        responsive: true,
        language: language,
        order: [],
    });

    $("#table_vehiculos_img").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [],
        ajax: "vehiculos_list",
        columns: [
            {
                data: "foto",
                render: function (data) {
                    if (data == null || data == "") {
                        return '<img src="assets/img/sin_imagen.jpg" loading="lazy" id="img_tbl_resize" />';
                    } else {
                        return (
                            '<img src="' +
                            url_general +
                            "images/vehiculos/" +
                            data +
                            '" loading="lazy" id="img_tbl_resize">'
                        );
                    }
                },
            },
            { data: "placa", name: "placa" },
            { data: "marca", name: "marca" },
            { data: "modelo", name: "modelo" },
            //{ data: "year", name: "year" },
            {
                data: "estado",
                render: function (data) {
                    if (data == 1) {
                        return '<span class="badge bg-success side-badge">Activo</span>';
                    } else {
                        return '<span class="badge bg-danger side-badge">Inactivo</span>';
                    }
                },
            },
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
        language: language,
    });

    $("#table_productos_img").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [],
        ajax: "productos_list",
        columns: [
            {
                data: "imagen",
                render: function (data) {
                    if (data == null || data == "") {
                        return '<img src="assets/img/sin_imagen.jpg" loading="lazy" id="img_tbl_resize" />';
                    } else {
                        return (
                            '<img src="' +
                            url_general +
                            "images/productos/" +
                            data +
                            '" loading="lazy" id="img_tbl_resize">'
                        );
                    }
                },
            },
            { data: "cod_producto", name: "cod_producto" },
            { data: "nombre", name: "nombre" },
            { data: "categoria", name: "categoria" },
            { data: "subcategoria", name: "subcategoria" },
            { data: "marca", name: "marca" },
            { data: "modelo", name: "modelo" },
            {
                data: "status",
                render: function (data) {
                    if (data == 1) {
                        return '<span class="badge bg-success side-badge">Disponible</span>';
                    } else {
                        return '<span class="badge bg-danger side-badge">Deshabilitado</span>';
                    }
                },
            },
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
        language: language,
    });

    $("#table_productos_gestion_img").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [],
        ajax: "productos_gestion_list",
        columns: [
            {
                data: "imagen",
                render: function (data) {
                    if (data == null || data == "") {
                        return '<img src="assets/img/sin_imagen.jpg" loading="lazy" id="img_tbl_resize" />';
                    } else {
                        return (
                            '<img src="' +
                            url_general +
                            "images/productos/" +
                            data +
                            '" loading="lazy" id="img_tbl_resize">'
                        );
                    }
                },
            },
            { data: "cod_producto", name: "cod_producto" },
            { data: "nombre", name: "nombre" },
            { data: "categoria", name: "categoria" },
            { data: "subcategoria", name: "subcategoria" },
            { data: "marca", name: "marca" },
            { data: "modelo", name: "modelo" },
            { data: "cantidad", name: "cantidad" },
            {
                data: "status",
                render: function (data) {
                    if (data == 1) {
                        return '<span class="badge bg-success side-badge">Disponible</span>';
                    } else {
                        return '<span class="badge bg-danger side-badge">Deshabilitado</span>';
                    }
                },
            },
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
        language: language,
    });

    var table_clientes = $("#table_clientes_img").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'<'float-md-right ml-2'B>f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: "clientes_list",
        buttons: [
            "csv",
            {
                text: '<i class="fa fa-id-badge fa-fw" aria-hidden="true"></i>',
                action: function (e, dt, node) {
                    $(dt.table().node()).toggleClass("cards");
                    $(".fa", node).toggleClass(["fa-table", "fa-id-badge"]);

                    dt.draw("page");
                },
                className: "btn-sm",
                attr: {
                    title: "Change views",
                },
            },
        ],
        select: "single",
        responsive: true,
        language: language,
        columns: [
            {
                orderable: false,
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (type === "display") {
                        if (data.avatar == null || data.avatar == "") {
                            return '<img src="assets/img/sin_imagen.jpg" class="avatar border rounded-circle">';
                        }
                        return (
                            '<img src="' +
                            url_general +
                            "images/clientes/" +
                            data.avatar +
                            '" class="avatar border rounded-circle">'
                        );
                    }

                    return data;
                },
            },
            {
                data: "razon_social",
            },
            {
                data: "nit",
            },
            {
                data: "contacto",
            },
            {
                data: "celular",
            },
            {
                data: "email",
            },
            {
                data: null,
                render: function (data) {
                    if (data.estado == 1) {
                        return '<span class="badge bg-success side-badge">Activo</span>';
                    } else {
                        return '<span class="badge bg-danger side-badge">Inactivo</span>';
                    }
                },
            },
            {
                data: null,
                render: function (data) {
                    let data_return = "";

                    if ($("#delete_cliente_admin").val() == 1) {
                        data_return +=
                            '<div class="text-center">' +
                            '<button data-id="' +
                            data.id +
                            '" class="btn btn-primary btn-sm btnEncuesta" title="Encuestas">' +
                            '<i class="fas fa-poll"></i></button>&nbsp;' +
                            '<button data-id="' +
                            data.id +
                            '" class="btn btn-secondary btn-sm btnSagrilaf" title="Sagrilaf">' +
                            '<i class="fas fa-file-alt"></i></button>&nbsp;' +
                            '<button data-estado="' +
                            data.estado +
                            '" data-id="' +
                            data.id +
                            '" class="btn btn-warning btn-sm btnInactivar" title="Inactivar">' +
                            '<i class="fas fa-times"></i></button>&nbsp;' +
                            '<button data-id="' +
                            data.id +
                            '" class="btn btn-danger btn-sm btnEliminar mt-1" title="Eliminar">' +
                            '<i class="fa fa-trash"></i></button>'
                            '</div>';
                    }

                    return data_return;
                },
            },
        ],
        drawCallback: function (settings) {
            var api = this.api();
            var $table = $(api.table().node());

            if ($table.hasClass("cards")) {
                // Create an array of labels containing all table headers
                var labels = [];
                $("thead th", $table).each(function () {
                    labels.push($(this).text());
                });

                // Add data-label attribute to each cell
                $("tbody tr", $table).each(function () {
                    $(this)
                        .find("td")
                        .each(function (column) {
                            $(this).attr("data-label", labels[column]);
                        });
                });

                var max = 0;
                $("tbody tr", $table)
                    .each(function () {
                        max = Math.max($(this).height(), max);
                    })
                    .height(max);
            } else {
                // Remove data-label attribute from each cell
                $("tbody td", $table).each(function () {
                    $(this).removeAttr("data-label");
                });

                $("tbody tr", $table).each(function () {
                    $(this).height("auto");
                });
            }
        },
    });

    $("#table_clientes_img tbody").on(
        "click",
        "tr td:first-child",
        function () {
            $("#global-loader").fadeIn("fast");
            var data = table_clientes.row(this).data();

            if ($.fn.DataTable.isDataTable("#table_anexos_edit")) {
                $("#table_anexos_edit").DataTable().destroy();
            }

            $("#table_anexos_edit tbody").empty();

            $.ajax({
                url: "clientes_data",
                type: "POST",
                data: {
                    cliente: data.id,
                },
                dataType: "json",
                success: function (data) {
                    let cliente = data.cliente;
                    let facturacion = data.facturacion;
                    let tecnicos = data.tecnicos;
                    let anexos = data.anexos;

                    if (facturacion) {
                        //Facturación
                        $("#nombre_fact_edit").val(facturacion.nombre);
                        $("#telefono_fact_edit").val(facturacion.telefono);
                        $("#apellido_fact_edit").val(facturacion.apellido);
                        $("#extension_fact_edit").val(facturacion.extension);
                        $("#email_fact_edit").val(facturacion.email);
                        $("#codigo_fact_edit").val(facturacion.codigo_postal);
                        $("#regimen_fact_edit").val(facturacion.tipo_regimen);
                        $("#responsable_fact_edit").val(
                            facturacion.responsabilidad_fiscal
                        );
                        $("#indicativo_fact_edit").val(
                            facturacion.indicativo_telefono
                        );
                    }

                    //Técnicos
                    if (tecnicos) {
                        $("#nombre_tecn_edit").val(tecnicos.nombre);
                        $("#indicativo_tecn_edit").val(
                            tecnicos.indicativo_telefono
                        );
                        $("#apellido_tecn_edit").val(tecnicos.apellido);
                        $("#telefono_tecn_edit").val(tecnicos.telefono);
                        $("#email_tecn_edit").val(tecnicos.email);
                        $("#extension_tecn_edit").val(tecnicos.extension);
                    }
                    
                    //Anexos
                    anexos.forEach((anexo) => {
                        var date = new Date(anexo.fecha);
                        var tipo_badge = "";
                        if (anexo.tipo == 0) {
                            tipo_badge = "Camara de comercio";
                        } else if (anexo.tipo == 1) {
                            tipo_badge = "RUT";
                        } else if (anexo.tipo == 2) {
                            tipo_badge = "Cedula del representante Legal";
                        } else if (anexo.tipo == 3) {
                            tipo_badge = "Remisiones";
                        } else if (anexo.tipo == 4) {
                            tipo_badge = "Cotizaciones";
                        } else if (anexo.tipo == 5) {
                            tipo_badge = "Informacion Tecnica";
                        } else if (anexo.tipo == 6) {
                            tipo_badge = "Frecuencias";
                        } else if (anexo.tipo == 7) {
                            tipo_badge = "Equipos Utilizados";
                        } else if (anexo.tipo == 8) {
                            tipo_badge = "Ubicación de Equipos e Inventario";
                        } else if (anexo.tipo == 9) {
                            tipo_badge = "Programaciones";
                        } else if (anexo.tipo == 10) {
                            tipo_badge = "Otros";
                        } else if (anexo.tipo == 11) {
                            tipo_badge = "Formulario ANE";
                        } else if (anexo.tipo == 12) {
                            tipo_badge = "Informes Tecnicos";
                        }
                        var data_delete = "";
                        if ($("#anexos_cliente_admin").val() == 1) {
                            data_delete =
                                '<br><a class="btn_delete_archivo" data-id="' +
                                anexo.id +
                                '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>';
                        }
                        $("#table_anexos_edit").append(
                            "<tr><td>" +
                                tipo_badge +
                                "</td><td>" +
                                date.toLocaleString() +
                                "</td><td>" +
                                anexo.descripcion +
                                "</td><td>" +
                                anexo.creador +
                                "</td><td>" +
                                '<a target="_BLANK" href="' + url_general + "images/clientes/" +
                                anexo.documento +
                                '"><i class="fa fa-download"></i>&nbsp;Descargar</a>' +
                                data_delete +
                                "</td></tr>"
                        );
                    });

                    $("#table_anexos_edit").DataTable({
                        language: language,
                        order: [],
                    });

                    //Datos del cliente
                    $("#div_list_clientes").hide();
                    $("#div_content_cliente_edit").show();

                    if (cliente.avatar != null && cliente.avatar != "") {
                        $("#img_cliente_edit").attr(
                            "src",
                            url_general + "images/clientes/" + cliente.avatar
                        );
                    } else {
                        $("#img_cliente_edit").attr(
                            "src",
                            url_general + "images/clientes/noavatar.png"
                        );
                    }

                    $("#title_cliente_edit").empty();
                    $("#title_cliente_edit").append(cliente.razon_social);
                    $("#id_cliente_edit").val(cliente.id);

                    $("#razon_social_edit").val(cliente.razon_social);
                    $("#contacto_edit").val(cliente.contacto);
                    $("#celular_edit").val(cliente.celular);
                    $("#email_edit").val(cliente.email);
                    $("#direccion_edit").val(cliente.direccion);
                    $("#tipo_cliente_edit").val(cliente.tipo).trigger("change");
                    $("#tipo_doc_cliente_edit")
                        .val(cliente.tipo_identificacion)
                        .trigger("change");
                    $("#documento_cliente_edit").val(cliente.nit);
                    $("#telefono_edit").val(cliente.telefono_fijo);
                    $("#ciudad_cliente_edit").val(cliente.ciudad);

                    $("#tipo_regimenadd").val(cliente.tipo_regimen);
                    $("#codigo_sucursaladd").val(cliente.codigo_sucursal);
                    $("#indicativo_telefonoadd").val(
                        cliente.indicativo_telefono
                    );
                    $("#extencionadd").val(cliente.extencion);

                    //console.log(data);
                    $("#global-loader").fadeOut("fast");
                },
                error: function (data) {
                    $("#global-loader").fadeOut("fast");
                    //console.log(data);
                    alert("Error al cargar los datos del cliente");
                },
            });
            //console.log(data);
        }
    );

    var table_empleados = $("#table_empleados_img").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'<'float-md-right ml-2'B>f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: "empleados_list",
        buttons: [
            "csv",
            {
                text: '<i class="fa fa-id-badge fa-fw" aria-hidden="true"></i>',
                action: function (e, dt, node) {
                    $(dt.table().node()).toggleClass("cards");
                    $(".fa", node).toggleClass(["fa-table", "fa-id-badge"]);

                    dt.draw("page");
                },
                className: "btn-sm",
                attr: {
                    title: "Change views",
                },
            },
        ],
        select: "single",
        responsive: true,
        language: language,
        columns: [
            {
                orderable: false,
                data: null,
                className: "text-center",
                render: function (dataa, type, full, meta) {
                    if (type === "display") {
                        data = '<i class="fa fa-user fa-fw"></i>';
                        data =
                            '<img src="' +
                            url_general +
                            "images/empleados/" +
                            dataa.avatar +
                            '" class="avatar border rounded-circle">';
                    }

                    return data;
                },
            },
            {
                data: "nombre",
            },
            {
                data: "cargo",
            },
            {
                data: "codigo_empleado",
            },
            {
                data: "telefono_celular",
            },
            {
                data: null,
                render: function (data) {
                    return "A" + data.rol;
                },
            },
            {
                data: null,
                render: function (data) {
                    if (data.status == 1) {
                        return '<span class="badge bg-success side-badge">Activo</span>';
                    } else {
                        return '<span class="badge bg-danger side-badge">Inactivo</span>';
                    }
                },
            },
            {
                data: null,
                render: function (data) {
                    let data_return = "";
                    if ($("#edit_empleados_admin").val() == 1) {
                        data_return =
                            '<button data-estado="' +
                            data.status +
                            '" data-id="' +
                            data.id +
                            '" class="btn btn-primary btn-sm btnInactivar" title="Inactivar">' +
                            '<i class="fas fa-times"></i></button>&nbsp;' +
                            '<button data-id="' +
                            data.id +
                            '" class="btn btn-danger btn-sm btnEliminar" title="Eliminar">' +
                            '<i class="fa fa-trash"></i></button>&nbsp;';
                    }

                    if ($("#clave_empleados_admin").val() == 1) {
                        data_return +=
                            '<button data-id="' +
                            data.id +
                            '" class="btn btn-primary btn-sm btnChangeClave" title="Cambiar Clave"><i class="fa fa-unlock-alt"></i></button>';
                    }

                    return data_return;
                },
            },
        ],
        drawCallback: function (settings) {
            var api = this.api();
            var $table = $(api.table().node());

            if ($table.hasClass("cards")) {
                // Create an array of labels containing all table headers
                var labels = [];
                $("thead th", $table).each(function () {
                    labels.push($(this).text());
                });

                // Add data-label attribute to each cell
                $("tbody tr", $table).each(function () {
                    $(this)
                        .find("td")
                        .each(function (column) {
                            $(this).attr("data-label", labels[column]);
                        });
                });

                var max = 0;
                $("tbody tr", $table)
                    .each(function () {
                        max = Math.max($(this).height(), max);
                    })
                    .height(max);
            } else {
                // Remove data-label attribute from each cell
                $("tbody td", $table).each(function () {
                    $(this).removeAttr("data-label");
                });

                $("tbody tr", $table).each(function () {
                    $(this).height("auto");
                });
            }
        },
    });

    $("#table_empleados_img tbody").on(
        "click",
        "tr td:first-child",
        function () {
            $("#global-loader").fadeIn("fast");
            var data = table_empleados.row(this).data();

            if ($.fn.DataTable.isDataTable("#table_novedades_edit")) {
                $("#table_novedades_edit").DataTable().destroy();
            }

            $("#table_novedades_edit tbody").empty();

            if ($.fn.DataTable.isDataTable("#table_horas_trabajadas_edit")) {
                $("#table_horas_trabajadas_edit").DataTable().destroy();
            }

            $("#table_horas_trabajadas_edit tbody").empty();

            if ($.fn.DataTable.isDataTable("#table_anexos_edit")) {
                $("#table_anexos_edit").DataTable().destroy();
            }

            $("#table_anexos_edit tbody").empty();

            $.ajax({
                url: "empleados_data",
                type: "POST",
                data: {
                    empleado: data.id,
                },
                dataType: "json",
                success: function (data) {
                    let nomina = data.nomina;
                    let novedades = data.novedades;
                    let horas = data.horas;
                    let anexos = data.anexos;

                    //Facturación
                    /*$("#nombre_fact_edit").val(facturacion.nombre);
                $("#telefono_fact_edit").val(facturacion.telefono);
                $("#apellido_fact_edit").val(facturacion.apellido);
                $("#extension_fact_edit").val(facturacion.extension);
                $("#email_fact_edit").val(facturacion.email);
                $("#codigo_fact_edit").val(facturacion.codigo_postal);
                $("#regimen_fact_edit").val(facturacion.tipo_regimen);*/

                    //Novedades
                    novedades.forEach((novedad) => {
                        $("#table_novedades_edit").append(
                            "<tr><td>" +
                                novedad.motivo +
                                "</td><td>" +
                                novedad.dias +
                                "</td><td>" +
                                novedad.fecha +
                                "</td><td>" +
                                novedad.status +
                                "</td><td>" +
                                '<a class="btn_delete_novedad" data-id="' +
                                novedad.id +
                                '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                "</td></tr>"
                        );
                    });

                    //Anexos
                    anexos.forEach((anexo) => {
                        var date = new Date(anexo.fecha);
                        var tipo_badge = "";
                        if (anexo.tipo == 0) {
                            tipo_badge = "Hoja de vida";
                        } else if (anexo.tipo == 1) {
                            tipo_badge = "Afiliaciones";
                        } else if (anexo.tipo == 2) {
                            tipo_badge = "Contrato";
                        } else if (anexo.tipo == 3) {
                            tipo_badge = "Examenes Ocupacionales";
                        } else if (anexo.tipo == 4) {
                            tipo_badge = "Curso de altura";
                        } else if (anexo.tipo == 5) {
                            tipo_badge = "Capacitaciones";
                        } else if (anexo.tipo == 6) {
                            tipo_badge = "Procesos disciplinarios";
                        } else if (anexo.tipo == 7) {
                            tipo_badge = "Vacaciones";
                        } else if (anexo.tipo == 8) {
                            tipo_badge = "Carnet de vacunación";
                        } else if (anexo.tipo == 9) {
                            tipo_badge = "Primas";
                        } else if (anexo.tipo == 10) {
                            tipo_badge = "Código de ética y buen gobierno";
                        } else if (anexo.tipo == 11) {
                            tipo_badge =
                                "Autorización tratamiento de datos personales";
                        } else if (anexo.tipo == 12) {
                            tipo_badge = "Hoja de vida empresarial";
                        } else if (anexo.tipo == 13) {
                            tipo_badge = "Control de selección";
                        } else if (anexo.tipo == 14) {
                            tipo_badge = "Entrega de carnet";
                        } else if (anexo.tipo == 15) {
                            tipo_badge = "Requisitos laborales";
                        } else if (anexo.tipo == 16) {
                            tipo_badge =
                                "Entrenamiento y preparación incorporación";
                        } else if (anexo.tipo == 17) {
                            tipo_badge = "Registro de inducción";
                        } else if (anexo.tipo == 18) {
                            tipo_badge = "Plan formación inducción";
                        } else if (anexo.tipo == 19) {
                            tipo_badge =
                                "Evidencia Fotográfoca de las capacitaciones";
                        } else if (anexo.tipo == 21) {
                            tipo_badge = "Formatos varios (word excel pdf)";
                        } else if (anexo.tipo == 22) {
                            tipo_badge = "Implementos de seguridad";
                        } else if (anexo.tipo == 23) {
                            tipo_badge = "Incapacidades";
                        } else if (anexo.tipo == 24) {
                            tipo_badge = "Datos Personales";
                        } else if (anexo.tipo == 25) {
                            tipo_badge = "Dotación";
                        } else if (anexo.tipo == 26) {
                            tipo_badge = "Seguridad Social";
                        } else if (anexo.tipo == 27) {
                            tipo_badge = "Prestamo a Empleados";
                        } else if (anexo.tipo == 28) {
                            tipo_badge = "Otros";
                        }
                        $("#table_anexos_edit").append(
                            "<tr><td>" +
                                tipo_badge +
                                "</td><td>" +
                                date.toLocaleString() +
                                "</td><td>" +
                                anexo.descripcion +
                                "</td><td>" +
                                anexo.creador +
                                "</td><td>" +
                                '<a target="_BLANK" href="' + url_general + "images/empleados/" +
                                anexo.documento +
                                '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                                '<a class="btn_delete_archivo" data-id="' +
                                anexo.id +
                                '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                "</td></tr>"
                        );
                    });

                    $("#table_novedades_edit").DataTable({
                        language: language,
                        order: [],
                    });

                    $("#table_horas_trabajadas_edit").DataTable({
                        language: language,
                        order: [],
                    });

                    $("#table_anexos_edit").DataTable({
                        language: language,
                        order: [],
                    });

                    //console.log(data);
                    $("#global-loader").fadeOut("fast");
                },
                error: function (data) {
                    $("#global-loader").fadeOut("fast");
                    console.log(data);
                    alert("Error al cargar los datos del cliente");
                },
            });

            if (data.avatar != null && data.avatar != "") {
                $("#img_empleado_edit").attr(
                    "src",
                    url_general + "images/empleados/" + data.avatar
                );
            } else {
                $("#img_empleado_edit").attr(
                    "src",
                    url_general + "images/empleados/noavatar.png"
                );
            }

            $("#div_list_empleados").hide();
            $("#div_content_empleado_edit").show();

            $("#title_empleado_edit").empty();
            $("#title_empleado_edit").append(data.nombre);
            $("#id_empleado_edit").val(data.id);

            $("#codigo_empleado_edit").val(data.codigo_empleado);
            $("#nombre_empleado_edit").val(data.nombre);
            $("#cargo_empleado_edit").val(data.cargo);
            $("#rol_empleado_edit").val(data.rol).trigger("change");
            $("#email_edit").val(data.email);
            $("#telefono_fij_edit").val(data.telefono_fijo);
            $("#telefono_cel_edit").val(data.telefono_celular);
            $("#direccion_edit").val(data.direccion);
            $("#fecha_ingreso_edit").val(data.fecha_ingreso);
            $("#fecha_retiro_edit").val(data.fecha_retiro);
            $("#fecha_nacimiento_edit").val(data.fecha_nacimiento);
            $("#eps_edit").val(data.eps);
            $("#caja_compensacion_edit").val(data.caja_compensacion);
            $("#arl_edit").val(data.arl);
            $("#fondo_pension_edit").val(data.fondo_pension);
            $("#riesgos_prof_edit")
                .val(data.riesgos_profesionales)
                .trigger("change");

            $("#observaciones_otra_info_edit").val(data.observaciones);
            $("#prestamo_otra_info_edit").val(data.prestamo).trigger("change");
            $("#periodo_dotacion_otra_info_edit").val(data.periodo_dotacion);
            $("#licencia_otra_info_edit").val(data.numero_licencia_conduccion);
            $("#vencimiento_otra_info_edit").val(
                data.vencimiento_licencia_conduccion
            );
            $("#multas_pend_otra_info_edit")
                .val(data.multas_transito_pendiente)
                .trigger("change");
            $("#implementos_otra_info_edit").val(data.implementos_seguridad);
            $("#fecha_culminacion_otra_info_edit").val(
                data.culminacion_contrato
            );

            console.log(data);
        }
    );
});
