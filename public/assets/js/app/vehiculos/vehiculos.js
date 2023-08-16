$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var vehiculo_global = 0;
    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $("#div_content_salud").hide();
    $("#div_content_gruas").hide();
    $("#div_content_tecnicos").hide();
    $("#div_content_inspeccion").hide();
    $("#div_list_vehiculos").show();
    $(".open-toggle").trigger("click");

    $("#back_table_salud").click(function (e) {
        e.preventDefault();
        $("#div_content_salud").hide();
        $("#div_list_vehiculos").show();
    });

    $("#back_table_gruas").click(function (e) {
        e.preventDefault();
        $("#div_content_gruas").hide();
        $("#div_list_vehiculos").show();
    });

    $("#back_table_tecnicos").click(function (e) {
        e.preventDefault();
        $("#div_content_tecnicos").hide();
        $("#div_list_vehiculos").show();
    });

    $("#back_table_inspeccion").click(function (e) {
        e.preventDefault();
        $("#div_content_inspeccion").hide();
        $("#div_list_vehiculos").show();
    });

    let editor_add;
    let editor_edit;

    ClassicEditor.create(document.querySelector("#observacionesadd"), {
        toolbar: [
            "heading",
            "|",
            "bold",
            "italic",
            "link",
            "insertTable",
            "bulletedList",
            "numberedList",
            "blockQuote",
        ],
        heading: {
            options: [
                {
                    model: "paragraph",
                    title: "Texto",
                    class: "ck-heading_paragraph",
                },
                {
                    model: "heading1",
                    view: "h1",
                    title: "Título",
                    class: "ck-heading_heading1",
                },
                {
                    model: "heading2",
                    view: "h2",
                    title: "Subtítulo",
                    class: "ck-heading_heading2",
                },
            ],
        },
    })
        .then((newEditorAdd) => {
            editor_add = newEditorAdd;
        })
        .catch((error) => {
            console.log(error);
        });

    ClassicEditor.create(document.querySelector("#observacionesedit"), {
        toolbar: [
            "heading",
            "|",
            "bold",
            "italic",
            "link",
            "insertTable",
            "bulletedList",
            "numberedList",
            "blockQuote",
        ],
        heading: {
            options: [
                {
                    model: "paragraph",
                    title: "Texto",
                    class: "ck-heading_paragraph",
                },
                {
                    model: "heading1",
                    view: "h1",
                    title: "Título",
                    class: "ck-heading_heading1",
                },
                {
                    model: "heading2",
                    view: "h2",
                    title: "Subtítulo",
                    class: "ck-heading_heading2",
                },
            ],
        },
    })
        .then((newEditorEdit) => {
            editor_edit = newEditorEdit;
        })
        .catch((error) => {
            console.log(error);
        });

    $("#btnGuardarVehiculo").click(function (e) {
        e.preventDefault();
        let placa = $("#placaadd").val();
        let modelo = $("#modeloadd").val();
        let marca = $("#marcaadd").val();
        let color = $("#coloradd").val();
        let tipo_carroceria = $("#corroseriaadd").val();
        let capacidad = $("#capacidadadd").val();
        let combustible = $("#combustibleadd").val();
        let cilindraje = $("#cilindrajeadd").val();
        let motor = $("#motoradd").val();
        let serie = $("#serieadd").val();
        let chasis = $("#chasisadd").val();
        let clase = $("#claseadd").val();
        let matricula = $("#matriculadd").val();
        let puertas = $("#puertasadd").val();
        let transito = $("#transitoadd").val();
        let licencia = $("#licenciaadd").val();
        let propietario = $("#propietarioadd").val();
        let identificacion = $("#identificacionadd").val();
        let observaciones = editor_add.getData();
        let foto = $("#fotoadd")[0].files[0];

        let formData = new FormData();
        formData.append("placa", placa);
        formData.append("modelo", modelo);
        formData.append("marca", marca);
        formData.append("color", color);
        formData.append("tipo_carroceria", tipo_carroceria);
        formData.append("capacidad", capacidad);
        formData.append("combustible", combustible);
        formData.append("cilindraje", cilindraje);
        formData.append("motor", motor);
        formData.append("serie", serie);
        formData.append("chasis", chasis);
        formData.append("clase", clase);
        formData.append("matricula", matricula);
        formData.append("puertas", puertas);
        formData.append("transito", transito);
        formData.append("licencia", licencia);
        formData.append("propietario", propietario);
        formData.append("identificacion", identificacion);
        formData.append("observaciones", observaciones);
        formData.append("foto", foto);

        $("#btnGuardarVehiculo");
        $("#btnGuardarVehiculo").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "vehiculos_create",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al guardar el vehiculo");
                    $("#btnGuardarVehiculo").attr("disabled", false);
                    $("#btnGuardarVehiculo").html("Guardar");
                }
            },
            error: function (error) {
                toastr.error("Error al guardar el vehiculo");
                $("#btnGuardarVehiculo").attr("disabled", false);
                $("#btnGuardarVehiculo").html("Guardar");
            },
        });
    });

    $(document).on("click", ".btn_Show", function () {
        $("#global-loader").fadeIn("fast");
        let id = $(this).data("id");
        $.ajax({
            url: "data_vehiculo",
            data: { id: id },
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                let data = response.success;
                $("#modalEdit").modal("show");
                $("#modalEdit input").attr("disabled", "disabled");
                $("#modalEdit select").attr("disabled", "disabled");
                $("#modalEdit textarea").attr("disabled", "disabled");
                $("#modalEdit .modal-footer").addClass("d-none");
                editor_edit.enableReadOnlyMode("editor");

                $("#imagenedit").attr(
                    "src",
                    url_general + "images/vehiculos/" + data.foto
                );
                $("#placaedit").val(data.placa);
                $("#modeloedit").val(data.modelo);
                $("#marcaedit").val(data.marca);
                $("#coloredit").val(data.color);
                $("#corroseriaedit").val(data.tipo_carroceria);
                $("#capacidadedit").val(data.capacidad);
                $("#combustibleedit").val(data.combustible);
                $("#cilindrajeedit").val(data.cilindraje);
                $("#motoredit").val(data.motor);
                $("#serieedit").val(data.serie);
                $("#chasisedit").val(data.chasis);
                $("#claseedit").val(data.clase);
                $("#matriculedit").val(data.matricula);
                $("#puertasedit").val(data.puertas);
                $("#transitoedit").val(data.transito);
                $("#licenciaedit").val(data.licencialicencia);
                $("#propietarioedit").val(data.propietario);
                $("#identificacionedit").val(data.identificacion);
                editor_edit.setData(data.observaciones);
                $("#global-loader").fadeOut("fast");
            },
            error: function (error) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar los datos");
            },
        });
    });

    $(document).on("click", ".btn_Edit", function () {
        $("#global-loader").fadeIn("fast");
        let id = $(this).data("id");
        $.ajax({
            url: "data_vehiculo",
            data: { id: id },
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                let data = response.success;
                $("#modalEdit").modal("show");
                $("#modalEdit input").removeAttr("disabled");
                $("#modalEdit select").removeAttr("disabled");
                $("#modalEdit textarea").removeAttr("disabled");
                $("#modalEdit .modal-footer").removeClass("d-none");
                editor_edit.disableReadOnlyMode("editor");

                $("#imagenedit").attr(
                    "src",
                    url_general + "images/vehiculos/" + data.foto
                );
                $("#idedit").val(data.id);

                $("#placaedit").val(data.placa);
                $("#modeloedit").val(data.modelo);
                $("#marcaedit").val(data.marca);
                $("#coloredit").val(data.color);
                $("#corroseriaedit").val(data.tipo_carroceria);
                $("#capacidadedit").val(data.capacidad);
                $("#combustibleedit").val(data.combustible);
                $("#cilindrajeedit").val(data.cilindraje);
                $("#motoredit").val(data.motor);
                $("#serieedit").val(data.serie);
                $("#chasisedit").val(data.chasis);
                $("#claseedit").val(data.clase);
                $("#matriculedit").val(data.matricula);
                $("#puertasedit").val(data.puertas);
                $("#transitoedit").val(data.transito);
                $("#licenciaedit").val(data.licencialicencia);
                $("#propietarioedit").val(data.propietario);
                $("#identificacionedit").val(data.identificacion);
                editor_edit.setData(data.observaciones);
                $("#global-loader").fadeOut("fast");
            },
            error: function (error) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar los datos");
            },
        });
    });

    $("#btnEditarVehiculo").click(function (e) {
        e.preventDefault();
        let id = $("#idedit").val();
        let placa = $("#placaedit").val();
        let modelo = $("#modeloedit").val();
        let marca = $("#marcaedit").val();
        let color = $("#coloredit").val();
        let tipo_carroceria = $("#corroseriaedit").val();
        let capacidad = $("#capacidadedit").val();
        let combustible = $("#combustibleedit").val();
        let cilindraje = $("#cilindrajeedit").val();
        let motor = $("#motoredit").val();
        let serie = $("#serieedit").val();
        let chasis = $("#chasisedit").val();
        let clase = $("#claseedit").val();
        let matricula = $("#matriculedit").val();
        let puertas = $("#puertasedit").val();
        let transito = $("#transitoedit").val();
        let licencia = $("#licenciaedit").val();
        let propietario = $("#propietarioedit").val();
        let identificacion = $("#identificacionedit").val();
        let observaciones = editor_edit.getData();
        let foto = $("#fotoedit")[0].files[0];

        let formData = new FormData();
        formData.append("id", id);
        formData.append("placa", placa);
        formData.append("modelo", modelo);
        formData.append("marca", marca);
        formData.append("color", color);
        formData.append("tipo_carroceria", tipo_carroceria);
        formData.append("capacidad", capacidad);
        formData.append("combustible", combustible);
        formData.append("cilindraje", cilindraje);
        formData.append("motor", motor);
        formData.append("serie", serie);
        formData.append("chasis", chasis);
        formData.append("clase", clase);
        formData.append("matricula", matricula);
        formData.append("puertas", puertas);
        formData.append("transito", transito);
        formData.append("licencia", licencia);
        formData.append("propietario", propietario);
        formData.append("identificacion", identificacion);
        formData.append("observaciones", observaciones);
        formData.append("foto", foto);

        $("#btnEditarVehiculo");
        $("#btnEditarVehiculo").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "vehiculos_edit",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.info == 1) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al modificar el vehiculo");
                    $("#btnEditarVehiculo").attr("disabled", false);
                    $("#btnEditarVehiculo").html("Modificar");
                }
            },
            error: function (error) {
                toastr.error("Error al modificar el vehiculo");
                $("#btnEditarVehiculo").attr("disabled", false);
                $("#btnEditarVehiculo").html("Modificar");
            },
        });
    });

    $(document).on("click", ".btn_Delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar este vehículo?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "delete_vehiculo",
                    data: { id: id },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success(response.success);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Error al eliminar el vehiculo");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar el vehiculo");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_Encuesta", function () {
        $("#global-loader").fadeIn("fast");

        if ($.fn.DataTable.isDataTable("#table_salud_vehiculos")) {
            $("#table_salud_vehiculos").DataTable().destroy();
        }

        $("#table_salud_vehiculos tbody").empty();

        $.ajax({
            url: "data_salud_vehiculos",
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                let data = response.success;

                data.forEach((element) => {
                    $("#table_salud_vehiculos tbody").append(`
                        <tr>
                            <td>${element.creador}</td>
                            <td>${element.fecha}</td>
                            <td class="d-flex">
                                <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowEncuesta"><i class="fa fa-eye"></i></a>&nbsp;
                                <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteEncuesta"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `);
                });

                $("#table_salud_vehiculos").DataTable({
                    order: [],
                });
                //console.log(data);
                $("#div_content_salud").show();
                $("#div_list_vehiculos").hide();
                $("#global-loader").fadeOut("fast");
            },
            error: function (error) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Error al cargar los datos");
            },
        });
    });

    $(document).on("click", ".btn_Gestionar", function () {
        let id = $(this).data("id");
        vehiculo_global = id;
        $("#modalViewGestionar").modal("show");
    });

    $("#btnAgregarEncuesta").click(function () {
        let sede = $("#sede_add").val();
        let uno = $("#uno_add").val();
        let dos = $("#dos_add").val();
        let tres = $("#tres_add").val();
        let cuatro = $("#cuatro_add").val();
        let cinco = $("#cinco_add").val();
        let seis = $("#seis_add").val();
        let siete = $("#siete_add").val();
        let ocho = $("#ocho_add").val();
        let nueve = $("#nueve_add").val();
        let diez = $("#diez_add").val();
        let once = $("#once_add").val();
        let doce = $("#doce_add").val();
        let trece = $("#trece_add").val();

        if (sede == "") {
            toastr.error("Debe ingresar una sede");
            return false;
        } else {
            $("#btnAgregarEncuesta");
            $("#btnAgregarEncuesta").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "add_encuesta_salud",
                data: {
                    sede: sede,
                    uno: uno,
                    dos: dos,
                    tres: tres,
                    cuatro: cuatro,
                    cinco: cinco,
                    seis: seis,
                    siete: siete,
                    ocho: ocho,
                    nueve: nueve,
                    diez: diez,
                    once: once,
                    doce: doce,
                    trece: trece,
                },
                type: "POST",
                dataType: "JSON",
                success: function (response) {
                    if (response.info == 1) {
                        let encuestas = response.encuestas;

                        $("#table_salud_vehiculos").DataTable().destroy();
                        $("#table_salud_vehiculos tbody").empty();

                        encuestas.forEach((element) => {
                            $("#table_salud_vehiculos tbody").append(`
                                <tr>
                                <td>${element.creador}</td>
                                <td>${element.fecha}</td>
                                <td class="d-flex">
                                <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowEncuesta"><i class="fa fa-eye"></i></a>&nbsp;
                                <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteEncuesta"><i class="fa fa-trash"></i></a>
                                </td>
                                </tr>
                                `);
                        });

                        $("#table_salud_vehiculos").DataTable({
                            order: [],
                        });
                        $("#sede_add").val("");
                        $("#btnAgregarEncuesta").attr("disabled", false);
                        $("#btnAgregarEncuesta").html("Agregar Encuesta");
                        toastr.success("Encuesta agregada correctamente");
                    } else {
                        toastr.error("Error al agregar la encuesta");
                        $("#btnAgregarEncuesta").attr("disabled", false);
                        $("#btnAgregarEncuesta").html("Agregar Encuesta");
                    }
                },
            });
        }
    });

    $(document).on("click", ".btn_ShowEncuesta", function () {
        let id = $(this).data("id");
        $("#global-loader").fadeIn("fast");
        $.ajax({
            url: "show_encuesta_salud",
            data: { id: id },
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                let data = response.data;
                console.log(data);
                $("#global-loader").fadeOut("fast");

                $("#sede_view").val(data.sede);
                $("#dolor_garganta_view")
                    .val(data.dolor_garganta)
                    .trigger("change");
                $("#uno_view").val(data.malestar_general).trigger("change");
                $("#dos_view").val(data.fiebre).trigger("change");
                $("#tres_view").val(data.tos_seca).trigger("change");
                $("#cuatro_view").val(data.perdida_olfato).trigger("change");
                $("#cinco_view").val(data.contacto_covid19).trigger("change");
                $("#seis_view")
                    .val(data.res_diagnostico_covid19)
                    .trigger("change");
                $("#siete_view").val(data.res_servicio_salud).trigger("change");
                $("#ocho_view").val(data.res_65years).trigger("change");
                $("#nueve_view")
                    .val(data.res_enfermedades_cronicas)
                    .trigger("change");
                $("#diez_view").val(data.botas).trigger("change");
                $("#once_view").val(data.uniforme).trigger("change");
                $("#doce_view").val(data.declaracion).trigger("change");
                $("#modalViewEncuesta").modal("show");
            },
            error: function (error) {
                toastr.error("Error al cargar los datos");
                $("#global-loader").fadeOut("fast");
            },
        });
    });

    $(document).on("click", ".btn_DeleteEncuesta", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar esta encuesta?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "delete_encuesta_salud",
                    data: { id: id },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            let encuestas = response.encuestas;

                            $("#table_salud_vehiculos").DataTable().destroy();
                            $("#table_salud_vehiculos tbody").empty();

                            encuestas.forEach((element) => {
                                $("#table_salud_vehiculos tbody").append(`
                                <tr>
                                <td>${element.creador}</td>
                                <td>${element.fecha}</td>
                                <td class="d-flex">
                                <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowEncuesta"><i class="fa fa-eye"></i></a>&nbsp;
                                <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteEncuesta"><i class="fa fa-trash"></i></a>
                                </td>
                                </tr>
                                `);
                            });

                            $("#table_salud_vehiculos").DataTable({
                                order: [],
                            });

                            toastr.success("Encuesta eliminada correctamente");
                        } else {
                            toastr.error("Error al eliminar la encuesta");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar la encuesta");
                    },
                });
            }
        });
    });

    $("#btnSelectGestion").click(function () {
        let select = $("#select_gest_view").val();
        let id = $("#id_gest_view").val();

        $("#modalViewGestionar").modal("hide");

        if (select == 1) {
            gruas();
        } else if (select == 2) {
            tecnicos();
        } else if (select == 3) {
            inspecciones();
        }
    });

    function gruas() {
        $("#global-loader").fadeIn("fast");

        $.ajax({
            url: "get_gruas",
            type: "POST",
            dataType: "JSON",
            data: { id: vehiculo_global },
            success: function (response) {
                let gruas = response.gruas;
                if ($.fn.DataTable.isDataTable("#table_gruas_vehiculos")) {
                    $("#table_gruas_vehiculos").DataTable().destroy();
                }

                $("#table_gruas_vehiculos tbody").empty();
                gruas.forEach((element) => {
                    $("#table_gruas_vehiculos tbody").append(`
                    <tr>
                    <td>${element.creador}</td>
                    <td>${element.fecha}</td>
                    <td class="d-flex">
                    <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowGrua"><i class="fa fa-eye"></i></a>&nbsp;
                    <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteGrua"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    `);
                });
                $("#table_gruas_vehiculos").DataTable({
                    order: [],
                });

                $("#div_list_vehiculos").hide();
                $("#div_content_gruas").show();
                $("#global-loader").fadeOut("fast");
            },
            error: function (error) {
                toastr.error("Error al cargar los datos");
                $("#global-loader").fadeOut("fast");
            },
        });
    }

    function tecnicos() {
        $("#global-loader").fadeIn("fast");

        $.ajax({
            url: "get_tecnicos_vehiculos",
            type: "POST",
            dataType: "JSON",
            data: { id: vehiculo_global },
            success: function (response) {
                let gruas = response.gruas;
                if ($.fn.DataTable.isDataTable("#table_tecnico_vehiculos")) {
                    $("#table_tecnico_vehiculos").DataTable().destroy();
                }

                $("#table_tecnico_vehiculos tbody").empty();
                gruas.forEach((element) => {
                    $("#table_tecnico_vehiculos tbody").append(`
                    <tr>
                    <td>${element.creador}</td>
                    <td>${element.fecha}</td>
                    <td class="d-flex">
                    <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowTecnico"><i class="fa fa-eye"></i></a>&nbsp;
                    <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteTecnico"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    `);
                });
                $("#table_tecnico_vehiculos").DataTable({
                    order: [],
                });

                $("#div_list_vehiculos").hide();
                $("#div_content_tecnicos").show();
                $("#global-loader").fadeOut("fast");
            },
            error: function (error) {
                toastr.error("Error al cargar los datos");
                $("#global-loader").fadeOut("fast");
            },
        });
    }

    function inspecciones() {
        $("#global-loader").fadeIn("fast");

        $.ajax({
            url: "get_inspecciones_vehiculos",
            type: "POST",
            dataType: "JSON",
            data: { id: vehiculo_global },
            success: function (response) {
                let gruas = response.gruas;
                if ($.fn.DataTable.isDataTable("#table_inspeccion_vehiculos")) {
                    $("#table_inspeccion_vehiculos").DataTable().destroy();
                }

                $("#table_inspeccion_vehiculos tbody").empty();
                gruas.forEach((element) => {
                    $("#table_inspeccion_vehiculos tbody").append(`
                    <tr>
                    <td>${element.creador}</td>
                    <td>${element.fecha}</td>
                    <td class="d-flex">
                    <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowInspeccion"><i class="fa fa-eye"></i></a>&nbsp;
                    <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteInspeccion"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    `);
                });
                $("#table_inspeccion_vehiculos").DataTable({
                    order: [],
                });

                $("#div_list_vehiculos").hide();
                $("#div_content_inspeccion").show();
                $("#global-loader").fadeOut("fast");
            },
            error: function (error) {
                toastr.error("Error al cargar los datos");
                $("#global-loader").fadeOut("fast");
            },
        });
    }

    $(document).on("click", ".btn_DeleteGrua", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar este checklist?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "delete_encuesta_grua",
                    data: {
                        id: id,
                        id_vehiculo: vehiculo_global,
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            let gruas = response.gruas;

                            $("#table_gruas_vehiculos").DataTable().destroy();
                            $("#table_gruas_vehiculos tbody").empty();

                            gruas.forEach((element) => {
                                $("#table_gruas_vehiculos tbody").append(`
                                <tr>
                                <td>${element.creador}</td>
                                <td>${element.fecha}</td>
                                <td class="d-flex">
                                <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowGrua"><i class="fa fa-eye"></i></a>&nbsp;
                                <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteGrua"><i class="fa fa-trash"></i></a>
                                </td>
                                </tr>
                                `);
                            });

                            $("#table_gruas_vehiculos").DataTable({
                                order: [],
                            });

                            toastr.success("CheckList eliminado correctamente");
                        } else {
                            toastr.error("Error al eliminar el checklist");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar el checklist");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_DeleteTecnico", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar este checklist?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "delete_encuesta_tecnico",
                    data: {
                        id: id,
                        id_vehiculo: vehiculo_global,
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            let gruas = response.gruas;

                            $("#table_tecnico_vehiculos").DataTable().destroy();
                            $("#table_tecnico_vehiculos tbody").empty();

                            gruas.forEach((element) => {
                                $("#table_tecnico_vehiculos tbody").append(`
                                <tr>
                                <td>${element.creador}</td>
                                <td>${element.fecha}</td>
                                <td class="d-flex">
                                <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowGrua"><i class="fa fa-eye"></i></a>&nbsp;
                                <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteGrua"><i class="fa fa-trash"></i></a>
                                </td>
                                </tr>
                                `);
                            });

                            $("#table_tecnico_vehiculos").DataTable({
                                order: [],
                            });

                            toastr.success("CheckList eliminado correctamente");
                        } else {
                            toastr.error("Error al eliminar el checklist");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar el checklist");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn_DeleteInspeccion", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "¿Deseas eliminar este checklist?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Cancelar",
            denyButtonText: `Eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: "delete_encuesta_inspeccion",
                    data: {
                        id: id,
                        id_vehiculo: vehiculo_global,
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.info == 1) {
                            let gruas = response.gruas;

                            $("#table_inspeccion_vehiculos")
                                .DataTable()
                                .destroy();
                            $("#table_inspeccion_vehiculos tbody").empty();

                            gruas.forEach((element) => {
                                $("#table_inspeccion_vehiculos tbody").append(`
                                    <tr>
                                    <td>${element.creador}</td>
                                    <td>${element.fecha}</td>
                                    <td class="d-flex">
                                    <a data-id="${element.id}" title="Editar" class="edit btn btn-primary btn-sm btn_ShowInspeccion"><i class="fa fa-eye"></i></a>&nbsp;
                                    <a data-id="${element.id}" title="Eliminar" class="delete btn btn-danger btn-sm btn_DeleteInspeccion"><i class="fa fa-trash"></i></a>
                                    </td>
                                    </tr>
                                    `);
                            });

                            $("#table_inspeccion_vehiculos").DataTable({
                                order: [],
                            });

                            toastr.success("CheckList eliminado correctamente");
                        } else {
                            toastr.error("Error al eliminar el checklist");
                        }
                    },
                    error: function (error) {
                        toastr.error("Error al eliminar el checklist");
                    },
                });
            }
        });
    });
});
