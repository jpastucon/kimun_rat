<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\Estado;
use App\Models\EstadosRats;
use App\Models\Fecha;
use App\Models\Foto;
use App\Models\Horario;
use App\Models\Maquina;
use App\Models\Rat;
use App\Models\TipoMaquina;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToArray;
use Nette\Utils\Arrays;
use Nette\Utils\Random;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Ramsey\Uuid\Type\Integer;

class RatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $contactos = DB::table('contactos')
            ->select('contactos.id as id', 'contactos.name as name', 'clientes.name as namecliente')
            ->join('clientes', 'clientes.id', '=', "contactos.cliente_id")->get();
        //dd(Auth::user()->id);
        $user_id = Auth::user()->id;
        $contador = DB::table('rats')
            ->join('users_rats', 'users_rats.rat_id', '=', "rats.id")
            ->join('users', 'users_rats.user_id', '=', "users.id")
            ->where("rats.user_id", $user_id)
            ->count();
        switch ($user_id) {
            case 2: //Alvaro
                $contador = $contador + 99;
                break;
            case 3: //Cristian
                $contador = $contador + 512;
                break;
            case 4: //Rodrigo
                $contador = $contador + 131;
                break;
        }

        //dd($contador);
        return view('admin.rats.index', compact('contactos', 'contador'));
    }

    public function getRats()
    {
        $btn = null;
        return Datatables::of(
            DB::table('rats')
                ->join('contactos', 'rats.contacto_id', '=', 'contactos.id')
                ->join('clientes', 'contactos.cliente_id', '=', 'clientes.id')
                ->join('users', 'rats.user_id', '=', 'users.id')
                ->join('maquinas_rats', 'rats.id', '=', 'maquinas_rats.rat_id')
                ->join('maquinas', 'maquinas.id', '=', 'maquinas_rats.maquina_id')
                ->join('estados_rats', 'rats.id', '=', 'estados_rats.rat_id')
                ->join('estados', 'estados.id', '=', 'estados_rats.estado_id')
                ->select(
                    'rats.id as id',
                    'rats.id as name',
                    'clientes.name as name_cliente',
                    'estados.name as name_estado',
                    DB::raw('count(maquinas.id) as contador'),
                    'users.name as name_user',
                    'rats.name as name',
                    'rats.tipo_rat as tipo_rat'
                )
                ->groupBy('rats.id', 'estados.name', 'users.id')
                ->get()
        )
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = null;
                if (Auth::user()->rol_id == 1) {
                    $btn = $btn . '<button onclick="editarModal(' . $row->id . ')" class="rounded px-4 py-1 mr-2 text-sm font-medium text-gray-100 border-b bg-yellow-500 hover:bg-yellow-400">📝Editar</button>';
                    $btn = $btn . '<button onclick="eliminarModal(' . $row->id . ')" class="rounded px-4 py-1 text-sm font-medium text-gray-100 border-b bg-red-500 hover:bg-red-400">🗑️Eliminar</button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
    }
    public function getRat($id)
    {
        $this->Rat = Rat::find($id);
        $this->Fechas = DB::table('fechas')
            ->join('fechas_rats', 'fechas_rats.fecha_id', '=', 'fechas.id')
            ->join('rats', 'fechas_rats.rat_id', '=', 'rats.id')
            ->select(
                'fechas.id as id',
                'fechas.name as name',
            )
            ->where('rats.id', $this->Rat->id)->get();
        $this->Fotos = Foto::where('rat_id', $this->Rat->id)->get();
        $this->User = User::find($this->Rat->user_id);
        $this->Contacto = Contacto::find($this->Rat->contacto_id);
        $this->Cliente = Cliente::find($this->Contacto->cliente_id);

        $this->Maquinas = DB::table('maquinas')
            ->join('maquinas_rats', 'maquinas_rats.maquina_id', '=', 'maquinas.id')
            ->join('rats', 'rats.id', '=', 'maquinas_rats.rat_id')
            ->join('marcas', 'maquinas.marca_id', '=', 'marcas.id')
            ->join('modelos', 'maquinas.modelo_id', '=', 'modelos.id')
            ->join('tipo_maquinas', 'maquinas.tipo_maquinas_id', '=', 'tipo_maquinas.id')
            ->select(
                'maquinas.id as id',
                'maquinas.name as name',
                'maquinas.nro_serie as nro_serie',
                'marcas.id as id1',
                'marcas.name as name1',
                'modelos.id as id2',
                'modelos.name as name2',
                'tipo_maquinas.id as id3',
                'tipo_maquinas.name as name3'
            )
            ->where('rats.id', $this->Rat->id)->get();


        $this->Horarios = DB::table('horarios')
            ->join('horarios_rats', 'horarios_rats.horario_id', '=', 'horarios.id')
            ->join('rats', 'horarios_rats.rat_id', '=', 'rats.id')
            ->select(
                'horarios.id as id',
                'horarios.hora_ini_traslado as hora_ini_traslado',
                'horarios.hora_fin_traslado as hora_fin_traslado',
                'horarios.hora_ini_trabajo as hora_ini_trabajo',
                'horarios.hora_fin_trabajo as hora_fin_trabajo',
                'horarios.hora_ini_salida as hora_ini_salida',
                'horarios.hora_fin_salida as hora_fin_salida',
                'horarios.tiempoTraslado as tiempoTraslado',
                'horarios.tiempoTrabajo as tiempoTrabajo',
                'horarios.tiempoSalida as tiempoSalida'
            )
            ->where('rats.id', $this->Rat->id)->get();

        return response()->json(
            [
                'Rats' => $this->Rat,
                'Fechas' => $this->Fechas,
                'Users' => $this->User,
                'Contacto' => $this->Contacto,
                'Cliente' => $this->Cliente,
                'Maquinas' => $this->Maquinas,
                'Horarios' => $this->Horarios,
                'Fotos' => $this->Fotos
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            //RAT
            $Rat = new Rat();
            $Rat->fill($request->all());
            $Rat->pendientes = $request->pendientes;
            $Rat->save();

            //Usuario
            $User = User::find($request->user_id);
            $User->rat()->save($Rat);

            //Estado (1 Nuevo)
            $estado = new EstadosRats();
            $estado->estado_id = 1;
            $estado->rat_id = $Rat->id;
            $estado->created_at = new DateTime('now');
            $estado->created_at = new DateTime('now');
            $estado->save();

            //Fecha
            $fecha_aux = date("Y-m-d", strtotime($request->fecha));
            $fecha = null;
            $fecha = Fecha::firstOrCreate(['name' => $fecha_aux]);
            if ($fecha) {
                $fecha->name = $fecha_aux;
                $fecha->save();
                $fecha->rat()->save($Rat);
            } else {
                $fecha->rat()->save($Rat);
            }

            //N Horarios
            $hh_ini_traslado = date("H:i:s", strtotime($request->hora_ini_traslado));
            $hh_fin_traslado = date("H:i:s", strtotime($request->hora_fin_traslado));
            $hh_ini_trabajo = date("H:i:s", strtotime($request->hora_ini_trabajo));
            $hh_fin_trabajo = date("H:i:s", strtotime($request->hora_fin_trabajo));
            $hh_ini_salida = date("H:i:s", strtotime($request->hora_ini_salida));
            $hh_fin_salida = date("H:i:s", strtotime($request->hora_fin_salida));
            $horario = null;

            $horario = Horario::firstOrCreate([
                'hora_ini_traslado' => $hh_ini_traslado,
                'hora_fin_traslado' => $hh_fin_traslado,
                'hora_ini_trabajo' => $hh_ini_trabajo,
                'hora_fin_trabajo' => $hh_fin_trabajo,
                'hora_ini_salida' => $hh_ini_salida,
                'hora_fin_salida' => $hh_fin_salida
            ]);
            if ($horario) {
                $horario->hora_ini_traslado = $hh_ini_traslado;
                $horario->hora_fin_traslado = $hh_fin_traslado;
                $horario->hora_ini_trabajo = $hh_ini_trabajo;
                $horario->hora_fin_trabajo = $hh_fin_trabajo;
                $horario->hora_ini_salida = $hh_ini_salida;
                $horario->hora_fin_salida = $hh_fin_salida;
                $horario->tiempoTraslado = $horario->tiempoTraslado();
                $horario->tiempoTrabajo = $horario->tiempoTrabajo();
                $horario->tiempoSalida = $horario->tiempoSalida();
                $horario->save();
                $horario->rat()->save($Rat);
            } else {
                $horario->rat()->save($Rat);
            }

            //N Maquinas
            $maquinas = explode(",", $request->values);
            $mm = 0;
            $maquinas_out = [];
            foreach ($maquinas as $maquina) {
                $maquina_tmp = Maquina::join('marcas', 'maquinas.marca_id', '=', 'marcas.id')
                    ->join('modelos', 'maquinas.modelo_id', '=', 'modelos.id')
                    ->join('tipo_maquinas', 'maquinas.tipo_maquinas_id', '=', 'tipo_maquinas.id')
                    ->select('maquinas.id as id', 'maquinas.name as name', 'maquinas.nro_serie as nro_serie', 'marcas.id as id1', 'marcas.name as name1', 'modelos.id as id2', 'modelos.name as name2', 'tipo_maquinas.id as id3', 'tipo_maquinas.name as name3')
                    ->where('maquinas.id', $maquina)
                    ->get()->first();
                $maquina_tmp->rat()->save($Rat);
                $maquinas_out[$mm] = $maquina_tmp;
                $mm++;
            }

            // N Fotos
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $imagefile) {
                    $image = new Foto();
                    $imagePath = '/rats/' . $Rat->name;
                    $path = $imagefile->store($imagePath, ['disk' =>   'my_files']);
                    $image->path = $path;
                    $image->rat_id = $Rat->id;
                    $image->save();
                }
                //dd($Rat);
                //Notificación
                notify()->success($Rat->name . ' Creado Exitosamente ✓');
                return redirect()->route('rats');
            } else {
                //Notificación
                notify()->success($Rat->name . ' Creado Exitosamente ✓ (SIN FOTOS)');
                return redirect()->route('rats');
            }
        } catch (\Exception $e) {
            notify()->error('ERROR: ' . $e->getMessage());
            return redirect()->route('rats');
        }
    }

    public function store_fecha(Request $request)
    {
        try {
            //RAT
            //dd($request->all());
            $Rat = Rat::where('name', $request->rat_name)->first();
            /*
            $sintoma = $Rat->sintoma;
            $desarrollo = $Rat->desarrollo;
            $observaciones = $Rat->observaciones;
            $pendientes = $Rat->pendientes;
            */

            $Rat->sintoma = $request->sintoma_add;
            $Rat->desarrollo = $request->desarrollo_add;
            $Rat->observaciones = $request->observaciones_add;
            $Rat->pendientes = $request->pendientes_add;

            //Fecha
            $fecha_aux = date("Y-m-d", strtotime($request->fecha_add));
            $fecha = null;
            $fecha = Fecha::firstOrCreate(['name' => $fecha_aux]);
            if ($fecha) {
                $fecha->name = $fecha_aux;
                $fecha->save();
                $fecha->rat()->save($Rat);
            } else {
                $fecha->rat()->save($Rat);
            }

            //N Horarios
            $hh_ini_traslado = date("H:i:s", strtotime($request->hora_ini_traslado_add));
            $hh_fin_traslado = date("H:i:s", strtotime($request->hora_fin_traslado_add));
            $hh_ini_trabajo = date("H:i:s", strtotime($request->hora_ini_trabajo_add));
            $hh_fin_trabajo = date("H:i:s", strtotime($request->hora_fin_trabajo_add));
            $hh_ini_salida = date("H:i:s", strtotime($request->hora_ini_salida_add));
            $hh_fin_salida = date("H:i:s", strtotime($request->hora_fin_salida_add));
            $horario = null;

            $horario = Horario::firstOrCreate([
                'hora_ini_traslado' => $hh_ini_traslado,
                'hora_fin_traslado' => $hh_fin_traslado,
                'hora_ini_trabajo' => $hh_ini_trabajo,
                'hora_fin_trabajo' => $hh_fin_trabajo,
                'hora_ini_salida' => $hh_ini_salida,
                'hora_fin_salida' => $hh_fin_salida
            ]);
            if ($horario) {
                $horario->hora_ini_traslado = $hh_ini_traslado;
                $horario->hora_fin_traslado = $hh_fin_traslado;
                $horario->hora_ini_trabajo = $hh_ini_trabajo;
                $horario->hora_fin_trabajo = $hh_fin_trabajo;
                $horario->hora_ini_salida = $hh_ini_salida;
                $horario->hora_fin_salida = $hh_fin_salida;
                $horario->tiempoTraslado = $horario->tiempoTraslado();
                $horario->tiempoTrabajo = $horario->tiempoTrabajo();
                $horario->tiempoSalida = $horario->tiempoSalida();
                $horario->save();
                $horario->rat()->save($Rat);
            } else {
                $horario->rat()->save($Rat);
            }

            // N Fotos
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $imagefile) {
                    $image = new Foto();
                    $imagePath = '/rats/' . $Rat->name;
                    $path = $imagefile->store($imagePath, ['disk' =>   'my_files']);
                    $image->path = $path;
                    $image->rat_id = $Rat->id;
                    $image->save();
                }
                //Notificación
                notify()->success('Se añadió información al ' . $Rat->name . '✓');
                return redirect()->route('rats');
            } else {
                //Notificación
                notify()->success('Se añadió información al ' . $Rat->name . '✓ (SIN FOTOS)');
                return redirect()->route('rats');
            }
        } catch (\Exception $e) {
            notify()->error('ERROR: ' . $e->getMessage());
            return redirect()->route('rats');
        }
    }


    public function store_firma(Request $request)
    {
        try {
            //RAT
            $Rat = Rat::find($request->show_rat_id);

            //Firma
            $image = new Foto();
            $imagePath = 'rats/' . $Rat->name;
            $folderPath = storage_path($imagePath);
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $uid = uniqid();
            $filename = $folderPath . '/' . $uid . '.' . $image_type;
            Storage::disk('my_files')->makeDirectory($imagePath);
            //mkdir($folderPath, 0777, true);
            file_put_contents($filename, $image_base64);
            $image->path = 'rats/' . $Rat->name . '/' . $uid . '.' . $image_type;
            $image->rat_id = $Rat->id;
            $image->save();

            //Cambio de estado - (2 Firmado y validado)
            $estado = EstadosRats::firstWhere('rat_id', $Rat->id);
            $estado->estado_id = 2;
            $estado->save();

            //Notificación
            notify()->success('Firma Añadida Exitosamente al ' . $Rat->name . ' ✓');
            return redirect()->route('rats');
        } catch (\Exception $e) {
            notify()->error('ERROR: ' . $e->getMessage());
            return redirect()->route('rats');
        }
    }

    public function store_mail(Request $request)
    {
        try {
            //Obtenemos todos los datos para generar el PDF
            $Rat = Rat::find($request->show_out_rat_id);
            $Fechas = DB::table('fechas')
                ->join('fechas_rats', 'fechas_rats.fecha_id', '=', 'fechas.id')
                ->join('rats', 'rats.id', '=', 'fechas_rats.rat_id')
                ->select('fechas.id as id', 'fechas.name as name')
                ->where('rats.id', $Rat->id)->get();
            $Fotos = Foto::where('rat_id', $Rat->id)->get();
            $User = User::find($Rat->user_id);
            $Contacto = Contacto::find($Rat->contacto_id);
            $Cliente = Cliente::find($Contacto->cliente_id);

            $Maquinas = DB::table('maquinas')
                ->join('maquinas_rats', 'maquinas_rats.maquina_id', '=', 'maquinas.id')
                ->join('rats', 'rats.id', '=', 'maquinas_rats.rat_id')
                ->join('marcas', 'maquinas.marca_id', '=', 'marcas.id')
                ->join('modelos', 'maquinas.modelo_id', '=', 'modelos.id')
                ->join('tipo_maquinas', 'maquinas.tipo_maquinas_id', '=', 'tipo_maquinas.id')
                ->select(
                    'maquinas.id as id',
                    'maquinas.name as name',
                    'maquinas.nro_serie as nro_serie',
                    'marcas.id as id1',
                    'marcas.name as name1',
                    'modelos.id as id2',
                    'modelos.name as name2',
                    'tipo_maquinas.id as id3',
                    'tipo_maquinas.name as name3'
                )
                ->where('rats.id', $Rat->id)->get();


            $Horarios = DB::table('horarios')
                ->join('horarios_rats', 'horarios_rats.horario_id', '=', 'horarios.id')
                ->join('rats', 'horarios_rats.rat_id', '=', 'rats.id')
                ->select(
                    'horarios.id as id',
                    'horarios.hora_ini_traslado as hora_ini_traslado',
                    'horarios.hora_fin_traslado as hora_fin_traslado',
                    'horarios.hora_ini_trabajo as hora_ini_trabajo',
                    'horarios.hora_fin_trabajo as hora_fin_trabajo',
                    'horarios.hora_ini_salida as hora_ini_salida',
                    'horarios.hora_fin_salida as hora_fin_salida',
                    'horarios.tiempoTraslado as tiempoTraslado',
                    'horarios.tiempoTrabajo as tiempoTrabajo',
                    'horarios.tiempoSalida as tiempoSalida'
                )
                ->where('rats.id', $Rat->id)->get();


            //PDF
            $pdfPath = '/rats/' . $Rat->name . '/' . $Rat->name . '.pdf';

            $document =  PDF::loadView(
                'admin.rats.out_pdf',
                compact('Rat', 'Fechas', 'Fotos', 'User', 'Contacto', 'Cliente', 'Maquinas', 'Horarios',)
            )->download($Rat->name . '.pdf');

            $document1 =  PDF::loadView(
                'admin.rats.out_pdf',
                compact('Rat', 'Fechas', 'Fotos', 'User', 'Contacto', 'Cliente', 'Maquinas', 'Horarios',)
            );

            File::put(storage_path($pdfPath), $document);


            //Cambio de estado - (3 Firmado y validado)
            $estado = EstadosRats::firstWhere('rat_id', $Rat->id);
            $estado->estado_id = 3;
            $estado->save();

            //CORREO + adjunto
            $data["email"] = $Contacto->email;
            $data["nameDoc"] = $Rat->name . '.pdf';
            $data["title"] = "Nuevo reporte (" . $Rat->name . ") - MadeIn";
            $data["cc"] = Auth::user()->email;
            $data["cc1"] = "contacto@madein-eirl.cl";
            $data["bcc"] = "isabel.briones@madein-eirl.cl";
            Mail::send(
                'mail.newratcliente',
                compact('Contacto', 'Cliente'),
                function ($message) use ($data, $document1) {
                    $message->to($data["email"], $data["email"])
                        ->cc($data["cc"])
                        ->cc($data["cc1"])
                        ->bcc($data["bcc"])
                        ->subject($data["title"])
                        ->attachData($document1->output(),  $data["nameDoc"]);
                }
            );
            //Notificación
            notify()->success(
                'Correo enviado con éxito a ' . $Contacto->name .
                    '\nCC: ' . Auth::user()->email . ' ✓'
            );
            return redirect()->route('rats');
        } catch (\Exception $e) {
            notify()->error('ERROR: ' . $e->getMessage());
            return redirect()->route('rats');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //RAT
            //dd($request->all());
            $Rat = Rat::where('name', $request->rat_name)->first();
            $Rat->sintoma = $request->sintoma_add;
            $Rat->desarrollo = $request->desarrollo_add;
            $Rat->observaciones = $request->observaciones_add;
            $Rat->pendientes = $request->pendientes_add;
            $Rat->save();

            // N Fotos
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $imagefile) {
                    $image = new Foto();
                    $imagePath = '/rats/' . $Rat->name;
                    $path = $imagefile->store($imagePath, ['disk' =>   'my_files']);
                    $image->path = $path;
                    $image->rat_id = $Rat->id;
                    $image->save();
                }
                //Notificación
                notify()->success($Rat->name . ' editado éxitosamente ✓');
                return redirect()->route('rats');
            } else {
                //Notificación
                notify()->success($Rat->name . ' editado éxitosamente ✓ (SIN FOTOS)');
                return redirect()->route('rats');
            }
        } catch (\Exception $e) {
            notify()->error('ERROR: ' . $e->getMessage());
            return redirect()->route('rats');
        }
    }

    public function destroy($id)
    {
        try {
            $Rat = Rat::find($id);
            $Rat->delete();
            //Notificación
            notify()->success($Rat->name . ' Eliminado Exitosamente ✓');
        } catch (\Exception $e) {
            return notify()->error('ERROR: ' . $e->getMessage());
        }
    }
}
