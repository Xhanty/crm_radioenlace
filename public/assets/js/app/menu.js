$(function () {
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

    //______Basic Data Table
    $(".basic-datatable-t").DataTable({
        language: language,
        order: [],
    });

    $("#table_vehiculos_img").DataTable({
        processing: true,
        serverSide: true,
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
                data: "estado",
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
        var data = table_clientes.row(this).data();
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
        
        $("#ciudad_cliente_edit").val(data.ciudad);
        $("#ciudad_cliente_edit").val(data.ciudad);
        $("#ciudad_cliente_edit").val(data.ciudad);
        console.log(data);
    });
});
