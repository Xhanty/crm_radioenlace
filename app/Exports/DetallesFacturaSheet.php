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
                    "Producto/Servicio" => $detalle->producto->nombre . " (" . $detalle->producto->marca . " - " . $detalle->producto->modelo . ")",
                    "Cantidad" => $detalle->cantidad,
                    "Valor" => $detalle->valor_total,
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
            "Producto/Servicio",
            "Cantidad",
            "Valor",
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