<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContactoController extends Controller
{
    public function index()
    {
        $clientes = DB::table('clientes')->select('id', 'name')->get();
        return view('admin.contactos.index', compact('clientes'));
    }

    public function getContactos()
    {
        $btn = null;
        return Datatables::of(
            DB::table('contactos')
                ->join('clientes', 'contactos.cliente_id', '=', 'clientes.id')
                ->select('contactos.id as id', 'clientes.name as name1', 'contactos.name as name2')
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
    public function getContacto($id)
    {
        return DB::table('contactos')
            ->join('clientes', 'contactos.cliente_id', '=', 'clientes.id')
            ->select('clientes.id as id', 'contactos.name as name', 'contactos.phone as phone', 'contactos.email as email')
            ->where('contactos.id', $id)
            ->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $Contacto = new Contacto();
            $Contacto->fill($request->all());
            $Contacto->save();
            //Notificación
            notify()->success('Contacto Creado Exitosamente ✓');
        } catch (\Exception $e) {
            notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Contacto Creado Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $Contacto = Contacto::find($id);
            $Contacto->fill($request->all());
            $Contacto->save();
            //Notificación
            notify()->success('Contacto ' . $Contacto->name . ' Actualizado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Contacto actualizado correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $Contacto = Contacto::find($id);
            $Contacto->delete();
            //Notificación
            notify()->success('Contacto ' . $Contacto->name . ' Eliminado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Contacto eliminado correctamente ✓');
    }
}
