<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Remisión No {{ $remision->code }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            height: 969px;
            margin: auto;
            padding: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            background-image: url("https://crm.radioenlacesas.com/logo-re.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            background-size: 60%;
            opacity: 0.07;
        }

        .invoice-box table {
            width: 100%;
            text-align: left;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 5px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            /*font-weight: bold;*/
        }

        .text-align-right {
            text-align: right;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://crm.radioenlacesas.com/logo-re.png"
                                    style="width:100%; max-width:80px;">
                            </td>

                            <td>
                                <!--<img src="https://crm.radioenlacesas.com/icontec.png"
                                    style="width:100%; max-width:136px; float:right;">-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                @if ($remision->id == 128)
                                <b>Sociedad de Seguridad Electrónica y Telecomunicaciones S.A.S<br>
                                    900265297-2<br>
                                    Bogotá, Colombia</b>
                                @elseif($remision->id == 127)
                                <b>Sistemas Electrónicos y Telecomunicaciones S.A.S<br>
                                    800162165-3<br>
                                    , Colombia</b>
                                @elseif($remision->id == 144)
                                <b>Meltec Comunicaciones S.A<br>
                                    830079015-1<br>
                                    , Colombia</b>
                                @elseif($remision->id == 238)
                                <b>Syscom Colombia S.A.S<br>
                                    901192317<br>
                                    , Colombia</b>
                                @else
                                <b>{{ $remision->razon_social }}<br>
                                    {{ $remision->nit }}-{{ $remision->codigo_verificacion }}<br>
                                    {{ $remision->ciudad }}, Colombia</b>
                                @endif
                            </td>
                            <td>
                                <b>Radio Enlace S.A.S<br>
                                    830504313-5<br>
                                    Medellín, Colombia</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2" style="text-align: left">
                    Remisión
                </td>

                <td colspan="1" style="text-align: right">
                    Fecha
                </td>
            </tr>

            <tr class="details">
                <td colspan="2" style="font-size: 15px; text-align: left">
                    {{ $remision->code }}
                </td>

                <td colspan="1" style="font-size: 15px; text-align: right">
                    {{ date('d-m-Y', strtotime($remision->created_at)) }}
                </td>
            </tr>

            @if ($remision->asunto)
            <tr class="heading">
                <td colspan="3">
                    Asunto
                </td>
            </tr>


            <tr class="details">
                <td colspan="3" style="font-size: 15px; text-align: justify;">
                    @php
                    $texto = $remision->asunto;
                    $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                    $texto_nuevo = preg_replace('/(-)(.*?)(-)/', "<span style='margin-left: 10px'>$2</span>", $texto_nuevo);
                    echo nl2br($texto_nuevo);
                    @endphp
                </td>
            </tr>
            @endif

            @if ($remision->observacion)
            <tr class="heading">
                <td colspan="3">
                    Notas Importantes
                </td>
            </tr>


            <tr class="details">
                <td colspan="3" style="font-size: 15px; text-align: justify;">
                    @php
                    $texto = $remision->observacion;
                    $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                    $texto_nuevo = preg_replace('/(-)(.*?)(-)/', "<span style='margin-left: 10px'>$2</span>", $texto_nuevo);
                    echo nl2br($texto_nuevo);
                    @endphp
                </td>
            </tr>
            @endif

            <tr class="heading">
                <td style="width: 100px; text-align: center;"></td>
                <td style="width: 222px; text-align: center;">Producto</td>
                <td style="text-align: center;">Cantidad</td>
            </tr>

            @for ($i = 0; $i < count($productos); $i++) @if ($i==count($productos) - 1) <tr>
                <td style="text-align: center; padding-top: 2%;">
                    <img src="https://crm.radioenlacesas.com/images/productos/{{ $productos[$i]->imagen }}" style="width:70%; max-width:90px; max-height: 110px">
                </td>
                <td style="text-align: center; padding-top: 3%;">
                    <b>{{ $productos[$i]->producto }}</b><br>
                    <b>{{ $productos[$i]->modelo }}</b>
                </td>
                <td style="text-align: center; padding-top: 3%">{{ $productos[$i]->cantidad }}</td>
                </tr>
                <tr class="item">
                    <td colspan="3">
                        <p style="font-size: 14px; margin-top: 0px; text-align: justify">
                            @php
                            $texto = $productos[$i]->descripcion;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            $texto_nuevo = preg_replace('/(-)(.*?)(-)/', "<span style='margin-left: 10px'>$2</span>", $texto_nuevo);
                            echo nl2br($texto_nuevo);
                            @endphp
                        </p>
                    </td>
                </tr>
                @else
                <tr>
                    <td style="text-align: center; padding-top: 2%;">
                        <img src="https://crm.radioenlacesas.com/images/productos/{{ $productos[$i]->imagen }}" style="width:70%; max-width:90px; max-height: 110px">
                    </td>
                    <td style="text-align: center; padding-top: 3%;">
                        <b>{{ $productos[$i]->producto }}</b> <br>
                        <b>{{ $productos[$i]->modelo }}</b>
                    </td>
                    <td style="text-align: center; padding-top: 3%;">{{ $productos[$i]->cantidad }}</td>
                </tr>
                <tr class="item">
                    <td colspan="3">
                        <p style="font-size: 14px; margin-top: 0px; text-align: justify">
                            @php
                            $texto = $productos[$i]->descripcion;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            $texto_nuevo = preg_replace('/(-)(.*?)(-)/', "<span style='margin-left: 10px'>$2</span>", $texto_nuevo);
                            echo nl2br($texto_nuevo);
                            @endphp
                        </p>
                    </td>
                </tr>
                @endif
                @endfor

                <br>

                <div style="width: 100%; position: absolute; margin-top: 55px;">
                    <div style="width: 300px">
                        <hr>
                        <p style="font-size: 16px; margin-top: 0px;">
                            <b>Teléfono: </b><br>
                            <b>Nombre: </b><br>
                            <b>C.C: <br></b>
                        </p>
                    </div>
                </div>
                <table cellpadding="0" width="500px" style="border-collapse: collapse; font-size: 14.4px; bottom: 77; position: fixed;">
                    <tr>
                        <td style="margin: 0.1px; padding: 0px;">
                            <table cellpadding="0" style="border-collapse: collapse; font-size: 17px;">
                                <tr>
                                    <td valign="top">
                                        <img src="https://crm.radioenlacesas.com/logo-re.png" width="120" style="display: block;">
                                    </td>
                                    <td valign="top" style="border-left: 1px solid rgb(176, 70, 70); margin: 0.1px; padding: 0px 0px 0px 12px; color: rgb(124, 124, 124);">
                                        <table cellpadding="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin: 0.1px; padding: 0px 0px 8px; color: #DD3932; font-size: 18px; margin-top: 5px">
                                                    {{ $creador->nombre }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin: 0.9px; padding: 0px;">
                                                    <table cellpadding="0" style="border-collapse: collapse;">
                                                        <tr style="cursor: pointer;">
                                                            <td style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                                {{ $creador->cargo }} <br>
                                                                Email: {{ $creador->email }}
                                                            </td>
                                                            <td style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);">
                                                            </td>
                                                        </tr>
                                                        <tr style="cursor: pointer;">
                                                            <td style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                                Dirección: Medellín, Colombia
                                                            </td>
                                                            <td style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);">
                                                            </td>
                                                        </tr>
                                                        <tr style="cursor: pointer; text-align: left;">
                                                            <td style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                                Celular: {{ $creador->telefono_celular }}
                                                            </td>
                                                            <td style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);; text-align: left;">

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
        </table>
    </div>
</body>

</html>