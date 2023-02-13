<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AutenticacionController;
use App\Http\Controllers\IngresarJosue;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
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

Route::get('/', function () {
    return response()->json('Welcome to laravel API');
});

Route::prefix('prefix')->group(
    function () {
        Route::post('login', [AutenticacionController::class, 'login']);
        Route::post('registrar', [AutenticacionController::class, 'registrar']);
    }
);

Route::prefix('ingresar')->group(
    function () {
        Route::post('producto', [ProductoController::class, 'nuevoproducto']);
        Route::post('ingresarp', [IngresarJosue::class, 'ingresarp']);
        Route::post('proveedor', [ProveedoresController::class, 'nuevoProveedor']);
        Route::post('proveedor-producto', [ProveedoresController::class, 'proveedorProducto']);
        Route::post('pedido', [PedidoController::class, 'Pedir']);
        Route::get('cuenta', [PedidoController::class, 'contar']);
        Route::post('DetalleProveedor', [ProveedoresController::class, 'consultaProveedor']);
    }
);

Route::prefix('obtener')->group(
    function () {
        Route::get('informacion', [AutenticacionController::class, 'obtener']);
        Route::get('listarp', [IngresarJosue::class, 'listar']);//Lista Presentaciones
        Route::get('proveedor', [ProveedoresController::class, 'obtenerProveedoresSolo']);
        Route::get('detalleProduct', [ProductoController::class, 'detalleProduct']);//Detalle de un producto especific (falta realizar)
        Route::get('productos', [ProductoController::class, 'todoProducto']);
        Route::get('proveedores', [ProveedoresController::class, 'obtenerProveedoresProductos']);
        Route::get('listaproducto', [ProductoController::class, 'listaProductosConProveedor']);
        Route::post('buscador', [PedidoController::class, 'BuscadorNombre']);
        Route::get('fecha', [PedidoController::class, 'FechaNow']);
        Route::post('codigo', [PedidoController::class, 'buscarporcodigo']);
        Route::post('consultar', [PedidoController::class, 'consular']);
        
    }
); 
 
Route::post('PrecioProveedor', [PedidoController::class, 'PrecioProveedor']);



