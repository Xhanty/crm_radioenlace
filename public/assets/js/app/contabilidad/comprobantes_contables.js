$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $(".open-toggle").trigger("click");

    $("#btnCargarExcel").click(function () {
        let fileInput = document.getElementById("exceladd");
        let file = fileInput.files[0]; // Obtener el archivo seleccionado

        if (!file) {
            toastr.error("Debe seleccionar un archivo");
        } else {
            let formData = new FormData();
            formData.append("file", file);

            $.ajax({
                url: "comprobantes_contables_add",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#btnCargarExcel").prop("disabled", true);
                    $("#btnCargarExcel").html("Cargando...");
                },
                success: function (response) {
                    if (response.info == 1) {
                        console.log(response);
                        toastr.success("Archivo cargado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al cargar el archivo");
                        $("#btnCargarExcel").prop("disabled", false);
                        $("#btnCargarExcel").html("Seleccionar");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al cargar el archivo");
                    $("#btnCargarExcel").prop("disabled", false);
                    $("#btnCargarExcel").html("Seleccionar");
                },
            });
        }
    });
});
