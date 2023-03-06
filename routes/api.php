<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AutenticacionController;
use App\Http\Controllers\IngresarJosue;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProveedoresController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
    
});  



Route::group(['prefix' => 'sesion', 'middleware' => ['auth:sanctum']], function(){
    Route::post('loggout', [AutenticacionController::class, 'loggout']);
    Route::post('getusu', [PedidoController::class, 'ObtenerUsuario']);
});

/** Rutas de ingreso de datos o metodos Post*/
Route::group(['prefix' => 'ingresar', 'middleware' => ['auth:sanctum']], function(){
    Route::post('producto', [ProductoController::class, 'nuevoproducto']);
    Route::post('ingresarp', [IngresarJosue::class, 'ingresarp']);
    Route::post('proveedor', [ProveedoresController::class, 'nuevoProveedor']);
    Route::post('proveedor-producto', [ProveedoresController::class, 'proveedorProducto']);
    Route::post('pedido', [PedidoController::class, 'Pedir']);
    Route::post('verpedido', [PedidoController::class, 'verpedidoporid']);
    Route::post('DetalleProveedor', [ProveedoresController::class, 'consultaProveedor']);
    Route::post('IngresarEntrada', [PedidoController::class, 'IngresarEntrada']);
    Route::post('consultar', [ProveedoresController::class, 'consular']);
    Route::post('codigo', [PedidoController::class, 'buscarporcodigo']);
    Route::post('consultar', [PedidoController::class, 'consular']);
    Route::post('buscador', [PedidoController::class, 'BuscadorNombre']);
    Route::post('buscarinventario', [InventarioController ::class, 'buscarporoid']);
});

/** Rutas obtener  datos o metodos Get */
Route::group(['prefix' => 'obtener', 'middleware' => ['auth:sanctum']], function(){
    Route::get('todospedidos', [PedidoController::class, 'todospedidos']);
    Route::get('informacion', [AutenticacionController::class, 'obtener']);
    Route::get('listarp', [IngresarJosue::class, 'listar']);//Lista Presentaciones
    Route::get('proveedor', [ProveedoresController::class, 'obtenerProveedoresSolo']);
    Route::get('detalleProduct', [ProductoController::class, 'detalleProduct']);//Detalle de un producto especific (falta realizar)
    Route::get('productos', [ProductoController::class, 'todoProducto']);
    Route::get('proveedores', [ProveedoresController::class, 'obtenerProveedoresProductos']);
    Route::get('listaproducto', [ProductoController::class, 'listaProductosConProveedor']);
    Route::get('todasentradas', [PedidoController::class, 'todosentradas']);
    Route::get('verinventario', [InventarioController ::class, 'obtenerTodos']);
    
});

Route::prefix('autenticacion')->group(
    function () {
        Route::post('login', [AutenticacionController::class, 'login']);
        Route::post('registrar', [AutenticacionController::class, 'registrar']);
        
    }
);

 
 




