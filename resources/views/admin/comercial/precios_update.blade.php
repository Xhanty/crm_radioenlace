<!DOCTYPE html>
<html lang="es">

<head>
    <title>Actualización Precios</title>
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
                                <th class="column1 text-center">Precio Unit.<br>Público ({{ $precio->moneda }})</th>
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
                                    <td class="column1 text-center cantidad"
                                        @if (!auth()->user()) contenteditable="true" @endif>
                                        {{ $producto->cantidad_disponible }}</td>
                                    <td class="column1 text-center precio" data-id="{{ $producto->id }}"
                                        @if (!auth()->user()) contenteditable="true" @endif>
                                        {{ $producto->precio ?? 0 }}</td>
                                    <td class="column1 text-center descuento"
                                        @if (!auth()->user()) contenteditable="true" @endif>
                                        {{ $producto->descuento ?? 0 }}</td>
                                    <td class="column1 text-center iva"
                                        @if (!auth()->user()) contenteditable="true" @endif>
                                        {{ $producto->iva ?? 0 }}</td>
                                    <td class="column1 text-center preciofinal">0</td>
                                    <td class="column1 comentario"
                                        @if (!auth()->user()) contenteditable="true" @endif>
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
                                <th class="column1 price_final" id="fecha_entrega" @if (!auth()->user()) contenteditable="true" @endif style="color: gray">{{ $precio->fecha_entrega }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Condiciones de entrega</th>
                                <th class="column1 price_final" id="condicion_entrega" @if (!auth()->user()) contenteditable="true" @endif style="color: gray">{{ $precio->condiciones_entrega }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Condiciones de pago</th>
                                <th class="column1 price_final" id="condiciones_pago" @if (!auth()->user()) contenteditable="true" @endif style="color: gray">{{ $precio->condiciones_pago }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Precio Dolar</th>
                                <th class="column1 price_final" id="precio_dolar" @if (!auth()->user()) contenteditable="true" @endif style="color: gray">{{ $precio->precio_dolar }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Total</th>
                                <th class="column1 price_final" id="preciofinal_total" style="color: gray">{{ $precio->total }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <input type="hidden" id="nit_val" value="{{ $precio->nit }}" disabled readonly>
                <input type="hidden" id="clave_val" value="{{ $precio->clave }}" disabled readonly>
                @if (!auth()->user())
                    <button class="btn btn-primary" id="btnSave">Actualizar Precios</button>
                @endif
            </div>
        </div>
    </div>

    <script src="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/bootstrap/js/popper.js"></script>
    <script src="https://colorlib.com/etc/tb/Table_Responsive_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var preciofinal_total = 0;
            @if (!auth()->user())
                /*let nit = $("#nit_val").val();
                let value_nit = prompt("Ingrese el nit:");
                if (nit != value_nit) {
                    alert("El nit ingresado no es correcto");
                    location.reload();
                } else {
                    let clave = $("#clave_val").val();
                    let value_clave = prompt("Ingrese la clave:");
                    if (clave != value_clave) {
                        alert("La clave ingresada no es correcta");
                        location.reload();
                    } else {
                        $(".d-none").removeClass("d-none");
                    }
                }*/
            @endif

            @if (auth()->user())
                $(".d-none").removeClass("d-none");
            @endif

            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 0
            });

            function calcularPrecioFinal() {
                var preciofinal_total = 0;
                $('.preciofinal').each(function() {
                    var preciofinal = $(this).text();
                    var cantidad = $(this).parent().find('.cantidad').text();
                    preciofinal = preciofinal.replace("$", "");
                    preciofinal = preciofinal.replace(",", "");
                    preciofinal_total = preciofinal_total + (preciofinal * cantidad);
                });

                $("#preciofinal_total").text(formatter.format(preciofinal_total));
            }

            $('.cantidad').on('input', function() {
                calcularPrecioFinal();
            });

            $('.precio').on('input', function() {
                var precio = $(this).text();
                var descuento = $(this).parent().find('.descuento').text();
                var cantidad = $(this).parent().find('.cantidad').text();
                var iva = $(this).parent().find('.iva').text();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().find('.preciofinal').text(formatter.format(preciofinal));
                calcularPrecioFinal();
            });

            $('.descuento').on('input', function() {
                var descuento = $(this).text();
                var precio = $(this).parent().find('.precio').text();
                var iva = $(this).parent().find('.iva').text();
                var cantidad = $(this).parent().find('.cantidad').text();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().find('.preciofinal').text(formatter.format(preciofinal));
                calcularPrecioFinal();
            });

            $('.iva').on('input', function() {
                var iva = $(this).text();
                var precio = $(this).parent().find('.precio').text();
                var descuento = $(this).parent().find('.descuento').text();
                var cantidad = $(this).parent().find('.cantidad').text();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().find('.preciofinal').text(formatter.format(preciofinal));
                calcularPrecioFinal();
            });

            $('.precio').each(function() {
                var precio = $(this).text();
                var descuento = $(this).parent().find('.descuento').text();
                var iva = $(this).parent().find('.iva').text();
                var cantidad = $(this).parent().find('.cantidad').text();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().find('.preciofinal').text(formatter.format(preciofinal));
            });

            $("#btnSave").click(function() {
                var fecha_entrega = $("#fecha_entrega").text();
                var condicion_entrega = $("#condicion_entrega").text();
                var condiciones_pago = $("#condiciones_pago").text();
                var precio_dolar = $("#precio_dolar").text();
                var total = $("#preciofinal_total").text();
                var productos = [];
                var cantidad = 0;
                var precio = 0;
                var descuento = 0;
                var preciofinal = 0;
                var comentario = "";
                var id = 0;
                var i = 0;
                var valid = 0;

                $('.precio').each(function() {
                    cantidad = $(this).parent().find('.cantidad').text();
                    precio = $(this).text();
                    descuento = $(this).parent().find('.descuento').text();
                    preciofinal = $(this).parent().find('.preciofinal').text();
                    comentario = $(this).parent().find('.comentario').text();
                    id = $(this).data('id');

                    if (preciofinal == "" || preciofinal == 0 || preciofinal == "0" ||
                        preciofinal == "0.00") {
                        valid = 1;
                    }

                    productos[i] = {
                        cantidad: cantidad,
                        precio: precio,
                        descuento: descuento,
                        preciofinal: preciofinal,
                        comentario: comentario,
                        id: id
                    };
                    i++;
                });

                if (fecha_entrega == "") {
                    valid = 1;
                }

                if (valid == 1) {
                    alert("Debe llenar todos los campos");
                    return false;
                } else {
                    if (window.confirm("¿Está seguro de actualizar los precios?")) {
                        $.ajax({
                            url: "{{ route('precios_edit') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                fecha_entrega: fecha_entrega,
                                condicion_entrega: condicion_entrega,
                                condiciones_pago: condiciones_pago,
                                precio_dolar: precio_dolar,
                                total: total,
                                productos: productos
                            },
                            success: function(response) {
                                if (response.info == 1) {
                                    alert("Precios actualizados correctamente");
                                    location.reload();
                                } else {
                                    alert("Error al actualizar los precios");
                                }
                            },
                            error: function(response) {
                                alert("Error al actualizar los precios");
                            }
                        });
                    }
                }


            });
        });
    </script>
</body>

</html>
