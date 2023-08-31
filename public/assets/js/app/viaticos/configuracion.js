$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btn_Edit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var valor = $(this).data("valor");

        $("#nombreedit").val(nombre);
        $("#valoredit").val(valor);
        $("#id_edit").val(id);

        $("#modalEdit").modal("show");
    });

    $("#btnEditar").click(function (e) {
        e.preventDefault();
        var valor = $("#valoredit").val();
        var id = $("#id_edit").val();

        if (valor == "") {
            toastr.error("El campo valor es obligatorio");
        } else {
            $("#btnEditar").attr("disabled", true);
            $("#btnEditar").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );
            $.ajax({
                url: "config_viaticos_edit",
                type: "POST",
                data: {
                    valor: valor,
                    id: id,
                },
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Valor modificado correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(
                            "Ha ocurrido un error al modificar el valor"
                        );
                        $("#btnEditar").attr("disabled", false);
                        $("#btnEditar").html("Modificar");
                    }
                },
                error: function (error) {
                    toastr.error("Ha ocurrido un error al editar el valor");
                    $("#btnEditar").attr("disabled", false);
                    $("#btnEditar").html("Modificar");
                    console.log(error);
                },
            });
        }
    });
});