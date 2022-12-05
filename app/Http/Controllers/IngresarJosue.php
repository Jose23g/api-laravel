<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use Validator;
use Illuminate\Http\Request;

class IngresarJosue extends Controller
{
    public function listar()
    {

        return Presentacion::all();
    }

    public function ingresarp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|max:25',
        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors());
        }

        if (!Presentacion::Where('Nombre', '=', $request->Nombre)->first()) {

            Presentacion::create([
                'Nombre' => $request->Nombre
            ]);

            return response()->json([
                'mensage' => 'se ingreso corretamente',
                'Unidad' => $request->Nombre
            ]);
        }

        return response()->json(['mensage' => 'fallo la unidad ya se encuentra']);
    }
}
