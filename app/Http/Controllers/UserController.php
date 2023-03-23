<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
                return response()->json([
                    'message' => 'Usuario logueado correctamente',
                    'user' => $user,
                    'status' => 200,
                    'token' => hash('sha256', $plainTextToken = Str::random(40)),
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
}
