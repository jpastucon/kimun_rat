<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HorarioController extends Controller
{
    public function index()
    {
        return view('admin.horarios.index');
    }

    public function getHorarios()
    {
        $btn = null;
        return Datatables::of(DB::table('horarios')->get())
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
    public function getHorario($id)
    {
        return DB::table('horarios')->where('id', $id)->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $horario = new Horario();
            $horario->fill($request->all());
            $horario->save();
            //Notificación
            notify()->success('Horario ' . $horario->id . ' Creado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Horario Creado Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $horario = Horario::find($id);
            $horario->fill($request->all());
            $horario->save();
            //Notificación
            notify()->success('Horario ' . $horario->id . ' Actualizado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Horario actualizado correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $horario = Horario::find($id);
            $horario->delete();
            //Notificación
            notify()->success('Horario ' . $horario->id . ' Eliminado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Horario eliminado correctamente ✓');
    }
}
