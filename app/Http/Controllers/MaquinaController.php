<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MaquinaController extends Controller
{
    public function index()
    {
        $marcas = DB::table('marcas')->select('id', 'name')->get();
        $modelos = DB::table('modelos')->select('id', 'name')->get();
        $tipo_maquinas = DB::table('tipo_maquinas')->select('id', 'name')->get();
        return view('admin.maquinas.index', compact('marcas', 'modelos', 'tipo_maquinas'));
    }

    public function getMaquinas()
    {
        $btn = null;
        return Datatables::of(
            DB::table('maquinas')
                ->join('marcas', 'maquinas.marca_id', '=', 'marcas.id')
                ->join('modelos', 'maquinas.modelo_id', '=', 'modelos.id')
                ->join('tipo_maquinas', 'maquinas.tipo_maquinas_id', '=', 'tipo_maquinas.id')
                ->select('maquinas.id as id', 'maquinas.name as name', 'marcas.name as name1', 'modelos.name as name2', 'tipo_maquinas.name as name3')
                ->get()
        )
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
    public function getMaquina($id)
    {
        return DB::table('maquinas')
            ->join('marcas', 'maquinas.marca_id', '=', 'marcas.id')
            ->join('modelos', 'maquinas.modelo_id', '=', 'modelos.id')
            ->join('tipo_maquinas', 'maquinas.tipo_maquinas_id', '=', 'tipo_maquinas.id')
            ->select('maquinas.id as id', 'maquinas.name as name', 'maquinas.nro_serie as nro_serie', 'marcas.id as id1', 'marcas.name as name1', 'modelos.id as id2', 'modelos.name as name2', 'tipo_maquinas.id as id3', 'tipo_maquinas.name as name3')
            ->where('maquinas.id', $id)
            ->get()->first();
    }

    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $Maquina = new Maquina();
            $Maquina->fill($request->all());
            $Maquina->save();
            //Notificación
            notify()->success('Maquina ' . $Maquina->id . ' Creada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Maquina creada correctamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $Maquina = Maquina::find($id);
            $Maquina->fill($request->all());
            $Maquina->save();
            //Notificación
            notify()->success('Maquina ' . $Maquina->id . ' Actualizada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Maquina actualizada correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $Maquina = Maquina::find($id);
            $Maquina->delete();
            //Notificación
            notify()->success('Maquina ' . $Maquina->id . ' Eliminada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Maquina eliminada correctamente ✓');
    }
}
