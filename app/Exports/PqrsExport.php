<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PqrsExport implements FromCollection, WithHeadings
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
            'Mes',
            'Medio Comunicación',
            'Cliente',
            'Queja',
            'Tratamiento',
            'Evidencia',
            'Seguimiento',
            'Correción',
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            return [
                $item->codigo,
                $item->mes,
                $item->medio_comunicacion,
                $item->cliente,
                $item->queja,
                $item->tratamiento,
                $item->evidencia,
                $item->seguimiento,
                $item->correcion,
            ];
        });
    }
}
