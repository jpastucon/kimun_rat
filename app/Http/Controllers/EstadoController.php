<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EstadoController extends Controller
{
    public function index()
    {
        return view('admin.estados.index');
    }

    public function getEstados()
    {
        $btn = null;
        return Datatables::of(DB::table('estados')->get())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="detalleModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-blue-500 hover:bg-blue-400">👁‍🗨Ver</button>';
                if (Auth::user()->rol_id == 1) {
                    $btn = $btn . '<button onclick="editarModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-gray-500 hover:bg-gray-400">✏️Editar</button>';
                    $btn = $btn . '<button onclick="eliminarModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-red-500 hover:bg-red-400">🗑️Eliminar</button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
    }
    public function getEstado($id)
    {
        return DB::table('estados')->where('id', $id)->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $estado = new Estado();
            $estado->fill($request->all());
            $estado->save();
            //Notificación
            notify()->success('Estado Creado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Estado Creado Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $estado = Estado::find($id);
            $estado->fill($request->all());
            $estado->save();
            //Notificación
            notify()->success('Estado ' . $estado->id . ' Actualizado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Estado actualizado correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $estado = Estado::find($id);
            $estado->delete();
            //Notificación
            notify()->success('Estado ' . $estado->id . ' Eliminado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Estado eliminado correctamente ✓');
    }
}
