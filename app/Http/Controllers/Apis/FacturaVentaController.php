<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Mail\SendFacturasMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FacturaVentaController extends Controller
{
    public function validate_fv()
    {
        $emails = ['smithhenao2020@gmail.com', 'santiagosmithdelgadohenao@gmail.com'];

        $facturas = DB::table('factura_venta')
            ->select('numero', 'fecha_elaboracion', 'valor_total')
            ->where('status', 1)
            //->whereYear('fecha_elaboracion', '=', date('Y'))
            ->orderBy('id', 'asc')
            ->get();
        
        // Validar la fecha de elaboración
        $facturas_send = [];

        foreach ($facturas as $factura) {
            $fecha_elaboracion = strtotime($factura->fecha_elaboracion);
            $fecha_actual = strtotime(date('Y-m-d'));
            $diferencia = $fecha_actual - $fecha_elaboracion;
            $dias = round($diferencia / (60 * 60 * 24));

            if ($dias >= 20) {
                $factura->dias = $dias;
                $facturas_send[] = $factura;
            }
        }

        // Enviar correo
        if (count($facturas_send) > 0) {
            foreach ($emails as $email) {
                Mail::to($email)->send(new SendFacturasMail($facturas_send));
            }
        }
    }
}
