$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url_general = protocol + "//" + host + "/";
    let time = 60000;

    obtenerDatos();

    function obtenerDatos() {
        $.ajax({
            url: "notificaciones_eventos",
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.info == 1) {
                    let data = response.data;
                    //console.log(data);
                    if (data.length > 0) {
                        var event = data[0];
                        Push.create("CRM Calendario", {
                            body: event.start + " - " + event.end,
                            icon: "https://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png",
                            timeout: time,
                            vibrate: [100, 100, 100],
                            onClick: function () {
                                window.open(url_general + 'calendario', "_blank");
                                this.close();
                            },
                        });
                    }
                    setTimeout(obtenerDatos, time);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});
