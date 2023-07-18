<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\RatController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoMaquinaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    ##RECURSOS
    Route::resources([
        'clientes' => ClienteController::class,
        'contactos' => ContactoController::class,
        'users' => UserController::class,
        'marcas' => MarcaController::class,
        'modelos' => ModeloController::class,
        'maquinas' => MaquinaController::class,
        'tipo_maquinas' => TipoMaquinaController::class,
        'rats' => RatController::class,
        'estados' => EstadoController::class,
        'horarios' => HorarioController::class,
    ]);
    ##SISTEMA
    Route::get('/showPermisos/{id_rols}', [RolController::class, 'ShowPermisos']);
    Route::post('/permisos/{id_rols}', [RolController::class, 'storePermiso']);
    Route::post('/permisos/{id_rols}/{id_permiso}', [RolController::class, 'updatePermiso']);
    ##DATATABLES - clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::get('/getClientes/', [ClienteController::class, 'getClientes']);
    Route::get('/getCliente/{id}', [ClienteController::class, 'getCliente'])->name('getCliente');
    ##DATATABLES - contactos
    Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos');
    Route::post('/contactos', [ContactoController::class, 'store']);
    Route::put('/contactos/{id}', [ContactoController::class, 'update']);
    Route::get('/getContactos/', [ContactoController::class, 'getContactos']);
    Route::get('/getContacto/{id}', [ContactoController::class, 'getContacto'])->name('getContacto');
    ##DATATABLES - marcas
    Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas');
    Route::post('/marcas', [MarcaController::class, 'store']);
    Route::put('/marcas/{id}', [MarcaController::class, 'update']);
    Route::get('/getMarcas/', [MarcaController::class, 'getMarcas']);
    Route::get('/getMarca/{id}', [MarcaController::class, 'getMarca'])->name('getMarca');
    ##DATATABLES - modelos
    Route::get('/modelos', [ModeloController::class, 'index'])->name('modelos');
    Route::post('/modelos', [ModeloController::class, 'store']);
    Route::put('/modelos/{id}', [ModeloController::class, 'update']);
    Route::get('/getModelos/', [ModeloController::class, 'getModelos']);
    Route::get('/getModelo/{id}', [ModeloController::class, 'getModelo'])->name('getModelo');
    ##DATATABLES - tipo de maquinas
    Route::get('/tipo_maquinas', [TipoMaquinaController::class, 'index'])->name('tipo_maquinas');
    Route::post('/tipo_maquinas', [TipoMaquinaController::class, 'store']);
    Route::put('/tipo_maquinas/{id}', [TipoMaquinaController::class, 'update']);
    Route::get('/getTipoMaquinas/', [TipoMaquinaController::class, 'getTipoMaquinas']);
    Route::get('/getTipoMaquina/{id}', [TipoMaquinaController::class, 'getTipoMaquina'])->name('getTipoMaquina');
    ##DATATABLES - maquinas
    Route::get('/maquinas', [MaquinaController::class, 'index'])->name('maquinas');
    Route::post('/maquinas', [MaquinaController::class, 'store']);
    Route::put('/maquinas/{id}', [MaquinaController::class, 'update']);
    Route::get('/getMaquinas/', [MaquinaController::class, 'getMaquinas']);
    Route::get('/getMaquina/{id}', [MaquinaController::class, 'getMaquina'])->name('getMaquina');
    ##DATATABLES - rats
    Route::get('/rats', [RatController::class, 'index'])->name('rats');
    Route::post('/rats', [RatController::class, 'store']);
    Route::post('/rats_fecha', [RatController::class, 'store_fecha']);
    Route::post('/rat_valid', [RatController::class, 'store_firma']);
    Route::post('/rat_send_mail', [RatController::class, 'store_mail']);
    Route::put('/rats/{id}', [RatController::class, 'update']);
    Route::get('/getRats/', [RatController::class, 'getRats']);
    Route::get('/getRat/{id}', [RatController::class, 'getRat'])->name('getRat');
    ##DATATABLES - estados
    Route::get('/estados', [EstadoController::class, 'index'])->name('estados');
    Route::post('/estados', [EstadoController::class, 'store']);
    Route::put('/estados/{id}', [EstadoController::class, 'update']);
    Route::get('/getEstados/', [EstadoController::class, 'getEstados']);
    Route::get('/getEstado/{id}', [EstadoController::class, 'getEstado'])->name('getEstado');
    ##DATATABLES - horarios
    Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios');
    Route::post('/horarios', [HorarioController::class, 'store']);
    Route::put('/horarios/{id}', [HorarioController::class, 'update']);
    Route::get('/getHorarios/', [HorarioController::class, 'getHorarios']);
    Route::get('/getHorario/{id}', [HorarioController::class, 'getHorario'])->name('getHorario');


    ##PANEL
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
