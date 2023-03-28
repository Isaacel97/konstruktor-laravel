<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
   
    public function create(Request $request)
    {
        $data = $request->all();
       
        $validated = Validator::make($request->all(),[
            'name' => 'required', 
            'apellidos' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'role_id' => 'required|numeric',
            'telefono' => 'required|numeric|digits:10'

        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validated->errors()
            ], 401);
        } 
    
        $user = new User();
        $user->name = $data['name'];
        $user->apellido = $data['apellidos'];
        $user->email = $data['email'];
        $user->password = Hash::make( $data['password']);
        
        $user->role_id = $data['role_id'];
        $user->telefono = $data['telefono'];
        try {
            $user->save();
            return response()->json([
                'message' => 'Usuario creado correctamente',
                'status' => 200
            ]);
        } catch (\Throwable $th) {    
            return response()->json([
                'message' => 'Este usuario ya existe',
                'error' => $th->getMessage(),
                'status' => 500
            ]);
        }
    }
    
    public function login (Request $request) { 
        //login auth
        $data = $request->all();
        $validated = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validated->errors()
            ], 401);
        }
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                $token = hash('sha256', $plainTextToken = Str::random(40));
                $user->token = $token;
                $user->save();

                return response()->json([
                    'message' => 'Usuario logueado correctamente',
                    'user' => $user,
                    'id' => $user->id,
                    'status' => 200,
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'message' => 'Contraseña incorrecta',
                    'status' => 401
                ], );
            }
        } else {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404 
            ], );
        }
    }
    public function auth (Request $request) {
        $data = $request->all();
        //get token from header 
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user = User::where('token', $token)->first();
        if ($user) {
            if($user->role_id == 1){

                return response()->json([
                    'message' => 'Token valido',
                    "type" => 1,
                    'status' => 200
                ]);
            }
                return response()->json([
                    'message' => 'Token valido',
                    "type" => 2,
                    'status' => 200
                ]);
            
        } else {
            return response()->json([
                'message' => 'Token invalido',
                'status' => 401,
                'token' => $token
            ]);
        }
    }
}
