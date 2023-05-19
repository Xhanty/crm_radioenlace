$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let encargados = JSON.parse(localStorage.getItem("encargados"));
    let categorias = JSON.parse(localStorage.getItem("categorias"));
    let accesorios = JSON.parse(localStorage.getItem("accesorios"));

    $(".open-toggle").trigger("click");

    // Ver
    $(document).on("click", ".btnView", function () {
        let id = $(this).attr("data-id");

        $("#global-loader").fadeIn("slow");

        $.ajax({
            url: "reparaciones_info",
            type: "POST",
            data: { id },
            success: function (response) {
                $("#global-loader").fadeOut("fast");
                if (response.info == 1) {
                    let data = response.data;
                    let detalle = response.detalle;

                    $("#cliente_view").val(data.cliente_id).trigger("change");
                    $("#correos_view").val(data.correos);

                    $("#div_reparaciones_view").html("");

                    detalle.forEach(element => {
                        let foto = '<input class="form-control foto_view" type="file" accept="image/*" disabled>';
                        if (element.foto && element.foto != "") {
                            foto = '<img src="images/reparaciones/' + element.foto + '" width="100px" height="100px">';
                        }
                        let accesorios_data = JSON.parse(element.accesorios);
                        for (let i = 0; i < accesorios_data.length; i++) {
                            accesorios_data[i] = parseInt(accesorios_data[i]);
                        }
                        $("#div_reparaciones_view").append('<div style="display: flex;" class="mt-3">' +
                            '<div style="width: 100%; border-bottom: 2px solid #ccc;">' +
                            '<div class="row row-sm">' +
                            '<div class="col-lg">' +
                            '<label for="">Persona que recibe</label>' +
                            '<select class="form-select encargado_view" disabled>' +
                            '<option value="">Seleccione una opción</option>' +
                            encargados.map((encargado) => {
                                if (encargado.id == element.encargado_id) {
                                    return `<option selected value="${encargado.id}">${encargado.nombre}</option>`;
                                } else {
                                    return `<option value="${encargado.id}">${encargado.nombre}</option>`;
                                }
                            }) +
                            '</select>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Categoría</label>' +
                            '<select class="form-select categoria_view" disabled>' +
                            '<option value="">Seleccione una opción</option>' +
                            categorias.map((categoria) => {
                                if (categoria.id == element.categoria_id) {
                                    return `<option selected value="${categoria.id}">${categoria.categoria}</option>`;
                                } else {
                                    return `<option value="${categoria.id}">${categoria.categoria}</option>`;
                                }
                            }) +
                            '</select>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Accesorios</label>' +
                            '<select multiple class="form-select accesorios_view" disabled>' +
                            '<option value="">Seleccione una opción</option>' +
                            accesorios.map((accesorio) => {
                                if (accesorios_data.includes(accesorio.id)) {
                                    return `<option selected value="${accesorio.id}">${accesorio.accesorio}</option>`;
                                } else {
                                    return `<option value="${accesorio.id}">${accesorio.accesorio}</option>`;
                                }
                            }) +
                            '</select>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg">' +
                            '<label for="">Modelo</label>' +
                            '<input class="form-control modelo_view" value="' + element.modelo + '" placeholder="Modelo" type="text" disabled>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Serie</label>' +
                            '<input class="form-control serie_view" value="' + element.serie + '" placeholder="Serie" type="text" disabled>' +
                            '</div>' +
                            '<div class="col-lg">' +
                            '<label for="">Foto</label>' +
                            foto +
                            '</div>' +
                            '</div>' +
                            '<div class="row row-sm mt-2">' +
                            '<div class="col-lg">' +
                            '<label for="">Observaciones</label>' +
                            '<textarea disabled class="form-control observaciones_view" placeholder="Observaciones" rows="3"' +
                            'style="height: 90px; resize: none">' + element.observacion + '</textarea>' +
                            '</div>' +
                            '</div>' +
                            '<br>' +
                            '</div>' +
                            '<div style="display: flex;"">' +
                            '</div>' +
                            '</div>');
                    });

                    $(".form-select").each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: "Seleccione una opción",
                            searchInputPlaceholder: "Buscar",
                        });
                    });

                    $("#modalView").modal("show");
                } else {
                    toastr.error("Ocurrió un error al obtener la información");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("fast");
                toastr.error("Ocurrió un error al obtener la información");
                console.log(error);
            }
        });
    });

    // Completar
    $(document).on("click", ".btnConfirmar", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, completar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "reparaciones_aprobado",
                    type: "POST",
                    data: { id },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Se completó correctamente");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error("Ocurrió un error al completar");
                        }
                    },
                    error: function (error) {
                        toastr.error("Ocurrió un error al completar");
                        console.log(error);
                    }
                });
            }
        });
    });
});
