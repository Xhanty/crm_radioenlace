$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

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

    $(".form-select").select2({
        placeholder: "Seleccione una opción",
        searchInputPlaceholder: "Buscar",
    });

    //______Basic Data Table
    $(".basic-datatable-t").DataTable({
        language: language,
        order: [],
    });

    $("#table_vehiculos_img").DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: "vehiculos_list",
        columns: [
            {
                data: "foto",
                render: function (data) {
                    if (data == null || data == "") {
                        return '<img src="assets/img/sin_imagen.jpg" loading="lazy" style="width: 120px" />';
                    } else {
                        return (
                            '<img src="http://127.0.0.1:8000/images/vehiculos/' +
                            data +
                            '" loading="lazy" style="width: 120px">'
                        );
                    }
                },
            },
            { data: "marca", name: "marca" },
            { data: "modelo", name: "modelo" },
            { data: "placa", name: "placa" },
            { data: "year", name: "year" },
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
        order: [],
        ajax: "productos_list",
        columns: [
            {
                data: "imagen",
                render: function (data) {
                    if (data == null || data == "") {
                        return '<img src="assets/img/sin_imagen.jpg" loading="lazy" style="width: 120px" />';
                    } else {
                        return (
                            '<img src="https://formrad.com/radio_enlace/productos/' +
                            data +
                            '" loading="lazy" style="width: 120px">'
                        );
                    }
                },
            },
            { data: "nombre", name: "nombre" },
            { data: "categoria", name: "categoria" },
            { data: "cod_producto", name: "cod_producto" },
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

    $("#tbl_actividades_inventario").DataTable({
        processing: true,
        serverSide: true,
        ajax: "actividades_inventario_list",
        columns: [
            { data: "empleado", name: "empleado" },
            {
                data: null,
                render: function (data) {
                    var img =
                        '<div><img src="https://formrad.com/radio_enlace/productos/' +
                        data.img_producto +
                        '" loading="lazy" style="width: 120px" /></div>' +
                        "<div>" +
                        data.producto +
                        "</div>";

                    return img;
                },
            },
            { data: "cantidad", name: "cantidad" },
            { data: "fecha", name: "fecha" },
            {
                data: null,
                render: function (data) {
                    return data.tipo;
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
        order: [],
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
        language: language,
        columns: [
            {
                orderable: false,
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (type === "display") {
                        var token = (Math.random() * 3 * 1e38).toString(16);
                        data = '<i class="fa fa-user fa-fw"></i>';
                        data =
                            '<img src="https://www.gravatar.com/avatar/' +
                            token +
                            '.png?d=robohash" class="avatar border rounded-circle">';
                    }

                    return data;
                },
            },
            {
                data: "razon_social",
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

    $("#table_clientes_img tbody").on("click", "tr", function () {
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
                let facturacion = data.facturacion;
                let tecnicos = data.tecnicos;
                let anexos = data.anexos;

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
                $("#indicativo_fact_edit").val(facturacion.indicativo_telefono);

                //Técnicos
                $("#nombre_tecn_edit").val(tecnicos.nombre);
                $("#indicativo_tecn_edit").val(tecnicos.indicativo_telefono);
                $("#apellido_tecn_edit").val(tecnicos.apellido);
                $("#telefono_tecn_edit").val(tecnicos.telefono);
                $("#email_tecn_edit").val(tecnicos.email);
                $("#extension_tecn_edit").val(tecnicos.extension);

                //Anexos
                anexos.forEach((anexo) => {
                    var date = new Date(anexo.fecha);
                    $("#table_anexos_edit").append(
                        "<tr><td>" +
                            anexo.tipo +
                            "</td><td>" +
                            date.toLocaleString() +
                            "</td><td>" +
                            anexo.descripcion +
                            "</td><td>" +
                            anexo.creador +
                            "</td><td>" +
                            '<a target="_BLANK" href="https://formrad.com/radio_enlace/documentos_clientes/' +
                            anexo.documento +
                            '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                            '<a class="btn_delete_archivo" data-id="' +
                            anexo.id +
                            '" href="#"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                            "</td></tr>"
                    );
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
                //console.log(data);
                alert("Error al cargar los datos del cliente");
            },
        });

        $("#div_list_clientes").hide();
        $("#div_content_cliente_edit").show();

        $("#title_cliente_edit").empty();
        $("#title_cliente_edit").append(data.razon_social);
        $("#id_cliente_edit").val(data.id);

        $("#razon_social_edit").val(data.razon_social);
        $("#contacto_edit").val(data.contacto);
        $("#celular_edit").val(data.celular);
        $("#email_edit").val(data.email);
        $("#direccion_edit").val(data.direccion);
        $("#tipo_cliente_edit").val(data.tipo);
        $("#tipo_doc_cliente_edit").val(data.tipo_identificacion);
        $("#documento_cliente_edit").val(data.nit);
        $("#telefono_edit").val(data.telefono_fijo);
        $("#ciudad_cliente_edit").val(data.ciudad);

        $("#tipo_regimenadd").val(data.tipo_regimen);
        $("#codigo_sucursaladd").val(data.codigo_sucursal);
        $("#indicativo_telefonoadd").val(data.indicativo_telefono);
        $("#extencionadd").val(data.extension);
        //console.log(data);
    });

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
        language: language,
        columns: [
            {
                orderable: false,
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (type === "display") {
                        var token = (Math.random() * 3 * 1e38).toString(16);
                        data = '<i class="fa fa-user fa-fw"></i>';
                        data =
                            '<img src="https://www.gravatar.com/avatar/' +
                            token +
                            '.png?d=robohash" class="avatar border rounded-circle">';
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

    $("#table_empleados_img tbody").on("click", "tr", function () {
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
                            '" href="#"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                            "</td></tr>"
                    );
                });

                //Anexos
                anexos.forEach((anexo) => {
                    var date = new Date(anexo.fecha);
                    $("#table_anexos_edit").append(
                        "<tr><td>" +
                            anexo.tipo +
                            "</td><td>" +
                            date.toLocaleString() +
                            "</td><td>" +
                            anexo.descripcion +
                            "</td><td>" +
                            anexo.creador +
                            "</td><td>" +
                            '<a target="_BLANK" href="https://formrad.com/radio_enlace/documentos/' +
                            anexo.documento +
                            '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                            '<a class="btn_delete_archivo" data-id="' +
                            anexo.id +
                            '" href="#"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
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

                console.log(data);
                $("#global-loader").fadeOut("fast");
            },
            error: function (data) {
                $("#global-loader").fadeOut("fast");
                console.log(data);
                alert("Error al cargar los datos del cliente");
            },
        });

        $("#div_list_empleados").hide();
        $("#div_content_empleado_edit").show();

        $("#title_empleado_edit").empty();
        $("#title_empleado_edit").append(data.nombre);
        $("#id_empleado_edit").val(data.id);

        $("#codigo_empleado_edit").val(data.codigo_empleado);
        $("#nombre_empleado_edit").val(data.nombre);
        $("#cargo_empleado_edit").val(data.cargo);
        $("#rol_empleado_edit").val(data.rol);
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
        $("#riesgos_prof_edit").val(data.riesgos_profesionales);

        $("#observaciones_otra_info_edit").val(data.observaciones);
        $("#prestamo_otra_info_edit").val(data.prestamo);
        $("#periodo_dotacion_otra_info_edit").val(data.periodo_dotacion);
        $("#licencia_otra_info_edit").val(data.numero_licencia_conduccion);
        $("#vencimiento_otra_info_edit").val(
            data.vencimiento_licencia_conduccion
        );
        $("#multas_pend_otra_info_edit").val(data.multas_transito_pendiente);
        $("#implementos_otra_info_edit").val(data.implementos_seguridad);
        $("#fecha_culminacion_otra_info_edit").val(data.culminacion_contrato);

        console.log(data);
    });
});
