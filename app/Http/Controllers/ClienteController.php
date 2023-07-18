<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;

class ClienteController extends Controller
{
    public function index()
    {
        return view('admin.clientes.index');
    }

    public function getClientes()
    {
        $btn = null;
        return Datatables::of(DB::table('clientes')->get())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="detalleModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 w-text-sm text-gray-50 border-b bg-blue-500 hover:bg-blue-400">👁‍🗨Ver</button>';
                if (Auth::user()->rol_id == 1) {
                    $btn = $btn . '<button onclick="editarModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-yellow-500 hover:bg-yellow-400">✏️Editar</button>';
                    $btn = $btn . '<button onclick="eliminarModal(' . $row->id . ')" class="rounded w-3/4 px-4 py-1 text-sm text-gray-50 border-b bg-red-500 hover:bg-red-400">🗑️Eliminar</button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
    }
    public function getCliente($id)
    {
        return DB::table('clientes')->where('id', $id)->select('name', 'email_empresa', 'rut', 'razon_social', 'direccion', 'ciudad', 'comuna')->get()->first();
    }

    public function store(Request $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->fill($request->all());
            $cliente->save();
            //Notificación
            notify()->success('Cliente Creado Exitosamente ✓');
        } catch (\Exception $e) {
            //Notificación
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('success', 'Cliente Creado Exitosamente ✓');
    }

    public function update(Request $request, $id)
    {
        try {
            $cliente = Cliente::find($id);
            $cliente->fill($request->all());
            $cliente->save();
            //Notificación
            notify()->success('Cliente ' . $cliente->name . ' Actualizado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('update', 'Cliente actualizado correctamente ✓');
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::find($id);
            $cliente->delete();
            //Notificación
            notify()->success('Cliente ' . $cliente->name . ' Eliminado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
        return back()->with('delete', 'Cliente eliminado correctamente ✓');
    }
}
