<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturaVentaSheet implements FromCollection, WithHeadings, WithTitle
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
        return $this->transformData();
    }

    public function headings(): array
    {
        // Definir los títulos de las columnas
        return [
            'Factura',
            'Identificación',
            'Razón Social',
            "Iva",
            "Rte Fte",
            "Rte Iva",
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

            $subtotal = str_replace(',', '.', str_replace('.', '', $item->subtotal));
            $subtotal = (float) $subtotal;

            $html_iva = "";
            $html_rte_fte = "";
            $html_rte_iva = "";
            $html_rte_ica = "";

            if($item->valor_retefuente) {
                $html_rte_fte = "(" . $item->valor_retefuente . "%): ";
                $html_rte_fte .= $item->valor_retefuente * $subtotal / 100;
            }

            if($item->valor_reteiva) {
                $html_rte_iva = "(" . $item->valor_reteiva . "%): ";
                $html_rte_iva .= $item->valor_reteiva * $subtotal / 100;
            }

            if($item->valor_reteica) {
                $html_rte_ica = "(" . $item->valor_reteica . "%): ";
                $html_rte_ica .= $item->valor_reteica * $subtotal / 1000;
            }
            
            return [
                "FE-" . $item->numero,
                $item->nit . "-" . $item->codigo_verificacion,
                $item->razon_social,
                $html_iva,
                $html_rte_fte,
                $html_rte_iva,
                $html_rte_ica,
                $item->valor_total,
                $status,
                Carbon::parse($item->fecha_elaboracion)->format('d-m-Y'), // Formato de fecha
            ];
        });
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Facturas';
    }
}
