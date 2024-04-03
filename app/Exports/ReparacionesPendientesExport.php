<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ReparacionesPendientesExport implements FromCollection, WithHeadings
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
            'Código',
            'Fecha Entrega',
            'Cliente',
            'Técnico',
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            return [
                $item->codigo,
                Carbon::parse($item->fecha_entrega)->format('d-m-Y'), // Formato de fecha
                "{$item->cliente} (NIT: {$item->nit})",
                $item->tecnico,
            ];
        });
    }
}
