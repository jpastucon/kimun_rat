<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoMaquina;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MarcaController extends Controller
{
    public function index()
    {
        $tipos = DB::table('tipo_maquinas')->select('id', 'name')->get();

        return view('admin.marcas.index', compact('tipos'));
    }

    public function getMarcas()
    {
        $btn = null;
        return Datatables::of(
            DB::table('marcas')
                ->select('marcas.id as id', 'marcas.name as name')
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
    public function getMarca($id)
    {
        return DB::table('marcas')
            ->join('marcas_tipo_maquinas', 'marcas_tipo_maquinas.marca_id', '=', 'marcas.id')
            ->join('tipo_maquinas', 'marcas_tipo_maquinas.tipo_maquina_id', '=', 'tipo_maquinas.id')
            ->select('marcas.id as id', 'marcas.name as name', 'tipo_maquinas.id as tipo_maquinas_id', 'marcas.created_at as created_at', 'marcas.updated_at')
            ->where('marcas.id', $id)->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $marca = Marca::firstOrNew(['name' => $request->name]);
            $marca->fill($request->all());
            $marca->save();
            $tipos = explode(",", $request->values);
            for ($i = 0; $i < count($tipos); $i++) {
                $Tipo = TipoMaquina::find($tipos[$i]);
                $marca->tipo_maquina()->save($Tipo);
            }
            //Notificación
            notify()->success('Marca ' . $marca->name . ' Creada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Marca Creada Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $marca = Marca::find($id);
            $marca->fill($request->all());
            $marca->save();
            //Notificación
            notify()->success('Marca ' . $marca->name . ' Actualizada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Marca actualizada correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $marca = Marca::find($id);
            $marca->delete();
            //Notificación
            notify()->success('Marca ' . $marca->name . ' Eliminada Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Marca eliminada correctamente ✓');
    }
}
