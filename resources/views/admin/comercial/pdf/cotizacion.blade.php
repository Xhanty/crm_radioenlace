<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Cotización No {{ $cotizacion->code }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .invoice-box {
            max-width: 800px;
            height: 969px;
            margin: auto;
            padding: 22px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
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
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
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
                <td colspan="5">
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
                <td colspan="5">
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

            @if ($cotizacion->duracion || $cotizacion->tiempo_entrega)
                <tr class="heading">
                    <td colspan="3">
                        Duración
                    </td>

                    <td>
                        Tiempo de entrega
                    </td>
                </tr>

                <tr class="details">
                    <td colspan="3">
                        {{ $cotizacion->duracion }}
                    </td>

                    <td>
                        {{ $cotizacion->tiempo_entrega }}
                    </td>
                </tr>
            @endif

            @if ($cotizacion->validez || $cotizacion->forma_pago)
                <tr class="heading">
                    <td colspan="3">
                        Validez de la oferta
                    </td>

                    <td>
                        Forma de pago
                    </td>
                </tr>

                <tr class="details">
                    <td colspan="3">
                        {{ $cotizacion->validez }}
                    </td>

                    <td>
                        {{ $cotizacion->forma_pago }}
                    </td>
                </tr>
            @endif

            @if ($cotizacion->descripcion)
                <tr class="heading">
                    <td colspan="5">
                        Descripción
                    </td>
                </tr>


                <tr class="details">
                    <td colspan="5">
                        {{ $cotizacion->descripcion }}
                    </td>
                </tr>
            @endif

            <tr class="heading">
                <td></td>
                <td style="text-align: center;">Producto</td>
                <td style="text-align: center;">Cantidad</td>
                <td class="text-align-right">Precio U.</td>
                <td class="text-align-right">Precio Total</td>
            </tr>

            @php
                $subtotal = 0;
            @endphp

            @for ($i = 0; $i < count($productos); $i++)
                @php
                    $total = $productos[$i]->cantidad * $productos[$i]->precio;
                    $subtotal += $total;
                    if ($productos[$i]->imagen == null || $productos[$i]->imagen == '') {
                        $productos[$i]->imagen = 'noimagen.png';
                    }
                @endphp
                @if ($i == count($productos) - 1)
                    <tr class="item last">
                        <td class="text-align-right">
                            <img src="{{ public_path('images/productos/') }}{{ $productos[$i]->imagen }}"
                                style="width:100%; max-width:50px;">
                        </td>
                        <td style="text-align: center;">
                            <b>{{ $productos[$i]->producto }}</b> <br>
                            <p style="font-size: 14px; margin-top: 0px; width: 255px">{{ $productos[$i]->descripcion }}
                            </p>
                        </td>
                        <td style="text-align: center;">{{ $productos[$i]->cantidad }}</td>
                        <td class="text-align-right">{{ number_format($productos[$i]->precio, 2) }}</td>
                        <td class="text-align-right">{{ number_format($total, 2) }}</td>
                    </tr>
                @else
                    <tr class="item">
                        <td class="text-align-right">
                            <img src="{{ public_path('images/productos/') }}{{ $productos[$i]->imagen }}"
                                style="width:100%; max-width:50px;">
                        </td>
                        <td style="text-align: center;">
                            <b>{{ $productos[$i]->producto }}</b>
                            <p style="font-size: 14px; margin-top: 0px">{{ $productos[$i]->descripcion }}
                            </p>
                        </td>
                        <td style="text-align: center;">{{ $productos[$i]->cantidad }}</td>
                        <td class="text-align-right">{{ number_format($productos[$i]->precio, 2) }}</td>
                        <td class="text-align-right">{{ number_format($total, 2) }}</td>
                    </tr>
                @endif
            @endfor

            @php
                $iva = $subtotal * 0.19;
            @endphp

            <tr class="total">
                <td colspan="5" class="text-align-right">
                    Subtotal: {{ number_format($subtotal, 2) }}<br />
                    IVA: {{ number_format($iva, 2) }}<br />
                    <b>Total: {{ number_format($subtotal + $iva, 2) }}</b>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>