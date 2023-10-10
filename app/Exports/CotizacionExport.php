<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class CotizacionExport implements FromCollection, WithHeadings
{
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
            '#',
            'Identificación',
            'Cliente',
            'Descripción',
            '¿Aprobado?',
            'Usuario',
            'Fecha',
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            $aprobado = "Pendiente";

            if ($item->aprobado == 1) {
                $aprobado = "Aprobado";
            } else if ($item->aprobado == 2) {
                $aprobado = "Rechazado";
            }

            return [
                $item->code,
                $item->nit,
                $item->razon_social,
                $item->descripcion,
                $aprobado,
                $item->creador,
                Carbon::parse($item->created_at)->format('d-m-Y H:i A'), // Formato de fecha
            ];
        });
    }
}
