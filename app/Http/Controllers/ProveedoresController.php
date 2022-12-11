<?php

namespace App\Http\Controllers;

use App\Models\Producto_Proveedores;
use App\Models\Proveedores;
use Exception;
use Validator;
use Illuminate\Http\Request;

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
}
