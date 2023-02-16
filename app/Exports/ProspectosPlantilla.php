<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectosPlantilla implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('prospectos')
            ->select('prospectos.pais_id', 'prospectos.empresa', 'prospectos.nombres', 'prospectos.apellidos', 'prospectos.email', 'prospectos.cargo', 'prospectos.celular', 'prospectos.tel_fijo', 'prospectos.fecha_nacimiento', 'prospectos.direccion', 'prospectos.facebook', 'prospectos.whatsapp', 'prospectos.instagram', 'prospectos.referido')
            ->where('prospectos.id', 0)
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
