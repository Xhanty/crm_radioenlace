<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsignacionesExport implements FromCollection, WithHeadings
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
            'Empleado',
            'Cliente',
            'Asignación',
            'Fecha Inicio',
            'Fecha Fin',
            'Creada Por',
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            return [
                $item->codigo,
                $item->nombre,
                $item->cliente,
                $item->asignacion,
                Carbon::parse($item->fecha)->format('d-m-Y g:i A'), // Formato de fecha
                Carbon::parse($item->fecha_culminacion)->format('d-m-Y g:i A'), // Formato de fecha
                $item->creador,
            ];
        });
    }

}
