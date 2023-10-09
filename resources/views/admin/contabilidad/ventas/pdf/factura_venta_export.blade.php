@foreach ($facturas as $key => $factura)
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('pdf/style.css') }}">
        <title>Factura Venta No. {{ $factura->numero }}</title>
    </head>
    <style>
        .descrip-personalizado {
            font-size: 12px;
            text-transform: lowercase; /* Convierte todo el texto en minúsculas */
        }
    
        .descrip-personalizado::first-letter {
            text-transform: uppercase; /* Convierte la primera letra en mayúscula */
        }
    </style>
    <body>
        <div class="tm_container">
            <div class="tm_invoice_wrap">
                <div class="tm_invoice tm_style2 tm_type1 tm_accent_border tm_radius_0 tm_small_border"
                    id="tm_download_section">
                    <div class="tm_invoice_in">
                        <div class="tm_invoice_head tm_mb20 tm_m0_md">
                            <div class="tm_invoice_left">
                                <div class="tm_logo"><img src="{{ asset('pdf/logoradioenlace.png') }}" alt="Logo">
                                </div>
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
                                        <img src="{{ asset('icontec.png') }}" width="136px">
                                    </div>
                                </div>
                            </div>
                            <div class="tm_shape_bg tm_accent_bg_10 tm_border tm_accent_border_20"></div>
                            @if ($factura->status == 0)
                                <img src="{{ asset('contabilidad/anulada.png') }}" alt=""
                                    style="position: absolute; left: -52px; top: -3px; height: 135px;">
                            @elseif ($factura->status == 2)
                                <img src="{{ asset('contabilidad/pagado.png') }}" alt=""
                                    style="position: absolute; left: -52px; top: -3px; height: 135px;">
                            @else
                                <img src="{{ asset('contabilidad/pendiente.png') }}" alt=""
                                    style="position: absolute; left: -52px; top: -3px; height: 135px;">
                            @endif
                        </div>
                        <div class="tm_invoice_info tm_mb22 tm_align_center" style="margin-top: -14px">
                            <div class="tm_invoice_info_left tm_mb20_md" style="margin-top: 2px; width: 24%">
                                <!--<p class="tm_mb0">
                                <b class="tm_primary_color ">Factura Venta Electrónica: </b>{{ $factura->numero }}<br>
                                <b class="tm_primary_color">Fecha Venta:
                                </b>{{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}
                            </p>-->
                            </div>
                            <div class="tm_invoice_info_right" style="width: 76%">
                                <div
                                    class="tm_border tm_accent_border_20 tm_radius_0 tm_accent_bg_10 tm_curve_35 tm_text_center">
                                    <div>
                                        <b class="tm_accent_color tm_medium tm_body_lineheight"
                                            style="font-size: 20px">FACTURA DE VENTA
                                            ELECTRÓNICA # FE-{{ $factura->numero }}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="tm_f16 tm_section_heading tm_accent_border_20 tm_mb0" style="margin-top: -45px"><span
                                class="tm_accent_bg_10 tm_radius_0 tm_curve_35 tm_border tm_accent_border_20 tm_border_bottom_0 tm_accent_color">
                                <span>Facturado a</span>
                            </span></h2>
                        <div class="tm_table tm_style1 tm_mb20">
                            <div class="tm_border  tm_accent_border_20 tm_border_top_0">
                                <div class="tm_table_responsive">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="tm_width_6 tm_border_top_0" style="width: 55%">
                                                    <b class="tm_primary_color tm_medium">Cliente:
                                                    </b>{{ $factura->razon_social }}
                                                </td>
                                                <td class="tm_width_4 tm_border_top_0 tm_border_left tm_accent_border_20"
                                                    style="width: 22.5%">
                                                    <b class="tm_primary_color tm_medium">Nit:
                                                    </b>{{ $factura->nit }}-{{ $factura->codigo_verificacion }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="tm_width_6 tm_accent_border_20" style="width: 55%">
                                                    <b class="tm_primary_color tm_medium">Dirección:
                                                    </b>{{ $factura->direccion }}
                                                </td>
                                                <td class="tm_width_4 tm_border_left tm_accent_border_20"
                                                    style="width: 22.5%">
                                                    <b class="tm_primary_color tm_medium">Ciudad:
                                                    </b>{{ $factura->ciudad }} - Colombia
                                                </td>
                                                <td class="tm_width_6 tm_border_left tm_accent_border_20">
                                                    <b class="tm_primary_color tm_medium">Teléfono:
                                                    </b>{{ $factura->telefono_fijo }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <h2 class="tm_f16 tm_section_heading tm_accent_border_20 tm_mb0" style="margin-top: -12px"><span
                                class="tm_accent_bg_10 tm_radius_0 tm_curve_35 tm_border tm_accent_border_20 tm_border_bottom_0 tm_accent_color">
                                <span>Fecha facturación</span>
                            </span></h2>
                        <div class="tm_table tm_style1 tm_mb20">
                            <div class="tm_border  tm_accent_border_20 tm_border_top_0">
                                <div class="tm_table_responsive">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="tm_width_3 tm_border_left tm_accent_border_20">
                                                    <b class="tm_primary_color tm_medium">Generación:
                                                    </b>{{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}
                                                </td>
                                                <td class="tm_width_3 tm_border_left tm_accent_border_20">
                                                    <b class="tm_primary_color tm_medium">Expedición:
                                                    </b>{{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}
                                                </td>
                                                <td class="tm_width_3 tm_border_left tm_accent_border_20">
                                                    <b class="tm_primary_color tm_medium">Vencimiento:
                                                    </b>{{ date('d/m/Y', strtotime($factura->fecha_elaboracion . ' +30 days')) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tm_table tm_style1" style="margin-top: -12px">
                            <div class="tm_border tm_accent_border_20">
                                <div class="tm_table_responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th
                                                    class="tm_width_1 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                    #
                                                </th>
                                                <th
                                                    class="tm_width_6 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                    Item
                                                </th>
                                                <th
                                                    class="tm_width_1 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                    Cant.
                                                </th>
                                                <th
                                                    class="tm_width_1 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                    Vr.
                                                    Bruto</th>
                                                <th style="display: none"
                                                    class="tm_width_1 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                    Impto.
                                                    Cargo</th>
                                                <th style="display: none"
                                                    class="tm_width_1 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_center">
                                                    Impto.
                                                    Rete.</th>
                                                <th
                                                    class="tm_width_1 tm_semi_bold tm_accent_color tm_accent_bg_10 tm_text_right">
                                                    Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($factura->productos as $key => $item)
                                                <tr>
                                                    <td class="tm_width_1 tm_accent_border_20 tm_text_center">
                                                        {{ $count }}
                                                    </td>
                                                    <td class="tm_width_6 tm_accent_border_20 tm_text_center"
                                                        style="text-align: justify">
                                                        <b>{{ $item->detalle->nombre }} (@if ($item->detalle->marca)
                                                                {{ $item->detalle->marca }} -
                                                            @endif
                                                            {{ $item->detalle->modelo }})</b>
                                                        <br><p class="descrip-personalizado">{{ $item->detalle->description }}</p>
                                                    </td>
                                                    <td class="tm_width_1 tm_accent_border_20 tm_text_center">
                                                        {{ $item->cantidad }}</td>
                                                    <td class="tm_width_1 tm_accent_border_20 tm_text_center">
                                                        {{ $item->valor_unitario }}</td>
                                                    <td style="display: none"
                                                        class="tm_width_1 tm_accent_border_20 tm_text_center">
                                                        {{ $item->impuesto_cargo }}%</td>
                                                    <td style="display: none"
                                                        class="tm_width_1 tm_accent_border_20 tm_text_center">
                                                        {{ $item->impuesto_retencion }}%</td>
                                                    <td class="tm_width_1 tm_accent_border_20 tm_text_right">
                                                        {{ $item->valor_total }}</td>
                                                </tr>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
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
                                    <p class="tm_mb2"><b class="tm_primary_color">Condiciones de Pago:</b></p>
                                    <p class="tm_m0">Otras cuentas por pagar - Cuota No. 001 vence el
                                        {{ date('d/m/Y', strtotime($factura->fecha_elaboracion . ' +30 days')) }}</p>
                                    <div class="tm_text_left">
                                        <!--<img src="{{ asset('RadioEnlaceQr.png') }}" width="120px">
                                    <br>
                                    <b style="font-size: 13px">CUFE:</b><span
                                        style="font-size: 12px">dbfecbbd3491e5214fb4f52f75f3ac56fa1e96643b64e85600a4d939558953d9c27b39d646a5e8e020e38ac95a22549b</span>-->
                                    </div>
                                </div>
                                <div class="tm_right_footer">
                                    <table class="tm_mb15 tm_m0_md">
                                        <tbody>
                                            <tr>
                                                <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Total
                                                    Bruto
                                                </td>
                                                <td
                                                    class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                    {{ $factura->total_bruto }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Descuento
                                                </td>
                                                <td
                                                    class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                    {{ $factura->descuentos }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Subtotal
                                                </td>
                                                <td
                                                    class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                    {{ $factura->subtotal }}</td>
                                            </tr>
                                            @php
                                                $impuestos_1 = $factura->impuestos_1 == 'null' ? [] : $factura->impuestos_1;
                                                $impuestos_2 = $factura->impuestos_2 == 'null' ? [] : $factura->impuestos_2;
                                                
                                                $subtotal = $factura->subtotal;
                                                // Eliminar los dos ceros del final
                                                $subtotal = rtrim($subtotal, '0');
                                                
                                                // Reemplazar comas y puntos
                                                $subtotal = str_replace(',', '', $subtotal);
                                                $subtotal = str_replace('.', '', $subtotal);
                                                
                                                // Convertir a entero
                                                $subtotal_num = (int) $subtotal;
                                                $sum_impuestos_1 = 0;
                                                
                                                if ($impuestos_1) {
                                                    if (json_decode($impuestos_1)) {
                                                        $impuestos = json_decode($impuestos_1);
                                                        foreach ($impuestos as $impuesto) {
                                                            $sum_impuestos_1 += intval($impuesto[1]);
                                                            $valor_impuesto = number_format(intval($impuesto[1]), 2, ',', '.');
                                                            echo '<tr>
                                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">' .
                                                                $impuesto[0] .
                                                                '</td>
                                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">' .
                                                                $valor_impuesto .
                                                                '</td>
                                                        </tr>';
                                                        }
                                                    }
                                                }
                                                
                                                if ($impuestos_2) {
                                                    if (json_decode($impuestos_2)) {
                                                        $impuestos = json_decode($impuestos_2);
                                                        foreach ($impuestos as $impuesto) {
                                                            $valor_impuesto = number_format(intval($impuesto[1]), 2, ',', '.');
                                                            echo '<tr>
                                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">' .
                                                                $impuesto[0] .
                                                                '</td>
                                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">' .
                                                                $valor_impuesto .
                                                                '</td>
                                                        </tr>';
                                                        }
                                                    }
                                                }
                                            @endphp

                                            @if ($factura->valor_retefuente)
                                                @php
                                                    $valor_rtefte = $subtotal_num * ($factura->valor_retefuente / 100);
                                                @endphp
                                                <tr>
                                                    <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Rte
                                                        Fte
                                                    </td>
                                                    <td
                                                        class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                        {{ number_format(intval($valor_rtefte), 2, ',', '.') }}</td>
                                                </tr>
                                            @endif
                                            @if ($factura->valor_reteiva)
                                                @php
                                                    $valor_rteiva = $sum_impuestos_1 * ($factura->valor_reteiva / 100);
                                                @endphp
                                                <tr>
                                                    <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Rte
                                                        Iva
                                                    </td>
                                                    <td
                                                        class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                        {{ number_format(intval($valor_rteiva), 2, ',', '.') }}</td>
                                                </tr>
                                            @endif
                                            @if ($factura->valor_reteica)
                                                @php
                                                    $valor_rteica = ($subtotal_num * $factura->valor_reteica) / 1000;
                                                @endphp
                                                <tr>
                                                    <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Rte
                                                        Ica
                                                    </td>
                                                    <td
                                                        class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                        {{ number_format(intval($valor_rteica), 2, ',', '.') }}</td>
                                                </tr>
                                            @endif
                                            <tr class="tm_accent_border_20 tm_border">
                                                <td
                                                    class="tm_width_3 tm_bold tm_f16 tm_border_top_0 tm_accent_color tm_accent_bg_10">
                                                    Total a Pagar</td>
                                                <td
                                                    class="tm_width_3 tm_bold tm_f16 tm_border_top_0 tm_accent_color tm_text_right tm_accent_bg_10 tm_invoice_total">
                                                    {{ $factura->valor_total }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if ($factura->observaciones != null)
                                <p class="tm_mb2" style="margin-top: -44px"><b
                                        class="tm_primary_color">Observaciones:</b></p>
                                <p class="tm_m0" style="font-size: 13px">{{ $factura->observaciones }}</p>
                            @endif

                            @if ($factura->adjunto_pdf != null)
                                <br>
                                <p class="tm_mb2"><b class="tm_primary_color">Adjunto:</b></p>
                                <a href="{{ asset('images/contabilidad/facturas_compra/' . $factura->adjunto_pdf) }}"
                                    style="color: rgb(217, 38, 28, 0.9);" target="_blank">Ver Adjunto</a>
                            @endif
                        </div>
                        <div class="tm_bottom_invoice tm_accent_border_20" style="margin-top: 16px">
                            <div class="tm_bottom_invoice_left">
                                <p class="tm_m0 tm_f11 tm_text_center" style="text-align: justify">
                                    Esta factura de Venta constituye título valor según el artículo 5 de la ley 1231 del
                                    17
                                    de Julio de 2008 - El no pago de esta generará intereses por mora, mensual a la tasa
                                    máxima legal autorizada. En caso de NO PAGO se procederá a reportarse en las
                                    centrales
                                    de crédito.
                                    Resolución DIAN 18764046586505 prefijo FE numeración Autorizada del 3823 al 4000
                                    Fecha
                                    23/09/21 Vigencia: 12 Meses.
                                    Responsable de IVA - Actividad Económica 4741 Comercio al por menor de computadores,
                                    equipos periféricos, programas de informática y equipos de telecomunicaciones en
                                    establecimientos especializados Tarifa 4. Autorretenedores de ICA en el municipio de
                                    Medellín según Resolución 202050056223 de 2020
                                    Favor abstenerse de practicar Retención por concepto de ICA.
                                    VR05 VERSIÓN: 01 06/01/2020
                                    FAVOR CONSIGNAR EN LA CUENTA DE AHORROS BANCOLOMBIA 10825335162 A
                                    NOMBRE DE RADIO ENLACE S.A.S.
                                    Enviar comprobante de pago al correo facturacionelectronica@radioenlacesas.com
                                    <br>
                                    <br>
                                </p>
                                <p class="tm_m0 tm_f11 tm_text_center"><b>Elaborado por CRM RADIO ENLACE S.A.S. NIT.
                                        830.504.313-5</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Validar si es la ultima factura -->
                @if ($factura->numero == $ultima_factura)
                    <!--<div class="tm_invoice_btns tm_hide_print">
                        <a href="javascript:void(0);" class="tm_invoice_btn tm_color1">
                            <span class="tm_btn_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                    <path
                                        d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <rect x="128" y="240" width="256" height="208"
                                        rx="24.32" ry="24.32" fill="none" stroke="currentColor"
                                        stroke-linejoin="round" stroke-width="32" />
                                    <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24"
                                        fill="none" stroke="currentColor" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <circle cx="392" cy="184" r="24" fill='currentColor' />
                                </svg>
                            </span>
                            <span class="tm_btn_text">Imprimir</span>
                        </a>
                    </div>-->
                @endif
            </div>
        </div>
        <script src="https://invoma.vercel.app/assets/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
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
@endforeach
