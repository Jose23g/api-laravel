<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Proveedores;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Aut;
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller
{
    public function registrar(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nombre1' => 'required',
                'nombre2' => 'required',
                'apellido1' => 'required',
                'cedula' => 'required',
                'usuario' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'contraseña' => 'required'
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        $usuario = User::create([
                'nombre1' => $request->nombre1,
                'nombre2' => $request->nombre2,
                'apellido1' => $request->apellido1,
                'apellido2' => $request->apellido2,
                'cedula' => $request->cedula,
                'usuario' => $request->usuario,
                'email'  => $request->email,
                'contraseña'=> Hash::make($request->contraseña)
        ]);

        return response()->json(['message' => 'Usuario creado', 200, 'usuario' => $usuario]);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'usuario' => 'required',
                    'contraseña' => 'required',
                ]
            );
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()]);
            }

            if ($user = User::where('usuario', '=', $request->usuario)->first()) {

               if (!Hash::check($request->contraseña, $user->contraseña)) {
                    return response()->json(['message' => 'Password no existe']);
                }
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['Message' => 'Bienvenido al sistema', 'user' => $user,'token' =>  $token]);
            }

            return response()->json(['message' => 'Email o contraseña incorrecta']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->get_browser_error()]);
        }
    }

    public function obtener()
    {
        $usuario = User::all();
        return response()->json($usuario);
    }
}
