<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Producto_Proveedores;
use App\Models\Proveedores;
use Dotenv\Parser\Value;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator as ValidationValidator;

class ProveedoresController extends Controller
{
    public function nuevoProveedor(Request $request)
    {
        $validar = Validator::make(
            $request->all(),
            [
                'nombre' => 'required|unique:Proveedores',
                'cedula_juridica' => 'required|unique:Proveedores'
            ]
        );

        if ($validar->fails()) {
            return response()->json(['message' => $validar->errors()]);
        }

        try {
            $proveedor = Proveedores::create([
                'Nombre' => $request->nombre,
                'Cedula_juridica' => $request->cedula_juridica
            ]);

            return response()->json([
                'message' => 'Nuevo proveedor',
                'status' => 'success',
                'Proveedor' => $proveedor
            ]);
        } catch (Exception $e) {
        }
    }

    public function obtenerProveedores()
    {
        return response()->json(Proveedores::get());
    }

    public function proveedorProducto(Request $request)
    {
        try {

            $validar = Validator::make(
                $request->all(),
                [
                    'id_producto' => 'required',
                    'id_proveedor' => 'required'

                ]
            );

            if ($validar->fails()) {
                return response()->json(['message' => $validar->errors()]);
            }

            $resultado = Producto_Proveedores::create([
                'id_producto' => $request->id_producto,
                'id_proveedor' => $request->id_proveedor,
                'Precio' => $request->precio
            ]);

            return response()->json([
                'message' => 'success',
                'resultado' => $resultado
            ]);
        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()]);
        }
    }

    public function consultaProveedor(Request $request)
    {
        $validar = Validator::make(
            $request->all(),
            [
                'id_proveedor' => 'numeric|required',
            ]
        );

        if ($validar->fails()) {
            return response()->json(['message' => $validar->errors()]);
        }

        try {
            /*  $productos = Producto::join(
            'Producto_Proveedores',
            'Producto.id_producto',
            'Producto_Proveedores.id_producto'
            )->select('Producto.Nombre as Producto')
            ->where('Producto_Proveedores.id_proveedor', $request->id_proveedor)->get(); */

            $provedor = Proveedores::find(1)->first();

            $productos = DB::table('Producto_Proveedores')
                ->join('Producto', 'Producto.id_producto', 'Producto_Proveedores.id_producto')
                ->join('Proveedores', 'Proveedores.id_proveedor', 'Producto_Proveedores.id_proveedor')
                ->where('Producto_Proveedores.id_proveedor', '=', $request->id_proveedor)
                ->select('Producto.Nombre as Producto', 'Proveedores.Nombre as Proveedores')->get();

            return response()->json([$provedor->Nombre => $productos]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}