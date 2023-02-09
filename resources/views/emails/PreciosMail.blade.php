<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización Precios</title>
</head>

<body style="background-color:#f9f9f9">
    <!-- © 2018 Shift Technologies. All rights reserved. -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;" id="bodyTable">
        <tbody>
            <tr>
                <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody"
                        style="max-width:600px">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                        class="tableCard"
                                        style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                        <tbody>
                                            <tr>
                                                <td style="background-color:#B52923;font-size:1px;line-height:3px"
                                                    class="topBorder" height="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 20px;" align="center" valign="top"
                                                    class="imgHero">
                                                    <br><br>
                                                    <a href="#" style="text-decoration:none" target="_blank">
                                                        <img alt="" border="0"
                                                            src="https://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
                                                            style="width:40%;max-width:600px;height:auto;display:block;color: #f9f9f9;">
                                                    </a>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;"
                                                    align="center" valign="top" class="mainTitle">
                                                    <h2 class="text"
                                                        style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">
                                                        {{ $proveedor }}</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;"
                                                    align="center" valign="top" class="subTitle">
                                                    <h4 class="text"
                                                        style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0">
                                                        Nueva Solicitud</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left:20px;padding-right:20px" align="center"
                                                    valign="top" class="containtTable ui-sortable">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                        class="tableDescription" style="">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding-bottom: 20px;" align="center"
                                                                    valign="top" class="description">
                                                                    <p class="text"
                                                                        style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                        Cordial saludo, requerimos por
                                                                        favoractualización de <br>
                                                                        los siguientes productos, dar click en <br>
                                                                        "REVISAR PRECIOS" <br><br>
                                                                        Fecha Límite: {{ date('d-m-Y', strtotime($fecha)) }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                        class="tableButton" style="">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding-top:20px;padding-bottom:20px"
                                                                    align="center" valign="top">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="background-color: #B52923; padding: 12px 35px; border-radius: 50px;"
                                                                                    align="center" class="ctaButton">
                                                                                    <a
                                                                                        href="{{ url('/precios_update') . '?token=' . $code . '&id=' . $id }}"
                                                                                        style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block"
                                                                                        target="_blank"
                                                                                        class="text">
                                                                                        Revisar Precios
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
