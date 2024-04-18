<?php

namespace App\Exports\Contabilidad;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class IngresoConciliacionBancaria implements FromCollection, WithHeadings
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
            'Cliente',
            'Descripción',
            'Ingreso',
            //'Saldo',
            'Facturas',
            'Fecha',
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            return [
                $item->nombre_cliente . ' (' . $item->nit_cliente . ')',
                $item->descripcion,
                $item->credito,
                //$item->saldo,
                $item->nota,
                Carbon::parse($item->fecha)->format('d-m-Y'), // Formato de fecha
            ];
        });
    }
}
