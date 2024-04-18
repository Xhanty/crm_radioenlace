<?php

namespace App\Exports\Contabilidad;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class SalidaConciliacionBancaria implements FromCollection, WithHeadings
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
            'Salida',
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
                $item->debito,
                //$item->saldo,
                $item->nota,
                Carbon::parse($item->fecha)->format('d-m-Y'), // Formato de fecha
            ];
        });
    }
}
