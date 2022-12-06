<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Unidad_Medida;
use Illuminate\Http\Request;
use Validator;

class ProductoController extends Controller
{

    public function getIdPresentacion(string $nombre)
    {
        if (!Presentacion::where('Nombre', '=', $nombre)->first()) {
            $nuevoP = Presentacion::create([
                'Nombre' => $nombre
            ]);
            return $nuevoP[0]->id_presentacion;
        }
        $nuevoP = Presentacion::where('Nombre', '=', $nombre)->get();
        return $nuevoP[0]->id_presentacion;
    }

    public function getIdunidad(string $unidad)
    {
        if (!Unidad_Medida::where('Nombre', '=', $unidad)->first()) {
            $nuevaU = Unidad_Medida::create([
                'Nombre' => $unidad
            ]);
            
            return $nuevaU[0]->id_unidad;
        }

        $laUnidad = Unidad_Medida::where('Nombre','=', $unidad)->get();
        //echo $laUnidad[0]->id_unidad;
        return $laUnidad[0]->id_unidad;
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

        //$idpresentacion = self::presentacion($request->presentacion);
        //$idunidad = self::unidad($request->unidad);

        Producto::create([
            'Codigo_producto' => $request->codigoproducto,
            'Nombre' => $request->nombre,
            'id_presentacion' => self::getIdPresentacion($request->presentacion),
            'id_unidad' => self::getIdunidad($request->unidad),
            'Precio_venta' =>$request->precioventa,
        ]);
    }

}
