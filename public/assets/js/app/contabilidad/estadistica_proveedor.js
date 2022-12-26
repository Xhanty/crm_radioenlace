$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    let datefilter = [];

    let language = {
        format: "DD/MM/YYYY",
        separator: " - ",
        applyLabel: "Aceptar",
        cancelLabel: "Cancelar",
        fromLabel: "Desde",
        toLabel: "Hasta",
        customRangeLabel: "Personalizar",
        daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        firstDay: 1,
    };

    $("#rangofilter").daterangepicker(
        {
            locale: language,
            autoUpdateInput: false,
        },
        function (start, end, label) {
            datefilter[0] = start.format("YYYY-MM-DD");
            datefilter[1] = end.format("YYYY-MM-DD");
            //traerData2(datefilter);
            $("#rangofilter").val(datefilter[0] + " - " + datefilter[1]);
        }
    );
});
