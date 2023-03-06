<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
 public function obtenerTodos(){
    
    $inventarios = Inventario::All();

    return Response()->json(['Productos' => $inventarios]);
 }

 public function buscarporoid (Request $request){
   $producto = Inventario::where('id_producto','=',$request->id_producto)->first();

   return Response()->json(['Stock' => $producto]);
}
}