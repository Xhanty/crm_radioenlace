<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProspectosEmpresasImport implements ToCollection, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        foreach ($rows as $row) {
            DB::table('prospectos_empresas')->insert([
                'tipo_cliente' => 0,
                'pais_id' => $row[0],
                'empresa' => $row[1],
                'nombres' => $row[2],
                'apellidos' => $row[3],
                'email' => $row[4],
                'cargo' => $row[5],
                'celular' => $row[6],
                'tel_fijo' => $row[7],
                'fecha_nacimiento' => $row[8],
                'direccion' => $row[9],
                'facebook' => $row[10],
                'whatsapp' => $row[11],
                'instagram' => $row[12],
                'referido' => $row[13],
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        DB::commit();
    }

    public function startRow(): int
    {
        return 2;
    }
}
