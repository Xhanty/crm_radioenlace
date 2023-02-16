<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectosEmpresaPlantilla implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('prospectos_empresas')
        ->select('prospectos_empresas.pais_id', 'prospectos_empresas.empresa', 'prospectos_empresas.nombres', 'prospectos_empresas.apellidos', 'prospectos_empresas.email', 'prospectos_empresas.cargo', 'prospectos_empresas.celular', 'prospectos_empresas.tel_fijo', 'prospectos_empresas.fecha_nacimiento', 'prospectos_empresas.direccion', 'prospectos_empresas.facebook', 'prospectos_empresas.whatsapp', 'prospectos_empresas.instagram', 'prospectos_empresas.referido')
        ->where('prospectos_empresas.id', 0)
        ->get();
    }

    public function headings(): array
    {
        return [
            'pais_id',
            'empresa',
            'nombres',
            'apellidos',
            'email',
            'cargo',
            'celular',
            'tel_fijo',
            'fecha_nacimiento',
            'direccion',
            'facebook',
            'whatsapp',
            'instagram',
            'referido'
        ];
    }
}
