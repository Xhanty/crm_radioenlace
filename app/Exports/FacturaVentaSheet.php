<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturaVentaSheet implements FromCollection, WithHeadings, WithTitle
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Transformar los datos para mostrar las columnas
        return $this->transformData();
    }

    public function headings(): array
    {
        // Definir los títulos de las columnas
        return [
            'Factura',
            'Identificación',
            'Razón Social',
            'Valor',
            'Estado',
            'Fecha Elaboración'
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            $status = $item->status;

            if ($status == 2) {
                $status = "Pagada";
            } else if ($status == 0) {
                $status = "Anulada";
            } else {
                $status = "Pendiente";
            }

            return [
                "FE-" . $item->numero,
                $item->nit . "-" . $item->codigo_verificacion,
                $item->razon_social,
                $item->valor_total,
                $status,
                Carbon::parse($item->fecha_elaboracion)->format('d-m-Y'), // Formato de fecha
            ];
        });
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Facturas';
    }
}
