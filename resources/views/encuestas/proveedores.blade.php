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
                <p class="text-center">Estimado Cliente, esta encuesta se realizara para conocer su grado de
                    satisfacción en la utilización de nuestros servicios. Su opinión es muy importante para RADIO ENLACE
                    S.A.S. Agradecemos de antemano su atención, tiempo y colaboración. A continuación se indica como se
                    debe diligenciar: Marque uno de los cuatro (4) círculos que aparecen con la letra 4: Excelente, 3:
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
                <div class="col-md-12">
                    <h3>Calidad del servicio.</h3>
                    <p></p>
                </div>
            </section>
            <!--  PREGUNTA 1  -->
            <section class="row">
                <div class="col-md-8">
                    <p>1- Como califica el servicio que RADIO ENLACE le ha ofrecido</p>
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
                    <p>2- Como califica el proceso de analisis de la solicitud del servicio y demas documentos para la
                        cotizacion realizado por RADIO ENLACE</p>
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
                    <p>3- Como califica el seguimiento de la prestacion del servicio que RADIO ENLACE le presta </p>
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
            <!--  PREGUNTA 4  -->
            <section class="row">
                <div class="col-md-8">
                    <p>4- Como califica el seguimiento de Logistica durante la prestacion del servicio: es clara, veraz
                        y
                        oportuna</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta4" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta4" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta4" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta4" value="1" required> 1
                    </label>
                </div>
            </section>
            <!-- PREGUNTA 5  -->
            <section class="row">
                <div class="col-md-8">
                    <p>5- Como califica la competencia del personal operativo y administrativo de RADIO ENLACE</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta5" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta5" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta5" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta5" value="1" required> 1
                    </label>
                </div>
            </section>
            <!-- PREGUNTA 6  -->
            <section class="row">
                <div class="col-md-8">
                    <p>6- Como califica el tiempo en la ejecucuion del servico prestado que realiza RADIO ENLACE</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta6" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta6" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta6" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta6" value="1" required> 1
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
                    <p>7- Como percibe las medidas de seguridad que RADIO ENLACE toma para proteger su mercancía</p>
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
                    <p>8- Como califica la atención de RADIO ENLACE a sus sugerencias u observaciones acerca del
                        servicio
                        que se le ha prestado
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
                    <p>9- La solución que RADIO ENLACE da a los inconvenientes, dificultades, quejas y reclamos
                        presentados
                        durante la prestación del servicio es</p>
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
            <!--  PREGUNTA 10  -->
            <section class="row">
                <div class="col-md-8">
                    <p>10- La posición de liderazgo de RADIO ENLACE frente a sus competidores es</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta10" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta10" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta10" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta10" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 11  -->
            <section class="row">
                <div class="col-md-8">
                    <p>11- Los medios de comunicación utilizados por RADIO ENLACE para la prestación de los servicios
                        son
                    </p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta11" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta11" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta11" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta11" value="1" required> 1
                    </label>
                </div>
            </section><br />
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
                    <p>12- Las tarifas de RADIO ENLACE para la prestación de los servicios son </p>
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
                    <p>13- Como califica el cumplimiento de las condiciones pactadas con RADIO ENLACE para la prestación
                        del
                        servicio </p>
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
                    <p>14- Como califica el cumplimiento de las condiciones de facturación pactadas con RADIO ENLACE</p>
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
            <!--  PREGUNTA 15  -->
            <section class="row">
                <div class="col-md-8">
                    <p>15- Como califica La atención en la Oficina Principal</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta15" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta15" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta15" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta15" value="1" required> 1
                    </label>
                </div>
            </section>
            <!--  PREGUNTA 16  -->
            <section class="row">
                <div class="col-md-8">
                    <p>16- Comparando los productos y servicios con otras compañias como consideras nuetro servicio</p>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta16" value="4" required> 4
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta16" value="3" required> 3
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta16" value="2" required> 2
                    </label>
                </div>
                <div class="col-md-1">
                    <label class="radio">
                        <input type="radio" name="pregunta16" value="1" required> 1
                    </label>
                </div>
            </section>

            <br />

            <!--  Preguntas  -->
            <section class="row">
                <div class="col-md-12">
                    <h3>Preguntas</h3>
                    <p></p>
                </div>
            </section>
            <section class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Que es lo que te gusta de nuetros productos y servicios?</label>
                        <textarea class="form-control" rows="2" name="pregunta_1" id="pregunta_1" style="resize: none"></textarea>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Que es lo que no te gusta de nuestros productos y servicios y que crees
                            que debemos cambiar?</label>
                        <textarea class="form-control" rows="2" name="pregunta_2" id="pregunta_2" style="resize: none"></textarea>
                    </div>
                </div>
            </section>
            <section class="row">
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
                    $('input[name="pregunta' + i + '"][value="' + respuestas['pregunta' + i] + '"]').parent().css('color', 'rgb(218, 37, 29)');
                    $('input[name="pregunta' + i + '"][value="' + respuestas['pregunta' + i] + '"]').parent().css('font-weight', 'bold');
                }

                $('#pregunta_1').val(respuestas.pregunta_1);
                $('#pregunta_2').val(respuestas.pregunta_2);
                $('#observaciones').val(respuestas.observaciones);
            }
        });
    </script>
</body>

</html>