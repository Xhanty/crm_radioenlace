$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";

    $("#btn_filtrar").click(function () {
        let factura = $("#factura_select").val();
        let cliente = $("#cliente_select").val();
        let empleado = $("#empleado_select").val();
        let fecha_inicio = $("#inicio_select").val();
        let fecha_fin = $("#fin_select").val();

        $("#btn_filtrar").attr("disabled", true);
        $("#btn_filtrar").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...'
        );
        $.ajax({
            url: "reportes_ventas_filtro",
            type: "POST",
            data: {
                factura: factura,
                cliente: cliente,
                empleado: empleado,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
            },
            success: function (response) {
                if (response.info = 1) {
                    let data = response.data;
                    clearAll();
                    printData(data)
                    $("#modalSelect").modal("hide");
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
        $("#tbl_facturas_all").html('');
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
            let impuesto_1 = JSON.parse(factura.impuestos_1);
            let impuesto_2 = JSON.parse(factura.impuestos_2);
            let estado = '';

            if (impuesto_1) {
                impuestos_1.push(impuesto_1[0]);
            }

            if (impuesto_2) {
                impuestos_2.push(impuesto_2[0]);
            }

            total = total.split(',');
            total = total[0];

            total = parseInt(total.replaceAll('.', ''));
            totales += total;

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

            let fecha_vencimiento = new Date(factura.fecha_vencimiento);
            fecha_vencimiento = fecha_vencimiento.toLocaleDateString("es-ES", opciones_date);

            $("#tbl_facturas_all").append(
                '<tr>' +
                '<td>' + count + '</td>' +
                '<td><div class="project-contain">' +
                '<h6 class="mb-1 tx-13">' +
                '<a target="_blank" href="' + url_general + 'pdf_factura_compra?token=' + factura.id + '">Factura No.' + factura.numero + '</a>' +
                '</h6>' +
                '</div>' +
                '<td>' + factura.razon_social + ' (' + factura.nit + '-' + factura
                    .codigo_verificacion + ')' + '</td>' +
                '<td>' + fecha_elaboracion + '</td>' +
                '<td>' + fecha_vencimiento + '</td>' +
                '<td>' + factura.valor_total + '</td>' +
                '<td>' + estado + '</td>' +
                '</tr>'
            );

            count++;
        });

        const dataArr = new Set(clientes);
        const dataArr2 = new Set(empleados);

        clientes = [...dataArr];
        empleados = [...dataArr2];

        clientes.forEach(element => {
            let total = 0;

            facturas.forEach(factura => {
                if (factura.razon_social + ' (' + factura.nit + '-' + factura
                    .codigo_verificacion +
                    ')' == element) {
                    let total_factura = factura.valor_total;

                    total_factura = total_factura.split(',');
                    total_factura = total_factura[0];

                    total_factura = parseInt(total_factura.replaceAll('.', ''));
                    total += total_factura;
                }
            });

            $("#div_clientes_factura").append(
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

        empleados.forEach(element => {
            let total = 0;

            facturas.forEach(factura => {
                if (factura.empleado == element) {
                    let total_factura = factura.valor_total;

                    total_factura = total_factura.split(',');
                    total_factura = total_factura[0];

                    total_factura = parseInt(total_factura.replaceAll('.', ''));
                    total += total_factura;
                }
            });

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

        const retenciones_array = {};

        impuestos_2.forEach(impuesto => {
            if (impuesto == null) return;
            let valor_1 = parseInt(impuesto[1]);
            retenciones += valor_1;

            let nombre = impuesto[0];
            let valor = parseInt(impuesto[1]);
            if (retenciones_array[nombre]) {
                retenciones_array[nombre] += valor;
            } else {
                retenciones_array[nombre] = valor;
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

        for (const [key, value] of Object.entries(retenciones_array)) {
            $("#tbl_impuesto_retencion").append(
                '<tr>' +
                '<td>' + key + '</td>' +
                '<td>' + value.toLocaleString('es-ES', {
                    minimumFractionDigits: 2
                }) + '</td>' +
                '</tr>'
            );
        }

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
});