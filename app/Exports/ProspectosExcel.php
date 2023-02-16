<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectosExcel implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('prospectos')
            ->select('paises.name as pais', 'paises.phonecode', 'prospectos.empresa', 'prospectos.nombres', 'prospectos.apellidos', 'prospectos.email', 'prospectos.celular', 'prospectos.created_at as fecha_registro')
            ->join('paises', 'prospectos.pais_id', '=', 'paises.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Pais',
            'Codigo de Pais',
            'Empresa',
            'Nombres',
            'Apellidos',
            'Email',
            'Celular',
            'Fecha de Registro',
        ];
    }
}
