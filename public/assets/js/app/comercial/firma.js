$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let canvas = document.getElementById('thecanvas');

    function canvas_read_mouse(canvas, e) {
        let canvasRect = canvas.getBoundingClientRect();
        canvas.tc_x1 = canvas.tc_x2;
        canvas.tc_y1 = canvas.tc_y2;
        canvas.tc_x2 = e.clientX - canvasRect.left;
        canvas.tc_y2 = e.clientY - canvasRect.top;
    }

    function on_canvas_mouse_down(e) {
        canvas_read_mouse(canvas, e);
        canvas.tc_md = true;
    }

    function on_canvas_mouse_up(e) {
        canvas.tc_md = false;
    }

    function on_canvas_mouse_move(e) {
        canvas_read_mouse(canvas, e);
        if (canvas.tc_md && (canvas.tc_x1 !== canvas.tc_x2 || canvas.tc_y1 !== canvas.tc_y2)) {
            let ctx = canvas.getContext("2d");
            ctx.beginPath();
            ctx.moveTo(canvas.tc_x1, canvas.tc_y1);
            ctx.lineTo(canvas.tc_x2, canvas.tc_y2);
            ctx.stroke();
        }
    }

    function canvas_read_touch(canvas, e) {
        let canvasRect = canvas.getBoundingClientRect();
        let touch = event.touches[0];
        canvas.tc_x1 = canvas.tc_x2;
        canvas.tc_y1 = canvas.tc_y2;
        canvas.tc_x2 = touch.pageX - document.documentElement.scrollLeft - canvasRect.left;
        canvas.tc_y2 = touch.pageY - document.documentElement.scrollTop - canvasRect.top;
    }

    function on_canvas_touch_start(e) {
        canvas_read_touch(canvas, e);
        canvas.tc_md = true;
    }

    function on_canvas_touch_end(e) {
        canvas.tc_md = false;
    }

    function on_canvas_touch_move(e) {
        canvas_read_touch(canvas, e);
        if (canvas.tc_md && (canvas.tc_x1 !== canvas.tc_x2 || canvas.tc_y1 !== canvas.tc_y2)) {
            //alert(`${canvas.tc_x1} ${canvas.tc_y1} ${canvas.tc_x2} ${canvas.tc_y2}`);
            let ctx = canvas.getContext("2d");
            ctx.beginPath();
            ctx.moveTo(canvas.tc_x1, canvas.tc_y1);
            ctx.lineTo(canvas.tc_x2, canvas.tc_y2);
            ctx.stroke();
        }
    }

    canvas.addEventListener('mousedown', (e) => { on_canvas_mouse_down(e) }, false);
    canvas.addEventListener('mouseup', (e) => { on_canvas_mouse_up(e) }, false);
    canvas.addEventListener('mousemove', (e) => { on_canvas_mouse_move(e) }, false);
    canvas.addEventListener('touchstart', (e) => { on_canvas_touch_start(e) }, false);
    canvas.addEventListener('touchend', (e) => { on_canvas_touch_end(e) }, false);
    canvas.addEventListener('touchmove', (e) => { on_canvas_touch_move(e) }, false);

    $("#btnLimpiar").click(function () {
        let ctx = canvas.getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    $("#btn_save_frima").click(function () {
        let id = $("#id").val();
        let firma = canvas.toDataURL();

        $("#btn_save_frima").attr("disabled", true);
        $("#btn_save_frima").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
        );
        $.ajax({
            url: "firmar_remision",
            type: "POST",
            data: {
                id: id,
                firma: firma,
            },
            success: function (response) {
                if (response.info == 1) {
                    toastr.success("Firma guardada correctamente");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Error al guardar la firma");
                    $("#btn_save_frima").attr("disabled", false);
                    $("#btn_save_frima").html("Firmar Cotización");
                }
            },
            error: function (response) {
                toastr.error("Error al guardar la firma");
                $("#btn_save_frima").attr("disabled", false);
                $("#btn_save_frima").html("Firmar Cotización");
            }
        });
    });
});