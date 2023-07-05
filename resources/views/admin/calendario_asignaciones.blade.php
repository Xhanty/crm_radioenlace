<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
</head>

<body>
    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var asignaciones_proyectos = <?php echo json_encode($asignaciones_proyectos); ?>;
            var asignaciones_generales = <?php echo json_encode($asignaciones_generales); ?>;

            var events = [];

            // Agregar los eventos de asignaciones_proyectos al arreglo de eventos
            asignaciones_proyectos.forEach(function(asignacion) {
                events.push({
                    title: asignacion.nombre + ' (' + asignacion.proyecto + ')',
                    start: asignacion.fecha,
                    end: asignacion.fecha_culminacion ?? asignacion.fecha,
                    color: 'green' // Color para asignaciones_proyectos
                });
            });

            // Agregar los eventos de asignaciones_generales al arreglo de eventos
            asignaciones_generales.forEach(function(asignacion) {
                events.push({
                    title: asignacion.nombre + ' (' + asignacion.cliente + ')',
                    start: asignacion.fecha,
                    end: asignacion.fecha_culminacion ?? asignacion.fecha,
                    color: 'blue' // Color para asignaciones_generales
                });
            });

            console.log(events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events
            });

            calendar.render();
        });
    </script>
</body>

</html>
