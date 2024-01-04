<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Encuesta de Satisfacción</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
</head>

<body>
    @php
        $view_data = false;

        if ($send == 0) {
            $view_data = true;
        } else {
            $view_data = false;
        }
    @endphp
    <!-- partial:index.partial.html -->
    <br />
    <div class="container">
        <section class="row">
            <div class="col-md-12">
                <h1 class="text-center">Encuesta de Satisfacción</h1>
                <br>
                <p class="text-center">Estimado Proveedor, esta encuesta se realizará para conocer el grado de
                    satisfacción de RADIO ENLACE S.A.S. hacía usted por los servicios prestados. <br>4: Excelente, 3:
                    Bueno, 2: Regular, 1: Malo, según sea el caso.</p>
            </div>
        </section>
        <hr><br />
        <section class="row">
            <section class="col-md-12">
                <h3>Datos básicos</h3>
                <p></p>
            </section>
        </section>

        <form method="POST" action="{{ route('encuesta_proveedores_save') }}">
            @csrf
            <input type="hidden" name="encuesta_send" id="encuesta_send" value="{{ $encuesta->id }}">
            <section class="row">
                <section class="col-md-12">
                    <section class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nombreCompleto">Encargado: *</label>
                                <input type="text" class="form-control" name="encargado_add" id="encargado_add"
                                    maxlength="128" placeholder="Encargado" required value="{{ $encuesta->encargado }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form_group">
                                <label for="edadEncuestado">Cargo: *</label>
                                <input type="text" class="form-control" name="cargo_add" id="cargo_add"
                                    placeholder="Cargo" required value="{{ $encuesta->cargo }}" />
                            </div>
                        </div>
                    </section>
                </section>
            </section>
            <hr />

            <!--  Calidad del servicio  -->
            <section class="row">
                <div class="col-md-8">
                    <h3>Calidad del servicio.</h3>
                    <p></p>
                </div>
                <div class="col-md-4">
                    <!-- Titulos -->
                    <div class="row">
                        <div class="col-md-3">
                            <b>
                                <p>Excelente</p>
                            </b>
                        </div>
                        <div class="col-md-3">
                            <b>
                                <p>Bueno</p>
                            </b>
                        </div>
                        <div class="col-md-3">
                            <b>
                                <p>Regular</p>
                            </b>
                        </div>
                        <div class="col-md-3">
                            <b>
                                <p>Malo</p>
                            </b>
                        </div>
                    </div>
                </div>
            </section>
            <!--  PREGUNTA 1  -->
            <section class="row">
                <div class="col-md-8">
                    <p>1- ¿Cómo calificarías la percepción general de la calidad del servicio?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta1" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta1" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta1" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta1" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 2  -->
            <section class="row">
                <div class="col-md-8">
                    <p>2- ¿Cómo valorarías la capacidad del proveedor para cumplir con las expectativas en términos de calidad del servicio?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta2" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta2" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta2" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta2" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 3  -->
            <section class="row">
                <div class="col-md-8">
                    <p>3- ¿Qué puntuación asignarías a la respuesta y resolución de problemas?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta3" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta3" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta3" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta3" value="1" required> 1
                    </label>
                </div>
            </section>
            <br>
            <hr>
            <!--  Control y seguridad  -->
            <section class="row">
                <div class="col-md-12">
                    <h3>Control y seguridad.</h3>
                    <p></p>
                </div>
            </section>
            <!--  PREGUNTA 7  -->
            <section class="row">
                <div class="col-md-8">
                    <p>7- ¿Cómo calificarías la efectividad de los protocolos de seguridad implementados?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta7" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta7" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta7" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta7" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 8  -->
            <section class="row">
                <div class="col-md-8">
                    <p>8- ¿Cómo evaluarías la gestión y control de acceso a datos confidenciales durante el servicio prestado?
                    </p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta8" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta8" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta8" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta8" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 9  -->
            <section class="row">
                <div class="col-md-8">
                    <p>9- ¿Qué calificación asignarías a la capacidad del proveedor para manejar y mitigar riesgos de seguridad de manera efectiva?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta9" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta9" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta9" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta9" value="1" required> 1
                    </label>
                </div>
            </section>
            <br />
            <hr />
            <!-- Cumplimiento de la organización -->
            <section class="row">
                <div class="col-md-12">
                    <h3>Cumplimiento de la organización.</h3>
                    <p></p>
                </div>
            </section>
            <!--  PREGUNTA 12  -->
            <section class="row">
                <div class="col-md-8">
                    <p>12- ¿En tu experiencia, cumple con todas las regulaciones y normativas pertinentes?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 13  -->
            <section class="row">
                <div class="col-md-8">
                    <p>13- ¿Qué puntuación darías al sistema de gestión de la calidad implementado?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 14  -->
            <section class="row">
                <div class="col-md-8">
                    <p>14- ¿Cómo calificarías la capacidad del proveedor para implementar mejoras?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="1" required> 1
                    </label>
                </div>
            </section>
            <br />
            <hr>
            <section class="row">
                <div class="col-md-12">
                    <h3>Aspectos económicos.</h3>
                    <p></p>
                </div>
            </section>
            <!--  PREGUNTA 12  -->
            <section class="row">
                <div class="col-md-8">
                    <p>12- ¿Cómo evaluarías la transparencia y claridad en la estructuración de los costos asociados con los servicios recibidos?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 13  -->
            <section class="row">
                <div class="col-md-8">
                    <p>13- ¿Qué calificación merece la flexibilidad en opciones de pago y descuentos proporcionada por el proveedor?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 14  -->
            <section class="row">
                <div class="col-md-8">
                    <p>14- ¿Qué puntuación asignarías a la capacidad del proveedor para gestionar aumentos de costos o cambios en la estructura de precios?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="1" required> 1
                    </label>
                </div>
            </section>
            <br>
            <hr>
            <section class="row">
                <div class="col-md-12">
                    <h3>Aspectos estratégicos.</h3>
                    <p></p>
                </div>
            </section>
            <!--  PREGUNTA 12  -->
            <section class="row">
                <div class="col-md-8">
                    <p>12- ¿Cómo calificarías la visión general de la estrategia a largo plazo proporcionada por el proveedor en la prestación de servicios?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta12" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 13  -->
            <section class="row">
                <div class="col-md-8">
                    <p>13- ¿Cómo evaluarías la adaptabilidad de los servicios a las cambiantes necesidades del mercado y las tendencias industriales?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta13" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 14  -->
            <section class="row">
                <div class="col-md-8">
                    <p>14- ¿Qué calificación asignarías a la capacidad del proveedor para innovar y mejorar continuamente la oferta de servicios?</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta14" value="1" required> 1
                    </label>
                </div>
            </section>
            <br>

            <!--  Preguntas  -->
            <section class="row" style="display: none">
                <div class="col-md-12">
                    <h3>Preguntas</h3>
                    <p></p>
                </div>
            </section>
            <section class="row" style="display: none">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Que es lo que te gusta de nuetros productos y servicios?</label>
                        <textarea class="form-control" rows="2" name="pregunta_1" id="pregunta_1" style="resize: none"></textarea>
                    </div>
                </div>
            </section>
            <section class="row" style="display: none">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Que es lo que no te gusta de nuestros productos y servicios y que crees
                            que debemos cambiar?</label>
                        <textarea class="form-control" rows="2" name="pregunta_2" id="pregunta_2" style="resize: none"></textarea>
                    </div>
                </div>
            </section>
            <section class="row" style="display: none">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Observaciones y Recomendaciones:</label>
                        <textarea class="form-control" rows="2" name="observaciones" id="observaciones" style="resize: none"></textarea>
                    </div>
                </div>
            </section>
            <br>
            <section class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-info" id="saveForm"
                        style="background: rgb(218, 37, 29); border:rgb(218, 37, 29); cursor: pointer;">Guardar
                        Encuesta</button>
                </div>
            </section>
        </form>
    </div>

    <br />
    <footer class="container">
        <p>Todos los derechos reservados para Radio Enlace S.A.S.</p>
    </footer>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script>
        // Poner disabled todos los input radio
        $(document).ready(function() {
            // Si view es true, se deshabilitan los input radio
            if ({{ $view_data }}) {
                $('input[type="text"]').attr('disabled', true);
                $('input[type="radio"]').attr('disabled', true);
                $('textarea').attr('disabled', true);
                $('#saveForm').attr('disabled', true);

                let respuestas = JSON.parse('{!! $encuesta->respuestas !!}');

                for (let i = 1; i <= 16; i++) {
                    $('input[name="pregunta' + i + '"][value="' + respuestas['pregunta' + i] + '"]').prop(
                        'checked', true);

                    // accent-color
                    $('input[name="pregunta' + i + '"][value="' + respuestas['pregunta' + i] + '"]').parent().css(
                        'color', 'rgb(218, 37, 29)');
                    $('input[name="pregunta' + i + '"][value="' + respuestas['pregunta' + i] + '"]').parent().css(
                        'font-weight', 'bold');
                }

                $('#pregunta_1').val(respuestas.pregunta_1);
                $('#pregunta_2').val(respuestas.pregunta_2);
                $('#observaciones').val(respuestas.observaciones);
            }
        });
    </script>
</body>

</html>
