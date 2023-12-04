$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

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

    $("#btn_filtrar").click(function () {
        let cliente = $("#cliente_select").val();
        let estado = $("#estado_select").val();
        let producto = $("#producto_select").val();
        let empleado = $("#empleado_select").val();
        let fecha_inicio = $("#inicio_select").val();
        let fecha_fin = $("#fin_select").val();

        // Validar que ingresen al menos un filtro
        if (cliente == "" && estado == "" && producto == "" && empleado == "" && fecha_inicio == "" && fecha_fin == "") {
            toastr.error("Debe ingresar al menos un filtro");
            return false;
        }

        // Validar que la fecha de inicio no sea mayor a la fecha de fin
        if (fecha_inicio != "" && fecha_fin != "") {
            let fecha_inicio = new Date($("#inicio_select").val());
            let fecha_fin = new Date($("#fin_select").val());

            if (fecha_inicio > fecha_fin) {
                toastr.error("La fecha de inicio no puede ser mayor a la fecha de fin");
                return false;
            }
        }

        $("#btn_filtrar").attr("disabled", true);
        $("#btn_filtrar").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...'
        );
        $.ajax({
            url: "reportes_ventas_filtro",
            type: "POST",
            data: {
                cliente: cliente,
                estado: estado,
                producto: producto,
                empleado: empleado,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
            },
            success: function (response) {
                if (response.info = 1) {
                    let data = response.data;
                    clearAll();
                    printData(data)
                    $("#modalSelectFilter").modal("hide");
                } else {
                    toasr.error("Error al filtrar los datos");
                }
                $("#btn_filtrar").attr("disabled", false);
                $("#btn_filtrar").html("Filtrar");
            },
            error: function (response) {
                toasr.error("Error al filtrar los datos");
                $("#btn_filtrar").attr("disabled", false);
                $("#btn_filtrar").html("Filtrar");
            },
        });
    });

    function clearAll() {
        $("#count_facturas").html('');
        $("#cargos_facturas").html('');
        $("#retenciones_facturas").html('');
        $("#totales_facturas").html('');

        $("#div_clientes_factura").html('');
        $("#div_empleados_factura").html('');
        $("#tbl_impuesto_cargo").html('');
        $("#tbl_impuesto_retencion").html('');

        if ($.fn.DataTable.isDataTable("#tbl_data_facturas")) {
            $("#tbl_data_facturas").DataTable().destroy();
        }

        $("#tbl_data_facturas tbody").empty();
    }

    function printData(data) {
        let opciones_date = { day: '2-digit', month: '2-digit', year: 'numeric' };
        let facturas = data;

        let impuestos_1 = [];
        let cargos = 0;

        let impuestos_2 = [];
        let retenciones = 0;

        let clientes = [];

        let empleados = [];

        let totales = 0;
        let count = 1;

        facturas.forEach(factura => {
            let total = factura.valor_total;
            let subtotal = factura.subtotal;
            let impuesto_1 = JSON.parse(factura.impuestos_1);
            let impuesto_2 = {
                retefuente: 0,
                reteica: 0,
                reteiva: 0
            };
            let iva = 0;

            let estado = '';

            if (impuesto_1) {
                impuestos_1.push(impuesto_1[0]);
            }

            total = total.split(',');
            total = total[0];

            total = parseInt(total.replaceAll('.', ''));

            subtotal = subtotal.split(',');
            subtotal = subtotal[0];

            subtotal = parseInt(subtotal.replaceAll('.', ''));

            if(factura.status > 0) {
                totales += subtotal;
            }

            if (factura.valor_retefuente) {
                let retencion = factura.valor_retefuente * subtotal / 100;
                impuesto_2.retefuente += retencion;
            }

            if (factura.valor_reteica) {
                let retencion = factura.valor_reteica * subtotal / 1000;
                impuesto_2.reteica += retencion;
            }

            for (let i = 0; i < impuesto_1.length; i++) {
                iva += impuesto_1[i][1];
            }

            if (factura.valor_reteiva) {
                let retencion = factura.valor_reteiva * iva / 100;
                impuesto_2.reteiva += retencion;
            }

            impuestos_2.push(impuesto_2);

            clientes.push(factura.razon_social + ' (' + factura.nit + '-' + factura
                .codigo_verificacion + ')');
            empleados.push(factura.empleado);

            if (factura.status == 0) {
                estado = '<span class="badge bg-warning-gradient">Reversado</span>';
            } else if (factura.status == 2) {
                estado = '<span class="badge bg-success-gradient">Con Pago</span>';
            } else {
                estado = '<span class="badge bg-danger-gradient">Sin Pago</span>';
            }

            let fecha_elaboracion = new Date(factura.fecha_elaboracion);
            fecha_elaboracion = fecha_elaboracion.toLocaleDateString("es-ES", opciones_date);

            $("#tbl_data_facturas tbody").append(
                '<tr>' +
                '<td>' + count + '</td>' +
                '<td><div class="project-contain">' +
                '<h6 class="mb-1 tx-13">' +
                '<a target="_blank" href="' + url_general + 'pdf_factura_venta?token=' + factura.id + '">FE-' + factura.numero + '</a>' +
                '</h6>' +
                '</div>' +
                '</td>' +
                '<td>' + factura.razon_social + ' (' + factura.nit + '-' + factura
                    .codigo_verificacion + ')' + '</td>' +
                '<td>' + fecha_elaboracion + '</td>' +
                '<td>' + factura.valor_total + '</td>' +
                '<td>' + estado + '</td>' +
                '</tr>'
            );

            count++;
        });

        $("#tbl_data_facturas").DataTable({
            responsive: true,
            language: language,
            order: [],
        });

        const dataArr = new Set(clientes);
        const dataArr2 = new Set(empleados);

        clientes = [...dataArr];
        empleados = [...dataArr2];

        //Ordenar clientes (mayor a menor según el total)
        clientes.sort((a, b) => {
            // Calcular el total de cada cliente 'a' y 'b'
            let totalA = calcularTotalCliente(a);
            let totalB = calcularTotalCliente(b);

            // Comparar los totales y devolver el resultado de la comparación
            if (totalA > totalB) {
                return -1; // 'a' debe colocarse antes que 'b'
            } else if (totalA < totalB) {
                return 1; // 'b' debe colocarse antes que 'a'
            } else {
                return 0; // No hay diferencia en los totales, el orden no importa
            }
        });

        // Función auxiliar para calcular el total de un cliente
        function calcularTotalCliente(cliente) {
            let total = 0;

            facturas.forEach(factura => {
                if (factura.razon_social + ' (' + factura.nit + '-' + factura.codigo_verificacion +
                    ')' == cliente) {
                    let total_factura = factura.valor_total;

                    total_factura = total_factura.split(',');
                    total_factura = total_factura[0];

                    total_factura = parseInt(total_factura.replaceAll('.', ''));
                    total += total_factura;
                }
            });

            return total;
        }

        // Imprimir clientes ordenados
        clientes.forEach(element => {
            let total = calcularTotalCliente(element);

            $("#div_clientes_factura").append(
                '<div class="d-flex align-items-center item  border-bottom">' +
                '<div class="d-flex">' +
                '<img src="' + url_general + 'images/empleados/noavatar.png' + '" alt="img"' +
                'class="ht-30 wd-30 me-2">' +
                '<div class="" style="margin-top: 8px">' +
                '<h6 style="cursor: pointer;" class="txt_search_table">' + element + '</h6>' +
                '</div>' +
                '</div>' +
                '<div class="ms-auto my-auto">' +
                '<div class="d-flex">' +
                '<span class="me-4 my-auto">' + total.toLocaleString('es-ES', {
                    minimumFractionDigits: 2
                }) + '</span>' +
                '</div>' +
                '</div>' +
                '</div>');
        });

        //Ordenar empleados (mayor a menor según el total)
        empleados.sort((a, b) => {
            // Calcular el total de cada empleado 'a' y 'b'
            let totalA = calcularTotalEmpleado(a);
            let totalB = calcularTotalEmpleado(b);

            // Comparar los totales y devolver el resultado de la comparación
            if (totalA > totalB) {
                return -1; // 'a' debe colocarse antes que 'b'
            } else if (totalA < totalB) {
                return 1; // 'b' debe colocarse antes que 'a'
            } else {
                return 0; // No hay diferencia en los totales, el orden no importa
            }
        });

        // Función auxiliar para calcular el total de un empleado
        function calcularTotalEmpleado(empleado) {
            let total = 0;

            facturas.forEach(factura => {
                if (factura.empleado == empleado) {
                    let total_factura = factura.valor_total;

                    total_factura = total_factura.split(',');
                    total_factura = total_factura[0];

                    total_factura = parseInt(total_factura.replaceAll('.', ''));
                    total += total_factura;
                }
            });

            return total;
        }

        // Imprimir empleados ordenados
        empleados.forEach(element => {
            let total = calcularTotalEmpleado(element);

            $("#div_empleados_factura").append(
                '<div class="d-flex align-items-center item  border-bottom">' +
                '<div class="d-flex">' +
                '<img src="' + url_general + 'images/empleados/noavatar.png' + '" alt="img"' +
                'class="ht-30 wd-30 me-2">' +
                '<div class="" style="margin-top: 8px">' +
                '<h6 class="">' + element + '</h6>' +
                '</div>' +
                '</div>' +
                '<div class="ms-auto my-auto">' +
                '<div class="d-flex">' +
                '<span class="me-4 my-auto">' + total.toLocaleString('es-ES', {
                    minimumFractionDigits: 2
                }) + '</span>' +
                '</div>' +
                '</div>' +
                '</div>');
        });

        const cargos_array = {};

        impuestos_1.forEach(impuesto => {
            if (impuesto == null) return;
            let valor_1 = parseInt(impuesto[1]);
            cargos += valor_1;

            let nombre = impuesto[0];
            let valor = parseInt(impuesto[1]);
            if (cargos_array[nombre]) {
                cargos_array[nombre] += valor;
            } else {
                cargos_array[nombre] = valor;
            }
        });

        for (const [key, value] of Object.entries(cargos_array)) {
            $("#tbl_impuesto_cargo").append(
                '<tr>' +
                '<td>' + key + '</td>' +
                '<td>' + value.toLocaleString('es-ES', {
                    minimumFractionDigits: 2
                }) + '</td>' +
                '</tr>'
            );
        }

        // Retenciones
        let totalImpuestos = {
            retefuente: 0,
            reteica: 0,
            reteiva: 0
        };

        impuestos_2.forEach(impuesto => {
            totalImpuestos.retefuente += parseInt(impuesto.retefuente);
            totalImpuestos.reteica += parseInt(impuesto.reteica);
            totalImpuestos.reteiva += parseInt(impuesto.reteiva);
        });

        $("#tbl_impuesto_retencion").append(
            '<tr>' +
            '<td>Retefuente</td>' +
            '<td>' + totalImpuestos.retefuente.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }) + '</td>' +
            '</tr>'
        );

        $("#tbl_impuesto_retencion").append(
            '<tr>' +
            '<td>Rete Ica</td>' +
            '<td>' + totalImpuestos.reteica.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }) + '</td>' +
            '</tr>'
        );

        $("#tbl_impuesto_retencion").append(
            '<tr>' +
            '<td>Rete Iva</td>' +
            '<td>' + totalImpuestos.reteiva.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }) + '</td>' +
            '</tr>'
        );

        retenciones = totalImpuestos.retefuente + totalImpuestos.reteica + totalImpuestos.reteiva;

        $('#count_facturas').html(facturas.length);

        $('#totales_facturas').html(totales.toLocaleString('es-ES', {
            minimumFractionDigits: 2
        }));

        $('#cargos_facturas').html(cargos.toLocaleString('es-ES', {
            minimumFractionDigits: 2
        }));

        $('#retenciones_facturas').html(retenciones.toLocaleString('es-ES', {
            minimumFractionDigits: 2
        }));
    }

    $(document).on('click', '.txt_search_table', function () {
        let val = $(this).html();

        $('input[aria-controls]').val(val).trigger('keyup');
    });
});