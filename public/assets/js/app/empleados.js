$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("input[type='search']").wrap("<form>");
    $("input[type='search']").closest("form").attr("autocomplete", "off");

    $("#div_content_empleado_edit").hide();
    $("#div_content_empleado_add").hide();
    $(".open-toggle").trigger("click");

    $("#back_table_empleado_edit").click(function () {
        $("#div_list_empleados").show();
        $("#div_content_empleado_edit").hide();
    });

    $("#back_table_empleado_add").click(function () {
        $("#div_list_empleados").show();
        $("#div_content_empleado_add").hide();
    });

    $("#addNewEmpleado").click(function () {
        $("#div_list_empleados").hide();
        $("#div_content_empleado_add").show();
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
        $("#five_detail").removeClass("active");
        $("#four_detail").addClass("active");
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

        //window.open("http://127.0.0.1:8000/documentos/?leftDisk=public&leftPath=Empleados/Santiago%20Smith%20Delgado%20Henao", "_blank");
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
                    url: "empleados_delete",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Empleado eliminado correctamente");
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el empleado");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar el empleado");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_delete_novedad", function () {
        let id = $(this).data("id");
        let id_empleado = $("#id_empleado_edit").val();
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
                    url: "empleados_novedad_delete",
                    type: "POST",
                    data: {
                        id: id,
                        id_empleado: id_empleado,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            let novedades = response.novedades;
                            $("#table_novedades_edit").DataTable().destroy();
                            $("#table_novedades_edit tbody").empty();

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

                            $("#table_novedades_edit").DataTable({
                                order: [],
                            });
                            toastr.success("Novedad eliminada correctamente");
                        } else {
                            toastr.error("Error al eliminar la novedad");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al eliminar la novedad");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_delete_archivo", function () {
        let id = $(this).data("id");
        let id_empleado = $("#id_empleado_edit").val();
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
                    url: "empleados_anexo_delete",
                    type: "POST",
                    data: {
                        id: id,
                        id_empleado: id_empleado,
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
                                    tipo_badge =
                                        "Código de ética y buen gobierno";
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
                                    tipo_badge =
                                        "Formatos varios (word excel pdf)";
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
                                        '<a target="_BLANK" href="https://formrad.com/radio_enlace/documentos/' +
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
                            toastr.success("Anexo eliminado correctamente");
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

    $(document).on("click", ".btnInactivar", function () {
        let id = $(this).data("id");
        let estado = $(this).data("estado");

        if (estado == 1) {
            estado = 0;
        } else {
            estado = 1;
        }

        Swal.fire({
            title: "¿Estás seguro de cambiar el estado del empleado?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Sí, cambiar!",
            cancelButtonText: "¡No, cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "empleados_inactivar",
                    type: "POST",
                    data: {
                        id: id,
                        estado: estado,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(
                                "Empleado actualizado correctamente"
                            );
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al actualizar el empleado");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error("Error al actualizar el empleado");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnChangeClave", function () {
        let id = $(this).data("id");
        $("#id_empleado_clave").val(id);

        $("#modalChangeClave").modal("show");
    });

    $("#btnChangeClave").click(function () {
        let id = $("#id_empleado_clave").val();
        let clave = $("#new_clave_empleado").val();

        $("#btnChangeClave").attr("disabled", true);
        $("#btnChangeClave").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "empleados_change_clave",
            type: "POST",
            data: {
                empleado: id,
                clave: clave,
            },
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    $("#new_clave_empleado").val("");
                    $("#id_empleado_clave").val("");
                    $("#modalChangeClave").modal("hide");

                    toastr.success("Clave actualizada correctamente");
                    $("#btnChangeClave").attr("disabled", false);
                    $("#btnChangeClave").html("Modificar");
                } else {
                    toastr.error("Error al actualizar la clave");
                    $("#btnChangeClave").attr("disabled", false);
                    $("#btnChangeClave").html("Modificar");
                }
            },
            error: function (error) {
                toastr.error("Error al actualizar la clave");
                $("#btnChangeClave").attr("disabled", false);
                $("#btnChangeClave").html("Modificar");
                console.log(error);
            },
        });
    });

    $("#btnAgregarNovedad").click(function () {
        let id = $("#id_empleado_edit").val();
        let motivo = $("#motivoadd").val();
        let dias = $("#dias_descontar_add").val();

        if (motivo == "") {
            toastr.error("Debe ingresar el motivo");
            return false;
        } else if (dias == "") {
            toastr.error("Debe ingresar la cantidad de días");
            return false;
        } else {
            $("#btnAgregarNovedad").attr("disabled", true);
            $("#btnAgregarNovedad").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "empleados_novedades",
                type: "POST",
                data: {
                    id: id,
                    motivo: motivo,
                    dias: dias,
                },
                dataType: "json",
                success: function (response) {
                    if (response.info == 1) {
                        let novedades = response.novedades;
                        $("#table_novedades_edit").DataTable().destroy();
                        $("#table_novedades_edit tbody").empty();

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

                        $("#table_novedades_edit").DataTable({
                            order: [],
                        });

                        $("#motivoadd").val("");
                        $("#dias_descontar_add").val("");
                        $("#modalAddNovedad").modal("hide");
                        toastr.success("Novedad agregada correctamente");
                        $("#btnAgregarNovedad").attr("disabled", false);
                        $("#btnAgregarNovedad").html("Guardar");
                    } else {
                        toastr.error("Error al agregar la novedad");
                        $("#btnAgregarNovedad").attr("disabled", false);
                        $("#btnAgregarNovedad").html("Guardar");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al agregar la novedad");
                    $("#btnAgregarNovedad").attr("disabled", false);
                    $("#btnAgregarNovedad").html("Guardar");
                },
            });
        }
    });

    $("#btnAgregarAnexo").click(function () {
        let id = $("#id_empleado_edit").val();
        let tipo_documento = $("#tipo_document_anexo_add").val();
        let descripcion = $("#descripcion_anexo_add").val();

        let formData = new FormData();
        formData.append("id", id);
        formData.append("tipo_documento", tipo_documento);
        formData.append("descripcion", descripcion);
        formData.append("archivo", $("#archivoadd")[0].files[0]);

        if ($("#archivoadd").val() == "" || $("#archivoadd").val() == null) {
            toastr.error("Debe anexar un archivo");
            return false;
        } else {
            $("#btnAgregarAnexo").attr("disabled", true);
            $("#btnAgregarAnexo").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "empleados_anexo_add",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
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
                                    '<a target="_BLANK" href="https://formrad.com/radio_enlace/documentos/' +
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

                        $("#tipo_document_anexo_add").val(0);
                        $("#archivoadd").val("");
                        $("#descripcion_anexo_add").val("");
                        $("#modalAddAnexo").modal("hide");
                        toastr.success("Anexo agregado correctamente");
                        $("#btnAgregarAnexo").attr("disabled", false);
                        $("#btnAgregarAnexo").html("Guardar");
                    } else {
                        toastr.error("Error al agregar el anexo");
                        $("#btnAgregarAnexo").attr("disabled", false);
                        $("#btnAgregarAnexo").html("Guardar");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al agregar el anexo");
                    $("#btnAgregarAnexo").attr("disabled", false);
                    $("#btnAgregarAnexo").html("Guardar");
                },
            });
        }
    });

    $("#btnModificarEmpleado1").click(function () {
        var id = $("#id_empleado_edit").val();
        var codigo = $("#codigo_empleado_edit").val();
        var nombre = $("#nombre_empleado_edit").val();
        var cargo = $("#cargo_empleado_edit").val();
        var rol = $("#rol_empleado_edit").val();
        var email = $("#email_edit").val();
        var telefono = $("#telefono_fij_edit").val();
        var celular = $("#telefono_cel_edit").val();
        var direccion = $("#direccion_edit").val();
        var fecha_ingreso = $("#fecha_ingreso_edit").val();
        var fecha_retiro = $("#fecha_retiro_edit").val();
        var fecha_nacimiento = $("#fecha_nacimiento_edit").val();
        var eps = $("#eps_edit").val();
        var caja = $("#caja_compensacion_edit").val();
        var arl = $("#arl_edit").val();
        var fondo = $("#fondo_pension_edit").val();
        var riesgos = $("#riesgos_prof_edit").val();

        let formData = new FormData();
        formData.append("update_tipo", 1);
        formData.append("id", id);
        formData.append("codigo", codigo);
        formData.append("nombre", nombre);
        formData.append("cargo", cargo);
        formData.append("rol", rol);
        formData.append("email", email);
        formData.append("telefono", telefono);
        formData.append("celular", celular);
        formData.append("direccion", direccion);
        formData.append("fecha_ingreso", fecha_ingreso);
        formData.append("fecha_retiro", fecha_retiro);
        formData.append("fecha_nacimiento", fecha_nacimiento);
        formData.append("eps", eps);
        formData.append("caja", caja);
        formData.append("arl", arl);
        formData.append("fondo", fondo);
        formData.append("riesgos", riesgos);
        formData.append("archivo", $("#avataredit")[0].files[0]);

        if (codigo == "") {
            toastr.error("El codigo es obligatorio");
        } else if (nombre == "") {
            toastr.error("El nombre es obligatorio");
        } else {
            $("#btnModificarEmpleado1").attr("disabled", true);
            $("#btnModificarEmpleado1").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "empleados_update",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Empleado modificado correctamente");
                        $("#btnModificarEmpleado1").attr("disabled", false);
                        $("#btnModificarEmpleado1").html("Modificar Datos Básicos");
                    } else {
                        toastr.error("Error al modificar el empleado");
                        $("#btnModificarEmpleado1").attr("disabled", false);
                        $("#btnModificarEmpleado1").html("Modificar Datos Básicos");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al modificar el empleado");
                    $("#btnModificarEmpleado1").attr("disabled", false);
                    $("#btnModificarEmpleado1").html("Modificar Datos Básicos");
                },
            });
        }
    });

    $("#btnModificarEmpleado2").click(function () {
        var id = $("#id_empleado_edit").val();
        var observaciones = $("#observaciones_otra_info_edit").val();
        var prestamo = $("#prestamo_otra_info_edit").val();
        var dotacion = $("#periodo_dotacion_otra_info_edit").val();
        var licencia = $("#licencia_otra_info_edit").val();
        var vencimiento_licencia = $("#vencimiento_otra_info_edit").val();
        var multas = $("#multas_pend_otra_info_edit").val();
        var seguridad = $("#implementos_otra_info_edit").val();
        var terminacion_contrato = $("#fecha_culminacion_otra_info_edit").val();

        let formData = new FormData();
        formData.append("update_tipo", 2);
        formData.append("id", id);
        formData.append("observaciones", observaciones);
        formData.append("prestamo", prestamo);
        formData.append("dotacion", dotacion);
        formData.append("licencia", licencia);
        formData.append("vencimiento_licencia", vencimiento_licencia);
        formData.append("multas", multas);
        formData.append("seguridad", seguridad);
        formData.append("terminacion_contrato", terminacion_contrato);

        $("#btnModificarEmpleado2").attr("disabled", true);
        $("#btnModificarEmpleado2").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "empleados_update",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.info == 1) {
                    toastr.success("Empleado modificado correctamente");
                    $("#btnModificarEmpleado2").attr("disabled", false);
                    $("#btnModificarEmpleado2").html("Modificar Otra Información");
                } else {
                    toastr.error("Error al modificar el empleado");
                    $("#btnModificarEmpleado2").attr("disabled", false);
                    $("#btnModificarEmpleado2").html("Modificar Otra Información");
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error("Error al modificar el empleado");
                $("#btnModificarEmpleado2").attr("disabled", false);
                $("#btnModificarEmpleado2").html("Modificar Otra Información");
            },
        });
    });

    $("#btnModificarEmpleado3").click(function () {
        var id = $("#id_empleado_edit").val();
        var sueldo = $("#suelto_nomina_edit").val();
        var incapacidad = $("#incapacidad_nomina_edit").val();
        var dia_trabajo = $("#dia_trabajo_nomina_edit").val();
        var total_devengado = $("#total_devengado_nomina_edit").val();
        var dias_laborados = $("#dias_laborados_nomina_edit").val();
        var salud = $("#salud_nomina_edit").val();
        var quincena = $("#quincena_nomina_edit").val();
        var pension = $("#pension_nomina_edit").val();
        var extras = $("#extras_nomina_edit").val();
        var fsp = $("#fps_nomina_edit").val();
        var subsidio = $("#subsidio_transporte_nomina_edit").val();
        var retencion = $("#retencion_fte_nomina_edit").val();
        var transporte = $("#transporte_adicional_nomina_edit").val();
        var total_global = $("#total_global_nomina_edit").val();

        let formData = new FormData();
        formData.append("update_tipo", 3);
        formData.append("id", id);
        formData.append("sueldo", sueldo);
        formData.append("incapacidad", incapacidad);
        formData.append("dia_trabajo", dia_trabajo);
        formData.append("total_devengado", total_devengado);
        formData.append("dias_laborados", dias_laborados);
        formData.append("salud", salud);
        formData.append("quincena", quincena);
        formData.append("pension", pension);
        formData.append("extras", extras);
        formData.append("fsp", fsp);
        formData.append("subsidio", subsidio);
        formData.append("retencion", retencion);
        formData.append("transporte", transporte);
        formData.append("total_global", total_global);

        $("#btnModificarEmpleado3").attr("disabled", true);
        $("#btnModificarEmpleado3").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "empleados_update",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.info == 1) {
                    toastr.success("Empleado modificado correctamente");
                    $("#btnModificarEmpleado3").attr("disabled", false);
                    $("#btnModificarEmpleado3").html("Modificar Configuración Nomina");
                } else {
                    toastr.error("Error al modificar el empleado");
                    $("#btnModificarEmpleado3").attr("disabled", false);
                    $("#btnModificarEmpleado3").html("Modificar Configuración Nomina");
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error("Error al modificar el empleado");
                $("#btnModificarEmpleado3").attr("disabled", false);
                $("#btnModificarEmpleado3").html("Modificar Configuración Nomina");
            },
        });
    });

    $("#btnAgregarEmpleado").click(function () {
        var codigo = $("#codigo_empleado_add").val();
        var nombre = $("#nombre_empleado_add").val();
        var cargo = $("#cargo_empleado_add").val();
        var rol = $("#rol_empleado_add").val();
        var email = $("#email_add").val();
        var telefono = $("#telefono_fij_add").val();
        var celular = $("#telefono_cel_add").val();
        var direccion = $("#direccion_add").val();
        var fecha_ingreso = $("#fecha_ingreso_add").val();
        var fecha_retiro = $("#fecha_retiro_add").val();
        var fecha_nacimiento = $("#fecha_nacimiento_add").val();
        var eps = $("#eps_add").val();
        var caja = $("#caja_compensacion_add").val();
        var arl = $("#arl_add").val();
        var fondo = $("#fondo_pension_add").val();
        var riesgos = $("#riesgos_prof_add").val();

        let formData = new FormData();
        formData.append("codigo", codigo);
        formData.append("nombre", nombre);
        formData.append("cargo", cargo);
        formData.append("rol", rol);
        formData.append("email", email);
        formData.append("telefono", telefono);
        formData.append("celular", celular);
        formData.append("direccion", direccion);
        formData.append("fecha_ingreso", fecha_ingreso);
        formData.append("fecha_retiro", fecha_retiro);
        formData.append("fecha_nacimiento", fecha_nacimiento);
        formData.append("eps", eps);
        formData.append("caja", caja);
        formData.append("arl", arl);
        formData.append("fondo", fondo);
        formData.append("riesgos", riesgos);
        formData.append("archivo", $("#avataradd")[0].files[0]);

        if (codigo == "") {
            toastr.error("El codigo es obligatorio");
        } else if (nombre == "") {
            toastr.error("El nombre es obligatorio");
        } else if (email == "") {
            toastr.error("El email es obligatorio");
        } else {
            $("#btnAgregarEmpleado").attr("disabled", true);
            $("#btnAgregarEmpleado").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "empleados_add",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.info == 1) {
                        toastr.success("Empleado creado correctamente");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al crear el empleado");
                        $("#btnAgregarEmpleado").attr("disabled", false);
                        $("#btnAgregarEmpleado").html("Agregar Empleado");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al crear el empleado");
                    $("#btnAgregarEmpleado").attr("disabled", false);
                    $("#btnAgregarEmpleado").html("Agregar Empleado");
                },
            });
        }
    });
});
