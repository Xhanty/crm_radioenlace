$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $("#div_content_prov_edit").hide();
    $("#div_content_prov_add").hide();
    $(".open-toggle").trigger("click");

    $("#btnNewProveedor").click(function () {
        $("#div_list_proveedores").hide();
        $("#div_content_prov_add").show();
    });

    $("#back_table_prov_add").click(function () {
        $("#div_list_proveedores").show();
        $("#div_content_prov_add").hide();
    });

    $("#back_table_prov_edit").click(function () {
        $("#div_list_proveedores").show();
        $("#div_content_prov_edit").hide();
    });

    $("#btnAddProveedor").click(function () {
        let nit = $("#nit_add").val();
        let codigo = $("#codigo_add").val();
        let razon_social = $("#razon_social_add").val();
        let direccion = $("#direccion_add").val();
        let telefono = $("#telefono_add").val();
        let celular = $("#celular_add").val();
        let contacto = $("#contacto_add").val();
        let email = $("#email_add").val();
        let email_comecial = $("#email_comercial_add").val();
        let tipo_regimen = $("#tipo_regimen_add").val();
        let ciudad = $("#ciudad_add").val();
        let observaciones = $("#observaciones_add").val();

        let formData = new FormData();
        formData.append("nit", nit);
        formData.append("codigo", codigo);
        formData.append("razon_social", razon_social);
        formData.append("direccion", direccion);
        formData.append("telefono", telefono);
        formData.append("celular", celular);
        formData.append("contacto", contacto);
        formData.append("email", email);
        formData.append("email_comercial", email_comecial);
        formData.append("tipo_regimen", tipo_regimen);
        formData.append("ciudad", ciudad);
        formData.append("observaciones", observaciones);
        formData.append("archivo", $("#avataradd")[0].files[0]);

        $("#btnAddProveedor").attr("disabled", true);
        $("#btnAddProveedor").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "proveedores_add",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.info == 1) {
                    toastr.success("Proveedor creado correctamente");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    $("#btnAddProveedor").attr("disabled", false);
                    $("#btnAddProveedor").html("Agregar Proveedor");
                    toastr.error("Error al agregar el proveedor");
                }
            },
            error: function (data) {
                $("#btnAddProveedor").attr("disabled", false);
                $("#btnAddProveedor").html("Agregar Proveedor");
                toastr.error("Error al agregar el proveedor");
            },
        });
    });

    $("#btnEditProveedor").click(function () {
        let id = $("#id_proveedor_edit").val();
        let nit = $("#nit_edit").val();
        let codigo = $("#codigo_edit").val();
        let razon_social = $("#razon_social_edit").val();
        let direccion = $("#direccion_edit").val();
        let telefono = $("#telefono_edit").val();
        let celular = $("#celular_edit").val();
        let contacto = $("#contacto_edit").val();
        let email = $("#email_edit").val();
        let email_comecial = $("#email_comercial_edit").val();
        let tipo_regimen = $("#tipo_regimen_edit").val();
        let ciudad = $("#ciudad_edit").val();
        let observaciones = $("#observaciones_edit").val();

        let formData = new FormData();
        formData.append("id", id);
        formData.append("nit", nit);
        formData.append("codigo", codigo);
        formData.append("razon_social", razon_social);
        formData.append("direccion", direccion);
        formData.append("telefono", telefono);
        formData.append("celular", celular);
        formData.append("contacto", contacto);
        formData.append("email", email);
        formData.append("email_comercial", email_comecial);
        formData.append("tipo_regimen", tipo_regimen);
        formData.append("ciudad", ciudad);
        formData.append("observaciones", observaciones);
        formData.append("archivo", $("#avataredit")[0].files[0]);

        $("#btnEditProveedor").attr("disabled", true);
        $("#btnEditProveedor").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );

        $.ajax({
            url: "proveedores_edit",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.info == 1) {
                    toastr.success("Proveedor modificado correctamente");
                    $("#btnEditProveedor").attr("disabled", false); 
                    $("#btnEditProveedor").html("Modificar Proveedor");
                } else {
                    $("#btnEditProveedor").attr("disabled", false);
                    $("#btnEditProveedor").html("Modificar Proveedor");
                    toastr.error("Error al modificar el proveedor");
                }
            },
            error: function (data) {
                $("#btnEditProveedor").attr("disabled", false);
                $("#btnEditProveedor").html("Modificar Proveedor");
                toastr.error("Error al modificar el proveedor");
            },
        });
    });

    $(document).on("click", ".btnEliminar", function () {
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
                    url: "proveedores_delete",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Proveedor eliminado correctamente");
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el proveedor");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar el proveedor");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnStatus", function () {
        let id = $(this).data("id");
        let status = $(this).data("status");

        if (status == 1) {
            status = 0;
        } else {
            status = 1;
        }

        $("#id_proveedor_status").val(id);
        $("#new_status_proveedor").val(status);
        $("#modalStatus").modal("show");
    });

    $("#btnModificarStatus").click(function () {
        let id = $("#id_proveedor_status").val();
        let status = $("#new_status_proveedor").val();
        let observacion = $("#descripcion_status").val();

        if(observacion.trim().length == 0) {
            toastr.error("Debe ingresar una observación");
            return false;
        } else {
            $("#btnModificarStatus").attr("disabled", true);
            $("#btnModificarStatus").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "proveedores_status",
                type: "POST",
                data: { id: id, status: status, observacion: observacion },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Proveedor modificado correctamente");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al modificar el proveedor");
                        $("#btnModificarStatus").attr("disabled", false);
                        $("#btnModificarStatus").html("Modificar Status");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al modificar el proveedor");
                    $("#btnModificarStatus").attr("disabled", false);
                    $("#btnModificarStatus").html("Modificar Status");
                },
            });
        }        
    });

    $(document).on("click", ".btn_delete_archivo", function () {
        let id = $(this).data("id");
        let id_proveedor = $(this).data("id_proveedor");

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
                    url: "proveedores_anexos_delete",
                    type: "POST",
                    data: { id: id, id_proveedor: id_proveedor },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Anexo eliminado correctamente");
                            let anexos = response.anexos;

                            $("#tbl_anexos_proveedores").DataTable().destroy();
                            $("#tbl_anexos_proveedores tbody").empty();

                            //Anexos
                            anexos.forEach((anexo) => {
                                var date = new Date(anexo.fecha);
                                var tipo_badge = "";
                                if (anexo.tipo == 0) {
                                    tipo_badge = "Camara de comercio";
                                } else if (anexo.tipo == 1) {
                                    tipo_badge = "RUT";
                                } else if (anexo.tipo == 2) {
                                    tipo_badge =
                                        "Cedula del representante Legal";
                                } else if (anexo.tipo == 3) {
                                    tipo_badge = "Remisiones";
                                } else if (anexo.tipo == 4) {
                                    tipo_badge = "Otros";
                                } else if (anexo.tipo == 5) {
                                    tipo_badge = "Certificación Bancaria";
                                }
                                $("#tbl_anexos_proveedores").append(
                                    "<tr><td>" +
                                        tipo_badge +
                                        "</td><td>" +
                                        date.toLocaleString() +
                                        "</td><td>" +
                                        anexo.descripcion +
                                        "</td><td>" +
                                        anexo.creador +
                                        "</td><td>" +
                                        '<a target="_BLANK" href="https://crm.radioenlacesas.com/images/proveedores/anexos/' +
                                        anexo.documento +
                                        '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                                        '<a class="btn_delete_archivo" data-id="' +
                                        anexo.id +
                                        '" data-id_proveedor="' +
                                        id_proveedor +
                                        '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                        "</td></tr>"
                                );
                            });

                            $("#tbl_anexos_proveedores").DataTable({
                                order: [],
                            });
                        } else {
                            toastr.error("Error al eliminar el anexo");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar el anexo");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnEditar", function () {
        let id_proveedor = $(this).data("id");
        $("#global-loader").fadeIn("fast");

        if ($.fn.DataTable.isDataTable("#tbl_anexos_proveedores")) {
            $("#tbl_anexos_proveedores").DataTable().destroy();
        }

        $("#tbl_anexos_proveedores tbody").empty();

        $.ajax({
            url: "proveedores_data",
            type: "POST",
            data: { id: id_proveedor },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;
                    let anexos = response.anexos;

                    //console.log(data);
                    //console.log(anexos);

                    if (data.avatar != null && data.avatar != "") {
                        $("#img_proveedor_edit").attr(
                            "src",
                            url_general + "images/proveedores/" + data.avatar
                        );
                    } else {
                        $("#img_proveedor_edit").attr(
                            "src",
                            url_general + "images/clientes/noavatar.png"
                        );
                    }

                    $("#title_proveedor_edit").html(data.razon_social);
                    $("#id_proveedor_edit").val(data.id);
                    $("#nit_edit").val(data.nit);
                    $("#codigo_edit").val(data.codigo_verificacion);
                    $("#razon_social_edit").val(data.razon_social);
                    $("#direccion_edit").val(data.direccion);
                    $("#telefono_edit").val(data.telefono_fijo);
                    $("#celular_edit").val(data.celular);
                    $("#contacto_edit").val(data.contacto);
                    $("#email_edit").val(data.email);
                    $("#email_comercial_edit").val(data.email_comercial);
                    $("#tipo_regimen_edit").val(data.tipo_regimen);
                    $("#ciudad_edit").val(data.ciudad);
                    $("#observaciones_edit").val(data.observaciones);

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
                            tipo_badge = "Otros";
                        } else if (anexo.tipo == 5) {
                            tipo_badge = "Certificación Bancaria";
                        }
                        var data_delete = "";
                        if ($("#anexos_proveedor_admin").val() == 1) {
                            data_delete =
                                '<br><a class="btn_delete_archivo" data-id="' +
                                anexo.id +
                                '" data-id_proveedor="' +
                                id_proveedor +
                                '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>';
                        }

                        $("#tbl_anexos_proveedores").append(
                            "<tr><td>" +
                                tipo_badge +
                                "</td><td>" +
                                date.toLocaleString() +
                                "</td><td>" +
                                anexo.descripcion +
                                "</td><td>" +
                                anexo.creador +
                                "</td><td>" +
                                '<a target="_BLANK" href="https://crm.radioenlacesas.com/images/proveedores/anexos/' +
                                anexo.documento +
                                '"><i class="fa fa-download"></i>&nbsp;Descargar</a>' + data_delete +
                                "</td></tr>"
                        );
                    });

                    $("#tbl_anexos_proveedores").DataTable({
                        order: [],
                    });

                    $("#global-loader").fadeOut("fast");
                    $("#div_list_proveedores").hide();
                    $("#div_content_prov_edit").show();
                } else {
                    toastr.error("Error al cargar los datos del proveedor");
                    $("#global-loader").fadeOut("fast");
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error("Error al cargar los datos del proveedor");
                $("#global-loader").fadeOut("fast");
            },
        });
    });

    $("#btnAgregarAnexo").click(function () {
        let id_proveedor = $("#id_proveedor_edit").val();
        let tipo_documento = $("#tipodocumento_anexoadd").val();
        let descripcion = $("#descripcion_anexoadd").val();

        let formData = new FormData();
        formData.append("id", id_proveedor);
        formData.append("tipo_documento", tipo_documento);
        formData.append("descripcion", descripcion);
        formData.append("archivo", $("#archivo_anexoadd")[0].files[0]);

        $("#btnAgregarAnexo").attr("disabled", true);
        $("#btnAgregarAnexo").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "proveedores_anexos_add",
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (response) {
                if (response.info == 1) {
                    let anexos = response.anexos;

                    $("#tbl_anexos_proveedores").DataTable().destroy();
                    $("#tbl_anexos_proveedores tbody").empty();

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
                            tipo_badge = "Otros";
                        } else if (anexo.tipo == 5) {
                            tipo_badge = "Certificación Bancaria";
                        }
                        $("#tbl_anexos_proveedores").append(
                            "<tr><td>" +
                                tipo_badge +
                                "</td><td>" +
                                date.toLocaleString() +
                                "</td><td>" +
                                anexo.descripcion +
                                "</td><td>" +
                                anexo.creador +
                                "</td><td>" +
                                '<a target="_BLANK" href="https://crm.radioenlacesas.com/images/proveedores/anexos/' +
                                anexo.documento +
                                '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                                '<a class="btn_delete_archivo" data-id="' +
                                anexo.id +
                                '" data-id_proveedor="' +
                                id_proveedor +
                                '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                "</td></tr>"
                        );
                    });

                    $("#tbl_anexos_proveedores").DataTable({
                        order: [],
                    });

                    $("#btnAgregarAnexo").attr("disabled", false);
                    $("#btnAgregarAnexo").html("Guardar");

                    $("#tipodocumento_anexoadd").val(0);
                    $("#descripcion_anexoadd").val("");
                    $("#archivo_anexoadd").val("");
                    $("#modalAdd").modal("hide");
                    toastr.success("Anexos actualizados correctamente");
                } else {
                    $("#btnAgregarAnexo").attr("disabled", false);
                    $("#btnAgregarAnexo").html("Guardar");
                    toastr.error("Error al actualizar los anexos");
                }
            },
            error: function (response) {
                $("#btnAgregarAnexo").attr("disabled", false);
                $("#btnAgregarAnexo").html("Guardar");
                toastr.error("Error al actualizar los anexos");
            },
        });
    });
});
