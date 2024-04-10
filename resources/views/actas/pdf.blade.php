<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acta de reunión</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&display=swap');


    body {
        font-family: 'Poppins', sans-serif;
        background-image: url("https://crm.radioenlacesas.com/logo-re.png");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center center;
        background-size: 60%;
        opacity: 0.08;
    }

    th {
        border: 1px solid #969696;
    }

    h3 {
        padding: 0px;
        margin: 0px;
    }

    p {
        padding: 0px;
        margin: 0px;
    }
</style>

<body>

    <body>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 27%; border-right: 0;">
                        <img src="https://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
                            alt="Logo" width="100" height="100" style="margin: 11px">
                    </th>
                    <th>
                        <h3 style="margin-left: 100px; margin-right: 100px">ACTA DE<br>REUNIONES</h3>
                    </th>
                    <th style="width: 33%; border-left: 0;">
                        <div>
                            <p>CÓDIGO: SST-AC-01</p>
                            <p>VERSION: 00</p>
                            <p>FECHA: 02/01/2021</p>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="margin-top: 33px; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 30%; text-align: left; background: #e6e6e6; font-size: 17px">
                        <p>&nbsp;Propósito de la reunión: </p>
                    </th>
                    <th style="text-align: left; border-left: 0">
                        <p style="font-weight: 400">&nbsp; {{ $acta->asunto }}</p>
                    </th>
                </tr>

                <tr>
                    <th style="text-align: left; background: #e6e6e6; font-size: 17px">
                        <p>&nbsp;Fecha: </p>
                    </th>
                    <th style="text-align: left; border-left: 0">
                        <p style="font-weight: 400">&nbsp; {{ date('d/m/Y', strtotime($acta->fecha_elaboracion)) }}</p>
                    </th>
                </tr>

                <tr>
                    <th style="text-align: left; background: #e6e6e6; font-size: 17px">
                        <p>&nbsp;Hora: </p>
                    </th>
                    <th style="text-align: left; border-left: 0">
                        <p style="font-weight: 400">&nbsp; {{ $acta->hora_inicio }} - {{ $acta->hora_fin }}</p>
                    </th>
                </tr>

                <tr>
                    <th style="text-align: left; background: #e6e6e6; font-size: 17px">
                        <p>&nbsp;Área: </p>
                    </th>
                    <th style="text-align: left; border-left: 0">
                        <p style="font-weight: 400">
                            @if ($acta->area == 1)
                                &nbsp; Administración
                            @elseif ($acta->area == 2)
                                &nbsp; Comercial
                            @elseif ($acta->area == 3)
                                &nbsp; Contabilidad
                            @elseif ($acta->area == 4)
                                &nbsp; Gerencia
                            @elseif ($acta->area == 5)
                                &nbsp; Operaciones
                            @elseif ($acta->area == 6)
                                &nbsp; Tecnología
                            @endif
                        </p>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="margin-top: 33px; width: 100%;">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: center;">
                        <h3>Observaciones y/o Detalles</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center; border-top: 0; padding: 10px">
                        <p style="font-weight: 400; text-align: justify">{!! nl2br($acta->observaciones) !!}</p>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="margin-top: 33px; width: 100%;">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: center;">
                        <h3>Compromisos</h3>
                    </th>
                </tr>
                @foreach ($detalle as $key => $item)
                    <tr>
                        <th style="width: 50%; border-top: 0; padding: 10px;">
                            <p style="font-weight: 400; text-align: justify">{!! nl2br($item->compromiso) !!}</p>
                        </th>
                        <th style="width: 50%; border-top: 0; padding: 10px;">
                            <div style="display: flex; justify-content: flex-end;">
                                <strong>{{ $item->nombre_empleado }}</strong>
                                <br>
                                <strong>{{ date('d/m/Y', strtotime($item->fecha)) }}</strong>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </thead>
        </table>

        <table style="margin-top: 33px; width: 100%;">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: center;">
                        <h3>Asistentes</h3>
                    </th>
                </tr>
                @foreach ($asistentes as $key => $item)
                    <tr>
                        <th style="width: 50%; border-top: 0; padding: 10px;">
                            <p style="font-weight: 400">{{ $item->nombre }}</p>
                        </th>
                        <th style="width: 50%; border-top: 0; padding: 10px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Miguel_D%C3%ADaz-Canel_firma.png"
                                width="40px" alt="">
                        </th>
                    </tr>
                @endforeach
            </thead>
        </table>
    </body>
</body>

</html>
