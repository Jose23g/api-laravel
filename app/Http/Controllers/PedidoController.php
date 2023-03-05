<?php

namespace App\Http\Controllers;

use App\Models\Detalle_Entrada;
use App\Models\Detalle_pedido;
use App\Models\Inventario;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Producto_Proveedores;
use App\Models\Proveedores;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
     
   public function Pedir (Request $request){
      $tamaño = Count($request->Detalles);   
      if(!$tamaño==0){
        
        $pedido = Pedido::create([
         'id_usuario' => 3,
         'id_estado' => 1,
         'fecha' => $this->FechaNow()
        ]);   
    
        $totallinea = 0;
        
        for($i = 0; $i < $tamaño; $i++){
          
            $actual = $request->Detalles[$i];
            
            $precioproovedor= $this->PrecioProveedor($actual['id_producto'], $actual['id_proveedor']);
            $totallinea = ($actual['cantidad'] *  $precioproovedor); 

          $detalle = Detalle_pedido::create([
                'id_producto'=> $actual['id_producto'], 
                'id_pedido'=> $pedido->id_pedido,
                'id_proveedor'=> $actual['id_proveedor'],  
                'cantidad'=> $actual['cantidad'], 
                'total_linea'=>$totallinea 
            ]);      
      }
      return Response()->json(['Message' => ' Se ha registrado correctamente el pedido ']);
    }
    return Response()->json(['Error' => ' Ingresa al menos 1 producto ']);
   }   

   public function IngresarEntrada(Request $request){
      
    $tamaño = Count($request->Detalles);  

    if(!$tamaño == 0){

     $Detalle_pedido = $request->Detalles;

     self::cambiarestadorecibido($request->id_pedido);
       
     foreach( $Detalle_pedido as $detalle){
         $detalleerntrada = Detalle_Entrada::create([
          'id_producto'=> $detalle['id_producto'],
          'id_pedido'=> $request->id_pedido,
          'Cantidad'=> $detalle['cantidad']  
      ]); 

     } 

     return Response()->json(['Message' =>'Se han registrado la entradas al inventario']);
    }
        
    return Response()->json(['No se han registrado detalles de entrada']);
    }

    /** Metodos secundarios */

    public function cambiarestadorecibido (String $id_pedido){
     
     $pedido = Pedido::where('id_pedido','=', $id_pedido)->update(['id_estado' =>2]);
         
      return $pedido ;
    } 


   public function verpedidoporid(Request $request){
      
     $pedido = Pedido::where('id_pedido','=' ,$request->id_pedido)->select('id_pedido','id_usuario','fecha')->first();
     $detalles = Detalle_pedido::where('id_pedido','=' ,$request->id_pedido)->get();
     $total = Detalle_pedido::where('id_pedido','=' ,$request->id_pedido)->sum('total_linea');

     return response()->json([$pedido ,' total pedido '=> $total, ' Detalles '=>  $detalles]);
   }

   public function todospedidos(Request $request){
    $pedido= Pedido::with('Detalle_pedido')->get();
    return response()->json(['Pedidos' =>$pedido]);
  } 

  public function todosentradas(Request $request){
       
    $entradas = Pedido::with('Detalle_entrada')->has('Detalle_entrada')->get();
    

    return response()->json(['Pedidos' =>$entradas]);
  }

  public function PedidosProcesados(){
    $Pedidos = Pedido::with('Detalle_entrada')->where('id_estado','=',1)->get();
    

    return response()->json(['Pedidos Procesados' =>$Pedidos]);
  }

  public function Pedidosentregados(){
    $Pedidos = Pedido::with('Detalle_entrada')->where('id_estado','=',2)->get();
    

    return response()->json(['Pedidos Entregados' =>$Pedidos]);
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
       dd($buscaridproducto);
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
     $precioproveedor = Producto_Proveedores::where('id_producto','=',$id_producto)->where('id_proveedor','=',$id_proveedor)->select('price')->first();
     return $precioproveedor->price;
    }   

    public function Verificarentrada(String $id_producto , int $cantidadentrada){
      
      $consulta = Inventario::where('id_producto',$id_producto)->first();
      
      if($consulta==0){
        
        $nuevoinventario = Inventario::create(['id_producto' =>$id_producto, 
         'cantidad' =>$cantidadentrada]);  

         return $nuevoinventario;
      }

      $cantidadnueva = ($consulta->cantidad + $cantidadentrada);
      Inventario::where('id_producto','=', $id_producto)->update(['cantidad' => $cantidadnueva]); 
       return Inventario::where('id_producto', '=', $id_producto)->first();
    }
}
