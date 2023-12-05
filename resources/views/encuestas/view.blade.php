<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Encuesta de Satisfacción Formulario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>

</head>

<body>
    <!-- partial:index.partial.html -->
    <br />
    <div class="container">
        <section class="row">
            <div class="col-md-12">
                <h1 class="text-center">Formato de Encuesta de Satisfacción.</h1>
                <p class="text-center">ESE Hospital San Rafael de Girardota.</p>
            </div>
        </section>
        <hr><br />
        <section class="row">
            <section class="col-md-12">
                <h3>Datos basicos</h3>
                <p></p>
            </section>
        </section>
        <section class="row">
            <section class="col-md-12">
                <section class="row">
                    <div class="col-md-4">
                        <label for="tipoAtencion">Tipo de Atención: *</label>
                        <select class="form-control" id="tipoAtencion">
                            <option value="ce">Consulta Externa</option>
                            <option value="farm">Farmacia</option>
                            <option value="fisi">Fisioterapia</option>
                            <option value="fo">Fo</option>
                            <option value="hosp">Hospitalizació</option>
                            <option value="odon">Odontologia</option>
                            <option value="pyp">Promoción y Prevención</option>
                            <option value="rx">Rayos X</option>
                            <option value="urge">Urgencias</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Fecha Actual: *</label>
                            <input type="date" class="form-control" id="fechaActual" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActencion">Fecha Atención: *</label>
                            <input type="date" class="form-control" id="fechaAtencion" required>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nombreCompleto">Nombre Compelto: *</label>
                            <input type="text" class="form-control" id="nombreCompleto" maxlength="128"
                                placeholder="Nombre Compelto" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label for="edadEncuestado">Edad: *</label>
                            <input type="number" class="form-control" id="edadEncuestado" placeholder="Edad"
                                maxlength="3" required />
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idIdentificacion">Identificación: *</label>
                            <input type="number" id="idIdentificacion" class="form-control"
                                placeholder="Numero de Identificación" maxlength="15" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono">Telefono: *</label>
                        <input type="text" class="form-control" id="telefono" placeholder="Numero Telefonico"
                            maxlength="12" required />
                    </div>
                    <div class="col-md-4">
                        <label for="epsPaciente">EPS: *</label>
                        <input type="text" class="form-control" id="epsPaciente" placeholder "EPS del Paciente"
                            required />
                    </div>
                </section>
            </section>
        </section>
        <hr />

        <!--  Servicios  -->
        <section class="row">
            <div class="col-md-12">
                <h3>Servicio.</h3>
                <p></p>
            </div>
        </section>
        <!--  PREGUNTA 1  -->
        <section class="row">
            <div class="col-md-6">
                <p>1- ¿"Sabe usted que tiene derechos y deberes en salud?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 2  -->
        <section class="row">
            <div class="col-md-6">
                <p>2- ¿A su llegada al hospital los tramites de ingreso y atención fueron claros? </p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 3  -->
        <section class="row">
            <div class="col-md-6">
                <p>3- ¿Al ingreso al hospital encontró información visible que le indique el sitio donde va a ser
                    atendido? </p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 4  -->
        <section class="row">
            <div class="col-md-6">
                <p>4- ¿Sabe usted en que horario solicitar una cita y cuál es el número telefónico?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section><br>
        <hr>
        <!--  Durante la Atención  -->
        <section class="row">
            <div class="col-md-12">
                <h3>Durante la Atención.</h3>
                <p></p>
            </div>
        </section>
        <!--  PREGUNTA 5  -->
        <section class="row">
            <div class="col-md-6">
                <p>5- ¿Está satisfecho con el tiempo que tuvo que esperar para ser atendido?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 6  -->
        <section class="row">
            <div class="col-md-6">
                <p>6- ¿El profesional le pregunto el motivo de la consulta, sus enfermedades anteriores y familiares?
                </p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 7  -->
        <section class="row">
            <div class="col-md-6">
                <p>7- ¿Considera que lo atendieron en condiciones de privacidad?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 8  -->
        <section class="row">
            <div class="col-md-6">
                <p>8- ¿El profesional que lo atendió se presentó por el nombre? </p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 9  -->
        <section class="row">
            <div class="col-md-6">
                <p>9- ¿Piensa que fue atendido amablemente en este hospital?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section><br />
        <hr />
        <!--  Durante la Atención  -->
        <section class="row">
            <div class="col-md-12">
                <h3>Salida del usuario.</h3>
                <p></p>
            </div>
        </section>
        <!--  PREGUNTA 10  -->
        <section class="row">
            <div class="col-md-6">
                <p>10- ¿A usted y/o a su familia le dieron las recomendaciones sobre cómo cuidar su salud en casa?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 11  -->
        <section class="row">
            <div class="col-md-6">
                <p>11- ¿Las áreas del servicio donde fue atendido, se encontraban limpias, comodas y agradables?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>
        <!--  PREGUNTA 12  -->
        <section class="row">
            <div class="col-md-6">
                <p>12- ¿Si se requiere volveria a utilizar nuestros servicios?</p>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="pregunta1a" value="SI"> Si
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntab" value="NO"> No
                </label>
            </div>
            <div class="col-md-2">
                <label class="radio">
                    <input type="radio" name="pregunta1" id="preguntac" value="NA"> N/A
                </label>
            </div>
        </section>





        <br />
        <hr />
        <!--  Satisfacción General  -->
        <section class="row">
            <div class="col-md-12">
                <h3>Satisfacción General.</h3>
                <p></p>
            </div>
        </section>
        <!--  PREGUNTA 13  -->
        <section class="row">
            <div class="col-md-12">
                <section class="row">
                    <div class="col-md-8">
                        <p>13- ¿Cómo calificaría su experiencia global respecto a los servicios de salud que ha recibido
                            a través del Hospital?</p>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="pregunta13">
                            <option value="5">Muy Buena</option>
                            <option value="4">Buena</option>
                            <option value="3">Regular</option>
                            <option value="2">Mala</option>
                            <option value="1">Muy Mala</option>
                            <option value="0">No Responde</option>
                        </select>
                    </div>
                </section>
            </div>
        </section><br />
        <!--  PREGUNTA 14  -->
        <section class="row">
            <div class="col-md-12">
                <section class="row">
                    <div class="col-md-8">
                        <p>14- ¿Recomendaria a sus familiares y amigos este Hospital?</p>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="pregunta14">
                            <option value="5">Muy Buena</option>
                            <option value="4">Buena</option>
                            <option value="3">Regular</option>
                            <option value="2">Mala</option>
                            <option value="1">Muy Mala</option>
                            <option value="0">No Responde</option>
                        </select>
                    </div>
                </section>
            </div>
        </section><br />
        <hr />

        <!--  Comentarios  -->
        <section class="row">
            <div class="col-md-12">
                <h3>Comentarios.</h3>
                <p></p>
            </div>
        </section>
        <section class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="comment">Comentarios:</label>
                    <textarea class="form-control" rows="6" id="comentarios"></textarea>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-info" id="saveForm" onclick="saveForm">Guardar
                    Encuesta</button>
                <button type="button" class="btn btn-danger" id="clearForm">Limpiar formulario</button>
            </div>
        </section>
    </div>

    <br /><br />
    <footer class="container">
        <p>Todos los derechos reservados para ESE Hospital San Rafael de Girardota.</p>
    </footer>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'></script>
    <!--<script src="./script.js"></script>-->

</body>

</html>
