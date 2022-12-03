$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btnGuardarVehiculo").click(function (e) {
        e.preventDefault();
        let marca = $("#marcaadd").val();
        let modelo = $("#modeloadd").val();
        let tipo_combustible = $("#tipo_combustibleadd").val();
        let year = $("#yearadd").val();
        let soat = $("#soatadd").val();
        let placa = $("#placaadd").val();
        let tecnomecanica = $("#tecnomecanicaadd").val();
        let color = $("#coloradd").val();
        let seguro = $("#seguroadd").val();
        let tipo = $("#tipoadd").val();
        let observaciones = $("#observacionesadd").val();
        let foto = $("#fotoadd")[0].files[0];

        let formData = new FormData();
        formData.append("marca", marca);
        formData.append("modelo", modelo);
        formData.append("tipo_combustible", tipo_combustible);
        formData.append("year", year);
        formData.append("soat", soat);
        formData.append("placa", placa);
        formData.append("tecnomecanica", tecnomecanica);
        formData.append("color", color);
        formData.append("seguro", seguro);
        formData.append("tipo", tipo);
        formData.append("observaciones", observaciones);
        formData.append("foto", foto);

        $("#btnGuardarVehiculo").attr("disabled", true);
        $.ajax({
            url: "vehiculos_create",
            data: formData,
            type: "POST",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if(response.info == 1) {
                    toastr.success(response.success);
                    window.location.href = "vehiculos";
                } else {
                    toastr.error("Error al guardar el vehiculo");
                    $("#btnGuardarVehiculo").attr("disabled", false);
                }
            },
            error: function (error) {
                toastr.error("Error al guardar el vehiculo");
                $("#btnGuardarVehiculo").attr("disabled", false);
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

                $("#imagenedit").attr("src", "http://127.0.0.1:8000/images/vehiculos/" + data.foto);
                $("#marcaedit").val(data.marca);
                $("#modeloedit").val(data.modelo);
                $("#tipo_combustibleedit").val(data.tipo_combustible);
                $("#yearedit").val(data.year);
                $("#soatedit").val(data.soat);
                $("#placaedit").val(data.placa);
                $("#tecnomecanicaedit").val(data.tecnomecanica);
                $("#coloredit").val(data.color);
                $("#seguroedit").val(data.seguro);
                $("#tipoedit").val(data.tipo);
                $("#observacionesedit").val(data.observaciones);
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

                $("#imagenedit").attr("src", "http://127.0.0.1:8000/images/vehiculos/" + data.foto);
                $("#idedit").val(data.id);
                $("#marcaedit").val(data.marca);
                $("#modeloedit").val(data.modelo);
                $("#tipo_combustibleedit").val(data.tipo_combustible);
                $("#yearedit").val(data.year);
                $("#soatedit").val(data.soat);
                $("#placaedit").val(data.placa);
                $("#tecnomecanicaedit").val(data.tecnomecanica);
                $("#coloredit").val(data.color);
                $("#seguroedit").val(data.seguro);
                $("#tipoedit").val(data.tipo);
                $("#observacionesedit").val(data.observaciones);
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
        let marca = $("#marcaedit").val();
        let modelo = $("#modeloedit").val();
        let tipo_combustible = $("#tipo_combustibleedit").val();
        let year = $("#yearedit").val();
        let soat = $("#soatedit").val();
        let placa = $("#placaedit").val();
        let tecnomecanica = $("#tecnomecanicaedit").val();
        let color = $("#coloredit").val();
        let seguro = $("#seguroedit").val();
        let tipo = $("#tipoedit").val();
        let observaciones = $("#observacionesedit").val();
        let foto = $("#fotoedit")[0].files[0];

        let formData = new FormData();
        formData.append("id", id);
        formData.append("marca", marca);
        formData.append("modelo", modelo);
        formData.append("tipo_combustible", tipo_combustible);
        formData.append("year", year);
        formData.append("soat", soat);
        formData.append("placa", placa);
        formData.append("tecnomecanica", tecnomecanica);
        formData.append("color", color);
        formData.append("seguro", seguro);
        formData.append("tipo", tipo);
        formData.append("observaciones", observaciones);
        formData.append("foto", foto);

        $("#btnEditarVehiculo").attr("disabled", true);
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
                    window.location.href = "vehiculos";
                } else {
                    toastr.error("Error al modificar el vehiculo");
                    $("#btnEditarVehiculo").attr("disabled", false);
                }
            },
            error: function (error) {
                toastr.error("Error al modificar el vehiculo");
                $("#btnEditarVehiculo").attr("disabled", false);
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
                            window.location.href = "vehiculos";
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
});
