<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AutenticacionController;
use App\Http\Controllers\IngresarJosue;

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

Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::post('login', [AutenticacionController::class, 'login']);
        Route::post('registrar', [AutenticacionController::class, 'registrar']);
    }
);

Route::get('obtener', [AutenticacionController::class, 'obtener']);
Route::post('nuevoproveedor', [AutenticacionController::class, 'ingresar']);
Route::get('obtener', [AutenticacionController::class, 'obtener']); 

Route::get('listarp', [IngresarJosue::class, 'listar']);

Route::post('ingresarp', [IngresarJosue::class, 'ingresarp']);
