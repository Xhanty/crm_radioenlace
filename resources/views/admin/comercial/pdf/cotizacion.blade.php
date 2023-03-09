<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Cotización No {{ $cotizacion->code }}</title>

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
            background-image: url("https://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png");
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
                <td colspan="7">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
                                    style="width:100%; max-width:80px;">
                            </td>

                            <td>
                                <br>
                                <strong>Cotización No:</strong> {{ $cotizacion->code }}<br>
                                <strong>Fecha:</strong> {{ date('d-m-Y', strtotime($cotizacion->created_at)) }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td>
                                <b>{{ $cotizacion->razon_social }}<br>
                                    {{ $cotizacion->nit }}-{{ $cotizacion->codigo_verificacion }}<br>
                                    {{ $cotizacion->ciudad }}, Colombia</b>
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

            @if ($cotizacion->descripcion)
                <tr class="heading">
                    <td colspan="7">
                        Descripción
                    </td>
                </tr>


                <tr class="details">
                    <td colspan="7" style="font-size: 15px; text-align: justify;">
                        @php
                            $texto = $cotizacion->descripcion;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>
                </tr>
            @endif

            @if ($cotizacion->incluye)
                <tr class="heading">
                    <td colspan="7">
                        Incluye
                    </td>
                </tr>


                <tr class="details">
                    <td colspan="7" style="font-size: 15px; text-align: justify;">
                        @php
                            $texto = $cotizacion->incluye;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>
                </tr>
            @endif

            <tr class="heading">
                <td style="width: 100px; text-align: center;"></td>
                <td style="width: 222px; text-align: center;">Producto</td>
                <td style="text-align: center;">Cant.</td>
                <td class="text-align-right">Precio U.</td>
                <td class="text-align-right">Iva(%)</td>
                <td class="text-align-right">Retención(%)</td>
                <td class="text-align-right">Subtotal</td>
            </tr>

            @php
                $subtotal = 0;
                $subtotal_mensual = 0;
                $incluye_mensual = 0;
                $incluye_anual = 0;
                $iva = 0;
                $iva_mensual = 0;
                $retencion = 0;
                $retencion_mensual = 0;
            @endphp

            @for ($i = 0; $i < count($productos); $i++)
                @if ($productos[$i]->titulo)
                    <tr style="background: #eee">
                        <td colspan="7" style="text-align: center; padding-top: 2%;">
                            <b>{{ $productos[$i]->titulo }}</b>
                        </td>
                    </tr>
                @else
                    @php
                        if ($productos[$i]->tipo_pago == 1) {
                            $total = $productos[$i]->cantidad * $productos[$i]->precio;
                            $subtotal_mensual += $productos[$i]->cantidad * $productos[$i]->precio;
                            $incluye_mensual++;
                        } else {
                            $total = $productos[$i]->cantidad * $productos[$i]->precio;
                            $subtotal += $productos[$i]->cantidad * $productos[$i]->precio;
                            $incluye_anual++;
                        }
                        
                        if ($productos[$i]->imagen == null || $productos[$i]->imagen == '') {
                            $productos[$i]->imagen = 'noimagen.png';
                        }
                    @endphp
                    @if ($i == count($productos) - 1)
                        @if ($productos[$i]->img_grande == 1)
                            <tr>
                                <td style="text-align: center; padding-top: 2%;" colspan="2">
                                    <b>{{ $productos[$i]->producto }}</b> <br>
                                    <b>{{ $productos[$i]->modelo }}</b>
                                </td>
                                <td style="text-align: center; padding-top: 3%;">{{ $productos[$i]->cantidad }}</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($productos[$i]->precio, 0, ',', '.') }}</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->iva }}%</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->retencion }}%</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="item">
                                <td colspan="7">
                                    <p style="font-size: 14px; margin-top: 0px; text-align: justify">
                                        @php
                                            $texto = $productos[$i]->descripcion;
                                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                                            echo $texto_nuevo;
                                        @endphp
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding-top: 2%;" colspan="7">
                                    <img src="https://crm.formrad.com/images/productos/{{ $productos[$i]->imagen }}"
                                        style="width:100%; max-height: 288px">
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td style="text-align: center; padding-top: 2%;">
                                    <img src="https://crm.formrad.com/images/productos/{{ $productos[$i]->imagen }}"
                                        style="width:100%; max-width:105px; max-height: 120px">
                                </td>
                                <td style="text-align: center; padding-top: 3%;">
                                    <b>{{ $productos[$i]->producto }}</b><br>
                                    <b>{{ $productos[$i]->modelo }}</b>
                                </td>
                                <td style="text-align: center; padding-top: 3%">{{ $productos[$i]->cantidad }}</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($productos[$i]->precio, 0, ',', '.') }}</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->iva }}%</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->retencion }}%</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="item">
                                <td colspan="7">
                                    <p style="font-size: 14px; margin-top: 0px; text-align: justify">
                                        @php
                                            $texto = $productos[$i]->descripcion;
                                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                                            echo $texto_nuevo;
                                        @endphp
                                    </p>
                                </td>
                            </tr>
                        @endif
                    @else
                        @if ($productos[$i]->img_grande == 1)
                            <tr>
                                <td style="text-align: center; padding-top: 2%;" colspan="2">
                                    <b>{{ $productos[$i]->producto }}</b> <br>
                                    <b>{{ $productos[$i]->modelo }}</b>
                                </td>
                                <td style="text-align: center; padding-top: 3%;">{{ $productos[$i]->cantidad }}</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($productos[$i]->precio, 0, ',', '.') }}</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->iva }}%</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->retencion }}%</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="item">
                                <td colspan="7">
                                    <p style="font-size: 14px; margin-top: 0px; text-align: justify">
                                        @php
                                            $texto = $productos[$i]->descripcion;
                                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                                            echo $texto_nuevo;
                                        @endphp
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding-top: 2%;" colspan="7">
                                    <img src="https://crm.formrad.com/images/productos/{{ $productos[$i]->imagen }}"
                                        style="width:100%; max-height: 288px">
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td style="text-align: center; padding-top: 2%;">
                                    <img src="https://crm.formrad.com/images/productos/{{ $productos[$i]->imagen }}"
                                        style="width:100%; max-width:105px; max-height: 120px">
                                </td>
                                <td style="text-align: center; padding-top: 3%;">
                                    <b>{{ $productos[$i]->producto }}</b> <br>
                                    <b>{{ $productos[$i]->modelo }}</b>
                                </td>
                                <td style="text-align: center; padding-top: 3%;">{{ $productos[$i]->cantidad }}</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($productos[$i]->precio, 0, ',', '.') }}</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->iva }}%</td>
                                <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->retencion }}%</td>
                                <td class="text-align-right" style="padding-top: 3%">
                                    {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="item">
                                <td colspan="7">
                                    <p style="font-size: 14px; margin-top: 0px; text-align: justify">
                                        @php
                                            $texto = $productos[$i]->descripcion;
                                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                                            echo $texto_nuevo;
                                        @endphp
                                    </p>
                                </td>
                            </tr>
                        @endif
                    @endif

                    @php
                        if ($productos[$i]->tipo_pago == 1) {
                            $iva_mensual += $total * ($productos[$i]->iva / 100);
                            $retencion_mensual += $total * ($productos[$i]->retencion / 100);
                        } else {
                            $iva += $total * ($productos[$i]->iva / 100);
                            $retencion += $total * ($productos[$i]->retencion / 100);
                        }
                    @endphp

                @endif
            @endfor

            <tr class="total">
                @if ($incluye_mensual > 0)
                    <td @if ($incluye_anual == 0) colspan="7" @else colspan="3" @endif class="text-align-left">
                        <b>Pago Mensual</b><br />
                        Subtotal: {{ number_format($subtotal_mensual, 0, ',', '.') }}<br />
                        Iva: {{ number_format($iva_mensual, 0, ',', '.') }}<br />
                        Retención: {{ number_format($retencion_mensual, 0, ',', '.') }}<br />
                        <b>Total:
                            {{ number_format($subtotal_mensual + $iva_mensual - $retencion_mensual, 0, ',', '.') }}</b>
                    </td>
                @endif

                @if ($incluye_anual > 0)
                    <td @if ($incluye_mensual > 0) colspan="4" @else colspan="7" @endif class="text-align-right">
                        @if ($incluye_mensual > 0)
                            <b>Pago Único</b><br />
                        @endif
                        Subtotal: {{ number_format($subtotal, 0, ',', '.') }}<br />
                        Iva: {{ number_format($iva, 0, ',', '.') }}<br />
                        Retención: {{ number_format($retencion, 0, ',', '.') }}<br />
                        <b>Total: {{ number_format($subtotal + $iva - $retencion, 0, ',', '.') }}</b>
                    </td>
                @endif
            </tr>

            <br>

            @if ($cotizacion->duracion || $cotizacion->tiempo_entrega)
                <tr class="heading">
                    <td colspan="3">
                        Duración
                    </td>

                    <td colspan="4">
                        Tiempo de entrega
                    </td>
                </tr>

                <tr class="details">
                    <td colspan="3" style="font-size: 15px;">
                        @php
                            $texto = $cotizacion->duracion;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>

                    <td colspan="4" style="font-size: 15px;">
                        @php
                            $texto = $cotizacion->tiempo_entrega;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>
                </tr>
            @endif

            @if ($cotizacion->validez || $cotizacion->forma_pago)
                <tr class="heading">
                    <td colspan="3">
                        Validez de la oferta
                    </td>

                    <td colspan="4">
                        Forma de pago
                    </td>
                </tr>

                <tr class="details">
                    <td colspan="3" style="font-size: 15px">
                        @php
                            $texto = $cotizacion->validez;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>

                    <td colspan="4" style="font-size: 15px">
                        @php
                            $texto = $cotizacion->forma_pago;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>
                </tr>
            @endif

            <tr class="heading">
                <td colspan="2">
                    Moneda
                </td>

                <td colspan="5">
                    Garantía
                </td>
            </tr>

            <tr class="details">
                <td colspan="2" style="font-size: 15px">
                    Peso colombiano. (COP)
                </td>

                <td colspan="5" style="font-size: 15px">
                    @php
                        $texto = $cotizacion->garantia;
                        $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                        echo $texto_nuevo;
                    @endphp
                </td>
            </tr>

            @if ($cotizacion->envio)
                <tr class="heading">
                    <td colspan="7">
                        Envío
                    </td>
                </tr>

                <tr class="details">
                    <td colspan="7" style="font-size: 15px;">
                        @php
                            $texto = $cotizacion->envio;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            echo $texto_nuevo;
                        @endphp
                    </td>
                </tr>
            @endif

            <table cellpadding="0" width="500px"
                style="border-collapse: collapse; font-size: 14.4px; bottom: 77; position: fixed;">
                <tr>
                    <td style="margin: 0.1px; padding: 0px;">
                        <table cellpadding="0" style="border-collapse: collapse; font-size: 17px;">
                            <tr>
                                <td valign="top">
                                    <img src="https://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
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
