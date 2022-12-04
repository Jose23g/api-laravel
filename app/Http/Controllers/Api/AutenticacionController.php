<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller
{
    public function registrar(Request $request)
    {
       
        $validator = Validator::make($request->all(),
            [   'name'=> 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]
        ); 
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        $usuario = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        $usuario->save();
        return response()->json(['message' => 'Usuario creado', 200]);

    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        if ($user = User::where('email', '=', $request->email)->first()) {

            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Password no existe']);
            }

            return response()->json(['Message' => 'Bienvenido al sistema', 'usuario' => $user]);
        }

        return response()->json(['message' => 'Email o contraseña incorrecta']);
    }

    public function obtener()
    {
        $usuario = User::all();
        return response()->json($usuario);
    }
}