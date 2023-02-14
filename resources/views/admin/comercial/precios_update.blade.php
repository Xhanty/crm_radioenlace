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
        body, html {
            background: linear-gradient(45deg, rgb(53, 53, 53), #DA251D) !important;
        }
        
        .container-table100 {
            background: transparent;
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
                                        <input type="text" @if(auth()->user()) disabled @endif style="background: transparent" class="text-center cantidad" value="{{ $producto->cantidad_disponible }}">
                                    </td>
                                    <td class="column1 text-center">
                                        <input type="text" @if(auth()->user()) disabled @endif data-id="{{ $producto->id }}" style="background: transparent" class="text-center precio" value="{{ $producto->precio ?? 0 }}">
                                    </td>
                                    <td class="column1 text-center">
                                        <input type="text" @if(auth()->user()) disabled @endif style="background: transparent" class="text-center descuento" value="{{ $producto->descuento ?? 0 }}">
                                    </td>
                                    <td class="column1 text-center">
                                        <input type="text" @if(auth()->user()) disabled @endif style="background: transparent" class="text-center iva" value="{{ $producto->iva ?? 0 }}">
                                    </td>
                                    <td class="column1 text-center preciofinal">
                                        0
                                    </td>
                                    <td class="column1 comentario" @if (!auth()->user()) contenteditable="true" @endif>
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
                                <th class="column1 price_final" id="fecha_entrega"
                                    @if (!auth()->user()) contenteditable="true" @endif style="color: gray">
                                    {{ $precio->fecha_entrega }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Condiciones de entrega</th>
                                <th class="column1 price_final" id="condicion_entrega"
                                    @if (!auth()->user()) contenteditable="true" @endif style="color: gray">
                                    {{ $precio->condiciones_entrega }}</th>
                            </tr>
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Condiciones de pago</th>
                                <th class="column1 price_final" id="condiciones_pago"
                                    @if (!auth()->user()) contenteditable="true" @endif style="color: gray">
                                    {{ $precio->condiciones_pago }}</th>
                            </tr>

                            @if($precio->moneda == 'USD')
                                <tr class="table100-head">
                                    <th class="column1" style="background: #36304a">Precio Dolar</th>
                                    <th class="column1 price_final" id="precio_dolar"
                                        @if (!auth()->user()) contenteditable="true" @endif style="color: gray">
                                        {{ $precio->precio_dolar }}</th>
                                </tr>
                            @endif

                            @if($precio->total == 0)
                                <tr class="table100-head">
                                    <th class="column1" style="background: #36304a">Archivo (Opcional)</th>
                                    <th style="color: gray;">
                                        <input type="file" id="file_cotizacion" style="width: 100%">
                                        {{ $precio->condiciones_pago }}
                                    </th>
                                </tr>
                            @elseif($precio->file_cotizacion != null)
                                <tr class="table100-head">
                                    <th class="column1" style="background: #36304a">Archivo</th>
                                    <th style="color: gray; text-align: right; padding-right: 20px">
                                        <a href="{{ $precio->file_cotizacion }}" target="_blank">Descargar</a>
                                    </th>
                                </tr>
                            @endif
                            <tr class="table100-head">
                                <th class="column1" style="background: #36304a">Total</th>
                                <th class="column1 price_final" id="preciofinal_total" style="color: gray">
                                    {{ $precio->total }}
                                </th>
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
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            var preciofinal_total = 0;
            /*@if (!auth()->user())
                let nit = $("#nit_val").val();
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
                }
            @endif

            @if (auth()->user())
                $(".d-none").removeClass("d-none");
            @endif*/

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

            $('.cantidad').on('input', function() {
                calcularPrecioFinal();
            });

            $('.precio').change( function() {
                var precio = $(this).val();
                precio = precio.replace("$", "");
                precio = precio.replace(",", "");
                var descuento = $(this).parent().parent().find('.descuento').val();
                var iva = $(this).parent().parent().find('.iva').val();
                var cantidad = $(this).parent().parent().find('.cantidad').val();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().parent().find('.preciofinal').text(formatter.format(preciofinal));
                calcularPrecioFinal();
                $(this).val(formatter.format(precio));
            });

            $('.descuento').change( function() {
                var descuento = $(this).val();
                var precio = $(this).parent().parent().find('.precio').val();
                precio = precio.replace("$", "");
                precio = precio.replace(",", "");
                var iva = $(this).parent().parent().find('.iva').val();
                var cantidad = $(this).parent().parent().find('.cantidad').val();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().parent().find('.preciofinal').text(formatter.format(preciofinal));
                calcularPrecioFinal();
            });

            $('.iva').change( function() {
                var iva = $(this).val();
                var precio = $(this).parent().parent().find('.precio').val();
                precio = precio.replace("$", "");
                precio = precio.replace(",", "");
                var descuento = $(this).parent().parent().find('.descuento').val();
                var cantidad = $(this).parent().parent().find('.cantidad').val();
                var preciofinal = precio - (precio * descuento / 100);
                var preciofinal = preciofinal + (preciofinal * iva / 100);
                $(this).parent().parent().find('.preciofinal').text(formatter.format(preciofinal));
                calcularPrecioFinal();
            });

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

            $("#btnSave").click(function() {
                var fecha_entrega = $("#fecha_entrega").text();
                var condicion_entrega = $("#condicion_entrega").text();
                var condiciones_pago = $("#condiciones_pago").text();
                var precio_dolar = $("#precio_dolar").text();
                var total = $("#preciofinal_total").text();
                var file = $("#file_cotizacion").val();
                var productos = [];
                var cantidad = 0;
                var iva = 0;
                var precio = 0;
                var descuento = 0;
                var preciofinal = 0;
                var comentario = "";
                var id = 0;
                var i = 0;
                var valid = 0;

                $('.precio').each(function() {
                    iva = $(this).parent().parent().find('.iva').val();
                    cantidad = $(this).parent().parent().find('.cantidad').val();
                    precio = $(this).val();
                    descuento = $(this).parent().parent().find('.descuento').val();
                    preciofinal = $(this).parent().parent().find('.preciofinal').text();
                    comentario = $(this).parent().parent().find('.comentario').text();
                    id = $(this).data('id');

                    if (preciofinal == "" || preciofinal == 0 || preciofinal == "0" ||
                        preciofinal == "0.00" || preciofinal == "$0" || preciofinal == "$NaN" || preciofinal == "$ 0") {
                        valid = 1;
                    }

                    productos[i] = {
                        iva: iva,
                        cantidad: cantidad,
                        precio: precio,
                        descuento: descuento,
                        preciofinal: preciofinal,
                        comentario: comentario,
                        id: id
                    };
                    i++;
                });

                if(total == "$ 0") {
                    valid = 1;
                }

                if (fecha_entrega.trim().length < 1) {
                    valid = 1;
                }

                if (valid == 1) {
                    alert("Debe llenar todos los campos");
                    return false;
                } else {
                    if (window.confirm("¿Está seguro de actualizar los precios?")) {
                        let email = prompt("Ingrese su email para enviar una copia:");

                        if (email != null && email.trim().length > 1) {

                            let formData = new FormData();
                            formData.append('fecha_entrega', fecha_entrega);
                            formData.append('condicion_entrega', condicion_entrega);
                            formData.append('condiciones_pago', condiciones_pago);
                            formData.append('precio_dolar', precio_dolar);
                            formData.append('total', total);
                            formData.append('productos', JSON.stringify(productos));
                            formData.append('email', email);
                            formData.append('file', $('#file_cotizacion')[0].files[0]);

                            $.ajax({
                                url: "{{ route('precios_edit') }}",
                                type: "POST",
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: { formData },
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
                        } else {
                            alert("Debe ingresar un email válido");
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
