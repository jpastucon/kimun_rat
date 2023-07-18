<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\ModelosMarcas;
use App\Models\TipoMaquina;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ModeloController extends Controller
{
    public function index()
    {
        $marcas = DB::table('marcas')->select('id', 'name')->get();
        $tipo_maquinas = DB::table('tipo_maquinas')->select('id', 'name')->get();
        return view('admin.modelos.index', compact('marcas','tipo_maquinas'));
    }

    public function getModelos()
    {
        $btn = null;
        return Datatables::of(
            DB::table('modelos')
                ->join('marcas', 'modelos.marca_id', '=', 'marcas.id')
                ->join('tipo_maquinas', 'modelos.tipo_maquina_id', '=', 'tipo_maquinas.id')
                ->select('modelos.id as id','tipo_maquinas.name as name', 'marcas.name as name1', 'modelos.name as name2')
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
    public function getModelo($id)
    {
        return DB::table('modelos')
            ->join('marcas', 'modelos.marca_id', '=', 'marcas.id')
            ->join('tipo_maquinas', 'modelos.tipo_maquina_id', '=', 'tipo_maquinas.id')
            ->select('modelos.id as id', 'tipo_maquinas.id as id1', 'marcas.id as id2', 'modelos.name as name')
            ->where('modelos.id', $id)
            ->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $Modelo = new Modelo();
            $Modelo->fill($request->all());
            $Marca = Marca::find($request->marca_id);
            $Modelo->marca()->save($Marca);
            $Tipo_Maquinas = TipoMaquina::find($request->tipo_maquina_id);
            $Modelo->tipo_maquina()->save($Tipo_Maquinas);
            $Modelo->save();
            //Notificación
            notify()->success('Modelo ' . $Modelo->name . ' Creado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Modelo Creado Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $Modelo = Modelo::find($id);
            $Modelo->fill($request->all());
            $Modelo->save();
            $Marca = Marca::find($request->marca_id);
            $Modelo->marca()->save($Marca);
            $Tipo_Maquinas = TipoMaquina::find($request->tipo_maquina_id);
            $Modelo->tipo_maquina()->save($Tipo_Maquinas);
            //Notificación
            notify()->success('Modelo ' . $Modelo->name . ' Actualizado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Modelo actualizado correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $Modelo = Modelo::find($id);
            $Modelo->delete();
            //Notificación
            notify()->success('Modelo ' . $Modelo->name . ' Eliminado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Modelo eliminado correctamente ✓');
    }
}
