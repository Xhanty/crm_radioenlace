<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('pdf/style.css') }}">
    <title>Comprobante No. {{ $data->numero }}</title>
</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style2 tm_type1 tm_accent_border tm_radius_0 tm_small_border"
                id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_mb20 tm_m0_md">
                        <div class="tm_invoice_left">
                            <div class="tm_logo"><img src="{{ asset('pdf/logoradioenlace.png') }}" alt="Logo"></div>
                        </div>
                        <div class="tm_invoice_right">
                            <div class="tm_grid_row tm_col_3">
                                <div class="tm_text_center">
                                    <p class="tm_accent_color tm_mb0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 512 512" fill="currentColor"
                                            style="color: rgb(217, 38, 28, 0.9)">
                                            <path
                                                d="M391 480c-19.52 0-46.94-7.06-88-30-49.93-28-88.55-53.85-138.21-103.38C116.91 298.77 93.61 267.79 61 208.45c-36.84-67-30.56-102.12-23.54-117.13C45.82 73.38 58.16 62.65 74.11 52a176.3 176.3 0 0128.64-15.2c1-.43 1.93-.84 2.76-1.21 4.95-2.23 12.45-5.6 21.95-2 6.34 2.38 12 7.25 20.86 16 18.17 17.92 43 57.83 52.16 77.43 6.15 13.21 10.22 21.93 10.23 31.71 0 11.45-5.76 20.28-12.75 29.81-1.31 1.79-2.61 3.5-3.87 5.16-7.61 10-9.28 12.89-8.18 18.05 2.23 10.37 18.86 41.24 46.19 68.51s57.31 42.85 67.72 45.07c5.38 1.15 8.33-.59 18.65-8.47 1.48-1.13 3-2.3 4.59-3.47 10.66-7.93 19.08-13.54 30.26-13.54h.06c9.73 0 18.06 4.22 31.86 11.18 18 9.08 59.11 33.59 77.14 51.78 8.77 8.84 13.66 14.48 16.05 20.81 3.6 9.53.21 17-2 22-.37.83-.78 1.74-1.21 2.75a176.49 176.49 0 01-15.29 28.58c-10.63 15.9-21.4 28.21-39.38 36.58A67.42 67.42 0 01391 480z" />
                                        </svg>
                                    </p>
                                    RADIO ENLACE S.A.S.<br>
                                    NIT 830.504.313-5<br>
                                    (604) 4448280
                                </div>
                                <div class="tm_text_center">
                                    <p class="tm_accent_color tm_mb0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 232597 333333"
                                            width="24" height="24" shape-rendering="geometricPrecision"
                                            text-rendering="geometricPrecision" image-rendering="optimizeQuality"
                                            fill-rule="evenodd" clip-rule="evenodd">
                                            <path
                                                d="M151444 5419C140355 1916 128560 0 116311 0 80573 0 48591 16155 27269 41534l54942 46222 69232-82338z"
                                                fill="#1a73e8" />
                                            <path
                                                d="M27244 41534C10257 61747 0 87832 0 116286c0 21876 4360 39594 11517 55472l70669-84002-54942-46222z"
                                                fill="#ea4335" />
                                            <path
                                                d="M116311 71828c24573 0 44483 19910 44483 44483 0 10938-3957 20969-10509 28706 0 0 35133-41786 69232-82313-14089-27093-38510-47936-68048-57286L82186 87756c8166-9753 20415-15928 34125-15928z"
                                                fill="#4285f4" />
                                            <path
                                                d="M116311 160769c-24573 0-44483-19910-44483-44483 0-10863 3906-20818 10358-28555l-70669 84027c12072 26791 32159 48289 52851 75381l85891-102122c-8141 9628-20339 15752-33948 15752z"
                                                fill="#fbbc04" />
                                            <path
                                                d="M148571 275014c38787-60663 84026-88210 84026-158728 0-19331-4738-37552-13080-53581L64393 247140c6578 8620 13206 17793 19683 27900 23590 36444 17037 58294 32260 58294 15172 0 8644-21876 32235-58320z"
                                                fill="#34a853" />
                                        </svg>
                                    </p>
                                    Calle 27 No.81-70<br>
                                    Medellín - Colombia<br>
                                    www.radioenlacesas.com
                                </div>
                                <div class="tm_text_center">
                                    <img src="{{ asset('RadioEnlaceQr.png') }}" width="96px">
                                </div>
                            </div>
                        </div>
                        <div class="tm_shape_bg tm_accent_bg_10 tm_border tm_accent_border_20"></div>
                    </div>
                    <div class="tm_invoice_info tm_mb22 tm_align_center">
                        <div class="tm_invoice_info_left tm_mb20_md" style="margin-top: 2px">
                            <p class="tm_mb0">
                                <b class="tm_primary_color ">Comprobante No: </b>{{ $data->numero }}<br>
                                <b class="tm_primary_color">Fecha Compra:
                                </b>{{ date('d/m/Y', strtotime($data->fecha_elaboracion)) }}<br>
                                <b class="tm_primary_color">Forma Pago:
                                </b>{{ $data->forma_pago }}
                            </p>
                        </div>
                        <div class="tm_invoice_info_right">
                            <div
                                class="tm_border tm_accent_border_20 tm_radius_0 tm_accent_bg_10 tm_curve_35 tm_text_center">
                                <div>
                                    <b class="tm_accent_color tm_f26 tm_medium tm_body_lineheight">Total:
                                        {{ $data->valor }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="tm_f16 tm_section_heading tm_accent_border_20 tm_mb0"></h2>
                    <div class="tm_table tm_style1 tm_mb30">
                        <div class="tm_border  tm_accent_border_20 tm_border_top_0">
                            <div class="tm_table_responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="tm_width_6 tm_border_top_0">
                                                <b class="tm_primary_color tm_medium">Proveedor:
                                                </b>{{ $data->proveedor }}
                                            </td>
                                            <td class="tm_width_6 tm_border_top_0 tm_border_left tm_accent_border_20">
                                                <b class="tm_primary_color tm_medium">Nit:
                                                </b>{{ $data->nit }}-{{ $data->codigo_verificacion }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_6 tm_accent_border_20">
                                                <b class="tm_primary_color tm_medium">Teléfono:
                                                </b>{{ $data->telefono_fijo }}
                                            </td>
                                            <td class="tm_width_6 tm_border_left tm_accent_border_20">
                                                <b class="tm_primary_color tm_medium">Dirección:
                                                </b>{{ $data->direccion }}, {{ $data->ciudad }} - Colombia
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tm_table tm_style1">
                        <div class="tm_border tm_accent_border_20">
                            <div class="tm_table_responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th
                                                class="tm_width_6 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                Concepto
                                            </th>
                                            <th
                                                class="tm_width_4 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_right">
                                                Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tm_width_6 tm_accent_border_20 tm_text_left">
                                                <span>Abono</span>
                                                <span
                                                    style="margin-left:100px">{{ $data->factura_proveedor }}-{{ $data->num_factura_proveedor }}</span>
                                                <span style="margin-left:60px">Cuota {{ $cuota }}</span>
                                                <span
                                                    style="margin-left:22px">{{ date('d/m/Y', strtotime($data->fecha_elaboracion)) }}</span>
                                                <br>
                                                <br>
                                                {{ $data->forma_pago }}
                                            </td>
                                            <td class="tm_width_4 tm_accent_border_20 tm_text_right">
                                                <span id="valor_1">{{ $data->valor }}</span>
                                                <br>
                                                <b>-{{ $data->valor }}</b>
                                                <br>
                                                <b>Total COP:</b> <span id="valor_2">{{ $data->valor }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer tm_mb15 tm_m0_md">
                            <div class="tm_left_footer">
                                <br>
                                <p class="tm_mb2"><b class="tm_primary_color">Valor en Letras:</b></p>
                                <p class="tm_m0" id="valor_txt">Cargando...</p>
                                <br>
                                <!--<p class="tm_mb2"><b class="tm_primary_color">Forma de Pago:</b></p>
                                <p class="tm_m0">Otras cuentas por pagar - Cuota No. 001 vence el 20/05/2023</p>-->
                                @if ($data->observacion != null)
                                    <p class="tm_mb2"><b class="tm_primary_color">Observaciones:</b></p>
                                    <p class="tm_m0">{{ $data->observacion }}</p>
                                @endif

                                @if ($data->adjunto_pdf != null)
                                    <br>
                                    <p class="tm_mb2"><b class="tm_primary_color">Adjunto:</b></p>
                                    <a href="{{ asset('images/contabilidad/comprobantes_egreso/' . $data->adjunto_pdf) }}"
                                        style="color: rgb(217, 38, 28, 0.9);" target="_blank">Ver Adjunto</a>
                                @endif

                            </div>
                            <div class="tm_right_footer">
                                <table class="tm_mb15 tm_m0_md">
                                    <tbody>
                                        <tr class="tm_accent_border_20 tm_border">
                                            <td
                                                class="tm_width_3 tm_bold tm_f16 tm_border_top_0 tm_accent_color tm_accent_bg_10">
                                                Total Pagado</td>
                                            <td
                                                class="tm_width_3 tm_bold tm_f16 tm_border_top_0 tm_accent_color tm_text_right tm_accent_bg_10 tm_invoice_total">
                                                {{ $data->valor }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tm_bottom_invoice tm_accent_border_20" style="justify-content: center;">
                    <div class="tm_bottom_invoice_left">
                        <!--<p class="tm_m0 tm_f11 tm_text_center">
                            A esta factura de venta aplican las normas relativas
                            a la letra de
                            cambio (artículo 5 Ley 1231 de 2008). Con esta el Comprador declara haber recibido real
                            y materialmente las
                            mercancías o prestación de servicios descritos en este título - Valor. <b>Número
                                Autorización 18764027118177 aprobado en 20211013 prefijo FE desde el número 2186 al
                                4000
                                Vigencia: 12 Meses</b>
                            - Actividad Económica 4741 Comercio al por menor de computadores, equipos periféricos,
                            programas de informática y equipos de telecomunicaciones en establecimientos
                            especializados Tarifa 4.
                            <br>
                            <b>CUFE:</b>
                            dbfecbbd3491e5214fb4f52f75f3ac56fa1e96643b64e85600a4d939558953d9c27b39d646a5e8e020e38ac95a22549b
                            
                        </p>-->
                        <p class="tm_m0 tm_f11 tm_text_center"><b>Elaborado por CRM RADIO ENLACE S.A.S. NIT.
                                830.504.313-5</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tm_invoice_btns tm_hide_print">
            <a href="javascript:void(0);" class="tm_invoice_btn tm_color1">
                <span class="tm_btn_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path
                            d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <rect x="128" y="240" width="256" height="208" rx="24.32"
                            ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round"
                            stroke-width="32" />
                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                            stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <circle cx="392" cy="184" r="24" fill='currentColor' />
                    </svg>
                </span>
                <span class="tm_btn_text">Imprimir</span>
            </a>
        </div>
    </div>
    </div>
    <script src="https://invoma.vercel.app/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let total_final = 0;
            let valor_1 = @json($data->valor_factura);
            let valor_2 = @json($data->valor);
            let lleva = @json($lleva);

            valor_1 = valor_1.split(',');
            valor_1 = valor_1[0];
            valor_1 = valor_1.replaceAll('.', '');
            valor_1 = parseInt(valor_1);

            valor_2 = valor_2.split(',');
            valor_2 = valor_2[0];
            valor_2 = valor_2.replaceAll('.', '');
            valor_2 = parseInt(valor_2);


            total_final = valor_1 - valor_2;

            if (lleva) {
                lleva.forEach(element => {
                    let valor = element.valor;
                    valor = valor.split(',');
                    valor = valor[0];
                    valor = valor.replaceAll('.', '');
                    valor = parseInt(valor);

                    valor_1 = valor_1 - valor;
                    total_final = total_final - valor;
                });
            }

            $("#valor_1").html(valor_1.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }));

            $("#valor_2").html(total_final.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }));

            $('.tm_invoice_btn').on('click', function() {
                window.print();
            });

            function Unidades(num) {

                switch (num) {
                    case 1:
                        return "un";
                    case 2:
                        return "dos";
                    case 3:
                        return "tres";
                    case 4:
                        return "cuatro";
                    case 5:
                        return "cinco";
                    case 6:
                        return "seis";
                    case 7:
                        return "siete";
                    case 8:
                        return "ocho";
                    case 9:
                        return "nueve";
                }

                return "";
            }

            function Decenas(num) {

                decena = Math.floor(num / 10);
                unidad = num - (decena * 10);

                switch (decena) {
                    case 1:
                        switch (unidad) {
                            case 0:
                                return "diez";
                            case 1:
                                return "once";
                            case 2:
                                return "doce";
                            case 3:
                                return "trece";
                            case 4:
                                return "catorce";
                            case 5:
                                return "quince";
                            default:
                                return "dieci" + Unidades(unidad);
                        }
                        case 2:
                            switch (unidad) {
                                case 0:
                                    return "veinte";
                                default:
                                    return "veinti" + Unidades(unidad);
                            }
                            case 3:
                                return DecenasY("treinta", unidad);
                            case 4:
                                return DecenasY("cuarenta", unidad);
                            case 5:
                                return DecenasY("cincuenta", unidad);
                            case 6:
                                return DecenasY("sesenta", unidad);
                            case 7:
                                return DecenasY("setenta", unidad);
                            case 8:
                                return DecenasY("ochenta", unidad);
                            case 9:
                                return DecenasY("noventa", unidad);
                            case 0:
                                return Unidades(unidad);
                }
            } //Unidades()

            function DecenasY(strSin, numUnidades) {
                if (numUnidades > 0)
                    return strSin + " y " + Unidades(numUnidades)

                return strSin;
            } //DecenasY()

            function Centenas(num) {

                centenas = Math.floor(num / 100);
                decenas = num - (centenas * 100);

                switch (centenas) {
                    case 1:
                        if (decenas > 0)
                            return "ciento " + Decenas(decenas);
                        return "cien";
                    case 2:
                        return "doscientos " + Decenas(decenas);
                    case 3:
                        return "trescientos " + Decenas(decenas);
                    case 4:
                        return "cuatrocientos " + Decenas(decenas);
                    case 5:
                        return "quinientos " + Decenas(decenas);
                    case 6:
                        return "sesicientos " + Decenas(decenas);
                    case 7:
                        return "setecientos " + Decenas(decenas);
                    case 8:
                        return "ochocientos " + Decenas(decenas);
                    case 9:
                        return "novecientos " + Decenas(decenas);
                }

                return Decenas(decenas);
            } //Centenas()

            function Seccion(num, divisor, strSingular, strPlural) {
                cientos = Math.floor(num / divisor)
                resto = num - (cientos * divisor)

                letras = "";

                if (cientos > 0)
                    if (cientos > 1)
                        letras = Centenas(cientos) + " " + strPlural;
                    else
                        letras = strSingular;

                if (resto > 0)
                    letras += "";

                return letras;
            } //Seccion()

            function Miles(num) {
                divisor = 1000;
                cientos = Math.floor(num / divisor)
                resto = num - (cientos * divisor)

                strMiles = Seccion(num, divisor, "un mil", "mil");
                strCentenas = Centenas(resto);

                if (strMiles == "")
                    return strCentenas;

                return strMiles + " " + strCentenas;

                //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
            } //Miles()

            function Millones(num) {
                divisor = 1000000;
                cientos = Math.floor(num / divisor)
                resto = num - (cientos * divisor)

                strMillones = Seccion(num, divisor, "un millón", "millones");
                strMiles = Miles(resto);

                if (strMillones == "")
                    return strMiles;

                return strMillones + " " + strMiles;

                //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
            } //Millones()

            function NumeroALetras(num) {
                var data = {
                    numero: num,
                    enteros: Math.floor(num),
                    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
                    letrasCentavos: "",
                    letrasMonedaPlural: "pesos",
                    letrasMonedaSingular: "peso"
                };

                if (data.centavos > 0)
                    data.letrasCentavos = "con " + data.centavos + "/100";

                if (data.enteros == 0)
                    return "cero " + data.letrasMonedaPlural + " " + data.letrasCentavos;
                if (data.enteros == 1)
                    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
                else
                    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
            } //NumeroALetras()

            function capitalizeLetter(string) {
                return string.charAt(0).toUpperCase() + string.substring(1);
            }

            var valor = $('.tm_invoice_total').text();
            valor = valor.replaceAll('.', '');
            valor = valor.replaceAll(',', '.');
            let valor_total = parseInt(valor.split('.')[0]);
            var valorEnLetras = capitalizeLetter(NumeroALetras(valor_total));
            $("#valor_txt").html(valorEnLetras.trim() + " m/cte");
        });
    </script>
</body>

</html>
