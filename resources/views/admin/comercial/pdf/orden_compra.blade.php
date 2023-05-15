<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Orden de Compra No {{ $orden->code }}</title>

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
            padding-bottom: 8px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 12px;
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
                                <img src="http://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
                                    style="width:100%; max-width:80px;">
                            </td>

                            <td>
                                <br>
                                <strong>Orden No:</strong> {{ $orden->code }}<br>
                                <strong>Fecha:</strong> {{ date('d-m-Y', strtotime($orden->created_at)) }}<br>
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
                                <b>{{ $proveedor->razon_social }}<br>
                                    {{ $proveedor->nit }}-{{ $proveedor->codigo_verificacion }}<br>
                                    {{ $proveedor->ciudad }}, Colombia</b>
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

            @if ($orden->descripcion)
                <tr class="heading">
                    <td colspan="7">
                        Descripción
                    </td>
                </tr>


                <tr class="details">
                    <td colspan="7" style="font-size: 15px; text-align: justify;">
                        @php
                            $texto = $orden->descripcion;
                            $texto_nuevo = preg_replace('/\*(.*?)\*/', "<b>$1</b>", $texto);
                            $texto_nuevo = preg_replace('/(-)(.*?)(-)/', "<span style='margin-left: 10px'>$2</span>", $texto_nuevo);
                            echo nl2br($texto_nuevo);
                        @endphp
                    </td>
                </tr>
            @endif

            <tr class="heading">
                <td style="width: 100px; text-align: center;"></td>
                <td style="width: 220px; text-align: center;">Producto</td>
                <td style="text-align: center;">Cant.</td>
                <td style="text-align: center;">Precio Unit.</td>
                <td style="text-align: center;">Iva(%)</td>
                <td style="text-align: center;">Retención(%)</td>
                <td class="text-align-right">Precio Total</td>
            </tr>

            @php
                $subtotal = 0;
                $total_todo = 0;
                $iva = 0;
                $retencion = 0;
            @endphp

            @for ($i = 0; $i < count($productos); $i++)
                @php //$total=$productos[$i]->cantidad * $productos[$i]->precio;
                    $total = $productos[$i]->precio * $productos[$i]->cantidad;
                    $total2 = $productos[$i]->precio * $productos[$i]->cantidad;
                    $total = $total + ($total * $productos[$i]->iva) / 100;
                    $total = $total - ($total2 * $productos[$i]->retencion) / 100;
                    $subtotal += $total2;
                    $total_todo += $total;
                    
                    $iva += $total2 * ($productos[$i]->iva / 100);
                    $retencion += $total2 * ($productos[$i]->retencion / 100);
                    
                    if ($productos[$i]->imagen == null || $productos[$i]->imagen == '') {
                        $productos[$i]->imagen = 'noimagen.png';
                    }
                @endphp
                @if ($i == count($productos) - 1)
                    <tr>
                        <td style="text-align: center; padding-top: 2%;">
                            <img src="https://crm.formrad.com/images/productos/{{ $productos[$i]->imagen }}"
                                style="width:100%; max-width:100px; max-height: 120px">
                        </td>
                        <td style="text-align: center; padding-top: 3%;">
                            <b>{{ $productos[$i]->producto }}</b><br>
                            <b>{{ $productos[$i]->modelo }}</b>
                        </td>
                        <td style="text-align: center; padding-top: 3%">{{ $productos[$i]->cantidad }}</td>
                        <td style="padding-top: 3%; text-align: center;">
                            {{ number_format($productos[$i]->precio, 0, ',', '.') }}</td>
                        <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->iva }}%</td>
                        <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->retencion }}%</td>
                        <td class="text-align-right" style="padding-top: 3%">{{ number_format($total, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr class="item">
                        <td colspan="7">
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
                            <img src="https://crm.formrad.com/images/productos/{{ $productos[$i]->imagen }}"
                                style="width:100%; max-width:100px; max-height: 120px">
                        </td>
                        <td style="text-align: center; padding-top: 3%;">
                            <b>{{ $productos[$i]->producto }}</b> <br>
                            <b>{{ $productos[$i]->modelo }}</b>
                        </td>
                        <td style="text-align: center; padding-top: 3%;">{{ $productos[$i]->cantidad }}</td>
                        <td style="padding-top: 3%; text-align: center;">
                            {{ number_format($productos[$i]->precio, 0, ',', '.') }}
                        </td>
                        <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->iva }}%</td>
                        <td style="padding-top: 3%; text-align: center;">{{ $productos[$i]->retencion }}%</td>
                        <td class="text-align-right" style="padding-top: 3%">{{ number_format($total, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr class="item">
                        <td colspan="7">
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

            <tr class="total">
                <td colspan="7" class="text-align-right">
                    Subtotal: {{ number_format($subtotal, 0, ',', '.') }}<br />
                    Iva: {{ number_format($iva, 0, ',', '.') }}<br />
                    Retención: {{ number_format($retencion, 0, ',', '.') }}<br />
                    <b>Total: {{ number_format($total_todo, 0, ',', '.') }}</b>
                </td>
            </tr>

            <br>

            <table cellpadding="0" width="500px"
                style="border-collapse: collapse; font-size: 14.4px; bottom: 80; position: fixed;">
                <tr>
                    <td style="margin: 0.1px; padding: 0px;">
                        <table cellpadding="0" style="border-collapse: collapse; font-size: 18px;">
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
