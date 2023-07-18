<?php

namespace App\Http\Controllers;

use App\Models\TipoMaquina;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TipoMaquinaController extends Controller
{
    public function index()
    {
        return view('admin.tipo_maquinas.index');
    }

    public function getTipoMaquinas()
    {
        $btn = null;
        return Datatables::of(DB::table('tipo_maquinas')->get())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="detalleModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-blue-500 hover:bg-blue-400">👁‍🗨Ver</button>';
                if (Auth::user()->rol_id == 1) {
                    $btn = $btn . '<button onclick="editarModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-yellow-500 hover:bg-yellow-400">✏️Editar</button>';
                    $btn = $btn . '<button onclick="eliminarModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-red-500 hover:bg-red-400">🗑️Eliminar</button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
    }
    public function getTipoMaquina($id)
    {
        return DB::table('tipo_maquinas')->where('id', $id)->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $TipoMaquina = new TipoMaquina();
            $TipoMaquina->fill($request->all());
            $TipoMaquina->save();
            //Notificación
            notify()->success('Tipo de Maquina Creada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Tipo de maquina creado Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $TipoMaquina = TipoMaquina::find($id);
            $TipoMaquina->fill($request->all());
            $TipoMaquina->save();
            //Notificación
            notify()->success('Tipo de Maquina ' . $TipoMaquina->name . ' Actualizada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Tipo de maquina actualizado correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $TipoMaquina = TipoMaquina::find($id);
            $TipoMaquina->delete();
            //Notificación
            notify()->success('Tipo de Maquina ' . $TipoMaquina->name . ' Eliminada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Tipo de maquina eliminado correctamente ✓');
    }
}
