<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ComprobantesContables implements ToCollection, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            DB::table('comprobantes_carga')->insert([
                'tipo' => $row[0],
                'consecutivo_comprobante' => $row[1],
                'fecha_elaboracion' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
                'cuenta_contable' => $row[3],
                'identificacion_tercero' => $row[4],
                'prefijo' => $row[8],
                'consecutivo' => $row[9],
                'fecha_vencimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]),
                'codigo_impuesto' => $row[12],
                'descripcion' => $row[14],
                'centro_costo' => $row[15],
                'debito' => $row[16],
                'credito' => $row[17],
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
