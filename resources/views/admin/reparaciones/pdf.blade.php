<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Reparación ({{ $reparacion->token }})</title>

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
            background-image: url("http://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png");
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
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
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
            <br>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                <b>{{ $reparacion->razon_social }}<br>
                                    {{ $reparacion->nit }}-{{ $reparacion->codigo_verificacion }}<br>
                                    {{ $reparacion->ciudad }}, Colombia</b>
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
                <td colspan="1">
                    Consecutivo
                </td>

                <td colspan="3" style="text-align: left">
                    Reparación
                </td>

                <td colspan="2" style="text-align: right">
                    Fecha
                </td>
            </tr>

            <tr class="details">
                <td colspan="1" style="font-size: 15px">
                    {{ $reparacion->consecutivo }}
                </td>

                <td colspan="3" style="font-size: 15px; text-align: left">
                    {{ $reparacion->token }}
                </td>

                <td colspan="2" style="font-size: 15px; text-align: right">
                    {{ date('d-m-Y', strtotime($reparacion->created_at)) }}
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">
                    Modelo
                </td>

                <td colspan="3">
                    Serie
                </td>
            </tr>

            <tr class="details">
                <td colspan="3" style="font-size: 15px">
                    {{ $reparacion->modelo }}
                </td>

                <td colspan="3" style="font-size: 15px">
                    {{ $reparacion->serie }}
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">
                    Persona que recibe
                </td>

                <td colspan="3">
                    Técnico Asignado
                </td>
            </tr>

            <tr class="details">
                <td colspan="3" style="font-size: 15px">
                    {{ $reparacion->recibe }}
                </td>

                <td colspan="3" style="font-size: 15px">
                    {{ $reparacion->encargado }}
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">
                    Categoría
                </td>

                <td colspan="3">
                    Accesorios
                </td>
            </tr>

            <tr class="details">
                <td colspan="3" style="font-size: 15px">
                    {{ $reparacion->categoria }}
                </td>

                <td colspan="3" style="font-size: 15px">
                    {{ $accesorios_fin }}
                </td>
            </tr>

            @if ($reparacion->observacion)
                <tr class="heading">
                    <td colspan="6">
                        Detalle
                    </td>
                </tr>

                <tr class="details">
                    <td colspan="6" style="font-size: 15px; text-align: justify;">
                        @php
                            $texto = $reparacion->observacion;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            $texto_nuevo = preg_replace('/(-)(.*?)(-)/', "<span style='margin-left: 10px'>$2</span>", $texto_nuevo);
                            echo nl2br($texto_nuevo);
                        @endphp
                    </td>
                </tr>
            @endif

            @if (count($repuestos) > 0)
                <tr class="heading">
                    <td colspan="2" style="text-align: center;"></td>
                    <td colspan="3" style="text-align: center; padding-right: 20px;">Repuesto</td>
                    <td colspan="1" style="text-align: center;">Cantidad</td>
                </tr>
            @endif

            @for ($i = 0; $i < count($repuestos); $i++)
                @if ($i == count($repuestos) - 1)
                    <tr>
                        <td colspan="2" style="text-align: center; padding-top: 2%;">
                            <img src="https://crm.radioenlacesas.com/images/productos/{{ $repuestos[$i]->imagen }}"
                                style="width:100%; max-width:100px; max-height: 120px">
                        </td>
                        <td colspan="3" style="text-align: center; padding-top: 3%;">
                            <b>{{ $repuestos[$i]->producto }}</b><br>
                            <b>{{ $repuestos[$i]->modelo }}</b><br>
                            ({{ $repuestos[$i]->marca }})
                        </td>
                        <td colspan="1" style="text-align: center; padding-top: 3%">{{ $repuestos[$i]->cantidad }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="3" style="text-align: center; padding-top: 2%;">
                            <img src="https://crm.radioenlacesas.com/images/productos/{{ $repuestos[$i]->imagen }}"
                                style="width:100%; max-width:100px; max-height: 120px">
                        </td>
                        <td colspan="2" style="text-align: center; padding-top: 3%;">
                            <b>{{ $repuestos[$i]->producto }}</b><br>
                            <b>{{ $repuestos[$i]->modelo }}</b><br>
                            ({{ $repuestos[$i]->marca }})
                        </td>
                        <td colspan="1" style="text-align: center; padding-top: 3%;">{{ $repuestos[$i]->cantidad }}
                        </td>
                    </tr>
                @endif
            @endfor

            <br>

            @if (count($informes) > 0)
                <tr class="heading">
                    <td colspan="3" style="width: 300px; text-align: center;">Informe</td>
                    <td colspan="2" style="text-align: center; padding-right: 20px;">Técnico</td>
                    <td colspan="1" style="text-align: center;">Anexo</td>
                </tr>
            @endif

            @for ($i = 0; $i < count($informes); $i++)
                @if ($i == count($informes) - 1)
                    <tr style="border-top: 1px solid #ccc;">
                        <td colspan="3" style="text-align: justify; padding-right: 33px">
                            {{ $informes[$i]->observacion }}</td>
                        <td colspan="2" style="text-align: center;">{{ $informes[$i]->tecnico }}</td>
                        <td colspan="1" style="text-align: center;">
                            @if ($informes[$i]->adjunto)
                                <a href="https://crm.radioenlacesas.com/images/adjuntos/{{ $informes[$i]->adjunto }}"
                                    target="_blank">Ver</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="3" style="text-align: justify; padding-right: 33px">
                            {{ $informes[$i]->observacion }}</td>
                        <td colspan="2" style="text-align: center;">{{ $informes[$i]->tecnico }}</td>
                        <td colspan="1" style="text-align: center;">
                            @if ($informes[$i]->adjunto)
                                <a href="https://crm.radioenlacesas.com/images/adjuntos/{{ $informes[$i]->adjunto }}"
                                    target="_blank">Ver</a>
                            @else
                                -
                            @endif
                        </td>
                        </trtyle=>
                @endif
            @endfor
            <br>
            <br>
            <br>
            <table cellpadding="0" width="500px"
                style="border-collapse: collapse; font-size: 14.4px; bottom: 68; position: fixed;">
                <tr>
                    <td style="margin: 0.1px; padding: 0px;">
                        <table cellpadding="0" style="border-collapse: collapse; font-size: 17px;">
                            <tr>
                                <td valign="top">
                                    <img src="http://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
                                        width="120" style="display: block;">
                                </td>
                                <td valign="top"
                                    style="border-left: 1px solid rgb(176, 70, 70); margin: 0.1px; padding: 0px 0px 0px 12px; color: rgb(124, 124, 124);">
                                    <table cellpadding="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td
                                                style="margin: 0.1px; padding: 0px 0px 8px; color: #DD3932; font-size: 18px; margin-top: 5px">
                                                {{ $creador->nombre }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="margin: 0.9px; padding: 0px;">
                                                <table cellpadding="0" style="border-collapse: collapse;">
                                                    <tr style="cursor: pointer;">
                                                        <td
                                                            style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                            {{ $creador->cargo }} <br>
                                                            Email: {{ $creador->email }}
                                                        </td>
                                                        <td
                                                            style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);">
                                                        </td>
                                                    </tr>
                                                    <tr style="cursor: pointer;">
                                                        <td
                                                            style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                            Dirección: Medellín, Colombia
                                                        </td>
                                                        <td
                                                            style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);">
                                                        </td>
                                                    </tr>
                                                    <tr style="cursor: pointer; text-align: left;">
                                                        <td
                                                            style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                            Celular: {{ $creador->telefono_celular }}
                                                        </td>
                                                        <td
                                                            style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);; text-align: left;">

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
