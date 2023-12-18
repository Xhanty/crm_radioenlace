<?php

namespace App\Exports\Contabilidad;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultadoIntegral implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('comprobantes_carga')
            ->select(
                'cuenta_contable',
                DB::raw('SUM(debito) as total_debito'),
                DB::raw('SUM(credito) as total_credito')
            )
            ->groupBy('cuenta_contable')
            ->orderBy('cuenta_contable', 'asc')
            ->get();

        // Recorrer la colección para agregar el nombre de la cuenta contable
        foreach ($data as $key => $value) {
            $cuenta_contable = DB::table('configuracion_puc')
                ->select('nombre')
                ->where('code', $value->cuenta_contable)
                ->first();

            $data[$key]->cuenta_contable = $value->cuenta_contable . ' - ' . $cuenta_contable->nombre;
        }

        // Agrupar la colección por el primer dígito de la cuenta_contable
        $groupedData = $data->groupBy(function ($item) {
            return substr($item->cuenta_contable, 0, 1);
        });

        // Ordenar los grupos por clave (primer dígito)
        $sortedData = $groupedData->sortKeys();

        // Fusionar los grupos en una única colección
        $result = collect();
        foreach ($sortedData as $group) {
            $result = $result->concat($group);
        }

        // Calcular totales
        $totalDebito = $data->sum('total_debito');
        $totalCredito = $data->sum('total_credito');

        // Agregar fila con totales
        $totalRow = (object) [
            'cuenta_contable' => '',
            'total_debito' => number_format($totalDebito, 2, ',', '.'),
            'total_credito' => number_format($totalCredito, 2, ',', '.'),
        ];

        $result->push($totalRow);

        return $result;
    }

    public function headings(): array
    {
        return [
            'Cuenta contable',
            'Débito',
            'Crédito',
        ];
    }
}
