<style>
    html,
    body {
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
</style>

<div style="font-size: 13pt;">
    Cordial saludo. <br>
    En la presente me permito enviarles la cotización, cualquier inquietud estamos atentos a sus comentarios. <br>
    Feliz día.
</div>

<br>
<br>
<br>

<table cellpadding="0" style="border-collapse: collapse; font-size: 14.4px;">
    <tr>
        <td style="margin: 0.1px; padding: 0px;">
            <table cellpadding="0" style="border-collapse: collapse; font-size: 16px;">
                <tr>
                    <td valign="top">
                        <img src="http://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png"
                            width="120" style="display: block; margin-right: 20px">
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
                                            <td style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);">
                                            </td>
                                        </tr>
                                        <tr style="cursor: pointer;">
                                            <td
                                                style="margin: 0.1px; padding: 0px 5px 0px 0px; color: rgb(124, 124, 124);;">
                                                Dirección: Medellín, Colombia
                                            </td>
                                            <td style="margin: 0.1px; padding: 0px; color: rgb(124, 124, 124);">
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
