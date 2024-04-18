$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";
    let clientes = JSON.parse(localStorage.getItem("clientes"));

    $(".open-toggle").trigger("click");

    $(document).on("keyup", ".input_dinner", function () {
        let v = $(this).val().replace(/\D+/g, "");
        if (v.length > 14) v = v.slice(0, 14);
        $(this).val(
            v
                .replace(/(\d)(\d\d)$/, "$1,$2")
                .replace(/(^\d{1,3}|\d{3})(?=(?:\d{3})+(?:,|$))/g, "$1.")
        );
    });

    $("#btnCargarExcel").click(function () {
        let mes = $("#mesadd").val();
        let anio = $("#anioadd").val();
        let fileInput = document.getElementById("exceladd");
        let file = fileInput.files[0]; // Obtener el archivo seleccionado

        if (mes < 1) {
            toastr.error("Debe seleccionar un mes");
        } else if (anio < 1 || anio > 9999 || anio.length != 4) {
            toastr.error("Debe ingresar un año válido");
        } else {
            $.ajax({
                url: "valid_concil_bancaria",
                type: "POST",
                data: {
                    mes: mes,
                    anio: anio,
                },
                success: function (response) {
                    if (response.info == 1) {
                        if (!file) {
                            $("#show_content_excel").removeClass("d-none");
                            $("#show_list_excel").addClass("d-none");
                            $("#modalAdd").modal("hide");
                        } else {
                            // Validar el tipo de archivo (extensión)
                            const allowedExtensions = [".xlsx"];
                            const fileExtension = file.name
                                .split(".")
                                .pop()
                                .toLowerCase();

                            if (
                                !allowedExtensions.includes(`.${fileExtension}`)
                            ) {
                                toastr.error(
                                    "El archivo debe ser de tipo .xlsx"
                                );
                            } else if (file.size > 5 * 1024 * 1024) {
                                toastr.error(
                                    "El archivo no debe ser mayor a 5MB"
                                );
                            } else {
                                const reader = new FileReader();

                                reader.onload = function (e) {
                                    const data = new Uint8Array(
                                        e.target.result
                                    );
                                    const workbook = XLSX.read(data, {
                                        type: "array",
                                    });
                                    const sheetName = workbook.SheetNames[0];
                                    const worksheet =
                                        workbook.Sheets[sheetName];
                                    const excelData = XLSX.utils.sheet_to_json(
                                        worksheet,
                                        {
                                            header: 1,
                                        }
                                    );

                                    // Limpiar la tabla antes de mostrar los datos
                                    const table =
                                        document.getElementById("excelTable");
                                    const tbody = table.querySelector("tbody");
                                    tbody.innerHTML = "";

                                    // Encuentra los índices de las columnas "DÉBITO" y "CRÉDITO"
                                    const debitoColumnIndex =
                                        excelData[0].indexOf("DÉBITO");
                                    const creditoColumnIndex =
                                        excelData[0].indexOf("CRÉDITO");

                                    // Iterar a partir de la segunda fila (índice 1)
                                    for (let i = 1; i < excelData.length; i++) {
                                        const row = excelData[i];
                                        const newRow = tbody.insertRow();

                                        for (let j = 0; j < row.length; j++) {
                                            if (j !== 3 && j !== 2) {
                                                // Omitir la cuarta columna (DCTO)
                                                const newCell =
                                                    newRow.insertCell();
                                                if (j === 0) {
                                                    // Formatear la fecha en el formato "DD/MM/YYYY"
                                                    const dateParts =
                                                        row[j].split("/");
                                                    const formattedDate =
                                                        new Date(
                                                            anio,
                                                            dateParts[1] - 1,
                                                            dateParts[0]
                                                        )
                                                            .toISOString()
                                                            .split("T")[0];
                                                    let ultimoDiaDelMes =
                                                        new Date(
                                                            anio,
                                                            mes,
                                                            0
                                                        ).getDate();

                                                    let input =
                                                        document.createElement(
                                                            "input"
                                                        );
                                                    input.setAttribute(
                                                        "type",
                                                        "date"
                                                    );
                                                    input.setAttribute(
                                                        "class",
                                                        "fecha_add form-control"
                                                    );
                                                    input.setAttribute(
                                                        "min",
                                                        `${anio}-${mes
                                                            .toString()
                                                            .padStart(
                                                                2,
                                                                "0"
                                                            )}-01`
                                                    );
                                                    input.setAttribute(
                                                        "max",
                                                        `${anio}-${mes
                                                            .toString()
                                                            .padStart(
                                                                2,
                                                                "0"
                                                            )}-${ultimoDiaDelMes
                                                            .toString()
                                                            .padStart(2, "0")}`
                                                    );
                                                    input.setAttribute(
                                                        "value",
                                                        formattedDate
                                                    );
                                                    newCell.appendChild(input);
                                                } else if (
                                                    j ===
                                                    row.length - 2
                                                ) {
                                                    // Verificar si el valor es positivo o negativo
                                                    const valor = parseFloat(
                                                        row[j].replace(/,/g, "")
                                                    );

                                                    if (valor >= 0) {
                                                        // Colocar el valor en "DÉBITO"
                                                        newRow.insertCell(
                                                            debitoColumnIndex
                                                        ).textContent =
                                                            valor.toLocaleString(
                                                                "de-DE",
                                                                {
                                                                    minimumFractionDigits: 2,
                                                                    maximumFractionDigits: 2,
                                                                }
                                                            );

                                                        newRow.insertCell(
                                                            creditoColumnIndex
                                                        ); // Agregar una celda vacía en "CRÉDITO"
                                                    } else {
                                                        // Colocar el valor (negativo) en "CRÉDITO"
                                                        newRow.insertCell(
                                                            debitoColumnIndex
                                                        ); // Agregar una celda vacía en "DÉBITO"

                                                        newRow.insertCell(
                                                            creditoColumnIndex
                                                        ).textContent =
                                                            (-valor).toLocaleString(
                                                                "de-DE",
                                                                {
                                                                    minimumFractionDigits: 2,
                                                                    maximumFractionDigits: 2,
                                                                }
                                                            );
                                                    }

                                                    // Eliminar fila 2
                                                    newRow.deleteCell(2);
                                                } else if (
                                                    j ===
                                                    row.length - 1
                                                ) {
                                                    // Formatear el número en dinero con separadores de miles y coma decimal
                                                    const formattedNumber =
                                                        parseFloat(
                                                            row[j].replace(
                                                                /,/g,
                                                                ""
                                                            )
                                                        ).toLocaleString(
                                                            "de-DE",
                                                            {
                                                                minimumFractionDigits: 2,
                                                                maximumFractionDigits: 2,
                                                            }
                                                        );

                                                    let input =
                                                        document.createElement(
                                                            "input"
                                                        );
                                                    input.setAttribute(
                                                        "type",
                                                        "text"
                                                    );
                                                    input.setAttribute(
                                                        "class",
                                                        "saldo_add form-control"
                                                    );
                                                    input.setAttribute(
                                                        "value",
                                                        formattedNumber
                                                    );
                                                    newCell.appendChild(input);
                                                } else {
                                                    //Añadir en input el contenido de la celda
                                                    let input =
                                                        document.createElement(
                                                            "input"
                                                        );
                                                    input.setAttribute(
                                                        "type",
                                                        "text"
                                                    );
                                                    input.setAttribute(
                                                        "class",
                                                        "descripcion_add form-control"
                                                    );
                                                    input.setAttribute(
                                                        "value",
                                                        row[j]
                                                    );
                                                    newCell.appendChild(input);
                                                }
                                            }
                                        }

                                        // Insertar fila documento en la tabla
                                        let select_documento =
                                            document.createElement("select");
                                        select_documento.setAttribute(
                                            "class",
                                            "documento_add form-select"
                                        );
                                        select_documento.setAttribute(
                                            "placeholder",
                                            "Cliente"
                                        );
                                        select_documento.innerHTML =
                                            '<option value="">Seleccione una opción</option>' +
                                            clientes.map((cliente) => {
                                                return `<option value="${cliente.id}">${cliente.razon_social} (${cliente.nit})</option>`;
                                            });
                                        newRow
                                            .insertCell()
                                            .appendChild(select_documento);

                                        //Insertar fila nota en la tabla
                                        let textarea_nota =
                                            document.createElement("textarea");
                                        textarea_nota.setAttribute("rows", "1");
                                        textarea_nota.setAttribute(
                                            "cols",
                                            "20"
                                        );
                                        textarea_nota.setAttribute(
                                            "class",
                                            "nota_add form-control"
                                        );
                                        textarea_nota.setAttribute(
                                            "placeholder",
                                            "Nota"
                                        );
                                        newRow
                                            .insertCell()
                                            .appendChild(textarea_nota);

                                        // Añadir clase "ui-sortable-handle" a la fila
                                        /*newRow.classList.add(
                                            "ui-sortable-handle"
                                        );*/
                                    }
                                };

                                reader.readAsArrayBuffer(file);

                                $("#excelTable tbody")
                                    .sortable({
                                        cursor: "row-resize",
                                        placeholder: "ui-state-highlight",
                                        opacity: "0.55",
                                        items: ".ui-sortable-handle",
                                    })
                                    .disableSelection();

                                setTimeout(() => {
                                    $(".form-select").each(function () {
                                        $(this).select2({
                                            dropdownParent: $(this).parent(),
                                            placeholder: "Seleccione",
                                            searchInputPlaceholder: "Buscar",
                                            allowClear: true,
                                        });
                                    });
                                }, 1000);

                                $("#show_content_excel").removeClass("d-none");
                                $("#show_list_excel").addClass("d-none");
                                $("#modalAdd").modal("hide");
                                toastr.success("Archivo cargado correctamente");
                            }
                        }
                    } else {
                        toastr.error("La fecha ya se encuentra registrada");
                    }

                    $("#btnCargarExcel").prop("disabled", false);
                    $("#btnCargarExcel").html("Seleccionar");
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al guardar el pago");
                    $("#btnCargarExcel").prop("disabled", false);
                    $("#btnCargarExcel").html("Seleccionar");
                },
            });
        }
    });

    $("#newRowAdd").click(function () {
        let mes = $("#mesadd").val();
        let anio = $("#anioadd").val();
        let last_value = "0.00";
        if ($("#excelTable tbody tr:last-child").length > 0) {
            last_value = $("#excelTable tbody tr:last-child .saldo_add").val();
        }

        $("#excelTable tbody").append(
            '<tr class="ui-sortable-handle">' +
                '<td><input type="date" class="form-control fecha_add"></td>' +
                '<td><input type="text" class="form-control descripcion_add"></td>' +
                '<td><input type="text" class="form-control input_dinner debito_add"></td>' +
                '<td><input type="text" class="form-control input_dinner credito_add"></td>' +
                '<td><input type="text" class="form-control input_dinner saldo_add" value="' +
                last_value +
                '"></td>' +
                '<td><select class="form-select documento_add" placeholder="Cliente">' +
                '<option value="">Seleccione una opción</option>' +
                clientes.map((cliente) => {
                    return `<option value="${cliente.id}">${cliente.razon_social} (${cliente.nit})</option>`;
                }) +
                '<td><div class="d-flex"><textarea rows="1" cols="20" class="form-control nota_add" placeholder="Nota"></textarea><i class="fas fa-trash-alt text-danger btnDeleteRow mt-2" style="margin-left: 6px"></i></div></td>' +
                "</tr>"
        );

        $(".form-select").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "Seleccione",
                searchInputPlaceholder: "Buscar",
                allowClear: true,
            });
        });

        //No permitir ingresar fechas menores y mayores al mes y año seleccionado
        let ultimoDiaDelMes = new Date(anio, mes, 0).getDate();

        $("#excelTable tbody tr:last-child input[type=date]").attr(
            "min",
            `${anio}-${mes.toString().padStart(2, "0")}-01`
        );

        $("#excelTable tbody tr:last-child input[type=date]").attr(
            "max",
            `${anio}-${mes.toString().padStart(2, "0")}-${ultimoDiaDelMes
                .toString()
                .padStart(2, "0")}`
        );

        $("#excelTable tbody")
            .sortable({
                cursor: "row-resize",
                placeholder: "ui-state-highlight",
                opacity: "0.55",
                items: ".ui-sortable-handle",
            })
            .disableSelection();
    });

    $(document).on("click", ".btnDeleteRow", function () {
        $(this).closest("tr").remove();
    });

    $(document).on("change", ".debito_add", function () {
        let valor = $(this).val();
        let saldo = $(this).closest("tr").find(".saldo_add").val();

        if (valor != "") {
            // Deshabitilar el campo "CRÉDITO"
            $(this).closest("tr").find(".credito_add").val("").change();
            $(this).closest("tr").find(".credito_add").prop("disabled", true);

            // Sumar al saldo
            saldo = parseFloat(saldo.replace(/\./g, "").replace(",", "."));
            valor = parseFloat(valor.replace(/\./g, "").replace(",", "."));
            saldo += valor;

            $(this)
                .closest("tr")
                .find(".saldo_add")
                .val(
                    saldo.toLocaleString("de-DE", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    })
                );
        } else {
            $(this).closest("tr").find(".credito_add").prop("disabled", false);
        }

        totales();
    });

    $(document).on("change", ".credito_add", function () {
        let valor = $(this).val();
        let saldo = $(this).closest("tr").find(".saldo_add").val();

        if (valor != "") {
            // Deshabitilar el campo "DÉBITO"
            $(this).closest("tr").find(".debito_add").val("").change();
            $(this).closest("tr").find(".debito_add").prop("disabled", true);

            // Restar al saldo
            saldo = parseFloat(saldo.replace(/\./g, "").replace(",", "."));
            valor = parseFloat(valor.replace(/\./g, "").replace(",", "."));
            saldo -= valor;

            $(this)
                .closest("tr")
                .find(".saldo_add")
                .val(
                    saldo.toLocaleString("de-DE", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    })
                );
        } else {
            $(this).closest("tr").find(".debito_add").prop("disabled", false);
        }

        totales();
    });

    $("#btnGuardarExcel").click(function () {
        let mes = $("#mesadd").val();
        let anio = $("#anioadd").val();
        let fileInput = document.getElementById("exceladd");
        let file = fileInput.files[0]; // Obtener el archivo seleccionado
        let saldo_final = $("#excelTable tbody tr:last-child .saldo_add").val();
        let data = [];
        let error = false;

        if (!$("#excelTable tbody tr").html()) {
            error = true;
        }

        $("#excelTable tbody tr").each(function () {
            let fecha = $(this).find(".fecha_add").val();
            let descripcion = $(this).find(".descripcion_add").val();
            let debito = $(this).find(".debito_add").val();
            let credito = $(this).find(".credito_add").val();
            let saldo = $(this).find(".saldo_add").val();
            // let documento = $(this).find(".documento_add").val();
            let cliente = $(this).find(".documento_add").val();
            let nota = $(this).find(".nota_add").val();

            if (fecha == "") {
                error = true;
            } else if (descripcion == "") {
                error = true;
            } else if (!debito && !credito) {
                if ($(this).find("td:nth-child(3)").html() != "") {
                    debito = $(this).find("td:nth-child(3)").html();
                } else if ($(this).find("td:nth-child(4)").html() != "") {
                    credito = $(this).find("td:nth-child(4)").html();
                } else {
                    error = true;
                }
            } else if (
                !saldo ||
                saldo == "" ||
                saldo == "0.00" ||
                saldo == "NaN"
            ) {
                error = true;
            }

            /*if(cliente == "") {
                error = true;
            }*/

            data.push({
                fecha: fecha,
                descripcion: descripcion,
                debito: debito,
                credito: credito,
                saldo: saldo,
                cliente: cliente,
                nota: nota,
            });
        });

        //console.log(data);

        if (error) {
            toastr.error("Revisa los campos");
        } else {
            $("#btnGuardarExcel").prop("disabled", true);
            $("#btnGuardarExcel").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            );

            let formData = new FormData();
            formData.append("mes", mes);
            formData.append("anio", anio);
            formData.append("saldo_final", saldo_final);
            formData.append("data", JSON.stringify(data));
            formData.append("file", file);

            $.ajax({
                url: "add_concil_bancaria",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.info == 1) {
                        toastr.success("Datos guardados correctamente");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error("Error al guardar los datos");
                        $("#btnGuardarExcel").prop("disabled", false);
                        $("#btnGuardarExcel").html("Guardar");
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error("Error al guardar los datos");
                    $("#btnGuardarExcel").prop("disabled", false);
                    $("#btnGuardarExcel").html("Guardar");
                },
            });
        }
    });

    $(document).on("click", ".btnView", function () {
        let id = $(this).attr("data-id");
        $("#global-loader").fadeIn("slow");

        $.ajax({
            url: "data_concil_bancaria",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                $("#global-loader").fadeOut("slow");
                if (response.info == 1) {
                    let data = response.data;
                    let detalle = response.data.detalle;
                    //console.log(data);

                    $("#excelTableView tbody").html("");

                    detalle.forEach((item) => {
                        let fecha = new Date(item.fecha);
                        let fecha_format =
                            fecha.getDate() +
                            "/" +
                            (fecha.getMonth() + 1) +
                            "/" +
                            fecha.getFullYear();

                        let debito = item.debito ? item.debito : "";
                        let credito = item.credito ? item.credito : "";
                        let saldo = item.saldo;
                        let cliente = item.cliente ? item.nombre_cliente + " (" + item.nit_cliente + ")" : "";

                        $("#excelTableView tbody").append(
                            "<tr>" +
                                "<td>" +
                                fecha_format +
                                "</td>" +
                                "<td>" +
                                item.descripcion +
                                "</td>" +
                                "<td>" +
                                debito +
                                "</td>" +
                                "<td>" +
                                credito +
                                "</td>" +
                                "<td>" +
                                saldo +
                                "</td>" +
                                "<td>" +
                                cliente +
                                "</td>" +
                                "<td>" +
                                item.nota +
                                "</td>" +
                                "</tr>"
                        );
                    });

                    $("#show_list_excel").addClass("d-none");
                    $("#view_content_excel").removeClass("d-none");
                } else {
                    toastr.error("Error al cargar la información");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                console.log(error);
                toastr.error("Error al cargar la información");
            },
        });
    });

    $(document).on("click", ".btnEdit", function () {
        let id = $(this).attr("data-id");

        $("#global-loader").fadeIn("slow");

        $.ajax({
            url: "data_concil_bancaria",
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                $("#global-loader").fadeOut("slow");
                if (response.info == 1) {
                    let data = response.data;
                    console.log(data);
                } else {
                    toastr.error("Error al cargar la información");
                }
            },
            error: function (error) {
                $("#global-loader").fadeOut("slow");
                console.log(error);
                toastr.error("Error al cargar la información");
            },
        });
    });

    $(document).on("click", ".btnCompletar", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Está seguro de completar la conciliación bancaria?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Completar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "completar_concil_bancaria",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Conciliación bancaria completada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(
                                "Error al completar la conciliación bancaria"
                            );
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error(
                            "Error al completar la conciliación bancaria"
                        );
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnDesaprobar", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Está seguro de rechazar la conciliación bancaria?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Rechazar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "rechazar_concil_bancaria",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Conciliación bancaria rechazada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(
                                "Error al rechazar la conciliación bancaria"
                            );
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error(
                            "Error al rechazar la conciliación bancaria"
                        );
                    },
                });
            }
        });
    });

    $(document).on("click", ".btnDelete", function () {
        let id = $(this).attr("data-id");

        Swal.fire({
            title: "¿Está seguro de eliminar la conciliación bancaria?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "eliminar_concil_bancaria",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        if (response.info == 1) {
                            toastr.success("Conciliación bancaria eliminada");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(
                                "Error al eliminar la conciliación bancaria"
                            );
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error(
                            "Error al eliminar la conciliación bancaria"
                        );
                    },
                });
            }
        });
    });

    function totales() {}
});
