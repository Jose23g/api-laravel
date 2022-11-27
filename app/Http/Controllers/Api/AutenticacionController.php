<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller
{
    public function registrar(Request $request){

        
        $usuario = new User([
            
            'name' =>$request->UserName,
            'email' =>$request->Email,
            'password' =>$request->Password

        ]);
        
        $usuario->save();
        return response()->json(['message' =>'Usuario creado', 200]);
       
    }

    public function login (Request $request){
        
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $credencials = request(['email', 'password']);
       
        if (!Auth::attempt($credencials)) {
            return response()->json(['message' => 'No authorization', 401]);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal_token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json(['data' => [
            'user' => Auth::user(),
            'access_token' => $tokenResult->access_token, 
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->expires_at)->toDateTimeString()
        ]]);
    }

    public function obtener(){
        $usuario = User::all();
        return response()->json($usuario);
    }
}
