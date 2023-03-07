$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

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

    $(document).on("click", ".btn_AgregarAlmacen", function () {
        $("#parent_add").val(0);
        $("#nivel_almacen_add").val(0);

        $("#modalAdd").modal("show");
    });

    $(document).on("click", ".btn_AddNivel", function () {
        let parent = $(this).data("id");
        $("#parent_add").val(parent);
        $("#nivel_almacen_add").val(1);

        $("#modalAdd").modal("show");
    });

    $("#btnGuardarAlmacen").click(function () {
        let nivel = $("#nivel_almacen_add").val();
        let parent = $("#parent_add").val();
        let nombre = $("#almacenadd").val();
        let observacion = $("#observacion_add").val();

        if (nombre.trim().length == 0) {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnGuardarAlmacen").attr("disabled", true);
            $("#btnGuardarAlmacen").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "almacenes_create",
                type: "POST",
                data: {
                    nivel: nivel,
                    parent: parent,
                    nombre: nombre,
                    observacion: observacion,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnGuardarAlmacen").attr("disabled", false);
                        $("#btnGuardarAlmacen").html("Guardar");
                        toastr.error("Error al guardar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnGuardarAlmacen").attr("disabled", false);
                    $("#btnGuardarAlmacen").html("Guardar");
                    toastr.error("Error al guardar el almacén");
                },
            });
        }
    });

    $(document).on("click", ".btn_Edit", function () {
        let id = $(this).data("id");
        let nombre = $(this).data("nombre");
        let observaciones = $(this).data("observaciones");

        $("#id_almacen_edit").val(id);
        $("#almacenedit").val(nombre);
        $("#observacion_edit").val(observaciones);

        $("#modalEdit").modal("show");
    });

    $("#btnModificarAlmacen").click(function () {
        let id = $("#id_almacen_edit").val();
        let nombre = $("#almacenedit").val();
        let observacion = $("#observacion_edit").val();

        if (nombre.trim().length == 0) {
            toastr.error("El campo nombre es obligatorio");
        } else {
            $("#btnModificarAlmacen").attr("disabled", true);
            $("#btnModificarAlmacen").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "almacenes_update",
                type: "POST",
                data: {
                    id: id,
                    nombre: nombre,
                    observacion: observacion,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#btnModificarAlmacen").attr("disabled", false);
                        $("#btnModificarAlmacen").html("Modificar");
                        toastr.error("Error al modificar el almacén");
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#btnModificarAlmacen").attr("disabled", false);
                    $("#btnModificarAlmacen").html("Modificar");
                    toastr.error("Error al modificar el almacén");
                },
            });
        }
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: "¡No, cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "almacenes_delete",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.warning(response.success);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar el almacén");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_ViewProducts", function () {
        let id = $(this).data("id");
        let nombre = $(this).data("nombre");

        $("#global-loader").show();
        $.ajax({
            url: "almacenes_get_inventario",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    $("#global-loader").hide();
                    let products = response.products;
                    $("#id_almacen_view").val(id);
                    $("#almacenview").val(nombre);

                    if ($.fn.DataTable.isDataTable("#tbl_seriales_view")) {
                        $("#tbl_seriales_view").DataTable().destroy();
                    }

                    $("#tbl_seriales_view tbody").empty();

                    products.forEach((element) => {
                        let estado = "";
                        if (element.status == 0) {
                            estado =
                                '<span class="badge bg-danger side-badge">Agotado</span>';
                        } else if (element.status == 1) {
                            estado =
                                '<span class="badge bg-success side-badge">Disponible</span>';
                        }

                        let tr = `<tr>
                            <td>${element.codigo_interno ? element.codigo_interno : ""}</td>
                            <td>${element.nombre} (${element.marca} - ${element.modelo})</td>
                            <td>${element.serial}</td>
                            <td>${element.cantidad}</td>
                            <td>${estado}</td>
                            <td class="text-center">
                            <a href="${url_general +
                            "historial_serial?token=" +
                            element.id
                            }" target="_blank" class="btn btn-success btn-sm" title="Ver Historial"><i class="fa fa-book"></i></a>
                            </td>
                            </tr>`;
                        $("#tbl_seriales_view tbody").append(tr);
                    });

                    $("#tbl_seriales_view").DataTable({
                        responsive: true,
                        language: language,
                        order: [],
                    });

                    $("#modalViewProduct").modal("show");
                } else {
                    $("#global-loader").hide();
                    toastr.error("Error al obtener los productos");
                }
            },
            error: function (error) {
                console.log(error);
                $("#global-loader").hide();
                toastr.error("Error al obtener los productos");
            },
        });
    });
});
