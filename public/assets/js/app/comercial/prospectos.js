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

    $(".open-toggle").trigger("click");

    $(document).on("click", ".btnView", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("slow");
        $.ajax({
            url: "prospectos_bd_view",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                let data = response.prospectos;
                if (response.info == 1) {

                    if(data.logo == null || data.logo == "") {
                        data.logo = "noavatar.png";
                    } else {
                        data.logo = data.logo;
                    }

                    $("#imagen_view").attr("src", "images/prospectos_personas/" + data.logo);
                    $("#tipocliente_view").val(data.tipo_cliente).trigger("change");
                    $("#empresa_view").val(data.empresa);
                    $("#nombres_view").val(data.nombres);
                    $("#apellidos_view").val(data.apellidos);
                    $("#email_view").val(data.email);
                    $("#cargo_view").val(data.cargo);
                    $("#celular_view").val(data.celular);
                    $("#telfijo_view").val(data.tel_fijo);
                    $("#fechanacimiento_view").val(data.fecha_nacimiento);
                    $("#direccion_view").val(data.direccion);
                    $("#facebook_view").val(data.facebook);
                    $("#whatsapp_view").val(data.whatsapp);
                    $("#instagram_view").val(data.instagram);
                    $("#referido_view").val(data.referido);

                    $("#global-loader").fadeOut("slow");
                    $("#modalView").modal("show");
                } else {
                    $("#global-loader").fadeOut("slow");
                    toastr.error("Ha ocurrido un error al consultar el prospecto");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                toastr.error("Ha ocurrido un error al consultar el prospecto");
            },
        });
    });

    $(document).on("click", ".btnEdit", function () {
        let id = $(this).data("id");

        $("#global-loader").fadeIn("slow");
        $.ajax({
            url: "prospectos_bd_view",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                let data = response.prospectos;
                if (response.info == 1) {
                    if (data.logo == null || data.logo == "") {
                        data.logo = "noavatar.png";
                    } else {
                        data.logo = data.logo;
                    }

                    $("#imagen_edit").attr("src", "images/prospectos_personas/" + data.logo);

                    $("#id_prospecto_edit").val(data.id);
                    $("#tipocliente_edit").val(data.tipo_cliente).trigger("change");
                    $("#empresa_edit").val(data.empresa);
                    $("#nombres_edit").val(data.nombres);
                    $("#apellidos_edit").val(data.apellidos);
                    $("#email_edit").val(data.email);
                    $("#cargo_edit").val(data.cargo);
                    $("#celular_edit").val(data.celular);
                    $("#telfijo_edit").val(data.tel_fijo);
                    $("#fechanacimiento_edit").val(data.fecha_nacimiento);
                    $("#direccion_edit").val(data.direccion);
                    $("#facebook_edit").val(data.facebook);
                    $("#whatsapp_edit").val(data.whatsapp);
                    $("#instagram_edit").val(data.instagram);
                    $("#referido_edit").val(data.referido);

                    $("#global-loader").fadeOut("slow");
                    $("#modalEdit").modal("show");
                } else {
                    $("#global-loader").fadeOut("slow");
                    toastr.error("Ha ocurrido un error al consultar el prospecto");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                toastr.error("Ha ocurrido un error al consultar el prospecto");
            }
        });
    });

    $(document).on("click", ".btnDelete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Está seguro de eliminar el prospecto?",
            text: "¡No podrá revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Si, eliminar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                $("#global-loader").fadeIn("slow");
                $.ajax({
                    url: "prospectos_bd_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        let data = response.prospectos;
                        if (response.info == 1) {
                            if ($.fn.DataTable.isDataTable("#tbl_data")) {
                                $("#tbl_data").DataTable().destroy();
                            }

                            $("#tbl_data tbody").empty();

                            if (data.length > 0) {
                                data.forEach((element) => {
                                    let chat_api = "";
                                    element.created_at = moment(element.created_at).format("DD/MM/YYYY H:mm A");
                                    if (element.tipo_cliente == 0) {
                                        element.tipo_cliente = "Posible Cliente";
                                    } else {
                                        element.tipo_cliente = "Cliente Existente";
                                    }

                                    if (!element.celular || element.celular == "") {
                                        chat_api = 'disabled';
                                    }
                                    let row = `<tr>
                                    <td>${element.tipo_cliente}</td>
                                    <td>${element.empresa}</td>
                                    <td>${element.nombres}</td>
                                    <td>${element.apellidos ? element.apellidos : ""}</td>
                                    <td>${element.email ? element.email : ""}</td>
                                    <td>${element.celular ? element.celular : ""}</td>
                                    <td>${element.created_at}</td>
                                    <td>
                                        <a title="Ver" href="javascript:void(0);" data-id="${element.id}" class="btn btn-primary btn-sm btnView">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a title="Modificar" href="javascript:void(0);" data-id="${element.id}" class="btn btn-warning btn-sm btnEdit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Eliminar" href="javascript:void(0);" data-id="${element.id}" class="btn btn-danger btn-sm btnDelete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a title="WhatsApp" href="javascript:void(0);" data-id="${element.id}" data-celular="${element.celular}" class="btn btn-success btn-sm btnWhatsapp ${chat_api}">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </td>
                                </tr>`;

                                    $("#tbl_data tbody").append(row);
                                });
                            }

                            $("#tbl_data").DataTable({
                                language: language,
                                responsive: true,
                                order: [],
                            });

                            $("#global-loader").fadeOut("slow");
                            toastr.success("Prospecto eliminado correctamente");
                        } else {
                            $("#global-loader").fadeOut("slow");
                            toastr.error("Ha ocurrido un error al eliminar el prospecto");
                        }
                    },
                    error: function (error) {
                        $("#global-loader").fadeOut("slow");
                        toastr.error("Ha ocurrido un error al eliminar el prospecto");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnWhatsapp", function () {
        let id = $(this).data("id");
        let celular = $(this).data("celular");
        window.open(`https://api.whatsapp.com/send?phone=57${celular}&text=Hola, Somos Radio Enlace`, '_blank');
    });

    $("#btnGuardar").click(function () {
        let tipo_cliente = $("#tipocliente_add").val();
        let empresa = $("#empresa_add").val();
        let nombres = $("#nombres_add").val();
        let apellidos = $("#apellidos_add").val();
        let email = $("#email_add").val();
        let cargo = $("#cargo_add").val();
        let celular = $("#celular_add").val();
        let tel_fijo = $("#telfijo_add").val();
        let fecha_nacimiento = $("#fechanacimiento_add").val();
        let direccion = $("#direccion_add").val();
        let facebook = $("#facebook_add").val();
        let whatsapp = $("#whatsapp_add").val();
        let instagram = $("#instagram_add").val();
        let referido = $("#referido_add").val();

        if (tipo_cliente == "") {
            toastr.error("Seleccione un tipo de cliente");
            return false;
        } else if (nombres.trim().length < 3) {
            toastr.error("Ingrese un nombre válido");
            return false;
        } else {
            $("#btnGuardar").prop("disabled", true);
            $("#global-loader").fadeIn("slow");
            $("#modalAdd").modal("hide");

            let formData = new FormData();
            formData.append("tipo_cliente", tipo_cliente);
            formData.append("empresa", empresa);
            formData.append("nombres", nombres);
            formData.append("apellidos", apellidos);
            formData.append("email", email);
            formData.append("cargo", cargo);
            formData.append("celular", celular);
            formData.append("tel_fijo", tel_fijo);
            formData.append("fecha_nacimiento", fecha_nacimiento);
            formData.append("direccion", direccion);
            formData.append("facebook", facebook);
            formData.append("whatsapp", whatsapp);
            formData.append("instagram", instagram);
            formData.append("referido", referido);
            formData.append("file", $("#logo_add")[0].files[0]);

            $.ajax({
                url: "prospectos_bd_add",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    let data = response.prospectos;
                    if (response.info == 1) {
                        if ($.fn.DataTable.isDataTable("#tbl_data")) {
                            $("#tbl_data").DataTable().destroy();
                        }

                        $("#tbl_data tbody").empty();

                        if (data.length > 0) {
                            data.forEach((element) => {
                                let chat_api = "";
                                element.created_at = moment(element.created_at).format("DD/MM/YYYY H:mm A");
                                if (element.tipo_cliente == 0) {
                                    element.tipo_cliente = "Posible Cliente";
                                } else {
                                    element.tipo_cliente = "Cliente Existente";
                                }

                                if (!element.celular || element.celular == "") {
                                    chat_api = 'disabled';
                                }
                                let row = `<tr>
                                    <td>${element.tipo_cliente}</td>
                                    <td>${element.empresa}</td>
                                    <td>${element.nombres}</td>
                                    <td>${element.apellidos ? element.apellidos : ""}</td>
                                    <td>${element.email ? element.email : ""}</td>
                                    <td>${element.celular ? element.celular : ""}</td>
                                    <td>${element.created_at}</td>
                                    <td>
                                        <a title="Ver" href="javascript:void(0);" data-id="${element.id}" class="btn btn-primary btn-sm btnView">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a title="Modificar" href="javascript:void(0);" data-id="${element.id}" class="btn btn-warning btn-sm btnEdit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Eliminar" href="javascript:void(0);" data-id="${element.id}" class="btn btn-danger btn-sm btnDelete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a title="WhatsApp" href="javascript:void(0);" data-id="${element.id}" data-celular="${element.celular}" class="btn btn-success btn-sm btnWhatsapp ${chat_api}">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </td>
                                </tr>`;

                                $("#tbl_data tbody").append(row);
                            });
                        }

                        $("#tbl_data").DataTable({
                            language: language,
                            responsive: true,
                            order: [],
                        });

                        $("#modalAdd input").val("");
                        $("#modalAdd select").val("").trigger("change");
                        $("#global-loader").fadeOut("slow");
                        $("#btnGuardar").prop("disabled", false);
                        toastr.success("Se ha registrado el prospecto");

                    } else {
                        $("#global-loader").fadeOut("slow");
                        $("#btnGuardar").prop("disabled", false);
                        toastr.error("Ha ocurrido un error al registrar el prospecto");
                    }
                },
                error: function (data) {
                    $("#global-loader").fadeOut("slow");
                    $("#btnGuardar").prop("disabled", false);
                    toastr.error("Ha ocurrido un error al registrar el prospecto");
                },
            });
        }
    });

    $("#btnModificar").click(function () {
        let id = $("#id_prospecto_edit").val();
        let tipo_cliente = $("#tipocliente_edit").val();
        let empresa = $("#empresa_edit").val();
        let nombres = $("#nombres_edit").val();
        let apellidos = $("#apellidos_edit").val();
        let email = $("#email_edit").val();
        let cargo = $("#cargo_edit").val();
        let celular = $("#celular_edit").val();
        let tel_fijo = $("#telfijo_edit").val();
        let fecha_nacimiento = $("#fechanacimiento_edit").val();
        let direccion = $("#direccion_edit").val();
        let facebook = $("#facebook_edit").val();
        let whatsapp = $("#whatsapp_edit").val();
        let instagram = $("#instagram_edit").val();
        let referido = $("#referido_edit").val();

        if (tipo_cliente == "") {
            toastr.error("Seleccione un tipo de cliente");
            return false;
        } else if (nombres.trim().length < 3) {
            toastr.error("Ingrese un nombre válido");
            return false;
        } else {
            $("#btnModificar").prop("disabled", true);
            $("#global-loader").fadeIn("slow");
            $("#modalEdit").modal("hide");

            let formData = new FormData();
            formData.append("id", id);
            formData.append("tipo_cliente", tipo_cliente);
            formData.append("empresa", empresa);
            formData.append("nombres", nombres);
            formData.append("apellidos", apellidos);
            formData.append("email", email);
            formData.append("cargo", cargo);
            formData.append("celular", celular);
            formData.append("tel_fijo", tel_fijo);
            formData.append("fecha_nacimiento", fecha_nacimiento);
            formData.append("direccion", direccion);
            formData.append("facebook", facebook);
            formData.append("whatsapp", whatsapp);
            formData.append("instagram", instagram);
            formData.append("referido", referido);
            formData.append("file", $("#logo_edit")[0].files[0]);

            $.ajax({
                url: "prospectos_bd_edit",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#global-loader").fadeOut("slow");
                    let data = response.prospectos;
                    if (response.info == 1) {
                        if ($.fn.DataTable.isDataTable("#tbl_data")) {
                            $("#tbl_data").DataTable().destroy();
                        }

                        $("#tbl_data tbody").empty();

                        if (data.length > 0) {
                            data.forEach((element) => {
                                let chat_api = "";
                                element.created_at = moment(element.created_at).format("DD/MM/YYYY H:mm A");
                                if (element.tipo_cliente == 0) {
                                    element.tipo_cliente = "Posible Cliente";
                                } else {
                                    element.tipo_cliente = "Cliente Existente";
                                }

                                if (!element.celular || element.celular == "") {
                                    chat_api = 'disabled';
                                }
                                let row = `<tr>
                                    <td>${element.tipo_cliente}</td>
                                    <td>${element.empresa}</td>
                                    <td>${element.nombres}</td>
                                    <td>${element.apellidos ? element.apellidos : ""}</td>
                                    <td>${element.email ? element.email : ""}</td>
                                    <td>${element.celular ? element.celular : ""}</td>
                                    <td>${element.created_at}</td>
                                    <td>
                                        <a title="Ver" href="javascript:void(0);" data-id="${element.id}" class="btn btn-primary btn-sm btnView">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a title="Modificar" href="javascript:void(0);" data-id="${element.id}" class="btn btn-warning btn-sm btnEdit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Eliminar" href="javascript:void(0);" data-id="${element.id}" class="btn btn-danger btn-sm btnDelete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a title="WhatsApp" href="javascript:void(0);" data-id="${element.id}" data-celular="${element.celular}" class="btn btn-success btn-sm btnWhatsapp ${chat_api}">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </td>
                                </tr>`;

                                $("#tbl_data tbody").append(row);
                            });
                        }

                        $("#tbl_data").DataTable({
                            language: language,
                            responsive: true,
                            order: [],
                        });

                        $("#modalEdit input").val("");
                        $("#modalEdit select").val("").trigger("change");
                        $("#global-loader").fadeOut("slow");
                        $("#btnModificar").prop("disabled", false);
                        toastr.success("Se ha modificado el prospecto");

                    } else {
                        $("#global-loader").fadeOut("slow");
                        $("#btnModificar").prop("disabled", false);
                        toastr.error("Ha ocurrido un error al modificar el prospecto");
                    }
                },
                error: function (data) {
                    $("#global-loader").fadeOut("slow");
                    $("#btnModificar").prop("disabled", false);
                    toastr.error("Ha ocurrido un error al modificar el prospecto");
                },
            });
        }
    });
});