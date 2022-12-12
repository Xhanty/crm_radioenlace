$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#div_content_cliente_edit").hide();
    $("#div_content_cliente_add").hide();
    $(".open-toggle").trigger("click");

    $("#btnNewCliente").click(function () {
        $("#div_list_clientes").hide();
        $("#div_content_cliente_add").show();
    });

    $("#back_table_cliente_add").click(function () {
        $("#div_list_clientes").show();
        $("#div_content_cliente_add").hide();
    });

    $("#back_table_cliente_edit").click(function () {
        $("#div_list_clientes").show();
        $("#div_content_cliente_edit").hide();
    });

    $(".nav-link-1").click(function () {
        $(this).addClass("active");
        $(".nav-link-2").removeClass("active");
        $(".nav-link-3").removeClass("active");

        $("#one_detail").addClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").removeClass("active");
    });

    $(".nav-link-2").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-3").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").addClass("active");
        $("#three_detail").removeClass("active");
    });

    $(".nav-link-3").click(function () {
        $(this).addClass("active");
        $(".nav-link-1").removeClass("active");
        $(".nav-link-2").removeClass("active");

        $("#one_detail").removeClass("active");
        $("#two_detail").removeClass("active");
        $("#three_detail").addClass("active");
    });

    $("#btnAddCliente").click(function () {
        let tipo_cliente = $("#tipo_cliente_add").val();
        let ciudad = $("#ciudad_cliente_add").val();
        let tipo_documento = $("#tipo_doc_cliente_add").val();
        let documento = $("#documento_cliente_add").val();
        let razon_social = $("#razon_social_add").val();
        let direccion = $("#direccion_add").val();
        let telefono = $("#telefono_add").val();
        let celular = $("#celular_add").val();
        let contacto = $("#contacto_add").val();
        let email = $("#email_add").val();
        let tipo_regimen = $("#tipo_regimenadd_new").val();
        let codigo = $("#codigo_sucursaladd_new").val();
        let indicativo = $("#indicativo_telefonoadd_new").val();
        let extension = $("#extencionadd_new").val();

        let formData = new FormData();
        formData.append("tipo_cliente", tipo_cliente);
        formData.append("ciudad", ciudad);
        formData.append("tipo_documento", tipo_documento);
        formData.append("documento", documento);
        formData.append("razon_social", razon_social);
        formData.append("direccion", direccion);
        formData.append("telefono", telefono);
        formData.append("celular", celular);
        formData.append("contacto", contacto);
        formData.append("email", email);
        formData.append("tipo_regimen", tipo_regimen);
        formData.append("codigo", codigo);
        formData.append("indicativo", indicativo);
        formData.append("extension", extension);
        formData.append("archivo", $("#avataradd")[0].files[0]);

        $("#btnAddCliente").attr("disabled", true);
        $.ajax({
            url: "clientes_add",
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (data) {
                if (data.info == 1) {
                    $("#btnAddCliente").attr("disabled", false);
                    toastr.success("Cliente agregado correctamente");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    $("#btnAddCliente").attr("disabled", false);
                    toastr.error("Error al agregar cliente");
                }
            },
        });
    });

    $("#btnModificarCliente1").click(function () {
        let id = $("#id_cliente_edit").val();
        let tipo_cliente = $("#tipo_cliente_edit").val();
        let ciudad = $("#ciudad_cliente_edit").val();
        let tipo_documento = $("#tipo_doc_cliente_edit").val();
        let documento = $("#documento_cliente_edit").val();
        let razon_social = $("#razon_social_edit").val();
        let direccion = $("#direccion_edit").val();
        let telefono = $("#telefono_edit").val();
        let celular = $("#celular_edit").val();
        let contacto = $("#contacto_edit").val();
        let email = $("#email_edit").val();
        let tipo_regimen = $("#tipo_regimenadd").val();
        let codigo = $("#codigo_sucursaladd").val();
        let indicativo = $("#indicativo_telefonoadd").val();
        let extension = $("#extencionadd").val();

        let formData = new FormData();
        formData.append("update_tipo", 1);
        formData.append("id", id);
        formData.append("tipo_cliente", tipo_cliente);
        formData.append("ciudad", ciudad);
        formData.append("tipo_documento", tipo_documento);
        formData.append("documento", documento);
        formData.append("razon_social", razon_social);
        formData.append("direccion", direccion);
        formData.append("telefono", telefono);
        formData.append("celular", celular);
        formData.append("contacto", contacto);
        formData.append("email", email);
        formData.append("tipo_regimen", tipo_regimen);
        formData.append("codigo", codigo);
        formData.append("indicativo", indicativo);
        formData.append("extension", extension);
        formData.append("archivo", $("#avataredit")[0].files[0]);

        $("#btnModificarCliente1").attr("disabled", true);
        $.ajax({
            url: "clientes_update",
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (response) {
                if (response.info == 1) {
                    $("#btnModificarCliente1").attr("disabled", false);
                    toastr.success("Cliente actualizado correctamente");
                } else {
                    $("#btnModificarCliente1").attr("disabled", false);
                    toastr.error("Error al actualizar cliente");
                }
            },
            error: function (response) {
                $("#btnModificarCliente1").attr("disabled", false);
                toastr.error("Error al actualizar cliente");
            },
        });
    });

    $("#btnModificarCliente2").click(function () {
        let id = $("#id_cliente_edit").val();
        let nombre = $("#nombre_fact_edit").val();
        let telefono = $("#telefono_fact_edit").val();
        let apellido = $("#apellido_fact_edit").val();
        let extension = $("#extension_fact_edit").val();
        let email = $("#email_fact_edit").val();
        let codigo = $("#codigo_fact_edit").val();
        let tipo_regimen = $("#regimen_fact_edit").val();
        let responsabilidad_fiscal = $("#responsable_fact_edit").val();
        let indicativo_telefono = $("#indicativo_fact_edit").val();

        $("#btnModificarCliente2").attr("disabled", true);
        $.ajax({
            url: "clientes_update",
            type: "POST",
            data: {
                update_tipo: 2,
                id: id,
                nombre: nombre,
                telefono: telefono,
                apellido: apellido,
                extension: extension,
                email: email,
                codigo: codigo,
                tipo_regimen: tipo_regimen,
                responsabilidad_fiscal: responsabilidad_fiscal,
                indicativo_telefono: indicativo_telefono,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#btnModificarCliente2").attr("disabled", false);
                    toastr.success("Cliente actualizado correctamente");
                } else {
                    $("#btnModificarCliente2").attr("disabled", false);
                    toastr.error("Error al actualizar cliente");
                }
            },
            error: function (response) {
                $("#btnModificarCliente2").attr("disabled", false);
                toastr.error("Error al actualizar cliente");
            },
        });
    });

    $("#btnModificarCliente3").click(function () {
        let id = $("#id_cliente_edit").val();
        let nombre = $("#nombre_tecn_edit").val();
        let indicativo = $("#indicativo_tecn_edit").val();
        let apellido = $("#apellido_tecn_edit").val();
        let telefono = $("#telefono_tecn_edit").val();
        let email = $("#email_tecn_edit").val();
        let extension = $("#extension_tecn_edit").val();

        $("#btnModificarCliente3").attr("disabled", true);
        $.ajax({
            url: "clientes_update",
            type: "POST",
            data: {
                update_tipo: 3,
                id: id,
                nombre: nombre,
                indicativo_telefono: indicativo,
                apellido: apellido,
                telefono: telefono,
                email: email,
                extension: extension,
            },
            success: function (response) {
                if (response.info == 1) {
                    $("#btnModificarCliente3").attr("disabled", false);
                    toastr.success("Cliente actualizado correctamente");
                } else {
                    $("#btnModificarCliente3").attr("disabled", false);
                    toastr.error("Error al actualizar cliente");
                }
            },
            error: function (response) {
                $("#btnModificarCliente3").attr("disabled", false);
                toastr.error("Error al actualizar cliente");
            },
        });
    });

    $(document).on("click", ".btn_delete_archivo", function () {
        let id = $("#id_cliente_edit").val();
        let id_anexo = $(this).data("id");
        
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
                    url: "clientes_update",
                    type: "POST",
                    data: {
                        update_tipo: 4,
                        id: id,
                        id_anexo: id_anexo,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            let anexos = response.anexos;

                            $("#table_anexos_edit").DataTable().destroy();

                            $("#table_anexos_edit tbody").empty();

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
                                    tipo_badge = "Cotizaciones";
                                } else if (anexo.tipo == 5) {
                                    tipo_badge = "Informacion Tecnica";
                                } else if (anexo.tipo == 6) {
                                    tipo_badge = "Frecuencias";
                                } else if (anexo.tipo == 7) {
                                    tipo_badge = "Equipos Utilizados";
                                } else if (anexo.tipo == 8) {
                                    tipo_badge =
                                        "Ubicación de Equipos e Inventario";
                                } else if (anexo.tipo == 9) {
                                    tipo_badge = "Programaciones";
                                } else if (anexo.tipo == 10) {
                                    tipo_badge = "Otros";
                                } else if (anexo.tipo == 11) {
                                    tipo_badge = "Formulario ANE";
                                } else if (anexo.tipo == 12) {
                                    tipo_badge = "Informes Tecnicos";
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
                                        '<a target="_BLANK" href="https://formrad.com/radio_enlace/documentos_clientes/' +
                                        anexo.documento +
                                        '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                                        '<a class="btn_delete_archivo" data-id="' +
                                        anexo.id +
                                        '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                        "</td></tr>"
                                );
                            });

                            $("#table_anexos_edit").DataTable({
                                order: [],
                            });
                            toastr.success("Cliente actualizado correctamente");
                        } else {
                            toastr.error("Error al actualizar cliente");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al actualizar cliente");
                    },
                });
            }
        });
    });

    $("#btnModificarCliente4").click(function () {
        let id = $("#id_cliente_edit").val();
        let tipo_documento = $("#tipodocumentoadd").val();
        let descripcion = $("#descripcionadd").val();
        
        let formData = new FormData();
        formData.append("update_tipo", 5);
        formData.append("id", id);
        formData.append("tipo_documento", tipo_documento);
        formData.append("descripcion", descripcion);
        formData.append("archivo", $("#archivoadd")[0].files[0]);

        $("#btnModificarCliente4").attr("disabled", true);
        $.ajax({
            url: "clientes_update",
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (response) {
                if (response.info == 1) {
                    let anexos = response.anexos;

                    $("#table_anexos_edit").DataTable().destroy();

                    $("#table_anexos_edit tbody").empty();

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
                                '<a target="_BLANK" href="https://formrad.com/radio_enlace/documentos_clientes/' +
                                anexo.documento +
                                '"><i class="fa fa-download"></i>&nbsp;Descargar</a><br>' +
                                '<a class="btn_delete_archivo" data-id="' +
                                anexo.id +
                                '" href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>' +
                                "</td></tr>"
                        );
                    });

                    $("#table_anexos_edit").DataTable({
                        order: [],
                    });

                    $("#btnModificarCliente4").attr("disabled", false);

                    $("#tipodocumentoadd").val(0);
                    $("#descripcionadd").val("");
                    $("#archivoadd").val("");
                    $("#modalAdd").modal("hide");
                    toastr.success("Cliente actualizado correctamente");
                } else {
                    $("#btnModificarCliente4").attr("disabled", false);
                    toastr.error("Error al actualizar cliente");
                }
            },
            error: function (response) {
                $("#btnModificarCliente4").attr("disabled", false);
                toastr.error("Error al actualizar cliente");
            },
        });
    });
});
