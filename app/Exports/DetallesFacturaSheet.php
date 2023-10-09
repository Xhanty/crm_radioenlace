<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetallesFacturaSheet implements FromArray, WithHeadings, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $detalleData = [];

        foreach ($this->data as $item) {
            foreach ($item->detalle as $detalle) {
                $detalleData[] = [
                    "Factura" => "FE-" . $item->numero,
                    "Identificación" => $item->nit . "-" . $item->codigo_verificacion,
                    "Razón Social" => $item->razon_social,
                    "Producto/Servicio" => $detalle->producto->nombre . " (" . $detalle->producto->marca . " - " . $detalle->producto->modelo . ")",
                    "Cantidad" => $detalle->cantidad,
                    "Iva" => $detalle->impuesto_cargo . "%" ?? 0 . "%",
                    "Valor Total" => $detalle->valor_total,
                ];
            }
        }

        return $detalleData;
    }

    public function headings(): array
    {
        // Definir los títulos de las columnas para la segunda hoja (Detalles de Factura)
        return [
            "Factura",
            'Identificación',
            'Razón Social',
            "Producto/Servicio",
            "Cantidad",
            "Iva",
            "Valor Total",
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Detalles';
    }
}