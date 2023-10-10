<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class RemisionesExport implements FromCollection, WithHeadings
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
            'Identificación',
            'Cliente',
            'Asunto',
            'Usuario',
            'Fecha',
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            return [
                $item->code,
                $item->nit,
                $item->razon_social,
                $item->asunto,
                $item->creador,
                Carbon::parse($item->created_at)->format('d-m-Y H:i A'), // Formato de fecha
            ];
        });
    }
}
