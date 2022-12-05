<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class InventarioController extends Controller
{
    public function index()
    {
        return view('admin.inventario.inventario');
    }

    public function productos_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("productos")
            ->select('productos.*', 'categorias.nombre as categoria')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a data-id="' . $row->id . '" title="Editar" class="edit btn btn-primary btn-sm btn_Show"><i class="fa fa-pencil-alt"></i></a>
                    <a data-id="' . $row->id . '" title="Dar de Baja" class="edit btn btn-primary btn-sm btn_Edit"><i class="fas fa-times"></i></a>
                    <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
