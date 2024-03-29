<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Unidad_Medida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductoController extends Controller
{

    public function getIdPresentacion(string $nombre)
    {
        if (!Presentacion::where('Nombre', '=', $nombre)->first()) {
            $nuevoP = Presentacion::create([
                'Nombre' => $nombre
            ])->get();
            return $nuevoP[0]->id_presentacion;
        }
        $nuevoP = Presentacion::where('Nombre', '=', $nombre)->get();
        //echo $nuevoP;
        return $nuevoP[0]->id_presentacion;
    }

    public function getIdunidad(string $unidad)
    {
        if (!Unidad_Medida::where('Nombre', '=', $unidad)->first()) {
            $nuevaU = Unidad_Medida::create([
                'Nombre' => $unidad
            ])->get();

            return $nuevaU[0]->id_unidad;
        }

        $laUnidad = Unidad_Medida::where('Nombre', '=', $unidad)->get();
        //echo $laUnidad[0]->id_unidad;
        return $laUnidad[0]->id_unidad;
    }

    public function todoproducto()
    {
        return Producto::all();
    }

    public function nuevoproducto(Request $request)
    {
        $validar = Validator::make(
            $request->all(),
            [
                'codigoproducto' => 'required',
                'nombre' => 'required',
                'presentacion' => 'required',
                'unidad' => 'required',
                'precioventa' => 'required',
            ]
        );

        if ($validar->fails()) {
            return response()->json(['mensage', $validar->errors()],500);
        }

        try {
            $NuevoProducto = Producto::create([
                'Codigo_producto' => $request->codigoproducto,
                'Nombre' => $request->nombre,
                'id_presentacion' => self::getIdPresentacion($request->presentacion),
                'id_unidad' => self::getIdunidad($request->unidad),
                'Precio_venta' => $request->precioventa,
            ]);
            return response()->json([
                'message' => 'Nuevo producto registrado',
                'status' => 200,
                'Producto' => $NuevoProducto
            ],200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error', 'status' => 500, $e]);
        }
    }

    public function listaProductosConProveedor()
    {
        try {

            $consultaProducto = Producto::with('Proveedores:Nombre,Cedula_juridica')
         /*    ->select('Proveedoree') */
            ->get();

            return response()->json(['Producto' => $consultaProducto]);

        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()]);
        }
    }
}