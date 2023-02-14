<!DOCTYPE html>
<html lang="es">

<head>
    <title>Copia Actualización Precios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--- Favicon --->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/tb/Table_Responsive_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/perfect-scrollbar/perfect-scrollbar.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/tb/Table_Responsive_v1/css/util.css">
    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/tb/Table_Responsive_v1/css/main.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <style>
        .container-table100 {
            background: linear-gradient(45deg, rgb(53, 53, 53), #DA251D) !important
        }

        .price_final {
            text-align: right;
            padding-right: 20px;
        }
    </style>
    <div class="limiter ">
        <div class="container-table100">
            <div class="wrap-table100 text-center" style="width: 90%">
                <h3 class="text-white">{{ $precio->razon_social }}</h3>
                <br>
                <div class="table100">
                    <table>
                        <thead>
                            <tr class="table100-head">
                                <th class="column1">Producto</th>
                                <th class="column1 text-center">Nota</th>
                                <th class="column1 text-center">Cant.<br>Requerida</th>
                                <th class="column1 text-center">Cant.<br>Disponible</th>
                                <th class="column1 text-center">Precio Unidad ({{ $precio->moneda }})</th>
                                <th class="column1 text-center">Descuento (%)</th>
                                <th class="column1 text-center">IVA (%)</th>
                                <th class="column1 text-center">Subtotal ({{ $precio->moneda }})</th>
                                <th class="column1">Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="column1">{{ $producto->nombre }} ({{ $producto->modelo }})</td>
                                    <td class="column1 text-center">{{ $producto->nota }}</td>
                                    <td class="column1 text-center">{{ $producto->cantidad_requerida }}</td>
                                    <td class="column1 text-center">
                                        <input type="text" disabled syle="background: transparent" class="text-center cantidad" value="{{ $producto->cantidad_disponible }}">
                                    </td>
                                    <td class="column1 text-center" >
                                        <input type="text" disabled data-id="{{ $producto->id }}" style="background: transparent" class="text-center precio" value="{{ $producto->precio }}">
                                    </td>
                                    <td class="column1 text-center">
                                        <input type="text" disabled syle="background: transparent" class="text-center descuento" value="{{ $producto->descuento }}">
                                    </td>
                                    <td class="column1 text-center">
                                        <input type="text" disabled syle="background: transparent" class="text-center iva" value="{{ $producto->iva }}">
                                    </td>
                                    <td class="column1 text-center preciofinal">0</td>
                                    <td class="column1 comentario">
                                        {{ $producto->comentario }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <div class="table100">
                    <table>
                        <tbody>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Fecha Entrega</th>
                                <th class="column1 price_final" id="fecha_entrega" style="color: gray">
                                    {{ $precio->fecha_entrega }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Condiciones de entrega</th>
                                <th class="column1 price_final" id="condicion_entrega" style="color: gray">
                                    {{ $precio->condiciones_entrega }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Condiciones de pago</th>
                                <th class="column1 price_final" id="condiciones_pago" style="color: gray">
                                    {{ $precio->condiciones_pago }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Precio Dolar</th>
                                <th class="column1 price_final" id="precio_dolar" style="color: gray">
                                    {{ $precio->precio_dolar }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Total</th>
                                <th class="column1 price_final" id="preciofinal_total" style="color: gray">
                                    {{ $precio->total }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

    <script src="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/bootstrap/js/popper.js"></script>
    <script src="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var preciofinal_total = 0;

            let money = "{{ $precio->moneda }}";
            let type_money = "en-US";

            if (money == 'COP') {
                type_money = "es-CO";
            }

            const formatter = new Intl.NumberFormat(type_money, {
                style: 'currency',
                currency: money,
                minimumFractionDigits: 0
            });

            function calcularPrecioFinal() {
                var preciofinal_total = 0;
                $('.preciofinal').each(function() {
                    var preciofinal = $(this).text();
                    var cantidad = $(this).parent().parent().find('.cantidad').val();
                    preciofinal = preciofinal.replace("$", "");
                    preciofinal = preciofinal.replace(",", "");
                    preciofinal = preciofinal.replace(".", "");
                    preciofinal_total = preciofinal_total + (preciofinal * cantidad);
                });

                $("#preciofinal_total").text(formatter.format(preciofinal_total));
            }

            $('.precio').each(function() {
                var precio = $(this).val();
                precio = precio.replace("$", "");
                precio = precio.replace(",", "");
                var descuento = $(this).parent().parent().find('.descuento').val();
                var iva = $(this).parent().parent().find('.iva').val();
                var cantidad = $(this).parent().parent().find('.cantidad').val();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).val(formatter.format(precio));
                $(this).parent().parent().find('.preciofinal').text(formatter.format(preciofinal));
            });

            calcularPrecioFinal();
        });
    </script>
</body>

</html>
