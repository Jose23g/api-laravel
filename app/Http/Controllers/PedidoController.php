<?php

namespace App\Http\Controllers;

use App\Models\Detalle_pedido;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Producto_Proveedores;
use App\Models\Proveedores;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
     
   public function Pedir (Request $request){
       dd($request);
      $tamaño = Count($request->Detalles);
      
      if(!$tamaño==0){
        
        /*$pedido = Pedido::create([
         'id_usuario' => $this->ObtenerUsuario(),
         'id_estado' => 1,
         'fecha' => $this->FechaNow()

        ]); */
        
        for($i = 0; $i < $tamaño; $i++){
          
            $actual = $request->Detalles[$i];
            $precioproovedor= $this->PrecioProveedor($actual->id_producto,  $actual->id_proovedor);
            $totallinea = $request->Detalles[$i]->cantidad *  $precioproovedor; 

            $detalle = Detalle_pedido::create([
                'id_producto'=> $actual['id_producto'], 
                'id_pedido'=> 1,
                'id_proveedor'=> $actual['id_proveedor'],  
                'cantidad'=> $actual['cantidad'], 
                'total_linea'=>$totallinea
            ]);

            print " /Ingreso {$ $detalle} ";
        
      }

      return Response()->json(['Ingresa al menos 1 producto']);
    }
   }  

   public function contar(){
    return Response()->json(['Jose bebe']);
   }

   public function FechaNow(){
    $fecha = Carbon::now(); 
    return $fecha->format('Y-m-d');
   }

    public function buscarporcodigo(Request $request){
      
        $buscaridproducto = Producto::Where('Codigo_producto', '=',  $request->Codigo_producto)->first();
       
       return $buscaridproducto->id_producto;
    }    
  

    public function ObtenerUsuario(){

        return auth()->user()->id;
    } 
  
    public function consular(Request $request){
        $proovedor = Proveedores::where('Nombre', $request->nombre)->first();
        return $proovedor->id_proveedor;
    }
    
    public function PrecioProveedor(string $id_producto, string $id_proveedor){
     $precioproveedor = Producto_Proveedores::where('id_producto','=',$id_producto)->where('id_proveedor','=',$id_proveedor)->select('Precio')->get();
         return $precioproveedor[0]->Precio;
    }
}
