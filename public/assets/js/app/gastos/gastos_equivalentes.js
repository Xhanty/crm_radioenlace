$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".open-toggle").trigger("click");

    let datefilter1 = [];
    let datefilter2 = [];

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

    $("#rangofilter1").daterangepicker(
        {
            autoUpdateInput: false,
            locale: language,
        },
        function (start, end, label) {
            datefilter1[0] = start.format("YYYY-MM-DD");
            datefilter1[1] = end.format("YYYY-MM-DD");
            //traerData1(datefilter1, 0);
            $("#rangofilter1").val(datefilter1[0] + " - " + datefilter1[1]);
        }
    );

    $("#rangofilter2").daterangepicker(
        {
            locale: language,
            autoUpdateInput: false,
        },
        function (start, end, label) {
            datefilter2[0] = start.format("YYYY-MM-DD");
            datefilter2[1] = end.format("YYYY-MM-DD");
            //traerData2(datefilter2);
            $("#rangofilter2").val(datefilter2[0] + " - " + datefilter2[1]);
        }
    );
});
