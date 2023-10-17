<?php

namespace App\Exports;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturaVentaSheet implements FromCollection, WithHeadings, WithTitle, WithColumnFormatting
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Transformar los datos para mostrar las columnas
        $transformedData = $this->transformData();

        // Agregar una fila de totales
        $totals = $this->calculateTotals($transformedData);
        $transformedData[] = $totals;

        return collect($transformedData);
    }

    public function headings(): array
    {
        // Definir los títulos de las columnas
        return [
            'Factura',
            'Identificación',
            'Razón Social',
            'Total Bruto',
            'Descuentos',
            'Subtotal',
            "Iva (%)",
            "Iva",
            "Rte Fte (%)",
            "Rte Fte",
            "Rte Iva (%)",
            "Rte Iva",
            "Rte Ica (%)",
            "Rte Ica",
            'Valor',
            'Estado',
            'Fecha Elaboración'
        ];
    }

    protected function transformData()
    {
        // Crear una colección transformada
        return collect($this->data)->map(function ($item) {
            $status = $item->status;

            if ($status == 2) {
                $status = "Pagada";
            } else if ($status == 0) {
                $status = "Anulada";
            } else {
                $status = "Pendiente";
            }

            $impuestos_1 = json_decode($item->impuestos_1);

            $subtotal = str_replace(',', '.', str_replace('.', '', $item->subtotal));
            $subtotal = (float) $subtotal;

            $html_iva = "";
            $html_rte_fte = "";
            $html_rte_iva = "";
            $html_rte_ica = "";
            $valor_iva = "";

            if ($impuestos_1 && count($impuestos_1) > 0) {
                for ($i = 0; $i < count($impuestos_1); $i++) {
                    $valor_iva = $impuestos_1[$i][0];
                    $html_iva = number_format($impuestos_1[$i][1], 2, ',', '.');
                }
            }

            if ($item->valor_retefuente) {
                $html_rte_fte .= number_format($item->valor_retefuente * $subtotal / 100, 2, ',', '.');
            }

            if ($item->valor_reteiva) {
                $html_rte_iva .= number_format($item->valor_reteiva * $subtotal / 100, 2, ',', '.');
            }

            if ($item->valor_reteica) {
                $html_rte_ica .= number_format($item->valor_reteica * $subtotal / 1000, 2, ',', '.');
            }

            return [
                "FE-" . $item->numero,
                $item->nit . "-" . $item->codigo_verificacion,
                $item->razon_social,
                $item->total_bruto,
                $item->descuentos,
                $item->subtotal,
                $valor_iva,
                $html_iva,
                $item->valor_retefuente ? $item->valor_retefuente . "%" : "",
                $html_rte_fte,
                $item->valor_reteiva ? $item->valor_reteiva . "%" : "",
                $html_rte_iva,
                $item->valor_reteica ? $item->valor_reteica . "%" : "",
                $html_rte_ica,
                $item->valor_total,
                $status,
                Carbon::parse($item->fecha_elaboracion)->format('d-m-Y'), // Formato de fecha
            ];
        });
    }

    public function columnFormats(): array
    {
        return [
            /*'D' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'E' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'F' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'H' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'J' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'L' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'N' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'O' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,*/
            'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    protected function calculateTotals($data)
    {
        $totals = [
            'Total',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
        ];

        $columnsToSum = [5, 7, 9, 11, 13, 14]; // Índices de las columnas a sumar

        foreach ($columnsToSum as $columnIndex) {
            $total = collect($data)->sum(function ($item) use ($columnIndex) {
                $valor = str_replace(',', '.', str_replace('.', '', $item[$columnIndex]));
                $valor = (float) $valor;
                return $valor;
            });

            $totals[$columnIndex] = number_format($total, 2, ',', '.');
        }

        

        return $totals;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Facturas';
    }
}
