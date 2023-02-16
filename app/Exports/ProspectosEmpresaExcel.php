<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectosEmpresaExcel implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('prospectos_empresas')
            ->select('paises.name as pais', 'paises.phonecode', 'prospectos_empresas.empresa', 'prospectos_empresas.nombres', 'prospectos_empresas.apellidos', 'prospectos_empresas.email', 'prospectos_empresas.celular', 'prospectos_empresas.created_at as fecha_registro')
            ->join('paises', 'prospectos_empresas.pais_id', '=', 'paises.id')
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
