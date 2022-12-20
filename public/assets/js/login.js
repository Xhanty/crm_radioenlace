$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btn_login").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "login",
            data: { email: email, password: password },
            success: function (data) {
                if (data.data == "success") {
                    localStorage.setItem("user", JSON.stringify(data.user));
                    window.location.href = "/home";
                } else {
                    toastr.error("Email o contraseña incorrectos");
                }
            },
            error: function (data) {
                toastr.error("Error al iniciar sesión");
            },
        });

    });
});
