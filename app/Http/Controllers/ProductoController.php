<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Unidad_Medida;
use Illuminate\Http\Request;
use Validator;

class ProductoController extends Controller
{

    public function presentacion(string $nombre)
    {
        if (!Presentacion::where('Nombre', '=', $nombre)->first()) {
            $nuevoP = Presentacion::create([
                'Nombre' => $nombre
            ]);
            return $nuevoP->id;
        }
        $nuevoP = Presentacion::where('Nombre', '=', $nombre)->get();
       echo($nuevoP->all());
        return $nuevoP->id_presentacion;
    }

    public function unidad(string $unidad)
    {
        if (!Unidad_Medida::where('Nombre', '=', $unidad)->first()) {
            $nuevaU = Unidad_Medida::create([
                'Nombre' => $unidad
            ]);
            
            return $nuevaU->id;
        }

        $laUnidad = Unidad_Medida::where('Nombre','=', $unidad);
        return $laUnidad->id;
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
            return response()->json(['mensage', $validar->erros()]);
        }

        $idpresentacion = self::presentacion($request->presentacion);
        $idunidad = self::unidad($request->unidad);

        Producto::create([
            'Codigo_producto' => $request->codigoproducto,
            'Nombre' => $request->nombre,
            'id_presentacion' => $idpresentacion,
            'id_unidad' => $idunidad,
            'Precio_venta' =>$request->precioventa,

        ]);
    }

}
